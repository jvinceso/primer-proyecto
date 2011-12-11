<?php
class Application_Form_FormNuevoAlumno extends Zend_Form{
    
    public function init(){                
        $seccion = new Application_Model_Seccion();
        $array = $seccion->listarSeccionesPeriodoActualActivos();
        $include = new Application_Model_Includes();
        //$q2a=$include->query2array($array, 'iSeccIdSeccion','vSeccDescripcion');
        $q2a=$include->querytoeach($array,"iSeccIdSeccion");
      
        $validator = new Zend_Validate_InArray($q2a); 
        $validator->setHaystack($q2a);
        $validator->setMessages( array(
        Zend_Validate_InArray::NOT_IN_ARRAY =>
                //'El string \'%value%\'  no se encuentra'
                'Eliga una sección'
        ));
        
        $this->setAction('/admin/agregaralumno')->setMethod('post')
             ->setAttrib('id','formLogin')
             ->setAttrib('enctype', 'multipart/form-data');
        
        
        $nombreusuario = $this->createElement('text', 'nombreusuario', array('label' => 'Nombre del Usuario', 'placeholder' => 'Máximo 25 caracteres'));
        $nombreusuario->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('alpha')
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
                      ->addFilter('alnum',array('allowwhitespace' => true))
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
        
        $dniapo = $this->createElement('text', 'dniapo', array('label' => 'DNI Apoderado', 'disabled'=>true));
        $dniapo->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(0-9)]+$/',array('regexNotMatch'=>'Solo Numeros')))
                      ->addValidator('stringLength',false,array(8,8,'messages'=>"DNI se Compone e 8 Carateres"))
                      ->addFilter("StringTrim");
        
        $dniapo->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
        
        $nombreapo = $this->createElement('text', 'nombreapo', array('label' => 'Nombre del Apoderado', 'disabled'=>true));
        $nombreapo->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(a-z A-Z)]+$/',array('regexNotMatch'=>'Solo Letras')))
                      ->addValidator('stringLength',false,array(2,150,'messages'=>"Entre 2 y 150 caracteres"))
                      ->addFilter("StringToUpper")
                      ->addFilter("StringTrim");
        
        $nombreapo->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
        
        $idapoderado = $this->createElement('text', 'idapoderado', array('label' => 'Id del Apoderado', 'disabled'=>true));
        $idapoderado->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('regex',true,array('patern'=>'/^[(0-9)]+$/',array('regexNotMatch'=>'Solo Numeros')))
                      ->addValidator('stringLength',false,array(1,8,'messages'=>"Elegir DNI"))
                      ->addFilter("StringTrim");
        
        $idapoderado->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
        
        // creating object for Zend_Form_Element_File
         
        $doc_file = new Zend_Form_Element_File('foto');
        $doc_file->setLabel('Foto: ')
                 ->setRequired(true)
                 ->setDestination('main/fotos')
                 ->addValidator('Extension', false, 'jpg,png,gif')
                 ->addValidator('Size', false, 5120000);//5Mb
        $doc_file->setDecorators(
                array(array('Description', array('tag' => 'p', 'class' => 'description', 'escape' => false)),
                array('File'),
                array('Errors'),
                array('HtmlTag', array('tag' => 'div')),
                array('Label')));
        
        $nombre = $this->createElement('text', 'nombre', array('label' => 'Nombre '));
        $nombre->addValidator('notEmpty',true,array('messages'=>array('isEmpty'=>'Campo Requerido')))
                      ->addValidator('stringLength',false,array(2,150,'messages'=>"Entre 2 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper")
                      ->addFilter('alpha',array('allowwhitespace' => true))
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
                      ->addValidator('stringLength',false,array(2,150,'messages'=>"Entre 2 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper")
                      ->addFilter('alpha',array('allowwhitespace' => true))
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
                      ->addValidator('stringLength',false,array(2,150,'messages'=>"Entre 2 y 150 caracteres"))
                      ->setRequired(true)
                      ->addFilter("StringToUpper")
                      ->addFilter('alpha',array('allowwhitespace' => true))
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
        
        $btnapoderado=$this->createElement('button', 'buscar', array('label' => 'Buscar Apoderado','onclick'=>'buscaapoderado();'));
        $btnapoderado->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td'))
                )); 
        
        
        $gradosactuales = new Application_Model_Grado();
        $includes=new Application_Model_Includes();
        $arraygrados=$gradosactuales->listarGradosActivos();
        $arraygradostoarray=$includes->query2array($arraygrados, 'iGradoIdGrado', 'vGradoDescripcion');

        $grado=$this->createElement('select','cbogrado',array(
            'label'        => 'Grado',
            'autocomplete' => false,
            'multiOptions' => $arraygradostoarray,
            'onChange' => 'cargarseccion();')
        );

        $grado->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
            ));
        
        $seccion=$this->createElement('select','cboseccion',array(
            'label'        => 'Seccion',
            'multiOptions' => array("0"=>"Seleccionar Sección"))
        ); 
        $seccion->addValidator($validator);
        $seccion->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido')));
        $seccion->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
            ));
        
        $sexo = $this->createElement('radio', 'sexo', array('value'=>'M', 'checked'=>'true', 'Label'=>'Sexo'));
        $sexo->addMultiOptions(array(
            'M' => 'Masculino',
            'F' => 'Femenino')); 
        
        $sexo->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
        $idapo = $this->createElement('hidden', 'idapo');
        
         
        $this->addElement($btnapoderado)
             ->addElement($idapo)
             ->addElement($idapoderado)
             ->addElement($nombreapo)
             ->addElement($dniapo)
             ->addElement($grado)
             ->addElement($seccion)
             ->addElement($nombre)
             ->addElement($appaterno)
             ->addElement($apmaterno)
             ->addElement($sexo)
             ->addElement($doc_file)
             ->addElement($dni)
             ->addElement($email)
             ->addElement($nombreusuario)
             ->addElement($clave)
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement($btnregistrar);
    }
}