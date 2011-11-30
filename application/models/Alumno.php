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
}
?>