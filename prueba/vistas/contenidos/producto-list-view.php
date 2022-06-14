<!-- Page header -->

	<div class="full-box page-header">
		<h3 class="text-left">
			<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS
		</h3>
		
	</div>
	
	<div class="container-fluid">
		<ul class="full-box list-unstyled page-nav-tabs">
			<li>
				<a href="<?php echo SERVERURL; ?>producto-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRODUCTO</a>
			</li>
			<li>
				<a class="active" href="<?php echo SERVERURL; ?>producto-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS</a>
			</li>
			<li>
				<a href="<?php echo SERVERURL; ?>producto-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO</a>
			</li>
		</ul>	
	</div>
	
	<!-- Content -->
	<div class="container-fluid">

		<form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
			<input type="hidden" name="modulo" value="productos">
			<div class="row">
				<div class="col-12 col-md-2">
					<div class="form-group">
						<label  class="bmd-label-floating">Ordenar por</label>
						<select class="form-control" name="ordenar_prod" required="">
							<option selected="" disabled="">Seleccione </option>
							<option value="sell">Más vendidos</option>
							<option value="stock">Más stock</option>
						</select>
					</div>
				</div>

				<div class="col-12 col-md-2">
					<div class="form-group">					
						<button type="submit" class="btn btn-raised btn-primary">Ordenar</button>
					</div>
				</div>
			</div>
		</form>
		
		<?php

			require_once "./controladores/productoControlador.php";
			$ins_usuario = new productoControlador();
			if (isset($_SESSION['ordenar'])) {
				$tipob = $_SESSION['ordenar'];
			}else{
				$tipob = "";
			}
			echo $ins_usuario->paginador_producto_controlador($pagina[1],15,$pagina[0],"",$tipob);
		?>			
					
		
	</div>
