<!-- Page header -->

	<div class="full-box page-header">
		<h3 class="text-left">
			<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VENTAS
		</h3>
		<p class="text-justify">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
		</p>
	</div>
	
	<div class="container-fluid">
		<ul class="full-box list-unstyled page-nav-tabs">
			<li>
				<a href="<?php echo SERVERURL; ?>ventas-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA VENTA</a>
			</li>
			<li>
				<a  href="<?php echo SERVERURL; ?>ventas-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS</a>
			</li>
			<li>
				<a class="active" href="<?php echo SERVERURL; ?>ventas-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VENTAS</a>
			</li>
		</ul>	
	</div>
	<?php
	
	if (!isset($_SESSION['busqueda_ventas']) && empty($_SESSION['busqueda_ventas'])) {
		# code...
	
	?>
	<!-- Content -->
	<div class="container-fluid">
		<form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
			<input type="hidden" name="modulo" value="ventas">
			<div class="container-fluid">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="inputSearch" class="bmd-label-floating">¿Qué venta estas buscando?</label>
							<input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30">
						</div>
					</div>
					<div class="col-12">
						<p class="text-center" style="margin-top: 40px;">
							<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
						</p>
					</div>
				</div>
			</div>
		</form>
	</div>

	<?php
	} else {
		# code...		
	?>
	
	<div class="container-fluid">
		<form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
			<input type="hidden" name="modulo" value="producto">
			<input type="hidden" name="eliminar_busqueda" value="eliminar">
			<div class="container-fluid">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-6">
						<p class="text-center" style="font-size: 20px;">
							Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_ventas']; ?>”</strong>
						</p>
					</div>
					<div class="col-12">
						<p class="text-center" style="margin-top: 20px;">
							<button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
						</p>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="container-fluid">
		<?php
			require_once "./controladores/ventasControlador.php";
			$ins_usuario = new ventasControlador();

			echo $ins_usuario->paginador_ventas_controlador($pagina[1],15,$pagina[0],$_SESSION['busqueda_ventas']);
		?>	
	</div>
	<?php } ?>