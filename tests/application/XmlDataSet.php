<?php

require_once 'PHPUnit/Extensions/Database/DataSet/XmlDataSet.php';

class XmlDataSet extends PHPUnit_Extensions_Database_DataSet_XmlDataSet
{
    private $_dataSet;

    public function __construct( $pXmlFile )
    {
        $this->_dataSet = new PHPUnit_Extensions_Database_DataSet_XmlDataSet( $pXmlFile );
    }

    public function getValue( $pTableName, $pRowIndex, $pColumnName )
    {
        $vTableColumns = array();
        $vTableValues = array();
        $this->_dataSet->getTableInfo( $vTableColumns, $vTableValues );

        return $vTableValues[ $pTableName ][ $pRowIndex ][ $pColumnName ];
    }
}