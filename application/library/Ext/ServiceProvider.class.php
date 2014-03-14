<?php

class Ext_ServiceProvider
{
    public function register( My_Application $application )
    {
        $application->getServiceManager()->set('dummy_service', function(){
            return 'dummy service result';
        }       );
    }
}