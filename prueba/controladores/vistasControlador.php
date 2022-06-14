<?php

require_once "./modelos/vistasModelo.php";

//todos los controladores son publicos

class vistasControlador extends vistasModelo{

	/* controlador para obtener la plantilla*/
	public function obtener_plantilla_controlador(){
		return require_once "./vistas/plantilla.php";
	}

	/* controlador para obtener las vistas*/
	public function obtener_vistas_controlador(){
		if (isset($_GET['views'])) {
			$ruta = explode("/", $_GET['views']);
			$respuesta=vistasModelo::obtener_vistas_modelo($ruta[0]);
		}else{
			$respuesta="./vistas/contenidos/home-view.php";
		}

		return $respuesta;
	}
}