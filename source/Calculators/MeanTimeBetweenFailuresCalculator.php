<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/12/11
 * Time: 1:49 PM
 * To change this template use File | Settings | File Templates.
 */

require_once("../Core/ITimeSeriesCalculator.php");

define ("SECONDS_PER_HOUR", 60 * 60);

class MeanTimeBetweenFailuresCalculator implements ITimeSeriesCalculator {

    private $down_count = 0;

    /**
     * @param $up_time_seed the initial date / time that should be considered by the calculations.
     * @param $time_series array containing two date fields (zero index is the start date/time, one index is the end date / time)
     * @return a value representing the result of the calculation performed against the time series.
     */
    public function calculate($up_time_seed, array $time_series)
    {
        $prev_up_time = $up_time_seed;
        $down_time_sum = 0;
        foreach($time_series as $record)
        {
            $this->down_count++;
            $down_time_sum += ((strtotime($record[0]) - strtotime($prev_up_time)) / SECONDS_PER_HOUR);
            $prev_up_time = $record[1];
        }

        return $this->down_count == 0 ? 0 : $down_time_sum / $this->down_count;
    }
}
?>