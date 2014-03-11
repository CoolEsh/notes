<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

require_once 'Doctrine/Common/ClassLoader.php';

define('APPLICATION_ENV', "development");
error_reporting(E_ALL);

$classLoader = new \Doctrine\Common\ClassLoader('Doctrine');
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Entities', __DIR__ . '/application/models/Entity');
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Proxies', __DIR__ . '/application/models/Proxy');
$classLoader->register();

$config = new \Doctrine\ORM\Configuration();
$config->setProxyDir(__DIR__ . '/application/persistent/Proxies');
$config->setProxyNamespace('Proxies');

$config->setAutoGenerateProxyClasses((APPLICATION_ENV == "development"));


//Here is the part that needs to be adjusted to make allow the ORM namespace in the annotation be recognized

#$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__ . "/application/persistent/Entities"));

AnnotationRegistry::registerFile("Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php");
$reader = new AnnotationReader();
$driverImpl = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, array(__DIR__ . "/application/persistent/Entities"));
$config->setMetadataDriverImpl($driverImpl);

//End of Changes

$connectionOptions = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'andrew',
    'password' => 'andrew',
    'dbname'   => 'notes'
);

$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);
$platform = $em->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('enum', 'string');

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));