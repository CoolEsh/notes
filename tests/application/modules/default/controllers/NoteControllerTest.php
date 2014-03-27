<?php

class NoteControllerTest extends ControllerTestCase
{
    public function testGetImageAction()
    {
        /** @var \Models\ReminderText $model */
        $textModel = $this->getContainer()['modelRepository']->getReminderTextModel();

        /** @var \Models\ReminderTodo $model */
        $todoModel = $this->getContainer()['modelRepository']->getReminderTodoModel();

        /** @var \Models\Reminder $model */
        $model = $this->getContainer()['modelRepository']->getReminderModel();
        $paginator = $model->getPageRecords( 1 );

        foreach ( $paginator['data'] as $reminder )
        {
            $image = $reminder->getImage();
            if ( !empty( $image ) )
            {
                switch ( $reminder->getType() )
                {
                    case 'text':
                        $imageUrl = $textModel->getImageUrl( $image );
                        break;
                    case 'todo':
                        $imageUrl = $todoModel->getImageUrl( $image );
                        break;
                }

                $this->assertStringMatchesFormat( '%A' . $image, $imageUrl );
            }
        }
    }

    /**
     * @expectedException \My_Exceptions_ReminderText_ImageNotExist
     */
    public function testGetTextImageExceptionAction()
    {
        $image = 'test_text_image';

        /** @var \Models\ReminderText $model */
        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
        $model->getImage( $image );
    }

    /**
     * @expectedException \My_Exceptions_ReminderTodo_ImageNotExist
     */
    public function testGetTodoImageExceptionAction()
    {
        $image = 'test_todo_image';

        /** @var \Models\ReminderTodo $model */
        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
        $model->getImage( $image );
    }

    /**
     * @expectedException \My_Exceptions_Reminder_RecordNotExist
     */
    public function testDeleteExceptionAction()
    {
        $id = 0;

        /** @var \Models\Reminder $model */
        $model = $this->getContainer()['modelRepository']->getReminderModel();
        $model->delete( $id );
    }

}