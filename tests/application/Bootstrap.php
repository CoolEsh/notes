<?php

error_reporting( -1 );

defined( 'APPLICATION_ENV' ) || define( 'APPLICATION_ENV', ( getenv( 'APPLICATION_ENV' ) ? getenv( 'APPLICATION_ENV' ) : 'testing' ) );

define( 'ROOT_PATH', dirname( dirname( dirname( __FILE__ ) ) ) );
define( 'APPLICATION_PATH', ROOT_PATH . '/application' );
define( 'CONFIG_PATH', APPLICATION_PATH . '/configs' );
define( 'LIB_PATH', ROOT_PATH . '/library' );

require_once ROOT_PATH . "/vendor/autoload.php";

set_include_path( implode(PATH_SEPARATOR, array(
    realpath( APPLICATION_PATH . '/../library' ),
    get_include_path(),
) ) );

require_once 'Zend/Application.php';
require_once 'ControllerTestCase.php';