<!-- Page header -->

			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRODUCTO
				</h3>
				
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a class="active" href="<?php echo SERVERURL; ?>producto-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRODUCTO</a>
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
				<form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/productoAjax.php" method="POST" data-form="save" autocomplete="off">
					<input type="hidden" name="producto_fecha_reg" value="<?php echo date("c"); ?>">
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Información del producto</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="producto_nombre" class="bmd-label-floating">Nombre</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" name="producto_nombre_reg" required="" id="producto_nombre" maxlength="100">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="producto_referencia" class="bmd-label-floating">Referencia</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" name="producto_referencia_reg" id="producto_referencia" required="" maxlength="20">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="producto_precio" class="bmd-label-floating">Precio</label>
										<input type="number" pattern="[0-9-]{1,20}" class="form-control" required="" name="producto_precio_reg" id="producto_precio" maxlength="20">
									</div>
								</div>

								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="producto_peso" class="bmd-label-floating">Peso</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" required="" name="producto_peso_reg" id="producto_peso" maxlength="20">
									</div>
								</div>
								
								
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="producto_categoria" class="bmd-label-floating">Categoría</label>
										<input type="text" pattern="[a-zA-Z0-9 ]{1,50}" class="form-control" name="producto_categoria_reg" id="producto_categoria" required="" maxlength="100">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="producto_stock" class="bmd-label-floating">Stock</label>
										<input type="number" required="" pattern="[0-9-]{1,20}" class="form-control" name="producto_stock_reg" id="producto_stock" maxlength="20">
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