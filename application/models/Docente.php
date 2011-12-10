<?php
class Application_Model_Docente extends Zend_Db_Table_Abstract{
    protected $iDocIdDocentes;
    protected $tDocEspecialidad;
    protected $Usuarios_iUsuIdUsuario; 
    
    public function registrarDocente($Usuarios_iUsuIdUsuario,$tDocEspecialidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->insert("docentes", array(
                'Usuarios_iUsuIdUsuario'     =>  $Usuarios_iUsuIdUsuario,
                'tDocEspecialidad'     =>  $tDocEspecialidad
                ));
        $id = $dbAdapter->lastInsertId();
        return $id;
    }
    
    public function listardocentebydni($dni){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
       $stmt= $dbAdapter->query("
SELECT doc.iDocIdDocentes, doc.tDocEspecialidad, usu.vUsuNombre, usu.vUsuApellidoPat, usu.vUsuApellidoMat, usu.cUsuDni
FROM docentes doc
INNER JOIN usuarios usu ON usu.iUsuIdUsuario = doc.Usuarios_iUsuIdUsuario
INNER JOIN tipousuario tipusu ON tipusu.iTiUsuarioIdTipoUsuario = usu.TipoUsuario_iTiUsuarioIdTipoUsuario
WHERE usu.cUsuDni LIKE '".$dni."%' and tipusu.iTiUsuarioIdTipoUsuario='2' ");
       
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;
            }
    }

    public function listardocentebyapellido($apellido){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
       $stmt= $dbAdapter->query("
SELECT usu.iUsuIdUsuario, doc.tDocEspecialidad, usu.vUsuNombre, usu.vUsuApellidoPat, usu.vUsuApellidoMat, usu.cUsuDni
FROM docentes doc
INNER JOIN usuarios usu ON usu.iUsuIdUsuario = doc.Usuarios_iUsuIdUsuario
INNER JOIN tipousuario tipusu ON tipusu.iTiUsuarioIdTipoUsuario = usu.TipoUsuario_iTiUsuarioIdTipoUsuario
WHERE usu.vUsuApellidoPat LIKE '".$apellido."%' and tipusu.iTiUsuarioIdTipoUsuario='2' ");
       
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;
            }
    } 
    
    public function getDocentesbyCurso($idcurso){
          $dbAdapter = Zend_Db_Table::getDefaultAdapter();
          $stmt=$dbAdapter->query("SELECT usu.vUsuNombre, usu.vUsuApellidoPat, usu.vUsuApellidoMat, doc.tDocEspecialidad
                FROM usuarios usu
                INNER JOIN docentes doc ON doc.Usuarios_iUsuIdUsuario = usu.iUsuIdUsuario
                INNER JOIN cursosusuarios cusu ON cusu.Usuarios_iUsuIdUsuario = doc.Usuarios_iUsuIdUsuario
                WHERE usu.TipoUsuario_iTiUsuarioIdTipoUsuario = '2'
                AND cusu.Cursos_iCursIdCursos = '".$idcurso."'
                ");
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;
            }
        }


}
?>