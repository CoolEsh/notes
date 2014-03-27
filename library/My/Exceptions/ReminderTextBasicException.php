<?php

class My_Exceptions_ReminderTextBasicException extends Zend_Exception
{
    public function __construct( $msg = '', $code = 0, Exception $previous = null )
    {
        parent::__construct( $msg, 0, $previous );
    }
}