<?php

namespace Models;

class ReminderTodo extends \Models\ReminderAbstract implements \Models\ReminderInterface
{
    public function getForm( $reminderId = null )
    {
        $content = array();

        if ( !empty( $reminderId ) )
        {
            $reminder = $this->getReminderRepository()->find( $reminderId );
            $content = $reminder->getTodoContent();
        }

        $form = new \Application_Form_TodoNote( array( 'content' => $content ) );

        $form->getElement( 'image' )->setDestination( $this->getTmpUploadPath() );

        return $form;
    }

    public function getImage( $image )
    {
        if ( !file_exists( $this->getUploadPath() . $image ) )
        {
            throw new \My_Exceptions_ReminderTodo_ImageNotExist();
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
            'content' => array(),
            'tags' => array()
        );

        $reminder = $this->getReminderRepository()->find( $reminderId );
        if ( empty( $reminder ) )
        {
            throw new \My_Exceptions_ReminderTodo_RecordNotExist();
        }

        $populateArr['id'] = $reminder->getId();

        $populateArr['title'] = $reminder->getTitle();

        $populateArr['content'] = $reminder->getTodoContent();

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

    protected function _create( $data )
    {
        $em = $this->getEntityManager();
        /** @var \Models\Tag $tagModel */
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

    protected function _update( $data )
    {
        $em = $this->getEntityManager();
        /** @var \Models\Tag $tagModel */
        $tagModel = $this->getModelRepository()->getTagModel();

        $reminderObj = $this->getReminderRepository()->find( $data['id'] );
        if ( empty( $reminderObj ) )
        {
            throw new \My_Exceptions_ReminderTodo_RecordNotExist();
        }

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

        $reminderContent = $reminderObj->getTodoContent();
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