<?php

class AdminController extends Zend_Controller_Action
{
    public function init(){  
        $this->verificarInactividad();
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->setExpirationSeconds(60*3,'actividad');
        /* Initialize action controller here */
        
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
    
    public function agendaAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Agenda';
        
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
        //$opt = $this->_request->opt;
        //Sreturn $this->_redirect('http://www.google.com/'.$opt);
        $this->view->formularioagregarcurso = $this->getFormAgregarCurso();
        //$this->render('formagregarcurso');
    }
    
    public function actualizarperiodoAction(){
        ////////////////////////////////////////////////////////        
        //$opt = $this->_request->opt;
        //Sreturn $this->_redirect('http://www.google.com/'.$opt);
        
        //OK
        $this->view->formactperiodo = $this->getFormActualizarPeriodo();
        
    }
        
    public function tablerodidacticoAction(){
        
    }
    public function actperiodoAction(){ 
        
        if (!$this->getRequest()->isPost()) { 
            return $this->_forward('actualizarperiodo');
        }
        $form = $this->getFormActualizarPeriodo();
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
    
    public function getFormAgregarCurso()
    {
        $form = new Zend_Form();
        $form->setAction('/index/login')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        
        // Crea un y configura el elemento username
        $username = $form->createElement('text', 'username', array('label' => 'Nombre de Usuario'));
        $username->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido'))) 
                 ->addValidator('regex', true, array('pattern'=>'/^[(a-zA-Z0-9)]+$/','messages'=>array('regexNotMatch'=>'Caracteres invalidos')))
                 ->addValidator('stringLength', false, array(5, 20,'messages' => "5 a 20 caracteres"))
                 ->setRequired(true)
                 ->addFilter('StringToLower');
 
        $username->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));

        // Crea y configura el elemento password:
        $password = $form->createElement('password', 'password', array('label' => 'Contraseña'));
        $password->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido')))
                 ->addValidator('stringLength', false, array(5, 20,'messages' => "5 a 20 caracteres"))
                 ->setRequired(true);
       
        $password->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
 
