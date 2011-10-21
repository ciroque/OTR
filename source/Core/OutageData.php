<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/13/11
 * Time: 11:25 AM
 *
 * Abstraction of the data set returned by a given IDataRetriever implementation.
 * NOTE: Probably a bit of overkill, the retrievers *could* return a simple array, but
 * this offers opportunity to stash metadata in with the results as necessary.
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
}
?>