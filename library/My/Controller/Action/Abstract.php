<?php

abstract class My_Controller_Action_Abstract extends Zend_Controller_Action
{
    private $_container;

    public function init()
    {
        parent::init();

        $bootstrap = $this->getInvokeArg( 'bootstrap' );
        $this->_container = $bootstrap->getResource( 'container' );
    }

    protected function getContainer()
    {
        return $this->_container;
    }

}