        $recordarme = $form->createElement('checkbox', 'remember', array('label'=>'Recordar mi Sesión'));
        $recordarme ->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors', 
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td'))
            ));
 
         
        // Añade los elementos al formulario:
        $form->addElement($username)
             ->addElement($password)
             ->addElement($recordarme)
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement('submit', 'registrar', array('label' => 'Registrar'));
              
        return $form;
    }

    public function getFormAgregarSeccion()
    {
        $form = new Zend_Form();
        $form->setAction('/index/login')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        
        // Crea un y configura el elemento username
        $username = $form->createElement('text', 'username', array('label' => 'Nombre de Usuario'));
        $username->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido'))) 
                 ->addValidator('regex', true, array('pattern'=>'/^[(a-zA-Z0-9)]+$/','messages'=>array('regexNotMatch'=>'Caracteres invalidos')))
                 ->addValidator('stringLength', false, array(5, 20,'messages' => "5 a 20 caracteres"))
                 ->setRequired(true)
                 ->addFilter('StringToLower');
 
        $username->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));

        // Crea y configura el elemento password:
        $password = $form->createElement('password', 'password', array('label' => 'Contraseña'));
        $password->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido')))
                 ->addValidator('stringLength', false, array(5, 20,'messages' => "5 a 20 caracteres"))
                 ->setRequired(true);
       
        $password->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                    array('Label', array('tag' => 'td')),
                ));
 
        $recordarme = $form->createElement('checkbox', 'remember', array('label'=>'Recordar mi Sesión'));
        $recordarme ->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors', 
                    array('Label', array('placement' => 'APPEND')),
            ));
 
         
        // Añade los elementos al formulario:
        $form->addElement($username)
             ->addElement($password)
             ->addElement($recordarme)
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement('submit', 'registrar', array('label' => 'Registrar'));
              
        return $form;
    }
    
    public function getFormActualizarPeriodo()
    {
        $form = new Zend_Form();
        $form->setAction('/admin/actperiodo')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        
        // Crea un y configura el elemento username
        $peracademico = $form->createElement('text', 'peracademico', array('label' => 'Periodo Académico', 'value'=>date("Y"),'disabled'=>'true'));
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
        
 
        $estado = $form->createElement('radio', 'estado', array('value'=>'Uno', 'checked'=>'true' ,'disabled'=>'true'));
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
        $form->addElement($peracademico)
             ->addElement($estado) 
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement('submit', 'registrar', array('label' => 'Registrar'));
              
        return $form;
    }
    
    public function getFormNuevoGrado()
    {
        $form = new Zend_Form();
        $form->setAction('/admin/agregargrado')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        
        $grados = new Application_Model_Grado(); 
        $listagrados=$grados->listarGradosPeriodoActual();
        
        if($listagrados==NULL){
            $configuracion = new Application_Model_Configuracion();
            $grados=$configuracion->getGradosPrimaria();
            //$recordarme = $form->createElement('checkbox', 'remember');

            foreach($grados as $aux){
                $name=$aux["tConfDescripcion"];
                $recordarme=$form->createElement('checkbox', $name, array('label' => $name ));

                $recordarme->setName($name);
                $recordarme->setLabel($name);
                 $recordarme ->setDecorators(array(
                        'ViewHelper',
                        'Description',
                        'Errors', 
                        array('Label', array('placement' => 'APPEND')),
                        array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                ));
                 $form->addElement($recordarme);

            }
        }
        else{
             foreach($listagrados as $aux){
                $name=$aux["vGradoDescripcion"];
                $estado=$aux["tiGradoEstado"];
                
                if($estado=='I'){
                    $recordarme=$form->createElement('checkbox', $name, array('label' => $name));
                }
                else{
                    $recordarme=$form->createElement('checkbox', $name, array('label' => $name, 'checked'=>true));  
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
                 $form->addElement($recordarme);

            }
            
        }
            
        
            // Añade los elementos al formulario: 
             // uso de addElement() como fábrica para crear el botón 'Login':
        $boton=$form->createElement('submit', 'login', array('label' => 'Registrar'));
        $boton->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')) 
                ));
        
             $form->addElement($boton);
              
        return $form;
    }
    
    public function getFormNuevaSeccion()
    {
        $form = new Zend_Form();
        $form->setAction('/admin/agregarseccion')->setMethod('post')
             ->setAttrib('id', 'formLogin');
        
        $seccion = new Application_Model_Seccion(); 
        $listasecciones=$seccion->listarSeccionesPeriodoActual();
        
        $includes = new Application_Model_Includes();    
        $gradosactuales = new Application_Model_Grado();

        $arraygrados=$gradosactuales->listarGradosActivos();
        $arraygradostoarray=$includes->query2array($arraygrados, 'iGradoIdGrado', 'vGradoDescripcion');

        $combo=$form->createElement('select','cbogrado',
            array(
            'label'        => 'Grado', 
            'autocomplete' => false,
            'multiOptions' => $arraygradostoarray,
                
                )
        );

        $combo->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
            ));

        $form->addElement($combo);

            // Añade los elementos al formulario: 
         // uso de addElement() como fábrica para crear el botón 'Login':
        $boton=$form->createElement('submit', 'login', array('label' => 'Registrar'));
        $boton->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
                    array(array('td' => 'HtmlTag'), array('tag' => 'td')) 
                ));

        $form->addElement($boton);

