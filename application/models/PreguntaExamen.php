<?php
require_once(realpath(dirname(__FILE__)) . '/ExamenAlumno.php');
require_once(realpath(dirname(__FILE__)) . '/Pregunta.php');

class PreguntaExamen {
	private $idPregunta;
	private $idExamen;
	/**
	 * @AssociationType ExamenAlumno
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_ExamenAlumno_1137;
	/**
	 * @AssociationType Pregunta
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Pregunta_1139;
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	public function setPreguntaExamen() {
		// Not yet implemented
	}

	public function getPreguntaEmxmen() {
		// Not yet implemented
	}

	/**
	 * @ReturnType void
	 * @ParamType examenAlumno ExamenAlumno
	 */
	public function setUnnamed_ExamenAlumno_1137(ExamenAlumno $examenAlumno) {
		$this->unnamed_ExamenAlumno_1137 = $unnamed_ExamenAlumno_1137;
	}

	/**
	 * @ReturnType ExamenAlumno
	 */
	public function getUnnamed_ExamenAlumno_1137() {
		return $this->unnamed_ExamenAlumno_1137;
	}

	/**
	 * @ReturnType void
	 * @ParamType pregunta Pregunta
	 */
	public function setUnnamed_Pregunta_1139(Pregunta $pregunta) {
		$this->unnamed_Pregunta_1139 = $unnamed_Pregunta_1139;
	}

	/**
	 * @ReturnType Pregunta
	 */
	public function getUnnamed_Pregunta_1139() {
		return $this->unnamed_Pregunta_1139;
	}
}
?>