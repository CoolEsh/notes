<?php

namespace Models;

use Zend_Controller_Front;

class ModelAbstract
{
    private static $_container;

    /**
     * @param \Ext\Application\Resource\Container $container
     */
    public static function setContainer( $container )
    {
        self::$_container = $container;
    }

    /**
     * @return \Ext\Application\Resource\Container
     */
    private function _getContainer()
    {
        return self::$_container;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        $container = $this->_getContainer();

        return $container['entityManager'];
    }

    /**
     * @return \Models\Repository
     */
    protected function getModelRepository()
    {
        $container = $this->_getContainer();

        return $container['modelRepository'];
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

    /**
     * @return \TagRepository
     */
    public function getTagRepository()
    {
        return $this->getEntityManager()->getRepository( '\Entities\Tag' );
    }

}