<?php

class NoteController extends My_Controller_Action_Abstract
{
    public function indexAction()
    {}

    public function addTextAction()
    {
        $this->view->headTitle( 'Add text note' );

        $model = $this->container['modelRepository']->getReminderTextModel();
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

    public function updateTextAction()
    {
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );

        $this->view->headTitle( 'Edit text note' );

        $model = $this->container['modelRepository']->getReminderTextModel();
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

    public function addTodoAction()
    {
        $this->view->headTitle( 'Add to-do note' );

        $model = $this->container['modelRepository']->getReminderTodoModel();
        $form = $model->getForm();

        if ( $this->getRequest()->isPost() )
        {
            $postValues = $this->getRequest()->getPost();
            if ( $form->isValid( $postValues ) )
            {
                $$model->save( $postValues );

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

        $model = $this->container['modelRepository']->getReminderTodoModel();
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

    public function deleteAction()
    {
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );
        if( !empty( $id ) )
        {
            $model = $this->container['modelRepository']->getReminderModel();
            $model->delete( $id );
        }

        $this->redirect( '' );
    }
}