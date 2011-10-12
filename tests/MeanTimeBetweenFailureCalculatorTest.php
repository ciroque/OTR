<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/12/11
 * Time: 11:20 AM
 */

require_once(dirname(__FILE__) . "/../source/MeanTimeBetweenFailuresCalculator.php");

class MeanTimeBetweenFailuresCalculatorTest extends PHPUnit_Framework_TestCase {
    public $start_up_time_seed = "0001-01-01 00:00:00";

    public function setUp(){ }
    public function tearDown(){ }

    /**
     * Tests a simple case of MTBF calculation: (1 + 1) / 2
     * @return void
     */
    public function testMeanTimeBetweenFailureCalculationAgainstSimpleList()
    {
        $records = $this->buildSimpleRecordList();
        $mtbfCalculator = new MeanTimeBetweenFailuresCalculator();

        $this->assertEquals((1 + 1) / 2, $mtbfCalculator->calculate($this->start_up_time_seed, $records));
    }

    /**
     * Tests a more complex case of MTBF calculation: (226 + 497) / 2
     * @return void
     */
    public function testMeanTimeBetweenFailureCalculationAgainstComplexList()
    {
        $records = $this->buildComplexRecordList();
        $mtbfCalculator = new MeanTimeBetweenFailuresCalculator();

        $this->assertEquals((226 + 496.5) / 2, $mtbfCalculator->calculate($this->start_up_time_seed, $records));
    }

    private function buildComplexRecordList()
    {
        // zero index of second dimension array is the start of outage,
        // one index of second dimension array is the end of the outage.
        return array(
            array("0001-01-10 10:00:00", "0001-01-10 10:30:00"),
            array("0001-01-31 03:00:00", "0001-01-01 04:00:00"),
        );
    }

    private function buildSimpleRecordList()
    {
        // zero index of second dimension array is the start of outage,
        // one index of second dimension array is the end of the outage.
        return array(
            array("0001-01-01 01:00:00", "0001-01-01 02:00:00"),
            array("0001-01-01 03:00:00", "0001-01-01 04:00:00"),
        );
    }
}
