<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->page = $this->_getParam( 'page', 1 );

        $this->view->headTitle( 'Notes List' );

        $bootstrap = $this->getInvokeArg( 'bootstrap' );
        $container = $bootstrap->getResource( 'container' );

        $em = $container['entityManager'];
        $remindersList = $em->getRepository( 'Entities\Reminder' )->findAll();

        $this->view->remindersList = $remindersList;

//        Zend_View_Helper_PaginationControl::setDefaultViewPartial( 'paginator-controls.tpl' );
//
//        $paginator = Zend_Paginator::factory( $reminders );
//        $paginator->setItemCountPerPage( 3 );
//        $paginator->setCurrentPageNumber( $this->view->page );
//        $this->view->paginator = $paginator;
    }

}