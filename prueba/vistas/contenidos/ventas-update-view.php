<!-- Page header -->

	<div class="full-box page-header">
		<h3 class="text-left">
			<i class="fas fa-sync-alt fa-fw"></i> &nbsp; DETALLES DE LA VENTA
		</h3>
		
	</div>

	<div class="container-fluid">
		<ul class="full-box list-unstyled page-nav-tabs">
			<li>
				<a href="<?php echo SERVERURL; ?>ventas-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA VENTA</a>
			</li>
			<li>
				<a class="active" href="<?php echo SERVERURL; ?>ventas-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS</a>
			</li>
			<li>
				<a href="<?php echo SERVERURL; ?>ventas-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VENTAS</a>
			</li>
		</ul>	
	</div>
	
	
	<!-- Content -->
	<div class="container-fluid">
		<?php
		require_once "./controladores/ventasControlador.php";
		$ins_producto = new ventasControlador();
		$datos_producto = $ins_producto->datos_ventas_controlador("",$pagina[1]);
		if ($datos_producto->rowCount()==1) {
			$campos = $datos_producto->fetch();

		?>
			<form action="<?php echo SERVERURL ?>ajax/productoAjax.php" class="form-neon FormularioAjax" method="POST" data-form="update" autocomplete="off">
				<input type="hidden" name="producto_id_up"  value="<?php echo $pagina[1]; ?>">
				<fieldset>
					<legend><i class="far fa-address-card"></i> &nbsp; Información de la venta</legend>
					<div class="container-fluid">
						<div class="row">
							
							
							<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_nombre" class="bmd-label-floating">Nombre Comprador</label>
										<input type="text" disabled="" class="form-control" name="producto_nombre_up" required="" id="producto_nombre" value="<?php echo $campos['ventas_comprador']; ?>" maxlength="100">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Producto</label>
										<input type="text" disabled="" class="form-control" name="producto_referencia_up" value="<?php echo $campos['ventas_producto']; ?>" id="producto_referencia" >
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Cantidad</label>
										<input type="number" class="form-control" name="producto_precio_up" id="producto_precio" value="<?php echo $campos['ventas_cantidad']; ?>" disabled="">
									</div>
								</div>

								
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_apellido" class="bmd-label-floating">Precio</label>
										<input type="text" pattern="[a-zA-Z0-9]{1,50}" class="form-control" disabled="" name="producto_categoria_up" id="producto_categoria" value="<?php echo $campos['ventas_total']/$campos['ventas_cantidad']; ?>" maxlength="100">
									</div>
								</div>

								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Total</label>
										<input type="text" disabled="" class="form-control" name="producto_peso_up" id="producto_peso" value="<?php echo $campos['ventas_total']; ?>" >
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Fecha</label>
										<input type="text" disabled="" class="form-control" name="producto_stock_up" id="producto_stock" value="<?php echo $campos['ventas_fecha']; ?>" >
									</div>
								</div>
						</div>
					</div>
				</fieldset>
				
				
				
			</form>
		<?php
		} else {
			
		?>

			<div class="alert alert-danger text-center" role="alert">
				<p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
				<h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
				<p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
			</div>
		<?php } ?>
	</div>