<?php
require_once ("mysql.class.php");
require_once ("oci8.class.php");
require_once ("pgsql.class.php");
require_once ("Sql.class.php");

class FabricaDbConexion {

	private $conexiones;
	private $cadenaSql;
	
	
	function __construct() {
		$this->conexiones = array ();
		$this->cadenaSql = new Sql ();
	}
	
	
	function setRecursoDB($nombre, $objeto) {
		if (is_object ( $objeto )) {
			$clase = $objeto->getMotorDB ();
			$registro ["dbdns"] = $objeto->getDireccionServidor ();
			$registro ["dbnombre"] = $objeto->getDb ();
			$registro ['dbpuerto'] = $objeto->getPuerto ();
			$registro ["dbusuario"] = $objeto->getUsuario ();
			$registro ["dbclave"] = $objeto->getClave ();
			$registro ["dbsys"] = $objeto->getMotorDB ();
			
		
			
			$recurso = new $clase ( $registro );
			
			if ($recurso) {
				$this->conexiones [$nombre] = $recurso;
				return true;
			}
		}
		return false;
	}
	
	
	function getRecursoDB($nombre) {
		if (isset ( $this->conexiones [$nombre] )) {
			
			return $this->conexiones [$nombre];
		}
		return false;
	}
	
	
	function getCadenaSql($opcion, $objeto) {
		$this->cadenaSql->sql ( $opcion, $objeto );
		return $this->cadenaSql->getCadenaSql ($opcion,$objeto);
	}
}

?>