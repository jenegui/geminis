<?php
include_once ($this->miConfigurador->getVariableConfiguracion ( "raizDocumento" ) . "/core/connection/Sql.class.php");

class BuilderSql extends Sql {

	var $cadenaSql;

	var $miConfigurador;

	private static $instance;

	function __construct() {

		$this->miConfigurador = Configurador::singleton ();
		return 0;
	
	}

	public static function singleton() {

		if (! isset ( self::$instance )) {
			$className = __CLASS__;
			self::$instance = new $className ();
		}
		return self::$instance;
	
	}

	function cadenaSql($indice, $parametro = "") {

		$this->clausula ( $indice, $parametro );
		if (isset ( $this->cadena_sql [$indice] )) {
			return $this->cadena_sql [$indice];
		}
		return false;
	
	}

	private function clausula($indice, $parametro) {

		$prefijo = $this->miConfigurador->getVariableConfiguracion ( "prefijo" );
		
		switch ($indice) {
			
			case "usuario" :
				$cadenaSql = "SELECT  ";
				$cadenaSql .= "usuario, ";
				$cadenaSql .= "estilo ";
				$cadenaSql .= "FROM ";
				$cadenaSql .= $prefijo . "estilo ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= "usuario='" . $this->id_usuario . "'";
				
				break;
			
			case "pagina" :
				$cadenaSql = "SELECT  ";
				$cadenaSql .= $prefijo . "bloque_pagina.*,";
				$cadenaSql .= $prefijo . "bloque.nombre, ";
				$cadenaSql .= $prefijo . "pagina.parametro ";
				$cadenaSql .= "FROM ";
				$cadenaSql .= $prefijo . "pagina, ";
				$cadenaSql .= $prefijo . "bloque_pagina, ";
				$cadenaSql .= $prefijo . "bloque ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= $prefijo . "pagina.nombre='" . $parametro . "' ";
				$cadenaSql .= "AND ";
				$cadenaSql .= $prefijo . "bloque_pagina.id_bloque=" . $prefijo . "bloque.id_bloque ";
				$cadenaSql .= "AND ";
				$cadenaSql .= $prefijo . "bloque_pagina.id_pagina=" . $prefijo . "pagina.id_pagina";
				break;
			
			case "bloquesPagina" :
				
				$cadenaSql = "SELECT  ";
				$cadenaSql .= $prefijo . "bloque_pagina.*,";
				$cadenaSql .= $prefijo . "bloque.nombre ,";
				$cadenaSql .= $prefijo . "pagina.parametro, ";
				$cadenaSql .= $prefijo . "bloque.grupo ";
				$cadenaSql .= "FROM ";
				$cadenaSql .= $prefijo . "pagina, ";
				$cadenaSql .= $prefijo . "bloque_pagina, ";
				$cadenaSql .= $prefijo . "bloque ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= $prefijo . "pagina.nombre='" . $parametro . "' ";
				$cadenaSql .= "AND ";
				$cadenaSql .= $prefijo . "bloque_pagina.id_bloque=" . $prefijo . "bloque.id_bloque ";
				$cadenaSql .= "AND ";
				$cadenaSql .= $prefijo . "bloque_pagina.id_pagina=" . $prefijo . "pagina.id_pagina ";
				$cadenaSql .= "ORDER BY " . $prefijo . "bloque_pagina.seccion," . $prefijo . "bloque_pagina.posicion ";
				break;
		}
		if (isset ( $cadenaSql )) {
			$this->cadena_sql [$indice] = $cadenaSql;
		}
	
	}

}

?>