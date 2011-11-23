<?php
require_once(realpath(dirname(__FILE__)) . '/Leccion.php');

class Archivo {
	private $idArchivo;
	private $rutaArchivo;
	private $fechaCreacion;
	private $descripcion;
	private $idUsuario;
	private $tipoArchivo;
	private $idLecciones;
	/**
	 * @AssociationType Leccion
	 */
	private $unnamed_Leccion_;
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	public function setArchivo() {
		// Not yet implemented
	}

	public function getArchivo() {
		// Not yet implemented
	}

	public function editarArchivo() {
		// Not yet implemented
	}

	public function eliminarArchivo() {
		// Not yet implemented
	}

	/**
	 * Docente,Seguridad
	 */
	public function AlojarArchivoServidor() {
		// Not yet implemented
	}

	/**
	 * Alumno,Seguridad
	 */
	public function DescargarArchivo() {
		// Not yet implemented
	}

	public function VisualizarArchivo() {
		// Not yet implemented
	}

	/**
	 * Lecciones,Usuario
	 */
	public function ListarArchivos() {
		// Not yet implemented
	}

	public function ConvertirContenido() {
		// Not yet implemented
	}

	public function VerificarContenido() {
		// Not yet implemented
	}

	public function VerificarEstado() {
		// Not yet implemented
	}
}
?>