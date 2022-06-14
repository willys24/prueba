<?php

$peticionAjax = true;
require_once "../config/app.php";
session_start(['name'=>'SPM']);


if (isset($_POST['producto_nombre_reg']) || isset($_POST['producto_id_delete']) || isset($_POST['producto_id_up'])) {
	// instancia al controlador

	require_once "../controladores/productoControlador.php";
	$ins_usuario = new productoControlador();


	// Agregar un usuario
	if (isset($_POST['producto_nombre_reg']) && isset($_POST['producto_referencia_reg'])) {
		echo $ins_usuario->agregar_producto_controlador();
	}

	// Actualizar un usuario
	if (isset($_POST['producto_id_up'])) {
		echo $ins_usuario->actualizar_producto_controlador();
	}

	// Eliminar un usuario
	if (isset($_POST['producto_id_delete'])) {
		echo $ins_usuario->eliminar_producto_controlador();
	}

}else{
	//si acceden al archivo desde la url
session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."home/");
	exit();
}