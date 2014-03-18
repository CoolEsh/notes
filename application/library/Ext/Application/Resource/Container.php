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
        $zendConfig = $this->getBootstrap()->getOptions();

        $this->container['entityManager'] = $this->container->share( function ( $c ) use ( $zendConfig ) {
            $configuration = new \Doctrine\ORM\Configuration;

            $configuration->setAutoGenerateProxyClasses( $zendConfig['doctrine']['autoGenerateProxyClasses'] );
            $configuration->setProxyDir( $zendConfig['doctrine']['proxyPath'] );
            $configuration->setProxyNamespace( $zendConfig['doctrine']['proxyNamespace'] );

            $configuration->setMetadataDriverImpl(
                $configuration->newDefaultAnnotationDriver( $zendConfig['doctrine']['entityPath'], false )
            );

            return EntityManager::create( $zendConfig['doctrine']['connectionParameters'], $configuration );
        } );

        $this->container['modelRepository'] = $this->container->share( function ( $c ) {
            return new \Models\Repository;
        } );

        return $this->container;
    }
}