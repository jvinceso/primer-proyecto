<?php
require_once(realpath(dirname(__FILE__)) . '/RegistroAvance.php');
require_once(realpath(dirname(__FILE__)) . '/Curso.php');
require_once(realpath(dirname(__FILE__)) . '/Usuario.php');

class CursosUsuario {
	private $idcurso;
	private $idusuario;
	private $activoUsuario;
	private $nivelCompletado;
	private $procentajeAvance;
	private $calificacionUsuario;
	private $fechainicio;
	private $fechafin;
	/**
	 * @AssociationType RegistroAvance
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_RegistroAvance_ = array();
	/**
	 * @AssociationType Curso
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Curso_1067;
	/**
	 * @AssociationType Usuario
	 * @AssociationMultiplicity 1..*
	 */
	private $unnamed_Usuario_1069;

	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}	
	
	public function setCursoUsuario() {
		// Not yet implemented
	}

	public function getCursoUsuario() {
		// Not yet implemented
	}

	public function editarCursoUsuario() {
		// Not yet implemented
	}

	public function eliminarCursoUsuario() {
		// Not yet implemented
	}

	public function AgregarUsuario() {
		// Not yet implemented
	}

	public function EliminarUsuario() {
		// Not yet implemented
	}

	/**
	 * @ReturnType void
	 * @ParamType curso Curso
	 */
	public function setUnnamed_Curso_1067(Curso $curso) {
		$this->unnamed_Curso_1067 = $unnamed_Curso_1067;
	}

	/**
	 * @ReturnType Curso
	 */
	public function getUnnamed_Curso_1067() {
		return $this->unnamed_Curso_1067;
	}

	/**
	 * @ReturnType void
	 * @ParamType usuario Usuario
	 */
	public function setUnnamed_Usuario_1069(Usuario $usuario) {
		$this->unnamed_Usuario_1069 = $unnamed_Usuario_1069;
	}

	/**
	 * @ReturnType Usuario
	 */
	public function getUnnamed_Usuario_1069() {
		return $this->unnamed_Usuario_1069;
	}
}
?>