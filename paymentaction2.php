<?php
session_start();
include "includes/dbconnection.php";

if (isset($_POST['submit'])) {
    $username = $_SESSION['dum_username'];
    $password = $_POST['dum_password'];

    // Use prepared statement to prevent SQL injection
    $check_user_query = "SELECT * FROM dummybank WHERE dum_username=? AND dum_password=?";
    $stmt = mysqli_prepare($con, $check_user_query);
    
    if ($stmt) {
        // Bind the parameters and execute the query
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);

        // Get the result set
        $result = mysqli_stmt_get_result($stmt);

        // Fetch the first row
        $row = mysqli_fetch_assoc($result);

        // Check if user exists
        if ($row) {
            $_SESSION['dum_username'] = $username;
            $_SESSION['dum_type'] = $row['dum_type'];
            $_SESSION['dum_accno'] = $row['dum_accno'];
            $_SESSION['dum_acctot'] = $row['dum_acctot'];

            // Redirect to payment4.php
            echo "<script>window.open('payment4.php', '_self')</script>";
        } else {
            // Invalid Password
            echo "<script>alert('Invalid Password!')</script>";
            header('refresh:0 url=payment3.php');
        }
    } else {
        // Handle query preparation failure
        echo "<script>alert('Error preparing the query!')</script>";
        header('refresh:0 url=payment3.php');
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
