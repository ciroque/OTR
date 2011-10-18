<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/14/11
 * Time: 7:25 PM
 */

require_once(dirname(__FILE__) . "/../Core/IReportGenerator.php");
require_once(dirname(__FILE__) . "/../Calculators/MeanTimeBetweenFailuresCalculator.php");
require_once(dirname(__FILE__) . "/../DataRetrievers/MeanTimeBetweenFailuresOutageDataRetriever.php");

$result = 0;
$result_label = "";

class MeanTimeBetweenFailuresReportGenerator implements IReportGenerator
{

    public function generate()
    {
        $retriever = new MeanTimeBetweenFailuresOutageDataRetriever();
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
