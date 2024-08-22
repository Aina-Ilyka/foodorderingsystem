<?php
session_start();
include('includes/dbconnection.php');

if (isset($_GET['foodId']) && isset($_GET['orderId']) && isset($_GET['status'])) {
    $foodId = $_GET['foodId'];
    $orderId = $_GET['orderId'];
    $status = $_GET['status'];

    // Update the status in the database
    if ($status === 'completed') {
        // Assuming 'completed' is the status value when the checkbox is checked
        $updateQuery = mysqli_query($con, "UPDATE tblorders SET status = 'completed' WHERE FoodId = '$foodId' AND OrderNumber = '$orderId'");
    } else {
        // Set the status to NULL when the checkbox is unchecked
        $updateQuery = mysqli_query($con, "UPDATE tblorders SET status = NULL WHERE FoodId = '$foodId' AND OrderNumber = '$orderId'");
    }

    if ($updateQuery) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($con);
    }
} else {
    echo "Incomplete data provided";
}
?>
