<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/14/11
 * Time: 1:55 PM
 *
 * A more specific implementation of the OutageDataRetriever generalization targetting the data
 * necessary to build a time series that can be used to calculate Mean Time Between Failures.
 */

require_once("OutageDataRetriever.php");
require_once(dirname(__FILE__) . "/../Core/OutageDataMap.php");

class MeanTimeBetweenFailuresOutageDataRetriever extends OutageDataRetriever
{
    public function retrieve($product = null)
    {
        $sql = "SELECT product, start_date, end_date FROM Outage";
        if(isset($product))
        {
            $sql .= " WHERE product = '$product'";
        }

        $outage_data = $this->retrieveImpl($sql);
        $outage_data_map = new OutageDataMap();

        foreach($outage_data->getResults() as $data)
        {
            $outage_data_map->add($data["product"], $data["start_date"], $data["end_date"]);
        }

        return $outage_data_map;
    }
}
?>