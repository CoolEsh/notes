<?php

defined( 'APPLICATION_ENV' ) || define( 'APPLICATION_ENV', ( getenv( 'APPLICATION_ENV' ) ? getenv( 'APPLICATION_ENV' ) : 'development' ) );
define( 'DEFAULT_LANGUAGE', 'en' );

define( 'ROOT_PATH', dirname( dirname( __FILE__ ) ) );
define( 'APPLICATION_PATH', ROOT_PATH . '/application' );
define( 'CONFIG_PATH', APPLICATION_PATH . '/configs' );
define( 'LIB_PATH', ROOT_PATH . '/library' );

require_once ROOT_PATH . "/vendor/autoload.php";

set_include_path( implode(PATH_SEPARATOR, array(
    realpath( APPLICATION_PATH . '/../library' ),
    get_include_path(),
) ) );

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    array(
        'config'      => APPLICATION_PATH . '/configs/application.ini'
    )
);
$application->bootstrap()->run();

//$config = new \Doctrine\DBAL\Configuration();
//
//$connectionParams = array(
//    'dbname' => 'notes',
//    'user' => 'andrew',
//    'password' => 'andrew',
//    'host' => 'localhost',
//    'driver' => 'pdo_mysql',
//);
//$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);