<?php
class AlumnoController extends Zend_Controller_Action{
    
    public function init(){  
        $this->verificarInactividad();
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->setExpirationSeconds(60*3,'actividad');
        /* Initialize action controller here */
        
    } 
    public function verificarInactividad(){
        $usuario= new Application_Model_Usuario();
        if ($usuario->getInactivo()){
            $usuario->logout();
            return $this->_redirect('/');
        }
    }
    public function principalAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Pagina Principal';
    }
    public function logoutAction(){
        $usuario= new Application_Model_Usuario();
        $usuario->logout();
        return $this->_redirect('/');
    }
    public function pruebandoAction(){
        $this->_helper->layout->disableLayout();        
    }
    public function cursosAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';        
    }
    public function agendaAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mi Agenda';        
    }

    public function detallecursoAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';  
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso = $idcurso;
    }    
    
// MODIFICACION JUEGOS
    public function aprendojugandoAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';     
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso = $idcurso;
    }
    public function granjamatematicaAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';     
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso = $idcurso;
    }    
}
