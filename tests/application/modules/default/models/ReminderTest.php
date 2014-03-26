<?php

class ReminderTextTest extends DbTestCase
{
    public function __construct()
    {
        $this->_modelClass = 'Reminder';
        $this->_tableName = 'reminder';
    }

    public function testAddTextReminder()
    {
        $vDataSet = new XmlDataSet( $this->_filesDir . 'addTextReminder.xml' );

        $model = $this->getContainer()['modelRepository']->getReminderTextModel();
        $model->save( array(
            'type' => $vDataSet->getValue( $this->_tableName, 0, 'type' ),
            'title' => $vDataSet->getValue( $this->_tableName, 0, 'title' ),
            'image' => $vDataSet->getValue( $this->_tableName, 0, 'image' ),
            'content' => $vDataSet->getValue( $this->_tableName, 0, 'content' )
        ) );

        $vExpected = $this->createXmlDataSet( $this->_filesDir . 'addTextReminder.xml' );
        $vActual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet( $this->getConnection() );
        $vActual->addTable( $this->_tableName );
        $this->assertDataSetsEqual( $vExpected, $vActual );
    }

}