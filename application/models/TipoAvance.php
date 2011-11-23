<?php
require_once(realpath(dirname(__FILE__)) . '/RegistroAvance.php');

class TipoAvance {
	private $idTipoAvance;
	private $decripcion;
	private $valorTipoAvance;
	private $estadoTipoAvance;
	/**
	 * @AssociationType RegistroAvance
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_RegistroAvance_ = array();
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	public function setTipoAvance() {
		// Not yet implemented
	}

	public function getTipoAvance() {
		// Not yet implemented
	}

	public function editarTipoAvance() {
		// Not yet implemented
	}

	public function eliminarTipoAvance() {
		// Not yet implemented
	}
}
?>