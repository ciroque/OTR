<?php

require_once(dirname(__FILE__) . "/../config.php");
require_once(dirname(__FILE__) . "/../Core/ITimeSeriesRetriever.php");
require_once(dirname(__FILE__) . "/../Core/OutageData.php");

/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/13/11
 * Time: 9:09 AM
 */
abstract class OutageDataRetriever implements ITimeSeriesRetriever
{
    /**
     * @return OutageData an instance initialized with the data returned from the database.
     */
    protected function retrieveImpl($selector)
    {
        $connection = mysql_connect(__MYSQL_HOSTNAME__, __MYSQL_USERNAME__, __MYSQL_PASSWORD__);
        mysql_select_db(__MYSQL_DBNAME__);
        $results = mysql_query($selector);
        $row_count = mysql_num_rows($results);
        $results_array = $this->buildArrayFromResults($results);
        $return_value = new OutageData($row_count, $results_array);
        mysql_close($connection);
        return $return_value;
    }

    /**
     * @param $results
     * @return void
     */
    private function buildArrayFromResults($results)
    {
        $array = array();
        while($row = mysql_fetch_array($results, MYSQL_ASSOC))
        {
            $array[] = $row;
        }
        return $array;
    }
}
?>