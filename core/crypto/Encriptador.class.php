<?php

/**
 * IMPORTANTE: La frase de seguridad predeterminada se encuentra en el archivo: aes.class.php, cambiarla afecta
 * el aplicativo si este depende de variables codificadas con la clave anterior (p.e. si se guardaron datos codificados
 * en la base de datos).
 * 
 */
require_once ("aes.class.php");
require_once ("aesctr.class.php");

class Encriptador {
    
    private static $instance;
    
    // Constructor
    function __construct() {
    
    }
    
    public static function singleton() {
        
        if (! isset ( self::$instance )) {
            $className = __CLASS__;
            self::$instance = new $className ();
        }
        return self::$instance;
    
    }
    
    function codificar_url($cadena, $enlace = "") { /* reemplaza valores + / */
        
        $cadena = rtrim ( strtr ( AesCtr::encrypt ( $cadena, "", 256 ), '+/', '-_' ), '=' );
        return $enlace . "=" . $cadena;
    
    }
    
    /**
     *
     * Método para decodificar la cadena GET para obtener las variables de la petición
     *
     * @param
     *            $cadena
     * @return boolean
     */
    function decodificar_url($cadena) { /* reemplaza valores + / */
        
        $cadena = AesCtr::decrypt ( str_pad ( strtr ( $cadena, '-_', '+/' ), strlen ( $cadena ) % 4, '=', STR_PAD_RIGHT ), "", 256 );
        
        parse_str ( $cadena, $matriz );
        
        foreach ( $matriz as $clave => $valor ) {
            $_REQUEST [$clave] = $valor;
        }
        
        return true;
    
    }
    
    function codificar($cadena, $frase = '') { /* reemplaza valores + / */
        
        return rtrim ( strtr ( AesCtr::encrypt ( $cadena, $frase, 256 ), '+/', '-_' ), '=' );
    
    }
    
    function decodificar($cadena) { /* reemplaza valores + / */
        
        return AesCtr::decrypt ( str_pad ( strtr ( $cadena, '-_', '+/' ), strlen ( $cadena ) % 4, '=', STR_PAD_RIGHT ), "", 256 );
    
    }
    
    function codificarClave($cadena) {
        
        return sha1 ( md5 ( $cadena ) );
    
    }

}

?>
