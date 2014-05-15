<?php
include_once ("FormularioHtmlBase.class.php");

class FormularioHtml extends FormularioHtmlBase {



	function recaptcha($atributos) {

		require_once ($this->configuracion ["raiz_documento"] . $this->configuracion ["clases"] . "/recaptcha/recaptchalib.php");
		$publickey = $this->configuracion ["captcha_llavePublica"];
		
		if (isset ( $atributos ["estilo"] ) && $atributos ["estilo"] != "") {
			$this->cadenaHTML = "<div class='" . $atributos ["estilo"] . "'>\n";
		} else {
			$this->cadenaHTML = "<div class='recaptcha'>\n";
		}
		$this->cadenaHTML .= recaptcha_get_html ( $publickey );
		$this->cadenaHTML .= "</div>\n";
		return $this->cadenaHTML;
	
	}

	function marcoFormulario($tipo, $atributos) {

		if ($tipo == "inicio") {
			
			if (isset ( $atributos ["estilo"] ) && $atributos ["estilo"] != "") {
				$this->cadenaHTML = "<div class='" . $atributos ["estilo"] . "'>\n";
			} else {
				$this->cadenaHTML = "<div class='formulario'>\n";
			}
			$this->cadenaHTML .= "<form ";
			
			if (isset ( $atributos ["id"] )) {
				$this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
			}
			
			if (isset ( $atributos ["tipoFormulario"] )) {
				$this->cadenaHTML .= "enctype='" . $atributos ["tipoFormulario"] . "' ";
			}
			
			if (isset ( $atributos ["metodo"] )) {
				$this->cadenaHTML .= "method='" . strtolower ( $atributos ["metodo"] ) . "' ";
			}
			
			if (isset ( $atributos ["action"] )) {
				$this->cadenaHTML .= "action='index.php' ";
			}
			
			$this->cadenaHTML .= "title='Formulario' ";
			$this->cadenaHTML .= "name='" . $atributos ["nombreFormulario"] . "'>\n";
		} else {
			$this->cadenaHTML = "</form>\n";
			$this->cadenaHTML .= "</div>\n";
		}
		
		return $this->cadenaHTML;
	
	}

	function marcoAgrupacion($tipo, $atributos = "") {

		$this->cadenaHTML = "";
		if (isset ( $atributos ["estilo"] ) && $atributos ["estilo"] == "jqueryui") {
			if ($tipo == "inicio") {
				$this->cadenaHTML = "<div ";
				
				if (isset ( $atributos ["id"] )) {
					$this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
				}
				
				$this->cadenaHTML .= ">\n";
				$this->cadenaHTML .= "<fieldset class='ui-widget ui-widget-content' ";
				
				$this->cadenaHTML .= ">\n";
				if (isset ( $atributos ["leyenda"] )) {
					$this->cadenaHTML .= "<legend class='ui-state-default ui-corner-all'>\n" . $atributos ["leyenda"] . "</legend>\n";
				}
			} else {
				$this->cadenaHTML .= "</fieldset>\n";
				$this->cadenaHTML .= "</div>\n";
			}
		} else {
			
			if ($tipo == "inicio") {
				$this->cadenaHTML = "<div class='marcoControles'>\n";
				$this->cadenaHTML .= "<fieldset ";
				if (isset ( $atributos ["id"] )) {
					$this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
				}
				$this->cadenaHTML .= ">\n";
				if (isset ( $atributos ["leyenda"] )) {
					$this->cadenaHTML .= "<legend>\n" . $atributos ["leyenda"] . "</legend>\n";
				}
			} else {
				$this->cadenaHTML .= "</fieldset>\n";
				$this->cadenaHTML .= "</div>\n";
			}
		}
		return $this->cadenaHTML;
	
	}

	/**
	 * Formulario que no requieren su propia división
	 *
	 * @param unknown $tipo        	
	 * @param unknown $atributos        	
	 * @return Ambigous <string, unknown>
	 *        
	 */
	function formulario($tipo, $atributos = "") {

		if ($tipo == "inicio") {
			
			$this->cadenaHTML = "<form ";
			
			if (isset ( $atributos ["id"] )) {
				$this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
			}
			
			if (isset ( $atributos ["tipoFormulario"] )) {
				$this->cadenaHTML .= "enctype='" . $atributos ["tipoFormulario"] . "' ";
			}
			
			if (isset ( $atributos ["metodo"] )) {
				$this->cadenaHTML .= "method='" . strtolower ( $atributos ["metodo"] ) . "' ";
			}
			
			if (isset ( $atributos ["action"] )) {
				$this->cadenaHTML .= "action='index.php' ";
			}
			
			if (isset ( $atributos ["titulo"] )) {
				$this->cadenaHTML .= "title='" . $atributos ["titulo"] . "' ";
			}
			
			$this->cadenaHTML .= "name='" . $atributos ["nombreFormulario"] . "'>\n";
		} else {
			$this->cadenaHTML = "</form>\n";
		}
		
		return $this->cadenaHTML;
	
	}

