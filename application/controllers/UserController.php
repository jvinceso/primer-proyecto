<?php
class UserController extends Zend_Controller_Action
{
    //protected $html;
    public function indexAction()
    {
        // genera user/form.phtml
        $this->view->form = $this->getForm();
        $this->render('login');
        $this->render('form');
    }
    
    public function loginAction()
    {
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
        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();

        $authAdapter = new Zend_Auth_Adapter_DbTable( $dbAdapter, 'usuarios', 'vUsuUsuario', 'vUsuClave');
        $authAdapter->setIdentity($username);
        $authAdapter->setCredential(hash_hmac('md5', $password, 'tesis'));
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate( $authAdapter );
        if (!$result->isValid()) {
            // Autenticación fallida, imprime el porque
            return $this->_redirect('/');
        }
        else {
            
            // Autenticación exitosa
            // $result->getIdentity() === $username
            $user= new Application_Model_User();
            $user->setIdUsuario($result->getIdentity());
            $iduser=$user->getIdUsuario();
                                
            echo "Bienvenido ".$iduser;
        }         
    }
    
    public function getForm()
    {
        $form = new Zend_Form();
        $form->setAction('/user/login')->setMethod('post')
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
                    'Errors',
                    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
                    array('Label', array('tag' => 'td')),
                    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
                    ));
         
        // Añade los elementos al formulario:
        $form->addElement($username)
             ->addElement($password)
             // uso de addElement() como fábrica para crear el botón 'Login':
             ->addElement('submit', 'login', array('label' => 'Ingresar'));
              
        return $form;
    }
   public function construirVista($opc){
        
        switch ($opc){
            case '1':
                $this->view->titulo='Colegio Nacional "Los Pinos"';
                break;
            
            case '2':
                $this->view->titulo='Página Principal"';
                 
                break;
            
            default:
                $this->view->titulo='Pagina sin Titulo';
                
                break;
        }        
    }

}