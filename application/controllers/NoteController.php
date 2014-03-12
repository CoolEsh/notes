<?php

class NoteController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $reminderType = new Application_Model_ReminderType;
        $reminderType->getTypes();

        $this->view->headTitle( 'Notes List' );
    }

    public function addAction()
    {

    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }
}