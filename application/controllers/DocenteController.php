<?php
class DocenteController extends Zend_Controller_Action{
    
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

//MODIFICACION
    public function adminfilesAction(){
//        $usuario= new Application_Model_Usuario();
//        $usuario->logout();
//        return $this->_redirect('/');
    }    

    public function redsocialAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Red Social';        
        
    }    

    public function mensajesAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Red Social';                
    }       
    
    public function crearcarpetaAction(){
        
        $curso=new Application_Model_Cursos();
        $nombre=$this->getRequest()->getParam('id');
        $result=$curso->creafile($nombre);
        if($result=="EXISTE"){
            echo "ARCHIVO EXISTE";
        }else{
            echo "ARCHIVO CREADO SATISFACTORIAMENTE";
        }
        exit;
    }   

    public function agendaAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Agenda';            
    }
    public function registraeventoAction(){
        //esta accion no usara layout.phtml
        $this->_helper->layout->disableLayout();
        //esta accion no renderizara su contenido en saludoajax2.phtml
        $this->_helper->viewRenderer->setNoRender();        
        $agenda=new Application_Model_Agenda();
        $fechainicio=$this->getRequest()->getParam('fechaini');
        $fechafin=$this->getRequest()->getParam('fechafin');
        $visibledocente=$this->getRequest()->getParam('vdoc');
        $visiblealumno=$this->getRequest()->getParam('valum');
        $visibleapoderado=$this->getRequest()->getParam('vapod');
        $titulo=$this->getRequest()->getParam('titulo');
        $contenido=$this->getRequest()->getParam('contenido');
        $urlAcceso=$this->getRequest()->getParam('url');
        $Usuarios_iUsuIdUsuario=$this->getRequest()->getParam('iduser');
        $curso_iscurso=$this->getRequest()->getParam('codcurso');
        $agenda->registrarEvento($fechainicio, $fechafin, $visibledocente, $visiblealumno, 
                $visibleapoderado, $titulo, $contenido, $urlAcceso, $Usuarios_iUsuIdUsuario,$curso_iscurso);
        exit();
    }
    
    public function actualizaeventoAction(){
        //esta accion no usara layout.phtml
        $this->_helper->layout->disableLayout();
        //esta accion no renderizara su contenido en saludoajax2.phtml
        $this->_helper->viewRenderer->setNoRender();        
        $agenda=new Application_Model_Agenda();
        $fechainicio=$this->getRequest()->getParam('fechaini');
        $fechafin=$this->getRequest()->getParam('fechafin');
        $visibledocente=$this->getRequest()->getParam('vdoc');
        $visiblealumno=$this->getRequest()->getParam('valum');
        $visibleapoderado=$this->getRequest()->getParam('vapod');
        $titulo=$this->getRequest()->getParam('titulo');
        $contenido=$this->getRequest()->getParam('contenido');
        $urlAcceso=$this->getRequest()->getParam('url');
        $Usuarios_iUsuIdUsuario=$this->getRequest()->getParam('iduser');
        $curso_iscurso=$this->getRequest()->getParam('idcurso');
        $agenda->actualizaEvento($fechainicio, $fechafin, $visibledocente, $visiblealumno, 
                $visibleapoderado, $titulo, $contenido, $urlAcceso, $Usuarios_iUsuIdUsuario,$curso_iscurso);
        exit();
    }

    public function creareventoAccion(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Red Social';           

    }
    public function eliminareventosAction(){
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();         
            $agenda=new Application_Model_Agenda();
            $idevento=$this->getRequest()->getParam('idevento');
            $result=$agenda->suprimeEvento($idevento);
            echo "algo";
    }    
    
    public function listareventosAction(){
        //esta accion no usara layout.phtml
        $this->_helper->layout->disableLayout();
        //esta accion no renderizara su contenido en saludoajax2.phtml
        $this->_helper->viewRenderer->setNoRender();         
        $agenda=new Application_Model_Agenda();
        $idusuario=$this->getRequest()->getParam('iduser');
        $result=$agenda->listarEventosbyUser($idusuario);
        $json_data;
        for($i=0;$i<sizeof($result);$i++){
            $json_data[$i]=array("id"=>$result[$i]['iAgeIdAgenda'],
                "start"=>$result[$i]['tAgeFechaInicio'],
                "end"=>$result[$i]['tAgeFechaFin'],
                "title"=>$result[$i]['tAgeTitulo'],
                );
        }
        $json = Zend_Json::encode($json_data);
        echo $json;       
        
    }
    
}