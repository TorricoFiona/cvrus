<?php 


	/* dentro de los controladores solo hay codigo php*/


	/* LIBRERIAS */

	$seccion = "Crear CV";

	/* CLASES */


	/* LÓGICA DE NEGOCIO */

	$usuario = new Usuario();

	$cant_users = $usuario->getCant();


	/* IMPRIMO LA VISTA */
	$tpl = new Palta("templates");

	$tpl->assign([
		"CANT_USERS" => $cant_users,
		"APP_SECTION" => $seccion,
	]);

	$tpl->printToScreen();

	

 ?>