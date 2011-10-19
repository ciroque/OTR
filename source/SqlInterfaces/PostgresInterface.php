<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/18/11
 * Time: 4:48 PM
 */

require_once("SqlInterface.php");

class PostgresInterface extends SqlInterface
{
    /**
     * @return void
     */
    public function close()
    {
        pg_close($this->connection);
        $this->connection = null;
    }

    /**
     * @param string $sql the SQL query to be executed.
     * @return null | array the results as an associative array.
     */
    public function executeSql(string $sql)
    {
        $resource = pg_query($this->connection, $sql);
        $array = array();
        while($row = pg_fetch_array($resource, PGSQL_ASSOC))
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
        if($this->connection == null)
        {
            $this->connection = pg_connect(
                "host=$this->hostname user=$this->username password=$this->password host=$this->hostname");
        }
    }
}
