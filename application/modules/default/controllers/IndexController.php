<?php

class IndexController extends My_Controller_Action_Abstract
{
    public function indexAction()
    {
        $this->view->page = (int) $this->_getParam( 'page', 1 );

        $this->view->headTitle( 'Notes List' );

        /** @var \Models\Reminder $model */
        $model = $this->container['modelRepository']->getReminderModel();
        $paginator = $model->getPageRecords( $this->view->page );

        $this->view->remindersPaginator = $paginator;
    }

}