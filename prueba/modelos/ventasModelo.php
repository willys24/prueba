<?php
//modelo interactua con la bd

require_once "mainModel.php";

class ventasModelo extends mainModel{
	// modelo para agregar usuario

	protected static function agregar_ventas_modelo($datos){
		$sql = mainModel::conectar()->prepare("INSERT INTO ventas (ventas_idproducto, ventas_producto, ventas_cantidad, ventas_total, ventas_comprador, ventas_fecha) VALUES (:Idproducto, :Producto, :Cantidad, :Total, :Nombre, :Fecha)");

		$sql->bindParam(":Idproducto",$datos['Idproducto']);	
		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Producto",$datos['Producto']);
		$sql->bindParam(":Cantidad",$datos['Cantidad']);
		$sql->bindParam(":Total",$datos['Total']);
		$sql->bindParam(":Fecha",$datos['Fecha']);

		$sql->execute();
		
		return $sql;

	}


	// modelo para eliminar usuario

	protected static function eliminar_ventas_modelo($id){
		$sql = mainModel::conectar()->prepare("DELETE FROM ventas WHERE ventas_id = :Ventas_id");

		$sql->bindParam(":Ventas_id",$id);
		$sql->execute();
		return $sql;

	}

	// modelo datos usuario

	protected static function datos_ventas_modelo($tipo,$id){
		if ($tipo=="Conteo") {
			$sql=mainModel::conectar()->prepare("SELECT * FROM ventas");
		} else {
			$sql=mainModel::conectar()->prepare("SELECT * FROM ventas WHERE ventas_id = :Ventas_id");
			$sql->bindParam(":Ventas_id",$id);
		}
		
		$sql->execute();
		return $sql;

	}

	// modelo actualizar usuario
	protected static function actualizar_stock_modelo($datos){
		$sql=mainModel::conectar()->prepare("UPDATE productos SET producto_stock=:Stock WHERE producto_id = :Idproducto");

		$sql->bindParam(":Idproducto",$datos['Idproducto']);		
		$sql->bindParam(":Stock",$datos['Stock']);

		$sql->execute();
		
		return $sql;

	}
	
}