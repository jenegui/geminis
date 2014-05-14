<?php
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
class WidgetHtml {

	/**
	 * Aggregations:
	 */
	/**
	 * Compositions:
	 */
	/* * Attributes: ** */
	
	/**
	 * Miembros privados de la clase
	 *
	 * @access private
	 */
	var $conexion_id;

	var $cuadro_registro;

	var $cuadroCampos;

	var $cuadro_miniRegistro;

	var $cadenaHTML;

	var $configuracion;

	var $atributos;

	var $miConfigurador;

	/**
	 *
	 * @name html
	 *       constructor
	 */
	function html() {

	
	}
	
	// Fin del método session
	function enlaceWiki($cadena, $titulo = "", $datoConfiguracion, $elEnlace = "") {

		if ($elEnlace != "") {
			$enlaceWiki = "<a class='wiki' href='" . $datoConfiguracion ["wikipedia"] . $cadena . "' title='" . $titulo . "'>" . $elEnlace . "</a>";
		} else {
			$enlaceWiki = "<a class='wiki' href='" . $datoConfiguracion ["wikipedia"] . $cadena . "' title='" . $titulo . "'>" . $cadena . "</a>";
		}
		return $enlaceWiki;
	
	}
	
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
	
	// IMPORTANTE!!!!!!!!!!!
	// Si la seleccion==-1 entonces se muestra una linea vacia al inicio de la lista
	// Si la seleccion <-1 entonces se seleccciona el primer registro devuelto en la busqueda
	// Cuando se pase un registro explicito debe ser una matriz de tres dimensiones. En cada dimension
	// debe tener:
	// $resultado[indice][valor][etiqueta_a_mostrar]
	function cuadro_lista($misAtributos) {

		$this->setAtributos($misAtributos);
		
		// Invocar la funcion que rescata el registro de los valores que se mostraran en la lista
		$resultado = $this->rescatarRegistroCuadroLista ();
		
		$this->cadena_html='';
		
		
		if ($resultado) {
			
			if (!isset ( $this->atributos ["nombre"] )) {
				$this->atributos ["nombre"]=$this->atributos ["id"];
			} 
			
			if (!isset ( $this->atributos ["seleccion"] )) {
				$this->atributos ["seleccion"]=-1;
			} 
			
			$this->atributos ["evento"] = $this->definirEvento ();
			
			$this->armarSelect();
			
			
		} else {
			$this->cadena_html .= "No Data";
		}
		
		return $this->cadena_html;
	
	}
	
	private function armarSelect(){
		$this->cadena_html = "<select ";
			
		if (isset ( $this->atributos ["deshabilitado"] ) && $this->atributos ["deshabilitado"] == true) {
			$this->cadena_html .= "disabled ";
		}
			
		if ($this->atributos ["id"] != "") {
			$this->cadena_html .= "id='" . $this->atributos ["id"] . "' ";
		}
			
			
		// Si se utiliza jQuery-Validation-Engine
		if (isset ( $this->atributos ["validar"] )) {
			$this->mi_cuadro .= " validate[" . $this->atributos ["validar"] . "] ";
		}
			
		if (isset ( $this->atributos ["estilo"] ) && $this->atributos ["estilo"] == "jqueryui") {
		
			$this->cadena_html .= " class='selectboxdiv' ";
		}
			
		if (isset ( $this->atributos ["ancho"] )) {
			$this->cadena_html .= " style='width:" . $this->atributos ["ancho"] . "' ";
		}
			
		// Si se especifica que puede ser multiple
		if (isset ( $this->atributos ["multiple"] ) && $this->atributos ["multiple"] = true) {
			$this->cadena_html .= " multiple \n";
		}
			
		$this->cadena_html .= "name='" . $this->atributos ['nombre'] . "' size='" . $this->atributos ['tamanno'] . "' " . $this->atributos ["evento"] . " tabindex='" . $this->atributos ['tab']."'>\n";
			
		// Si no se especifica una seleccion se agrega un espacio en blanco
		if ($this->atributos ["seleccion"] == - 1) {
			$this->cadena_html .= "<option value='-1'> </option>\n";
		}
			
		// Si el control esta asociado a otro control que aparece si no hay un valor en la lista
		if (isset ($this->atributos ["otraOpcion"])) {
			if ($this->atributos ["seleccion"] == "sara") {
				$this->cadena_html .= "<option value='sara' selected='true'>" . $this->atributos ["otraOpcionEtiqueta"] . "</option>\n";
			} else {
				$this->cadena_html .= "<option value='sara'>" . $this->atributos ["otraOpcionEtiqueta"] . "</option>\n";
			}
		}
			
		$this->listadoInicialCuadroLista ();
		$this->opcionesCuadroLista ();
			
		$this->cadena_html .= "</select>\n";
		
		
	}
	
