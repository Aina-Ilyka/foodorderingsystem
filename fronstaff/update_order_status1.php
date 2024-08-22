<?php
include('includes/dbconnection.php');

header('Content-Type: application/json');

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];

    // Set the timezone to Malaysia
    date_default_timezone_set('Asia/Kuala_Lumpur');

    // Get the OrderTime for the specified orderId
    $getOrderTimeQuery = "SELECT OrderTime FROM tblorderaddresses WHERE Ordernumber = '$orderId'";
    $resultOrderTime = $con->query($getOrderTimeQuery);

    if ($resultOrderTime) {
        $row = $resultOrderTime->fetch_assoc();
        $orderTime = $row['OrderTime'];

        // Create DateTime objects for OrderTime and NOW with the Malaysia timezone
        $orderTimeObj = new DateTime($orderTime, new DateTimeZone('Asia/Kuala_Lumpur'));
        $nowObj = new DateTime('NOW', new DateTimeZone('Asia/Kuala_Lumpur'));

        // Calculate the time difference in seconds
        $timeDifferenceInSeconds = $nowObj->getTimestamp() - $orderTimeObj->getTimestamp();

        // Format the time difference to a time string
        $formattedTimeTaken = gmdate("H:i:s", $timeDifferenceInSeconds);

        // Update the OrderFinalStatus to 'Food Served', CompleteTime, and timetaken
        $updateQuery = "UPDATE tblorderaddresses SET OrderFinalStatus = 'Food Picked Up', completeTime = NOW(), timetaken = '$formattedTimeTaken' WHERE Ordernumber = '$orderId'";
        $result = $con->query($updateQuery);

        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Status, time taken, and completion time updated successfully'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Error updating status, time taken, and completion time: ' . $con->error
            );
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error retrieving OrderTime: ' . $con->error
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
