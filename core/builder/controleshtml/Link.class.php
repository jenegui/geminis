<?php

class Link {
    
    function enlace($atributos) {
    
        $this->cadenaHTML = "";
        $this->cadenaHTML .= "<a ";
    
        if (isset ( $atributos ["id"] )) {
            $this->cadenaHTML .= "id='" . $atributos ["id"] . "' ";
        }
    
        if (isset ( $atributos [self::ENLACE] ) && $atributos [self::ENLACE] != "") {
            $this->cadenaHTML .= "href='" . $atributos [self::ENLACE] . "' ";
        }
    
        if (isset ( $atributos ["tabIndex"] )) {
            $this->cadenaHTML .= "tabindex='" . $atributos ["tabIndex"] . "' ";
        }
    
        if (isset ( $atributos [self::ESTILO] ) && $atributos [self::ESTILO] != "") {
    
            if ($atributos [self::ESTILO] == self::JQUERYUI) {
                $this->cadenaHTML .= " class='botonEnlace ui-widget ui-widget-content ui-state-default ui-corner-all' ";
            } else {
    
                $this->cadenaHTML .= "class='" . $atributos [self::ESTILO] . "' ";
            }
        }
        $this->cadenaHTML .= ">\n";
        if (isset ( $atributos ["enlaceTexto"] )) {
            $this->cadenaHTML .= "<span>" . $atributos ["enlaceTexto"] . "</span>";
        }
        $this->cadenaHTML .= "</a>\n";
    
        return $this->cadenaHTML;
    
    }
    
    
    function enlaceWiki($cadena, $titulo = "", $datoConfiguracion, $elEnlace = "") {
    
        if ($elEnlace != "") {
            $enlaceWiki = "<a class='wiki' href='" . $datoConfiguracion ["wikipedia"] . $cadena . "' title='" . $titulo . "'>" . $elEnlace . "</a>";
        } else {
            $enlaceWiki = "<a class='wiki' href='" . $datoConfiguracion ["wikipedia"] . $cadena . "' title='" . $titulo . "'>" . $cadena . "</a>";
        }
        return $enlaceWiki;
    
    }
    
    
}