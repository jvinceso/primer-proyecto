<?php
class Application_Model_Menu extends Zend_Db_Table_Abstract{
    
    public function getMenu($tipo){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('m' => 'menu'))
                ->where('tipo = ?', $tipo)
                ->order('idMenu');

        $stmt = $dbAdapter->query($select);
        $result = $stmt->fetchAll();
        
        return $result;
    }
}