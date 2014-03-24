<?php

class My_Exceptions_Reminder_RecordNotExist extends My_Exceptions_ReminderBasicException
{
    public function __construct( $msg = 'Record with given ID not exist', $code = 0, Exception $previous = null )
    {
        parent::__construct( $msg, $code, $previous );
    }
}