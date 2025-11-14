# Personas Perdidas

Esta aplicacion es para que los municipios publiquen de forma rapida las personas perdidas o desaparecidas

## Seguridad de contraseñas

A partir de la versión actual las contraseñas se almacenan usando `password_hash()` con el algoritmo `PASSWORD_DEFAULT` de PHP. El flujo implementa:

1. Registro: la contraseña se hashea antes de insertarse.
2. Login: se verifica con `password_verify()`. Si la contraseña almacenada todavía está en texto plano (legado), se convierte automáticamente al primer inicio de sesión exitoso.
3. Rehash automático: si el coste/algoritmo cambia, se actualiza el hash durante el login.

### Migración manual (opcional)

Se incluye el script `convert_passwords.php` para migrar todos los usuarios en bloque. Usar solo una vez y luego borrar el archivo. Protegerlo con un token y preferentemente ejecutarlo en entorno seguro.

### Recomendaciones futuras

- Reemplazar concatenaciones SQL por consultas preparadas para prevenir inyección.
- Limitar intentos de login (rate limiting) y registrar intentos fallidos.
- Forzar HTTPS y establecer políticas de seguridad (HSTS, Content-Security-Policy, etc.).
- Añadir validación de complejidad mínima de contraseñas.