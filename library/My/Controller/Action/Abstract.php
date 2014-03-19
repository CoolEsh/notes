<?php

abstract class My_Controller_Action_Abstract extends Zend_Controller_Action
{
    protected $container;

    public function init()
    {
        parent::init();

        $bootstrap = $this->getInvokeArg( 'bootstrap' );
        $this->container = $bootstrap->getResource( 'container' );
    }

}