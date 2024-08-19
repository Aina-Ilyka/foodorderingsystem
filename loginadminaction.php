<?php  
session_start();
include "includes/dbconnection.php";  
  
if(isset($_POST['submit']))  
{  
    $username=$_POST['admin_username'];
    $password=$_POST["admin_password"]; 
    $check_user="select * from admin WHERE admin_username='$username' AND admin_password='$password'";  
	
    $run=mysqli_query($con,$check_user);
    if(mysqli_num_rows($run) > 0)  
    {  
        $row = $run->fetch_array();	
        $_SESSION['admin_username']= $username;
        $_SESSION['admin_id']= $row['admin_id'];
        $_SESSION['loggedin'] = true;
        header("Location: admin/dashboard.php");
        exit();
      		}
        else  
        {  
        echo "<script>alert('Username or password is incorrect ')</script>";
        header ('refresh:0 url=first.php');
        }  
    }

?>  