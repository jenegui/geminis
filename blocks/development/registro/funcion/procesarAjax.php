<?php

namespace registro;



class procesarAjax{
    
    var $miConfigurador;
    var $miBloque;


    function __construct(){

        
    $this->miConfigurador=\Configurador::singleton();
            
    switch ($_REQUEST['funcion']){
        
        case 'nombre':
            
            include($this->miConfigurador->getVariableConfiguracion('rutaBloque').'formulario/registrarPagina.php');
            
        
        }
    
    }

}


$miProcesarAjax=new procesarAjax();

?>