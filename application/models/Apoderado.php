<?php
class Application_Model_Apoderado extends Zend_Db_Table_Abstract{ 
    protected $iApodIdApoderado;
    protected $Usuarios_iUsuIdUsuario;
    
    public function registrarApoderado($Usuarios_iUsuIdUsuario){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->insert("apoderados", array(
                'Usuarios_iUsuIdUsuario'     =>  $Usuarios_iUsuIdUsuario));
        $id = $dbAdapter->lastInsertId();
        return $id;
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