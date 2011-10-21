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
    private $auto_opened = false;

    /**
     * @abstract closes the connection to the database.
     * @return void
     */
    public function close()
    {
        if($this->connection != null)
        {
            mysql_close($this->connection);
            $this->connection = null;
            $this->auto_opened = false;
        }
    }

    /**
     * @abstract executes the given SQL statement against the database and returns the data as an array.
     * @param string $sql the SQL query to be executed.
     * @return null | array the results as an associative array.
     */
    public function executeSql($sql)
    {
        $this->ensureConnectionIsOpen();

        $results = mysql_query($sql);
        $array = array();
        while($row = mysql_fetch_array($results, MYSQL_ASSOC))
        {
            $array[] = $row;
        }
        mysql_free_result($results);

        $this->closeIfAutoOpened();

        return $array;
    }

    /**
     * @abstract opens a connection to the database. NOTE: Clients need not call open if there is just a single
     * query to be run. Call open only when multiple statements need to be run in short order.
     * @return void
     */
    public function open()
    {
        if($this->connection == null)
        {
            $this->connection = mysql_connect(
                $this->hostname,
                $this->username,
                $this->password);
        }

        mysql_select_db($this->database);

        $this->auto_opened = false;
    }

    private function closeIfAutoOpened()
    {
        if ($this->auto_opened) {
            $this->close();
        }
    }

    private function ensureConnectionIsOpen()
    {
        if ($this->connection == null) {
            $this->open();
            $this->auto_opened = true;
        }
    }
}
