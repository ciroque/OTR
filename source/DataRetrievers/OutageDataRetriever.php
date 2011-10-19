<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/13/11
 * Time: 9:09 AM
 */

require_once(dirname(__FILE__) . "/../config.php");
require_once(dirname(__FILE__) . "/../Core/ITimeSeriesRetriever.php");
require_once(dirname(__FILE__) . "/../Core/OutageData.php");

abstract class OutageDataRetriever implements ITimeSeriesRetriever
{
    private $sql_interface = null;

    /**
     * @param ISqlInterface $sql_interface abstracts away the underlying database operation functions.
     * By using implementations of this interface the business logic becomes immune to changes in database vendors.
     * It also allows multiple database engines to be queried for report generation.
     */
    function __construct(ISqlInterface $sql_interface)
    {
        $this->sql_interface = $sql_interface;
    }

    /**
     * @param $selector the SQL statement to be executed.
     * @return OutageData an instance initialized with the data returned from the database.
     */
    protected function retrieveImpl($selector)
    {
        $this->sql_interface->open();
        $results_array = $this->sql_interface->executeSql($selector);
        $this->sql_interface->close();

        $row_count = sizeof($results_array);
        $return_value = new OutageData($row_count, $results_array);
        return $return_value;
    }
}
?>