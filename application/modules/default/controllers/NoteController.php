<?php

class NoteController extends Zend_Controller_Action
{
    public function indexAction()
    {}

    public function addTextAction()
    {
        $this->view->headTitle( 'Add text note' );

        $layout = new Zend_Layout();
        $layout->getView()->headScript()->appendFile( '/js/tag-it.min.js' );
        $layout->getView()->headLink()->appendStylesheet( '/css/jquery.tagit.css' );

        $layout->getView()->headScript()->appendFile( '/js/scripts/add-edit-note.js' );

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
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );

        $this->view->headTitle( 'Edit text note' );

        $layout = new Zend_Layout();
        $layout->getView()->headScript()->appendFile( '/js/tag-it.min.js' );
        $layout->getView()->headLink()->appendStylesheet( '/css/jquery.tagit.css' );

        $layout->getView()->headScript()->appendFile( '/js/scripts/add-edit-note.js' );

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
        else
        {
//            $form->populate(  );
        }

        $this->view->form = $form;
    }

    public function updateTodoAction()
    {
        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );

        $this->view->headTitle( 'Edit to-do note' );
    }

    public function deleteAction()
    {
        $id = ( int )$this->getRequest()->getParam( 'id', 0 );
        if( !empty( $id ) )
        {
            $em = Zend_Registry::get( 'em' );
            $reminder = $em->getRepository( 'Entities\Reminder' )->find( $id );
            $em->remove( $reminder );
            $em->flush();
        }

        $this->redirect( '' );
    }
}