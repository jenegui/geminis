<?php

class Sql {

	var $cadenaSql;

	function __construct() {

	
	}

	function sql($opcion, $parametro) {

		switch ($opcion) {
			
			case 'buscarPagina' :
				$cadenaSql = 'SELECT ';
				$cadenaSql .= 'id_pagina, ';
				$cadenaSql .= 'nombre,';
				$cadenaSql .= 'descripcion,';
				$cadenaSql .= 'modulo,';
				$cadenaSql .= 'nivel,';
				$cadenaSql .= 'parametro';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= $parametro ["prefijo"] . 'pagina';
				$cadenaSql .= 'ORDER BY nombre ASC';
				break;
			
			case 'insertarPagina' :
				$cadenaSql = 'INSERT INTO ';
				$cadenaSql .= $parametro . 'pagina ';
				$cadenaSql .= '( ';
				$cadenaSql .= 'nombre,';
				$cadenaSql .= 'descripcion,';
				$cadenaSql .= 'modulo,';
				$cadenaSql .= 'nivel,';
				$cadenaSql .= 'parametro';
				$cadenaSql .= ') ';
				$cadenaSql .= 'VALUES ';
				$cadenaSql .= '( ';
				$cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
				$cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
				$cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
				$cadenaSql .= ') ';
				break;
			
			case 'insertarBloque' :
				$cadenaSql = 'INSERT INTO ';
				$cadenaSql .= $parametro . 'bloque ';
				$cadenaSql .= '( ';
				$cadenaSql .= 'nombre,';
				$cadenaSql .= 'descripcion,';
				$cadenaSql .= 'grupo';
				$cadenaSql .= ') ';
				$cadenaSql .= 'VALUES ';
				$cadenaSql .= '( ';
				$cadenaSql .= '\'' . $_REQUEST ['nombreBloque'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['descripcionBloque'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['grupoBloque'] . '\'';
				$cadenaSql .= ') ';
				break;
		}
		
		return $cadenaSql;
	
	}

	function getCadenaSql($opcion, $parametros) {

		$this->cadenaSql = $this->sql ( $opcion, $parametros );
		return $this->cadenaSql;
	
	}

}
?>
