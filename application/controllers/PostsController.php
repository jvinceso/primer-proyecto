<?php
class PostsController extends Zend_Controller_Action{
    public function listarAction(){
        $model=new Application_Model_Posts();
        $this->view->posts = $model->getAll();
        
    }
}