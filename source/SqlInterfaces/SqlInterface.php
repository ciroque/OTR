<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/18/11
 * Time: 4:49 PM
 *
 * Generalized implementation of the ISqlInterface that provides the common functionality needed
 * by most every ISqlInterface implementations.
 */

require_once(dirname(__FILE__) . "/../Core/ISqlInterface.php");

abstract class SqlInterface implements ISqlInterface
{
    protected $hostname;
    protected $username;
    protected $password;
    protected $database;

    protected $connection = null;

    /**
     * Requires that standard parameters are provided when an instance is created.
     * @param $hostname The hostname of the target database server.
     * @param $database The name of the database on the hostname which is of interest.
     * @param $username The username used to connect to the database.
     * @param $password The password used to connect to the database.
     */
    function __construct($hostname, $database, $username, $password)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }
}
