<?php 
class UsuarioController extends Zend_Controller_Action{
	public function reporteAction(){
        $usu=new Application_Model_Usuario();
        $tipo=new Application_Model_TipoUsuario();
        $fil=$usu->getUsarios();
        //print_r($fil);       
           foreach($fil as $tm){  
               echo '<tr>
                       <td>'.$tm['iUsuIdUsuario'].'</td>
                       <td>'.$tm['vUsuUsuario'].'</td>                            
                       <td>'.$tm['vUsuEmail'].'</td>                                
                       <td>'.$tm['cUsuDni'].'</td> 
                       <td>'.$tm['vUsuNombre'].'</td> 
                       <td>'.$tm['vUsuApellidoPat'].'</td> 
                       <td>'.$tm['vUsuApellidoMat'].'</td> 
                       <td>'.$tm['cUsuEstado'].'</td> 
                       <td><a><img alt="Eliminar" /></a> <a><img alt="Editar" /></a> </td>                             
                     </tr><br />';  
           }
           exit;        
        }
        public function addusuarioAction(){

        }
        public function generaTabla()
        {
            $formTab=new Zend_Form();
        }
        public function getform(){
            $formusu=new Zend_Form();
            $formusu->setAction('/usuario/addusuario')->setMethod('post')
                 ->setAttrib('id', 'nuevousuario'); 

        }
}