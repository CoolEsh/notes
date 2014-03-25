<?php

class NoteControllerTest extends ControllerTestCase
{
    /**
     * @expectedException \My_Exceptions_ReminderText_ImageNotExist
     */
    public function testGetTextImageAction()
    {
        $image = 'test_text_image';

        /** @var \Models\ReminderText $model */
        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
        $model->getImage( $image );
    }

    /**
     * @expectedException \My_Exceptions_ReminderTodo_ImageNotExist
     */
    public function testGetTodoImageAction()
    {
        $image = 'test_todo_image';

        /** @var \Models\ReminderTodo $model */
        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
        $model->getImage( $image );
    }

}