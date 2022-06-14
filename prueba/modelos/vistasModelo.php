<?php

class vistasModelo{

	/* modelo para obtener las vistas*/
	protected static function obtener_vistas_modelo($vistas){
		$listaBlanca=["ventas-list","ventas-new","ventas-search","ventas-update","home","producto-list","producto-new","producto-search","producto-update"];
		if (in_array($vistas, $listaBlanca)) {
			if(is_file("./vistas/contenidos/".$vistas."-view.php")){
				$contenido="./vistas/contenidos/".$vistas."-view.php";
			}else{
				$contenido="404";
			}
			
		}elseif ($vistas=="login" || $vistas=="index") {
			$contenido="home";
			
		}else{
			$contenido="404";
		}

		return $contenido;
	}
	
}