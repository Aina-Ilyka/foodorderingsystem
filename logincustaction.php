<?php  
session_start();
include "includes/dbconnection.php";  
  
if(isset($_POST['submit']))  
{  
    $username=$_POST['cust_username'];
    $password=md5($_POST["cust_password"]); 
    $check_user="select * from customer WHERE cust_username='$username' AND cust_password='$password'";  
	
    $run=mysqli_query($con,$check_user);
    if(mysqli_num_rows($run) > 0)  
    {  
        $row = $run->fetch_array();	
        $_SESSION['cust_username']= $username;
        $_SESSION['cust_id']= $row['cust_id'];
        $_SESSION['uemail']= $row['cust_email'];
        $_SESSION['loggedin'] = true;
        header("Location: index.php");
        exit();
      		}
        else  
        {  
        echo "<script>alert('Username or password is incorrect ')</script>";
        header ('refresh:0 url=first.php');
        }  
    }

?>  