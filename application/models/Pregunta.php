<?php
require_once(realpath(dirname(__FILE__)) . '/PreguntaExamen.php');
require_once(realpath(dirname(__FILE__)) . '/TipoPregunta.php');

class Pregunta {
	private $idPregunta;
	private $descripcion;
	private $tipoPregunta;
	private $idTipoPregunta;
	/**
	 * @AssociationType PreguntaExamen
	 * @AssociationMultiplicity 1..*
	 */
	public $unnamed__983 = array();
	/**
	 * @AssociationType TipoPregunta
	 * @AssociationMultiplicity 1
	 */
	private $unnamed_TipoPregunta_;
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	public function setPregunta() {
		// Not yet implemented
	}

	public function getPregunta() {
		// Not yet implemented
	}

	public function editarPregunta() {
		// Not yet implemented
	}

	public function operation2() {
		// Not yet implemented
	}

	public function eliminarPregunta() {
		// Not yet implemented
	}
}
?>