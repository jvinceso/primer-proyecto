<?php

class AdminController extends Zend_Controller_Action{
    
    public function init(){  
        $this->verificarInactividad();
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->setExpirationSeconds(60*3,'actividad');
    } 
    
    public function indexAction(){ 
         
    }
    
    public function principalAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Pagina Principal';           
    }
    
    public function cursosAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Cursos';        
    }
    
    public function usuariosAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Usuarios';        
    }
    
    public function informesAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Informes';        
    }
    
    public function redsocialAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Red Social';        
    }
    
    public function panelcontrolAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Panel de Control';        
    }
    
    public function plataformaAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Administracion de la Plataforma';        
    }
    
    public function logoutAction(){
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
    
    public function listausuariosAction(){
    }
    
    public function nuevodirectorAction(){
    }
        
    public function buscarusuarioAction(){
    }
    
    public function actualizarperiodoAction(){
        ////////////////////////////////////////////////////////        
        //$opt = $this->_request->opt;
        //Sreturn $this->_redirect('http://www.google.com/'.$opt);
        
        //OK
        $form=new Application_Form_FormActualizarPeriodo();
        $this->view->formactperiodo = $form;
        
    }
        
    public function actperiodoAction(){ 
        
        if (!$this->getRequest()->isPost()) { 
            return $this->_forward('actualizarperiodo');
        }
        $form=new Application_Form_FormActualizarPeriodo();
        
        if (!$form->isValid($_POST)) {
            // Falla la validación; Se vuelve a mostrar el formulario
           
            $this->view->formactperiodo = $form;
            //return $this->render('form');
        }
        $mysession = new Zend_Session_Namespace('sesion');                    
         
        $periodoacademico= new Application_Model_PeriodoAcademico();
        $result = $periodoacademico->registrarPeriodo();
         
        if ($result==true) {
            $grados=new Application_Model_Grado();
            if($grados->registrarGrado()){
                return $this->_redirect('/admin/nuevogrado');
            }
        }
        else {
            return $this->_redirect('/');
        }  
    }    
    
    public function nuevogradoAction(){
        ////////////////////////////////////////////////////////        
        //$opt = $this->_request->opt;
        //Sreturn $this->_redirect('http://www.google.com/'.$opt);
        $form=new Application_Form_FormNuevoGrado();
        $this->view->formnuevogrado = $form;
         
        }
    
    public function agregargradoAction(){ 
        if (!$this->getRequest()->isPost()) { 
            return $this->_forward('nuevogrado');
        }
        $form=new Application_Form_FormNuevoGrado();
        if (!$form->isValid($_POST)) {
            // Falla la validación; Se vuelve a mostrar el formulario
           
            $this->view->formnuevogrado = $form;
            //return $this->render('form');
        }
        
        $grados = new Application_Model_Grado(); 
        $listagrados=$grados->listarGradosPeriodoActual();
        
        //$recordarme = $form->createElement('checkbox', 'remember');
 
        foreach($listagrados as $aux){
            $nombregrado=$aux["vGradoDescripcion"];
            $grado2=$form->getValue($nombregrado);
            $id=$aux['iGradoIdGrado'];
            if ($grado2==1){
                $grados->actualizarGradoPorId($id, 'A');
            }
            else{
                $grados->actualizarGradoPorId($id, 'I');
            }
        }
        
        return $this->_redirect('/admin/plataforma');
        
         
    }
    
    public function nuevaseccionAction(){
        $form=new Application_Form_FormNuevaSeccion();
        $this->view->formnuevaseccion = $form;
    }
    
    public function agregarseccionAction(){ 
        if (!$this->getRequest()->isPost()) { 
            return $this->_forward('nuevaseccion');
        }
        $form=new Application_Form_FormNuevaSeccion();
        if (!$form->isValid($_POST)) {           
            $this->view->formnuevaseccion = $form;
            //return $this->render('form');
        }
        
        $secciones = new Application_Model_Seccion();
        
        $idgrado=$form->getValue('cbogrado');
        $listaseccionesxgrado=$secciones->listarSeccionesPorGrado($idgrado);
        $abc=array (0=>'A', 1=>'B','C', 'D', 'E', 'F','G', 'H','I');
        if($listaseccionesxgrado==NULL){
            $secciones->registrarSeccion('A', $idgrado) ;
        }
        else{
            $letra=$abc[sizeof($listaseccionesxgrado)];
            $secciones->registrarSeccion($letra, $idgrado) ;
        }
        return $this->_redirect('/admin/nuevaseccion');
         
    }
         
    public function eliminarseccionAction(){
        $secciones = new Application_Model_Seccion();
        $idseccion=$this->_request->secc;
        $secciones->deleteSeccion($idseccion);
        return $this->_redirect('/admin/nuevaseccion');
    }
    
    public function actualizarseccionAction(){
        $secciones = new Application_Model_Seccion();
        $idseccion=$this->_request->secc;
        $estado=$this->_request->est;
        $secciones->actualizarSeccion($idseccion, $estado);
        return $this->_redirect('/admin/nuevaseccion');
    }
       
    public function pruebandoAction(){
        $this->_helper->layout->disableLayout();
        //$this->_helper->viewRenderer->setNoRender();
    }
    
    public function nuevocursoAction(){          
        $form = new Application_Form_FormNuevoCurso();
        $this->view->formularioagregarcurso = $form;
    }
    
    public function listacursosAction(){        
            $cursos = new Application_Model_Cursos();
            $listacursos = $cursos->listarCursosPeriodoActual();

            $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($listacursos));
            
            $this->view->nroreg=$this->getRequest()->getParam('nroreg');
            if($this->view->nroreg==null){
                $this->view->nroreg=2;
            }         
            $paginator->setItemCountPerPage($this->view->nroreg);
            $paginator->setCurrentPageNumber($this->_getParam('page'),1);
            
            $this->view->paginator=$paginator;
    }
    
    public function agregarcursoAction(){
        if (!$this->getRequest()->isPost()) { 
            return $this->_forward('nuevocurso');
        }
        $form = new Application_Form_FormNuevoCurso();
        if (!$form->isValid($_POST)) {           
            $this->view->formularioagregarcurso = $form;
            return $this->render('nuevocurso');
        } 
        
        $cursos = new Application_Model_Cursos();
        
        $nombrecurso=$form->getValue('nombrecurso');
        $descripcion=$form->getValue('descripcion');
        $idseccion=$form->getValue('cboseccion');
        
        $cursos->registrarCurso($nombrecurso, $descripcion, $idseccion);
        
        return $this->_redirect('/admin/nuevocurso');
         
    }
    
    public function actualizarcursoAction(){
        $cursos = new Application_Model_Cursos();
        $idcurso=$this->_request->cur;
        $estado=$this->_request->est;
        $cursos->actualizarSeccion($idcurso, $estado);
        return $this->_redirect('/admin/nuevocurso');
    }
    
    public function listarsecciongradoAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $seccion=new Application_Model_Seccion();
        $idGrado=$this->_request->codgrad;
        
        $array_re=$seccion->listarSeccionesPorGradoActivos($idGrado);
