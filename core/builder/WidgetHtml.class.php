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
    
    /**
     * Nombres de los atributos que se pueden asignar a los controles,
     * se declaran como constantes para facilitar su cambio ya que se utilizan en varias funciones.
     */
    const ID = 'id';
    
    const TIPO = 'tipo';
    
    const ESTILO = 'estilo';
    
    const ESTILOENLINEA = 'estiloEnLinea';
    
    const SINDIVISION = 'sinDivision';
    
    const HIDDEN = 'hidden';
    
    const DESHABILITADO = 'deshabilitado';
    
    const SELECCIONADO = 'seleccionado';
    
    const MAXIMOTAMANNO = 'maximoTamanno';
    
    const EVENTO = 'evento';
    
    const ONCLICK = 'onClick';
    
    const TIPOSUBMIT = 'tipoSubmit';
    
    const TABINDEX = 'tabIndex';
    
    const VALOR = 'valor';
    
    const ETIQUETA = 'etiqueta';
    
    const TITULO = 'titulo';
    
    const ESTILOAREA = 'estiloArea';
    
    const TEXTOENRIQUECIDO = 'textoEnriquecido';
    
    const VERIFICARFORMULARIO = 'verificarFormulario';
    
    const NOMBREFORMULARIO = 'nombreFormulario';
    
    /**
     * Atributos HTML
     * Se definen como constantes para evitar errores al duplicar
     */
    const HTMLNAME = 'name=';
    
    const HTMLTABINDEX = 'tabindex=';
    
    const HTMLVALUE = 'value=';
    
    const HTMLCLASS = 'class=';
    
    const HTMLLABEL = '<label for=';
    
    const HTMLENDLABEL = self::HTMLENDLABEL;
    
    // ================================== Funciones Cuadro Lista ==================================
    
    /**
     *
     * @name cuadro_lista
     * @param string $cuadroSql
     *            Clausula SQL desde donde se extraen los valores de la lista
     * @param string $nombre
     *            Nombre del control que se va a crear
     * @param string $configuracion            
     * @param int $seleccion
     *            id (o nombre??) del elemento seleccionado en la lista
     * @param int $evento
     *            Evento javascript que desencadena el control
     * @return void
     * @access public
     */
    function __construct() {
        
        $this->miConfigurador = Configurador::singleton ();
    
    }
    
    function cuadro_texto($misAtributos) {
        
        $this->setAtributos ( $misAtributos );
        
        if (! isset ( $this->atributos [self::TIPO] ) || $this->atributos [self::TIPO] != self::HIDDEN) {
            
            $this->mi_cuadro = '<input ';
            
            $this->mi_cuadro .= $this->atributoClassCuadroTexto ();
            
            $this->mi_cuadro .= $this->atributosGeneralesCuadroTexto ();
            
            if (! isset ( $this->atributos [self::MAXIMOTAMANNO] )) {
                $this->atributos [self::MAXIMOTAMANNO] = 100;
            }
            
            $cadena .= "maxlength='" . $this->atributos [self::MAXIMOTAMANNO] . "' ";
            
            // Si se utiliza ketchup
            if (isset ( $this->atributos ["data-validate"] )) {
                $cadena .= "data-validate='validate(" . $this->atributos ["data-validate"] . ")' ";
            }
            
            // Si utiliza algun evento especial
            if (isset ( $this->atributos [self::EVENTO] )) {
                $cadena .= " " . $this->atributos [self::EVENTO] . " ";
            }
            $this->mi_cuadro .= self::HTMLTABINDEX . "'" . $this->atributos [self::TABINDEX] . "' ";
            $this->mi_cuadro .= ">\n";
        } else {
            
            $this->mi_cuadro = "<input type='hidden' ";
            $this->mi_cuadro .= self::HTMLNAME . "'" . $this->atributos [self::ID] . "' ";
            $this->mi_cuadro .= "id='" . $this->atributos [self::ID] . "' ";
            if (isset ( $this->atributos [self::VALOR] )) {
                $this->mi_cuadro .= self::HTMLVALUE . "'" . $this->atributos [self::VALOR] . "' ";
            }
            $this->mi_cuadro .= ">\n";
        }
        return $this->mi_cuadro;
    
    }
    
    function atributosGeneralesCuadroTexto() {
        
        $cadena = '';
        
        if (! isset ( $this->atributos [self::TIPO] )) {
            $this->atributos [self::TIPO] = "text";
        }
        
        $cadena .= "type='" . $this->atributos [self::TIPO] . "' ";
        
        if (isset ( $this->atributos [self::TITULO] ) && $this->atributos [self::TITULO] != "") {
            $cadena .= "title='" . $this->atributos [self::TITULO] . "' ";
        }
        
        if (isset ( $this->atributos [self::DESHABILITADO] ) && $this->atributos [self::DESHABILITADO]) {
            $cadena .= "readonly='readonly' ";
        }
        
        if (isset ( $this->atributos ["name"] ) && $this->atributos ["name"] != "") {
            $cadena .= self::HTMLNAME . "'" . $this->atributos ["name"] . "' ";
        } else {
            $cadena .= self::HTMLNAME . "'" . $this->atributos [self::ID] . "' ";
        }
        
        $cadena .= "id='" . $this->atributos [self::ID] . "' ";
        
        if (isset ( $this->atributos [self::VALOR] )) {
            $cadena .= self::HTMLVALUE . "'" . $this->atributos [self::VALOR] . "' ";
        }
        
        if (isset ( $this->atributos ["tamanno"] )) {
            $cadena .= "size='" . $this->atributos ["tamanno"] . "' ";
        } else {
            $cadena .= "size='50' ";
        }
        
        return $cadena;
    
    }
    
    function atributoClassCuadroTexto() {
        
        $cadena = self::HTMLCLASS . "'";
        // --------------Atributo class --------------------------------
        if (isset ( $this->atributos [self::ESTILO] ) && $this->atributos [self::ESTILO] != "") {
            
            if ($this->atributos [self::ESTILO] == "jqueryui") {
                $cadena .= "ui-widget ui-widget-content ui-corner-all ";
            } else {
                $cadena .= $this->atributos [self::ESTILO] . " ";
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
        
        return $cadena .= "' ";
        
        // ----------- Fin del atributo class ----------------------------
    
    }
    
    function area_texto($datosConfiguracion, $misAtributos) {
        
        $this->setAtributos ( $misAtributos );
        
        $this->mi_cuadro = "<textarea ";
        
        $this->mi_cuadro .= "id='" . $this->atributos [self::ID] . "' ";
        
        $this->mi_cuadro .= $this->atributosGeneralesAreaTexto ();
        
        if (isset ( $this->atributos [self::ESTILOAREA] ) && $this->atributos [self::ESTILOAREA] != "") {
            $this->mi_cuadro .= self::HTMLCLASS . "'" . $this->atributos [self::ESTILOAREA] . "' ";
        } else {
            $this->mi_cuadro .= "class='areaTexto' ";
        }
        
        $this->mi_cuadro .= self::HTMLTABINDEX . "'" . $this->atributos [self::TABINDEX] . "' ";
        $this->mi_cuadro .= ">\n";
        if (isset ( $this->atributos [self::VALOR] )) {
            $this->mi_cuadro .= $this->atributos [self::VALOR];
        } else {
            $this->mi_cuadro .= "";
        }
        $this->mi_cuadro .= "</textarea>\n";
        
        if (isset ( $this->atributos [self::TEXTOENRIQUECIDO] ) && $this->atributos [self::TEXTOENRIQUECIDO]) {
            $this->mi_cuadro .= "<script type=\"text/javascript\">\n";
            $this->mi_cuadro .= "mis_botones='" . $datosConfiguracion ["host"] . $datosConfiguracion ["site"] . $datosConfiguracion ["grafico"] . "/textarea/';\n";
            $this->mi_cuadro .= "archivo_css='" . $datosConfiguracion ["host"] . $datosConfiguracion ["site"] . $datosConfiguracion ["estilo"] . "/basico/estilo.php';\n";
            $this->mi_cuadro .= "editor_html('" . $this->atributos [self::ID] . "', 'bold italic underline | left center right | number bullet | wikilink');";
            $this->mi_cuadro .= "\n</script>";
        }
        
        return $this->mi_cuadro;
    
    }
    
    function atributosGeneralesAreaTexto() {
        
        $cadena = '';
        
        if (isset ( $this->atributos [self::DESHABILITADO] ) && $this->atributos [self::DESHABILITADO]) {
            $cadena .= "readonly='1' ";
        }
        
        if (isset ( $this->atributos ["name"] ) && $this->atributos ["name"] != "") {
            $cadena .= self::HTMLNAME . "'" . $this->atributos ["name"] . "' ";
        } else {
            $cadena .= self::HTMLNAME . "'" . $this->atributos [self::ID] . "' ";
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
        
        $this->setAtributos ( $misAtributos );
        
        $this->mi_etiqueta = "";
        
        if (! isset ( $this->atributos [self::SINDIVISION] )) {
            if (isset ( $this->atributos ["anchoEtiqueta"] )) {
                
                $this->mi_etiqueta .= "<div style='float:left; width:" . $this->atributos ["anchoEtiqueta"] . "px' ";
            } else {
                $this->mi_etiqueta .= "<div style='float:left; width:120px' ";
            }
            
            $this->mi_etiqueta .= ">";
        }
        
        $this->mi_etiqueta .= '<label ';
        
        if (isset ( $this->atributos ["estiloEtiqueta"] )) {
            $this->mi_etiqueta .= self::HTMLCLASS . "'" . $this->atributos ["estiloEtiqueta"] . "' ";
        }
        
        $this->mi_etiqueta .= "for='" . $this->atributos [self::ID] . "' >";
        $this->mi_etiqueta .= $this->atributos [self::ETIQUETA] . self::HTMLENDLABEL;
        
        if (isset ( $this->atributos ["etiquetaObligatorio"] ) && $this->atributos ["etiquetaObligatorio"]) {
            $this->mi_etiqueta .= "<span class='texto_rojo texto_pie'>* </span>";
        } else {
            if (! isset ( $this->atributos [self::SINDIVISION] ) && (isset ( $this->atributos [self::ESTILO] ) && $this->atributos [self::ESTILO] != "jqueryui")) {
                $this->mi_etiqueta .= "<span style='white-space:pre;'> </span>";
            }
        }
        
        if (! isset ( $this->atributos [self::SINDIVISION] )) {
            $this->mi_etiqueta .= "</div>\n";
        }
        
        return $this->mi_etiqueta;
    
    }
    
    function boton($datosConfiguracion, $misAtributos) {
        
        $this->setAtributos ( $misAtributos );
        
        if ($this->atributos [self::TIPO] == "boton") {
            $this->cadenaBoton = "<button ";
            $this->cadenaBoton .= self::HTMLVALUE . "'" . $this->atributos [self::VALOR] . "' ";
            $this->cadenaBoton .= "id='" . $this->atributos [self::ID] . "A' ";
            $this->cadenaBoton .= self::HTMLTABINDEX . "'" . $this->atributos [self::TABINDEX] . "' ";
            
            $this->cadenaBoton .= $this->atributosGeneralesBoton ();
            
            if (! isset ( $this->atributos ["cancelar"] ) && (isset ( $this->atributos [self::VERIFICARFORMULARIO] ) && $this->atributos [self::VERIFICARFORMULARIO] != "")) {
                $this->cadenaBoton .= "onclick=\"if(" . $this->atributos [self::VERIFICARFORMULARIO] . "){document.forms['" . $this->atributos [self::NOMBREFORMULARIO] . "'].elements['" . $this->atributos [self::ID] . "'].value= 'true';";
                if (isset ( $this->atributos [self::TIPOSUBMIT] ) && $this->atributos [self::TIPOSUBMIT] == "jquery") {
                    $this->cadenaBoton .= " $(this).closest('form').submit();";
                } else {
                    $this->cadenaBoton .= "document.forms['" . $this->atributos [self::NOMBREFORMULARIO] . "'].submit()";
                }
                $this->cadenaBoton .= "}else{this.disabled=false;false}\">" . $this->atributos [self::VALOR] . '</button>\n';
                // El cuadro de Texto asociado
                $this->atributos [self::ID] = $this->atributos [self::ID];
                $this->atributos [self::TIPO] = self::HIDDEN;
                $this->atributos ["obligatorio"] = false;
                $this->atributos [self::ETIQUETA] = "";
                $this->atributos [self::VALOR] = "false";
                $this->cadenaBoton .= $this->cuadro_texto ( $datosConfiguracion, $this->atributos );
            } else {
                
                $this->cadenaBoton .= $this->atributoOnclickBoton ();
                
                $this->cadenaBoton .= "\">" . $this->atributos [self::VALOR] . "</button>\n";
                
                // El cuadro de Texto asociado
                $this->atributos [self::ID] = $this->atributos [self::ID];
                $this->atributos [self::TIPO] = self::HIDDEN;
                $this->atributos ["obligatorio"] = false;
                $this->atributos [self::ETIQUETA] = "";
                $this->atributos [self::VALOR] = "false";
                $this->cadenaBoton .= $this->cuadro_texto ( $datosConfiguracion, $this->atributos );
            }
        } else {
            
            $this->cadenaBoton = "<input ";
            $this->cadenaBoton .= self::HTMLVALUE . "'" . $this->atributos [self::VALOR] . "' ";
            $this->cadenaBoton .= self::HTMLNAME . "'" . $this->atributos [self::ID] . "' ";
            $this->cadenaBoton .= "id='" . $this->atributos [self::ID] . "' ";
            $this->cadenaBoton .= self::HTMLTABINDEX . "'" . $this->atributos [self::TABINDEX] . "' ";
            $this->cadenaBoton .= "type='submit' ";
            $this->cadenaBoton .= ">\n";
        }
        return $this->cadenaBoton;
    
    }
    
    function atributoOnclickBoton() {
        
        $cadena = '';
        if (isset ( $this->atributos [self::TIPOSUBMIT] ) && $this->atributos [self::TIPOSUBMIT] == "jquery") {
            // Utilizar esto para garantizar que se procesan los controladores de eventos de javascript al momento de enviar el form
            $cadena .= "onclick=\"document.forms['" . $this->atributos [self::NOMBREFORMULARIO] . "'].elements['" . $this->atributos [self::ID] . "'].value='true';";
            $cadena .= " $(this).closest('form').submit();";
        } else {
            if (! isset ( $this->atributos [self::ONCLICK] )) {
                
                $cadena .= "onclick=\"document.forms['" . $this->atributos [self::NOMBREFORMULARIO] . "'].elements['" . $this->atributos [self::ID] . "'].value='true';";
                $cadena .= "document.forms['" . $this->atributos [self::NOMBREFORMULARIO] . "'].submit()";
            }
        }
        
        if (isset ( $this->atributos [self::ONCLICK] ) && $this->atributos [self::ONCLICK] != '') {
            $cadena .= "onclick=\" " . $this->atributos [self::ONCLICK] . "\" ";
        }
        
        return $cadena;
    
    }
    
    function atributosGeneralesBoton() {
        
        $cadena = '';
        if (isset ( $this->atributos ['submit'] ) && $this->atributos ['submit']) {
            $cadena .= "type='submit' ";
        } else {
            $cadena .= "type='button' ";
        }
        
        if (! isset ( $this->atributos ["onsubmit"] )) {
            $this->atributos ["onsubmit"] = "";
        }
        
        // Poner el estilo en línea definido por el usuario
        if (isset ( $this->atributos [self::ESTILOENLINEA] ) && $this->atributos [self::ESTILOENLINEA] != "") {
            $cadena .= "style='" . $this->atributos [self::ESTILOENLINEA] . "' ";
        }
        
        return $cadena;
    
    }
    
    function radioButton($misAtributos) {
        
        $this->setAtributos ( $misAtributos );
        $this->miOpcion = "";
        $nombre = $this->atributos [self::ID];
        $id = "campo" . rand ();
        
        if (isset ( $this->atributos ["opciones"] )) {
            $opciones = explode ( "|", $this->atributos ["opciones"] );
            
            if (is_array ( $opciones )) {
                
                $this->miOpcion .= $this->opcionesRadioButton ( $opciones );
            }
        } else {
            
            $this->miOpcion .= "<input type='radio' ";
            $this->miOpcion .= self::HTMLNAME . "'" . $id . "' ";
            $this->miOpcion .= "id='" . $id . "' ";
            $this->miOpcion .= self::HTMLNAME . "'" . $nombre . "' ";
            
            $this->miOpcion .= self::HTMLVALUE . "'" . $this->atributos [self::VALOR] . "' ";
            
            if (isset ( $this->atributos [self::TABINDEX] )) {
                $this->miOpcion .= self::HTMLTABINDEX . "'" . $this->atributos [self::TABINDEX] . "' ";
            }
            
            if (isset ( $this->atributos [self::SELECCIONADO] ) && $this->atributos [self::SELECCIONADO]) {
                $this->miOpcion .= "checked='true' ";
            }
            
            $this->miOpcion .= "/> ";
            $this->miOpcion .= self::HTMLLABEL . "'" . $id . "'>";
            $this->miOpcion .= $this->atributos [self::ETIQUETA];
            $this->miOpcion .= self::HTMLENDLABEL;
        }
        return $this->miOpcion;
    
    }
    
    function opcionesRadioButton($opciones) {
        
        $cadena = '';
        foreach ( $opciones as $clave => $valor ) {
            $opcion = explode ( "&", $valor );
            if ($opcion [0] != "") {
                if ($opcion [0] != $this->atributos ["seleccion"]) {
                    $cadena .= "<div>";
                    $cadena .= "<input type='radio' id='" . $id . "' " . self::HTMLNAME . "'" . $nombre . "' value='" . $opcion [0] . "' />";
                    $cadena .= self::HTMLLABEL . "'" . $id . "'>";
                    $cadena .= $opcion [1] . "";
                    $cadena .= "</label>";
                    $cadena .= "</div>";
                } else {
                    $cadena .= "<div>";
                    $cadena .= "<input type='radio' id='" . $id . "' " . self::HTMLNAME . "'" . $nombre . "' value='" . $opcion [0] . "' checked /> ";
                    $cadena .= self::HTMLLABEL . "'" . $id . "'>";
                    $cadena .= $opcion [1] . "";
                    $cadena .= "</label>";
                    $cadena .= "</div>";
                }
            }
        }
        
        return $cadena;
    
    }
    
    function checkBox($misAtributos) {
        
        $this->setAtributos ( $misAtributos );
        
        $this->miOpcion = "";
        $this->miOpcion .= self::HTMLLABEL . "'" . $this->atributos [self::ID] . "'>";
        $this->miOpcion .= $this->atributos [self::ETIQUETA];
        $this->miOpcion .= self::HTMLENDLABEL;
        
        $this->miOpcion .= "<input type='checkbox' ";
        
        if (isset ( $this->atributos [self::ID] )) {
            $this->miOpcion .= self::HTMLNAME . "'" . $this->atributos [self::ID] . "' ";
            $this->miOpcion .= "id='" . $this->atributos [self::ID] . "' ";
        }
        
        if (isset ( $this->atributos [self::VALOR] )) {
            $this->miOpcion .= self::HTMLVALUE . "'" . $this->atributos [self::VALOR] . "' ";
        }
        
        if (isset ( $this->atributos [self::TABINDEX] )) {
            $this->miOpcion .= self::HTMLTABINDEX . "'" . $this->atributos [self::TABINDEX] . "' ";
        }
        
        if (isset ( $this->atributos [self::EVENTO] )) {
            $this->miOpcion .= $this->atributos [self::EVENTO] . "=\"" . $this->atributos ["eventoFuncion"] . "\" ";
        }
        
        if (isset ( $this->atributos [self::SELECCIONADO] ) && $this->atributos [self::SELECCIONADO]) {
            $this->miOpcion .= "checked ";
        }
        
        $this->miOpcion .= "/>";
        return $this->miOpcion;
    
    }

}

// Fin de la clase html
?>
