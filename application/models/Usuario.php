<?php
class Application_Model_Usuario extends Zend_Db_Table_Abstract{
    protected $nombreUsuario;
    protected $clave;
    protected $nombre;
    protected $direccion;
    protected $apellido_Paterno;
    protected $apellido_Materno;
    protected $tipoUsuario;
    protected $estado;
    protected $email;
    protected $dni;
    protected $activo;
    protected $idusuario; 
    protected $_name = 'usuarios';
    protected $_primary = 'iUsuIdUsuario';

    public function __construct(){
    }
    
    public function nuevoUsuario($idusuario,$nombreUsuario,$clave,$nombre,$direccion,$apellido_Paterno,$apellido_Materno,$tipoUsuario,$estado,$email,$dni,$activo){
        $this->idusuario=$idusuario;
        $this->nombreUsuario=$nombreUsuario;
        $this->nombre=$nombre;
        $this->clave=$clave;
        $this->direccion=$direccion;
        $this->apellido_Paterno=$apellido_Paterno;
        $this->apellido_Materno=$apellido_Materno;
        $this->tipoUsuario=$tipoUsuario;
        $this->estado=$estado;
        $this->email=$email;
        $this->dni=$dni;
        $this->activo=$activo;           
        }
    public function setUsuario($idusuario=null,$nombreUsuario=null,$clave=null,$nombre=null,$direccion=null,$apellido_Paterno=null,$apellido_Materno=null,$tipoUsuario=null,$estado=null,$email=null,$dni=null,$activo=null){
        $this->idusuario=$idusuario;
        $this->nombreUsuario=$nombreUsuario;
        $this->nombre=$nombre;
        $this->clave=$clave;
        $this->direccion=$direccion;
        $this->apellido_Paterno=$apellido_Paterno;
        $this->apellido_Materno=$apellido_Materno;
        $this->tipoUsuario=$tipoUsuario;
        $this->estado=$estado;
        $this->email=$email;
        $this->dni=$dni;
        $this->activo=$activo;
    }
    public function getUsarios() {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from("usuarios")
                ->where("cUsuActivo = 'A'");
       
        $stmt = $dbAdapter->query($select);
        $result = $stmt->fetchAll();
        if(isset($result)){
            return $result;
        }else{
            return NULL;   
        }
    }

    public function getUsuariobyId($idUsuario) {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('u' => 'usuarios'))
                ->where('iUsuIdUsuario = ?', $idUsuario);

        $stmt = $dbAdapter->query($select);
        
        $result = $stmt->fetchAll();
        
        return $result;
    }
   
    public function editarUsuario() {
        // Not yet implemented
    }

    public function eliminarUsuario() {
        // Not yet implemented
    }
   
    public function eliminarUsuariobyid($idusuario) {

    }
    public function validarLogin($username, $password){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable( $dbAdapter, 'usuarios', 'vUsuUsuario', 'vUsuClave');
        $authAdapter->setIdentity($username);
        $authAdapter->setCredential(hash_hmac('md5', $password, 'tesis'));
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate( $authAdapter );
        return $result;
    }
    
    public function logout(){
        $userProfileNamespace = new Zend_Session_Namespace('sesion');
        $userProfileNamespace->unLock();
        
        $log = new Application_Model_Logs();
        $log->crearLog('B');
        
        Zend_Session::destroy(true);
    }
    
    public function setIdUsuario($id){
         $this->idusuario = $id;
    }
    
    public function getIdUsuario(){
         return $this->idusuario;
    }
    
    public function getUsuariobyNombreUsuario($nombreUsuario){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('u' => 'usuarios'))
                ->where('vUsuUsuario = ?', $nombreUsuario);

        $stmt = $dbAdapter->query($select);
        
        $result = $stmt->fetchAll();
        
        return $result;
    }
    
    public function getInactivo(){
        $mysession = new Zend_Session_Namespace('sesion');
        if (isset($mysession->actividad)){
            return false;
        }
        else{
            return true;
        }
    }
   
}