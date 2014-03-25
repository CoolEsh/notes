<?php

class My_Exceptions_ReminderText_RecordNotExist extends My_Exceptions_ReminderTextBasicException
{
    public function __construct( $msg = 'Text note with given ID not exist', $code = 0, Exception $previous = null )
    {
        parent::__construct( $msg, $code, $previous );
    }
}