<?php
include_once ("core/manager/Configurador.class.php");

/**
 * Contiene las definiciones de los diferentes controles HTML
 *
  * Listado de atributos que se requieren para definir el control:
 * 
 * $atributos['anchoEtiqueta']:        Entero. Define el ancho de la etqiueta en pixeles. 
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
    
    const NOMBRE = 'nombre';
    
    const SELECCION = 'seleccion';
    
    const EVENTO = 'evento';
    
    const DESHABILITADO = 'deshabilitado';
    
    const ANCHO = 'ancho';
    
    const ALTO = 'alto';
    
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
    
    const ESTILOMARCO = 'estiloMarco';
    
    const ESTILOBOTON = 'estiloBoton';
    
    const SINDIVISION = 'sinDivision';
    
    const HIDDEN = 'hidden';
    
    const SELECCIONADO = 'seleccionado';
    
    const MAXIMOTAMANNO = 'maximoTamanno';
    
    const ONCLICK = 'onClick';
    
    const TIPOSUBMIT = 'tipoSubmit';
    
    const TABINDEX = 'tabIndex';
    
    const VALOR = 'valor';
    
    const ETIQUETA = 'etiqueta';
    
    const ANCHOETIQUETA = 'anchoEtiqueta';
    
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
    
    const ENLACECODIFICAR = 'enlaceCodificar';
    
    const COLUMNAS = 'columnas';
    
    const TAMANNO = 'tamanno';
    
    const MENSAJE = 'mensaje';
    
    const TEXTO = 'texto';
    
    
    /**
     * Atributos HTML
     * Se definen como constantes para evitar errores al duplicar
     */
    const HTMLNAME = 'name=';
    
    const HTMLTABINDEX = 'tabindex=';
    
    const HTMLVALUE = 'value=';
    
    const HTMLCLASS = 'class=';
    
    const HTMLLABEL = '<label for=';
    
    const HTMLENDLABEL = '</label>';
    
    function __construct() {
        
        $this->miConfigurador = Configurador::singleton ();
    
    }
    
    function setAtributos($misAtributos) {
        
        $this->atributos = $misAtributos;
    
    }
    
    public function setConfiguracion($configuracion) {
        
        $this->configuracion = $configuracion;
    
    }   
    
    function etiqueta($misAtributos) {
    
        $this->setAtributos ( $misAtributos );
    
        $this->mi_etiqueta = "";
    
        if (! isset ( $this->atributos [self::SINDIVISION] )) {
            if (isset ( $this->atributos [self::ANCHOETIQUETA] )) {
    
                $this->mi_etiqueta .= "<div style='float:left; width:" . $this->atributos [self::ANCHOETIQUETA] . "px' ";
            } else {
                $this->mi_etiqueta .= "<div style='float:left; width:150px' ";
            }
    
            $this->mi_etiqueta .= ">";
        }
    
        $this->mi_etiqueta .= '<label ';
    
        if (isset ( $this->atributos ["estiloEtiqueta"] )) {
            $this->mi_etiqueta .= self::HTMLCLASS . "'" . $this->atributos ["estiloEtiqueta"] . "' ";
        }
    
        $this->mi_etiqueta .= "for='" . $this->atributos [self::ID] . "' >";
        $this->mi_etiqueta .= $this->atributos [self::ETIQUETA] . self::HTMLENDLABEL;
    
        if (isset ( $this->atributos ["etiquetaObligatorio"] ) && $this->atributos ["etiquetaObligatorio"]) {
            $this->mi_etiqueta .= "<span class='texto_rojo texto_pie'>* </span>";
        } else {
            if (! isset ( $this->atributos [self::SINDIVISION] ) && (isset ( $this->atributos [self::ESTILO] ) && $this->atributos [self::ESTILO] != "jqueryui")) {
                $this->mi_etiqueta .= "<span style='white-space:pre;'> </span>";
            }
        }
    
        if (! isset ( $this->atributos [self::SINDIVISION] )) {
            $this->mi_etiqueta .= "</div>\n";
        }
    
        return $this->mi_etiqueta;
    
    }
    

}
?>