//        $gradoajax=$form->createElement('select','cbogrados',array(
//            'label'        => 'Grado',
//            'onchange'=>'cargarsecion();',
//            'autocomplete' => false,
//            'multiOptions' => array("4"=>"CUARTO", "5"=>"QUINTO"))
//        );
//
//        $gradoajax->setDecorators(array(
//                'ViewHelper',
//                'Description',
//                'Errors',
//                array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
//                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
//                array('Label', array('tag' => 'td')),
//            ));
//       $form->addElement($gradoajax);
//        $seccion2=$form->createElement('select','cboseccion',array(
//            'label'        => 'Seccion',
//            'autocomplete' => false,
//            'multiOptions' => array("0"=>"Seleccion Grado"))
//        );
//
//        $seccion2->setDecorators(array(
//                'ViewHelper',
//                'Description',
//                'Errors',
//                array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
//                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
//                array('Label', array('tag' => 'td')),
//            ));
//       $form->addElement($seccion2);					
//        // Crea un y configura el elemento username
//        $peracademico = $form->createElement('text', 'peracademico', array('label' => 'Periodo Académico'));
//        $peracademico->addValidator('notEmpty', true, array('messages' => array('isEmpty' => 'Campo requerido'))) 
//                 ->setRequired(true);
// 
//        $peracademico->setDecorators(array(
//                    'ViewHelper',
//                    'Description',
//                    'Errors',
//                    array(array('elementDiv' => 'HtmlTag'), array('tag' => 'div')),
//                    array(array('td' => 'HtmlTag'), array('tag' => 'td')),
//                    array('Label', array('tag' => 'td')),
//                ));
//    $form->addElement($peracademico);
        
        return $form;
    }
    
    public function cargacomboAction(){

        $this->_helper->layout->disableLayout();         

//         return $json;      
//             
//        $this->view->array_re=$array_re; 
    }
  
    public function listarsecciongradoAction(){
        $this->_helper->layout->disableLayout();  
        $this->_helper->viewRenderer->setNoRender();        
        $seccion=new Application_Model_Seccion();         
        $idGrado=$this->_request->codgrad;
        
        $array_re=$seccion->listarSeccionesPorGrado($idGrado); 
//funcion de zend framewrok que me codifica el listado para formato Json   

        $json = Zend_Json::encode($array_re);  
        echo $json;
    }
    
    public function nuevogradoAction(){
        ////////////////////////////////////////////////////////        
        //$opt = $this->_request->opt;
        //Sreturn $this->_redirect('http://www.google.com/'.$opt);
         $this->view->formnuevogrado = $this->getFormNuevoGrado();
         
         }
    
    public function agregargradoAction(){ 
        if (!$this->getRequest()->isPost()) { 
            return $this->_forward('nuevogrado');
        }
        $form = $this->getFormNuevoGrado();
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
        ////////////////////////////////////////////////////////        
        //$opt = $this->_request->opt;
        //Sreturn $this->_redirect('http://www.google.com/'.$opt);
         $this->view->formnuevaseccion = $this->getFormNuevaSeccion();
         
    }
    
    public function agregarseccionAction(){ 
        if (!$this->getRequest()->isPost()) { 
            return $this->_forward('nuevaseccion');
        }
        $form = $this->getFormNuevaSeccion();
        if (!$form->isValid($_POST)) {
            // Falla la validación; Se vuelve a mostrar el formulario
           
            $this->view->formnuevaseccion = $form;
            return $this->render('nuevaseccion');
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
        if ($this->getRequest()->isXmlHttpRequest())
        {   
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();             
            $idseccion=$this->getRequest()->getParam('secc');
            $secciones->deleteSeccion($idseccion);
            echo "1";
        
        }
    }
    public function listadoseccionesAction()  
    {  
     // action body  
        $this->verificarInactividad();
     $this->_helper->layout->disableLayout();  
//     $this->_helper->viewRenderer->setNoRender();   
    }     
    
    /*Juegando Ajax*/
    public function saludoajax2Action()
    {
        //esta accion no usara layout.phtml
        $this->_helper->layout->disableLayout();
        //esta accion no renderizara su contenido en saludoajax2.phtml
        $this->_helper->viewRenderer->setNoRender();

        //esta es la respuesta a la llamada ajax
        echo "saludos desde el servidor";
    }    
    
    public function ajaxcontrolAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest())//Detectamos si es una llamada AJAX
        {
            //Declaramos las clases que necesitamos 
            $seccion = new Application_Model_Seccion();
            $includes=new Application_Model_Includes();
            
            // Solo si estas usando Zend_Layout
            $this->_helper->layout->disableLayout();             
            //No necesitamos el render de la vista en una llamada ajax.
            $this->_helper->viewRenderer->setNoRender();             
            
            
            $idGrado=$this->_request->getPost('codgrad'); 
            
            $array_re=$seccion->listarSeccionesPorGrado($idGrado); 
//          $intIdCarrera = $this->_request->getPost('pais');
        
//            Segunda Opcion
//            $tmpSecciones = $includes->query2array($array_re, 'iSeccIdSeccion', 'vSeccDescripcion');
            
            $optListaSecciones='<option value="0">[SELECCIONE UNA SECCION]</option>';

            for($i=0;$i<sizeof($array_re);$i++){
               $optListaSecciones.="<option value='".$array_re[$i]['iSeccIdSeccion']."'>".($array_re[$i]['vSeccDescripcion'])."</option>"; 
            }            

            echo $optListaSecciones;
        }
    }
    
}