<?php
class DocenteController extends Zend_Controller_Action{
    public function init(){  
        $this->verificarInactividad();
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->setExpirationSeconds(60*5,'actividad');
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

    public function cursosAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';        
    }
    
    public function detallecursoAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';  
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso = $idcurso;
    }
    
    public function descripcioncursoAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';   
        
        $idcurso = $this->_request->idcurso;
        $opt = $this->_request->opt;
        
        $this->view->idcurso = $idcurso;
        $this->view->opt = $opt;
    }

    public function agregardetallecursoAction(){
        $detcurso = new Application_Model_DetalleCurso();
        
        $idcurso = $this->_request->idcurso;
        $opt = $this->_request->opt;
        
        $postArray = &$_POST;
        //$postArray = $this->_request->editor1;
        foreach ($postArray as $sForm => $value){
            if (get_magic_quotes_gpc()){
               $postedValue = htmlspecialchars(stripslashes($value)) ;
            }
            else{
               $postedValue = htmlspecialchars($value);
            }
//            $postedValue=htmlentities(addslashes($postedValue));
            ($postedValue==""?$detcurso->eliminarDetalle($idcurso, $opt):$detcurso->insertarDetalle($idcurso, $opt, $postedValue));
        }
        
//        $this->view->xxx = $postedValue;
        return $this->_redirect('/docente/descripcioncurso/?idcurso='.$this->_request->idcurso.'&opt=ini');
    }
    
    public function editarunidadesAction(){
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso=$idcurso;
        $cursosunidad = new Application_Model_CursoUnidad();
        $arraycursosunidad = $cursosunidad->listarCursoUnidad($idcurso);
        
        if($arraycursosunidad==0){
            $cursosunidad->registrarUnidadesCurso($idcurso);            
        }
    }
    
    public function editarunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
    
        
    }
    
    public function agregarunidadcursoAction(){
        $idcurso = $this->_request->idcurso;
        $idunicurso = $this->_request->idunicurso;
        $titulounidad = $this->getRequest()->getParam('txtunidad');
        
        $cursounidad = new Application_Model_CursoUnidad();
        $cursounidad->setTituloUnidadCurso($idunicurso,$titulounidad);
        
        return $this->_redirect('docente/editarunidades?idcurso='.$idcurso);
    }
    
    public function verunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
    }
    
    public function detalleunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        $opt = $this->_request->opt;
        
        if(isset($this->_request->idcom)){
            $idcom=$this->_request->idcom;
            $this->view->idcom=$idcom;
        }
        if(isset($this->_request->idcap)){
            $idcap=$this->_request->idcap;
            $this->view->idcap=$idcap;
        }
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
        $this->view->opt=$opt;
        
    }
    
    public function registrardetalleunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        $opt = $this->_request->opt;
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
        $this->view->opt=$opt;
        
        if(isset($idcurso) && isset($idunicurso) && isset($opt)){
            $descripcion = $this->getRequest()->getParam('txtdescripcion');
            switch($opt){
                case 'com':
                    $competencia = new Application_Model_Competencias();
                    $titulo = $this->getRequest()->getParam('txttitulo');
                    $competencia->registrarCompetencia($idunicurso, $descripcion,$titulo);
                    break;
                case 'cap':
                    $idcompetencia = $this->_request->idcom;
                    $actitud = $this->getRequest()->getParam('txtactitud');                     
                    $capacidad = new Application_Model_Capacidades();
                    $capacidad->registrarCapacidad($idcompetencia, $descripcion, $actitud);
                    break;
                case 'con':
                    $idcap = $this->_request->idcap;                   
                    $conocimiento = new Application_Model_Conocimiento();
                    $conocimiento->registrarConocimiento($idcap, $descripcion);
                    break;
                case 'ind':
                    $idcap = $this->_request->idcap;                   
                    $indicadores = new Application_Model_Indicadores();
                    $indicadores->registrarIndicador($idcap, $descripcion);
                    break;
            }
           return $this->_redirect('docente/verunidadcurso?idcur='.$idcurso.'&idunicur='.$idunicurso);
        }
            
        
    }

    public function documentosAction(){
        $idcurso = $this->_request->idcurso;
        $iddocpadre = (isset($this->_request->iddocpadre)?$this->_request->iddocpadre:"0");
        $crearcar = (isset($this->_request->crearcar)?$this->_request->crearcar:"0");
        
        $this->view->idcurso=$idcurso;
        $this->view->iddocpadre=$iddocpadre;
        $this->view->crearcar=$crearcar;
        
        $documentos = new Application_Model_Documentos();
        $listadocumentos = $documentos->getDocumentosbyIdCurso($idcurso);
        
        if($listadocumentos==0){
            mkdir("main/documentos/".$idcurso,0777);
            $ruta = "main/documentos/".$idcurso;
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de Videos", "Videos",0);
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de Audios", "Audios",0);
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de Imagenes", "Imagenes",0);
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de los Usuarios", "Carpeta de los Usuarios",0);
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de Lecciones", "Lecciones",0);
        }
        
    }

    public function crearcarpetaAction(){
        $idcurso = $this->_request->idcurso;
        $iddocpadre = $this->_request->iddocpadre;
        $titulounidad = $this->getRequest()->getParam('txtnombrecarpeta');
        
        if(isset($titulounidad)){
            $documentos= new Application_Model_Documentos();
            $ruta=$documentos->obternerruta($iddocpadre);
            $documentos->registrarCarpeta($idcurso, NULL, "main/documentos/".$idcurso.$ruta, NULL, $titulounidad, $iddocpadre);
        }
        
     
        
        return $this->_redirect('docente/documentos?idcurso='.$idcurso.'&iddocpadre='.$iddocpadre);
    }

    public function cargararchivoAction(){
        $idcurso = $this->_request->idcurso;
        $iddocpadre = $this->_request->iddocpadre;
        $titulo = $this->getRequest()->getParam('txtnombre');
        
        $documento = new Application_Model_Documentos();
        $ruta=$documento->obternerruta($iddocpadre);
        
        $upload = new Zend_File_Transfer_Adapter_Http();
//        $upload = new Zend_File_Transfer();
        $upload->addValidator('FilesSize',
                      false,
                      array('min' => '10kB', 'max' => '4MB'));
        //$upload->addValidator('Extension', false, 'jpg,png,pdf');
        $upload->setDestination("main/documentos/".$idcurso.$ruta);
        
        try {
         // upload received file(s)
             $name = $upload->getFileName('filee');
             $tamano = $upload->getFileSize('filee');
             
             $accion = $documento->buscarNombreArchivobyIdDocuPadre($iddocpadre, $titulo);
             if($accion==0){
                 
                 $documento->registrarArchivo($idcurso, NULL, $name, NULL, $titulo, $iddocpadre,$tamano);
                 $upload->receive();
             }
             else{
                 return $this->_redirect("http://www.google.com");
             }
//             $extension = pathinfo($name, PATHINFO_EXTENSION);
//
//             $renameFile = $idusuario.'.'.$extension;

//             $fullFilePath = 'main/'.$renameFile;
         
//             $fullFilePath = 'main/'.$name;
             
             // Rename uploaded file using Zend Framework
//             $filterFileRename = new Zend_Filter_File_Rename(array('target' => $fullFilePath, 'overwrite' => true));

//             $filterFileRename -> filter($name);
             
//             $usuario->actualizarFoto($idusuario, $fullFilePath);
        }
        catch (Zend_File_Transfer_Exception $e) {
            return $this->_redirect("http://www.google.com");
        }
        
        return $this->_redirect('docente/documentos?idcurso='.$idcurso.'&iddocpadre='.$iddocpadre);
    }
    
    public function leccionesAction(){
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso=$idcurso;
    }
    
    public function agendaAction(){
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->paginaActual = 'Mi Agenda';
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