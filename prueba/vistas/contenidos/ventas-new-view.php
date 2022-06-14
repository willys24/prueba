<!-- Page header -->

			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA VENTA
				</h3>
				<p class="text-justify">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
				</p>
			</div>
			
			<div class="container-fluid">
			<ul class="full-box list-unstyled page-nav-tabs">
				<li>
					<a class="active" href="<?php echo SERVERURL; ?>ventas-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA VENTA</a>
				</li>
				<li>
					<a  href="<?php echo SERVERURL; ?>ventas-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS</a>
				</li>
				<li>
					<a href="<?php echo SERVERURL; ?>ventas-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VENTAS</a>
				</li>
			</ul>	
		</div>
			<?php
			require_once "./controladores/productoControlador.php";
			$ins_producto = new productoControlador();
			$datos_producto = $ins_producto->datos_producto_controlador("Conteo","");
			$datos = $datos_producto->fetchAll();
			?>
			<!-- Content -->
			<div class="container-fluid">
				<form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/ventasAjax.php" method="POST" data-form="save" autocomplete="off">
					<input type="hidden" name="ventas_fecha_reg" value="<?php echo date("c"); ?>">
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Información de la venta</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_nombre" class="bmd-label-floating">Nombre Comprador</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" name="ventas_nombre_reg" required="" id="ventas_nombre" maxlength="100">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Producto</label>
										<select class="form-control" name="ventas_producto_reg" required="">
										<?php
										foreach ($datos as $rows) {
										?>
											<option value="<?php echo mainModel::encryption($rows['producto_id']); ?>"><?php echo $rows['producto_nombre']; ?></option>
										 <?php } ?>
										</select>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="usuario_dni" class="bmd-label-floating">Cantidad</label>
										<input type="number" pattern="[0-9-]{1,20}" class="form-control" min="1" name="ventas_cantidad_reg" id="venta_cantidad">
									</div>
								</div>

								
							</div>
						</div>
					</fieldset>
					
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
			</div>