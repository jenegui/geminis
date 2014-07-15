<?php
if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}

$rutaPrincipal = $this->miConfigurador->getVariableConfiguracion ( 'host' ) . $this->miConfigurador->getVariableConfiguracion ( 'site' );

$indice = $rutaPrincipal . "/index.php?";

$directorio = $rutaPrincipal . '/' . $this->miConfigurador->getVariableConfiguracion ( 'bloques' ) . "/menu_principal/imagen/";

$urlBloque = $this->miConfigurador->getVariableConfiguracion ( 'rutaUrlBloque' );

$enlace= $this->miConfigurador->getVariableConfiguracion ( 'enlace' );


?><hr>
<div class="footer">
	<div class="footer_enlaces fleft">
		<div class="footer_logo fleft">
			<br> <img src="<?php echo $urlBloque.'/imagen/'?>logo.jpg">
		</div>
		<!--Grupo de Enlaces -->
		<div class="footer_lista fleft">
			<span class="listaEncabezado">Servicios</span>
			<p>
				<br>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">Página Principal</a>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					/*$variable = "pagina=informacion";
					$variable .= "&imagenLateral=imagenInformacion";
					$variable .= "&tema=informacion";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;*/
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">Sistema de Información</a>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					/*$variable = "pagina=informacion";
					$variable .= "&imagenLateral=imagenInformacion";
					$variable .= "&tema=informacion";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;*/
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">Desarrollo de Software</a>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					/*$variable = "pagina=informacion";
					$variable .= "&imagenLateral=imagenInformacion";
					$variable .= "&tema=informacion";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;*/
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">Servicios Web</a>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					/*$variable = "pagina=informacion";
					$variable .= "&imagenLateral=imagenInformacion";
					$variable .= "&tema=informacion";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;*/
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">Virtualización</a>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					/*$variable = "pagina=informacion";
					$variable .= "&imagenLateral=imagenInformacion";
					$variable .= "&tema=informacion";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;*/
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">Soporte</a>
			</p>
			
		</div>
		<!--Fin del Grupo de Enlaces -->
		<!--Division entre secciones -->
		<div class="footer_division fleft">
			<br> <img src="<? echo $urlBloque.'/imagen/' ?>bg_ulfooter.gif">
		</div>

		<!--Fin division entre secciones -->
		<!--Grupo de Enlaces -->
		<div class="footer_lista fleft">
			<span class="listaEncabezado">Estandarización</span>
			<p>
				<br>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					/*$variable = "pagina=informacion";
					$variable .= "&imagenLateral=imagenInformacion";
					$variable .= "&tema=informacion";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;*/
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">SGSI</a>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					/*$variable = "pagina=informacion";
					$variable .= "&imagenLateral=imagenInformacion";
					$variable .= "&tema=informacion";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;*/
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">Catálogo de Servicos OAS</a>
			</p>
			<p>
				<img src="<? echo $urlBloque.'/imagen/' ?>arrow_footer.gif"> <a
					href="<?
					/*$variable = "pagina=informacion";
					$variable .= "&imagenLateral=imagenInformacion";
					$variable .= "&tema=informacion";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;*/
					$variable = "pagina=index";
					$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable,$enlace );
					echo $indice . $variable;
					?>"
					title="">Acceso e Identidad</a>
			</p>
			<p>
				<br>
			</p>
		</div>
		<!--Fin del grupo de Enlaces -->
		<!--Division entre secciones -->
		<div class="footer_division fleft">
			<br> <img src="<?echo $urlBloque.'/imagen/' ?>bg_ulfooter.gif">
		</div>
		<!--Fin division entre secciones -->
		<!--Mensaje en grupo enlaces -->
		<div class="footer_mensajeLista fleft">
			<p>
				<br>
			</p>
			<p style="padding-right: 0px; text-align: justify;">
				<span class="listaEncabezado">OAS</span>
			</p>
			<p class="textoPie" style="color:#555555">(R)2013.Se autoriza la reproducci&oacute;n total o parcial,
				as&iacute; como su traducci&oacute;n a cualquier idioma.</p>
			<p class="textoPie" style="color:#555555">
				Powered by: SARA Framework<br>
				<a href="http://portalws.udistrital.edu.co/oas">http://portalws.udistrital.edu.co/oas</a>
			</p>
		</div>
		<!--Fin mensaje en grupo enlaces -->
	</div>
	<div class="footer_messages  fleft">
	<p>
		2013. UNIVERSIDAD DISTRITAL Francisco Jos&eacute; de Caldas.<br> Cr 7
		No 40 - 53<br> Tel: 3239300<br> <a
			href="mailto:computo@udistrital.edu.co">computo@udistrital.edu.co</a><br>
		Bogot&aacute;, D.C. - Colombia<br>
	</p>
	<p>La Oficina Asesora de Sistemas tiene como función principal: Planear, proponer e implantar la sistematización de la 
	información de actividades, procesos y tareas institucionales en las diferentes dependencias con miras de agilizar el 
	funcionamiento administrativo, operativo y de planeación de la Universidad Distrital.</p>
<p><br></p>		
	<hr class="hr_divisionPie">
</div>
	<div class="pieImagenes">
	<br>
		<div class="pieMenuImagen">
		      <div class="pieImagen fleft"> <a id="unidistrital" href="http://www.udistrital.edu.co" target="_blank"> <span>Universidad Distrital Francisco Jos&eacute; de Caldas</span> </a> </div>
		      <div class="pieImagen fleft"> <a id="minEducacion" href="http://www.mineducacion.gov.co" target="_blank"> <span>Ministerio de educaci&oacute;n</span> </a> </div>
		      <div class="pieImagen fleft"> <a id="bogota" href="http://www.bogota.gov.co" target="_blank"> <span>Bogot&aacute;</span> </a> </div>
		      <div class="pieImagen fleft"> <a id="segEducacionBogota" href="http://www.sedbogota.edu.co/" target="_blank"> <span>Secretaria de Educaci&oacute;n de Bogot&aacute;</span></a> </div>
		</div>
	<br>
	</div>
</div>

