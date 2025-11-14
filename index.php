<?php 
	/****
	 * 
	 * 
	 * ROuter firewall
	 * 
	 * 
	 * */

	$env = 'production'; // cambiar a 'production' cuando subas al servidor // cambiar a local para trabajar local

	if ($env === 'local') {
	    require_once __DIR__ . '/env.php';
	} else {
	    require_once __DIR__ . '/envProduction.php';
	}

	include_once'librarys/palta/Palta.php';

	include_once 'models/DBAbstract.php';
	include_once 'models/UsuariosModel.php';
	include_once 'models/ProfileModel.php';

	$section = "landing";

	if(isset($_GET["slug"])){
		$section = $_GET['slug'];
	}

	if(!file_exists( 'controllers/'.$section.'Controller.php')){
		echo 'controllers/'.$section.'Controller.php';
		$section = "error";
	}

	include 'controllers/'.$section.'Controller.php';



 ?>