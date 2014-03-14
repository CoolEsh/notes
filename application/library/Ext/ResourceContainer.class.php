<?php

namespace Ext;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Tools\Setup,
    Pimple;

class ResourceContainer
{
    protected $container;

    public function __construct( $container = null )
    {
        $this->container = $container;
    }

    public function init()
    {
        $options = $this->getBootstrap()->getOptions();
        $db = $options['doctrine']['connectionParameters'];

        $this->container['entityManager'] = $this->container->share( function ( $c ) use ( $db ) {
            $isDevMode = APPLICATION_ENV == 'development';

            $config = Setup::createAnnotationMetadataConfiguration( array( APPLICATION_PATH . '/models' ), $isDevMode );

            return EntityManager::create( $db, $config );
        } );

        return $this->container;
    }
}