	// Fin del método cuadro lista
	private function opcionesCuadroLista() {

		if (isset ( $this->atributos ["seleccion"] )) {
			$seleccion = $this->atributos ["seleccion"];
		} else {
			$seleccion = - 1;
		}
		
		$limitar = $this->atributos ["limitar"];
		// Recorrer todos los registros devueltos
		
		for($j = 0; $j < $this->cuadroCampos; $j ++) {
			
			$this->cuadro_contenido = "";
			
			if ($j == 0) {
				$this->keys = array_keys ( $this->cuadro_registro [0] );
				
				$this->columnas = 0;
				foreach ( $this->keys as $clave => $valor ) {
					if (is_string ( $valor )) {
						$this->columnas ++;
					}
				}
			}
			
			if ($seleccion < 0 && $j == 0) {
				if ($limitar == 1) {
					$this->cadena_html .= "<option value='" . $this->cuadro_registro [$j] [0] . "' selected='true'>" . substr ( $this->cuadro_registro [$j] [1], 0, 20 ) . "</option>\n";
				} else {
					$this->cadena_html .= "<option value='" . $this->cuadro_registro [$j] [0] . "' selected='true'>" . htmlentities ( $this->cuadro_registro [$j] [1] ) . "</option>\n";
				}
			} else {
				if ($limitar == 1) {
					if (is_array ( $seleccion )) {
						if (in_array ( $this->cuadro_registro [$j] [0], $seleccion )) {
							$this->cadena_html .= "<option value='" . $this->cuadro_registro [$j] [0] . "' selected='true'>" . substr ( $this->cuadro_registro [$j] [1], 0, 20 ) . "</option>\n";
						} else {
							$this->cadena_html .= "<option value='" . $this->cuadro_registro [$j] [0] . "'>" . substr ( $this->cuadro_registro [$j] [1], 0, 20 ) . "</option>\n";
						}
					} else {
						if ($this->cuadro_registro [$j] [0] == $seleccion) {
							$this->cadena_html .= "<option value='" . $this->cuadro_registro [$j] [0] . "' selected='true'>" . substr ( $this->cuadro_registro [$j] [1], 0, 20 ) . "</option>\n";
						} else {
							$this->cadena_html .= "<option value='" . $this->cuadro_registro [$j] [0] . "'>" . substr ( $this->cuadro_registro [$j] [1], 0, 20 ) . "</option>\n";
						}
					}
				} else {
					if ($this->cuadro_registro [$j] [0] == $seleccion) {
						$this->cadena_html .= "<option value='" . $this->cuadro_registro [$j] [0] . "' selected='true'>" . htmlentities ( $this->cuadro_registro [$j] [1] ) . "</option>\n";
					} else {
						$this->cadena_html .= "<option value='" . $this->cuadro_registro [$j] [0] . "'>" . htmlentities ( $this->cuadro_registro [$j] [1] ) . "</option>\n";
					}
				}
			}
		}
	
	}

