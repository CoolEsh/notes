<?php

namespace Models;

use Zend_Controller_Front;

class ModelAbstract
{
    /**
     * @return \Ext\Application\Resource\Container
     */
    protected function getEntityManager()
    {
        $front = Zend_Controller_Front::getInstance();

        $bootstrap = $front->getParam( 'bootstrap' );
        $container = $bootstrap->getResource( 'container' );

        return $container['entityManager'];
    }

    /**
     * @return \ReminderRepository
     */
    public function getReminderRepository()
    {
        return $this->getEntityManager()->getRepository( '\Entities\Reminder' );
    }

    /**
     * @return \ReminderTextRepository
     */
    public function getReminderTextRepository()
    {
        return $this->getEntityManager()->getRepository( '\Entities\ReminderText' );
    }

    /**
     * @return \ReminderTodoRepository
     */
    public function getReminderTodoRepository()
    {
        return $this->getEntityManager()->getRepository( '\Entities\ReminderTodo' );
    }

}