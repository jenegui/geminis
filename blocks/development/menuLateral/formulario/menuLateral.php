<?php

$directorio = $this->miConfigurador->getVariableConfiguracion("host");
$directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");


$item = 'desenlace';
$items[$item]['nombre'] = 'Desenlace';
$items[$item]['enlace'] = true; //El li es un enlace directo, dejar false si existe submenus
$items[$item]['icono'] = 'ui-icon-circle-triangle-e'; //El li es un enlace directo
$enlace = 'pagina=desenlace';
$enlace.= '&development=true';
$items[$item]['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlace, $directorio);


$item = 'codificador';
$items[$item]['nombre'] = 'Codificador';
$items[$item]['enlace'] = true; //El <li> es un enlace directo
$items[$item]['icono'] = 'ui-icon-extlink'; //El <li> es un enlace directo
$enlace = 'pagina=codificador';
$enlace.= '&development=true';
$items[$item]['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlace, $directorio);

$item = 'registro';
$items[$item]['nombre'] = 'Registro';
$items[$item]['enlace'] = true; //El <li> es un enlace directo
$items[$item]['icono'] = 'ui-icon-extlink'; //El <li> es un enlace directo
$enlace = 'pagina=registro';
$enlace.= '&development=true';
$items[$item]['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlace, $directorio);

$item = 'constructor';
$items[$item]['nombre'] = 'Constructor';
$items[$item]['enlace'] = true; //El <li> es un enlace directo
$items[$item]['icono'] = 'ui-icon-extlink'; //El <li> es un enlace directo
$enlace = 'pagina=constructor';
$enlace.= '&development=true';
$items[$item]['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlace, $directorio);

$item = 'cruder';
$items[$item]['nombre'] = 'CRUDer';
$items[$item]['enlace'] = true; //El <li> es un enlace directo
$items[$item]['icono'] = 'ui-icon-extlink'; //El <li> es un enlace directo
$enlace = 'pagina=cruder';
$enlace.= '&development=true';
$items[$item]['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlace, $directorio);

$atributos ['id'] = 'menuLateral';
$atributos ['estilo'] = 'jqueryui';
$atributos ["enlaces"]=true;
$atributos['items']=$items;
echo $this->miFormulario->listaNoOrdenada($atributos);

?>