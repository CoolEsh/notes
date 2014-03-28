<?php

namespace Ext\Application\Resource;

use Zend_Application_Resource_ResourceAbstract,
    Doctrine\ORM\EntityManager;

class Container extends Zend_Application_Resource_ResourceAbstract
{
    public $_explicitType = 'container';

    protected $_container;

    public function __construct( $options = null, $container = null )
    {
        parent::__construct( $options );

        $this->_container = $container;
    }

    public function init()
    {
        $doctrineConfig = $this->getOptions();

        $this->_container['entityManager'] = $this->_container->share( function () use ( $doctrineConfig ) {
            $configuration = new \Doctrine\ORM\Configuration;

            $configuration->setAutoGenerateProxyClasses( $doctrineConfig['autoGenerateProxyClasses'] );
            $configuration->setProxyDir( $doctrineConfig['proxyPath'] );
            $configuration->setProxyNamespace( $doctrineConfig['proxyNamespace'] );

            $configuration->setMetadataDriverImpl(
                $configuration->newDefaultAnnotationDriver( $doctrineConfig['entityPath'], false )
            );

            return EntityManager::create( $doctrineConfig['connectionParameters'], $configuration );
        } );

        $this->_container['modelRepository'] = $this->_container->share( function () {
            return new \Models\Repository;
        } );

        return $this;
    }

    public function getEntityManager()
    {
        return $this->_container['entityManager'];
    }

    public function getModelRepository()
    {
        return $this->_container['modelRepository'];
    }

}