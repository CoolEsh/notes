<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->page = $this->_getParam( 'page', 1 );

        $this->view->headTitle( 'Notes List' );

//        $reminderModel = new Models\Reminder();
//        $reminders = $reminderModel->findAllForPaging();

        $bootstrap = $this->getInvokeArg( 'bootstrap' );
        $container = $bootstrap->getResource( 'container' );

        $em = $container['entityManager'];
        $em->getRepository( 'Entities\Raw\Reminder' )->findAll();

//        Zend_View_Helper_PaginationControl::setDefaultViewPartial( 'paginator-controls.tpl' );
//
//        $paginator = Zend_Paginator::factory( $reminders );
//        $paginator->setItemCountPerPage( 3 );
//        $paginator->setCurrentPageNumber( $this->view->page );
//        $this->view->paginator = $paginator;
    }

}