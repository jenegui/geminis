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
				$cadena = "SELECT  ";
				$cadena .= "usuario, ";
				$cadena .= "estilo ";
				$cadena .= "FROM ";
				$cadena .= $prefijo . "estilo ";
				$cadena .= "WHERE ";
				$cadena .= "usuario='" . $this->id_usuario . "'";
				
				break;
			
			case "pagina" :
				$cadena = "SELECT  ";
				$cadena .= $prefijo . "bloque_pagina.*,";
				$cadena .= $prefijo . "bloque.nombre, ";
				$cadena .= $prefijo . "pagina.parametro ";
				$cadena .= "FROM ";
				$cadena .= $prefijo . "pagina, ";
				$cadena .= $prefijo . "bloque_pagina, ";
				$cadena .= $prefijo . "bloque ";
				$cadena .= "WHERE ";
				$cadena .= $prefijo . "pagina.nombre='" . $parametro . "' ";
				$cadena .= "AND ";
				$cadena .= $prefijo . "bloque_pagina.id_bloque=" . $prefijo . "bloque.id_bloque ";
				$cadena .= "AND ";
				$cadena .= $prefijo . "bloque_pagina.id_pagina=" . $prefijo . "pagina.id_pagina";
				break;
			
			case "bloquesPagina" :
				
				$cadena = "SELECT  ";
				$cadena .= $prefijo . "bloque_pagina.*,";
				$cadena .= $prefijo . "bloque.nombre ,";
				$cadena .= $prefijo . "pagina.parametro, ";
				$cadena .= $prefijo . "bloque.grupo ";
				$cadena .= "FROM ";
				$cadena .= $prefijo . "pagina, ";
				$cadena .= $prefijo . "bloque_pagina, ";
				$cadena .= $prefijo . "bloque ";
				$cadena .= "WHERE ";
				$cadena .= $prefijo . "pagina.nombre='" . $parametro . "' ";
				$cadena .= "AND ";
				$cadena .= $prefijo . "bloque_pagina.id_bloque=" . $prefijo . "bloque.id_bloque ";
				$cadena .= "AND ";
				$cadena .= $prefijo . "bloque_pagina.id_pagina=" . $prefijo . "pagina.id_pagina ";
				$cadena .= "ORDER BY " . $prefijo . "bloque_pagina.seccion," . $prefijo . "bloque_pagina.posicion ";
				break;
		}
		if (isset ( $cadena )) {
			$this->cadena_sql [$indice] = $cadena;
		}
	
	}

}

?>