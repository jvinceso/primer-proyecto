<?php
//require_once(realpath(dirname(__FILE__)) . '/Alumno.php');
//require_once(realpath(dirname(__FILE__)) . '/Usuario.php');

class Application_Model_Apoderado {
	protected $idApoderado;
	protected $idUsuario;
	/**
	 * @AssociationType Alumno
	 * @AssociationMultiplicity 1..*
	 */
	private $tiene = array();

	/**
	 * Seguridad,Sistema
	 */
	private $cn;
	public function __construct()
	{
//		$this->cn = new Db();
	}	 
	public function getApoderado() {
		// Not yet implemented
	}

	public function setApoderado() {
		// Not yet implemented
	}

	public function editarApoderado() {
		// Not yet implemented
	}

	public function eliminarApoderado() {
		// Not yet implemented
	}

	public function actualizarApoderado() {
		// Not yet implemented
	}

	public function setAlumno() {
		// Not yet implemented
	}

	public function getAlumno() {
		// Not yet implemented
	}

        public function listarApoderadobynombre($apellido){
 
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("SELECT ap.iApodIdApoderado, ap.Usuarios_iUsuIdUsuario,usu.vUsuNombre, usu.vUsuApellidoPat, usu.vUsuApellidoMat, usu.cUsuDni
                    FROM apoderados ap
                    INNER JOIN usuarios usu ON usu.iUsuIdUsuario = ap.Usuarios_iUsuIdUsuario
INNER JOIN tipousuario tipusu ON tipusu.iTiUsuarioIdTipoUsuario = usu.TipoUsuario_iTiUsuarioIdTipoUsuario
WHERE usu.vUsuApellidoPat LIKE '".$apellido."%'");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
        }   
        public function listarApoderadobydni($dni){
 
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("SELECT ap.iApodIdApoderado, ap.Usuarios_iUsuIdUsuario, usu.vUsuNombre,usu.vUsuApellidoPat, usu.vUsuApellidoMat, usu.cUsuDni
                    FROM apoderados ap
                    INNER JOIN usuarios usu ON usu.iUsuIdUsuario = ap.Usuarios_iUsuIdUsuario
INNER JOIN tipousuario tipusu ON tipusu.iTiUsuarioIdTipoUsuario = usu.TipoUsuario_iTiUsuarioIdTipoUsuario
WHERE usu.cUsuDni LIKE '".$dni."%'");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
        }         
}
?>