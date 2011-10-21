<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/17/11
 * Time: 9:57 AM
 *
 * ArrayObject implementation that acts as a Map to contain time series data segmented by
 * a key (such as the Product name). This grouping allows easier calculation on a per-Product
 * basis as well as rolled up to the full project stack.
 */
 
class OutageDataMap extends ArrayObject
{
    private $row_count = 0;

    /**
     * Adds a record to the Map.
     * The key allows grouping of the various outage time series entries (by Product most often,
     * but can be anything, really). Since PHP array are truly maps under the covers performance
     * should be acceptable using them in this manner.
     * @param $key the grouping value for the time series data.
     * @param $start_date the date / time the outage began.
     * @param $end_date the date / time the outage ended.
     * @return the newly added Map entry.
     */
    public function add($key, $start_date, $end_date)
    {
        if(!array_key_exists($key, $this))
        {
            $this[$key] = array();
        }

        $this[$key][] = array("start_date" => $start_date, "end_date" => $end_date);

        $this->row_count++;

        return $this[$key];
    }

    /**
     * Allows access to the fully de-normalized (all time series data without the key groupings)
     * time series data stored in the Map.
     * @return array the full time series data set.
     */
    public function getAllDataPoints()
    {
        $full_array = array();
        foreach($this as $key)
        {
            foreach($key as $record)
            {
                $full_array[] = $record;
            }
        }

        return $full_array;
    }

    /**
     * @return int the number of items in the Map. This number does not take into account the groupings.
     */
    public function getRowCount()
    {
        return $this->row_count;
    }
}
