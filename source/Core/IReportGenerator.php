<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/14/11
 * Time: 7:15 PM
 *
 * Interface that defines the common entry points for report generation.
 */

interface IReportGenerator {

    /**
     * @abstract Responsible for gathering all necessary data and returning an array containing
     * the results to be displayed. It is best to avoid any manner of formatting in the return
     * of this method as then the data can be used by various formatting / display algorithms
     * as desired.
     * @return void | array the values representing the output of the report.
     */
    public function generate();
}
