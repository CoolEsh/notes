<?php

class My_Application_Resource_View extends Zend_Application_Resource_ResourceAbstract
{
    protected $_options = array(
        'caching' => '0',
        'cache_lifetime'=> '14400',
        'template_dir' => '',
        'compile_dir' => '',
        'config_dir' => '',
        'cache_dir' => '',
        'left_delimiter' => '{',
        'right_delimiter' => '}'
    );

    public function init()
    {
        $bootstrap = $this->getBootstrap();

        $view = new Ext_View_Smarty( $this->getOptions() );
        $view->addHelperPath( LIB_PATH . '/My/View/Helper/', 'My_View_Helper' );

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper( 'ViewRenderer' );
        $viewRenderer->setViewSuffix( 'tpl' );
        $viewRenderer->setView( $view );

        $bootstrap->bootstrap( 'layout' );

        $layout = Zend_Layout::getMvcInstance();
        $layout->setViewSuffix( 'tpl' );

        return $view;
    }

}