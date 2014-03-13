<?php

use Entities\Reminder,
    Entities\ReminderTodo;

class Application_Model_ReminderTodo
{
    public function save( $data )
    {
        $em = Zend_Registry::get( 'em' );

        $reminder = new Entities\Reminder();
        $reminder->setType( 'todo' );
        $reminder->setTitle( $data['title'] );

        $em->persist( $reminder );
        $em->flush();

        $reminderText = new Entities\ReminderTodo();
        $reminderText->setContent( $data['content'] );
        $reminderText->setReminder( $reminder );

        $em->persist( $reminderText );
        $em->flush();
    }
}