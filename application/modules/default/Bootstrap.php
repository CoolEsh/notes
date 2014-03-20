<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
//    protected function _initRewrite()
//    {
//        $front = Zend_Controller_Front::getInstance();
//        $router = $front->getRouter();
//
//        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/routes.ini', 'development' );
//        $router->addConfig( $config,'routes' );
//    }
//    public function _initRoute()
//    {
//        $router = Zend_Controller_Front::getInstance()->getRouter();
//
//        $route_update_text_notes = new Zend_Controller_Router_Route(
//            '/note/update-text/:noteId/*',
//            array(
//                'controller' => 'note',
//                'action' => 'update-text'
//            ),
//            array(
//                'noteId' => '[\w\-]+'
//            )
//        );
//        $router->addRoute( 'update-text-note', $route_update_text_notes );
//
//        $route_update_todo_notes = new Zend_Controller_Router_Route(
//            '/note/update-todo/:noteId/*',
//            array(
//                'controller' => 'note',
//                'action' => 'update-todo'
//            ),
//            array(
//                'noteId' => '[\w\-]+'
//            )
//        );
//        $router->addRoute( 'update-todo-note', $route_update_todo_notes );
//
//        $route_delete_note = new Zend_Controller_Router_Route(
//            '/note/delete/:noteId/*',
//            array(
//                'controller' => 'note',
//                'action' => 'delete'
//            ),
//            array(
//                'noteId' => '[\w\-]+'
//            )
//        );
//        $router->addRoute( 'delete-note', $route_delete_note );
//    }
}