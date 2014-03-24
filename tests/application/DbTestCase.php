<?php

use Doctrine\ORM\EntityManager;

require_once 'Zend/Test/PHPUnit/DatabaseTestCase.php';

abstract class DbTestCase extends Zend_Test_PHPUnit_DatabaseTestCase
{
    protected $_container;

    protected $_db;
    protected $_model;
    protected $_modelClass;

    protected $_fixturesDir;
    protected $_filesDir;
    protected $_initDataSet;

    private function _initDoctrine()
    {
        $appConfig = new Zend_Config_Ini( APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV );

        $this->_container = new Pimple;

        $doctrineConfig = $appConfig->resources->container;

        $this->_container['entityManager'] = $this->_container->share( function () use ( $doctrineConfig ) {
            $configuration = new \Doctrine\ORM\Configuration;

            $configuration->setAutoGenerateProxyClasses( $doctrineConfig->autoGenerateProxyClasses );
            $configuration->setProxyDir( $doctrineConfig->proxyPath );
            $configuration->setProxyNamespace( $doctrineConfig->proxyNamespace );

            $configuration->setMetadataDriverImpl(
                $configuration->newDefaultAnnotationDriver( $doctrineConfig->entityPath, false )
            );

            return EntityManager::create( $doctrineConfig->connectionParameters->toArray(), $configuration );
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

    public function setUp()
    {
        $this->_fixturesDir = dirname(__FILE__) . '/models/fixtures/';
        $this->_filesDir = $this->_fixturesDir . $this->_modelClass . '/';
//        $this->_model = new $this->_modelClass( $this->getAdapter() );

        $this->_initDoctrine();

        parent::setUp();
    }

    protected function getTearDownOperation()
    {
        return PHPUnit_Extensions_Database_Operation_Factory::DELETE_ALL();
    }

    protected function getConnection()
    {
        return $this->getContainer()['entityManager'];
    }

    protected function getDataSet( $pFileName=null )
    {
        if ( $pFileName === null )
        {
            $vFileName = $this->_fixturesDir . 'init.xml';
        }
        else
        {
            $vFileName = $pFileName;
        }
        return $this->createXmlDataSet( $vFileName );
    }

    protected function prepareInitData( $pInitData )
    {
        $this->getDatabaseTester()->setDataSet( $this->getDataSet( $pInitData ) );
        $this->getDatabaseTester()->onSetUp();
    }

}