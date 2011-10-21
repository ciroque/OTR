<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swagner
 * Date: 10/14/11
 * Time: 1:53 PM
 *
 * Interface that defines the common entry points for time series retrieval. 
 */

interface ITimeSeriesRetriever
{
    /**
     * @abstract
     * @return void
     */
    public function retrieve();
}
?>