<?php

namespace registro;



class procesarAjax{


    function __construct(){
        
    switch ($_REQUEST['funcion']){
        
        case 'nombre':
            
            echo 'Nombre';
            
        
        }
    
    }

}


$miProcesarAjax=new procesarAjax();

?>