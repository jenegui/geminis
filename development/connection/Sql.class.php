<?php
class Sql {
	var $cadenaSql;
	function __construct() {
	}
	function sql($opcion, $parametro) {
		switch ($opcion) {
			
			case 'buscarPagina' :
				$cadena_sql = 'SELECT ';
				$cadena_sql .= 'id_pagina, ';
				$cadena_sql .= 'nombre,';
				$cadena_sql .= 'descripcion,';
				$cadena_sql .= 'modulo,';
				$cadena_sql .= 'nivel,';
				$cadena_sql .= 'parametro';
				$cadena_sql .= 'FROM ';
				$cadena_sql .= $parametro ["prefijo"] . 'pagina';
				$cadena_sql .= 'ORDER BY nombre ASC';
				break;
			
			case 'insertarPagina' :
				$cadena_sql = 'INSERT INTO ';
				$cadena_sql .= $parametro.'pagina ';
				$cadena_sql .= '( ';
				$cadena_sql .= 'nombre,';
				$cadena_sql .= 'descripcion,';
				$cadena_sql .= 'modulo,';
				$cadena_sql .= 'nivel,';
				$cadena_sql .= 'parametro';
				$cadena_sql .= ') ';
				$cadena_sql .= 'VALUES ';
				$cadena_sql .= '( ';
				$cadena_sql .= '\''.$_REQUEST['nombrePagina'].'\', ';
				$cadena_sql .= '\''.$_REQUEST['descripcionPagina'].'\', ';
				$cadena_sql .= '\''.$_REQUEST['moduloPagina'].'\', ';
				$cadena_sql .= $_REQUEST['nivelPagina'].', ';
				$cadena_sql .= '\''.$_REQUEST['parametroPagina'].'\'';
				$cadena_sql .= ') ';
				break;
			
				case 'insertarBloque' :
					$cadena_sql = 'INSERT INTO ';
					$cadena_sql .= $parametro.'bloque ';
					$cadena_sql .= '( ';
					$cadena_sql .= 'nombre,';
					$cadena_sql .= 'descripcion,';
					$cadena_sql .= 'grupo';
					$cadena_sql .= ') ';
					$cadena_sql .= 'VALUES ';
					$cadena_sql .= '( ';
					$cadena_sql .= '\''.$_REQUEST['nombreBloque'].'\', ';
					$cadena_sql .= '\''.$_REQUEST['descripcionBloque'].'\', ';
					$cadena_sql .= '\''.$_REQUEST['grupoBloque'].'\'';
					$cadena_sql .= ') ';
					break;
		}
		
		return $cadena_sql;
	}
	function getCadenaSql($opcion, $parametros) {
		
		
		$this->cadenaSql= $this->sql($opcion, $parametros);
		return $this->cadenaSql;
	}
}
?>
