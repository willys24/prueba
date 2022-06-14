<!-- Page header -->

	<div class="full-box page-header">
		<h3 class="text-left">
			<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR PRODUCTO
		</h3>
		
	</div>

	<div class="container-fluid">
		<ul class="full-box list-unstyled page-nav-tabs">
			<li>
				<a href="<?php echo SERVERURL; ?>producto-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRODUCTO</a>
			</li>
			<li>
				<a href="<?php echo SERVERURL; ?>producto-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS</a>
			</li>
			<li>
				<a href="<?php echo SERVERURL; ?>producto-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO</a>
			</li>
		</ul>	
	</div>
	
	
	<!-- Content -->
	<div class="container-fluid">
		<?php
		require_once "./controladores/productoControlador.php";
		$ins_producto = new productoControlador();
		$datos_producto = $ins_producto->datos_producto_controlador("",$pagina[1]);
		if ($datos_producto->rowCount()==1) {
			$campos = $datos_producto->fetch();

		?>
			<form action="<?php echo SERVERURL ?>ajax/productoAjax.php" class="form-neon FormularioAjax" method="POST" data-form="update" autocomplete="off">
				<input type="hidden" name="producto_id_up"  value="<?php echo $pagina[1]; ?>">
				<fieldset>
					<legend><i class="far fa-address-card"></i> &nbsp; Información del producto</legend>
					<div class="container-fluid">
						<div class="row">
							
							
							<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_nombre" class="bmd-label-floating">Nombre</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" name="producto_nombre_up" required="" id="producto_nombre" value="<?php echo $campos['producto_nombre']; ?>" maxlength="100">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Referencia</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" name="producto_referencia_up" value="<?php echo $campos['producto_referencia']; ?>" id="producto_referencia" maxlength="20">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Precio</label>
										<input type="number" pattern="[0-9-]{1,20}" class="form-control" name="producto_precio_up" id="producto_precio" value="<?php echo $campos['producto_precio']; ?>" maxlength="20">
									</div>
								</div>

								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Peso</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" name="producto_peso_up" id="producto_peso" value="<?php echo $campos['producto_peso']; ?>" maxlength="20">
									</div>
								</div>
								
								
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_apellido" class="bmd-label-floating">Categoría</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" name="producto_categoria_up" id="producto_categoria" value="<?php echo $campos['producto_categoria']; ?>" maxlength="100">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Stock</label>
										<input type="number" pattern="[0-9-]{1,20}" class="form-control" name="producto_stock_up" id="producto_stock" value="<?php echo $campos['producto_stock']; ?>" maxlength="20">
									</div>
								</div>
						</div>
					</div>
				</fieldset>
				
				
				<p class="text-center" style="margin-top: 40px;">
					<button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
				</p>
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