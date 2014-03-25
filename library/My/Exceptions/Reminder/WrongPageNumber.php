<?php

class My_Exceptions_Reminder_WrongPageNumber extends My_Exceptions_ReminderBasicException
{
    public function __construct( $msg = 'Page number couldn\'t be less than 1', $code = 0, Exception $previous = null )
    {
        parent::__construct( $msg, $code, $previous );
    }
}