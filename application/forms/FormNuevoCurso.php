<?php 
class Application_Form_FormNuevoCurso extends Zend_Form{
    
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
        
        $this->setAction('/admin/agregarcurso')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        
        // Crea un y configura el elemento username
        $nombrecurso = $this->createElement('text', 'nombrecurso', array('label' => 'Nombre del Curso', 'placeholder' => 'Máximo 150 caracteres'));
        $nombrecurso->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido'))) 
                 ->addValidator('regex', true, array('pattern'=>'/^[(a-z A-Z)]+$/','messages'=>array('regexNotMatch'=>'Sólo Letras')))
                 ->addValidator('stringLength', false, array(5, 150,'messages' => "Entre 5 a 150 caracteres"))
                 ->setRequired(true)
                 ->addFilter('StringToUpper'); 
 
        $nombrecurso->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
        
        $descripcion= $this->createElement('text', 'descripcion', array('label' => 'Descripción', 'placeholder' => 'Breve descripción del curso'));
        $descripcion->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido'))) 
                 ->addValidator('regex', true, array('pattern'=>'/^[(a-z A-Z 0-9)]+$/','messages'=>array('regexNotMatch'=>'Sólo Letras')))
                 ->setRequired(true)
                 ->addFilter('StringToUpper');
 
        $descripcion->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
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
         
        // Añade los elementos al formulario:
        $this->addElement($nombrecurso)
             ->addElement($descripcion)
             ->addElement($grado) 
             ->addElement($seccion)
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement('submit', 'registrar', array('label' => 'Registrar'));
    } 
}