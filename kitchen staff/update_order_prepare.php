<?php
include('includes/dbconnection.php');

header('Content-Type: application/json');

if (isset($_GET['orderId']) && isset($_GET['status'])) {
    $orderId = $_GET['orderId'];
    $status = $_GET['status'];

    // Update OrderFinalStatus in tblorderaddresses
    $query = "UPDATE tblorderaddresses SET OrderFinalStatus = '$status' WHERE Ordernumber = '$orderId'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $response = array(
            'success' => true,
            'message' => 'Order status updated successfully.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Failed to update order status.'
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Invalid request parameters.'
    );
}

echo json_encode($response);
?>