	/**
	 * Agrupaciones que no deben tener una división propia
	 *
	 * @param unknown $tipo        	
	 * @param string $atributos        	
	 * @return Ambigous <string, unknown>
	 *        
	 */
	function agrupacion($tipo, $atributos = "") {

		$this->cadenaHTML = "";
		
		if ($tipo == "inicio") {
			$this->cadenaHTML .= "<fieldset ";
			if (isset ( $atributos ["id"] )) {
				$this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
			}
			$this->cadenaHTML .= ">\n";
			if (isset ( $atributos ["leyenda"] )) {
				$this->cadenaHTML .= "<legend>\n" . $atributos ["leyenda"] . "</legend>\n";
			}
		} else {
			$this->cadenaHTML .= "</fieldset>\n";
		}
		
		return $this->cadenaHTML;
	
	}

	/**
	 * Cuadro Mensaje: Funcion olvidada por el Ing Paulo.
	 * Se Incorpora nuevamente.
	 * Nickthor.
	 */
	function cuadroMensaje($atributos) {

		$this->cadenaHTML = "<div id='mensaje' class='" . $atributos ["tipo"] . " shadow " . $atributos ["estilo"] . "' >";
		$this->cadenaHTML .= "<span>" . $atributos ["mensaje"] . "</span>";
		$this->cadenaHTML .= "</div><br>";
		return $this->cadenaHTML;
	
	}

	function division($tipo, $atributos = "") {

		$this->cadenaHTML = "";
		if ($tipo == "inicio") {
			if (isset ( $atributos ["estilo"] )) {
				$this->cadenaHTML = "<div class='" . $atributos ["estilo"] . "' ";
			} else {
				$this->cadenaHTML = "<div ";
			}
			
			if (isset ( $atributos ["estiloEnLinea"] ) && $atributos ["estiloEnLinea"] != "") {
				$this->cadenaHTML .= "style='" . $atributos ["estiloEnLinea"] . "' ";
			}
			
			if (isset ( $atributos ["titulo"] )) {
				$this->cadenaHTML .= "title='" . $atributos ["titulo"] . "' ";
			}
			
			$this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
			
			$this->cadenaHTML .= ">\n";
		} else {
			
			$this->cadenaHTML .= "\n</div>\n";
		}
		
		return $this->cadenaHTML;
	
	}

	function enlace($atributos) {

		$this->cadenaHTML = "";
		$this->cadenaHTML .= "<a ";
		
		if (isset ( $atributos ["id"] )) {
			$this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
		}
		
		if (isset ( $atributos ["enlace"] ) && $atributos ["enlace"] != "") {
			$this->cadenaHTML .= "href='" . $atributos ["enlace"] . "' ";
		}
		
		if (isset ( $atributos ["tabIndex"] )) {
			$this->cadenaHTML .= "tabindex='" . $atributos ["tabIndex"] . "' ";
		}
		
		if (isset ( $atributos ["estilo"] ) && $atributos ["estilo"] != "") {
			
			if ($atributos ["estilo"] == 'jqueryui') {
				$this->cadenaHTML .= " class='botonEnlace ui-widget ui-widget-content ui-state-default ui-corner-all' ";
			} else {
				
				$this->cadenaHTML .= "class='" . $atributos ["estilo"] . "' ";
			}
		}
		$this->cadenaHTML .= ">\n";
		if (isset ( $atributos ["enlaceTexto"] )) {
			$this->cadenaHTML .= "<span>" . $atributos ["enlaceTexto"] . "</span>";
		}
		$this->cadenaHTML .= "</a>\n";
		
		return $this->cadenaHTML;
	
	}

	function listaNoOrdenada($atributos) {

		if (isset ( $atributos ['id'] )) {
			$this->cadenaHTML = "<ul id='" . $atributos ['id'] . "'>";
		} else {
			$this->cadenaHTML = "<ul>";
		}
		
		foreach ( $atributos ["items"] as $clave => $valor ) {
			$this->cadenaHTML .= "<li>";
			if (is_array ( $valor )) {
				
				if (isset ( $valor ['enlace'] ) && $atributos ['estilo'] == 'jqueryui') {
					if (isset ( $valor ['icono'] )) {
						$icono = '<span class="ui-accordion-header-icon ui-icon ' . $valor ['icono'] . '"></span>';
					} else {
						$icono = '';
					}
					
					$this->cadenaHTML .= "<a  id='pes" . $clave . "' href='" . $valor ['urlCodificada'] . "'>";
					$this->cadenaHTML .= "<div id='tab" . $clave . "' class='ui-accordion ui-widget ui-helper-reset'>";
					$this->cadenaHTML .= "<h3 class='ui-accordion-header ui-state-default ui-accordion-icons ui-corner-all'>" . $icono . $valor ['nombre'] . "</h3>";
					$this->cadenaHTML .= "</div>";
					$this->cadenaHTML .= "</a>";
				}
			} else {
				// Podría implementarse llamando a $this->enlace
				if (isset ( $atributos ["pestañas"] ) && $atributos ["pestañas"] == "true") {
					$this->cadenaHTML .= "<a id='pes" . $clave . "' href='#" . $clave . "'><div id='tab" . $clave . "'>" . $valor . "</div></a>";
				}
				
				if (isset ( $atributos ["enlaces"] ) && $atributos ["enlaces"] == "true") {
					$enlace = explode ( '|', $valor );
					$this->cadenaHTML .= "<a href='" . $enlace [1] . "'>" . $enlace [0] . "</a>";
				}
			}
			$this->cadenaHTML .= "</li>";
		}
		
		$this->cadenaHTML .= "</ul>";
		
		return $this->cadenaHTML;
	
	}

}

// Fin de la clase FormularioHtml
?>
