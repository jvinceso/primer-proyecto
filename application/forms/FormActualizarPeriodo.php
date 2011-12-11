<?php 
class Application_Form_FormActualizarPeriodo extends Zend_Form{
    
    public function init(){ 
        $this->setAction('/admin/actperiodo')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        
        // Crea un y configura el elemento username
        $peracademico = $this->createElement('text', 'peracademico', array('label' => 'Periodo Académico', 'value'=>date("Y"),'disabled'=>'true'));
        $peracademico->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido'))) 
                 ->setRequired(true);
 
        $peracademico->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));

        // Crea y configura el elemento password:
        
 
        $estado = $this->createElement('radio', 'estado', array('value'=>'Uno', 'checked'=>'true' ,'disabled'=>'true'));
        $estado->addMultiOptions(array(
            'A' => 'Periodo Actual')); 
        
        $estado->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
         
        // Añade los elementos al formulario:
        $this->addElement($peracademico)
             ->addElement($estado) 
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement('submit', 'registrar', array('label' => 'Registrar'));
    } 
}