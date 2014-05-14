<?php

class Sql {

	var $cadenaSql;

	function __construct() {

	
	}

	function sql($opcion, $parametro) {

		switch ($opcion) {
			
			case 'buscarPagina' :
				$cadena = 'SELECT ';
				$cadena .= 'id_pagina, ';
				$cadena .= 'nombre,';
				$cadena .= 'descripcion,';
				$cadena .= 'modulo,';
				$cadena .= 'nivel,';
				$cadena .= 'parametro';
				$cadena .= 'FROM ';
				$cadena .= $parametro ["prefijo"] . 'pagina';
				$cadena .= 'ORDER BY nombre ASC';
				break;
			
			case 'insertarPagina' :
				$cadena = 'INSERT INTO ';
				$cadena .= $parametro . 'pagina ';
				$cadena .= '( ';
				$cadena .= 'nombre,';
				$cadena .= 'descripcion,';
				$cadena .= 'modulo,';
				$cadena .= 'nivel,';
				$cadena .= 'parametro';
				$cadena .= ') ';
				$cadena .= 'VALUES ';
				$cadena .= '( ';
				$cadena .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
				$cadena .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
				$cadena .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
				$cadena .= $_REQUEST ['nivelPagina'] . ', ';
				$cadena .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
				$cadena .= ') ';
				break;
			
			case 'insertarBloque' :
				$cadena = 'INSERT INTO ';
				$cadena .= $parametro . 'bloque ';
				$cadena .= '( ';
				$cadena .= 'nombre,';
				$cadena .= 'descripcion,';
				$cadena .= 'grupo';
				$cadena .= ') ';
				$cadena .= 'VALUES ';
				$cadena .= '( ';
				$cadena .= '\'' . $_REQUEST ['nombreBloque'] . '\', ';
				$cadena .= '\'' . $_REQUEST ['descripcionBloque'] . '\', ';
				$cadena .= '\'' . $_REQUEST ['grupoBloque'] . '\'';
				$cadena .= ') ';
				break;
		}
		
		return $cadena;
	
	}

	function getCadenaSql($opcion, $parametros) {

		$this->cadenaSql = $this->sql ( $opcion, $parametros );
		return $this->cadenaSql;
	
	}

}
?>
