<?php
require_once ('configDesenlace.class.php');
require_once ("../connection/FabricaDbConexion.class.php");
require_once ('DatoConexion.php');

class RegistradorElemento {
    
    var $miSql;
    
    var $miConfigurador;
    
    var $misDatosConexion;
    
    var $miFabricaConexiones;
    
    function __construct() {
        
        $this->miSql = new Sql ();
        $this->miConfigurador = ConfiguracionDesenlace::singleton ();
        $this->miConfigurador->variable ();
        
        $this->misDatosConexion = new DatoConexion ();
        $this->misDatosConexion->setDatosConexion ( $this->miConfigurador->getConf () );
        
        $this->miFabricaConexiones = new FabricaDbConexion ();
        
        $this->miFabricaConexiones->setRecursoDB ( "principal", $this->misDatosConexion );
    
    }
    
    function formRegistrarPagina() {
        
        $cadenaHTML = "<div id='registrarPagina' class='marcoFormulario'>";
        $cadenaHTML .= "<form method='post'>";
        $cadenaHTML .= "<label for='nombrePagina' >Nombre de la página:</label>";
        $cadenaHTML .= "<input type='text' name='nombrePagina' id='nombrePagina' /><br>";
        $cadenaHTML .= "<label for='descripcionPagina'>Descripción:</label>";
        $cadenaHTML .= "<textarea rows='4' cols='50'name='descripcionPagina' id='descripcionPagina'></textarea><br>";
        $cadenaHTML .= "<label for='moduloPagina'>Módulo al que pertenece:</label>";
        $cadenaHTML .= "<input type='text' name='moduloPagina' id='moduloPagina' />";
        $cadenaHTML .= "<label for='nivelPagina'>Nivel de acceso:</label>";
        $cadenaHTML .= "<input type='text' name='nivelPagina' id='nivelPagina' />";
        $cadenaHTML .= "<label for='parametroPagina'>Parámetros predeterminados:</label>";
        $cadenaHTML .= "<input type='text' name='parametroPagina' id='parametroPagina' />";
        $cadenaHTML .= "<div class='marcoBoton'>";
        $cadenaHTML .= "<button type='submit'>Guardar</button>";
        $cadenaHTML .= "<input type='hidden' name='action' id='action' value='pagina'>";
        $cadenaHTML .= "</div>";
        $cadenaHTML .= "</form>";
        $cadenaHTML .= "</div>";
        
        return $cadenaHTML;
    
    }
    
    function formRegistrarBloque() {
        
        $cadenaHTML = "<div id='registrarBloque'  class='marcoFormulario'>";
        $cadenaHTML .= "<form  method='post'>";
        $cadenaHTML .= "<label for='nombreBloque' >Nombre del Bloque:</label>";
        $cadenaHTML .= "<input type='text' name='nombreBloque' id='nombreBloque' /><br>";
        $cadenaHTML .= "<label for='descripcionBloque'>Descripción:</label>";
        $cadenaHTML .= "<textarea rows='4' cols='50'name='descripcionBloque' id='descripcionBloque'></textarea><br>";
        $cadenaHTML .= "<label for='grupoBloque'>Grupo del Bloque:</label>";
        $cadenaHTML .= "<input type='text' name='grupoBloque' id='grupoBloque' />";
        $cadenaHTML .= "<div class='marcoBoton'>";
        $cadenaHTML .= "<button type='submit'>Guardar</button>";
        $cadenaHTML .= "<input type='hidden' name='action' id='action' value='bloque'>";
        $cadenaHTML .= "</div>";
        $cadenaHTML .= "</form>";
        $cadenaHTML .= "</div>";
        
        return $cadenaHTML;
    
    }
    
    function formAsociarBloque() {
        
        $cadenaHTML = "<div id='seleccionarPagina' class='marcoDisenno'>";
        
        $cadenaHTML .= "</div>";
        
        $cadenaHTML .= "<div id='disennarPagina' class='marcoDisenno'>";
        $cadenaHTML .= "<form  method='post'>";
        $cadenaHTML .= "<div class='seccionA'>";
        $cadenaHTML .= "<input class='seccion' type='text' name='seccionA' id='seccionA' />";
        $cadenaHTML .= "</div>";
        $cadenaHTML .= "<div class='seccionB'>";
        $cadenaHTML .= "<input class='seccion' type='text' name='seccionB' id='seccionB' />";
        $cadenaHTML .= "</div>";
        $cadenaHTML .= "<div class='seccionC'>";
        $cadenaHTML .= "<input class='seccion' type='text' name='seccionC' id='seccionC' />";
        $cadenaHTML .= "</div>";
        $cadenaHTML .= "<div class='seccionD'>";
        $cadenaHTML .= "<input class='seccion' type='text' name='seccionD' id='seccionD' />";
        $cadenaHTML .= "</div>";
        $cadenaHTML .= "<div class='seccionE'>";
        $cadenaHTML .= "<input class='seccion' type='text' name='seccionE' id='seccionE' />";
        $cadenaHTML .= "<input type='hidden' name='action' id='action' value='disenno'>";
        $cadenaHTML .= "</div>";
        $cadenaHTML .= "</form>";
        $cadenaHTML .= "</div>";
        
        return $cadenaHTML;
    
    }
    
    function formSeleccionarAccion() {
        
        $cadenaHTML = "<div class='marcoBoton'>";
        $cadenaHTML .= "<form  method='post'>";
        $cadenaHTML .= "<select id='seleccionador'>";
        $cadenaHTML .= "<option>Seleccionar actividad...</option>";
        $cadenaHTML .= "<option value='pagina'>Registrar Página</option>";
        $cadenaHTML .= "<option value='bloque'>Registrar Bloque</option>";
        $cadenaHTML .= "<option value='disennarPagina'>Diseñar Página</option>";
        $cadenaHTML .= "</select>";
        $cadenaHTML .= "<input type='hidden' name='action' id='action' value='true'>";
        $cadenaHTML .= "</form>";
        $cadenaHTML .= "</div>";
        
        return $cadenaHTML;
    
    }
    
    function procesarFormulario($opcion) {
        
        $conexion = $this->miFabricaConexiones->getRecursoDB ( 'principal' );
        
        if (! $conexion) {
            error_log ( "No se conectó" );
            return false;
        }
        
        switch ($opcion) {
            
            case 'pagina' :
                $cadenaSql = $this->miFabricaConexiones->getCadenaSql ( "insertarPagina", $this->misDatosConexion->getPrefijo () );
                $conexion->ejecutarAcceso ( $cadenaSql, "insertar" );
                break;
            
            case 'bloque' :
                $cadenaSql = $this->miFabricaConexiones->getCadenaSql ( "insertarBloque", $this->misDatosConexion->getPrefijo () );
                $conexion->ejecutarAcceso ( $cadenaSql, "insertar" );
                break;
        }
    
    }
    
    function buscarDatos() {
    
    }

}

?>