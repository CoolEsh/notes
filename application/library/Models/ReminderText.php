<?php

namespace Models;

class ReminderText extends ModelAbstract
{
    public function getForm()
    {
        return new \Application_Form_TextNote();
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

        $populateArr['id'] = $reminder->getId();

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

    public function _create( $data )
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

    public function _update( $data )
    {
        $em = $this->getEntityManager();

        $reminderObj = $em->find( '\Entities\Reminder', $data['id'] );
        $reminderObj->setTitle( $data['title'] );

        foreach ( $reminderObj->getTag() as $tagObj )
        {
            $reminderObj->removeTag( $tagObj );
            $em->remove( $tagObj );
        }

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

        $reminderContent = $reminderObj->getContent();
        $reminderTextObj = $reminderContent[ 0 ];
        $reminderTextObj->setContent( $data['content'] );
        $reminderTextObj->setReminder( $reminderObj );

        $em->merge( $reminderTextObj );
        $em->flush();
    }
}