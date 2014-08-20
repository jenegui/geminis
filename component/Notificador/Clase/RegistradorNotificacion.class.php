<?php

namespace component\Notificador\Clase;

class RegistradorNotificacion implements \INotificador {
    
    private $laNotificacion;
    
    
    function datosNotificacionSistema($notificacion) {
        
        $this->laNotificacion = json_decode ( $notificacion );
        
        $continuar = $this->revisarDatos ();
        
        if($continuar){
            $continuar=$this->registrarTransaccion($laNotificacion);
        }
        
      }
    
    private function revisarDatos() {
        
        $campos=array('idProceso','idRemitente','idDestinatario','asunto','descripcion','criticidad','tipoMecanismo');
        
        $resultado=true;
        foreach ($campos as $clave=> $valor){
            
            if(!isset($this->laNotificacion[$valor])){
                $resultado=false;
            }            
        }
        
        if($resultado){
            
            if(($tipoMecanismo==2 && !isset($this->laNotificacion['email'])) 
                    || ($tipoMecanismo==3 && (!isset($this->laNotificacion['celular'])|| !isset($this->laNotificacion['textoSMS'])))){
                $resultado=false;
            }            
            
        }
        
        return $resultado;
    }
    
    private function registrarTransaccion(){
        
    }

}
