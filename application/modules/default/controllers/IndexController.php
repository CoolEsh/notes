<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->page = (int) $this->_getParam( 'page', 1 );

        $this->view->headTitle( 'Notes List' );

        $reminderModel = new Models\Reminder();
        $remindersPaginator = $reminderModel->getPageRecords( $this->view->page );

        $this->view->remindersPaginator = $remindersPaginator;
    }

}