<?php
class Application_Form_FormNuevoApoderado extends Zend_Form{
    
    public function init(){                
        $this->setAction('/admin/agregarapoderado')->setMethod('post')
             ->setAttrib('id','formLogin');
        
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
                      ->addValidator('stringLength',false,array(5,20,'messages'=>"Entre 5 y 20 caracteres"))
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
                      ->addValidator('regex',true,array('patern'=>'/^[(a-zA-Z0-9@)].+$/',array('regexNotMatch'=>'Solo Letras y numeros')))
                      ->addValidator('stringLength',false,array(5,100,'messages'=>"Entre 5 y 100 caracteres"))
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
        
        $dni = $this->createElement('text', 'dni', array('label' => 'Numero Dni', 'placeholder'=>'8 Dígitos'));
        $dni->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(0-9)]+$/',array('regexNotMatch'=>'Solo Numeros')))
                      ->addValidator('stringLength',false,array(8,8,'messages'=>"DNI se Compone e 8 Carateres"))
                      ->setRequired(true)
                      ->addFilter("StringTrim");
        
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
                      ->addValidator('stringLength',false,array(2,150,'messages'=>"Entre 2 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper")
                      ->addFilter("StringTrim");
        
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
                      ->addValidator('alpha')
                      ->addValidator('stringLength',false,array(5,150,'messages'=>"Entre 5 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper")
                      ->addFilter("StringTrim");
        
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
                      ->addValidator('regex',true,array('patern'=>'/^[(a-z A-Z)Ñ]+$/',array('regexNotMatch'=>'Solo Letras')))
                      ->addValidator('stringLength',false,array(5,150,'messages'=>"Entre 5 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper")
                      ->addFilter("StringTrim");
        
        $apmaterno->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
        
        $btnregistrar=$this->createElement('submit', 'registrar', array('label' => 'Registrar'));
        $btnregistrar->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td'))
                ));    
               
        $this->addElement($nombre)
             ->addElement($appaterno)
             ->addElement($apmaterno)
             ->addElement($dni)
             ->addElement($email)
             ->addElement($nombreusuario)
             ->addElement($clave)
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement($btnregistrar);
    }
}