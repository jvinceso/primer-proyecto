<?php
require_once(realpath(dirname(__FILE__)) . '/Usuario.php');

/**
 * Guarda Informacion del Docente
 */
class Docente extends Usuario {
	private $idDocente;
	private $especialidad;
	private $seccion;
	private $idUsuario;


	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}	
	/**
	 * Seguridad,Sistema
	 */
	public function setDocente() {
		// Not yet implemented
	}

	/**
	 * Contenidos
	 */
	public function getDocente() {
		// Not yet implemented
	}
}
?>