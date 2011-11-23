<?php
require_once(realpath(dirname(__FILE__)) . '/Leccion.php');

class Contenido {
	private $idContenido;
	private $nombreContenido;
	private $descripcionContenido;
	private $idContenidoPadre;
	private $estado;
	private $publicado;
	private $idLeccion;
	/**
	 * @AssociationType Leccion
	 * @AssociationMultiplicity 1
	 */
	private $unnamed_Leccion_;
	/**
	 * @AssociationType Contenido
	 */
	private $unnamed_Contenido_;
	/**
	 * @AssociationType Contenido
	 */
	private $unnamed_Contenido_1000;

		private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function setContenido() {
		// Not yet implemented
	}

	public function getContenido() {
		// Not yet implemented
	}

	public function editarContenido() {
		// Not yet implemented
	}

	public function eliminarContenido() {
		// Not yet implemented
	}
}
?>