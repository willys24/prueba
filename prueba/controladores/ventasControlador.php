<?php

if ($peticionAjax) {
	//si es una peticion ajax se ejecuta en la carpeta ajax
	require_once "../modelos/ventasModelo.php";
}else{
	//sino se ejecuta en el index
	require_once "./modelos/ventasModelo.php";
}

class ventasControlador extends ventasModelo{
	
	// controlador para agregar usuario

	public function agregar_ventas_controlador(){

		$nombre=mainModel::limpiar_cadena($_POST['ventas_nombre_reg']);
		$idproducto=mainModel::decryption($_POST['ventas_producto_reg']);
		$idproducto=mainModel::limpiar_cadena($idproducto);
		$cantidad=mainModel::limpiar_cadena($_POST['ventas_cantidad_reg']);
		
		$fecha=mainModel::limpiar_cadena($_POST['ventas_fecha_reg']);


		//comprobar campos vacios

		if($nombre=="" || $idproducto=="" || $cantidad=="" || $fecha==""){
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

		if (mainModel::verificar_datos("[0-9-]{1,20}",$cantidad)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"La cantidad no tiene el formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}
		

		// comprobar producto

		$check_prod = mainModel::ejecutar_consulta_simple("SELECT * FROM productos WHERE producto_id = '".$idproducto."'");
		if ($check_prod->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El producto no existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}else{
			$campos=$check_prod->fetch();
		}

		$Nstock = $campos['producto_stock']-$cantidad;

		if ($Nstock<0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No hay stock suficiente para la venta",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}	

		$Total = $cantidad*$campos['producto_precio'];
		
		$datos_venta_reg=[			
			"Idproducto"=>$idproducto,
			"Cantidad"=> $cantidad,
			"Total"=>$Total,
			"Nombre"=>$nombre,
			"Producto"=>$campos['producto_nombre'],
			"Fecha"=>$fecha	
		];

		$datos_stock_prod=[			
			"Idproducto"=>$idproducto,
			"Stock"=> $Nstock
		];

		$agregar_venta=ventasModelo::agregar_ventas_modelo($datos_venta_reg);

		if ($agregar_venta->rowCount()==1) {

			$agregar_stock=ventasModelo::actualizar_stock_modelo($datos_stock_prod);
			if ($agregar_stock->rowCount()==1) {

				$alerta=[
					"Alerta"=>"limpiar",
					"Titulo"=>"Venta registrada",
					"Texto"=>"Los datos de la venta se han guardado",
					"Tipo"=>"success"
				];

			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido realizar la venta",
					"Tipo"=>"error"
				];
			}


		} else {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se ha podido realizar la venta",
				"Tipo"=>"error"
			];
		}
		
		echo json_encode($alerta);

	}


	//controlador paginar usuarios
	public function paginador_ventas_controlador($pagina,$registros,$url,$busqueda){

		$pagina=mainModel::limpiar_cadena($pagina);
		$registros=mainModel::limpiar_cadena($registros);
		
		$url=mainModel::limpiar_cadena($url);
		$url=SERVERURL.$url."/";
		$busqueda=mainModel::limpiar_cadena($busqueda);

		$tabla="";

		$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
		$inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

		if (isset($busqueda) && $busqueda!="") {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ventas WHERE ((ventas_comprador LIKE '%".$busqueda."%' OR ventas_fecha LIKE '%".$busqueda."%' OR ventas_id LIKE '%".$busqueda."%')) ORDER BY ventas_id DESC LIMIT ".$inicio.",".$registros;
		} else {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ventas ORDER BY ventas_id DESC LIMIT ".$inicio.",".$registros;
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
						<th>COMPRADOR</th>
						<th>ID PRODUCTO</th>
						<th>PRODUCTO</th>
						<th>CANTIDAD</th>
						<th>TOTAL</th>
						<th>FECHA</th>
						<th>VER DETALLES</th>
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
					<td>'.$rows['ventas_id'].'</td>
					<td>'.$rows['ventas_comprador'].'</td>
					<td>'.$rows['ventas_idproducto'].'</td>
					<td>'.$rows['ventas_producto'].'</td>
					<td>'.$rows['ventas_cantidad'].'</td>
					<td>'.$rows['ventas_total'].'</td>
					<td>'.$rows['ventas_fecha'].'</td>
					
					<td>
						<a href="'.SERVERURL.'ventas-update/'.mainModel::encryption($rows['ventas_id']).'/" class="btn btn-success">
								<i class="fas fa-eye"></i>	
						</a>
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
			$tabla.='<p class="text-right">Mostrando ventas '.$reg_inicio.' al '.$reg_final.' de '.$total.'</p>';
		}

		$tabla.='</tbody>
			</table>
		</div>';

		if ($total>=1 && $pagina<=$Npaginas) {
			$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,5);
		}
		

		return $tabla;

	}

	// controlador datos usuario

	public function datos_ventas_controlador($tipo,$id){
		
		$id = mainModel::decryption($id);
		$id=mainModel::limpiar_cadena($id);
		$tipo=mainModel::limpiar_cadena($tipo);

		return ventasModelo::datos_ventas_modelo($tipo,$id);

	}

	// controlador actualizar producto

	

}




