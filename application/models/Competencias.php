<?php
class Application_Model_Competencias extends Zend_Db_Table_Abstract{
    public function getCompetenciasbyIdCursoUnidad($idcursounidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM competencia
                                WHERE iCursoUnidades_IdCursosUnidades = ".$idcursounidad);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getCompetenciabyIdCompetencia($idcompetencia){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM competencia
                                WHERE iComIdCompetencia = ".$idcompetencia);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function registrarCompetencia($idcursounidad, $descripcion, $titulo){
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $dbAdapter->insert("competencia", array(
                    'iCursoUnidades_IdCursosUnidades'     =>  $idcursounidad,
                    'vComDescripcion'     =>  $descripcion,
                    'vComTitulo'     =>  $titulo,
                    'cComEstado' =>  "A",
            ));
    }
}