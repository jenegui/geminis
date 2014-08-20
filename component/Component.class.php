<?php

namespace component;


class Component{
    
    /**
     * Función para inicializar el componente
     */
    
    function inicializar(){
        
        
        
    }
    
    /**
     * Para definir las clases que serán 
     */
    
    abstract function entryPoint(){
        
    }
    
    /**
     * Se invoca inmediatamente después que el componente termine de hacer su trabajo y antes
     * de pasar el control a quien lo haya utilizado
     */
    
    function terminar(){
        
        
    } 
    
    
}