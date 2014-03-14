<?php

error_reporting( E_ALL );

defined( 'APPLICATION_ENV' ) || define( 'APPLICATION_ENV', ( getenv( 'APPLICATION_ENV' ) ? getenv( 'APPLICATION_ENV' ) : 'development' ) );

define( 'ROOT_PATH', dirname( dirname( __FILE__ ) ) );
define( 'APPLICATION_PATH', ROOT_PATH . '/application' );
define( 'CONFIG_PATH', APPLICATION_PATH . '/configs' );
define( 'LIB_PATH', ROOT_PATH . '/library' );

spl_autoload_unregister( array( 'Zend_Loader_Autoloader','autoload' ) );

require_once ROOT_PATH . "/vendor/autoload.php";

set_include_path( implode(PATH_SEPARATOR, array(
    realpath( APPLICATION_PATH . '/../library' ),
    get_include_path(),
) ) );

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    array(
        'config' => APPLICATION_PATH . '/configs/application.ini'
    )
);

$resource = new \Ext\Application\Resource\Container( null, new Pimple );
$application->getBootstrap()->registerPluginResource( $resource );

$application->bootstrap()->run();