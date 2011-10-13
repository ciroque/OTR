<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/13/11
 * Time: 11:25 AM
 * To change this template use File | Settings | File Templates.
 */
 
class OutageData {

    private $row_count = 0;
    private $results = null;

    public function OutageData($row_count, $results)
    {
        $this->row_count = $row_count;
        $this->results = $results;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getRowCount()
    {
        return $this->row_count;
    }
}
