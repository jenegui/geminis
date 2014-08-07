<?php 
/**
 * IMPORTANTE: Este formulario está utilizando jquery. Por tanto en el archivo ready.php se delaran algunas funciones js
 * que lo complementan.
 */

// Rescatar los datos de este bloque
$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );

// ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
/**
 * Atributos que deben ser aplicados a todos los controles de este formulario. Se utiliza un arreglo
 * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
 * 
 * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
 * $atributos=  array_merge($atributos,$atributosGlobales);
 * 
 * 
 */
$atributosGlobales['campoSeguro']='true';

//-------------------------------------------------------------------------------------------------

// ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
$esteCampo=$esteBloque ['nombre'];
$atributos['id']=$esteCampo;
$atributos['nombre']=$esteCampo;
//Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
$atributos['tipoFormulario']='';
//Si no se coloca, entonces toma el valor predeterminado 'POST'
$atributos['metodo']='POST';
//Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
$atributos['action']='index.php';
$atributos['titulo']=$this->lenguaje->getCadena($esteCampo);
//Si no se coloca, entonces toma el valor predeterminado.
$atributos['estilo']='';
$atributos['marco']=true;
$tab=1;
// ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------

//----------------INICIAR EL FORMULARIO ------------------------------------------------------------
$atributos['tipoEtiqueta']='inicio';
echo $this->miFormulario->formulario($atributos);

//---------------- SECCION: Controles del Formulario -----------------------------------------------

//---------------- CONTROL: Cuadro Lista --------------------------------------------------------

$esteCampo='seleccionar';
$atributos['columnas']=1;
$atributos['nombre']=$esteCampo;
$atributos['id']=$esteCampo;
$atributos['seleccion']=-1;
$atributos['evento']='';
$atributos['deshabilitado']=false;
$atributos['tab']=$tab;
$atributos['tamanno']=1;
$atributos['estilo']='jqueryui';
$atributos['validar']='';
$atributos['limitar']=true;
$atributos['etiqueta']=$this->lenguaje->getCadena ( $esteCampo );
// Valores a mostrar en el control
$matrizItems=array(
        array(1,'Registrar Página'),
        array(2,'Registrar Bloque'),
        array(3,'Diseñar Página')
);

$atributos['matrizItems']=$matrizItems;


// Utilizar lo siguiente cuando no se pase un arreglo:
//$atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
//$atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
$tab++;
echo $this->miFormulario->campoCuadroLista($atributos);
unset($atributos);


// --------------- FIN CONTROL : Cuadro Lista --------------------------------------------------

//----------------  SECCION: División ----------------------------------------------------------
$esteCampo='division1';
$atributos ['id'] = $esteCampo;
$atributos ['estilo'] = 'general';
echo $this->miFormulario->division ( "inicio", $atributos );


//----------------  FIN SECCION: División ----------------------------------------------------------
echo $this->miFormulario->division ( 'fin' );


// ------------------- SECCION: Paso de variables ------------------------------------------------

/**
 * En algunas ocasiones es útil pasar variables entre las diferentes páginas. SARA permite realizar esto a través de tres
 * mecanismos:
 * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
 * la base de datos.
 * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
 * formsara, cuyo valor será una cadena codificada que contiene las variables.
 * (c) a través de campos ocultos en los formularios. (deprecated)
 */

//En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:

// Paso 1: crear el listado de variables
$valorCodificado = "actionBloque=" . $esteBloque ["nombre"];
$valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
$valorCodificado .= "&bloque=" . $esteBloque ["id_bloque"];
$valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
/**
 * SARA permite que los nombres de los campos sean dinámicos. Para ello utiliza la hora en que es creado el formulario para
 * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
 * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
 * (b) asociando el tiempo en que se está creando el formulario
 */ 
$valorCodificado .= "&tiempo=" . $_REQUEST ['tiempo'];
//Paso 2: codificar la cadena resultante
$valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );


$atributos ["id"] = "formSaraData"; // No cambiar este nombre
$atributos ["tipo"] = "hidden";
$atributos ['estilo']='';
$atributos ["obligatorio"] = false;
$atributos ['marco']=true;
$atributos ["etiqueta"] = "";
$atributos ["valor"] = $valorCodificado;
echo $this->miFormulario->campoCuadroTexto ( $atributos );
unset ( $atributos );


// ----------------FIN SECCION: Paso de variables -------------------------------------------------


//---------------- FIN SECCION: Controles del Formulario -------------------------------------------

//----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
//Se debe declarar el mismo atributo de marco con que se inició el formulario.
$atributos['marco']=true;
$atributos['tipoEtiqueta']='fin';
echo $this->miFormulario->formulario($atributos);


?>