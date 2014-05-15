<?php
include_once ("HtmlBase.class.php");
include_once ("core/manager/Configurador.class.php");

/**
 * Contiene las definiciones de los diferentes controles HTML
 *
 * @author Paulo Cesar Coronado
 * @version 1.0.0.0, 29/12/2011
 * @package framework:BCK:estandar
 * @copyright Universidad Distrital F.J.C
 * @license GPL Version 3.0 o posterior
 *         
 */
class WidgetHtml extends HtmlBase {

	
	// ================================== Funciones Cuadro Lista ==================================
	
	/**
	 *
	 * @name cuadro_lista
	 * @param string $cuadroSql
	 *        	Clausula SQL desde donde se extraen los valores de la lista
	 * @param string $nombre
	 *        	Nombre del control que se va a crear
	 * @param string $configuracion        	
	 * @param int $seleccion
	 *        	id (o nombre??) del elemento seleccionado en la lista
	 * @param int $evento
	 *        	Evento javascript que desencadena el control
	 * @return void
	 * @access public
	 */
	function __construct() {

		$this->miConfigurador = Configurador::singleton ();
	
	}
	
	function cuadro_texto($misAtributos) {
		
		$this->setAtributos($misAtributos);

		if (! isset ( $this->atributos ["tipo"] ) || $this->atributos ["tipo"] != 'hidden') {
			
			$this->mi_cuadro='<input ';
			
			$this->mi_cuadro.=$this->atributoClassCuadroTexto();
			
			$this->mi_cuadro.=$this->atributosGeneralesCuadroTexto();
			
			if (!isset ( $this->atributos ["maximoTamanno"] )) {
				$this->atributos ["maximoTamanno"]=100;
			}
				
			$cadena .= "maxlength='" . $this->atributos ["maximoTamanno"] . "' ";
			
			// Si se utiliza ketchup
			if (isset ( $this->atributos ["data-validate"] )) {
				$cadena .= "data-validate='validate(" . $this->atributos ["data-validate"] . ")' ";
			}
				
			// Si utiliza algun evento especial
			if (isset ( $this->atributos ["evento"] )) {
				$cadena .= " " . $this->atributos ["evento"] . " ";
			}
			
			
			$this->mi_cuadro .= "tabindex='" . $this->atributos ["tabIndex"] . "' ";
			$this->mi_cuadro .= ">\n";
		} else {
			
			$this->mi_cuadro = "<input type='hidden' ";
			$this->mi_cuadro .= "name='" . $this->atributos ["id"] . "' ";
			$this->mi_cuadro .= "id='" . $this->atributos ["id"] . "' ";
			if (isset ( $this->atributos ["valor"] )) {
				$this->mi_cuadro .= "value='" . $this->atributos ["valor"] . "' ";
			}
			$this->mi_cuadro .= ">\n";
		}
		return $this->mi_cuadro;
	
	}
	
	
	function atributosGeneralesCuadroTexto(){
		
		$cadena='';
		
		if (!isset ( $this->atributos ["tipo"] ) ) {
			$this->atributos ["tipo"] = "text";
		} 
		
		$cadena .= "type='" . $this->atributos ["tipo"] . "' ";
			
		if (isset ( $this->atributos ["titulo"] ) && $this->atributos ["titulo"] != "") {
			$cadena .= "title='" . $this->atributos ["titulo"] . "' ";
		}
			
		if (isset ( $this->atributos ["deshabilitado"] ) && $this->atributos ["deshabilitado"] == true) {
			$cadena .= "readonly='readonly' ";
		}
			
		if (isset ( $this->atributos ["name"] ) && $this->atributos ["name"] != "") {
			$cadena .= "name='" . $this->atributos ["name"] . "' ";
		} else {
			$cadena .= "name='" . $this->atributos ["id"] . "' ";
		}
			
		$cadena .= "id='" . $this->atributos ["id"] . "' ";
			
		if (isset ( $this->atributos ["valor"] )) {
			$cadena .= "value='" . $this->atributos ["valor"] . "' ";
		}
			
		if (isset ( $this->atributos ["tamanno"] )) {
			$cadena .= "size='" . $this->atributos ["tamanno"] . "' ";
		} else {
			$cadena .= "size='50' ";
		}
			

		
		return $cadena;
	}
	
