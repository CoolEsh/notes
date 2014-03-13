<?php

$prjRoot = dirname(__FILE__) . '/../';
$vendor = $prjRoot . 'vendor/';
$webapp = $prjRoot . 'webapp/';

require_once( $vendor . 'autoload.php' );

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

define( 'APPLICATION_ENV', 'development' );

define( 'APPLICATION_PATH', ( $webapp . 'application' ) );

set_include_path( implode( PATH_SEPARATOR, array(
    realpath( APPLICATION_PATH . '/../library' ),
    get_include_path()
) ) );

// Create application
$application = new Zend_Application(
    APPLICATION_ENV
);

$config = new \Doctrine\ORM\Configuration();

$config->setProxyDir( __DIR__ . '/application/models/Proxies/' );
$config->setProxyNamespace( 'Proxies' );

AnnotationRegistry::registerFile( $vendor . 'doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php' );
$reader = new AnnotationReader();
$driverImpl = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver( $reader, array( __DIR__ . "/../application/models/Entities/" ) );
$config->setMetadataDriverImpl( $driverImpl );

$connectionOptions = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'notes'
);

$em = \Doctrine\ORM\EntityManager::create( $connectionOptions, $config );
$platform = $em->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping( 'enum', 'string' );

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper( $em->getConnection() ),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper( $em )
) );

\Doctrine\ORM\Tools\Console\ConsoleRunner::run( $helperSet );