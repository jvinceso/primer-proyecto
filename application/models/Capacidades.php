<?php
class Application_Model_Capacidades extends Zend_Db_Table_Abstract{
    public function getCapacidadesbyIdCompetencia($idcompetencia){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM capacidades
                                WHERE iCompetencia_iComIdCompetencia = ".$idcompetencia);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getCapacidadbyIdCapacidad($idcapacidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM capacidades
                                WHERE iCapIdCapacidad = ".$idcapacidad);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function registrarCapacidad($idcompetencia, $descripcion, $actitud){
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $dbAdapter->insert("capacidades", array(
                    'iCompetencia_iComIdCompetencia'     =>  $idcompetencia,
                    'tCapDescripcion'     =>  $descripcion,
                    'tCapActitud'     =>  $actitud,
                    'cCapEstado' =>  "A",
            ));
    }
}