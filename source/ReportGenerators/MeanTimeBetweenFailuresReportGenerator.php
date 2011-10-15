<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/14/11
 * Time: 7:25 PM
 * To change this template use File | Settings | File Templates.
 */

require_once(dirname(__FILE__) . "/../Core/IReportGenerator.php");
require_once(dirname(__FILE__) . "/../Calculators/MeanTimeBetweenFailuresCalculator.php");
require_once(dirname(__FILE__) . "/../DataRetrievers/MeanTimeBetweenFailuresOutageDataRetriever.php");

$result = 0;
$result_label = "";

class MeanTimeBetweenFailuresReportGenerator implements IReportGenerator
{

    public function generate($criteria = null)
    {
        $retriever = new MeanTimeBetweenFailuresOutageDataRetriever();
        $calculator = new MeanTimeBetweenFailuresCalculator();

        $time_series_data = $retriever->retrieve($criteria);
        $result = $calculator->calculate(__EPOCH__, $time_series_data);

        if(isset($criteria))
        {
            $result_label = "All products";
        }
        else
        {
            $result_label = $criteria;
        }
    }
}
?>

<table>
    <tbody>
        <tr>
            <th>Product</th>
            <th>MTBF</th>
        </tr>
        <tr>
            <td><?php echo $result_label; ?></td>
            <td><?php echo $result; ?></td>
        </tr>
    </tbody>
</table>