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

        $this->getContainer()->getModelRepository()->getReminderTodoModel()->save( array(
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
        ) );

        $vExpected = $this->createXmlDataSet( $this->_filesDir . 'addTodoReminder.xml' );
        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( 'reminder' );
        $vActual->addTable( 'reminder_todo' );

        $this->assertDataSetsEqual( $vExpected, $vActual );
    }

    public function testUpdateTodoReminder()
    {
        $this->prepareInitData( $this->_filesDir . 'updateBeginTodoReminder.xml' );

        $vExpected = new XmlDataSet( $this->_filesDir . 'updateEndTodoReminder.xml' );

        $this->getContainer()->getModelRepository()->getReminderTodoModel()->save( array(
            'id' => $vExpected->getValue( 'reminder', 0, 'id' ),
            'type' => $vExpected->getValue( 'reminder', 0, 'type' ),
            'title' => $vExpected->getValue( 'reminder', 0, 'title' ),
            'image' => $vExpected->getValue( 'reminder', 0, 'image' ),
            'todo_content' => array(
                $vExpected->getValue( 'reminder_todo', 0, 'content' ),
                $vExpected->getValue( 'reminder_todo', 1, 'content' ),
                $vExpected->getValue( 'reminder_todo', 2, 'content' )
            ),
            'todo_completed' => array(
                $vExpected->getValue( 'reminder_todo', 0, 'completed' ),
                $vExpected->getValue( 'reminder_todo', 1, 'completed' ),
                $vExpected->getValue( 'reminder_todo', 2, 'completed' )
            )
        ) );

        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( 'reminder' );
        $vActual->addTable( 'reminder_todo' );
        $this->assertDataSetsEqual( $this->createXmlDataSet( $this->_filesDir . 'updateEndTodoReminder.xml' ), $vActual );
    }

    public function testDeleteTodoReminder()
    {
        $this->prepareInitData( $this->_filesDir . 'deleteBeginTodoReminder.xml' );
        $vExpected = new XmlDataSet( $this->_filesDir . 'deleteBeginTodoReminder.xml' );

        $this->getContainer()->getModelRepository()->getReminderModel()->delete( $vExpected->getValue( 'reminder', 1, 'id' ) );

        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( 'reminder' );
        $vActual->addTable( 'reminder_todo' );

        $this->assertDataSetsEqual( $this->createXmlDataSet( $this->_filesDir . 'deleteEndTodoReminder.xml' ), $vActual );
    }

}