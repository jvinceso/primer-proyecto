<?php
require_once(realpath(dirname(__FILE__)) . '/Pregunta.php');

class TipoPregunta {
	private $idTIpoPregunta;
	private $descripcion;
	private $valor;
	private $estado;
	/**
	 * @AssociationType Pregunta
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Pregunta_ = array();
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	public function setTipoPregunta() {
		// Not yet implemented
	}

	public function getTipoPregunta() {
		// Not yet implemented
	}

	public function editarTipoPPregunta() {
		// Not yet implemented
	}

	public function eliminarTipoPregunta() {
		// Not yet implemented
	}
}
?>