<?php

/**
 * $atributo['estilo'] 
 * $atributo['marco']
 * $atributo['columnas']
 * $atributo['etiqueta']
 * $atributo['anchoEtiqueta']
 * $atributo['estiloEtiqueta']
 * $atributo['dobleLinea']: La etiqueta va en una línea diferente a la del control asociado.
 * $atributo['tipo']
 * $atributo['maximoTamanno']
 * $atributo['data-validate'] : Específico si se trabaja con el plugin Ketchup
 * $atributo['validar'] : Específico si se trabajo con el plugin validation-engine
 * $atributo['evento']
 * $atributo['tabIndex']
 * $atributo['name']
 * $atributo['id']
 * $atributo['valor']
 * $atributo['titulo']
 * $atributo['deshabilitado']
 * $atributo['tamanno']
 * 
 */

require_once ("core/builder/HtmlBase.class.php");

class Input  extends HtmlBase {
    
    
    function campoCuadroTexto($atributos) {
       
        $this->cadenaHTML = '';
    
        $final = '';
    
        if (! isset ( $atributos [self::ESTILO] )) {
            $atributos [self::ESTILO] = 'campoCuadroTexto';
        }
    
        if (isset ( $atributos ['marco'] ) && $atributos ['marco']) {
    
            $this->cadenaHTML .= "<div class='" . $atributos [self::ESTILO] . " ";
    
            if (isset ( $atributos [self::COLUMNAS] ) && $atributos [self::COLUMNAS] != "" && is_numeric ( $atributos [self::COLUMNAS] )) {
    
                $this->cadenaHTML .= " anchoColumna" . $atributos [self::COLUMNAS];
            }
    
            $this->cadenaHTML .= "'>\n";
    
            $final = '</div>';
        }
    
        if (isset ( $atributos [self::ETIQUETA] ) && $atributos [self::ETIQUETA] != "") {
            $this->cadenaHTML .= self::etiqueta($atributos );
        }
        if (isset ( $atributos ["dobleLinea"] ) && $atributos ["dobleLinea"]) {
            $this->cadenaHTML .= "<br>";
        }
        $this->cadenaHTML .= $this->cuadro_texto ( $atributos );
    
        $this->cadenaHTML .= $final;
    
        return $this->cadenaHTML;
    
    }
    
    function cuadro_texto($misAtributos) {
    
        $this->setAtributos ( $misAtributos );
        
        $cadena='';
    
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
            $this->mi_cuadro .= ">";
        }
        return $this->mi_cuadro;
    
    }
    
    private function atributosGeneralesCuadroTexto() {
    
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
        
        if(isset($atributos['campoSeguro']) && $atributos['campoSeguro']){
        
            $this->atributos [self::ID]=sha1($this->atributos [self::ID].$_REQUEST['tiempo']);
            $this->atributos [self::NOMBRE]=$this->atributos [self::ID];
        
        }
    
        $cadena .= "id='" . $this->atributos [self::ID] . "' ";
        
        if ($this->atributos [self::NOMBRE] != "") {
            $cadena .= self::HTMLNAME . "'" . $this->atributos [self::NOMBRE] . "' ";
        } else {
            $cadena .= self::HTMLNAME . "'" . $this->atributos [self::ID] . "' ";
        }
    
        if (isset ( $this->atributos [self::VALOR] )) {
            $cadena .= self::HTMLVALUE . "'" . $this->atributos [self::VALOR] . "' ";
        }
    
        if (isset ( $this->atributos [self::TAMANNO] )) {
            $cadena .= "size='" . $this->atributos [self::TAMANNO] . "' ";
        } else {
            $cadena .= "size='50' ";
        }
    
        return $cadena;
    
    }
    
    private function atributoClassCuadroTexto() {
    
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
    
    
    function campoFecha($atributos) {
    
        if (isset ( $atributos [self::ESTILO] ) && $atributos [self::ESTILO] != "") {
            $this->cadenaHTML = "<div class='" . $atributos [self::ESTILO] . "'>\n";
        } else {
            $this->cadenaHTML = "<div class='campoFecha'>\n";
        }
        $this->cadenaHTML .= $this->etiqueta ( $atributos );
        $this->cadenaHTML .= "<div style='display:table-cell;vertical-align:top;float:left;'><span style='white-space:pre;'> </span>";
        $this->cadenaHTML .= $this->cuadro_texto ( $this->configuracion, $atributos );
        $this->cadenaHTML .= "</div>";
        $this->cadenaHTML .= "<div style='display:table-cell;vertical-align:top;float:left;'>";
        $this->cadenaHTML .= "<span style='white-space:pre;'> </span><img src=\"" . $this->configuracion ["host"] . $this->configuracion ["site"] . $this->configuracion ["grafico"] . "/calendarito.jpg\" ";
        $this->cadenaHTML .= "id=\"imagen" . $atributos ["id"] . "\" style=\"cursor: pointer; border: 0px solid red;\" ";
        $this->cadenaHTML .= "title=\"Selector de Fecha\" alt=\"Selector de Fecha\" onmouseover=\"this.style.background='red';\" onmouseout=\"this.style.background=''\" />";
        $this->cadenaHTML .= "</div>";
        $this->cadenaHTML .= "</div>\n";
    
        return $this->cadenaHTML;
    
    }
    
    
    
    
    
    
    
    
    
    
    
}