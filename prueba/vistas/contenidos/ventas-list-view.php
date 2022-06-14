<!-- Page header -->

	<div class="full-box page-header">
		<h3 class="text-left">
			<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS
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
			$ins_usuario = new ventasControlador();

			echo $ins_usuario->paginador_ventas_controlador($pagina[1],15,$pagina[0],"");
		?>			
					
		
	</div>
