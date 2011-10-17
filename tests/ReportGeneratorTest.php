<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/14/11
 * Time: 7:10 PM
 * To change this template use File | Settings | File Templates.
 */

require_once(dirname(__FILE__) . "/../source/ReportGenerators/MeanTimeBetweenFailuresReportGenerator.php");

class ReportGeneratorTest extends PHPUnit_Framework_TestCase {

    public function testReportGeneratorWorksForAllProducts()
    {
        $generator = new MeanTimeBetweenFailuresReportGenerator();

        // no criteria
//        $report = $generator->generate();
//        echo $report;
    }
}
