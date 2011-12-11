<?php
class Application_Model_Conocimiento extends Zend_Db_Table_Abstract{
    public function getConocimientosbyIdCapacidad($idcapacidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM conocimiento
                                WHERE iCapacidad_IdCapacidad = ".$idcapacidad);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getConocimientobyIdConocimiento($idconocimiento){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM conocimiento
                                WHERE iConIdConocimiento = ".$idconocimiento);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function registrarConocimiento($idcapacidad, $descripcion){
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $dbAdapter->insert("conocimiento", array(
                    'iCapacidad_IdCapacidad'     =>  $idcapacidad,
                    'tConDescripcion'     =>  $descripcion,
                    'cConEstado' =>  "A"
            ));
    }
}