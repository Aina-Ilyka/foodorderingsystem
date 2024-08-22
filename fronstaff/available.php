<?php
session_start();
include('includes/dbconnection.php');

$id= $_GET['table_id'];
$status= $_GET['table_status'];

$updatequery = " UPDATE booktable SET table_status=$status WHERE table_id=$id";
mysqli_query($con,$updatequery);
header('location:table.php');

?>