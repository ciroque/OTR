<?php

require_once("config.php");

/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/13/11
 * Time: 9:09 AM
 */
class OutageDataRetriever
{
    public function retrieve()
    {
        $connection = mysql_connect(__MYSQL_HOSTNAME__, __MYSQL_USERNAME__, __MYSQL_PASSWORD__);
        mysql_select_db(__MYSQL_DBNAME__);
        $results = mysql_query("SELECT * FROM Outage");
        $row_count = mysql_num_rows($results);
        $results_array = $this->retrieveAllRecords($results);
        $return_value = new OutageData($row_count, mysql_fetch_array($results));
        mysql_close($connection);
        return $return_value;
    }

    private function retrieveAllRecords($results)
    {
        $array = array();
        while($row = mysql_fetch_array($results, MYSQL_NUM))
        {
            
        }
    }
}