	function atributoClassCuadroTexto(){
		
		$cadena="class='";
		// --------------Atributo class --------------------------------
		if (isset ( $this->atributos ["estilo"] ) && $this->atributos ["estilo"] != "") {			
			
			if ($this->atributos ["estilo"] == "jqueryui") {
				$cadena .= "ui-widget ui-widget-content ui-corner-all ";
			} else {
				$cadena.= $this->atributos ["estilo"] . " ";
			}
		} else {
			$cadena .= "cuadroTexto ";
		}
			
		// Si se utiliza jQuery-Validation-Engine
		if (isset ( $this->atributos ["validar"] )) {
			$cadena .= " validate[" . $this->atributos ["validar"] . "] ";
			// Si se utiliza jQuery-Validation-Engine
			if (isset ( $this->atributos ["categoria"] ) && $this->atributos ["categoria"] = "fecha") {
				$cadena .= "datepicker ";
			}
		}
			
		$cadena .= "' ";
		
		// ----------- Fin del atributo class ----------------------------
		
		return $cadena;
		
		
	}

	function area_texto($datosConfiguracion, $misAtributos) {
		
		$this->setAtributos($misAtributos);

		$this->mi_cuadro = "<textarea ";
		
		$this->mi_cuadro .= "id='" . $this->atributos ["id"] . "' ";
		
		$this->mi_cuadro.=$this->atributosGeneralesAreaTexto();
		
		if (isset ( $this->atributos ["estiloArea"] ) && $this->atributos ["estiloArea"] != "") {
			$this->mi_cuadro .= "class='" . $this->atributos ["estiloArea"] . "' ";
		} else {
			$this->mi_cuadro .= "class='areaTexto' ";
		}
		
		$this->mi_cuadro .= "tabindex='" . $this->atributos ["tabIndex"] . "' ";
		$this->mi_cuadro .= ">\n";
		if (isset ( $this->atributos ["valor"] )) {
			$this->mi_cuadro .= $this->atributos ["valor"];
		} else {
			$this->mi_cuadro .= "";
		}
		$this->mi_cuadro .= "</textarea>\n";
		
		if (isset ( $this->atributos ["textoEnriquecido"] ) && $this->atributos ["textoEnriquecido"] == true) {
			$this->mi_cuadro .= "<script type=\"text/javascript\">\n";
			$this->mi_cuadro .= "mis_botones='" . $datosConfiguracion ["host"] . $datosConfiguracion ["site"] . $datosConfiguracion ["grafico"] . "/textarea/';\n";
			$this->mi_cuadro .= "archivo_css='" . $datosConfiguracion ["host"] . $datosConfiguracion ["site"] . $datosConfiguracion ["estilo"] . "/basico/estilo.php';\n";
			$this->mi_cuadro .= "editor_html('" . $this->atributos ["id"] . "', 'bold italic underline | left center right | number bullet | wikilink');";
			$this->mi_cuadro .= "\n</script>";
		}
		
		return $this->mi_cuadro;
	
	}
	
	function atributosGeneralesAreaTexto(){
		$cadena='';
		
		if (isset ( $this->atributos ["deshabilitado"] ) && $this->atributos ["deshabilitado"] == true) {
			$cadena .= "readonly='1' ";
		}
		
		if (isset ( $this->atributos ["name"] ) && $this->atributos ["name"] != "") {
			$cadena .= "name='" . $this->atributos ["name"] . "' ";
		} else {
			$cadena .= "name='" . $this->atributos ["id"] . "' ";
		}
		
		if (isset ( $this->atributos ["columnas"] )) {
			$cadena .= "cols='" . $this->atributos ["columnas"] . "' ";
		} else {
			$cadena .= "cols='50' ";
		}
		
		if (isset ( $this->atributos ["filas"] )) {
			$cadena .= "rows='" . $this->atributos ["filas"] . "' ";
		} else {
			$cadena .= "rows='2' ";
		}
		
		
		return $cadena;
	}

	function etiqueta($misAtributos) {
		
		$this->setAtributos($misAtributos);

		$this->mi_etiqueta = "";
		
		if (! isset ( $this->atributos ["sinDivision"] )) {
			if (isset ( $this->atributos ["anchoEtiqueta"] )) {
				
				$this->mi_etiqueta .= "<div style='float:left; width:" . $this->atributos ["anchoEtiqueta"] . "px' ";
			} else {
				$this->mi_etiqueta .= "<div style='float:left; width:120px' ";
			}
			
			$this->mi_etiqueta .= ">";
		}
		
		$this->mi_etiqueta .= '<label ';
		
		if (isset ( $this->atributos ["estiloEtiqueta"] )) {
			$this->mi_etiqueta .= "class='" . $this->atributos ["estiloEtiqueta"] . "' ";
		}
		
		$this->mi_etiqueta .= "for='" . $this->atributos ["id"] . "' >";
		$this->mi_etiqueta .= $this->atributos ["etiqueta"] . "</label>\n";
		
		if (isset ( $this->atributos ["etiquetaObligatorio"] ) && $this->atributos ["etiquetaObligatorio"] == true) {
			$this->mi_etiqueta .= "<span class='texto_rojo texto_pie'>* </span>";
		} else {
			if (! isset ( $this->atributos ["sinDivision"] ) && (isset ( $this->atributos ["estilo"] ) && $this->atributos ["estilo"] != "jqueryui")) {
				$this->mi_etiqueta .= "<span style='white-space:pre;'> </span>";
			}
		}
		
		if (! isset ( $this->atributos ["sinDivision"] )) {
			$this->mi_etiqueta .= "</div>\n";
		}
		
		return $this->mi_etiqueta;
	
	}

