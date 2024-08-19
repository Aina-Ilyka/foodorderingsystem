<?php
include_once('includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foodId = $_POST['foodId'];
    $qty = $_POST['qty'];
    $userid=$_SESSION['cust_id'];

    // Validate input to prevent SQL injection

    // Update the quantity in the database
    $updateQuery = "UPDATE tblorders SET FoodQty = '$qty' WHERE FoodId = '$foodId' AND UserId=$userid AND IsOrderPlaced is Null";

    if (mysqli_query($con, $updateQuery)) {
        echo "Quantity updated successfully";
    } else {
        echo "Error updating quantity: " . mysqli_error($con);
    }
} else {
    echo "Invalid request";
}
?>
