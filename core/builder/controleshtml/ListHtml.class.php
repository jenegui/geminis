<?php
/**
 * 
 */


require_once ("core/builder/HtmlBase.class.php");


class ListHTML extends HtmlBase{
    
    
    function listaNoOrdenada($atributos) {
    
        if (isset ( $atributos ['id'] )) {
            $this->cadenaHTML = "<ul id='" . $atributos ['id'] . "' ";
        } else {
            $this->cadenaHTML = "<ul ";
        }        
        
        if(isset ( $atributos ['menu'] ) && $atributos ['menu']){
            $this->cadenaHTML .= "class='listaMenu' ";
        }
        
        $this->cadenaHTML .= ">";
    
        foreach ( $atributos ["items"] as $clave => $valor ) {
            // La clave es la fila, el valor es un arreglo con los datos de cada columna
            // $arreglo[fila][columna] 
            
            $this->cadenaHTML .= '<li ';
            
            if (isset ( $valor ['toolTip'] )) {
                $this->cadenaHTML.= " title='" . $valor ['toolTip'] . "' ";
            }
            
            $this->cadenaHTML .= '>';
    
            $this->procesarValor ( $valor, $atributos, $clave );
    
            $this->cadenaHTML .= "</li>";
        }
    
        $this->cadenaHTML .= "</ul>";
    
        return $this->cadenaHTML;
    
    }
    
    private function procesarValor($valor, $atributos, $clave) {
        
        if(isset ( $atributos ['menu'] ) && $atributos ['menu']){
            $claseEnlace= "class='enlaceMenu' ";
        }else{
            $claseEnlace='';
        }
        
        if (is_array ( $valor )) {
    
            if (isset ( $valor ['icono'] )) {
                $icono = '<span class="ui-accordion-header-icon ui-icon ' . $valor ['icono'] . '"></span>';
            } else {
                $icono = '';
            }
    
            if (isset ( $valor ['enlace'] ) && $atributos ['estilo'] == self::JQUERYUI) {
                $this->cadenaHTML .= "<a  id='pes" . $clave . "' ".$claseEnlace." href='" . $valor ['urlCodificada'] . "'>";
                $this->cadenaHTML .= "<div id='tab" . $clave . "' class='ui-accordion ui-widget ui-helper-reset'>";
                $this->cadenaHTML .= "<span class='ui-accordion-header ui-state-default ui-accordion-icons ui-corner-all'>" . $icono . $valor ['nombre'] . "</span>";
                $this->cadenaHTML .= "</div>";
                $this->cadenaHTML .= "</a>";
            }
        } else {
            // Podría implementarse llamando a $this->enlace
            if (isset ( $atributos ["pestañas"] ) && $atributos ["pestañas"] == "true") {
                $this->cadenaHTML .= "<a id='pes" . $clave . "' ".$claseEnlace." href='#" . $clave . "'><div id='tab" . $clave . "'>" . $valor . "</div></a>";
            }
    
            if (isset ( $atributos ["enlaces"] ) && $atributos ["enlaces"] == "true") {
                $enlace = explode ( '|', $valor );
                $this->cadenaHTML .= "<a href='" . $enlace [1] . "' ".$claseEnlace.">" . $enlace [0] . "</a>";
            }
        }
    
        return true;
    }
    
    
    
}