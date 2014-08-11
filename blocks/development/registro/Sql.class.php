<?php

namespace development\registro;

if (! isset ( $GLOBALS ["autorizado"] )) {
    include ("../index.php");
    exit ();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/connection/Sql.class.php");

// Para evitar redefiniciones de clases el nombre de la clase del archivo sqle debe corresponder al nombre del bloque
// en camel case precedida por la palabra sql

class Sql extends \Sql {
    
    var $miConfigurador;
    
    function getCadenaSql($tipo, $variable = '') {
        
        /**
         * 1.
         * Revisar las variables para evitar SQL Injection
         */
        $prefijo = $this->miConfigurador->getVariableConfiguracion ( "prefijo" );
        $idSesion = $this->miConfigurador->getVariableConfiguracion ( "id_sesion" );
        
        switch ($tipo) {
            
            /**
             * Clausulas específicas
             */
            case 'insertarPagina' :
                $cadenaSql = 'INSERT INTO ';
                $cadenaSql .= $prefijo.'pagina ';
                $cadenaSql .= '( ';
                $cadenaSql .= 'nombre,';
                $cadenaSql .= 'descripcion,';
                $cadenaSql .= 'modulo,';
                $cadenaSql .= 'nivel,';
                $cadenaSql .= 'parametro';
                $cadenaSql .= ') ';
                $cadenaSql .= 'VALUES ';
                $cadenaSql .= '( ';
                $cadenaSql .= '\''.$_REQUEST['nombrePagina'].'\', ';
                $cadenaSql .= '\''.$_REQUEST['descripcionPagina'].'\', ';
                $cadenaSql .= '\''.$_REQUEST['moduloPagina'].'\', ';
                $cadenaSql .= $_REQUEST['nivelPagina'].', ';
                $cadenaSql .= '\''.$_REQUEST['parametroPagina'].'\'';
                $cadenaSql .= ') ';
                break;
            
        
        }
        
        return $cadenaSql;
    
    }
}
?>
