<?php
session_start();
include('includes/dbconnection.php');

if (isset($_GET['itemName'])) {
    $itemName = $_GET['itemName'];

    if (isset($_SESSION['fromdate']) && isset($_SESSION['todate']) && isset($_SESSION['requesttype'])) {
        $fdate = $_SESSION['fromdate'];
        $tdate = $_SESSION['todate'];
        $requestType = $_SESSION['requesttype'];

        $fstatus = 'Successful';

        if ($requestType == 'mtwise') {
            $query = "SELECT month(OrderTime) as lmonth, year(OrderTime) as lyear, tblfood.ID, tblfood.ItemName as ItemName,
                      sum(tblorders.FoodQty) as QuantitySold, sum(ItemPrice*tblorders.FoodQty) as totalitmprice
                      FROM tblorders 
                      JOIN tblorderaddresses ON tblorderaddresses.Ordernumber = tblorders.OrderNumber 
                      JOIN tblfood ON tblfood.ID = tblorders.FoodId 
                      WHERE date(tblorderaddresses.OrderTime) BETWEEN '$fdate' AND '$tdate' 
                      AND tblorderaddresses.paystatus = '$fstatus' 
                      AND tblfood.ItemName = '$itemName' 
                      GROUP BY lmonth, lyear, tblfood.ID ORDER BY lmonth, lyear";
        } elseif ($requestType == 'yrwise') {
            $query = "SELECT year(OrderTime) as lyear, tblfood.ID, tblfood.ItemName as ItemName,
                      sum(tblorders.FoodQty) as QuantitySold, sum(ItemPrice*tblorders.FoodQty) as totalitmprice
                      FROM tblorders 
                      JOIN tblorderaddresses ON tblorderaddresses.Ordernumber = tblorders.OrderNumber 
                      JOIN tblfood ON tblfood.ID = tblorders.FoodId 
                      WHERE date(tblorderaddresses.OrderTime) BETWEEN '$fdate' AND '$tdate' 
                      AND tblorderaddresses.paystatus = '$fstatus' 
                      AND tblfood.ItemName = '$itemName' 
                      GROUP BY lyear, tblfood.ID ORDER BY lyear";
        }

        $ret = mysqli_query($con, $query);

        $output = '';
        $ftotal = 0;
        $cnt = 1;

        if ($ret && mysqli_num_rows($ret) > 0) {
            while ($row = mysqli_fetch_array($ret)) {
                $output .= '<tr>';
                if ($requestType == 'mtwise') {
                    $output .= '<td>' . $cnt . '</td>';
                    $output .= '<td>' . $row['lmonth'] . '/' . $row['lyear'] . '</td>';
                } elseif ($requestType == 'yrwise') {
                    $output .= '<td>' . $cnt . '</td>';
                    $output .= '<td>' . $row['lyear'] . '</td>';
                }
                $output .= '<td>' . $row['ItemName'] . '</td>';
                $output .= '<td>' . $row['QuantitySold'] . '</td>';
                $output .= '<td>' . 'RM ' . number_format($row['totalitmprice'], 2) . '</td>';
                $output .= '</tr>';
                $ftotal += $row['totalitmprice'];
                $cnt++;
            }
            // Add a row for total at the end of the table
            $output .= '<tr>';
            $output .= '<td colspan="4" align="right">Total</td>';
            $output .= '<td>' . 'RM ' . number_format($ftotal, 2) . '</td>';
            $output .= '</tr>';
        } else {
            $output .= '<tr><td colspan="5">No records found</td></tr>';
        }

        echo $output;
    }
}
?>

