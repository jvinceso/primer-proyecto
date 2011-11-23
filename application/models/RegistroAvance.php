<?php
require_once(realpath(dirname(__FILE__)) . '/TipoAvance.php');
require_once(realpath(dirname(__FILE__)) . '/CursosUsuario.php');

class RegistroAvance {
	private $idRegistroAvance;
	private $descripcion;
	private $idCursosUsuario;
	private $idUsuario;
	private $idTipoAvance;
	/**
	 * @AssociationType TipoAvance
	 * @AssociationMultiplicity 1
	 */
	private $unnamed_TipoAvance_;
	/**
	 * @AssociationType CursosUsuario
	 * @AssociationMultiplicity 1
	 */
	private $unnamed_CursosUsuario_;
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	public function setRegistroAvance() {
		// Not yet implemented
	}

	public function getRegistroAvance() {
		// Not yet implemented
	}
}
?>