<?php
class UsuariosController extends Zend_Controller_Action{
    public function validarAction(){
        $this->_helper->layout->disableLayout();
        //esta accion no renderizara su contenido en saludoajax2.phtml
        $this->_helper->viewRenderer->setNoRender();
        
//        $model=new Application_Model_Usuarios();
//        
//        if ($this->getRequest()->isPost()){
//            $iduser = $this->_getParam("iduser");
//            $pass = $this->_getParam("password");
//            if ($iduser != null){
//                if($model->validar($iduser,hash_hmac('md5', $pass, 'tesis'))){
//                //return $this->_redirect('http://www.google.com/');
//                return "hola";
//                }
//                else{
//                    $model=new Application_Model_Usuarios();
//                //return $this->_redirect('http://www.facebook.com/');    
//                return "hola";
//                
//                }
//            }
//            else{
//                //return $this->_redirect('http://www.hotmail.com/');
//            return "hola";
//                
//            }
//        }
//        else{
//            return "hola";
//        }  
        $aux = new Zend_Session_Namespace('mysession');
        if (isset($aux->usuario_id)){
             echo "<div id='login_fail'>SIIIIII</div>";
        }
         else {
            echo "<div id='login_fail'>NOOOOO</div>";
        }
        
        
    }
}