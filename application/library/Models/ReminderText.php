<?php

namespace Models;

class ReminderText extends ModelAbstract
{
    public function getForm()
    {

    }

    public function save( $data )
    {
        $em = $this->getEntityManager();

        $reminderObj = new \Entities\Reminder();
        $reminderObj->setType( 'text' );
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

        $reminderTextObj = new \Entities\ReminderText();
        $reminderTextObj->setContent( $data['content'] );
        $reminderTextObj->setReminder( $reminderObj );

        $em->persist( $reminderTextObj );
        $em->flush();
    }
}