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
        $return_value = new OutageData(mysql_num_rows($results), mysql_fetch_array($results));
        mysql_close($connection);
        return $return_value;
    }
}
