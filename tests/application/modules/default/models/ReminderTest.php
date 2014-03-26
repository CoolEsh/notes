<?php

class ReminderTextTest extends DbTestCase
{
    public function __construct()
    {
        $this->_modelClass = 'Reminder';
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

}