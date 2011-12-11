<?php
class Application_Model_Indicadores extends Zend_Db_Table_Abstract{
    public function getIndicadoresbyIdCapacidad($idcapacidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM indicadores
                                WHERE iCapacidad_IdCapacidad = ".$idcapacidad);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getIndicadorbyIdIndicador($idindicador){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM indicadores
                                WHERE iIndIdIndicadores = ".$idindicador);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function registrarIndicador($idcapacidad, $descripcion){
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $dbAdapter->insert("indicadores", array(
                    'iCapacidad_IdCapacidad'     =>  $idcapacidad,
                    'tIndDescripcion'     =>  $descripcion,
                    'cIndEstado' =>  "A"
            ));
    }
}