<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/12/11
 * Time: 3:18 PM
 */

require_once("MySqlTestDataManager.php");
require_once(dirname(__FILE__) . "/../source/DataRetrievers/OutageDataRetriever.php");
require_once(dirname(__FILE__) . "/../source/DataRetrievers/MeanTimeBetweenFailuresOutageDataRetriever.php");
require_once(dirname(__FILE__) . "/../source/Core/OutageData.php");
require_once(dirname(__FILE__) . "/../source/SqlInterfaces/MySqlInterface.php");

/**
 * Tests for OutageDataRetriever
 */
class MeanTimeBetweenFailuresOutageDataRetrieverTest extends PHPUnit_Framework_TestCase {

    public function testRetrieverReturnsTimeSeriesForSpecificProduct()
    {
        $sql_interface = new MySqlInterface(
            __MYSQL_OUTAGE_HOSTNAME__,
            __MYSQL_OUTAGE_DBNAME__,
            __MYSQL_OUTAGE_USERNAME__,
            __MYSQL_OUTAGE_PASSWORD__);
        $retriever = new MeanTimeBetweenFailuresOutageDataRetriever($sql_interface);
        $retrieved = $retriever->retrieve("Product1");
        $this->assertEquals(3, $retrieved->getRowCount());

        $retrieved = $retriever->retrieve("Product2");
        $this->assertEquals(2, $retrieved->getRowCount());

        $retrieved = $retriever->retrieve("Product3");
        $this->assertEquals(2, $retrieved->getRowCount());
    }

    public static function setUpBeforeClass()
    {
        MySqlTestDataManager::setUpDatabase();
    }

    public static function tearDownAfterClass()
    {
        MySqlTestDataManager::tearDownDatabase();
    }
}
?>