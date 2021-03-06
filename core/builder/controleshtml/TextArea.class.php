<?php
require_once ("core/builder/HtmlBase.class.php");
/**
 * 
 * @author paulo
 * 
 * $atributos['estilo']
 * $atributos['filas']
 * $atributos['columnas']
 *
 */
class TextArea  extends HtmlBase{
    
    
    function campoTextArea($atributos) {
    
        if ($atributos [self::ESTILO] == self::JQUERYUI) {
            $this->cadenaHTML = "<div>\n";
            $this->cadenaHTML .= "<fieldset class='ui-widget ui-widget-content'>\n";
            $this->cadenaHTML .= "<legend class='ui-state-default ui-corner-all'>\n" . $atributos [self::ETIQUETA] . "</legend>\n";
            $this->cadenaHTML .= $this->area_texto ( $this->configuracion, $atributos );
            $this->cadenaHTML .= "\n</fieldset>\n";
            $this->cadenaHTML .= "</div>\n";
            return $this->cadenaHTML;
        } else {
    
            if (isset ( $atributos [self::ESTILO] ) && $atributos [self::ESTILO] != "") {
                $this->cadenaHTML = "<div class='" . $atributos [self::ESTILO] . "'>\n";
            } else {
                $this->cadenaHTML = "<div class='campoAreaTexto'>\n";
            }
    
            $this->cadenaHTML .= $this->etiqueta ( $atributos );
            $this->cadenaHTML .= "<div class='campoAreaContenido'>\n";
            $this->cadenaHTML .= $this->area_texto ( $this->configuracion, $atributos );
            $this->cadenaHTML .= "\n</div>\n";
            $this->cadenaHTML .= "</div>\n";
            return $this->cadenaHTML;
        }
    
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
    
    
}