	/**
	 *
	 *
	 *
	 *
	 * Para cuadros de lista que tienen al inicio un conjunto de los datos "mas populares"; luego de estos datos saldra el listado completo
	 *
	 * @name listadoInicialCuadroLista
	 * @param
	 *        	none
	 * @category funciones para crear cuadros de lista
	 * @access private
	 * @return none
	 */
	private function listadoInicialCuadroLista() {

		if (isset ( $miniRegistro )) {
			for($i = 0; $i < $totalMiniRegistro; $i ++) {
				$this->cuadro_contenido = "";
				if ($i == 0) {
					$keys = array_keys ( $miniRegistro [0] );
					
					$columnas = 0;
					foreach ( $keys as $clave => $valor ) {
						if (is_string ( $valor )) {
							$columnas ++;
						}
					}
				}
				
				// Si ningun registro es seleccionado
				if ($seleccion < 0 && $i == 0) {
					if ($limitar == 1) {
						$this->cadena_html .= "<option class='texto_negrita' value='" . $miniRegistro [$i] [0] . "' selected='true'>" . substr ( $miniRegistro [$i] [1], 0, 20 ) . "</option>\n";
					} else {
						$this->cadena_html .= "<option class='texto_negrita' value='" . $miniRegistro [$i] [0] . "' selected='true'>" . $miniRegistro [$i] [1] . "</option>\n";
					}
				} else {
					if ($limitar == 1) {
						if ($miniRegistro [$i] [0] == $seleccion) {
							$this->cadena_html .= "<option class='texto_negrita' value='" . $miniRegistro [$i] [0] . "' selected='true'>" . substr ( $miniRegistro [$i] [1], 0, 20 ) . "</option>\n";
							$seleccion = time ();
						} else {
							$this->cadena_html .= "<option class='texto_negrita' value='" . $miniRegistro [$i] [0] . "'>" . substr ( $miniRegistro [$i] [1], 0, 20 ) . "</option>\n";
						}
					} else {
						if ($miniRegistro [$i] [0] == $seleccion) {
							$this->cadena_html .= "<option class='texto_negrita' value='" . $miniRegistro [$i] [0] . "' selected='true'>" . htmlentities ( $miniRegistro [$i] [1] ) . "</option>\n";
							$seleccion = time ();
						} else {
							$this->cadena_html .= "<option class='texto_negrita' value='" . $miniRegistro [$i] [0] . "'>" . htmlentities ( $miniRegistro [$i] [1] ) . "</option>\n";
						}
					}
				}
			}
			$this->cadena_html .= "<option value='-1'></option>\n";
			$this->cadena_html .= "<option value='-1'>--------------</option>\n";
			$this->cadena_html .= "<option value='-1'></option>\n";
		}
	
	}

	/**
	 *
	 *
	 *
	 *
	 * De acuerdo a los atributos, define el tipo de evento asociado al control cuadro de lista.
	 *
	 * @name definirEvento
	 * @param
	 *        	none
	 * @category funciones para crear cuadros de lista
	 * @access private
	 * @return string
	 */
	private function definirEvento() {

		$evento = $this->atributos ["evento"];
		
		switch ($evento) {
			case 1 :
				$miEvento = 'onchange="this.form.submit()"';
				break;
			
			case 2 :
				$this->control = explode ( "|", $this->configuracion ["ajax_control"] );
				$miEvento = "onchange=\"" . $this->configuracion ["ajax_function"];
				$miEvento .= "(";
				foreach ( $this->control as $miControl ) {
					$miEvento .= "document.getElementById('" . $miControl . "').value,";
				}
				$miEvento = substr ( $miEvento, 0, (strlen ( $miEvento ) - 1) );
				$miEvento .= ")\"";
				break;
			
			default :
				$miEvento = "";
		}
		return $miEvento;
	
	}

