<?php

if ($peticionAjax) {
	//si es una peticion ajax se ejecuta en la carpeta ajax
	require_once "../modelos/productoModelo.php";
}else{
	//sino se ejecuta en el index
	require_once "./modelos/productoModelo.php";
}

class productoControlador extends productoModelo{
	
	// controlador para agregar usuario

	public function agregar_producto_controlador(){

		$nombre=mainModel::limpiar_cadena($_POST['producto_nombre_reg']);
		$referencia=mainModel::limpiar_cadena($_POST['producto_referencia_reg']);
		$precio=mainModel::limpiar_cadena($_POST['producto_precio_reg']);
		$peso=mainModel::limpiar_cadena($_POST['producto_peso_reg']);
		$categoria=mainModel::limpiar_cadena($_POST['producto_categoria_reg']);

		$stock=mainModel::limpiar_cadena($_POST['producto_stock_reg']);
		$fecha=mainModel::limpiar_cadena($_POST['producto_fecha_reg']);


		//comprobar campos vacios

		if($nombre=="" || $referencia=="" || $precio=="" || $peso=="" || $categoria=="" || $stock==""){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"Hay campos sin llenar",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		//verificando integridad de los datos

		if (mainModel::verificar_datos("[a-zA-Z0-9 ]{1,50}",$nombre)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El nombre no tiene el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (mainModel::verificar_datos("[a-zA-Z0-9 ]{1,50}",$referencia)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"La referencia no tiene el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (mainModel::verificar_datos("[0-9-]{1,20}",$precio)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El precio no tiene el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		// comprobar DNI

		$check_ref = mainModel::ejecutar_consulta_simple("SELECT producto_referencia FROM productos WHERE producto_referencia = '".$referencia."'");
		if ($check_ref->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"La referencia ya existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		//comprobar usuario

		$check_nom = mainModel::ejecutar_consulta_simple("SELECT producto_referencia FROM productos WHERE producto_nombre= '".$nombre."'");
		if ($check_nom->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El producto ya existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		
		$datos_usuario_reg=[			
			"Nombre"=>$nombre,
			"Referencia"=> $referencia,
			"Precio"=>$precio,
			"Peso"=>$peso,
			"Categoria"=>$categoria,
			"Stock"=>$stock,
			"Fecha"=>$fecha		
		];

		$agregar_usuario=productoModelo::agregar_producto_modelo($datos_usuario_reg);

		if ($agregar_usuario->rowCount()==1) {
			$alerta=[
				"Alerta"=>"limpiar",
				"Titulo"=>"Producto registrado",
				"Texto"=>"Los datos del producto se han guardado",
				"Tipo"=>"success"
			];
		} else {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se ha podido realizar el registro",
				"Tipo"=>"error"
			];
		}
		
		echo json_encode($alerta);

	}


	//controlador paginar usuarios
	public function paginador_producto_controlador($pagina,$registros,$url,$busqueda,$tipo){

		$pagina=mainModel::limpiar_cadena($pagina);
		$registros=mainModel::limpiar_cadena($registros);
		
		$url=mainModel::limpiar_cadena($url);
		$url=SERVERURL.$url."/";
		$busqueda=mainModel::limpiar_cadena($busqueda);

		$tabla="";

		$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
		$inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

		if (isset($busqueda) && $busqueda!="") {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM productos WHERE ((producto_nombre LIKE '%".$busqueda."%' OR producto_referencia LIKE '%".$busqueda."%' OR producto_categoria LIKE '%".$busqueda."%')) ORDER BY producto_nombre ASC LIMIT ".$inicio.",".$registros;
		} else {
			if ($tipo!="") {
				if($tipo=="stock"){
					$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM productos ORDER BY producto_stock DESC LIMIT ".$inicio.",".$registros;
				}else{
					$consulta = "SELECT productos.* FROM productos LEFT JOIN ventas ON productos.producto_id = ventas.ventas_idproducto GROUP BY productos.producto_nombre LIMIT ".$inicio.",".$registros;
				}
				
			} else {
				$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM productos ORDER BY producto_nombre ASC LIMIT ".$inicio.",".$registros;
			}
			
			
		}

		$conexion = mainModel::conectar();
		$datos = $conexion->query($consulta);
		$datos = $datos->fetchAll();

		$total = $conexion->query("SELECT FOUND_ROWS()");
		$total = (int) $total->fetchColumn();

		$Npaginas = ceil($total/$registros);
		
		$tabla.='
		<div class="table-responsive">
			<table class="table table-dark table-sm">
				<thead>
					<tr class="text-center roboto-medium">
						<th>#</th>
						<th>ID</th>
						<th>NOMBRE</th>
						<th>REFERENCIA</th>
						<th>PRECIO</th>
						<th>PESO</th>
						<th>CATEGORIA</th>
						<th>STOCK</th>
						<th>FECHA</th>
						<th>ACTUALIZAR</th>
						<th>ELIMINAR</th>
					</tr>
				</thead>
				<tbody>';

		if ($total>=1 && $pagina<=$Npaginas) {
			$contador = $inicio+1;
			$reg_inicio=$inicio+1;
			foreach ($datos as $rows) {
				$tabla.='
				<tr class="text-center" >
					<td>'.$contador.'</td>
					<td>'.$rows['producto_id'].'</td>
					<td>'.$rows['producto_nombre'].'</td>
					<td>'.$rows['producto_referencia'].'</td>
					<td>'.$rows['producto_precio'].'</td>
					<td>'.$rows['producto_peso'].'</td>
					<td>'.$rows['producto_categoria'].'</td>
					<td>'.$rows['producto_stock'].'</td>
					<td>'.$rows['producto_fecha'].'</td>
					
					<td>
						<a href="'.SERVERURL.'producto-update/'.mainModel::encryption($rows['producto_id']).'/" class="btn btn-success">
								<i class="fas fa-sync-alt"></i>	
						</a>
					</td>
					<td>
						<form class="FormularioAjax"  action="'.SERVERURL.'ajax/productoAjax.php" method="POST" data-form="delete">
							<input type="hidden" value="'.mainModel::encryption($rows['producto_id']).'" name="producto_id_delete">
							<button type="submit" class="btn btn-warning">
									<i class="far fa-trash-alt"></i>
							</button>
						</form>
					</td>
				</tr>';
				$contador++;
			}
			$reg_final = $contador-1;

		} else {
			if ($total>=1) {
				$tabla.='<tr class="text-center" ><td colspan="9">
				<a href="'.$url.'" class="btn btn-raised btn-primary">Recargar listado</a>
				</td></tr>';
			} else {
				$tabla.='<tr class="text-center" ><td colspan="9">No hay registros en el sistema</td></tr>';
			}
						
		}

		if ($total>=1 && $pagina<=$Npaginas) {
			$tabla.='<p class="text-right">Mostrando productos '.$reg_inicio.' al '.$reg_final.' de '.$total.'</p>';
		}

		$tabla.='</tbody>
			</table>
		</div>';

		if ($total>=1 && $pagina<=$Npaginas) {
			$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,5);
		}
		

		return $tabla;

	}

	//controlador eliminar usuario

	public function eliminar_producto_controlador(){

		$id_producto=mainModel::decryption($_POST['producto_id_delete']);
		$id_producto=mainModel::limpiar_cadena($id_producto);
		

		// comprobando que existe
		$check_user=mainModel::ejecutar_consulta_simple("SELECT producto_id FROM productos WHERE producto_id = '".$id_producto."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El producto no existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		// comprobando que no este relacionado en otra tabla
		$check_prestamo=mainModel::ejecutar_consulta_simple("SELECT ventas_idproducto FROM ventas WHERE ventas_idproducto = '".$id_producto."' LIMIT 1");

		if ($check_prestamo->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El producto tiene una o varias ventas",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}



		// eliminado producto
		
		$eliminar_producto=productoModelo::eliminar_producto_modelo($id_producto);

		if ($eliminar_producto->rowCount()==1) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"Producto eliminado",
				"Texto"=>"Los datos del producto se han eliminado correctamente",
				"Tipo"=>"success"
			];
		} else {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se ha podido eliminar el producto",
				"Tipo"=>"error"
			];
		}
		
		echo json_encode($alerta);

	}


	// controlador datos usuario

	public function datos_producto_controlador($tipo,$id){
		
		$id = mainModel::decryption($id);
		$id=mainModel::limpiar_cadena($id);
		$tipo=mainModel::limpiar_cadena($tipo);

		return productoModelo::datos_producto_modelo($tipo,$id);

	}

	// controlador actualizar producto

	public function actualizar_producto_controlador(){

		// recibir id
		$id = mainModel::decryption($_POST['producto_id_up']);
		$id=mainModel::limpiar_cadena($id);

		// comprobar el producto en la bd
		$check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM productos WHERE producto_id = '".$id."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El producto no existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}else{
			$campos=$check_user->fetch();			

		}


		$nombre=mainModel::limpiar_cadena($_POST['producto_nombre_up']);
		$referencia=mainModel::limpiar_cadena($_POST['producto_referencia_up']);
		$precio=mainModel::limpiar_cadena($_POST['producto_precio_up']);
		$peso=mainModel::limpiar_cadena($_POST['producto_peso_up']);
		$categoria=mainModel::limpiar_cadena($_POST['producto_categoria_up']);

		$stock=mainModel::limpiar_cadena($_POST['producto_stock_up']);

		if ($nombre =="" || $referencia =="" || $precio =="" || $peso =="" || $categoria =="") {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No ha llenado todos los campos obligatorios",
				"Tipo"=>"error"
			];

			echo json_encode($alerta);
			exit();
		}

		// verificar integridad de los datos, agregar condiciones segun sea necesario
		
		if (mainModel::verificar_datos("[a-zA-Z0-9 ]{1,50}",$nombre)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El nombre no tiene el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (mainModel::verificar_datos("[a-zA-Z0-9 ]{1,50}",$referencia)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"La referencia no tiene el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (mainModel::verificar_datos("[0-9-]{1,20}",$precio)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El precio no tiene el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		// comprobar nombre
		if ($nombre!=$campos['producto_nombre']) {
			$check_nom = mainModel::ejecutar_consulta_simple("SELECT producto_nombre FROM productos WHERE producto_nombre = '".$nombre."'");
			if ($check_nom->rowCount()>0) {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El producto ya existe",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}
		

		//comprobar referencia
		if ($referencia!=$campos['producto_referencia']) {
			$check_ref = mainModel::ejecutar_consulta_simple("SELECT producto_referencia FROM productos WHERE producto_referencia = '".$referencia."'");
			if ($check_ref->rowCount()>0) {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"La referencia ya existe",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}


		$fecha = $campos['producto_fecha'];
		
		// enviando datos al modelo
		$datos_producto_up=[
			"ID"=>$id,
			"Nombre"=>$nombre,
			"Referencia"=>$referencia,
			"Precio"=>$precio,
			"Peso"=>$peso,
			"Categoria"=>$categoria,
			"Stock"=>$stock,
			"Fecha"=>$fecha
		];

		
		if (productoModelo::actualizar_producto_modelo($datos_producto_up)) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"Producto modificado",
				"Texto"=>"Los datos del producto se han modificado",
				"Tipo"=>"success"
			];
		} else {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se ha podido realizar la acción",
				"Tipo"=>"error"
			];
		}
		
		echo json_encode($alerta);

	}

}




