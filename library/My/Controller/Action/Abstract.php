<?php

abstract class My_Controller_Action_Abstract extends Zend_Controller_Action
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
    protected function getContainer()
    {
        return self::$_container;
    }

}