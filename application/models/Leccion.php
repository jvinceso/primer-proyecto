<?php
require_once(realpath(dirname(__FILE__)) . '/CursosLecciones.php');
require_once(realpath(dirname(__FILE__)) . '/Archivo.php');
require_once(realpath(dirname(__FILE__)) . '/Contenido.php');
require_once(realpath(dirname(__FILE__)) . '/Examen.php');

/**
 * Guarda Información de las Clases
 */
class Leccion {
	private $idLeccion;
	private $nombre;
	private $estado;
	private $metaDato;
	private $fechaCreado;
	/**
	 * @AssociationType 
	 * @AssociationMultiplicity 1..*
	 */
	public $unnamed_CursosLecciones_ = array();
	/**
	 * @AssociationType Archivo
	 */
	private $unnamed_Archivo_;
	/**
	 * @AssociationType Contenido
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Contenido_ = array();
	/**
	 * @AssociationType Examen
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Examen_ = array();

	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}	
	
	public function setLeccion() {
		// Not yet implemented
	}

	public function getLeccion() {
		// Not yet implemented
	}

	public function ModificarLeccion() {
		// Not yet implemented
	}

	/**
	 * Archivo
	 */
	public function eliminarLecciones() {
		// Not yet implemented
	}
}
?>