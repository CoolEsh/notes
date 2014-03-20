<?php

namespace Models;

class Repository
{
    private $_reminderModel = null;
    private $_reminderTextModel = null;
    private $_reminderTodoModel = null;
    private $_tagModel = null;

    /**
     * @return \Models\Reminder
     */
    public function getReminderModel()
    {
        if ( $this->_reminderModel === null )
        {
            $this->_reminderModel = new \Models\Reminder;
        }

        return $this->_reminderModel;
    }

    /**
     * @return \Models\ReminderText
     */
    public function getReminderTextModel()
    {
        if ( $this->_reminderTextModel === null )
        {
            $this->_reminderTextModel = new \Models\ReminderText;
        }

        return $this->_reminderTextModel;
    }

    /**
     * @return \Models\ReminderTodo
     */
    public function getReminderTodoModel()
    {
        if ( $this->_reminderTodoModel === null )
        {
            $this->_reminderTodoModel = new \Models\ReminderTodo;
        }

        return $this->_reminderTodoModel;
    }

    /**
     * @return \Models\Tag
     */
    public function getTagModel()
    {
        if ( $this->_tagModel === null )
        {
            $this->_tagModel = new \Models\Tag;
        }

        return $this->_tagModel;
    }

}