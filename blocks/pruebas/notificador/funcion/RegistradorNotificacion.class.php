<?php

namespace pruebas\notificador;

use component\Notificador;
use component\Notificador\Componente;

include_once('component/Notificador/Componente.php');


class RegistradorNotificacion {
    
    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miSql;
    var $conexion;
    
    function __construct($lenguaje, $sql) {
        
        $this->miConfigurador = \Configurador::singleton ();
        $this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
    
    }
    
    function procesarFormulario() {
        
        // 1. Invocar al componente Notificador
        $miComponente=new Componente();
        
        //2. Preparar los datos conforme los espera la interfaz del componente
        
        $campos=array('idProceso','idRemitente','idDestinatario','asunto','descripcion','criticidad','tipoMecanismo');
        
        $resultado=true;
        foreach ($campos as $clave=> $valor){
        
            if(!isset($_REQUEST[$valor])){
                $resultado=false;
                break;
            }else{
                $notificacion[$valor]=$_REQUEST[$valor];
            }
        }
        
        
        $notificacion=json_encode($notificacion);
        $miComponente->datosNotificacionSistema($notificacion);
        
        
        
        
    
    }
    
    function resetForm(){
        foreach($_REQUEST as $clave=>$valor){
             
            if($clave !='pagina' && $clave!='development' && $clave !='jquery' &&$clave !='tiempo'){
                unset($_REQUEST[$clave]);
            }
        }
    }
    
    function getBloque(){
        
        $cadenaSql = $this->miSql->getCadenaSql ( 'buscarBloque' );
        return $this->conexion->ejecutarAcceso ( $cadenaSql, 'busqueda' );        
    }
    
    function setBloque(){
        $cadenaSql = $this->miSql->getCadenaSql ( 'insertarBloque' );
        $this->conexion->ejecutarAcceso ( $cadenaSql, 'insertar' );
        
        $resultado=$this->getBloque();
        
        if(is_array($resultado)){
            //Armar un mensaje codificado en json
            $mensaje=json_encode($resultado);
            
        }
        
        $this->miConfigurador->setVariableConfiguracion('mostrarMensaje',$mensaje);
        $this->miConfigurador->setVariableConfiguracion('tipoMensaje','json');
        /**
         * Después de realizar esto se borran todas las variables relacionadas con este
         * Formulario
        */
        $this->resetForm();
        
        return true;
    }
    
}

$miRegistrador = new RegistradorNotificacion( $this->lenguaje, $this->sql );

$resultado= $miRegistrador->procesarFormulario ();



