<?php

class ReminderTextTest extends DbTestCase
{
    public function __construct()
    {
        $this->_modelClass = 'ReminderText';
    }

    public function testAddTextReminder()
    {
        $vDataSet = new XmlDataSet( $this->_filesDir . 'addTextReminder.xml' );

        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
        $model->save( array(
            'type' => $vDataSet->getValue( 'reminder', 0, 'type' ),
            'title' => $vDataSet->getValue( 'reminder', 0, 'title' ),
            'image' => $vDataSet->getValue( 'reminder', 0, 'image' ),
            'content' => $vDataSet->getValue( 'reminder_text', 0, 'content' )
        ) );

        $vExpected = $this->createXmlDataSet( $this->_filesDir . 'addTextReminder.xml' );
        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( 'reminder' );
        $vActual->addTable( 'reminder_text' );

        $this->assertDataSetsEqual( $vExpected, $vActual );
    }

    public function testUpdateTextReminder()
    {
        $this->prepareInitData( $this->_filesDir . 'updateBeginTextReminder.xml' );

        $vExpected = new XmlDataSet( $this->_filesDir . 'updateEndTextReminder.xml' );

        $this->getContainer()['modelRepository']->getReminderTextModel()->save( array(
            'id' => $vExpected->getValue( 'reminder', 0, 'id' ),
            'type' => $vExpected->getValue( 'reminder', 0, 'type' ),
            'title' => $vExpected->getValue( 'reminder', 0, 'title' ),
            'image' => $vExpected->getValue( 'reminder', 0, 'image' ),
            'content' => $vExpected->getValue( 'reminder_text', 0, 'content' )
        ) );

        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( 'reminder' );
        $vActual->addTable( 'reminder_text' );
        $this->assertDataSetsEqual( $this->createXmlDataSet( $this->_filesDir . 'updateEndTextReminder.xml' ), $vActual );
    }

    public function testDeleteTextReminder()
    {
        $this->prepareInitData( $this->_filesDir . 'deleteBeginTextReminder.xml' );
        $vExpected = new XmlDataSet( $this->_filesDir . 'deleteBeginTextReminder.xml' );

        $this->getContainer()['modelRepository']->getReminderModel()->delete( $vExpected->getValue( 'reminder', 1, 'id' ) );

        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( 'reminder' );
        $vActual->addTable( 'reminder_text' );

        $this->assertDataSetsEqual( $this->createXmlDataSet( $this->_filesDir . 'deleteEndTextReminder.xml' ), $vActual );
    }


}