	function boton($datosConfiguracion, $misAtributos) {
		
		$this->setAtributos($misAtributos);

		if ($this->atributos ["tipo"] == "boton") {
			$this->cadenaBoton = "<button ";
			$this->cadenaBoton .= "value='" . $this->atributos ["valor"] . "' ";
			$this->cadenaBoton .= "id='" . $this->atributos ["id"] . "A' ";
			$this->cadenaBoton .= "tabindex='" . $this->atributos ["tabIndex"] . "' ";
			
			$this->cadenaBoton.=$this->atributosGeneralesBoton();
			
			if (! isset ( $this->atributos ["cancelar"] ) && (isset ( $this->atributos ["verificarFormulario"] ) && $this->atributos ["verificarFormulario"] != "")) {
				$this->cadenaBoton .= "onclick=\"if(" . $this->atributos ["verificarFormulario"] . "){document.forms['" . $this->atributos ["nombreFormulario"] . "'].elements['" . $this->atributos ["id"] . "'].value='true';";
				if (isset ( $this->atributos ["tipoSubmit"] ) && $this->atributos ["tipoSubmit"] == "jquery") {
					$this->cadenaBoton .= " $(this).closest('form').submit();";
				} else {
					$this->cadenaBoton .= "document.forms['" . $this->atributos ["nombreFormulario"] . "'].submit()";
				}
				$this->cadenaBoton .= "}else{this.disabled=false;false}\">" . $this->atributos ["valor"] . '</button>\n';
				// El cuadro de Texto asociado
				$this->atributos ["id"] = $this->atributos ["id"];
				$this->atributos ["tipo"] = "hidden";
				$this->atributos ["obligatorio"] = false;
				$this->atributos ["etiqueta"] = "";
				$this->atributos ["valor"] = "false";
				$this->cadenaBoton .= $this->cuadro_texto ( $datosConfiguracion, $this->atributos );
			} else {
				
				$this->cadenaBoton.=$this->atributoOnclickBoton();
				
				$this->cadenaBoton .= "\">" . $this->atributos ["valor"] . "</button>\n";
				
				// El cuadro de Texto asociado
				$this->atributos ["id"] = $this->atributos ["id"];
				$this->atributos ["tipo"] = "hidden";
				$this->atributos ["obligatorio"] = false;
				$this->atributos ["etiqueta"] = "";
				$this->atributos ["valor"] = "false";
				$this->cadenaBoton .= $this->cuadro_texto ( $datosConfiguracion, $this->atributos );
			}
		} else {
			
			$this->cadenaBoton = "<input ";
			$this->cadenaBoton .= "value='" . $this->atributos ["valor"] . "' ";
			$this->cadenaBoton .= "name='" . $this->atributos ["id"] . "' ";
			$this->cadenaBoton .= "id='" . $this->atributos ["id"] . "' ";
			$this->cadenaBoton .= "tabindex='" . $this->atributos ["tabIndex"] . "' ";
			$this->cadenaBoton .= "type='submit' ";
			$this->cadenaBoton .= ">\n";
		}
		return $this->cadenaBoton;
	
	}
	
