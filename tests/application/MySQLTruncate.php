<?php

/**
 * MySQL truncate class that allows foreign key checks to be suspended for the duration of the truncate operation.
 * @author Mike Lively
 * @author Jeremy Cook
 * @version 1.0
 * @package Veridis
 * @see https://gist.github.com/1319731
 */
class MySQLTruncate extends PHPUnit_Extensions_Database_Operation_Truncate
{
    /**
     * Executes the truncate.
     * Note: the $connection variable here is an instance of DoctrineExtensions\PHPUnit\TestConnection
     * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_Operation_Truncate::execute()
     */
    public function execute(PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection, PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet)
    {
        $connection->getConnection()->exec("SET @PREVIOUS_foreign_key_checks = @@foreign_key_checks");
        $connection->getConnection()->exec("SET @@foreign_key_checks = 0");
        parent::execute($connection, $dataSet);
        $connection->getConnection()->exec("SET @@foreign_key_checks = @PREVIOUS_foreign_key_checks");
    }

}