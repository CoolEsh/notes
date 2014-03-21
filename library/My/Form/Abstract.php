<?php

abstract class My_Form_Abstract extends Zend_Form
{
    private $_container;

    public function init()
    {
        parent::init();

        $front = Zend_Controller_Front::getInstance();

        $bootstrap = $front->getParam( 'bootstrap' );
        $this->_container = $bootstrap->getResource( 'container' );
    }

    protected function getContainer()
    {
        return $this->_container;
    }

}