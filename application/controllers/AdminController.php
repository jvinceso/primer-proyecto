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
    
    public function panelAction(){
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
        
        $cursos = new Application_Model_Cursos();
        
        $this->view->nroreg=$this->getRequest()->getParam('nroreg');
        $this->view->page=$this->getRequest()->getParam('page');
        if($this->view->nroreg==null){
            $this->view->nroreg=2;
            $this->view->page=1;
        }  
        
        $listacursos = $cursos->listarCursosPeriodoActual();
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($listacursos));

        
        $paginator->setItemCountPerPage($this->view->nroreg);
        $paginator->setCurrentPageNumber($this->view->page,1);

        $this->view->paginator=$paginator;
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
    
    public function listausuariosAction(){        
        $usuarios = new Application_Model_Usuario();
        $listausuarios = $usuarios->listarUsuarios();

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($listausuarios));

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
            
            //
                $cursos = new Application_Model_Cursos();
        
                $this->view->nroreg=$this->getRequest()->getParam('nroreg');
                $this->view->page=$this->getRequest()->getParam('page');
                if(!isset($this->view->nroreg)){
                    $this->view->nroreg=5;
                    $this->view->page=1;
                }  

                $listacursos = $cursos->listarCursosPeriodoActual();
                $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($listacursos));


                $paginator->setItemCountPerPage($this->view->nroreg);
                $paginator->setCurrentPageNumber($this->view->page,1);

                $this->view->paginator=$paginator;
            //
            return $this->render('nuevocurso');
        } 
        
        $cursos = new Application_Model_Cursos();
        
        $nombrecurso=$form->getValue('nombrecurso');
        $descripcion=$form->getValue('descripcion');
        $idseccion=$form->getValue('cboseccion');
        
        $cursos->registrarCurso($nombrecurso, $descripcion, $idseccion);
        
        return $this->_redirect('/admin/nuevocurso?page=1&nroreg=6');
         
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
    
    public function listadousuariosajaxAction(){
        $this->verificarInactividad();
        $this->_helper->layout->disableLayout();
        
        $usuarios = new Application_Model_Usuario();
        $listausuarios = $usuarios->listarUsuarios();

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($listausuarios));

        $this->view->nroreg=$this->getRequest()->getParam('nroreg');

        if($this->view->nroreg==null){
            $this->view->nroreg=2;
        }  

        $paginator->setItemCountPerPage($this->view->nroreg);
        $paginator->setCurrentPageNumber($this->_getParam('page'),1);

        $this->view->paginator=$paginator;
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
        $sexo=$form->getValue('sexo');
        
        $usuario = new Application_Model_Usuario();
        $idusuario=$usuario->registrarUsuario($nombreusuario, $clave, $email, $dni, $nombre, $appaterno, $apmaterno, '3', $sexo);
        
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
        $sexo=$form->getValue('sexo');
        
        $idapoderado=$form->getValue('idapo');
        $idseccion=$form->getValue('cboseccion');
        
        $usuario = new Application_Model_Usuario();
        $idusuario=$usuario->registrarUsuario($nombreusuario, $clave, $email, $dni, $nombre, $appaterno, $apmaterno, '1', $sexo);
        
        $alumno= new Application_Model_Alumno;
        $alumno->registrarAlumno($idusuario, $idseccion, $idapoderado);
        
        /* Uploading Document File on Server */
        $upload = new Zend_File_Transfer_Adapter_Http();
        $upload->setDestination("main/fotos");
         try {
         // upload received file(s)
             $upload->receive();
             $name = $upload->getFileName('foto');
             $extension = pathinfo($name, PATHINFO_EXTENSION);

             $renameFile = $idusuario.'.'.$extension;

             $fullFilePath = 'main/fotos/'.$renameFile;

             // Rename uploaded file using Zend Framework
             $filterFileRename = new Zend_Filter_File_Rename(array('target' => $fullFilePath, 'overwrite' => true));

             $filterFileRename -> filter($name);
             
             $usuario->actualizarFoto($idusuario, $fullFilePath);
        }
        catch (Zend_File_Transfer_Exception $e) {
            $e->getMessage();
        }
             
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
    
    public function asignardocentecursoAction(){
        $curso=new Application_Model_Cursos();
        $listacursos=$curso->listarCursosPeriodoActualActivos();
// $listanombres=$curso->listarNombreCursosActivos();
        $json = Zend_Json::encode($listacursos);
        $this->view->listacursosactivos=$listacursos;
        $this->view->listanombres=$json;
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
    
    public function listarcursodocenteajaxAction() {
        $this->verificarInactividad();
        $this->_helper->layout->disableLayout();
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
                }else
                {
                    
                }
        }
    }
    
    public function aperturarcursosAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Aperturar Cursos';        
    }
    
    public function nuevaaperturaAction(){
        $idseccion=$this->getRequest()->getParam('cboseccion');
        
        if(isset($idseccion)){
           $seccion = new Application_Model_Seccion();
           $seccion->aperturarSeccion($idseccion);
           return $this->_redirect('/admin/aperturarcursos');
        }
        else{
            return $this->_redirect('/');
        }
        
        
    }
    
    public function listaralumnosseccionAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $seccion=new Application_Model_Seccion();
        $idSeccion=$this->_request->idseccion;
        if($seccion->listarCursosAlumnosbySeccion($idSeccion)==FALSE){
            $array_re=$seccion->listarAlumnosporSecciones($idSeccion);
            $json = Zend_Json::encode($array_re);
            echo $json;
        }
        else{
            
            echo '[{"rpta":"SI"}]';
        }
    }
    
    public function listarnombreusuarioAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $usunombre=$this->getRequest()->getParam('usunombre');
        $usuario = new Application_Model_Usuario();
        
        $result = $usuario->buscarNombredeUsuario($usunombre);
        
        if($result==true){
            echo "existe";
        }
        else{
            echo "";
        }
    }
    
    public function buscardniusuarioAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $usunombre=$this->getRequest()->getParam('usudni');
        $usuario = new Application_Model_Usuario();
        
        $result = $usuario->buscardniusuario($usunombre);
        
        if($result==true){
            echo "existe";
        }
        else{
            echo "";
        }
    }

//MODIFICACION
    
    public function reporteusualumnoAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
//        $usunombre=$this->getRequest()->getParam('usudni');
        $alumno = new Application_Model_Alumno();
        
        $result = $alumno->reportealumnos();
        
        if($result==NULL){
            echo "nada";
        }
        else{
            $json=Zend_Json_Encoder::encode($result);
                echo $json;
        }
    }

    public function countalumnosbysexoseccionAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $alumno = new Application_Model_Alumno();
//        $sexo=$this->getRequest()->getParam('sex');        
        $result = $alumno->cantidadalumnosbysexo();
        
        if($result==NULL){
            echo "nada";
        }
        else{
            $json=Zend_Json_Encoder::encode($result);
                echo $json;
        }      
    }
    
    public function reporte1Action(){
        
    }
    public function reporte2Action(){
        
    }

//Mod Reporte Notas
    public function reportenotasbyseccionAction(){
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->paginaActual = 'Reporte Notas';
    }
//Mod Reporte Notas
    public function flotgraficoAction(){
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->paginaActual = 'Reporte Notas';
    }     
    
}