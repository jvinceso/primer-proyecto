<?php
class Application_Form_FormNuevoAlumno extends Zend_Form{
    
    public function init(){
        $alumno=new Application_Model_Alumno();
        $usuario=new Application_Model_Usuario();
        $apoderado=new Application_Model_Apoderado();
        $grado=new Application_Model_Grado();
        $curso=new Application_Model_Cursos();
        
    }
    
}