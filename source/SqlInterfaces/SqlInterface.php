<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/18/11
 * Time: 4:49 PM
 * To change this template use File | Settings | File Templates.
 */

require_once(dirname(__FILE__) . "/../Core/ISqlInterface.php");

abstract class SqlInterface implements ISqlInterface
{
    protected $hostname;
    protected $username;
    protected $password;
    protected $database;

    protected $connection = null;

    function __construct($hostname, $database, $username, $password)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }
}
