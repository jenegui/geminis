<?php
$indice = 0;
$estilo [$indice] = "general.css";
$indice ++;
$estilo [$indice] = "estiloCuadrosMensaje.css";
$indice ++;
$estilo [$indice] = "estiloTexto.css";
$indice ++;
$estilo [$indice] = "estiloFormulario.css";
$indice ++;

$host = $this->miConfigurador->getVariableConfiguracion ( "host" );
$sitio = $this->miConfigurador->getVariableConfiguracion ( "site" );

foreach ( $estilo as $nombre ) {
    echo "<link rel='stylesheet' type='text/css' href='" . $host . $sitio . "/theme/basico/css/" . $nombre . "'>\n";
}
?>
