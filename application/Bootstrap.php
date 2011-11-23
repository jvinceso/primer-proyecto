<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function __initSession() {
        Zend_Session::start();
    }
}

