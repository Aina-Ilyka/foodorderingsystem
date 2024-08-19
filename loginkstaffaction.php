<?php  
session_start();
include "includes/dbconnection.php";  
  
if(isset($_POST['submit']))  
{  
    $username=$_POST['ks_username'];
    $password=md5($_POST["ks_password"]); 
    $check_user="select * from kstaff WHERE ks_username='$username' AND ks_password='$password' AND ks_status='Active'";  
	
    $run=mysqli_query($con,$check_user);
    if(mysqli_num_rows($run) > 0)  
    {  
        $row = $run->fetch_array();	
        $_SESSION['ks_username']= $username;
        $_SESSION['ks_id']= $row['ks_id'];
        $_SESSION['loggedin'] = true;
        header("Location: kitchenstaff/dashboard.php");
        exit();
      		}
        else  
        {  
        echo "<script>alert('Username or password is incorrect or status is inactive ')</script>";
        header ('refresh:0 url=first.php');
        }  
    }

?>  