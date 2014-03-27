<?php

abstract class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase
{
    private $_container;

    public function __construct()
    {
        $this->application = new Zend_Application( APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini' );
        $this->bootstrap = $this->application->bootstrap()->getBootstrap();

        $this->_container = $this->bootstrap->getResource( 'container' );

        parent::setUp();
    }

    public function tearDown() {}

    public function getContainer()
    {
        return $this->_container;
    }

}