<?php

class Application_Model_ReminderType
{
    public function getTypes()
    {
        $em = Zend_Registry::get('em');
        $types = $em->find( 'Entity\ReminderType', 1 );
//        Zend_Debug::dump( $types );
    }
}