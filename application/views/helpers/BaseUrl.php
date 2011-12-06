<?php
 class Zend_View_Helper_BaseUrl{
     function BaseUrl(){
         $front_controller=Zend_Controller_Front::getInstance();
         return $front_controller->getBaseUrl();
     }
 }