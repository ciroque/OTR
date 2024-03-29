<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/12/11
 * Time: 1:49 PM
 *
 * Implementation of the ITimeSeriesCalculator interface that calculates the Mean Time Between Failures.
 */

require_once(dirname(__FILE__) . "/../Core/ITimeSeriesCalculator.php");

define ("SECONDS_PER_HOUR", 60 * 60);

class MeanTimeBetweenFailuresCalculator implements ITimeSeriesCalculator
{

    private $down_count = 0;

    /**
     * @param $epoch the initial date / time that should be considered by the calculations.
     * @param $time_series array containing two date fields (zero index is the start date/time, one index is the end date / time)
     * @return a value representing the result of the calculation performed against the time series.
     */
    public function calculate($epoch, array $time_series)
    {
        $this->down_count = 0;
        $prev_up_time = $epoch;
        $down_time_sum = 0;
        foreach($time_series as $record)
        {
            $this->down_count++;
            $down_time_sum += ((strtotime($record["start_date"]) - strtotime($prev_up_time)) / SECONDS_PER_HOUR);
            $prev_up_time = $record["end_date"];
        }

        return $this->down_count == 0 ? 0 : $down_time_sum / $this->down_count;
    }
}
?>