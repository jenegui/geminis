<?php

class SesionSql {
    
    private $prefijoTablas;
    
    var $cadenaSql;
    
    function __construct() {
    
    }
    
    function setPrefijoTablas($valor) {
        
        $this->prefijoTablas = $valor;
    
    }
    
    function getCadenaSql($indice, $parametro = "") {
        
        $this->clausula ( $indice, $parametro );
        if (isset ( $this->cadena_sql [$indice] )) {
            return $this->cadena_sql [$indice];
        }
        return false;
    
    }
    
    private function clausula($indice, $parametro) {
        
        switch ($indice) {
            
            case "seleccionarPagina" :
                $this->cadena_sql [$indice] = "SELECT nivel  FROM " . $this->prefijoTablas . "pagina WHERE  nombre='" . $parametro . "' LIMIT 1";
                break;
            
            case "actualizarSesion" :
                
                $this->cadena_sql [$indice] = "UPDATE " . $this->prefijoTablas . "valor_sesion SET expiracion=" . $parametro ["expiracion"] . " WHERE sesionid='" . $parametro ["sesionId"] . "' ";
                break;
            
            case "borrarVariableSesion" :
                $this->cadena_sql [$indice] = "DELETE FROM " . $this->prefijoTablas . "valor_sesion  WHERE sesionid='" . $parametro ["sesionId"] . " AND variable='" . $parametro ["dato"] . "'";
                break;
            
            case "borrarSesionesExpiradas" :
                $this->cadena_sql [$indice] = "DELETE FROM " . $this->prefijoTablas . "valor_sesion  WHERE  expiracion<" . time ();
                break;
            
            case "borrarSesion" :
                $this->cadena_sql [$indice] = "DELETE FROM " . $this->prefijoTablas . "valor_sesion WHERE sesionid='" . $parametro . "' ";
                break;
            
            case "buscarValorSesion" :
                $this->cadena_sql [$indice] = "SELECT valor, sesionid, variable, expiracion FROM " . $this->prefijoTablas . "valor_sesion WHERE sesionid ='" . $parametro ["sesionId"] . "' AND variable='" . $parametro ["variable"] . "' ";
                break;
            
            case "actualizarValorSesion" :
                $this->cadena_sql [$indice] = "UPDATE " . $this->prefijoTablas . "valor_sesion SET valor='" . $parametro ["valor"] . "', expiracion='" . $parametro ["expiracion"] . "' WHERE sesionid='" . $parametro ["sesionId"] . "' AND variable='" . $parametro ["variable"] . "'";
                break;
            
            case "insertarValorSesion" :
                $this->cadena_sql [$indice] = "INSERT INTO " . $this->prefijoTablas . "valor_sesion ( sesionid, variable, valor, expiracion) VALUES ('" . $parametro ["sesionId"] . "', '" . $parametro ["variable"] . "', '" . $parametro ["valor"] . "', '" . $parametro ["expiracion"] . "' )";
                break;
            
            case "verificarNivelUsuario" :
                $this->cadena_sql [$indice] = "SELECT tipo FROM " . $this->prefijoTablas . "usuario WHERE id_usuario='" . $parametro . "' ";
                break;
            default :
        }
    
    }

}
?>