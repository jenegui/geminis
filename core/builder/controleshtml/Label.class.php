<?php
class Label{
    
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
}