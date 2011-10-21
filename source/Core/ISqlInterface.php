<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/18/11
 * Time: 4:40 PM
 *
 * Interface that defines the common entry points for SQL functionality.
 */
interface ISqlInterface
{

    /**
     * @abstract closes the connection to the database.
     * @return void
     */
    public function close();

    /**
     * @abstract executes the given SQL statement against the database and returns the data as an array.
     * @param string $sql the SQL query to be executed.
     * @return null | array the results as an associative array.
     */
    public function executeSql($sql);

    /**
     * @abstract opens a connection to the database.
     * @return void
     */
    public function open();

}