	/**
	 *
	 *
	 *
	 *
	 * Define el registro de datos a partir del cual se construira el cuadro de lista
	 *
	 * @name rescatarRegistroCuadroLista
	 * @param
	 *        	none
	 * @access private
	 * @return none
	 */
	private function rescatarRegistroCuadroLista() {
		// Si no se ha pasado una tabla de valores, entonces debe realizarse una busqueda con la opcion determinada
		// Si se ha pasado una tabla de valores, entonces se utiliza esa tabla y no se hacen consultas
		$cuadroSql = $this->atributos ["cadena_sql"];
		
		if (! is_array ( $cuadroSql )) {
			
			// Si no se ha definido de donde tomar los datos se utiliza la base de datos definida en config.inc
			
			if (! isset ( $this->atributos ["baseDatos"] ) || (isset ( $this->atributos ["baseDatos"] ) && $this->atributos ["baseDatos"] == "")) {
				$this->atributos ["baseDatos"] = "configuracion";
			}
			
			$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $this->atributos ["baseDatos"] );
			if (! $esteRecursoDB) {
				// Esto se considera un error fatal
				exit ();
			}
			
			$this->cuadro_registro = $esteRecursoDB->ejecutarAcceso ( $cuadroSql, "busqueda" );
			
			if ($this->cuadro_registro) {
				
				$this->cuadroCampos = $esteRecursoDB->getConteo ();
				
				// En el caso que se requiera una minilista de opciones al principio
				if (isset ( $this->atributos ["subcadena_sql"] )) {
					
					$this->cuadro_miniRegistro = $esteRecursoDB->ejecutarAcceso ( $this->atributos ["subcadena_sql"], "busqueda" );
					if ($this->cuadro_registro) {
						return true;
					}
				}
				return true;
			}
			
			return false;
		} else {
			$this->cuadro_registro = $cuadroSql;
			$this->cuadroCampos = count ( $cuadroSql );
		}
	
	}
	
	// Fin del metodo rescatarRegistro
	// ================================== Fin de las Funciones Cuadro Lista ==================================
	function cuadro_texto($misAtributos) {
		
		$this->setAtributos($misAtributos);

		if (! isset ( $this->atributos ["tipo"] ) || $this->atributos ["tipo"] != 'hidden') {
			
			// --------------Atributo class --------------------------------
			if (isset ( $this->atributos ["estilo"] ) && $this->atributos ["estilo"] != "") {
				
				if ($this->atributos ["estilo"] == "jqueryui") {
					$this->mi_cuadro = "<input class='ui-widget ui-widget-content ui-corner-all ";
				} else {
					$this->mi_cuadro = "<input class='" . $this->atributos ["estilo"] . " ";
				}
			} else {
				$this->mi_cuadro = "<input class='cuadroTexto ";
			}
			
			// Si se utiliza jQuery-Validation-Engine
			if (isset ( $this->atributos ["validar"] )) {
				$this->mi_cuadro .= " validate[" . $this->atributos ["validar"] . "] ";
				// Si se utiliza jQuery-Validation-Engine
				if (isset ( $this->atributos ["categoria"] ) && $this->atributos ["categoria"] = "fecha") {
					$this->mi_cuadro .= "datepicker ";
				}
			}
			
			$this->mi_cuadro .= "' ";
			
			// ----------- Fin del atributo class ----------------------------
			
			if (isset ( $this->atributos ["tipo"] ) && $this->atributos ["tipo"] != "") {
				$this->mi_cuadro .= "type='" . $this->atributos ["tipo"] . "' ";
			} else {
				$this->mi_cuadro .= "type='text' ";
			}
			
			if (isset ( $this->atributos ["titulo"] ) && $this->atributos ["titulo"] != "") {
				$this->mi_cuadro .= "title='" . $this->atributos ["titulo"] . "' ";
			}
			
			if (isset ( $this->atributos ["deshabilitado"] ) && $this->atributos ["deshabilitado"] == true) {
				$this->mi_cuadro .= "readonly='readonly' ";
			}
			
			if (isset ( $this->atributos ["name"] ) && $this->atributos ["name"] != "") {
				$this->mi_cuadro .= "name='" . $this->atributos ["name"] . "' ";
			} else {
				$this->mi_cuadro .= "name='" . $this->atributos ["id"] . "' ";
			}
			
			$this->mi_cuadro .= "id='" . $this->atributos ["id"] . "' ";
			
			if (isset ( $this->atributos ["valor"] )) {
				$this->mi_cuadro .= "value='" . $this->atributos ["valor"] . "' ";
			}
			
			if (isset ( $this->atributos ["tamanno"] )) {
				$this->mi_cuadro .= "size='" . $this->atributos ["tamanno"] . "' ";
			} else {
				$this->mi_cuadro .= "size='50' ";
			}
			
			if (isset ( $this->atributos ["maximoTamanno"] )) {
				$this->mi_cuadro .= "maxlength='" . $this->atributos ["maximoTamanno"] . "' ";
			} else {
				$this->mi_cuadro .= "maxlength='100' ";
			}
			
			// Si se utiliza ketchup
			if (isset ( $this->atributos ["data-validate"] )) {
				$this->mi_cuadro .= "data-validate='validate(" . $this->atributos ["data-validate"] . ")' ";
			}
			
			// Si utiliza algun evento especial
			if (isset ( $this->atributos ["evento"] )) {
				$this->mi_cuadro .= " " . $this->atributos ["evento"] . " ";
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

	function area_texto($datosConfiguracion, $misAtributos) {
		
		$this->setAtributos($misAtributos);

		$this->mi_cuadro = "<textarea ";
		
		if (isset ( $this->atributos ["deshabilitado"] ) && $this->atributos ["deshabilitado"] == true) {
			$this->mi_cuadro .= "readonly='1' ";
		}
		
		if (isset ( $this->atributos ["name"] ) && $this->atributos ["name"] != "") {
			$this->mi_cuadro .= "name='" . $this->atributos ["name"] . "' ";
		} else {
			$this->mi_cuadro .= "name='" . $this->atributos ["id"] . "' ";
		}
		
		$this->mi_cuadro .= "id='" . $this->atributos ["id"] . "' ";
		
		if (isset ( $this->atributos ["columnas"] )) {
			$this->mi_cuadro .= "cols='" . $this->atributos ["columnas"] . "' ";
		} else {
			$this->mi_cuadro .= "cols='50' ";
		}
		
		if (isset ( $this->atributos ["filas"] )) {
			$this->mi_cuadro .= "rows='" . $this->atributos ["filas"] . "' ";
		} else {
			$this->mi_cuadro .= "rows='2' ";
		}
		
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
			
			if (isset ( $this->atributos ['submit'] ) && $this->atributos ['submit'] == true) {
				$this->cadenaBoton .= "type='submit' ";
			} else {
				$this->cadenaBoton .= "type='button' ";
			}
			
			if (! isset ( $this->atributos ["onsubmit"] )) {
				$this->atributos ["onsubmit"] = "";
			}
			
			// Poner el estilo en línea definido por el usuario
			if (isset ( $this->atributos ["estiloEnLinea"] ) && $this->atributos ["estiloEnLinea"] != "") {
				$this->cadenaBoton .= "style='" . $this->atributos ["estiloEnLinea"] . "' ";
			}
			
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
				
				if (isset ( $this->atributos ["tipoSubmit"] ) && $this->atributos ["tipoSubmit"] == "jquery") {
					// Utilizar esto para garantizar que se procesan los controladores de eventos de javascript al momento de enviar el form
					$this->cadenaBoton .= "onclick=\"document.forms['" . $this->atributos ["nombreFormulario"] . "'].elements['" . $this->atributos ["id"] . "'].value='true';";
					$this->cadenaBoton .= " $(this).closest('form').submit();";
				} else {
					if (! isset ( $this->atributos ["onclick"] )) {
						
						$this->cadenaBoton .= "onclick=\"document.forms['" . $this->atributos ["nombreFormulario"] . "'].elements['" . $this->atributos ["id"] . "'].value='true';";
						$this->cadenaBoton .= "document.forms['" . $this->atributos ["nombreFormulario"] . "'].submit()";
					}
				}
				
				if (isset ( $this->atributos ["onclick"] ) && $this->atributos ["onclick"] != '') {
					$this->cadenaBoton .= "onclick=\" " . $this->atributos ["onclick"] . "\" ";
				}
				
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
	
	// Funcion que genera listas desplegables con grupos de opciones
	// matrizItems es un vector, donde la posicion cero y las posiciones pares corresponden a los labels de los grupos de opciones y las posiciones impares corresponden a las opciones por cada grupo.
	// Las posiciones impar contienen un vector con las opciones correspondientes al grupo de opciones
	function cuadro_listaGrupos($matrizItems, $nombre, $datosConfiguracion, $seleccion, $evento, $limitar, $tab = 0, $id) {

		include_once ($datosConfiguracion ["raiz_documento"] . $datosConfiguracion ["clases"] . "/cadenas.class.php");
		$this->formato = new cadenas ();
		$this->cuadro_registro = $matrizItems;
		$this->cuadroCampos = count ( $matrizItems );
		
		$this->mi_cuadro = "";
		
		if ($this->cuadroCampos > 0) {
			switch ($evento) {
				case 1 :
					$miEvento = 'onchange="this.form.submit()"';
					break;
				
				case 2 :
					$miEvento = "onchange=\"" . $datosConfiguracion ["ajax_function"] . "(document.getElementById('" . $datosConfiguracion ["ajax_control"] . "').value)\"";
					break;
				case 3 :
					$miEvento = 'disabled="yes"';
					break;
				default :
					$miEvento = "";
			} // ierre de switch($evento)
			  // i trae id para asignar
			if ($id != "") {
				$id = "id='" . $id . "'";
			}
			
			// onstruye cuadro de seleccion
			$this->mi_cuadro = "<select name='" . $nombre . "' size='1' " . $miEvento . " tabindex='" . $tab . "' " . $id . ">\n";
			
			// i no se especifica una seleccion se agrega un espacio en blanco
			if ($seleccion < 0) {
				$this->mi_cuadro .= "<option value=''>Seleccione </option>\n";
			}
			
			for($this->grupos_contador = 0; $this->grupos_contador < $this->cuadroCampos - 1; $this->grupos_contador ++) {
				if (! is_array ( $this->cuadro_registro [$this->grupos_contador] ) && is_array ( $this->cuadro_registro [$this->grupos_contador + 1] )) {
					$this->valor = $this->cuadro_registro [$this->grupos_contador];
					$this->mi_cuadro .= "<optgroup ";
					$this->mi_cuadro .= "label='" . $this->valor . "'>";
					
					// lmacena en otra variable el vector que viene en $this->cuadro_registro[$this->grupos_contador+1] para poderlo manipular
					$this->opciones = $this->cuadro_registro [$this->grupos_contador + 1];
					
					// scribe las opciones del select
					$this->opciones_num_campos = count ( $this->opciones );
					$this->opciones_contador_valor = 0;
					$this->opciones_contador_texto = 1;
					
					while ( $this->opciones_contador_texto < $this->opciones_num_campos ) {
						
						$this->mi_cuadro .= "<option ";
						$this->mi_cuadro .= "value=" . $this->opciones [$this->opciones_contador_valor];
						
						// i debe seleccionar un registro especifico
						if ($seleccion == $this->opciones [$this->opciones_contador_valor]) {
							$this->mi_cuadro .= " selected='true'";
						}
						$this->mi_cuadro .= ">";
						$this->texto = $this->opciones [$this->opciones_contador_texto];
						
						// i debe limitar el texto en la visualizacion
						if ($limitar == 1) {
							$this->texto = $this->formato->unhtmlentities ( substr ( $this->texto, 0, 20 ) );
						} else {
							$this->texto = $this->formato->formatohtml ( $this->texto );
						}
						$this->mi_cuadro .= $this->texto;
						$this->mi_cuadro .= "</option>";
						
						$this->opciones_contador_valor = $this->opciones_contador_valor + 2;
						$this->opciones_contador_texto = $this->opciones_contador_texto + 2;
					}
					
					$this->mi_cuadro .= "</optgroup>";
					$this->grupos_contador + 1;
				}
			} // ierre de for
			$this->mi_cuadro .= "</select>\n";
		} 		// ierre de if $this->cuadroCampos>0
		else {
			echo "Imposible rescatar los datos.";
		}
		
		return $this->mi_cuadro;
	
	}
	
	// ierre de funcion cuadro_listaGrupos
	function radioButton($misAtributos) {
		
		$this->setAtributos($misAtributos);
		$this->miOpcion = "";
		$nombre = $this->atributos ["id"];
		$id = "campo" . rand ();
		
		if (isset ( $this->atributos ["opciones"] )) {
			$opciones = explode ( "|", $this->atributos ["opciones"] );
			
			if (is_array ( $opciones )) {
				
				foreach ( $opciones as $clave => $valor ) {
					$opcion = explode ( "&", $valor );
					if ($opcion [0] != "") {
						if ($opcion [0] != $this->atributos ["seleccion"]) {
							$this->miOpcion .= "<div>";
							$this->miOpcion .= "<input type='radio' id='" . $id . "' name='" . $nombre . "' value='" . $opcion [0] . "' />";
							$this->miOpcion .= "<label for='" . $id . "'>";
							$this->miOpcion .= $opcion [1] . "";
							$this->miOpcion .= "</label>";
							$this->miOpcion .= "</div>";
						} else {
							$this->miOpcion .= "<div>";
							$this->miOpcion .= "<input type='radio' id='" . $id . "' name='" . $nombre . "' value='" . $opcion [0] . "' checked /> ";
							$this->miOpcion .= "<label for='" . $id . "'>";
							$this->miOpcion .= $opcion [1] . "";
							$this->miOpcion .= "</label>";
							$this->miOpcion .= "</div>";
						}
					}
				}
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
	
	function setAtributos($misAtributos){
		$this->atributos=$misAtributos;
	}

}

// Fin de la clase html
?>
