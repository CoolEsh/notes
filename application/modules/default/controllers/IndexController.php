<?php

class IndexController extends My_Controller_Action_Abstract
{
    public function indexAction()
    {
        $this->view->page = (int) $this->_getParam( 'page', 1 );

        $this->view->headTitle( 'Notes List' );

        $reminderModel = $this->container['modelRepository']->getReminderModel();
        $remindersPaginator = $reminderModel->getPageRecords( $this->view->page );

        $this->view->remindersPaginator = $remindersPaginator;
    }

}