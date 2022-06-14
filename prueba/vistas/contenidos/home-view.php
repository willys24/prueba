
	<!-- Page header -->
	<div class="full-box page-header">
		<h3 class="text-left">
			<i class="fab fa-dashcube fa-fw"></i> &nbsp; DASHBOARD
		</h3>
		
	</div>
	
	<!-- Content -->
	<div class="full-box tile-container">
		
		<?php
		
			require_once "./controladores/productoControlador.php";	
			require_once "./controladores/ventasControlador.php";	

			$ins_usuario = new productoControlador();
			$total_usuarios = $ins_usuario->datos_producto_controlador("Conteo","");

			$ins_venta = new ventasControlador();
			$total_ventas = $ins_venta->datos_ventas_controlador("Conteo","");


		?>

		<a href="<?php echo SERVERURL; ?>producto-list/" class="tile">
			<div class="tile-tittle">Productos</div>
			<div class="tile-icon">
				<i class="fas fa-tags fa-fw"></i>
				<p><?php echo $total_usuarios->rowCount(); ?> Registrados</p>
			</div>
		</a>
		
		<a href="<?php echo SERVERURL; ?>ventas-list/" class="tile">
			<div class="tile-tittle">Ventas</div>
			<div class="tile-icon">
				<i class="fas fa-shopping-cart fa-fw"></i>
				<p><?php echo $total_ventas->rowCount(); ?> Registrada</p>
			</div>
		</a>
	</div>

