<?php
require_once(realpath(dirname(__FILE__)) . '/Curso.php');
require_once(realpath(dirname(__FILE__)) . '/Leccion.php');

class CursosLecciones {
	private $idCurso;
	private $idLeccion;
	private $descripcion;
	/**
	 * @AssociationType Curso
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Curso_1020;
	/**
	 * @AssociationType Leccion
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Leccion_1022;

	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}	
	
	public function setCursosLecciones() {
		// Not yet implemented
	}

	public function getCursosLecciones() {
		// Not yet implemented
	}

	public function editarCursosLecciones() {
		// Not yet implemented
	}

	public function eliminarCursosLecciones() {
		// Not yet implemented
	}

	/**
	 * @ReturnType void
	 * @ParamType curso Curso
	 */
	public function setUnnamed_Curso_1020(Curso $curso) {
		$this->unnamed_Curso_1020 = $unnamed_Curso_1020;
	}

	/**
	 * @ReturnType Curso
	 */
	public function getUnnamed_Curso_1020() {
		return $this->unnamed_Curso_1020;
	}

	/**
	 * @ReturnType void
	 * @ParamType leccion Leccion
	 */
	public function setUnnamed_Leccion_1022(Leccion $leccion) {
		$this->unnamed_Leccion_1022 = $unnamed_Leccion_1022;
	}

	/**
	 * @ReturnType Leccion
	 */
	public function getUnnamed_Leccion_1022() {
		return $this->unnamed_Leccion_1022;
	}
}
?>