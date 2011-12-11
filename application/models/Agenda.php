<?php
class Application_Model_Agenda extends Zend_Db_Table_Abstract{
    protected $iAgeIdAgenda;
    
    public function registrarEvento($fechainicio,$fechafin,$visibledocente,$visiblealumno,$visibleapoderado,$titulo,$contenido,$urlAcceso,$Usuarios_iUsuIdUsuario,$curso_iscurso){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->insert("agenda", array(
                'tAgeFechaInicio' => $fechainicio,
                'tAgeFechaFin' => $fechafin,
                'iAgeVisibleDocente' => $visibledocente,
                'iAgeVisibleAlumno' => $visiblealumno,
                'iAgeVisibleApoderado' => $visibleapoderado,
                'tAgeTitulo' => $titulo,
                'tAgeContenido' => $contenido,
                'tAgeUrlAcceso' => $urlAcceso,
                'Usuarios_iUsuIdUsuario' => $Usuarios_iUsuIdUsuario,
                'Cursos_iCursIdCursos' =>$curso_iscurso
                ));
        $id = $dbAdapter->lastInsertId();
        return $id;
    }

    public function actualizaEvento($fechainicio,$fechafin,$visibledocente,$visiblealumno,$visibleapoderado,$titulo,$contenido,$urlAcceso,$Usuarios_iUsuIdUsuario,$curso_iscurso){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->update("agenda", array(
                'tAgeFechaInicio' => $fechainicio,
                'tAgeFechaFin' => $fechafin,
                'iAgeVisibleDocente' => $visibledocente,
                'iAgeVisibleAlumno' => $visiblealumno,
                'iAgeVisibleApoderado' => $visibleapoderado,
                'tAgeTitulo' => $titulo,
                'tAgeContenido' => $contenido,
                'tAgeUrlAcceso' => $urlAcceso,
                ),'Usuarios_iUsuIdUsuario="'.$Usuarios_iUsuIdUsuario.'" and Cursos_iCursIdCursos="'.$curso_iscurso.'"');
        $id = $dbAdapter->lastInsertId();
        return $id;
    }
    
    public function suprimeEvento($idevento){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->delete("agenda", "iAgeIdAgenda=".$idevento);
        
    }
    
    public function listarEventosbyUser($idUsuarioAl){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $tipuser=new Application_Model_TipoUsuario();
        if($tipuser=="2"){
        $stmt=$dbAdapter->query("SELECT *   FROM agenda age 
            INNER JOIN usuarios usu ON usu.iUsuIdUsuario = age.Usuarios_iUsuIdUsuario 
            WHERE usu.iUsuIdUsuario = ".$idUsuarioAl);
        }else if($tipuser=="1"){
            
        }
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }else{
            return NULL;
        }
    }
    
}
?>