<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/14/11
 * Time: 7:10 PM
 */

require_once("TestDataManager.php");
require_once(dirname(__FILE__) . "/../source/ReportGenerators/MeanTimeBetweenFailuresReportGenerator.php");

class ReportGeneratorTest extends PHPUnit_Framework_TestCase {

    public function testReportGeneratorWorksForAllProducts()
    {
        $generator = new MeanTimeBetweenFailuresReportGenerator();
        $report = $generator->generate();

        $this->assertEquals(4, sizeof($report));

        $expected_names = TestDataManager::getDistinctProductNames();
        foreach($expected_names as $name)
        {
            $this->assertTrue(array_key_exists($name, $report));
        }

        array_key_exists("All Products", $report);
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
