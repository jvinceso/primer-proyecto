<?php
class Application_Model_Posts extends Zend_Db_Table_Abstract
{
    protected $_name='menu';
    protected $_primary='idMenu';
    
    public function getAll(){
        return $this->fetchAll();
    }
    
}