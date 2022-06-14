<?php

if ($peticionAjax) {
	require_once "../config/server.php";
}else{
	require_once "./config/server.php";
}

//LOS MODELOS SON PROTEGIDOS

class mainModel{

	/* funcion para conectar a la bd */

	protected static function conectar(){
		$conexion = new PDO(SGBD, USER, PASS);
		$conexion->exec('SET CHARACTER SET utf8');

		return $conexion;
	}

	/* funcion para consultas simples */

	protected static function ejecutar_consulta_simple($consulta){
		$sql = self::conectar()->prepare($consulta);
		$sql->execute();
		return $sql;
	}

/* encriptar y desencriptar */
	public function encryption($string){
		$output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRETID), 0, 16);
		$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
		$output=base64_encode($output);
		return $output;
	}

	public function decryption($string){
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRETID), 0, 16);
		$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
		return $output;
	}

	/* funcion para generar codigos random */

	protected static function generar_codigo_aleatorio($letra,$longitud,$numero){
		for ($i=1; $i <= $longitud; $i++) { 
			$aleatorio = rand(0,9);
			$letra.=$aleatorio;
		}
		return $letra."-".$numero;
	}

	/* funcion para limpiar cadenas */
	protected static function limpiar_cadena($cadena){
		
		$cadena = str_replace("<script>", "", $cadena);
		$cadena = str_replace("</script>", "", $cadena);
		$cadena = str_replace("<script src", "", $cadena);
		$cadena = str_replace("<script type=", "", $cadena);
		$cadena = str_replace("SELECT * FROM", "", $cadena);
		$cadena = str_replace("DELETE FROM", "", $cadena);
		$cadena = str_replace("INSERT INTO", "", $cadena);
		$cadena = str_replace("UPDATE SET", "", $cadena);
		$cadena = str_replace("DROP TABLE", "", $cadena);
		$cadena = str_replace("DROP DATABASE", "", $cadena);
		$cadena = str_replace("TRUNCATE TABLE", "", $cadena);
		$cadena = str_replace("SHOW TABLES", "", $cadena);
		$cadena = str_replace("SHOW DATABASE", "", $cadena);
		$cadena = str_replace("<?php", "", $cadena);
		$cadena = str_replace("?>", "", $cadena);
		$cadena = str_replace("--", "", $cadena);
		$cadena = str_replace(">", "", $cadena);
		$cadena = str_replace("<", "", $cadena);
		$cadena = str_replace("[", "", $cadena);
		$cadena = str_replace("]", "", $cadena);
		$cadena = str_replace("^", "", $cadena);
		$cadena = str_replace("==", "", $cadena);
		$cadena = str_replace(";", "", $cadena);
		$cadena = str_replace("::", "", $cadena);
		$cadena = stripslashes($cadena);
		$cadena = trim($cadena);

		return $cadena;

	}


	/* funcion para verificar datos */

	protected static function verificar_datos($filtro,$cadena){
		if(preg_match("/^".$filtro."$/", $cadena)){
			return false;
		}else{
			return true;
		}
	}

	/* funcion para verificar fechas*/


	/* funcion paginador de tablas */

	protected static function paginador_tablas($pagina,$npaginas,$url,$botones){
		$tabla='<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

		if ($pagina==1) {
			$tabla.='<li class="page-item disabled"><a class="page-link"><i class="fas fa-angle-double-left"></i></a></li>';
		}else{
			$tabla.='<li class="page-item"><a class="page-link" href="'.$url.'1/"><i class="fas fa-angle-double-left"></i></a></li>
			<li class="page-item"><a class="page-link" href="'.$url.($pagina-1).'/">Anterior</a></li>';
		}

		$ci=0;

		for ($i=$pagina; $i <=$npaginas; $i++) { 
			if ($ci>=$botones) {
				break;
			}

			if ($pagina==$i) {
				$tabla.='<li class="page-item"><a class="page-link active" href="'.$url.$i.'/">'.$i.'</a></li>';
			}else{
				$tabla.='<li class="page-item"><a class="page-link" href="'.$url.$i.'/">'.$i.'</a></li>';
			}

			$ci++;
		}

		if ($pagina==$npaginas) {
			$tabla.='<li class="page-item disabled"><a class="page-link"><i class="fas fa-angle-double-right"></i></a></li>';
		}else{
			$tabla.='<li class="page-item"><a class="page-link" href="'.$url.($pagina+1).'/">Siguiente</a></li>
			<li class="page-item"><a class="page-link" href="'.$url.$npaginas.'/"><i class="fas fa-angle-double-right"></i></a></li>';
		}

		$tabla.='</ul></nav>';
		return $tabla;
	}
}