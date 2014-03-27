<?php

use DoctrineExtensions\PHPUnit\OrmTestCase;

abstract class DbTestCase extends OrmTestCase
{
    private $_container;
    private $_em;

    protected $_modelClass;

    protected $_fixturesDir;
    protected $_filesDir;
    protected $_initDataSet;

    public function __construct()
    {
        parent::__construct();
    }

    public function createEntityManager()
    {
        $this->application = new Zend_Application( APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini' );
        $this->bootstrap = $this->application->bootstrap()->getBootstrap();

        $this->_container = $this->bootstrap->getResource( 'container' );

        $this->_fixturesDir = dirname(__FILE__) . '/modules/default/models/fixtures/';
        $this->_filesDir    = $this->_fixturesDir . $this->_modelClass . '/';

        $this->_em = $this->_container['entityManager'];
        return $this->_em;
    }

    /**
     * Overrides the parent method to add a custom MySQL truncate operation.
     * This suspends foreign key checks for the duration of the truncate command.
     * (non-PHPdoc)
     * @see DoctrineExtensions\PHPUnit\DatabaseTestCase::getSetUpOperation()
     */
    public function getSetUpOperation()
    {
        $truncate = new MySQLTruncate();
        return new PHPUnit_Extensions_Database_Operation_Composite( array(
            $truncate,
            PHPUnit_Extensions_Database_Operation_Factory::INSERT()
        ) );
    }

    public function tearDown() {}

    public function getContainer()
    {
        return $this->_container;
    }

    protected function getDataSet( $pFileName = null )
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