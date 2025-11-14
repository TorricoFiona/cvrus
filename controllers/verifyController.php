<?php
$seccion = "Verificar";
$mensaje = "";

if(isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    $db = new DBAbstract();
    // Buscar usuario con token
    $sql = "SELECT * FROM usuario WHERE email='" . $email . "' AND verificacion_token='" . $token . "' LIMIT 1"; // TODO: prepared
    $res = $db->consultar($sql);
    if(count($res) === 1) {
        // Actualizar verificación y anular token para un solo uso
        $update = "UPDATE usuario SET email_verificado=1, verificado_en='" . date('Y-m-d H:i:s') . "', verificacion_token=NULL WHERE email='" . $email . "' LIMIT 1";
        $db->ejecutar($update);
        $mensaje = "Cuenta verificada correctamente. Ya podés iniciar sesión.";
    } else {
        $mensaje = "Enlace inválido o token expirado.";
    }
} else {
    $mensaje = "Faltan parámetros de verificación.";
}

$tpl = new Palta("verify");
$tpl->assign([
    'VERIFY_MESSAGE' => $mensaje,
    'APP_SECTION' => $seccion,
]);
$tpl->printToScreen();
