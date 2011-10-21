<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/18/11
 * Time: 4:47 PM
 *
 * A more specific implementation of the SqlInterface that supports the MySQL database.
 */

require_once("SqlInterface.php");

class MySqlInterface extends SqlInterface
{
    function __construct($hostname, $database, $username, $password)
    {
        parent::__construct($hostname, $database, $username, $password);
    }

    /**
     * @abstract closes the connection to the database.
     * @return void
     */    public function close()
    {
        mysql_close($this->connection);
    }

    /**
     * @abstract executes the given SQL statement against the database and returns the data as an array.
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
        mysql_free_result($results);
        return $array;
    }

    /**
     * @abstract opens a connection to the database.
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
