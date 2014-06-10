<?php

require_once ("core/builder/HtmlBase.class.php");


class Form  extends HtmlBase {
    
    function marcoFormulario($tipo, $atributos) {
    
        if ($tipo == self::INICIO) {
    
            if (isset ( $atributos [self::ESTILO] ) && $atributos [self::ESTILO] != "") {
                $this->cadenaHTML = "<div class='" . $atributos [self::ESTILO] . "'>\n";
            } else {
                $this->cadenaHTML = "<div class='formulario'>\n";
            }
            $this->procesarAtributosForm();
    
        } else {
            $this->cadenaHTML = "</form>\n";
            $this->cadenaHTML .= "</div>\n";
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
    
        if ($tipo == self::INICIO) {
    
            $this->procesarAtributosForm();
    
        } else {
            $this->cadenaHTML = "</form>\n";
        }
    
        return $this->cadenaHTML;
    
    }
    
    private function procesarAtributosFormulario($atributos){
    
        $this->cadenaHTML = "<form ";
    
        if (isset ( $atributos ["id"] )) {
            $this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
        }
    
        if (isset ( $atributos [self::TIPOFORMULARIO] )) {
            $this->cadenaHTML .= "enctype='" . $atributos [self::TIPOFORMULARIO] . "' ";
        }
    
        if (isset ( $atributos [self::METODO] )) {
            $this->cadenaHTML .= "method='" . strtolower ( $atributos [self::METODO] ) . "' ";
        }
    
        if (isset ( $atributos ["action"] )) {
            $this->cadenaHTML .= "action='index.php' ";
        }
    
        if (isset ( $atributos [self::TITULO] )) {
            $this->cadenaHTML .= "title='" . $atributos [self::TITULO] . "' ";
        }else{
            $this->cadenaHTML .= "title='Formulario' ";
        }
    
        $this->cadenaHTML .= "name='" . $atributos ["nombreFormulario"] . "'>\n";
    }
    
    
}