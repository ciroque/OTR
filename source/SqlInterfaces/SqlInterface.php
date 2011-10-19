<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/18/11
 * Time: 4:49 PM
 * To change this template use File | Settings | File Templates.
 */
 
abstract class SqlInterface implements ISqlInterface
{
    protected $hostname;
    protected $username;
    protected $password;

    protected $connection = null;

    function __construct(string $hostname, string $username, string $password)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
    }
}
