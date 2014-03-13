<?php

use Entities\Reminder,
    Entities\ReminderText,
    Entities\Tag;

class Application_Model_ReminderText
{
    public function save( $data )
    {
        $em = Zend_Registry::get( 'em' );

        $reminderObj = new Entities\Reminder();
        $reminderObj->setType( 'text' );
        $reminderObj->setTitle( $data['title'] );

        if ( !empty( $data['tags'] ) )
        {
            $tags = explode( ',', $data['tags'] );
            foreach ( $tags as $tag )
            {
                $tagObj = new Entities\Tag();
                $tagObj->setName( trim( $tag ) );
                $reminderObj->addTag( $tagObj );
            }
        }

        $reminderTextObj = new Entities\ReminderText();
        $reminderTextObj->setContent( $data['content'] );
        $reminderTextObj->setReminder( $reminderObj );

        $em->persist( $reminderTextObj );
        $em->flush();
    }
}