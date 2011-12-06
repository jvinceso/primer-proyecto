<?php
class Application_Model_Configuracion extends Zend_Db_Table_Abstract{
    protected $cConfValor;
    protected $cConfTipo;
    protected $tConfDescripcion;
    
    public function getGradosPrimaria(){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from("configuracion")
                ->where("cConfValor = 'P'");
       
        $stmt = $dbAdapter->query($select);
        $result = $stmt->fetchAll();
        if(isset($result)){
            return $result;
        }else{
            return NULL;   
        }
    }
    
   
    
}