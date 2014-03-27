<?php

class My_Application_Resource_Container extends Zend_Application_Resource_ResourceAbstract
{
    protected $_options = array(
        'driver' => '',
        'host' => '',
        'user' => '',
        'password' => '',
        'dbname' => '',
        'autoGenerateProxyClasses' => '',
        'proxyPath' => '',
        'proxyNamespace' => '',
        'entityPath' => '',
        'entityNamespace' => ''
    );

    public function init()
    {
        $containerResource = new \Ext\Application\Resource\Container( $this->getOptions(), new Pimple );
        $container = $containerResource->init();

        My_Controller_Action_Abstract::setContainer( $container );
        \Models\ModelAbstract::setContainer( $container );

        return $container;
    }

}