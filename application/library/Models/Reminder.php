<?php

namespace Models;

class Reminder
{
    public function findAllForPaging()
    {
        $em = Zend_Registry::get( 'em' );

        $reminders = $em->getRepository( 'Entities\Reminder' )->findAll();
        foreach ( $reminders as $key => $reminder )
        {
            $reminders[ $key ]->tags = call_user_func( function() use ( $reminder ) {
                $tags = array();

                $reminderTags = $reminder->getTag();
                foreach ( $reminderTags as $reminderTag )
                {
                    array_push( $tags, $reminderTag->getName() );
                }

                return $tags;
            } );

            $reminders[ $key ]->content = call_user_func( function() use ( $reminder, $em ) {
                switch ( $reminder->getType() )
                {
                    case 'text':
                        $reminderContentText = $em->getRepository( 'Entities\ReminderText' )->findOneBy( array( 'reminder'=> $reminder->getId() ) );
                        $content = $reminderContentText->getContent();
                        break;
                    case 'todo':
                        $content = array();
                        $reminderContentTodos = $em->getRepository( 'Entities\ReminderTodo' )->findBy( array( 'reminder'=> $reminder->getId() ) );
                        foreach ( $reminderContentTodos as $reminderContentTodo )
                        {
                            array_push( $content, array(
                                'content' => $reminderContentTodo->getContent(),
                                'completed' => $reminderContentTodo->getCompleted()
                            ) );
                        }
                        break;
                    default:
                        break;
                }

                return $content;
            } );
        }

        return $reminders;
    }
}