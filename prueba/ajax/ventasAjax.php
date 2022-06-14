<?php

$peticionAjax = true;
require_once "../config/app.php";
session_start(['name'=>'SPM']);


if (isset($_POST['ventas_nombre_reg'])) {
	// instancia al controlador

	require_once "../controladores/ventasControlador.php";
	$ins_usuario = new ventasControlador();


	// Agregar un usuario
	if (isset($_POST['ventas_nombre_reg']) && isset($_POST['ventas_producto_reg'])) {
		echo $ins_usuario->agregar_ventas_controlador();
	}


	// Eliminar un usuario
	/*if (isset($_POST['venta_id_delete'])) {
		echo $ins_usuario->eliminar_venta_controlador();
	}*/

}else{
	//si acceden al archivo desde la url
session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."home/");
	exit();
}