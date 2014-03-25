<?php

class My_Exceptions_ReminderTodo_ImageNotExist extends My_Exceptions_ReminderTodoBasicException
{
    public function __construct( $msg = 'Image for to-do note not exist', $code = 0, Exception $previous = null )
    {
        parent::__construct( $msg, $code, $previous );
    }
}