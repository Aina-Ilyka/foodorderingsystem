<?php
include('includes/dbconnection.php');

if (isset($_GET['cancelfood'])) {
    $orderId = intval($_GET['cancelfood']);
    $query = mysqli_query($con, "UPDATE tblorderaddresses SET OrderFinalStatus = 'Order Cancelled' WHERE Ordernumber = '$orderId' AND paystatus = 'Pending'");
    
    if ($query) {
        $response = array('status' => 'success');
        echo json_encode($response);
    } else {
        $response = array('status' => 'error');
        echo json_encode($response);
    }
}
?>
