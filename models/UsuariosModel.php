<?php 
	
	/**
	 * 
	 * Clase Usuarios
	 * Contiene todo lo que debe tener / hacer un usuario
	 * 
	 * */
	class Usuario extends DBAbstract
	{

		/* atributos de un usuario */
			public $email, $password;
		
		/* al crear la instancia se ejecuta el constructor */
		function __construct()
		{

			/* llamo al constructor del padre DBAbstract */
			parent::__construct();

			$this->name = "";
			$this->lastName = "";
			$this->email = "";
			$this->password = "";
		}

		public function getCant(){
			return count($this->consultar("SELECT * FROM usuario"));
		}
	

		/**
		 * 
		 * valido
		 * usuario sea valido y pass invalida
		 * usuario no exista
		 * usuario = ""
		 * password = ""
		 * 
		 * */
		public function login($form){

			$this->email = $form['txt_email'];
			$this->password = $form['txt_password'];

			/* no hay email*/
			if( strlen($this->email)==0 ){
				return ["errno" => 404, "error" => "Falta email"];
			}

			/* no hay contraseña */
			if(strlen($this->password) == 0){
				return ["errno" => 404, "error" => "Falta contraseña"];
			}

			$sql = "SELECT * FROM usuario WHERE email = '".$this->email."'"; // TODO: reemplazar por prepared statement

			$response = $this->consultar($sql);

			/* valido que exista el usuario*/
			if(count($response)==0){
				return ["errno" => 400, "error" => "usuario no registrado"];
			}

			$usuarioDB = $response[0];
			$hashAlmacenado = $usuarioDB["password"];

			/* Caso moderno: password_hash */
			if(password_verify($this->password, $hashAlmacenado)){
				// Bloquear acceso si el email no está verificado
				if (isset($usuarioDB['email_verificado']) && (int)$usuarioDB['email_verificado'] !== 1) {
					return ["errno" => 403, "error" => "Debes verificar tu email para ingresar."]; 
				}
				// Rehash si el algoritmo o coste cambió
				if(password_needs_rehash($hashAlmacenado, PASSWORD_DEFAULT)){
					$nuevoHash = password_hash($this->password, PASSWORD_DEFAULT);
					$update = "UPDATE usuario SET password='".$nuevoHash."' WHERE email='".$this->email."' LIMIT 1";
					$this->ejecutar($update);
				}
				return [
			        "errno" => 202,
			        "error" => "Acceso valido",
			        "id_usuario" => $usuarioDB['id_usuario'] // <--- esto faltaba
			    ];
			}

			/* Compatibilidad retro: password plano almacenado */
			$info = password_get_info($hashAlmacenado);
			if($info['algo'] === 0){ // Probablemente texto plano
				if($hashAlmacenado === $this->password){
					// Actualizo a hash seguro
					$nuevoHash = password_hash($this->password, PASSWORD_DEFAULT);
					$update = "UPDATE usuario SET password='".$nuevoHash."' WHERE email='".$this->email."' LIMIT 1";
					$this->ejecutar($update);
					return ["errno" => 202, "error" => "Acceso valido"];
				}
			}

			return ["errno" => 401, "error" => "contraseña incorrecta"];

		}

		public function register($form){

			$this->name = $form['txt_name'];
			$this->lastName = $form['txt_lastName'];
			$this->email = $form['txt_email'];
			$this->password = $form['txt_password'];

			/* no hay nombre*/
			if( strlen($this->name)==0 ){
				return ["errno" => 404, "error" => "Falta nombre"];
			}
			
			/* no hay apellido*/
			if( strlen($this->lastName)==0 ){
				return ["errno" => 404, "error" => "Falta apellido"];
			}

			/* no hay email*/
			if( strlen($this->email)==0 ){
				return ["errno" => 404, "error" => "Falta email"];
			}

			/* no hay contraseña */
			if(strlen($this->password) == 0){
				return ["errno" => 404, "error" => "Falta contraseña"];
			}

			$sql = "SELECT * FROM usuario WHERE email = '".$this->email."'"; // TODO: prepared statement

			$response = $this->consultar($sql);

			/* valido que NO exista el usuario*/
			if(count($response) > 0){
				return ["errno" => 400, "error" => "El usuario ya existe"];
			}

			$hash = password_hash($this->password, PASSWORD_DEFAULT);
			// Generar token de verificación
			$token = bin2hex(random_bytes(32));
			$ahora = date('Y-m-d H:i:s');

			// Intento insertar con campos de verificación si existen
			$insert = "INSERT INTO usuario (nombre, apellido, email, password, email_verificado, verificacion_token, verificacion_enviada_en) VALUES ('".$this->name."','".$this->lastName."','".$this->email."', '".$hash."', 0, '".$token."', '".$ahora."')"; // TODO: prepared statement
			$ok = $this->ejecutar($insert);

			if (!$ok) {
				// Fallback: si la tabla aún no tiene columnas de verificación, insertar solo email/password
				$insert2 = "INSERT INTO usuario (email, password) VALUES ('".$this->email."', '".$hash."')";
				$this->ejecutar($insert2);
			}

			// Enviar email de verificación (ignorar errores de envío)
			$this->enviarVerificacionEmail($this->email, $token);

			return ["errno" => 201, "error" => "OK"];


		}

		private function enviarVerificacionEmail($email, $token) {
			// Construir enlace absoluto/relativo
			$base = (isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http') . "://" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . dirname($_SERVER['REQUEST_URI'] ?? '/');
			$link = $base . "?slug=verify&email=" . urlencode($email) . "&token=" . urlencode($token);

			$subject = 'Activa tu cuenta en CVrus';

			$body = '
				<!DOCTYPE html>
				<html lang="es">
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Verificación de cuenta</title>
				</head>
				<body style="margin: 0; padding: 0; font-family: \'Inter\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; background-color: #f5f7f8; line-height: 1.6;">
					<table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f5f7f8;">
						<tr>
							<td style="padding: 40px 20px;">
								<table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #FFFFFF; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
									<!-- Header -->
									<tr>
										<td style="background: linear-gradient(135deg, #007BFF 0%, #00a8ff 100%); padding: 40px 30px; text-align: center;">
											<h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 900; letter-spacing: -0.02em;">
												CVrus
											</h1>
											<p style="margin: 8px 0 0 0; color: rgba(255, 255, 255, 0.9); font-size: 14px; font-weight: 500;">
												Tu Primer CV Profesional
											</p>
										</td>
									</tr>
									
									<!-- Content -->
									<tr>
										<td style="padding: 40px 30px;">
											<h2 style="margin: 0 0 20px 0; color: #1F2937; font-size: 24px; font-weight: 700; letter-spacing: -0.02em;">
												¡Bienvenido/a a CVrus! 
											</h2>
											
											<p style="margin: 0 0 20px 0; color: #6B7280; font-size: 16px; line-height: 1.6;">
												Estamos emocionados de tenerte con nosotros. Para comenzar a usar tu cuenta, necesitamos verificar tu dirección de correo electrónico.
											</p>
											
											<p style="margin: 0 0 30px 0; color: #6B7280; font-size: 16px; line-height: 1.6;">
												Haz clic en el botón de abajo para activar tu cuenta:
											</p>
											
											<!-- Button -->
											<table role="presentation" style="margin: 0 auto;">
												<tr>
													<td style="border-radius: 0.75rem; background: #007BFF;">
														<a href="' . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . '" style="display: inline-block; padding: 16px 40px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 600; border-radius: 0.75rem;">
															Activar mi cuenta
														</a>
													</td>
												</tr>
											</table>
											
											<p style="margin: 30px 0 20px 0; color: #9CA3AF; font-size: 14px; line-height: 1.6;">
												Si el botón no funciona, copia y pega este enlace en tu navegador:
											</p>
											
											<div style="background-color: #F7F9FC; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 15px; word-break: break-all;">
												<a href="' . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . '" style="color: #007BFF; text-decoration: none; font-size: 14px;">
													' . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . '
												</a>
											</div>
										</td>
									</tr>
									
									<!-- Footer -->
									<tr>
										<td style="background-color: #F7F9FC; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
											<p style="margin: 0 0 10px 0; color: #9CA3AF; font-size: 13px; line-height: 1.5;">
												Si no solicitaste esta cuenta, puedes ignorar este mensaje de forma segura.
											</p>
											<p style="margin: 0; color: #6B7280; font-size: 12px;">
												© ' . date('Y') . ' CVrus · Todos los derechos reservados
											</p>
										</td>
									</tr>
								</table>
								
								<!-- Spacer for email clients -->
								<table role="presentation" style="max-width: 600px; margin: 20px auto 0;">
									<tr>
										<td style="text-align: center; padding: 0 20px;">
											<p style="margin: 0; color: #9CA3AF; font-size: 12px; line-height: 1.5;">
												Este es un correo automático, por favor no respondas a este mensaje.
											</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</body>
				</html>';

			// Cargar PHPMailer local
			$cred = __DIR__ . '/../vendor/mp-mailer-master/credenciales.php';
			$baseMailerPath = __DIR__ . '/../vendor/mp-mailer-master/Mailer/src/';
			if (!file_exists($cred)) {
				$cred = __DIR__ . '/../vendor/mp-mailer-master/credenciales.php'; // intento relativo diferente por estructura
			}
			@include_once $cred;
			@include_once $baseMailerPath . 'PHPMailer.php';
			@include_once $baseMailerPath . 'SMTP.php';
			@include_once $baseMailerPath . 'Exception.php';

			if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
				return false;
			}
			$mail = new \PHPMailer\PHPMailer\PHPMailer();
			try{
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Host = defined('HOST') ? HOST : 'smtp.gmail.com';
				$mail->Port = defined('PORT') ? PORT : 587;
				$mail->SMTPAuth = defined('SMTP_AUTH') ? SMTP_AUTH : true;
				$mail->SMTPSecure = defined('SMTP_SECURE') ? SMTP_SECURE : 'tls';
				$mail->Username = defined('REMITENTE') ? REMITENTE : '';
				$mail->Password = defined('PASSWORD') ? PASSWORD : '';
				$mail->setFrom(defined('REMITENTE') ? REMITENTE : 'no-reply@example.com', defined('NOMBRE') ? NOMBRE : 'CVrus');
				$mail->addAddress($email);
				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $body;
				$mail->send();
				return true;
			}catch(\Exception $e){
				return false;
			}
		}

	}


 ?>