<?php

namespace development\registro\funcion;

class RegistradorPagina {
    
    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miSql;
    
    function __construct($lenguaje, $sql) {
        
        $this->miConfigurador = \Configurador::singleton ();
        $this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
    
    }
    
    function procesarFormulario() {
        
        $error = false;
        // 1. Verificar la integridad de las variables        
        if (! isset ( $_REQUEST ['nombrePagina'] ) || 
                ! isset ( $_REQUEST ['descripcionPagina'] ) || 
                ! isset ( $_REQUEST ['moduloPagina'] ) || 
                ! isset ( $_REQUEST ['nivelPagina'] ) || 
                ! isset ( $_REQUEST ['parametroPagina'] )|| 
                $_REQUEST ['nombrePagina']=='' || 
                $_REQUEST ['descripcionPagina'] =='' || 
                $_REQUEST ['moduloPagina']=='' || 
                $_REQUEST ['nivelPagina']=='')
        {
            $error = true;
        }else
        
        {
            $conexion = $this->miConfigurador->fabricaConexiones->getRecursoDB ( 'estructura' );
            if (! $conexion) {
                error_log ( "No se conectó" );
                $error = true;
            }
        }
        
        if ($error == true) {
            $this->miConfigurador->setVariableConfiguracion('mostrarMensaje','errorDatos');
            return false;
        } else {
            
            switch ($_REQUEST ['opcion']) {
                
                case 'registrarPagina' :
                    $cadenaSql = $this->miSql->getCadenaSql ( "insertarPagina" );
                    echo $cadenaSql;
                    exit ();
                    $conexion->ejecutarAcceso ( $cadenaSql, "insertar" );
                    break;
                
                case 'registrarBloque' :
                    $cadenaSql = $this->miFabricaConexiones->getCadenaSql ( "insertarBloque", $this->misDatosConexion->getPrefijo () );
                    $conexion->ejecutarAcceso ( $cadenaSql, "insertar" );
                    break;
            }
        }
    
    }
}

$miRegistrador = new RegistradorPagina ( $this->lenguaje, $this->sql );

echo $miRegistrador->procesarFormulario ();
