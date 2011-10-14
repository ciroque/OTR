<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/13/11
 * Time: 11:25 AM
 */
class OutageData {

    private $row_count = 0;
    private $results = null;

    /**
     * @param $row_count the number of rows present in $results;
     * @param array $results the time series data retrieved from the database.
     * @return void
     */
    public function OutageData($row_count, array $results)
    {
        $this->row_count = $row_count;
        $this->results = $results;
    }

    /**
     * @return array | null the time series data retrieved from the database.
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return int | the number of rows in the time series data.
     */
    public function getRowCount()
    {
        return $this->row_count;
    }
}
