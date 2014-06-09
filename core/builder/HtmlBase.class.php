<?php
include_once ("core/manager/Configurador.class.php");

/**
 * Contiene las definiciones de los diferentes controles HTML
 *
 * @author Paulo Cesar Coronado
 * @version 1.0.0.0, 29/12/2011
 * @package framework:BCK:estandar
 * @copyright Universidad Distrital F.J.C
 * @license GPL Version 3.0 o posterior
 *         
 */
class HtmlBase {
    
    var $conexion_id;
    
    var $cuadro_registro;
    
    var $cuadroCampos;
    
    var $cuadro_miniRegistro;
    
    var $cadenaHTML;
    
    var $configuracion;
    
    var $atributos;
    
    var $miConfigurador;
    
    const NOMBRE = self::NOMBRE;
    
    const SELECCION = 'seleccion';
    
    const EVENTO = self::EVENTO;
    
    const DESHABILITADO = 'deshabilitado';
    
    const ANCHO = 'ancho';
    
    const OTRAOPCIONETIQUETA = 'otraOpcionEtiqueta';
    
    const MULTIPLE = 'multiple';
    
    const VALIDAR = 'validar';
    
    const BASEDATOS = 'baseDatos';
    
    /**
     * Nombres de los atributos que se pueden asignar a los controles,
     * se declaran como constantes para facilitar su cambio ya que se utilizan en varias funciones.
     */
    const ID = 'id';
    
    const TIPO = 'tipo';
    
    const ESTILO = 'estilo';
    
    const ESTILOENLINEA = 'estiloEnLinea';
    
    const ESTILOETIQUETA = 'estiloEtiqueta';
    
    const ESTILOCONTENIDO = 'estiloContenido';
    
    const SINDIVISION = 'sinDivision';
    
    const HIDDEN = 'hidden';
    
    const DESHABILITADO = 'deshabilitado';
    
    const SELECCIONADO = 'seleccionado';
    
    const MAXIMOTAMANNO = 'maximoTamanno';
    
    const EVENTO = self::EVENTO;
    
    const ONCLICK = 'onClick';
    
    const TIPOSUBMIT = 'tipoSubmit';
    
    const TABINDEX = 'tabIndex';
    
    const VALOR = 'valor';
    
    const ETIQUETA = 'etiqueta';
    
    const TITULO = 'titulo';
    
    const ESTILOAREA = 'estiloArea';
    
    const TEXTOENRIQUECIDO = 'textoEnriquecido';
    
    const VERIFICARFORMULARIO = 'verificarFormulario';
    
    const NOMBREFORMULARIO = 'nombreFormulario';
    
    const INICIO = 'inicio';
    const TIPOFORMULARIO = 'tipoFormulario';
    const METODO = 'metodo';
    const JQUERYUI = 'jqueryui';
    const LEYENDA = 'leyenda';
    const ENLACE = 'enlace';
    const COLUMNAS = 'columnas';
    const TAMANNO = self::TAMANNO;
    const MENSAJE = 'mensaje';
    const TEXTO = 'texto';
    
    const HTMLTABINDEX = 'tabindex=';
    
    /**
     * Atributos HTML
     * Se definen como constantes para evitar errores al duplicar
     */
    const HTMLNAME = 'name=';
    
    const HTMLTABINDEX = 'tabindex=';
    
    const HTMLVALUE = 'value=';
    
    const HTMLCLASS = 'class=';
    
    const HTMLLABEL = '<label for=';
    
    const HTMLENDLABEL = '</label>\n';
    
    function __construct() {
        
        $this->miConfigurador = Configurador::singleton ();
    
    }
    
    function setAtributos($misAtributos) {
        
        $this->atributos = $misAtributos;
    
    }
    
    public function setConfiguracion($configuracion) {
        
        $this->configuracion = $configuracion;
    
    }   
    

}
?>
