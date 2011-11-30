<?php
class Application_Model_CursosUsuario {
	
	public function setCursoUsuario($idusuario,$idcurso) {
           $dbAdapter = Zend_Db_Table::getDefaultAdapter();
           $dbAdapter->insert('cursosusuarios',
                   array('Cursos_iCursIdCursos'=>$idcurso,
                       'Usuarios_iUsuIdUsuario'=>$idusuario,
                       'tiCursUsuActivo'=>'A'
                       )
                   );
	}

	public function unsetCursoUsuario($idusuario,$idcurso) {
           $dbAdapter = Zend_Db_Table::getDefaultAdapter();
           $dbAdapter->update('cursosusuarios',
                   array('Cursos_iCursIdCursos=?'=>$idcurso,
                       'Usuarios_iUsuIdUsuario=?'=>$idusuario
                       )
                   );
	}        

	public function getCursosbyid($idcurso) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("SELECT Cursos_iCursIdCursos FROM cursosusuarios WHERE Cursos_iCursIdCursos=".$idcurso."");
            $result = $stmt->fetchAll();
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            } 
	}

        
	public function editarCursoUsuario() {
		// Not yet implemented
	}

	public function eliminarCursoUsuario() {
	}

	public function AgregarUsuario() {
		// Not yet implemented
	}

	public function EliminarUsuario() {
		// Not yet implemented
	}
        


}
?>
