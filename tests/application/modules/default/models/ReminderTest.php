<?php

class ReminderTest extends DbTestCase
{
    public function __construct()
    {
        $this->_modelClass = 'Reminder';
    }

    public function testGetReminder()
    {
        $this->prepareInitData( $this->_filesDir . 'getReminder.xml' );
        $vExpected = new XmlDataSet( $this->_filesDir . 'getReminder.xml' );

        $vActual = $this->getContainer()['modelRepository']->getReminderModel()->getReminderRepository()->find( $vExpected->getValue( 'reminder', 0, 'id' ) );

        $this->assertEquals( $vActual->getId(), $vExpected->getValue( 'reminder', 0,'id' ) );
        $this->assertEquals( $vActual->getType(), $vExpected->getValue( 'reminder', 0,'type' ) );
        $this->assertEquals( $vActual->getTitle(), $vExpected->getValue( 'reminder', 0,'title' ) );
        $this->assertEquals( $vActual->getImage(), $vExpected->getValue( 'reminder', 0,'image' ) );
    }

}