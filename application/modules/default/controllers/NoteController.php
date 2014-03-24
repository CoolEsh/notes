<?php

class NoteController extends My_Controller_Action_Abstract
{
    public function indexAction()
    {
        $this->view->page = (int) $this->_getParam( 'page', 1 );
        if ( $this->view->page < 1 )
        {
            throw new My_Exceptions_InvalidParameterException( 'Page is not defined properly' );
        }

        $this->view->headTitle( 'Notes List' );

        /** @var \Models\Reminder $model */
        $model = $this->getContainer()['modelRepository']->getReminderModel();
        $paginator = $model->getPageRecords( $this->view->page );

        $this->view->remindersPaginator = $paginator;
    }

    public function addTextAction()
    {
        $this->view->headTitle( 'Add text note' );

        /** @var \Models\ReminderText $model */
        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
        $form = $model->getForm();

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $model->validateForm( $form, $postValues ) )
            {
                $model->save( $model->getFormValues() );

                $this->redirect( '' );
            }
        }

        $this->view->form = $form;
    }

    public function updateTextAction()
    {
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );

        $this->view->headTitle( 'Edit text note' );

        /** @var \Models\ReminderText $model */
        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
        $form = $model->getForm();

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $model->validateForm( $form, $postValues ) )
            {
                $model->save( $model->getFormValues() );

                $this->redirect( '' );
            }
        }
        else
        {
            $model->populateForm( $form, $id );
        }

        $this->view->form = $form;
    }

    public function getTextImageAction()
    {
        $image = $this->getRequest()->getParam( 'image', 'no-image-available.jpg' );

        if ( !empty( $image ) )
        {
            /** @var \Models\ReminderText $model */
            $model = $this->getContainer()['modelRepository']->getReminderTextModel();
            echo readfile( $model->getUploadPath() . $image );
        }

        exit;
    }

    public function addTodoAction()
    {
        $this->view->headTitle( 'Add to-do note' );

        /** @var \Models\ReminderTodo $model */
        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
        $form = $model->getForm();

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $model->validateForm( $form, $postValues ) )
            {
                $model->save( $model->getFormValues() );

                $this->redirect( '' );
            }
        }

        $this->view->form = $form;
    }

    public function updateTodoAction()
    {
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );
        if ( empty( $id ) )
        {
            $this->redirect( '' );
        }

        $this->view->headTitle( 'Edit to-do note' );

        /** @var \Models\ReminderTodo $model */
        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
        $form = $model->getForm( $id );

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $model->validateForm( $form, $postValues ) )
            {
                $model->save( $model->getFormValues() );

                $this->redirect( '' );
            }
        }
        else
        {
            $model->populateForm( $form, $id );
        }

        $this->view->form = $form;
    }

    public function getTodoImageAction()
    {
        $image = $this->getRequest()->getParam( 'image', 'no-image-available.jpg' );

        if ( !empty( $image ) )
        {
            /** @var \Models\ReminderTodo $model */
            $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
            echo readfile( $model->getUploadPath() . $image );
        }

        exit;
    }

    public function deleteAction()
    {
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );

        /** @var \Models\Reminder $model */
        $model = $this->getContainer()['modelRepository']->getReminderModel();
        $model->delete( $id );

        $this->redirect( '' );
    }
}