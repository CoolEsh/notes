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

}