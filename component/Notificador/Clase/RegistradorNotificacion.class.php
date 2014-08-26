<?php

namespace component\Notificador\Clase;

use component\Notificador\interfaz\INotificador;

require_once ('component/Notificador/Interfaz/INotificador.php');

class RegistradorNotificacion implements INotificador {
    
    private $laNotificacion;
    var $miConfigurador;
    
    function __construct() {
        
        $this->miConfigurador = \Configurador::singleton ();
    }
    
    function datosNotificacionSistema($notificacion) {
        
        $respuesta = true;
        
        $this->laNotificacion = json_decode ( $notificacion );
        
        if ($this->laNotificacion != NULL) {
            
            $respuesta = $this->revisarDatos ();
            
            if ($respuesta) {
                $respuesta = $this->registrarTransaccion ( $this->laNotificacion );
            }
        } else {
            $respuesta = false;
        }
        return $respuesta;
    
    }
    
    private function revisarDatos() {
        
        $campos = array (
                'idProceso',
                'idRemitente',
                'idDestinatario',
                'asunto',
                'descripcion',
                'criticidad',
                'tipoMecanismo' 
        );
        
        $resultado = true;
        foreach ( $campos as $clave => $valor ) {
            
            if (! isset ( $this->laNotificacion->$valor )) {
                $resultado = false;
            }
        }
        
        if ($resultado) {
            
            $tipoMecanismo = $this->laNotificacion->tipoMecanismo;
            
            if (($tipoMecanismo == 2 && ! isset ( $this->laNotificacion ['email'] )) || ($tipoMecanismo == 3 && (! isset ( $this->laNotificacion ['celular'] ) || ! isset ( $this->laNotificacion ['textoSMS'] )))) {
                $resultado = false;
            }
        
        }
        
        return $resultado;
    }
    
    private function registrarTransaccion() {
        
        $conexion='aplicativo'';
        $esteRecursoDB=$this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        $esteRecursoDB->ejecutarAcceso($cadenaSql,"acceso");
        
        return true;
    }

}