//funcion de zend framewrok que me codifica el listado para formato Json

        $json = Zend_Json::encode($array_re);
        echo $json;
    }
    
    public function asignardocentecursoAction(){
        $curso=new Application_Model_Cursos();        
        $listacursos=$curso->listarCursosPeriodoActualActivos();
//        $listanombres=$curso->listarNombreCursosActivos();
        $json = Zend_Json::encode($listacursos);
        $this->view->listacursosactivos=$listacursos;
        $this->view->listanombres=$json;
    }
    //Funciones Ajax
    public function actualizarseccionajaxAction(){
      $secciones = new Application_Model_Seccion();
        if ($this->getRequest()->isXmlHttpRequest())//Detectamos si es una llamada AJAX
        {
            //esta accion no usara layout.phtml
            $this->_helper->layout->disableLayout();
            //esta accion no renderizara su contenido en saludoajax2.phtml
            $this->_helper->viewRenderer->setNoRender();
            $idseccion=$this->getRequest()->getParam('secc');
            $estado=$this->getRequest()->getParam('est');
            $secciones->actualizarSeccion($idseccion, $estado);
            echo "1";
        }
    }
    
    public function eliminarseccionajaxAction(){
        $secciones = new Application_Model_Seccion();
        if ($this->getRequest()->isXmlHttpRequest()){
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            $idseccion=$this->getRequest()->getParam('secc');
            $secciones->deleteSeccion($idseccion);
            echo "1";        
        }
    }
    
    public function actualizarcursoajaxAction(){
      $curso = new Application_Model_Cursos();
      //Detectamos si es una llamada AJAX
        if ($this->getRequest()->isXmlHttpRequest()){
            //esta accion no usara layout.phtml
            $this->_helper->layout->disableLayout();
            //esta accion no renderizara su contenido en saludoajax2.phtml
            $this->_helper->viewRenderer->setNoRender();
            $idcurso=$this->getRequest()->getParam('cur');
            $estado=$this->getRequest()->getParam('est');
            $curso->actualizarCursoPorId($idcurso, $estado);
            echo "1";
        }
    }
    
    public function eliminarcursoajaxAction(){
        $curso = new Application_Model_Cursos();
        if ($this->getRequest()->isXmlHttpRequest()){
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            $idcurso=$this->getRequest()->getParam('cur');
            $curso->deleteCurso($idcurso);
            echo "1";        
        }
    }
    
    public function listadoseccionesajaxAction() {
        $this->verificarInactividad();
        $this->_helper->layout->disableLayout();
    } 
    
    public function listadocursosajaxAction() {
        $this->verificarInactividad();
        $this->_helper->layout->disableLayout();
    }

    public function listarcursodocenteajaxAction() {
        $this->verificarInactividad();
        $this->_helper->layout->disableLayout();
    }    
      
    public function nuevoapoderadoAction() {
        $form = new Application_Form_FormNuevoApoderado();
        $this->view->formularionuevoapoderado = $form;
    }
    
    public function agregarapoderadoAction() {
        if (!$this->getRequest()->isPost()) {
            return $this->_forward('nuevoapoderado');
        }
        $form = new Application_Form_FormNuevoApoderado();
        if (!$form->isValid($_POST)) {
            $this->view->formularionuevoapoderado = $form;
            return $this->render('nuevoapoderado');
        }
        
        $nombreusuario=$form->getValue('nombreusuario');
        $clave=hash_hmac('md5', $form->getValue('clave'), 'tesis');
        $email=$form->getValue('email');
        $dni=$form->getValue('dni');
        $nombre=$form->getValue('nombre');
        $appaterno=$form->getValue('appaterno');
        $apmaterno=$form->getValue('apmaterno');
        
        $usuario = new Application_Model_Usuario();
        $idusuario=$usuario->registrarUsuario($nombreusuario, $clave, $email, $dni, $nombre, $appaterno, $apmaterno, '3');
        
        $apoderado= new Application_Model_Apoderado();
        $apoderado->registrarApoderado($idusuario);
        
        return $this->_redirect('/admin/nuevoapoderado');
    }
    
    public function nuevoalumnoAction() {
        $form = new Application_Form_FormNuevoAlumno;
        $this->view->formularionuevoalumno = $form;
    }
    
    public function agregaralumnoAction() {
        if (!$this->getRequest()->isPost()) {
            return $this->_forward('nuevoalumno');
        }
        $form = new Application_Form_FormNuevoAlumno();
        if (!$form->isValid($_POST)) {
            $this->view->formularionuevoalumno = $form;
            return $this->render('nuevoalumno');
        }
        $nombreusuario=$form->getValue('nombreusuario');
        $clave=hash_hmac('md5', $form->getValue('clave'), 'tesis');
        $email=$form->getValue('email');
        $dni=$form->getValue('dni');
        $nombre=$form->getValue('nombre');
        $appaterno=$form->getValue('appaterno');
        $apmaterno=$form->getValue('apmaterno');
        
        $idapoderado=$form->getValue('idapo');
        $idseccion=$form->getValue('cboseccion');
        
        $usuario = new Application_Model_Usuario();
        $idusuario=$usuario->registrarUsuario($nombreusuario, $clave, $email, $dni, $nombre, $appaterno, $apmaterno, '1');
        
        $alumno= new Application_Model_Alumno;
        $alumno->registrarAlumno($idusuario, $idseccion, $idapoderado);
        
        return $this->_redirect('/admin/nuevoalumno');
    }

    public function nuevodocenteAction(){
        $form = new Application_Form_FormNuevoDocente();
        $this->view->formularionuevodocente = $form;
    }
    
    public function agregardocenteAction() {
        if (!$this->getRequest()->isPost()) {
            return $this->_forward('nuevodocente');
        }
        $form = new Application_Form_FormNuevoDocente();
        if (!$form->isValid($_POST)) {
            $this->view->formularionuevodocente = $form;
            return $this->render('nuevodocente');
        }
        $nombreusuario=$form->getValue('nombreusuario');
        $clave=hash_hmac('md5', $form->getValue('clave'), 'tesis');
        $email=$form->getValue('email');
        $dni=$form->getValue('dni');
        $nombre=$form->getValue('nombre');
        $appaterno=$form->getValue('appaterno');
        $apmaterno=$form->getValue('apmaterno');
        
        $especialidad=$form->getValue('especialidad');
        
        $usuario = new Application_Model_Usuario();
        $idusuario = $usuario->registrarUsuario($nombreusuario, $clave, $email, $dni, $nombre, $appaterno, $apmaterno, '2');
        
        $docente = new Application_Model_Docente();
        $docente->registrarDocente($idusuario, $especialidad);
        
        return $this->_redirect('/admin/nuevodocente');
    }

    public function obtenapoderadoajaxAction(){
        $apoderado = new Application_Model_Apoderado();
        if ($this->getRequest()->isXmlHttpRequest())
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            $parametro=$this->getRequest()->getParam('parametro');
            $opcion=$this->getRequest()->getParam('opt');
            if($opcion=='dni'){
                $result=$apoderado->listarApoderadobydni($parametro);
            }else{$result=$apoderado->listarApoderadobynombre($parametro);}
            if(sizeof($result)>0){
                $json = Zend_Json::encode($result);
                echo $json;
            }else{}

        }
    }
    
    public function obtenerdocenteajaxAction(){
        $docente=new Application_Model_Docente();
        if($this->getRequest()->isXmlHttpRequest())
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            $parametro=$this->getRequest()->getParam('parametro');
            $opcion=$this->getRequest()->getParam('opt');
            if($opcion=='dni'){
                $resuslt=$docente->listardocentebydni($parametro);
               
            }else{$result=$docente->listardocentebyapellido($parametro);}
            if(sizeof($result)>0){
                $json = Zend_Json::encode($result);
                echo $json;
            }else{}
        }
    }
    
    public function asignadocentecursoajaxAction(){
      $cursousuario = new Application_Model_CursosUsuario();
        if ($this->getRequest()->isXmlHttpRequest()){
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            $idusuario=$this->getRequest()->getParam('idusuario');
            $idcurso=$this->getRequest()->getParam('idcurso');
            $option=$this->getRequest()->getParam('opt');
            if($option=='ins'){
                $cursousuario->setCursoUsuario($idusuario, $idcurso);
            }
            else{
                 $cursousuario->unsetCursoUsuario($idusuario, $idcurso);
            }
            echo "1";
        }        
    }

/*by : jvinceso
 * blog: http://jvinceso.blogspot.com
 * twitter: @jvinceso
 * Funcion Obtener Datos del Docente en el curso
 */
    public function obtenerdocentesporcursoajaxAction(){
        $docente=new Application_Model_Docente();
        if($this->getRequest()->isXmlHttpRequest())
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            $idcurso=$this->getRequest()->getParam('idcurso');
            $result=$docente->getDocentesbyCurso($idcurso);
            if(sizeof($result)>0){
                $json = Zend_Json::encode($result);
                echo $json;
            }else{}
        }        
    }
}