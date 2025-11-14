<?php
/**
 * Script de migración de contraseñas en texto plano a hashes seguros.
 * Ejecutar UNA sola vez (por consola o navegador protegido) después de desplegar el nuevo código.
 *
 * Pasos:
 * 1. Hacer backup de la tabla `usuario`.
 * 2. Colocar este script en el root y acceder: http://localhost/cvrus_desarrollo/convert_passwords.php?token=TU_TOKEN_SEGURIDAD
 * 3. Verificar resultado y luego eliminar el archivo.
 */
require_once __DIR__ . '/env.php';
require_once __DIR__ . '/models/DBAbstract.php';

// Cambia este token a un valor impredecible antes de usar
$tokenSeguridad = 'CAMBIAR_ESTE_TOKEN';
if (!isset($_GET['token']) || $_GET['token'] !== $tokenSeguridad) {
    http_response_code(403);
    echo 'Acceso denegado';
    exit;
}

class PasswordMigrator extends DBAbstract {
    public function migrar() {
        $usuarios = $this->consultar('SELECT id, email, password FROM usuario');
        $procesados = 0; $actualizados = 0; $yaHash = 0;
        foreach ($usuarios as $u) {
            $procesados++;
            $info = password_get_info($u['password']);
            if ($info['algo'] !== 0) { // ya es hash
                $yaHash++;
                continue;
            }
            // Texto plano: lo convertimos
            $nuevo = password_hash($u['password'], PASSWORD_DEFAULT);
            $id = (int)$u['id'];
            $sql = "UPDATE usuario SET password='" . $nuevo . "' WHERE id=" . $id . " LIMIT 1";
            $this->ejecutar($sql);
            $actualizados++;
        }
        return [
            'procesados' => $procesados,
            'actualizados' => $actualizados,
            'ya_hash' => $yaHash
        ];
    }
}

$migrator = new PasswordMigrator();
$res = $migrator->migrar();
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'status' => 'ok',
    'detalle' => $res,
    'nota' => 'Elimina convert_passwords.php después de verificar.'
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
