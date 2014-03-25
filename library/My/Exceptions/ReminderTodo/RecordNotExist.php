<?php

class My_Exceptions_ReminderTodo_RecordNotExist extends My_Exceptions_ReminderTodoBasicException
{
    public function __construct( $msg = 'To-do note with given ID not exist', $code = 0, Exception $previous = null )
    {
        parent::__construct( $msg, $code, $previous );
    }
}