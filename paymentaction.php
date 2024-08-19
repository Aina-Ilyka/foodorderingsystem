<?php  
session_start();
include "includes/dbconnection.php";  
$_SESSION['ID'];

if(isset($_POST['submit']))  
{  
    $username=$_POST['dum_username'];
   
    $check_user = "SELECT * FROM dummybank WHERE dum_username='$username' ";  
	
    $run = mysqli_query($con, $check_user);
    $row = ($run) ? $run->fetch_array() : null;

    if($row !== null && is_array($row))  
    {  
        $_SESSION['dum_username'] = $username;
        $_SESSION['ID'];
        $_SESSION['dum_word'] = $row['dum_word'];

        echo "<script>window.open('payment2.php','_self')</script>";  
    }
    else  
    {  
        echo "<script>alert('No user!')</script>";
        header ('refresh:0 url=payment.php?ID=' . $_SESSION['ID']);
    }  
}
?> 
