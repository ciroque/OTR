<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/17/11
 * Time: 4:34 PM
 *
 * Web page that displays all the available reports.
 */
require_once("../ReportGenerators/MeanTimeBetweenFailuresReportGenerator.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <style type="text/css">
        .tip { font-color:blue; font-decoration:underline; cursor:hand; }
    </style>
</head>
<body>
<?php
/* *******************************************************************************
 * Mean Time Between Failures report section.
 */
?>
<table>
    <tbody>
    <tr>
        <th>Product</th>
        <th>MTBF<sup
                class=""
                title="Mean Time Between Failures - denotes the average amount of time the system is up and running between failures being recorded.">1</sup></th>
    </tr>
    <?php
    $generator = new MeanTimeBetweenFailuresReportGenerator();
    $report_values = $generator->generate();
    foreach($report_values as $key => $value)
    {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>