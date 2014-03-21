<?php

namespace Models;

use Zend_Filter_File_Rename;

class ReminderText extends ModelAbstract
{
    private $_tmpUploadPath = '/application/tmp/upload/';
    private $_uploadPath = '/upload/';

    private $_formValues;

    public function getTmpUploadPath()
    {
        return ROOT_PATH . $this->_tmpUploadPath;
    }

    public function getUploadPath()
    {
        return ROOT_PATH . $this->_uploadPath;
    }

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

        $reminder = $this->getReminderRepository()->find( $reminderId );

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

    public function validateForm( &$form, $postValues )
    {
        if ( $form->isValid( $postValues ) )
        {
            $this->_formValues = $postValues;
            if ( $form->image->receive() )
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

    public function getFormValues()
    {
        return $this->_formValues;
    }

    private function _renameFile( $locationFile )
    {
        $newFileName = sha1( uniqid( rand(), true ) ).'.jpg';
        $fullPathFileName = $this->getUploadPath() . $newFileName;

        $filterRename = new Zend_Filter_File_Rename( array(
            'target' => $fullPathFileName,
            'overwrite' => true
        ) );
        $filterRename->filter( $locationFile );

        return $newFileName;
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

    public function _update( $data )
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

        $reminderContent = $reminderObj->getContent();
        $reminderTextObj = $reminderContent[ 0 ];
        $reminderTextObj->setContent( $data['content'] );
        $reminderTextObj->setReminder( $reminderObj );

        $em->merge( $reminderTextObj );
        $em->flush();
    }
}