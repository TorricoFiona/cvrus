<?php 
	session_start();

	if(!isset($_SESSION['user_email'])){
	    header("Location: ?slug=login");
	    exit;
	}

	$seccion = "Panel de usuario";
	$user_name = "XXXXX";

	/* IMPRIMO LA VISTA */
	$tpl = new Palta("panel");

	$tpl->assign([
		"USER_NAME" => $user_name,
        "APP_SECTION" => $seccion,
	]);

	$tpl->printToScreen();
 ?>