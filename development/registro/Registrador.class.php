<?php
require_once ('configDesenlace.class.php');
require_once ("../connection/FabricaDbConexion.class.php");
require_once ('DatoConexion.php');
class RegistradorElemento {
	var $miSql;
	var $miConfigurador;
	var $misDatosConexion;
	var $miFabricaConexiones;
	function __construct() {
		$this->miSql = new Sql ();
		$this->miConfigurador = ConfiguracionDesenlace::singleton ();
		$this->miConfigurador->variable ();
		
		$this->misDatosConexion = new DatoConexion ();
		$this->misDatosConexion->setDatosConexion ( $this->miConfigurador->getConf () );
		
		$this->miFabricaConexiones = new FabricaDbConexion ();
		
		$this->miFabricaConexiones->setRecursoDB ( "principal", $this->misDatosConexion );
	}
	function formRegistrarPagina() {
		$cadena_html = "<div id='registrarPagina' class='marcoFormulario'>";
		$cadena_html .= "<form method='post'>";
		$cadena_html .= "<label for='nombrePagina' >Nombre de la página:</label>";
		$cadena_html .= "<input type='text' name='nombrePagina' id='nombrePagina' /><br>";
		$cadena_html .= "<label for='descripcionPagina'>Descripción:</label>";
		$cadena_html .= "<textarea rows='4' cols='50'name='descripcionPagina' id='descripcionPagina'></textarea><br>";
		$cadena_html .= "<label for='moduloPagina'>Módulo al que pertenece:</label>";
		$cadena_html .= "<input type='text' name='moduloPagina' id='moduloPagina' />";
		$cadena_html .= "<label for='nivelPagina'>Nivel de acceso:</label>";
		$cadena_html .= "<input type='text' name='nivelPagina' id='nivelPagina' />";
		$cadena_html .= "<label for='parametroPagina'>Parámetros predeterminados:</label>";
		$cadena_html .= "<input type='text' name='parametroPagina' id='parametroPagina' />";
		$cadena_html .= "<div class='marcoBoton'>";
		$cadena_html .= "<button type='submit'>Guardar</button>";
		$cadena_html .= "<input type='hidden' name='action' id='action' value='pagina'>";
		$cadena_html .= "</div>";
		$cadena_html .= "</form>";
		$cadena_html .= "</div>";
		
		return $cadena_html;
	}
	function formRegistrarBloque() {
		$cadena_html = "<div id='registrarBloque'  class='marcoFormulario'>";
		$cadena_html .= "<form  method='post'>";
		$cadena_html .= "<label for='nombreBloque' >Nombre del Bloque:</label>";
		$cadena_html .= "<input type='text' name='nombreBloque' id='nombreBloque' /><br>";
		$cadena_html .= "<label for='descripcionBloque'>Descripción:</label>";
		$cadena_html .= "<textarea rows='4' cols='50'name='descripcionBloque' id='descripcionBloque'></textarea><br>";
		$cadena_html .= "<label for='grupoBloque'>Grupo del Bloque:</label>";
		$cadena_html .= "<input type='text' name='grupoBloque' id='grupoBloque' />";
		$cadena_html .= "<div class='marcoBoton'>";
		$cadena_html .= "<button type='submit'>Guardar</button>";
		$cadena_html .= "<input type='hidden' name='action' id='action' value='bloque'>";
		$cadena_html .= "</div>";
		$cadena_html .= "</form>";
		$cadena_html .= "</div>";
		
		return $cadena_html;
	}
	function formAsociarBloque() {
		$cadena_html = "<div id='seleccionarPagina' class='marcoDisenno'>";
		
		$cadena_html .= "</div>";
		
		$cadena_html .= "<div id='disennarPagina' class='marcoDisenno'>";
		$cadena_html .= "<form  method='post'>";
		$cadena_html .= "<div class='seccionA'>";
		$cadena_html .= "<input class='seccion' type='text' name='seccionA' id='seccionA' />";
		$cadena_html .= "</div>";
		$cadena_html .= "<div class='seccionB'>";
		$cadena_html .= "<input class='seccion' type='text' name='seccionB' id='seccionB' />";
		$cadena_html .= "</div>";
		$cadena_html .= "<div class='seccionC'>";
		$cadena_html .= "<input class='seccion' type='text' name='seccionC' id='seccionC' />";
		$cadena_html .= "</div>";
		$cadena_html .= "<div class='seccionD'>";
		$cadena_html .= "<input class='seccion' type='text' name='seccionD' id='seccionD' />";
		$cadena_html .= "</div>";
		$cadena_html .= "<div class='seccionE'>";
		$cadena_html .= "<input class='seccion' type='text' name='seccionE' id='seccionE' />";
		$cadena_html .= "<input type='hidden' name='action' id='action' value='disenno'>";
		$cadena_html .= "</div>";
		$cadena_html .= "</form>";
		$cadena_html .= "</div>";
		
		return $cadena_html;
	}
	function formSeleccionarAccion() {
		$cadena_html = "<div class='marcoBoton'>";
		$cadena_html .= "<form  method='post'>";
		$cadena_html .= "<select id='seleccionador'>";
		$cadena_html .= "<option>Seleccionar actividad...</option>";
		$cadena_html .= "<option value='pagina'>Registrar Página</option>";
		$cadena_html .= "<option value='bloque'>Registrar Bloque</option>";
		$cadena_html .= "<option value='disennarPagina'>Diseñar Página</option>";
		$cadena_html .= "</select>";
		$cadena_html .= "<input type='hidden' name='action' id='action' value='true'>";
		$cadena_html .= "</form>";
		$cadena_html .= "</div>";
		
		return $cadena_html;
	}
	function procesarFormulario($opcion) {
		$conexion = $this->miFabricaConexiones->getRecursoDB ( 'principal' );
		
		if (! $conexion) {
			error_log ( "No se conectó" );
			return false;
		}
		
		switch ($opcion) {
			
			case 'pagina' :
				$cadenaSql = $this->miFabricaConexiones->getCadenaSql ( "insertarPagina", $this->misDatosConexion->getPrefijo () );
				$conexion->ejecutarAcceso ( $cadenaSql, "insertar" );
				break;
			
			case 'bloque' :
				$cadenaSql = $this->miFabricaConexiones->getCadenaSql ( "insertarBloque", $this->misDatosConexion->getPrefijo () );
				$conexion->ejecutarAcceso ( $cadenaSql, "insertar" );
				break;
		}
	}
	function buscarDatos() {
	}
}

?>