<?php

namespace registro;

use development\registro\Lenguaje;

class procesarAjax {
    
    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    
    function __construct($lenguaje) {
        
        include_once ("core/builder/FormularioHtml.class.php");
        
        $this->miConfigurador = \Configurador::singleton ();
        
        $this->ruta = $this->miConfigurador->getVariableConfiguracion ( "rutaBloque" );
        
        $this->miFormulario = new \FormularioHtml ();
        
        $this->lenguaje = $lenguaje;
        
        switch ($_REQUEST ['opcion']) {
            
            case '1' :
                
                include ($this->miConfigurador->getVariableConfiguracion ( 'rutaBloque' ) . 'formulario/registrarPagina.php');
                break;
            
            case '2' :
                include ($this->miConfigurador->getVariableConfiguracion ( 'rutaBloque' ) . 'formulario/registrarBloque.php');
                break;
            
            case '3' :
                
                include ($this->miConfigurador->getVariableConfiguracion ( 'rutaBloque' ) . 'formulario/armarPagina.php');
                break;
        
        }
    
    }

}

$miProcesarAjax = new procesarAjax ( $this->lenguaje );


?>