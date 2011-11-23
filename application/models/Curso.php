<?php
class Application_Model_Curso{
	protected $idCurso;
	protected $nombre;
	protected $fechaCreacion;
	protected $fechaInicio;
	protected $fechaFin;
	protected $descripcion;
	protected $activo;
	/**
	 * @AssociationType 
	 * @AssociationMultiplicity 1..*
	 */
	public $unnamed_CursosUsuario_ = array();
	/**
	 * @AssociationType CursosLecciones
	 * @AssociationMultiplicity 1..*
	 */
	public $unnamed_CursosLecciones_ = array();

	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	
	public function setCurso() {
		// Not yet implemented
	}

	public function getCurso() {
		// Not yet implemented
	}

	public function EditarCurso() {
		// Not yet implemented
	}

	public function EliminarCurso() {
		// Not yet implemented
	}

	/**
	 * Docente,Director
	 */
	public function MatricularAlumno() {
		// Not yet implemented
	}

	/**
	 * Docente,Director
	 */
	public function DesMatricularAlumno() {
		// Not yet implemented
	}

	/**
	 * TestAprendizaje,Alumno,Docente
	 */
	public function PromoverAlumno() {
		// Not yet implemented
	}

	/**
	 * TestAprendizaje,Alumno,Docente
	 */
	public function ReportarCalificaciones() {
		// Not yet implemented
	}

	public function InhabilitarCurso() {
		// Not yet implemented
	}

	/**
	 * Usuario
	 */
	public function DarAltaUsuarios() {
		// Not yet implemented
	}

	/**
	 * Usuario
	 */
	public function DarBajaUsuarios() {
		// Not yet implemented
	}

	/**
	 * Alumno,Lecciones
	 */
	public function GuardarAvancesLecciones() {
		// Not yet implemented
	}

	/**
	 * Alumno,TestAprendizaje
	 */
	public function GuardarAvancesAprendizaje() {
		// Not yet implemented
	}

	/**
	 * Alumno,Docente
	 */
	public function ControlarLecciones() {
		// Not yet implemented
	}

	/**
	 * TestAprendizaje,Alumno,Docente
	 */
	public function ControlarEvluaciones() {
		// Not yet implemented
	}
}
?>