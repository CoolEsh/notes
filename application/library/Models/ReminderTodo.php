<?php

namespace Models;

class ReminderTodo extends ModelAbstract
{
    public function getForm()
    {
        return new \Application_Form_TodoNote();
    }

    public function populateForm( &$form, $reminderId )
    {
        $populateArr = array(
            'id' => '',
            'title' => '',
            'content' => '',
            'tags' => array()
        );

        $em = $this->getEntityManager();

        $reminder = $em->getRepository( '\Entities\Reminder' )->find( $reminderId );

        $populateArr['title'] = $reminder->getTitle();

        $content = $reminder->getContent();
        $populateArr['content'] = $content[ 0 ]->getContent();

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

        $reminderObj = new \Entities\Reminder();
        $reminderObj->setType( 'todo' );
        $reminderObj->setTitle( $data['title'] );

        if ( !empty( $data['tags'] ) )
        {
            $tags = explode( ',', $data['tags'] );
            foreach ( $tags as $tag )
            {
                $tagObj = new \Entities\Tag();
                $tagObj->setName( trim( $tag ) );
                $reminderObj->addTag( $tagObj );
            }
        }

        $em->persist( $reminderObj );
        $em->flush();

        $reminderTodoObj = new \Entities\ReminderTodo();
        $reminderTodoObj->setContent( $data['content'] );
        $reminderTodoObj->setReminder( $reminderObj );

        $em->persist( $reminderTodoObj );
        $em->flush();
    }

    private function _update( $data )
    {
        $em = $this->getEntityManager();

        $reminderObj = new \Entities\Reminder();
        $reminderObj->setId( $data['id'] );
        $reminderObj->setType( 'todo' );
        $reminderObj->setTitle( $data['title'] );

        if ( !empty( $data['tags'] ) )
        {
            $tags = explode( ',', $data['tags'] );
            foreach ( $tags as $tag )
            {
                $tagObj = new \Entities\Tag();
                $tagObj->setName( trim( $tag ) );
                $reminderObj->addTag( $tagObj );
            }
        }

        $em->persist( $reminderObj );
        $em->flush();

        $reminderTodoObj = new \Entities\ReminderTodo();
        $reminderTodoObj->setContent( $data['content'] );
        $reminderTodoObj->setReminder( $reminderObj );

        $em->persist( $reminderTodoObj );
        $em->flush();
    }
}