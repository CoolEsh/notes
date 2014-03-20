<?php

class My_Application_Resource_Router extends Zend_Application_Resource_ResourceAbstract
{
    protected $_options = array(
        'routes_config' => '/configs/routes.ini',
        'container_name' => 'routes'
    );

    public function init()
    {
        $options = $this->getOptions();

        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();

        $config = new Zend_Config_Ini(APPLICATION_PATH . $options['routes_config'], 'development' );
        $router->addConfig( $config, $options['container_name'] );

        return $router;
    }

}