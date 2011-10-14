<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/12/11
 * Time: 11:56 AM
 */

/**
 * The iTimeSeriesCalculator interface which defines the methods required to implement a standard calculation against
 * a list of time series data.
 */
interface ITimeSeriesCalculator {

    /**
     * @abstract given a multi-dimensional array perform a calculation and return the result.
     * @param $up_time_seed the initial date / time that should be considered by the calculations.
     * @param $time_series array containing two date fields (zero index is the start date/time, one index is the end date / time)
     * @return a value representing the result of the calculation performed against the time series.
     */
    public function calculate($up_time_seed, array $time_series);
}
