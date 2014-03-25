<?php

namespace Ext\Application\Resource;

use Zend_Application_Resource_ResourceAbstract,
    Doctrine\ORM\EntityManager;

class Container extends Zend_Application_Resource_ResourceAbstract
{
    public $_explicitType = 'container';

    protected $container;

    public function __construct( $options = null, $container = null )
    {
        parent::__construct( $options );

        $this->container = $container;
    }

    public function init()
    {
        $doctrineConfig = $this->getOptions();

        $this->container['entityManager'] = $this->container->share( function () use ( $doctrineConfig ) {
            $configuration = new \Doctrine\ORM\Configuration;

            $configuration->setAutoGenerateProxyClasses( $doctrineConfig['autoGenerateProxyClasses'] );
            $configuration->setProxyDir( $doctrineConfig['proxyPath'] );
            $configuration->setProxyNamespace( $doctrineConfig['proxyNamespace'] );

            $configuration->setMetadataDriverImpl(
                $configuration->newDefaultAnnotationDriver( $doctrineConfig['entityPath'], false )
            );

            return EntityManager::create( $doctrineConfig['connectionParameters'], $configuration );
        } );

        $this->container['modelRepository'] = $this->container->share( function () {
            return new \Models\Repository;
        } );

        return $this->container;
    }

}