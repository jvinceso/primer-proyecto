<?php
require_once(realpath(dirname(__FILE__)) . '/Usuario.php');

class Director extends Usuario {
	private $idDirector;
	private $estado;
	private $idUsuario;

	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}	
	/**
	 * TestAprendizaje,Alumno,Docente
	 */
	public function setDirector() {
		// Not yet implemented
	}

	/**
	 * Docente
	 */
	public function getDirector() {
		// Not yet implemented
	}
}
?>