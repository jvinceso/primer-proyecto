<?php
require_once(realpath(dirname(__FILE__)) . '/PreguntaExamen.php');
require_once(realpath(dirname(__FILE__)) . '/Usuario.php');
require_once(realpath(dirname(__FILE__)) . '/Examen.php');

class ExamenAlumno {
	private $idExamenAlumno;
	private $fechacreacion;
	private $horaInicio;
	private $horaFin;
	private $tiempo;
	/**
	 * @AssociationType PreguntaExamen
	 * @AssociationMultiplicity 1..*
	 */
	public $unnamed__983 = array();
	/**
	 * @AssociationType Usuario
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Usuario_1108;
	/**
	 * @AssociationType Examen
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Examen_1110;

	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}	
	
	public function operation() {
		// Not yet implemented
	}

	/**
	 * @ReturnType void
	 * @ParamType usuario Usuario
	 */
	public function setUnnamed_Usuario_1108(Usuario $usuario) {
		$this->unnamed_Usuario_1108 = $unnamed_Usuario_1108;
	}

	/**
	 * @ReturnType Usuario
	 */
	public function getUnnamed_Usuario_1108() {
		return $this->unnamed_Usuario_1108;
	}

	/**
	 * @ReturnType void
	 * @ParamType examen Examen
	 */
	public function setUnnamed_Examen_1110(Examen $examen) {
		$this->unnamed_Examen_1110 = $unnamed_Examen_1110;
	}

	/**
	 * @ReturnType Examen
	 */
	public function getUnnamed_Examen_1110() {
		return $this->unnamed_Examen_1110;
	}
}
?>