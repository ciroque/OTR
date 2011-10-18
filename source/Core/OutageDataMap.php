<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/17/11
 * Time: 9:57 AM
 */
 
class OutageDataMap extends ArrayObject
{
    private $row_count = 0;

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

    public function getRowCount()
    {
        return $this->row_count;
    }
}
