<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/14/11
 * Time: 1:55 PM
 * To change this template use File | Settings | File Templates.
 */
 
class MeanTimeBetweenFailuresOutageDataRetriever extends OutageDataRetriever
{
    public function retrieve()
    {
        $sql = "SELECT start_date, end_date FROM Outage;";
        return $this->retrieveImpl($sql);
    }
}
?>