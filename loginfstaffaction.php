<?php  
session_start();
include "includes/dbconnection.php";  
  
if(isset($_POST['submit']))  
{  
    $username=$_POST['fs_username'];
    $password=md5($_POST["fs_password"]);
    $check_user="select * from fstaff WHERE fs_username='$username' AND fs_password='$password' AND fs_status='Active'";  
	
    $run=mysqli_query($con,$check_user);
    if(mysqli_num_rows($run) > 0)  
    {  
        $row = $run->fetch_array();	
        $_SESSION['fs_username']= $username;
        $_SESSION['fs_id']= $row['fs_id'];
        $_SESSION['loggedin'] = true;
        header("Location: frontstaff/dashboard.php");
        exit();
      		}
        else  
        {  
        echo "<script>alert('Username or password is incorrect ')</script>";
        header ('refresh:0 url=first.php');
        }  
    }

?>  