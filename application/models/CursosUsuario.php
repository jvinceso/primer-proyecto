<?php 
class Application_Model_CursosUsuario {

    public function setCursoUsuario($idusuario,$idcurso) {
        $curso = new Application_Model_Cursos;
        $res = $curso->verificardocentecurso($idcurso, $idusuario);

        $dbAdapter = Zend_Db_Table::getDefaultAdapter();

        if($res==NULL){
           $dbAdapter->insert('cursosusuarios',
                       array('Cursos_iCursIdCursos'=>$idcurso,
                           'Usuarios_iUsuIdUsuario'=>$idusuario,
                           'tiCursUsuActivo'=>'A',
                           'tiCursUsuFechaRegistro'=>time()
                ));
        }
        else{
            $data = array('tiCursUsuActivo' =>  'A' );   
            $dbAdapter->update('cursosusuarios',$data,'Cursos_iCursIdCursos = ' . $idcurso . ' AND Usuarios_iUsuIdUsuario='.$idusuario);
        }


    }

    public function unsetCursoUsuario($idusuario,$idcurso) {
               $dbAdapter = Zend_Db_Table::getDefaultAdapter();
               $data = array('tiCursUsuActivo' =>  'E' );   
               $dbAdapter->update('cursosusuarios',$data,'Cursos_iCursIdCursos = ' . $idcurso . ' AND Usuarios_iUsuIdUsuario='.$idusuario);
    }

    public function getCursosbyid($idcurso) {
                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                $stmt=$dbAdapter->query("SELECT * FROM cursosusuarios WHERE Cursos_iCursIdCursos=".$idcurso."");
                $result = $stmt->fetchAll();
                if(isset($result)){
                    return $result;
                }else{
                    return NULL;
                }
    }

    public function getAlumnosCursobyIdCurso($idcurso){
        
    }
}
?>