<?php

namespace Models;

class ReminderText extends \Models\ReminderAbstract implements \Models\ReminderInterface
{
    public function getForm()
    {
        $form = new \Application_Form_TextNote();

        $form->getElement( 'image' )->setDestination( $this->getTmpUploadPath() );

        return $form;
    }

    public function getImage( $image )
    {
        if ( !file_exists( $this->getUploadPath() . $image ) )
        {
            throw new \My_Exceptions_ReminderText_ImageNotExist();
        }

        return readfile( $this->getUploadPath() . $image );
    }

    public function getImageUrl( $image )
    {
        return $this->getUploadPath() . $image;
    }

    public function populateForm( &$form, $reminderId )
    {
        $populateArr = array(
            'id' => '',
            'title' => '',
            'content' => '',
            'tags' => array()
        );

        $reminder = $this->getReminderRepository()->find( $reminderId );
        if ( empty( $reminder ) )
        {
            throw new \My_Exceptions_ReminderText_RecordNotExist();
        }

        $populateArr['id'] = $reminder->getId();

        $populateArr['title'] = $reminder->getTitle();

        $content = $reminder->getTextContent();
        $populateArr['content'] = $content->getContent();

        $tags = $reminder->getTag();
        foreach ( $tags as $tag )
        {
            $populateArr['tags'][] = $tag->getName();
        }
        $populateArr['tags'] = implode( ',', $populateArr['tags'] );

        $form->populate( $populateArr );
    }

    public function validateForm( &$form, $postValues )
    {
        if ( $form->isValid( $postValues ) )
        {
            $this->_formValues = $postValues;
            if ( $form->image->receive() && $form->image->isUploaded() )
            {
                $this->_formValues['image'] = $this->_renameFile( $form->image->getFileName() );
            }

            return true;
        }
        else
        {
            $this->_formValues = $form->getValues();

            return false;
        }
    }

    protected function _create( $data )
    {
        $em = $this->getEntityManager();
        /** @var \Models\Tag $tagModel */
        $tagModel = $this->getModelRepository()->getTagModel();

        $reminderObj = new \Entities\Reminder();
        $reminderObj->setType( 'text' );
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

        $reminderTextObj = new \Entities\ReminderText();
        $reminderTextObj->setContent( $data['content'] );
        $reminderTextObj->setReminder( $reminderObj );

        $em->persist( $reminderTextObj );
        $em->flush();
    }

    protected function _update( $data )
    {
        $em = $this->getEntityManager();
        /** @var \Models\Tag $tagModel */
        $tagModel = $this->getModelRepository()->getTagModel();

        $reminderObj = $this->getReminderRepository()->find( $data['id'] );
        if ( empty( $reminderObj ) )
        {
            throw new \My_Exceptions_ReminderText_RecordNotExist();
        }

        $reminderObj->setTitle( $data['title'] );
        if ( !empty( $data['image'] ) )
        {
            $reminderObj->setImage( $data['image'] );
        }

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

        $reminderContent = $reminderObj->getTextContent();
        $reminderTextObj = $reminderContent;
        $reminderTextObj->setContent( $data['content'] );
        $reminderTextObj->setReminder( $reminderObj );

        $em->merge( $reminderTextObj );
        $em->flush();
    }

}