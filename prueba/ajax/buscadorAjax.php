<?php

session_start(['name'=>'SPM']);

require_once "../config/app.php";



if (isset($_POST['busqueda_inicial']) || isset($_POST['eliminar_busqueda']) || isset($_POST['ordenar_prod']) ) {

	$data_url=[
		"producto"=>"producto-search",
		"productos"=>"producto-list",
		"ventas"=>"ventas-search"
	];


	if (isset($_POST['ordenar_prod'])) {
		$tipo_ord= $_POST['ordenar_prod'];
	} else {
		$tipo_ord = "";
	}
	
	$_SESSION['ordenar']=$tipo_ord;

	if (isset($_POST['modulo'])) {
		$modulo = $_POST['modulo'];
		if (!isset($data_url[$modulo])) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se pudo continuar con la busqueda",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}
	} else {
		$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrió un error inesperado",
			"Texto"=>"No se pudo continuar con la busqueda",
			"Tipo"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}


	/* si es el form de busqueda diferente al general
	creo otras variables de sesion*/
	if ($modulo=="") {
		
	} else {
		$name_var="busqueda_".$modulo;

		// iniciar busqueda general
		if (isset($_POST['busqueda_inicial'])) {
			if ($_POST['busqueda_inicial']=="") {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"Introduzca un valor para la busqueda",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

			$_SESSION[$name_var]=$_POST['busqueda_inicial'];
		}

		//eliminar busqueda general
		if (isset($_POST['eliminar_busqueda'])) {
			unset($_SESSION[$name_var]);
		}
	}


	// redireccionar

	$url=$data_url[$modulo];
	$alerta=[
		"Alerta"=>"redireccionar",
		"URL"=>SERVERURL.$url."/"
	];
	echo json_encode($alerta);
	

} else {
session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."home/");
	exit();
}


