<?php

class ReminderTodoTest extends DbTestCase
{
    public function __construct()
    {
        $this->_modelClass = 'ReminderTodo';
    }

    public function testAddTodoReminder()
    {
        $vDataSet = new XmlDataSet( $this->_filesDir . 'addTodoReminder.xml' );

        $todo = array(
            'type' => $vDataSet->getValue( 'reminder', 0, 'type' ),
            'title' => $vDataSet->getValue( 'reminder', 0, 'title' ),
            'image' => $vDataSet->getValue( 'reminder', 0, 'image' ),
            'todo_content' => array(
                $vDataSet->getValue( 'reminder_todo', 0, 'content' ),
                $vDataSet->getValue( 'reminder_todo', 1, 'content' ),
                $vDataSet->getValue( 'reminder_todo', 2, 'content' )
            ),
            'todo_completed' => array(
                $vDataSet->getValue( 'reminder_todo', 0, 'completed' ),
                $vDataSet->getValue( 'reminder_todo', 1, 'completed' ),
                $vDataSet->getValue( 'reminder_todo', 2, 'completed' )
            )
        );

        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
        $model->save( $todo );

        $vExpected = $this->createXmlDataSet( $this->_filesDir . 'addTodoReminder.xml' );
        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( 'reminder' );
        $vActual->addTable( 'reminder_todo' );

        $this->assertDataSetsEqual( $vExpected, $vActual );
    }

    public function testUpdateTodoReminder()
    {
        $vDataSet = new XmlDataSet( $this->_filesDir . 'addTodoReminder.xml' );

        $todo = array(
            'type' => $vDataSet->getValue( 'reminder', 0, 'type' ),
            'title' => $vDataSet->getValue( 'reminder', 0, 'title' ),
            'image' => $vDataSet->getValue( 'reminder', 0, 'image' ),
            'todo_content' => array(
                $vDataSet->getValue( 'reminder_todo', 0, 'content' ),
                $vDataSet->getValue( 'reminder_todo', 1, 'content' ),
                $vDataSet->getValue( 'reminder_todo', 2, 'content' )
            ),
            'todo_completed' => array(
                $vDataSet->getValue( 'reminder_todo', 0, 'completed' ),
                $vDataSet->getValue( 'reminder_todo', 1, 'completed' ),
                $vDataSet->getValue( 'reminder_todo', 2, 'completed' )
            )
        );

        $model = $this->getContainer()['modelRepository']->getReminderTodoModel();
        $model->save( $todo );

        $vExpected = $this->createXmlDataSet( $this->_filesDir . 'addTodoReminder.xml' );
        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( 'reminder' );
        $vActual->addTable( 'reminder_todo' );

        $this->assertDataSetsEqual( $vExpected, $vActual );
    }

}