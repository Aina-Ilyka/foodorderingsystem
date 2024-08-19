<?php
session_start();
error_reporting(0);
include 'includes/dbconnection.php';
$_SESSION['ID'];

if (isset($_POST['submit'])) {
    $date = $_POST['pay_date'];
    $transid = $_POST['pay_transid'];
    $amount = $_POST['pay_amount'];
    $poid = $_SESSION['ID'];

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql1 = "SELECT pay_amount FROM payment WHERE ID=$poid";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $payamount = $row1['pay_amount'];

    $sql2 = "SELECT dum_acctot FROM dummybank";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $dumacctot = $row2['dum_acctot'];

    if ($payamount < $dumacctot) {
        $sql3 = "INSERT INTO payment (pay_transid, pay_date, pay_amount, pay_status, ID) VALUES ('$transid', '$date', '$amount', 'Successful', $poid)";
        $result3 = mysqli_query($con, $sql3);
        $sql4 = "UPDATE dummybank SET dum_acctot = dum_acctot - $amount ";
        $result4 = mysqli_query($con, $sql4);
        $sql5 = "UPDATE tblorderaddresses SET paystatus='Successful', OrderFinalStatus='Confirmed Order' WHERE ID=$poid";
        $result5 = mysqli_query($con, $sql5);

    } else 
	if ($payamount > $dumacctot) {
        $sql7 = "INSERT INTO payment (pay_transid, pay_date, pay_amount, pay_status, ID) VALUES ('$transid', '$date', '$amount', 'Failed', $poid)";
        $result7 = mysqli_query($con, $sql7);
        $sql8= "UPDATE tblorderaddresses SET paystatus='Failed' WHERE ID=$poid ";
        $result8 = mysqli_query($con, $sql8);
    }

    if (isset($result3) && isset($result4) && isset($result5)) {
        echo "<script type='text/javascript'>alert('Payment successful!')</script>";
        header("refresh:1; url=payment5.php");
    }
    if (isset($result7) && isset($result8)) {
        echo "<script type='text/javascript'>alert('Payment failed. Insufficient funds!')</script>";
        header("refresh:1; url=payment5.php");
    }
}
?>
