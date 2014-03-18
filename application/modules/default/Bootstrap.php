<?php

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration as DoctrineConfiguration,
    Doctrine\Common\EventManager as DoctrineEventManager,
    Doctrine\ORM\EntityManager as DoctrineEntityManager,
    Doctrine\Common\Cache\ApcCache as DoctrineApcCache,
    Doctrine\Common\Cache\ArrayCache as DoctrineArrayCache;

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Bootstrap Smarty view
     */
    protected function _initView()
    {
        $view = new Ext_View_Smarty( $this->getOption( 'smarty' ) );

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper( 'ViewRenderer' );
        $viewRenderer->setViewSuffix( 'tpl' );
        $viewRenderer->setView( $view );

        $this->bootstrap( 'layout' );

        $layout = Zend_Layout::getMvcInstance();
        $layout->setViewSuffix( 'tpl' );

        return $view;
    }

    public function _initRoute()
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();

        $route_update_text_notes = new Zend_Controller_Router_Route(
            '/note/update-text/:noteId/*',
            array(
                'controller' => 'note',
                'action' => 'update-text'
            ),
            array(
                'noteId' => '[\w\-]+'
            )
        );
        $router->addRoute( 'update-text-note', $route_update_text_notes );

        $route_update_todo_notes = new Zend_Controller_Router_Route(
            '/note/update-todo/:noteId/*',
            array(
                'controller' => 'note',
                'action' => 'update-todo'
            ),
            array(
                'noteId' => '[\w\-]+'
            )
        );
        $router->addRoute( 'update-todo-note', $route_update_todo_notes );

        $route_delete_note = new Zend_Controller_Router_Route(
            '/note/delete/:noteId/*',
            array(
                'controller' => 'note',
                'action' => 'delete'
            ),
            array(
                'noteId' => '[\w\-]+'
            )
        );
        $router->addRoute( 'delete-note', $route_delete_note );
    }

    public function _initResources()
    {
        $containerResource = new \Ext\Application\Resource\Container( null, new Pimple );
        $this->registerPluginResource( $containerResource );
    }

}