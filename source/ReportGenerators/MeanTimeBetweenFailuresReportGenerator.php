<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/14/11
 * Time: 7:25 PM
 *
 * Glues all the bits and pieces together to actually realize the report values for the
 * Mean Time Between Failures report.
 */

require_once(dirname(__FILE__) . "/../Core/IReportGenerator.php");
require_once(dirname(__FILE__) . "/../Calculators/MeanTimeBetweenFailuresCalculator.php");
require_once(dirname(__FILE__) . "/../DataRetrievers/MeanTimeBetweenFailuresOutageDataRetriever.php");
require_once(dirname(__FILE__) . "/../SqlInterfaces/MySqlInterface.php");

class MeanTimeBetweenFailuresReportGenerator implements IReportGenerator
{

    public function generate()
    {
        $sql_interface = new MySqlInterface(
            __MYSQL_HOSTNAME__,
            __MYSQL_DBNAME__,
            __MYSQL_USERNAME__,
            __MYSQL_PASSWORD__);

        $retriever = new MeanTimeBetweenFailuresOutageDataRetriever($sql_interface);
        $calculator = new MeanTimeBetweenFailuresCalculator();

        $outage_data_map = $retriever->retrieve();

        $result_array = array();

        foreach($outage_data_map as $key => $value)
        {
            $result_array[$key] = $calculator->calculate(__EPOCH__, $value);
        }

        $result_array["All Products"] = $calculator->calculate(__EPOCH__, $outage_data_map->getAllDataPoints());

        return $result_array;
    }
}
?>
