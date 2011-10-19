<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/18/11
 * Time: 4:47 PM
 */

require_once("SqlInterface.php");

class MySqlInterface extends SqlInterface
{
    function __construct($hostname, $database, $username, $password)
    {
        parent::__construct($hostname, $database, $username, $password);
    }

    /**
     * @return void
     */
    public function close()
    {
        mysql_close($this->connection);
    }

    /**
     * @param string $sql the SQL query to be executed.
     * @return null | array the results as an associative array.
     */
    public function executeSql($sql)
    {
        $results = mysql_query($sql);
        $array = array();
        while($row = mysql_fetch_array($results, MYSQL_ASSOC))
        {
            $array[] = $row;
        }
        return $array;
    }

    /**
     * @return void
     */
    public function open()
    {
        $this->connection = mysql_connect(
            $this->hostname,
            $this->username,
            $this->password);

        mysql_select_db($this->database);
    }
}
