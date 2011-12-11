<?php
class Application_Model_CursoUnidad extends Zend_Db_Table_Abstract{
    protected $IdCursosUnidades;
    protected $Cursos_iCursIdCursos;
    protected $Unidades_IdUnidad;
    protected $vNombreUnidad;
    protected $cEstado;
    
    public function listarCursoUnidad($idcurso){        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT * 
                                FROM cursos_unidades curuni
                                INNER JOIN unidades uni ON curuni.Unidades_IdUnidad = uni.IdUnidad
                                WHERE curuni.Cursos_iCursIdCursos = ".$idcurso);

        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }else{
            return "0";   
        }    
    }
    
    public function registrarUnidadesCurso($idcurso){
        $unidades = new Application_Model_Unidades();
        $listaunidades=$unidades->listarUnidades();
        
        foreach($listaunidades as $unidad){
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $dbAdapter->insert("cursos_unidades", array(
                    'Cursos_iCursIdCursos'     =>  $idcurso,
                    'Unidades_IdUnidad'     =>  $unidad['IdUnidad'],
                    'vNombreUnidad'     =>  $unidad['vUniDescripcion'],
                    'cEstado'     =>  "A",
            ));
        }
    }

    public function getunidadCurso($idunidadcurso){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM cursos_unidades curuni
                                INNER JOIN unidades uni ON curuni.Unidades_IdUnidad = uni.IdUnidad
                                WHERE IdCursosUnidades = ".$idunidadcurso);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        }  
    }

    public function setTituloUnidadCurso($idunicurso,$titulo){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
        $data = array('vNombreUnidad' =>  $titulo );   
        $dbAdapter->update('cursos_unidades',$data,'IdCursosUnidades = ' . $idunicurso);
    }
}
?>