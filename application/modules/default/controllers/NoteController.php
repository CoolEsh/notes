<?php

class NoteController extends My_Controller_Action_Abstract
{
    public function indexAction()
    {
        $this->view->page = (int) $this->_getParam( 'page', 1 );

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
            if ( $form->isValid( $postValues ) )
            {
                $formValues = $form->getValues();
                if ( $form->image->receive() )
                {
                    $locationFile = $form->image->getFileName();

                    $nameFile = sha1( uniqid( rand(), true ) ).'.jpg';
                    $fullPathNameFile = $model->getUploadPath() . $nameFile;

                    $filterRename = new Zend_Filter_File_Rename( array(
                        'target' => $fullPathNameFile,
                        'overwrite' => true
                    ) );
                    $filterRename->filter( $locationFile );

                    $formValues['image'] = $nameFile;
                }

                $model->save( $formValues );

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
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );

        $this->view->headTitle( 'Edit text note' );

        /** @var \Models\ReminderText $model */
        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
        $form = $model->getForm();

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $form->isValid( $postValues ) )
            {
                $model->save( $postValues );

                $this->redirect( '' );
            }
            else
            {
                $form->populate( $postValues );
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
            if ( $form->isValid( $postValues ) )
            {
                $model->save( $postValues );

                $this->redirect( '' );
            }
            else
            {
                $form->populate( $postValues );
            }
        }

        $this->view->form = $form;
    }

    public function updateTodoAction()
    {
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );

        $this->view->headTitle( 'Edit to-do note' );

        /** @var \Models\ReminderTodo $model */
        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
        $form = $model->getForm( $id );

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $form->isValid( $postValues ) )
            {
                $model->save( $postValues );

                $this->redirect( '' );
            }
            else
            {
                $form->populate( $postValues );
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
        if( !empty( $id ) )
        {
            /** @var \Models\Reminder $model */
            $model = $this->getContainer()['modelRepository']->getReminderModel();
            $model->delete( $id );
        }

        $this->redirect( '' );
    }
}