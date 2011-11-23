<?php
require_once(realpath(dirname(__FILE__)) . '/Leccion.php');
require_once(realpath(dirname(__FILE__)) . '/ExamenAlumno.php');

class Examen {
	private $idExamen;
	private $idContenido;
	private $nombreExamen;
	private $puntuacionEsperada;
	private $instrucciones;
	private $duracion;
	private $idLeccion;
	/**
	 * @AssociationType Leccion
	 * @AssociationMultiplicity 1
	 */
	private $unnamed_Leccion_;
	/**
	 * @AssociationType ExamenAlumno
	 * @AssociationMultiplicity 1..*
	 */
	public $unnamed__984 = array();

	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function setExamen() {
		// Not yet implemented
	}

	public function getExamen() {
		// Not yet implemented
	}

	public function editarExamen() {
		// Not yet implemented
	}

	public function eliminarExamen() {
		// Not yet implemented
	}
}
?>