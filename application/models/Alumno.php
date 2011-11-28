<?php
//require_once(realpath(dirname(__FILE__)) . '/Apoderado.php');
//require_once(realpath(dirname(__FILE__)) . '/Seccion.php');
//require_once(realpath(dirname(__FILE__)) . '/Usuario.php');

/**
 * Asiste a Clases Mediante Sistema Web
 */
class Application_Model_Alumno {
	private $idAlumno;
	private $idUsuario;
	private $idSeccion;
	private $idApoderado;
	/**
	 * @AssociationType Apoderado
	 * @AssociationMultiplicity 1
	 */
	private $tiene;
	/**
	 * @AssociationType Seccion
	 * @AssociationMultiplicity 1
	 */
	private $unnamed_Seccion_;
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	/**
	 * Docente
	 */
	public function setAlumno() {
		// Not yet implemented
	}

	/**
	 * Seguridad
	 */
	public function getAlumno() {
		// Not yet implemented
	}

	public function setApoderado() {
		// Not yet implemented
	}

	public function getApoderado() {
		// Not yet implemented
	}

	public function editarAlumno() {
		// Not yet implemented
	}

	public function eliminarAlumno() {
		// Not yet implemented
	}
}
?>