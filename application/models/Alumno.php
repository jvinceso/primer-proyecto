<?php
class Application_Model_Alumno extends Zend_Db_Table_Abstract{
    protected $iAlumIdAlumno;
    protected $Usuarios_iUsuIdUsuario;
    protected $Seccion_iSeccIdSeccion;
    protected $Apoderados_iApodIdApoderado;
    
    public function registrarAlumno($Usuarios_iUsuIdUsuario,$Seccion_iSeccIdSeccion,$Apoderados_iApodIdApoderado){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->insert("alumnos", array(
                'Usuarios_iUsuIdUsuario'     =>  $Usuarios_iUsuIdUsuario,
                'Seccion_iSeccIdSeccion'     =>  $Seccion_iSeccIdSeccion,
                'Apoderados_iApodIdApoderado'     =>  $Apoderados_iApodIdApoderado
                ));
        $id = $dbAdapter->lastInsertId();
        return $id;
    }

    public function listarCursosAlumno($idUsuarioAl){
        $peracademico = new Application_Model_PeriodoAcademico();
        $idperiodoacademico = $peracademico->getPeriodoActualId();
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("SELECT *
                            FROM cursosusuarios curusu
                            INNER JOIN cursos cur ON curusu.Cursos_iCursIdCursos = cur.iCursIdCursos
                            INNER JOIN usuarios usu ON usu.iUsuIdUsuario = curusu.Usuarios_iUsuIdUsuario
                            INNER JOIN seccion secc ON secc.iSeccIdSeccion = cur.Seccion_iSeccIdSeccion
                            INNER JOIN grado gr ON gr.iGradoIdGrado = secc.Grado_iGradoIdGrado
                            INNER JOIN periodoacademico peraca ON peraca.iPerAcaIdPeriodoAcademico = gr.PeriodoAcademico_iPerAcaIdPeriodoAcademico
                            WHERE usu.iUsuIdUsuario = ".$idUsuarioAl." 
                            AND peraca.iPerAcaIdPeriodoAcademico = ".$idperiodoacademico);
        
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }else{
            return NULL;   
        }
    }
}
?>