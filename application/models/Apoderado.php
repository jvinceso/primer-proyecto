<?php
//require_once(realpath(dirname(__FILE__)) . '/Alumno.php');
//require_once(realpath(dirname(__FILE__)) . '/Usuario.php');

class Application_Model_Apoderado {
	private $idApoderado;
	private $idUsuario;
	/**
	 * @AssociationType Alumno
	 * @AssociationMultiplicity 1..*
	 */
	private $tiene = array();

	/**
	 * Seguridad,Sistema
	 */
	private $cn;
	public function __construct()
	{
//		$this->cn = new Db();
	}	 
	public function getApoderado() {
		// Not yet implemented
	}

	public function setApoderado() {
		// Not yet implemented
	}

	public function editarApoderado() {
		// Not yet implemented
	}

	public function eliminarApoderado() {
		// Not yet implemented
	}

	public function actualizarApoderado() {
		// Not yet implemented
	}

	public function setAlumno() {
		// Not yet implemented
	}

	public function getAlumno() {
		// Not yet implemented
	}
}
?>