	function atributoOnclickBoton(){
		
		$cadena='';
		if (isset ( $this->atributos ["tipoSubmit"] ) && $this->atributos ["tipoSubmit"] == "jquery") {
			// Utilizar esto para garantizar que se procesan los controladores de eventos de javascript al momento de enviar el form
			$cadena .= "onclick=\"document.forms['" . $this->atributos ["nombreFormulario"] . "'].elements['" . $this->atributos ["id"] . "'].value='true';";
			$cadena .= " $(this).closest('form').submit();";
		} else {
			if (! isset ( $this->atributos ["onclick"] )) {
		
				$cadena .= "onclick=\"document.forms['" . $this->atributos ["nombreFormulario"] . "'].elements['" . $this->atributos ["id"] . "'].value='true';";
				$cadena .= "document.forms['" . $this->atributos ["nombreFormulario"] . "'].submit()";
			}
		}
		
		if (isset ( $this->atributos ["onclick"] ) && $this->atributos ["onclick"] != '') {
			$cadena .= "onclick=\" " . $this->atributos ["onclick"] . "\" ";
		}
		
		return $cadena;
	}
	
	
	function atributosGeneralesBoton(){
		
		$cadena='';
		if (isset ( $this->atributos ['submit'] ) && $this->atributos ['submit'] == true) {
			$cadena .= "type='submit' ";
		} else {
			$cadena .= "type='button' ";
		}
			
		if (! isset ( $this->atributos ["onsubmit"] )) {
			$this->atributos ["onsubmit"] = "";
		}
			
		// Poner el estilo en línea definido por el usuario
		if (isset ( $this->atributos ["estiloEnLinea"] ) && $this->atributos ["estiloEnLinea"] != "") {
			$cadena .= "style='" . $this->atributos ["estiloEnLinea"] . "' ";
		}
		
		return $cadena;
	}
	
	
	function radioButton($misAtributos) {
		
		$this->setAtributos($misAtributos);
		$this->miOpcion = "";
		$nombre = $this->atributos ["id"];
		$id = "campo" . rand ();
		
		if (isset ( $this->atributos ["opciones"] )) {
			$opciones = explode ( "|", $this->atributos ["opciones"] );
			
			if (is_array ( $opciones )) {
				
				$this->miOpcion.=$this->opcionesRedioButton($opciones);
			}
		} else {
			
			$this->miOpcion .= "<input type='radio' ";
			$this->miOpcion .= "name='" . $id . "' ";
			$this->miOpcion .= "id='" . $id . "' ";
			
			$this->miOpcion .= "value='" . $this->atributos ["valor"] . "' ";
			
			if (isset ( $this->atributos ["tabIndex"] )) {
				$this->miOpcion .= "tabindex='" . $this->atributos ["tabIndex"] . "' ";
			}
			
			if (isset ( $this->atributos ["seleccionado"] ) && $this->atributos ["seleccionado"] == true) {
				$this->miOpcion .= "checked='true' ";
			}
			
			$this->miOpcion .= "/> ";
			$this->miOpcion .= "<label for='" . $id . "'>";
			$this->miOpcion .= $this->atributos ["etiqueta"];
			$this->miOpcion .= "</label>\n";
		}
		return $this->miOpcion;
	
	}
	
	function opcionesRadioButton($opciones){
		
		$cadena='';
		foreach ( $opciones as $clave => $valor ) {
			$opcion = explode ( "&", $valor );
			if ($opcion [0] != "") {
				if ($opcion [0] != $this->atributos ["seleccion"]) {
					$cadena .= "<div>";
					$cadena .= "<input type='radio' id='" . $id . "' name='" . $nombre . "' value='" . $opcion [0] . "' />";
					$cadena .= "<label for='" . $id . "'>";
					$cadena .= $opcion [1] . "";
					$cadena .= "</label>";
					$cadena .= "</div>";
				} else {
					$cadena .= "<div>";
					$cadena .= "<input type='radio' id='" . $id . "' name='" . $nombre . "' value='" . $opcion [0] . "' checked /> ";
					$cadena .= "<label for='" . $id . "'>";
					$cadena .= $opcion [1] . "";
					$cadena .= "</label>";
					$cadena .= "</div>";
				}
			}
		}
		
		return $cadena;
	}

	function checkBox($misAtributos) {
		
		$this->setAtributos($misAtributos);

		$this->miOpcion = "";
		$this->miOpcion .= "<label for='" . $this->atributos ["id"] . "'>";
		$this->miOpcion .= $this->atributos ["etiqueta"];
		$this->miOpcion .= "</label>\n";
		
		$this->miOpcion .= "<input type='checkbox' ";
		
		if (isset ( $this->atributos ["id"] )) {
			$this->miOpcion .= "name='" . $this->atributos ["id"] . "' ";
			$this->miOpcion .= "id='" . $this->atributos ["id"] . "' ";
		}
		
		if (isset ( $this->atributos ["valor"] )) {
			$this->miOpcion .= "value='" . $this->atributos ["valor"] . "' ";
		}
		
		if (isset ( $this->atributos ["tabIndex"] )) {
			$this->miOpcion .= "tabindex='" . $this->atributos ["tabIndex"] . "' ";
		}
		
		if (isset ( $this->atributos ["evento"] )) {
			$this->miOpcion .= $this->atributos ["evento"] . "=\"" . $this->atributos ["eventoFuncion"] . "\" ";
		}
		
		if (isset ( $this->atributos ["seleccionado"] ) && $this->atributos ["seleccionado"] == true) {
			$this->miOpcion .= "checked ";
		}
		
		$this->miOpcion .= "/>";
		return $this->miOpcion;
	
	}

}

// Fin de la clase html
?>
