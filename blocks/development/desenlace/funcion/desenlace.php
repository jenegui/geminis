<?php


if (isset ( $_REQUEST ['botonAceptar'] )) {
    
    $this->miConfigurador->fabricaConexiones->crypto->decodificar_url ( $_REQUEST ['campoCadena'] );
    
    echo "<b>Variables</b><br>";
    foreach ( $_REQUEST as $key => $value ) {
        if ($key != 'botonAceptar') {
            echo $key . "=>" . $value . "<br>";
        }
    }
    echo "<hr>";
    if (isset ( $_REQUEST ["pagina"] )) {
        $pagina = $_REQUEST ["pagina"];
        
        $conexion="configuracion";
        $esteRecursoDB=$this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        
        
        echo "<b>P&aacute;gina</b><br><b>" . $pagina . "</b><br>";
        $cadenaSql = "SELECT id_pagina,parametro FROM " . $this->miConfigurador->getVariableConfiguracion('prefijo') . "pagina WHERE nombre='" . $pagina . "' LIMIT 1";
        $registro = $esteRecursoDB->ejecutarAcceso($cadenaSql,'busqueda');
        if ($registro) {
            echo "id_pagina: " . $registro [0] [0] . "<br>";
            echo "parametros: " . $registro [0] [1] . "<br><hr>";
            echo "Bloques que componen esta p&aacute;gina:<br>";
            $prefijo=$this->miConfigurador->getVariableConfiguracion('prefijo');
            
            $cadenaSql = "SELECT ";
            $cadenaSql .= "" . $prefijo . "bloque_pagina.id_bloque, ";
            $cadenaSql .= "" . $prefijo . "bloque_pagina.seccion, ";
            $cadenaSql .= "" . $prefijo . "bloque_pagina.posicion, ";
            $cadenaSql .= "" . $prefijo . "bloque.nombre ";
            $cadenaSql .= "FROM ";
            $cadenaSql .= "" . $prefijo . "bloque_pagina,";
            $cadenaSql .= "" . $prefijo . "bloque ";
            $cadenaSql .= "WHERE ";
            $cadenaSql .= "" . $prefijo . "bloque_pagina.id_pagina='" . $registro [0] [0] . "' ";
            $cadenaSql .= "AND ";
            $cadenaSql .= "" . $prefijo . "bloque_pagina.id_bloque=" . $prefijo . "bloque.id_bloque";
            // echo $cadenaSql."<br>";
           $registro = $esteRecursoDB->ejecutarAcceso($cadenaSql,'busqueda');
            if ($registro) {
                ?>
                    <table border="0" align="center" cellpadding="5" cellspacing="1">
                    	<tr bgcolor="#ECECEC">
                    		<td align="center">id</td>
                    		<td align="center">nombre</td>
                    		<td align="center">secci&oacute;n</td>
                    		<td align="center">posici&oacute;n</td>
                    	</tr>	
                <?
                for($contador = 0; $contador < count ( $registro ); $contador ++) {
                    ?>
                    <tr bgcolor="#ECECEC">
                		<td><? echo $registro[$contador][0] ?></td>
                		<td><? echo $registro[$contador][3] ?></td>
                		<td><? echo $registro[$contador][1] ?></td>
                		<td><? echo $registro[$contador][2] ?></td>
                	</tr>	
                    <?
                }
                ?>
                                </table>
                    <hr>
                    P&aacute;gina generada autom&aacute;ticamente el: <? echo @date("d/m/Y", time()) ?><br>
                    Ambiente de desarrollo para aplicaciones web. - Software amparado por
                    licencia GPL. Copyright (c) 2004-2006.
                    <br>
                    Paulo Cesar Coronado - Universidad Distrital Francisco Jos&eacute; de
                    Caldas.
                    <br>
                    <hr>

<?
            }
        }
    }
}

?>