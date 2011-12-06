<?php

class CursoController extends Zend_Controller_Action
{
    public function init(){  
        $this->verificarInactividad();
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->setExpirationSeconds(60);
        /* Initialize action controller here */
        
    } 
    public function indexAction(){ 
        
        //$this->view->form = $this->getForm();
        //$this->render('form');
    }
     
    public function plataformaAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Administracion de la Plataforma';
        
    }
    
    public function logoutAction(){
        //Zend_Session::writeClose();
        //Zend_Session::destroy(true);
        //Zend_Session::expireSessionCookie();
        //Zend_Session::namespaceUnset('sesion');
        $usuario= new Application_Model_Usuario();
        $usuario->logout();
        return $this->_redirect('/');
    }
    
    public function verificarInactividad(){
        $usuario= new Application_Model_Usuario();
        if ($usuario->getInactivo()){
            $usuario->logout();
            return $this->_redirect('/');
        }
    }
    
    public function agregarcursoAction(){ 
         
        
        
    }
}