<?php

namespace component\Notificador;

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
    
    function __construct() {
        
        $this->miConfigurador = Configurador::singleton ();
    
    }
    
    function cadena_sql($tipo, $variable = "") {
        
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
            
            case "insertarRegistro" :
                $cadenaSql = "INSERT INTO ";
                $cadenaSql .= $prefijo . "notificador ";
                $cadenaSql .= "( ";
                $cadenaSql .= "`idnotificacion`, ";
                $cadenaSql .= "`idproceso`, ";
                $cadenaSql .= "`idremitente`, ";
                $cadenaSql .= "`iddestinatario`, ";
                $cadenaSql .= "`asunto`, ";
                $cadenaSql .= "`descripcion`, ";
                $cadenaSql .= "`criticidad`, ";
                $cadenaSql .= "`tipoMecanismo`, ";
                $cadenaSql .= "`email`, ";
                $cadenaSql .= "`celular`, ";
                $cadenaSql .= "`sms`, ";
                $cadenaSql .= "`fecha`, ";
                $cadenaSql .= "`estado`, ";
                $cadenaSql .= "`observacionestado` ";
                $cadenaSql .= ") ";
                $cadenaSql .= "VALUES ";
                $cadenaSql .= "( ";
                $cadenaSql .= "NULL, ";
                $cadenaSql .= "'" . $variable ['idProceso'] . "', ";
                $cadenaSql .= "'" . $variable ['idRemitente'] . "', ";
                $cadenaSql .= "'" . $variable ['idDestinatario'] . "', ";
                $cadenaSql .= "'" . $variable ['asunto'] . "', ";
                $cadenaSql .= "'" . $variable ['descripcion'] . "', ";
                $cadenaSql .= "'" . $variable ['criticidad'] . "', ";
                $cadenaSql .= "'" . $variable ['tipoMecanismo'] . "', ";
                $cadenaSql .= "'" . $variable ['email'] . "', ";
                $cadenaSql .= "'" . $variable ['celular'] . "', ";
                $cadenaSql .= "'" . $variable ['sms'] . "', ";
                $cadenaSql .= "'" . time () . "', ";
                $cadenaSql .= "'1', ";
                $cadenaSql .= "'Notificación regular.' ";
                $cadenaSql .= ")";
                
                break;
            
            /**
             * Clausulas genéricas.
             * se espera que estén en todos los formularios
             * que utilicen esta plantilla
             */
            
            case "iniciarTransaccion" :
                $cadenaSql = "START TRANSACTION";
                break;
            
            case "finalizarTransaccion" :
                $cadenaSql = "COMMIT";
                break;
            
            case "cancelarTransaccion" :
                $cadenaSql = "ROLLBACK";
                break;
            
            case "eliminarTemp" :
                
                $cadenaSql = "DELETE ";
                $cadenaSql .= "FROM ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "id_sesion = '" . $variable . "' ";
                break;
            
            case "insertarTemp" :
                $cadenaSql = "INSERT INTO ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "( ";
                $cadenaSql .= "id_sesion, ";
                $cadenaSql .= "formulario, ";
                $cadenaSql .= "campo, ";
                $cadenaSql .= "valor, ";
                $cadenaSql .= "fecha ";
                $cadenaSql .= ") ";
                $cadenaSql .= "VALUES ";
                
                foreach ( $_REQUEST as $clave => $valor ) {
                    $cadenaSql .= "( ";
                    $cadenaSql .= "'" . $idSesion . "', ";
                    $cadenaSql .= "'" . $variable ['formulario'] . "', ";
                    $cadenaSql .= "'" . $clave . "', ";
                    $cadenaSql .= "'" . $valor . "', ";
                    $cadenaSql .= "'" . $variable ['fecha'] . "' ";
                    $cadenaSql .= "),";
                }
                
                $cadenaSql = substr ( $cadenaSql, 0, (strlen ( $cadenaSql ) - 1) );
                break;
            
            case "rescatarTemp" :
                $cadenaSql = "SELECT ";
                $cadenaSql .= "id_sesion, ";
                $cadenaSql .= "formulario, ";
                $cadenaSql .= "campo, ";
                $cadenaSql .= "valor, ";
                $cadenaSql .= "fecha ";
                $cadenaSql .= "FROM ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "id_sesion='" . $idSesion . "'";
                break;
        }
        
        return $cadenaSql;
    
    }
}
?>
