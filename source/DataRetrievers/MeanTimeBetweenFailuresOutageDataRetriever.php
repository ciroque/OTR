<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/14/11
 * Time: 1:55 PM
 * To change this template use File | Settings | File Templates.
 */

require_once("OutageDataRetriever.php");

class MeanTimeBetweenFailuresOutageDataRetriever extends OutageDataRetriever
{
    public function retrieve($product = null)
    {
        $sql = "SELECT start_date, end_date FROM Outage";
        if(isset($product))
        {
            $sql .= " WHERE product = '$product'";
        }
        return $this->retrieveImpl($sql);
    }
}
?>