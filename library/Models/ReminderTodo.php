<?php

namespace Models;

class ReminderTodo extends ModelAbstract
{
    private $_tmpUploadPath = '/application/tmp/upload/';
    private $_uploadPath = '/upload/';

    public function getTmpUploadPath()
    {
        return ROOT_PATH . $this->_tmpUploadPath;
    }

    public function getUploadPath()
    {
        return ROOT_PATH . $this->_uploadPath;
    }

    public function getForm( $reminderId = null )
    {
        $content = array();

        if ( !empty( $reminderId ) )
        {
            $em = $this->getEntityManager();

            $reminder = $this->getReminderRepository()->find( $reminderId );
            $content = $reminder->getContent();
        }

        return new \Application_Form_TodoNote( array( 'content' => $content ) );
    }

    public function populateForm( &$form, $reminderId )
    {
        $populateArr = array(
            'id' => '',
            'title' => '',
            'content' => array(),
            'tags' => array()
        );

        $em = $this->getEntityManager();

        $reminder = $this->getReminderRepository()->find( $reminderId );

        $populateArr['id'] = $reminder->getId();

        $populateArr['title'] = $reminder->getTitle();

        $populateArr['content'] = $reminder->getContent();

        $tags = $reminder->getTag();
        foreach ( $tags as $tag )
        {
            $populateArr['tags'][] = $tag->getName();
        }
        $populateArr['tags'] = implode( ',', $populateArr['tags'] );

        $form->populate( $populateArr );
    }

    public function save( $data )
    {
        if ( empty( $data['id'] ) )
        {
            $this->_create( $data );
        }
        else
        {
            $this->_update( $data );
        }
    }

    private function _create( $data )
    {
        $em = $this->getEntityManager();
        $tagModel = $this->getModelRepository()->getTagModel();

        $reminderObj = new \Entities\Reminder();
        $reminderObj->setType( 'todo' );
        $reminderObj->setTitle( $data['title'] );
        $reminderObj->setImage( $data['image'] );

        if ( !empty( $data['tags'] ) )
        {
            $tags = explode( ',', $data['tags'] );
            foreach ( $tags as $tag )
            {
                $tag = trim( $tag );

                if ( $tagModel->isTagExist( $tag ) )
                {
                    $tagObj = $tagModel->getExistingTag();
                }
                else
                {
                    $tagObj = new \Entities\Tag();
                    $tagObj->setName( $tag );
                }

                $reminderObj->addTag( $tagObj );
            }
        }

        $em->persist( $reminderObj );
        $em->flush();

        foreach ( $data['todo_content'] as $key => $todoText )
        {
            $reminderTodoObj = new \Entities\ReminderTodo();
            $reminderTodoObj->setContent( $todoText );
            $reminderTodoObj->setCompleted( intval( $data['todo_completed'][ $key ] ) === 1 );
            $reminderTodoObj->setReminder( $reminderObj );

            $em->persist( $reminderTodoObj );
            $em->flush();
        }
    }

    private function _update( $data )
    {
        $em = $this->getEntityManager();
        $tagModel = $this->getModelRepository()->getTagModel();

        $reminderObj = $em->find( '\Entities\Reminder', $data['id'] );
        $reminderObj->setTitle( $data['title'] );
        $reminderObj->setImage( $data['image'] );

        foreach ( $reminderObj->getTag() as $tagObj )
        {
            $reminderObj->removeTag( $tagObj );
        }

        if ( !empty( $data['tags'] ) )
        {
            $tags = explode( ',', $data['tags'] );
            foreach ( $tags as $tag )
            {
                $tag = trim( $tag );

                if ( $tagModel->isTagExist( $tag ) )
                {
                    $tagObj = $tagModel->getExistingTag();
                }
                else
                {
                    $tagObj = new \Entities\Tag();
                    $tagObj->setName( $tag );
                }

                $reminderObj->addTag( $tagObj );
            }
        }

        $em->merge( $reminderObj );
        $em->flush();

        $reminderContent = $reminderObj->getContent();
        foreach ( $reminderContent as $todoObj )
        {
            $em->remove( $todoObj );
        }

        foreach ( $data['todo_content'] as $key => $todoText )
        {
            $reminderTodoObj = new \Entities\ReminderTodo();
            $reminderTodoObj->setContent( $todoText );
            $reminderTodoObj->setCompleted( intval( $data['todo_completed'][ $key ] ) === 1 );
            $reminderTodoObj->setReminder( $reminderObj );

            $em->persist( $reminderTodoObj );
            $em->flush();
        }
    }
}