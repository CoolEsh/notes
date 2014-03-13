<?php

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration as DoctrineConfiguration,
    Doctrine\Common\EventManager as DoctrineEventManager,
    Doctrine\ORM\EntityManager as DoctrineEntityManager,
    Doctrine\Common\Cache\ApcCache as DoctrineApcCache,
    Doctrine\Common\Cache\ArrayCache as DoctrineArrayCache;

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Bootstrap Smarty view
     */
    protected function _initView()
    {
        // initialize smarty view
        $view = new Ext_View_Smarty( $this->getOption( 'smarty' ) );
        // setup viewRenderer with suffix and view
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper( 'ViewRenderer' );
        $viewRenderer->setViewSuffix( 'tpl' );
        $viewRenderer->setView( $view );

        // ensure we have layout bootstrapped
        $this->bootstrap( 'layout' );
        // set the tpl suffix to layout also
        $layout = Zend_Layout::getMvcInstance();
        $layout->setViewSuffix( 'tpl' );

        return $view;
    }

    public function _initClassLoaders()
    {
        $loader = new ClassLoader('Doctrine\ORM');
        $loader->register();
        $loader = new ClassLoader('Doctrine\Common');
        $loader->register();
        $loader = new ClassLoader('Doctrine\DBAL');
        $loader->register();
        $loader = new ClassLoader('Symfony', 'Doctrine');
        $loader->register();
        $loader = new ClassLoader('Entities', APPLICATION_PATH . '/models');
        $loader->register();
    }

    public function _initDoctrineEntityManager()
    {
        $this->bootstrap( array( 'classLoaders', 'doctrineCache' ) );
        $zendConfig = $this->getOptions();

        // parameters required for connecting to the database.
        // the required attributes are driver, host, user, password and dbname
        $connectionParameters = $zendConfig['doctrine']['connectionParameters'];

        // now initialize the configuration object
        $configuration = new DoctrineConfiguration();
        // the metadata cache is used to avoid parsing all mapping information every time
        // the framework is initialized.
        $configuration->setMetadataCacheImpl( $this->getResource( 'doctrineCache' ) );
        // for performance reasons, it is also recommended to use a result cache
        $configuration->setResultCacheImpl( $this->getResource( 'doctrineCache' ) );

        // if you set this option to true, Doctrine 2 will generate proxy classes for your entities
        // on the fly. This has of course impact on the performance and should therefore be disabled
        // in the production environment
        $configuration->setAutoGenerateProxyClasses( $zendConfig['doctrine']['autoGenerateProxyClasses'] );

        // the directory, where your proxy classes live
        $configuration->setProxyDir( $zendConfig['doctrine']['proxyPath'] );
        // the proxy classes' namespace
        $configuration->setProxyNamespace( $zendConfig['doctrine']['proxyNamespace'] );

        // the next option tells doctrine which description language we want to use for the mapping
        // information
        $configuration->setMetadataDriverImpl(
            $configuration->newDefaultAnnotationDriver( $zendConfig['doctrine']['entityPath'], false )
        );

        // next, we create an event manager
        $eventManager = new DoctrineEventManager();

        // now we have everything required to initialize the entity manager
        $entityManager = DoctrineEntityManager::create( $connectionParameters, $configuration, $eventManager );

        Zend_Registry::set( 'em', $entityManager );

        return $entityManager;
    }

    /**
     * @return Doctrine\Common\CacheProvider
     */
    public function _initDoctrineCache()
    {
        $cache = null;
        if (APPLICATION_ENV === 'development') {
            $cache = new DoctrineArrayCache();
        } else {
            $cache = new DoctrineApcCache();
        }
        return $cache;
    }

}