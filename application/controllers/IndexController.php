<?php

class IndexController extends Zend_Controller_Action
{
    public function init(){   
        if (Zend_Session::sessionExists()){
                 $this->verificarInactividad();
                
        }
    }

    public function indexAction(){ 
        $this->view->form = $this->getForm();
        $this->render('form');
 
    }
     public function loginAction(){
        if (!$this->getRequest()->isPost()) {
            return $this->_forward('index');
        }
        $form = $this->getForm();
        if (!$form->isValid($_POST)) {
            // Falla la validación; Se vuelve a mostrar el formulario
            $this->view->form = $form;
            return $this->render('form');
        }

        $username=$form->getValue('username');
        $password=$form->getValue('password');
        $remember=$form->getValue('remember');
        
        $usuario= new Application_Model_Usuario();
        $result = $usuario->validarLogin($username, $password);
         
        if (!$result->isValid()) {
            // Autenticación fallida, imprime el porque
            return $this->_redirect('/');
        }
        else {
            $usuario->setIdUsuario($result->getIdentity());
                        
            $mysession = new Zend_Session_Namespace('sesion');
            $mysession->actividad='SI';
            $mysession->setExpirationSeconds(60,'actividad');
            //$mysession->usuario_id =  $usuario->getIdUsuario();
            $mysession->usuario_nombre = $result->getIdentity();
            $aux=$usuario->getUsuariobyNombreUsuario($mysession->usuario_nombre);
            
            $mysession->usuario_id = $aux[0]['iUsuIdUsuario'];
            $mysession->tipo_usuario = $aux[0]['TipoUsuario_iTiUsuarioIdTipoUsuario'];

            
            $log = new Application_Model_Logs();
            $log->crearLog('A');
            $this->redireccionar(); 
        } 
    }
 
    public function getForm()
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
             ->addElement('submit', 'login', array('label' => 'Ingresar'));
              
        return $form;
    }
    
    public function verificarInactividad(){
        $usuario= new Application_Model_Usuario();
        if ($usuario->getInactivo()){
            $usuario->logout();
            return $this->_redirect('/');
        }
        else{
             $this->redireccionar(); 
        }    
    }
    
    public function saludoajax2Action()
    {
        //esta accion no usara layout.phtml
        $this->_helper->layout->disableLayout();
        //esta accion no renderizara su contenido en saludoajax2.phtml
        $this->_helper->viewRenderer->setNoRender();

        //esta es la respuesta a la llamada ajax
        echo "<div id='login_fail'>Usuario Incorrecto</div>";
    }
    
    public function redireccionar(){
        $mysession = new Zend_Session_Namespace('sesion');
        switch ($mysession->tipo_usuario){
                case 1:
                    //Alumno                    
                    return $this->_redirect('/alumno/principal');
                    break;
                case 2:
                    //Docente
                    return $this->_redirect('/docente/principal');
                    break;
                case 3:
                    //Apoderado
                    return $this->_redirect('/apoderado/principal');
                    break;
                case 4:
                    //Director
                    return $this->_redirect('/director/principal');
                    break;
                case 5:
                    //Administrador
                    return $this->_redirect('/admin/principal');
                    break;
                default:
                    return $this->_redirect('/');
                    break;
            }
    }

}

