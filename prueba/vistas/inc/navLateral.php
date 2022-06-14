<section class="full-box nav-lateral">
	<div class="full-box nav-lateral-bg show-nav-lateral"></div>
	<div class="full-box nav-lateral-content">
		<figure class="full-box nav-lateral-avatar">
			<i class="far fa-times-circle show-nav-lateral"></i>
			<img src="<?php echo SERVERURL; ?>vistas/assets/avatar/Avatar.png" class="img-fluid" alt="Avatar">
			<figcaption class="roboto-medium text-center">
				Willy <br><small class="roboto-condensed-light">Web Developer</small>
			</figcaption>
		</figure>
		<div class="full-box nav-lateral-bar"></div>
		<nav class="full-box nav-lateral-menu">
			<ul>
				<li>
					<a href="<?php echo SERVERURL; ?>home/"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Dashboard</a>
				</li>


				<li>
					<a href="#" class="nav-btn-submenu"><i class="fas fa-tags"></i></i> &nbsp; Productos <i class="fas fa-chevron-down"></i></a>
					<ul>
						<li>
							<a href="<?php echo SERVERURL; ?>producto-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo producto</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>producto-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de productos</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>producto-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar productos</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#" class="nav-btn-submenu"><i class="fas fa-shopping-cart"></i></i> &nbsp; Ventas <i class="fas fa-chevron-down"></i></a>
					<ul>
						<li>
							<a href="<?php echo SERVERURL; ?>ventas-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Venta</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>ventas-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Ventas</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>ventas-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Ventas</a>
						</li>
					</ul>
				</li>

				

				
			</ul>
		</nav>
	</div>
</section>