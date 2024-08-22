<?php
include('includes/dbconnection.php');

header('Content-Type: application/json');

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];

    // Update the OrderFinalStatus to 'Cooking Completed'
    $updateQuery = "UPDATE tblorderaddresses SET OrderFinalStatus = 'Cooking Completed' WHERE Ordernumber = '$orderId'";
    $result = $con->query($updateQuery);

    if ($result) {
        $response = array(
            'success' => true,
            'message' => 'Status updated successfully'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error updating status: ' . $con->error
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Invalid request'
    );
}

echo json_encode($response);
?>

