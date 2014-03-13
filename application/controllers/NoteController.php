<?php

class NoteController extends Zend_Controller_Action
{
    public function indexAction()
    {}

    public function addTextAction()
    {
        $this->view->headTitle( 'Add text note' );

        $form = new Application_Form_TextNote();

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $form->isValid( $postValues ) )
            {
                $reminderText = new Application_Model_ReminderText;
                $reminderText->save( $postValues );

                $this->redirect( '' );
            }
            else
            {
                $form->populate( $postValues );
            }
        }

        $this->view->form = $form;
    }

    public function addTodoAction()
    {
        $this->view->headTitle( 'Add to-do note' );

        $form = new Application_Form_TodoNote();

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $form->isValid( $postValues ) )
            {
                $reminderTodo = new Application_Model_ReminderTodo;
                $reminderTodo->save( $postValues );

                $this->redirect( '' );
            }
            else
            {
                $form->populate( $postValues );
            }
        }

        $this->view->form = $form;
    }

    public function updateTextAction()
    {
        $this->view->headTitle( 'Edit text note' );
    }

    public function updateTodoAction()
    {
        $this->view->headTitle( 'Edit to-do note' );
    }

    public function deleteAction()
    {

    }
}