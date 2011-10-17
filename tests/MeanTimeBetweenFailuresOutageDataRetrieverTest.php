<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/12/11
 * Time: 3:18 PM
 */

require_once("TestDataManager.php");
require_once(dirname(__FILE__) . "/../source/DataRetrievers/OutageDataRetriever.php");
require_once(dirname(__FILE__) . "/../source/DataRetrievers/MeanTimeBetweenFailuresOutageDataRetriever.php");
require_once(dirname(__FILE__) . "/../source/Core/OutageData.php");


/**
 * Tests for OutageDataRetriever
 */
class MeanTimeBetweenFailuresOutageDataRetrieverTest extends PHPUnit_Framework_TestCase {

    public function testRetrieverReturnsTimeSeriesForSpecificProduct()
    {
        $retriever = new MeanTimeBetweenFailuresOutageDataRetriever();
        $retrieved = $retriever->retrieve("Product1");
        $this->assertEquals(3, $retrieved->getRowCount());

        $retrieved = $retriever->retrieve("Product2");
        $this->assertEquals(2, $retrieved->getRowCount());

        $retrieved = $retriever->retrieve("Product3");
        $this->assertEquals(2, $retrieved->getRowCount());
    }

    public static function setUpBeforeClass()
    {
        TestDataManager::setUpDatabase();
    }

    public static function tearDownAfterClass()
    {
        TestDataManager::tearDownDatabase();
    }
}
?>