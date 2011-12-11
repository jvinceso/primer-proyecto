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
    protected $sexo;
    protected $idusuario; 
    protected $_name = 'usuarios';
    protected $_primary = 'iUsuIdUsuario';

    public function __construct() {
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
    
    public function buscarNombredeUsuario($nombreUsuario){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('u' => 'usuarios'))
                ->where('vUsuUsuario = ?', $nombreUsuario);

        $stmt = $dbAdapter->query($select);
        
        $result = $stmt->fetchAll();
        
        if(sizeof($result)>0){
                return TRUE;
            }else{
                return FALSE;   
            }
    }
    
    public function buscardniusuario($dni){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('u' => 'usuarios'))
                ->where('cUsuDni = ?', $dni);

        $stmt = $dbAdapter->query($select);
        
        $result = $stmt->fetchAll();
        
        if(sizeof($result)>0){
                return TRUE;
            }else{
                return FALSE;   
            }
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
   
    public function registrarUsuario($vUsuUsuario,$vUsuClave,$vUsuEmail,$cUsuDni,$vUsuNombre, $vUsuApellidoPat, $vUsuApellidoMat, $TipoUsuario_iTiUsuarioIdTipoUsuario, $sexo){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->insert("usuarios", array(
                'vUsuUsuario'     =>  $vUsuUsuario,
                'vUsuClave'     =>  $vUsuClave,
                'vUsuEmail'     =>  $vUsuEmail,
                'cUsuDni'     =>  $cUsuDni,
                'vUsuNombre'     =>  $vUsuNombre,
                'vUsuApellidoPat'     =>  $vUsuApellidoPat,
                'vUsuApellidoMat'     =>  $vUsuApellidoMat,
                'cUsuActivo'     =>  'A',
                'cUsuEstado'     =>  'A',
                'cSexo' =>  $sexo,
                'TipoUsuario_iTiUsuarioIdTipoUsuario'     =>  $TipoUsuario_iTiUsuarioIdTipoUsuario,
            ));
        $id = $dbAdapter->lastInsertId();
        return $id;
    }
    
    public function actualizarFoto($idUsuario,$filename){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
        $data = array('tFoto' =>  $filename );
        $dbAdapter->update('usuarios',$data,'iUsuIdUsuario = ' . $idUsuario);
    }
    
    public function listarUsuarios(){  
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("SELECT usu . * , tip.vDescripcion as tipousuario
                            FROM usuarios usu
                            INNER JOIN tipousuario tip ON usu.TipoUsuario_iTiUsuarioIdTipoUsuario = tip.iTiUsuarioIdTipoUsuario
                            ORDER BY vUsuApellidoPat, vUsuApellidoMat, vUsuNombre, cUsuDni");

        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }else{
            return NULL;   
        }
    }
    
    public function crearTablaUsuarios($data,$page=null,$nroreg=null){
             $contenido = ' 
            <table class="data_table">
                <tbody>
                    <tr class="row_odd">
                        <th>&nbsp;</th>
                        <th>Foto</th>
                        <th>Codigo</th>
                        <th><a href="">Ap. Paterno</a></th>                    
                        <th><a href="">Ap. Materno</a></th>
                        <th><a href="">Nombres</a></th>
                        <th><a href="">Tipo de Usuario</a></th>  
                        <th><a href="">Estado</a></th>
                    </tr>';
        $cont=0;
        foreach ($data as $aux){
            if ($cont % 2){
                $contenido.='<tr class="row_even">';
            }
            else{
                $contenido .= '<tr class="row_odd">';
            }
            $contenido.='
                        <td>
                            <input type="checkbox" name="id" value="'.$aux['iUsuIdUsuario'].'">
                        </td>
                        <td>
                            <center><img src="/'.($aux['tFoto']==NULL? "main/img/unknown.jpg" : $aux['tFoto']).'" width="50px" height="50px"/></center>
                        </td>
                        <td>
                            <center>'.$aux['iUsuIdUsuario'].'</center>
                        </td>
                        <td>
                            <center>'.$aux['vUsuApellidoPat'].'</center>
                        </td>
                        <td>
                            <center>'.$aux['vUsuApellidoMat'].'</center>
                        </td>
                        <td>
                            <center>'.$aux['vUsuNombre'].'</center>
                        </td>
                        <td>
                            <center>'.($aux['tipousuario']=='Alumno'? "<a href='' style='color:blue;'>ALUMNO</a>" : ($aux['tipousuario']=='Docente'? "<a href='' style='color:green;'>DOCENTE</a>" : ($aux['tipousuario']=='Director'? "<a href='' style='color:green;'>DIRECTOR</a>" : ($aux['tipousuario']=='Apoderado'? "<a href='' style='color:red;'>APODERADO</a>" :"<a href='' style='color:black;'>ADMINISTRADOR</a>")))).'</center>
                        </td>
                        <td>
                            <center>';
                            if($page==NULL && $nroreg==NULL){
                                if($aux['cUsuEstado']=='A'){
                                    $contenido.='<a href="" onclick="ActDelCurso('.$aux['iUsuIdUsuario'].',\'I\',event,\'act\');" ><img id="img_4" src="/main/img/icons/16/accept.png" alt="Desactivar" title="Desactivar"></a>';
                                }
                                else{
                                    $contenido.='<a href="" onclick="ActDelCurso('.$aux['iUsuIdUsuario'].',\'A\',event,\'act\');" ><img id="img_4" src="/main/img/icons/16/error.png" alt="Activar" title="Activar"></a>';
                                }
                            }
                            else{
                                if($aux['cUsuEstado']=='A'){
                                    $contenido.='<a href="" onclick="ActDelCurso('.$aux['iUsuIdUsuario'].',\'I\',event,\'act\','.$page.','.$nroreg.');" ><img id="img_4" src="/main/img/icons/16/accept.png" alt="Desactivar" title="Desactivar"></a>';
                                }
                                else{
                                    $contenido.='<a href="" onclick="ActDelCurso('.$aux['iUsuIdUsuario'].',\'A\',event,\'act\','.$page.','.$nroreg.');" ><img id="img_4" src="/main/img/icons/16/error.png" alt="Activar" title="Activar"></a>';
                                }
                            }
                                
            $contenido.='
                           </center>
                        </td>
                    </tr>';
            $cont++;
        }
        
	$contenido .= '</tbody>
                </table>';
         
            return $contenido;
        }

    public function getFotobyIdUsuario($idusuario){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("SELECT tFoto
                                FROM usuarios
                                WHERE iUsuIdUsuario = ".$idusuario);

        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result[0]['tFoto'];
        }else{
            return NULL;   
        }
    }    

    public function getTipoUsuariobyIdUsuario($idUsuario){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('u' => 'usuarios'))
                ->where('vUsuUsuario = ?', $nombreUsuario);

        $stmt = $dbAdapter->query($select);
        
        $result = $stmt->fetchAll();
        if($result!=null){
            return $result[0]['TipoUsuario_iTiUsuarioIdTipoUsuario'];
        }else {
            return NULL;
        }
    }    
    
}