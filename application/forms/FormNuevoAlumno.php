<?php
class Application_Form_FormNuevoAlumno extends Zend_Form{
    
    public function init(){
        $alumno=new Application_Model_Alumno();
        $usuario=new Application_Model_Usuario();
        $apoderado=new Application_Model_Apoderado();
        $grado=new Application_Model_Grado();
        $curso=new Application_Model_Cursos();
                
        $this->setAction('/admin/agregaralumno')->setMethod('post')
             ->setAttrib('id','formlogin');
        
        $tipousuario=new Application_Model_TipoUsuario();

        $arraygrados=$grado->listarGradosActivos();
        $arraygradostoarray=$includes->query2array($arraygrados, 'iGradoIdGrado', 'vGradoDescripcion');

        $combogrados=$this->createElement('select','cbogrado',
            array(
            'label'        => 'Grado', 
                'placeholder' => 'Seleccionar Grado',
            'autocomplete' => false,
            'multiOptions' => $arraygradostoarray)
        );
        
        $nombreusuario = $this->createElement('text', 'nombreusuario', array('label' => 'Nombre del Usuario', 'placeholder' => 'Máximo 25 caracteres'));
        $nombreusuario->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(a-zA-Z)]+$/',array('regexNotMatch'=>'Solo Letras')))
                      ->addValidator('stringLength',false,array(5,25,'messages'=>"Entre 5 y 25 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper");
        
        $nombreusuario->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
        
        $clave = $this->createElement('password', 'clave', array('label' => 'Contraseña'));
        $clave->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(a-zA-Z 0-9)]+$/',array('regexNotMatch'=>'Solo Letras y numeros')))
                      ->addValidator('stringLength',false,array(5,25,'messages'=>"Entre 5 y 100 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper");
        
        $clave->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));         

        $email = $this->createElement('text', 'email', array('label' => 'Direccion de Correo','placeholder' => 'usuario@dominio.com'));
        $email->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(a-zA-Z 0-9)]+$/',array('regexNotMatch'=>'Solo Letras y numeros')))
                      ->addValidator('stringLength',false,array(5,25,'messages'=>"Entre 5 y 100 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper");
        
        $email->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));  
        
        $dni = $this->createElement('text', 'dni', array('label' => 'Numero Dni'));
        $dni->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(0-9)]+$/',array('regexNotMatch'=>'Solo Numeros')))
                      ->addValidator('stringLength',false,array(8,8,'messages'=>"Dni se  Compone e 8 Carateres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper");
        
        $dni->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));  
        
        $nombre = $this->createElement('text', 'nombre', array('label' => 'Nombre '));
        $nombre->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(a-z A-Z)]+$/',array('regexNotMatch'=>'Solo Letras')))
                      ->addValidator('stringLength',false,array(5,150,'messages'=>"Entre 5 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper");
        
        $nombre->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));    
        
        $appaterno = $this->createElement('text', 'appaterno', array('label' => 'Apellido Paterno '));
        $appaterno->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(a-z A-Z)]+$/',array('regexNotMatch'=>'Solo Letras')))
                      ->addValidator('stringLength',false,array(5,150,'messages'=>"Entre 5 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper");
        
        $appaterno->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));    

        $apmaterno = $this->createElement('text', 'apmaterno', array('label' => 'Apellido Materno '));
        $apmaterno->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(a-z A-Z)]+$/',array('regexNotMatch'=>'Solo Letras')))
                      ->addValidator('stringLength',false,array(5,150,'messages'=>"Entre 5 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper");
        
        $apmaterno->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));     
        
//        $arraytipo=$tipousuario->getTipoUsuario();
//        $tipousuario=$this->createElement('select','cbotipousuario',array(
//            'label'        => 'Tipo de Usuario',
//            'autocomplete' => false,
//            'multiOptions' => $arraytipo,
//            'onChange' => 'cargarseccion();')
//        );
//
//        $tipousuario->setDecorators(array(
//                'ViewHelper',
//                'Description',
//                'Errors',
//                array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
//                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
//                array('Label', array('tag' => 'td')),
//            ));        
        
        $this->addElement($nombre)
             ->addElement($appaterno)
             ->addElement($apmaterno) 
             ->addElement($dni)
             ->addElement($email)
             ->addElement($nombreusuario)
             ->addElement($clave)                
             ->addElement($tipousuario) 
             ->addElement($combogrados)
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement('submit', 'registrar', array('label' => 'Registrar'));
    }    
    
}