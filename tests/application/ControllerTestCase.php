<?php

use Doctrine\ORM\EntityManager;

abstract class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase
{
    protected $_container;

    public function __construct()
    {
        $this->appConfig = new Zend_Config_Ini( APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV );

        $this->_initDoctrine();

        $this->bootstrap = new Zend_Application( APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini' );

        parent::setUp();
    }

    public function tearDown() {}

    private function _initDoctrine()
    {
        $this->_container = new Pimple;

        $doctrineConfig = $this->appConfig;

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

        $this->_container['repositoryManager'] = $this->_container->share( function () {
            return new \Models\RepositoryManager;
        } );
    }

    public function getContainer()
    {
        return $this->_container;
    }

}