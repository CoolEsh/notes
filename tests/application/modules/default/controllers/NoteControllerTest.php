<?php

class NoteControllerTest extends ControllerTestCase
{
    public function testIndexAction()
    {
        $this->dispatch( '/' );
//        $this->assertModule( 'default' );
//        $this->assertController( 'note' );
//        $this->assertAction('index');
        $this->assertResponseCode( 200 );
    }

//    public function testAddTextAction()
//    {
//        $this->view->headTitle( 'Add text note' );
//
//        /** @var \Models\ReminderText $model */
//        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
//        $form = $model->getForm();
//
//        if ( $this->getRequest()->isPost() )
//        {
//            $postValues = $this->getRequest()->getPost();
//            if ( $model->validateForm( $form, $postValues ) )
//            {
//                $model->save( $model->getFormValues() );
//
//                $this->redirect( '' );
//            }
//        }
//
//        $this->view->form = $form;
//    }
//
//    public function testUpdateTextAction()
//    {
//        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );
//
//        $this->view->headTitle( 'Edit text note' );
//
//        /** @var \Models\ReminderText $model */
//        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
//        $form = $model->getForm();
//
//        if ( $this->getRequest()->isPost() )
//        {
//            $postValues = $this->getRequest()->getPost();
//            if ( $model->validateForm( $form, $postValues ) )
//            {
//                $model->save( $model->getFormValues() );
//
//                $this->redirect( '' );
//            }
//        }
//        else
//        {
//            $model->populateForm( $form, $id );
//        }
//
//        $this->view->form = $form;
//    }
//
//    public function testGetTextImageAction()
//    {
//        $image = $this->getRequest()->getParam( 'image', 'no-image-available.jpg' );
//
//        if ( !empty( $image ) )
//        {
//            /** @var \Models\ReminderText $model */
//            $model = $this->getContainer()['modelRepository']->getReminderTextModel();
//            echo readfile( $model->getUploadPath() . $image );
//        }
//
//        exit;
//    }
//
//    public function testAddTodoAction()
//    {
//        $this->view->headTitle( 'Add to-do note' );
//
//        /** @var \Models\ReminderTodo $model */
//        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
//        $form = $model->getForm();
//
//        if ( $this->getRequest()->isPost() )
//        {
//            $postValues = $this->getRequest()->getPost();
//            if ( $model->validateForm( $form, $postValues ) )
//            {
//                $model->save( $model->getFormValues() );
//
//                $this->redirect( '' );
//            }
//        }
//
//        $this->view->form = $form;
//    }
//
//    public function testUpdateTodoAction()
//    {
//        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );
//        if ( empty( $id ) )
//        {
//            $this->redirect( '' );
//        }
//
//        $this->view->headTitle( 'Edit to-do note' );
//
//        /** @var \Models\ReminderTodo $model */
//        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
//        $form = $model->getForm( $id );
//
//        if ( $this->getRequest()->isPost() )
//        {
//            $postValues = $this->getRequest()->getPost();
//            if ( $model->validateForm( $form, $postValues ) )
//            {
//                $model->save( $model->getFormValues() );
//
//                $this->redirect( '' );
//            }
//        }
//        else
//        {
//            $model->populateForm( $form, $id );
//        }
//
//        $this->view->form = $form;
//    }
//
//    public function testGetTodoImageAction()
//    {
//        $image = $this->getRequest()->getParam( 'image', 'no-image-available.jpg' );
//
//        if ( !empty( $image ) )
//        {
//            /** @var \Models\ReminderTodo $model */
//            $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
//            echo readfile( $model->getUploadPath() . $image );
//        }
//
//        exit;
//    }
//
//    public function testDeleteAction()
//    {
//        $id = ( int )$this->getRequest()->getParam( 'noteId', 0 );
//
//        /** @var \Models\Reminder $model */
//        $model = $this->getContainer()['modelRepository']->getReminderModel();
//        $model->delete( $id );
//
//        $this->redirect( '' );
//    }
}