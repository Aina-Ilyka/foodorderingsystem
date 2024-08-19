<?php
include "includes/dbconnection.php";
session_start();
$_SESSION['ID']= $_GET['ID'];
header("refresh:3; url=payment.php?ID=" . $_GET['ID']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><b>Please wait while you are redirecting to secure bank sites...</b></p>
</body>
</html>