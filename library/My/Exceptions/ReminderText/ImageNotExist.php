<?php

class My_Exceptions_ReminderText_ImageNotExist extends My_Exceptions_ReminderTextBasicException
{
    public function __construct( $msg = 'Image for text note not exist', $code = 0, Exception $previous = null )
    {
        parent::__construct( $msg, $code, $previous );
    }
}