<?php

namespace Models;

class ReminderTodo
{
    public function getForm()
    {

    }
    
    public function save( $data )
    {
        $em = Zend_Registry::get( 'em' );

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

        $reminderTextObj = new \Entities\ReminderTodo();
        $reminderTextObj->setContent( $data['content'] );
        $reminderTextObj->setReminder( $reminderObj );

        $em->persist( $reminderTextObj );
        $em->flush();
    }
}