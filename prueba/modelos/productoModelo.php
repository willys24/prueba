<?php
//modelo interactua con la bd

require_once "mainModel.php";

class productoModelo extends mainModel{
	// modelo para agregar usuario

	protected static function agregar_producto_modelo($datos){
		$sql = mainModel::conectar()->prepare("INSERT INTO productos (producto_nombre, producto_referencia, producto_precio, producto_peso, producto_categoria, producto_stock, producto_fecha) VALUES (:Nombre, :Referencia, :Precio, :Peso, :Categoria, :Stock, :Fecha)");

		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Referencia",$datos['Referencia']);		
		$sql->bindParam(":Precio",$datos['Precio']);
		$sql->bindParam(":Peso",$datos['Peso']);
		$sql->bindParam(":Categoria",$datos['Categoria']);
		$sql->bindParam(":Stock",$datos['Stock']);
		$sql->bindParam(":Fecha",$datos['Fecha']);

		$sql->execute();
		//print_r($datos);

		return $sql;

	}


	// modelo para eliminar usuario

	protected static function eliminar_producto_modelo($id){
		$sql = mainModel::conectar()->prepare("DELETE FROM productos WHERE producto_id = :Producto_id");

		$sql->bindParam(":Producto_id",$id);
		$sql->execute();
		return $sql;

	}

	// modelo datos usuario

	protected static function datos_producto_modelo($tipo,$id){
		if ($tipo=="Conteo") {
			$sql=mainModel::conectar()->prepare("SELECT * FROM productos");
		} else {
			$sql=mainModel::conectar()->prepare("SELECT * FROM productos WHERE producto_id = :Producto_id");
			$sql->bindParam(":Producto_id",$id);
		}
		
		$sql->execute();
		return $sql;

	}

	// modelo actualizar usuario
	protected static function actualizar_producto_modelo($datos){
		$sql=mainModel::conectar()->prepare("UPDATE productos SET producto_nombre=:Nombre, producto_referencia=:Referencia, producto_precio=:Precio, producto_peso=:Peso, producto_categoria=:Categoria, producto_stock=:Stock, producto_fecha=:Fecha WHERE producto_id = :ID");

		$sql->bindParam(":ID",$datos['ID']);
		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Referencia",$datos['Referencia']);		
		$sql->bindParam(":Precio",$datos['Precio']);
		$sql->bindParam(":Peso",$datos['Peso']);
		$sql->bindParam(":Categoria",$datos['Categoria']);
		$sql->bindParam(":Stock",$datos['Stock']);
		$sql->bindParam(":Fecha",$datos['Fecha']);

		$sql->execute();
		
		return $sql;

	}
	
}