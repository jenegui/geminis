<?php
require_once ("Conector.interface.php");
require_once ("mysql.class.php");
require_once ("oci8.class.php");
require_once ("pgsql.class.php");
require_once ("dbms.class.php");

class dbms {

	private $servidor;

	private $db;

	private $usuario;

	private $clave;

	private $enlace;

	private $dbsys;

	private $cadenaSql;

	private $error;

	private $numero;

	private $conteo;

	private $registro;

	private $campo;

	private $miConfigurador;

	/**
	 *
	 * @name db_admin
	 *      
	 */
	function __construct($registro) {

		if (isset ( $registro [0] ["dbsys"] )) {
			$this->configuracion = $registro [0];
			$this->dbsys = $registro [0] ["dbsys"];
		} else {
			$this->configuracion = $registro;
			if (isset ( $registro ['dbsys'] )) {
				$this->dbsys = $registro ['dbsys'];
			} else {
				$this->dbsys = null;
			}
		}
	
	}

	function setDbNombre($nombreDb) {

		$this->db = $nombreDb;
	
	}

	function setDbUsuario($usuarioDb) {

		$this->usuario = $usuarioDb;
	
	}

	function setDbclave($claveDb) {

		$this->clave = $claveDb;
	
	}

	function setDbServidor($servidorDb) {

		$this->servidor = $servidorDb;
	
	}

	function setDbPuerto($servidorDb) {

		$this->servidor = $servidorDb;
	
	}

	function setDbSys($sistema) {

		$this->dbsys = $sistema;
	
	}

	function setEnlace($enlace) {

		if (is_resource ( $enlace )) {
			$this->enlace = $enlace;
		}
	
	}

	function getEnlace() {

		return $this->enlace;
	
	}

	function getRecursoDb() {

		if (isset ( $this->dbsys )) {
			$clase = trim ( $this->dbsys );
			
			$recurso = new $clase ( $this->configuracion );
			
			if ($recurso) {
				return $recurso;
			}
		}
		return false;
	
	}

	function probar_conexion() {

		if ($this->enlace == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	
	} // Fin del método probar_conexion
	function logger($configuracion, $idUsuario, $evento) {

		$this->cadena_sql = "INSERT INTO ";
		$this->cadena_sql .= "" . $configuracion ["prefijo"] . "logger ";
		$this->cadena_sql .= "( ";
		$this->cadena_sql .= "`id_usuario` ,";
		$this->cadena_sql .= " `evento` , ";
		$this->cadena_sql .= "`fecha`  ";
		$this->cadena_sql .= ") ";
		$this->cadena_sql .= "VALUES (";
		$this->cadena_sql .= $idUsuario . ",";
		$this->cadena_sql .= "'" . $evento . "',";
		$this->cadena_sql .= "'" . time () . "'";
		$this->cadena_sql .= ")";
		
		$this->ejecutar_acceso_db ( $this->cadena_sql );
		unset ( $this->db_sel );
		return TRUE;
	
	}

} // Fin de la clase db_admin

?>
