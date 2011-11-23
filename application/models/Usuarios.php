<?php
class Application_Model_Usuarios extends Zend_Db_Table_Abstract
{
    protected $_name='usuarios';
    protected $_primary='iUsuIdUsuario';
    
    public function validar($nombreusuario,$clave){
        $sel=$this->fetchRow("vUsuUsuario='".$nombreusuario."' AND vUsuClave='".$clave."'");
        if (count($sel)==0){
            return false;
        }
        else{
            return true;    
        }
    }
    
}
