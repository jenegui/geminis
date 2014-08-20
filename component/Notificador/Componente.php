<?php
namespace component\Notificador;


class Componente extends Component{
    
    
    
    private $miNotificador;
    
    
    
    //El componente actua como Fachada
    
    public function __construct(\INotificador $notificador)
    {
        $this->miNotificador = $notificador;
    }
    
    
      
    
    
    
}

$miComponente=new Componente();

