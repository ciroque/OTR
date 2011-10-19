<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/18/11
 * Time: 4:47 PM
 */
class MySqlInterface extends SqlInterface
{

    /**
     * @return void
     */
    public function close()
    {
        // TODO: Implement close() method.
    }

    /**
     * @param string $sql the SQL query to be executed.
     * @return null | array the results as an associative array.
     */
    public function executeSql(string $sql)
    {
        // TODO: Implement executeSql() method.
    }

    /**
     * @return void
     */
    public function open()
    {
        // TODO: Implement open() method.
    }
}
