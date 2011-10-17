<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/17/11
 * Time: 4:34 PM
 */
require_once("../ReportGenerators/MeanTimeBetweenFailuresReportGenerator.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
</head>
<body>
<table>
    <tbody>
    <tr>
        <th>Product</th>
        <th>MTBF</th>
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