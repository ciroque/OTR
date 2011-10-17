<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/14/11
 * Time: 7:25 PM
 * To change this template use File | Settings | File Templates.
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

        $time_series_data = $retriever->retrieve();
        
        $result = $calculator->calculate(__EPOCH__, $time_series_data);
    }
}
?>
