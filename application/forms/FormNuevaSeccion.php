<?php 
class Application_Form_FormNuevaSeccion extends Zend_Form{
    
    public function init(){
        $this->setAction('/admin/agregarseccion')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        
        $seccion = new Application_Model_Seccion(); 
        $listasecciones=$seccion->listarSeccionesPeriodoActual();
        
        $includes = new Application_Model_Includes();    
        $gradosactuales = new Application_Model_Grado();

        $arraygrados=$gradosactuales->listarGradosActivos();
        $arraygradostoarray=$includes->query2array($arraygrados, 'iGradoIdGrado', 'vGradoDescripcion');

        $combo=$this->createElement('select','cbogrado',
            array(
            'label'        => 'Grado', 
                'placeholder' => 'Seleccionar Grado',
            'autocomplete' => false,
            'multiOptions' => $arraygradostoarray)
        );

        $combo->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
            ));

        $this->addElement($combo);

            // Añade los elementos al formulario: 
         // uso de addElement() como fábrica para crear el botón 'Login':
        $boton=$this->createElement('submit', 'login', array('label' => 'Registrar'));
        $boton->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')) 
                ));

        $this->addElement($boton);
    }
}