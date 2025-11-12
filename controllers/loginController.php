<?php 
	
	session_start();
	if(isset($_SESSION['user_email'])){
	    header("Location: ?slug=panel");
	    exit;
	}

	$seccion = "Iniciar sesion";
	$error_login = "";

	/* se presiono el boton de ingresar */
	if(isset($_POST['btn_ingresar'])){
	
		/* se instancia la clase usuario */
		$usuario = new Usuario();

		/* se prueba si se puede loguear */
		$response = $usuario->login($_POST);

		// en el caso que el logueo sea valido
		if($response["errno"]==202){
		    $_SESSION['user_email'] = $_POST['txt_email'];
		    header("Location: ?slug=panel");
		    exit;
		}


		$error_login = $response["error"];
	}

	/* IMPRIMO LA VISTA */
	$tpl = new Palta("login");

	$tpl->assign([
		"ERROR_LOGIN" => $error_login,
		"APP_SECTION" => $seccion,
	]);

	$tpl->printToScreen();
?>