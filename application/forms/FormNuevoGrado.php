<?php 
class Application_Form_FormNuevoGrado extends Zend_Form{
    
    public function init(){
        $this->setAction('/admin/agregargrado')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        $grados = new Application_Model_Grado(); 
        $listagrados=$grados->listarGradosPeriodoActual();
        
        if($listagrados==NULL){
            $configuracion = new Application_Model_Configuracion();
            $grados=$configuracion->getGradosPrimaria();
        
            foreach($grados as $aux){
                $name=$aux["tConfDescripcion"];
                $recordarme=$this->createElement('checkbox', $name, array('label' => $name ));

                $recordarme->setName($name);
                $recordarme->setLabel($name);
                 $recordarme ->setDecorators(array(
                        'ViewHelper',
                        'Description',
                        'Errors', 
                        array('Label', array('placement' => 'APPEND')),
                        array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                ));
                 $this->addElement($recordarme);
            }
        }
        else{
             foreach($listagrados as $aux){
                $name=$aux["vGradoDescripcion"];
                $estado=$aux["tiGradoEstado"];
                
                if($estado=='I'){
                    $recordarme=$this->createElement('checkbox', $name, array('label' => $name));
                }
                else{
                    $recordarme=$this->createElement('checkbox', $name, array('label' => $name, 'checked'=>true));  
                }
                
                $recordarme->setName($name);
                $recordarme->setLabel($name);
                $recordarme ->setDecorators(array(
                        'ViewHelper',
                        'Description',
                        'Errors', 
                        array('Label', array('placement' => 'APPEND')),
                        array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                ));
                 $this->addElement($recordarme);
            }
            
        }
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