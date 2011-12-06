<?php
class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $idusuario;
//    protected $_primary='iUsuIdUsuario';
    
    public function setIdUsuario($id){
         $this->idusuario = $id;
    }
    
    public function getIdUsuario(){
         return $this->idusuario;
    }
}
