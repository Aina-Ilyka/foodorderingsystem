<?php
   session_start();
   //error_reporting(0);
   include_once('includes/dbconnection.php');
   if (!isset($_SESSION['cust_id'])) {
  header('location:logout.php');
  } else{

    //Update Profile
    if(isset($_POST['updateprofile']))
  {
    $sid=$_SESSION['cust_id'];
    $fname=$_POST['fullname'];
    $lname=$_POST['username'];


    $query=mysqli_query($con, "update customer set cust_name='$fname', cust_username='$lname' where cust_id='$sid'");


    if ($query) {
    $msg="Your profile has been updated";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

}

// change Password
if(isset($_POST['changepassword']))
{
$userid=$_SESSION['cust_id'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select cust_id from customer where cust_id='$userid' and   cust_password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update customer set cust_password='$newpassword' where cust_id='$userid'");
$msg= "Your password successully changed"; 
} else {

$msg="Your current password is wrong";
}



}

   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="" />
      <meta name="keywords" content="" />
      <title>Mee PokSu Dir's Restaurant</title>
      <link rel="shortcut icon" href="assets/images/resource/logo poksu.png" type="image/png">
      <link rel="stylesheet" href="assets/css/icons.min.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/main.css">
      <link rel="stylesheet" href="assets/css/red-color.css">
      <link rel="stylesheet" href="assets/css/yellow-color.css">
      <link rel="stylesheet" href="assets/css/responsive.css">
      <script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
} 

</script>
          <script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
   </head>
   <body itemscope>
      <?php include_once('includes/header.php');?>
      <section>
         <div class="block">
            <div class="fixed-bg" style="background-image: url(assets/images/dish3.svg);"></div>
            <div class="page-title-wrapper text-center">
               <div class="col-md-12 col-sm-12 col-lg-12">
                  <div class="page-title-inner">
                     <h1 itemprop="headline">My Account</h1>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="bread-crumbs-wrapper">
         <div class="container">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="index.php" title="" itemprop="url">Home</a></li>
               <li class="breadcrumb-item active">Dashboard</li>
            </ol>
         </div>
      </div>
      <section>
         <div class="block less-spacing gray-bg top-padd30">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-lg-12">
                     <div class="sec-box">
                        <div class="dashboard-tabs-wrapper">
                           <div class="row">
                              <div class="col-md-4 col-sm-12 col-lg-4">
                                 <div class="profile-sidebar brd-rd5 wow fadeIn" data-wow-delay="0.2s">
                                    <div class="profile-sidebar-inner brd-rd5">

                                <?php
$pid=$_SESSION['cust_id'];
$ret=mysqli_query($con,"select * from customer where cust_id='$pid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>  

                                       <div class="user-info red-bg">
                                          <img class="brd-rd50" src="assets/images/profile.png" alt="user-avatar.jpg" itemprop="image">
                                          <div class="user-info-inner">
                                             <h5 itemprop="headline"><a href="#" title="" itemprop="url"><?php  echo $row['cust_name'];?></a></h5>
                                             <span><a href="#" title="" itemprop="url"><?php  echo $row['cust_email'];?></a></span>
                                             <a class="brd-rd3 sign-out-btn yellow-bg" href="logout.php" title="" itemprop="url"><i class="fa fa-sign-out"></i> SIGN OUT</a>
                                          </div>
                                       </div>
                                   <?php } ?>
                                       <ul class="nav nav-tabs">
                                       
                                      
                                          <li class="active"><a href="#my-orders" data-toggle="tab"><i class="fa fa-shopping-basket"></i> MY ORDERS</a></li>
                                          <li><a href="#my-pending" data-toggle="tab"><i class="fa fa-money"></i> Payment Pending </a></li>
                                          <li><a href="#my-past" data-toggle="tab"><i class="fa fa-history"></i> Order History</a></li>
                                          <li><a href="#statement" data-toggle="tab"><i class="fa fa-wpforms"></i> Change Password</a></li>
                                          <li><a href="#account-settings" data-toggle="tab"><i class="fa fa-cog"></i> Profile</a></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-8 col-sm-12 col-lg-8">
                                 <div class="tab-content">
                                                            <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
                  
                                    <div class="tab-pane fade in active" id="my-orders">
                                       <div class="tabs-wrp brd-rd5">
                                          <h4 itemprop="headline">MY ORDERS</h4>
                                          <hr />
                                          <div class="select-wrap-inner">
                                     
                                          </div>
                                          <div class="order-list">

<?php
$uid=$_SESSION['cust_id'];
date_default_timezone_set('Asia/Kuala_Lumpur');
// Get today's date in the format matching your OrderTime attribute (assuming it's in 'Y-m-d' format)
$today = date('Y-m-d');
$query = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE UserId='$uid' AND DATE(OrderTime) = '$today' AND paystatus='Successful' ORDER BY OrderTime DESC");
      $count=1;
      $num=mysqli_num_rows( $query);
      if($num>0){
              while($row=mysqli_fetch_array($query))
              { ?>  

                                             <div class="order-item brd-rd5">
                                                <div class="order-thumb brd-rd5">
                                                   <a href="#" title="" itemprop="url"><img src="assets/images/order.jpg" alt="order-img1.jpg" itemprop="image"></a>
                                            
                                                </div>
                                                <div class="order-info">
                                                   <span class="red-clr"><b>Order Date :</b> <?php echo $row['OrderTime']?></span>
                                                   <h4 itemprop="headline" font-size:12px;><a href="#" title="" itemprop="url">Order # <?php echo $row['Ordernumber'];?></a></h4>
                                                   <span class="processing brd-rd3" style="margin-left:2px; width:51%; text-align:center; font-size:12px;"> <?php $status=$row['OrderFinalStatus'];
if($status==''){
 echo "Payment is pending";   
} else{
echo $status;
}

                                                    ?></span>
                                                   <a class="brd-rd2" style="margin-top:2px;" href="order-details.php?onumber=<?php echo $row['Ordernumber'];?>" title="Order Detail" itemprop="url">Order Details</a>

                                                   <ul class="post-meta">
                                                               
                                    
                                                                    </ul>
                                                </div>
                                             </div>
                                         <?php } } else {?>
                                    <h5 style="color:red">No order found</h5>
                                     <?php } ?>
                                          </div>
                                
                                          <!-- Pagination Wrapper -->
                                       </div>
                                    </div>

                                    <div class="tab-pane fade in " id="my-pending">
                                       <div class="tabs-wrp brd-rd5">
                                          <h4 itemprop="headline">Payment Pending</h4>
                                          <hr />
                                          <div class="select-wrap-inner">
                                     
                                          </div>
                                          <div class="order-list">

<?php
$uid=$_SESSION['cust_id'];
date_default_timezone_set('Asia/Kuala_Lumpur');
// Get today's date in the format matching your OrderTime attribute (assuming it's in 'Y-m-d' format)
$today = date('Y-m-d');
      $query = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE UserId='$uid' AND DATE(OrderTime) = '$today' AND paystatus='pending' ORDER BY OrderTime ASC");

      $count=1;
      $num=mysqli_num_rows( $query);
      if($num>0){
              while($row=mysqli_fetch_array($query))
              { ?>  

                                             <div class="order-item brd-rd5">
                                                <div class="order-thumb brd-rd5">
                                                   <a href="#" title="" itemprop="url"><img src="assets/images/order.jpg" alt="order-img1.jpg" itemprop="image"></a>
                                            
                                                </div>
                                                <div class="order-info">
                                                   <span class="red-clr"><b>Order Date :</b> <?php echo $row['OrderTime']?></span>
                                                   <h4 itemprop="headline" font-size:12px;><a href="#" title="" itemprop="url">Order # <?php echo $row['Ordernumber'];?></a></h4>
                                                   <span class="processing brd-rd3" style="margin-left:2px; width:51%; text-align:center; font-size:12px;"> <?php $status=$row['OrderFinalStatus'];
if($status==''){
 echo "Payment is pending";   
} else{
echo $status;
}

                                                    ?></span>
                                                   <a class="brd-rd2" style="margin-top:2px;" href="order-details.php?onumber=<?php echo $row['Ordernumber'];?>" title="Order Detail" itemprop="url">Order Details</a>

                                                   <ul class="post-meta">
                                                               
                                    
                                                                    </ul>
                                                </div>
                                             </div>
                                         <?php } } else {?>
                                    <h5 style="color:red">No order found</h5>
                                     <?php } ?>
                                          </div>
                                
                                          <!-- Pagination Wrapper -->
                                       </div>
                                    </div>

                                    <div class="tab-pane fade in " id="my-past">
                                       <div class="tabs-wrp brd-rd5">
                                          <h4 itemprop="headline">MY ORDERS</h4>
                                          <hr />
                                          <div class="select-wrap-inner">
                                     
                                          </div>
                                          <div class="order-list">

<?php
$uid=$_SESSION['cust_id'];
$today = date('Y-m-d');
$query = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE UserId='$uid' AND (OrderFinalStatus='Food Served' OR OrderFinalStatus='Food Picked Up') AND DATE(OrderTime) != '$today' ORDER BY OrderTime DESC");


      $count=1;
      $num=mysqli_num_rows( $query);
      if($num>0){
              while($row=mysqli_fetch_array($query))
              { ?>  

                                             <div class="order-item brd-rd5">
                                                <div class="order-thumb brd-rd5">
                                                   <a href="#" title="" itemprop="url"><img src="assets/images/order.jpg" alt="order-img1.jpg" itemprop="image"></a>
                                            
                                                </div>
                                                <div class="order-info">
                                                   <span class="red-clr"><b>Order Date :</b> <?php echo $row['OrderTime']?></span>
                                                   <h4 itemprop="headline" font-size:12px;><a href="#" title="" itemprop="url">Order # <?php echo $row['Ordernumber'];?></a></h4>
                                                   <span class="processing brd-rd3" style="margin-left:2px; width:51%; text-align:center; font-size:12px;"> <?php $status=$row['OrderFinalStatus'];
if($status==''){
 echo "Waiting for Restaurant confirmation";   
} else{
echo $status;
}

                                                    ?></span>
                                                   <a class="brd-rd2" style="margin-top:2px;" href="order-details.php?onumber=<?php echo $row['Ordernumber'];?>" title="Order Detail" itemprop="url">Order Details</a>

                                                   <ul class="post-meta">
                                                               
                                    
                                                                    </ul>
                                                </div>
                                             </div>
                                         <?php } } else {?>
                                    <h5 style="color:red">No order found</h5>
                                     <?php } ?>
                                          </div>
                                
                                          <!-- Pagination Wrapper -->
                                       </div>
                                    </div>
              
                                    <div class="tab-pane fade" id="statement">
                                       <div class="tabs-wrp brd-rd5">
                                          <h4 itemprop="headline">Change Password</h4>
                                      
            <form method="post" class="profile-info-form" name="changepassword" onsubmit="return checkpass();">
                                         <div class="col-md-12 col-sm-12 col-lg-12">
                                                               <label>Current Password<sup>*</sup></label>
                                                               <input class="brd-rd3" type="password" name="currentpassword" id="currentpassword"required="true">
                                                            </div>

   <div class="col-md-12 col-sm-12 col-lg-12">
                                                               <label>New Password<sup>*</sup></label>
                                                               <input class="brd-rd3" type="password" id="newpassword" value="" name="newpassword" required="true">
                                                            </div>

   <div class="col-md-12 col-sm-12 col-lg-12">
                                                               <label>Confirm Password<sup>*</sup></label>
                                                               <input class="brd-rd3" type="password" id="confirmpassword" value="" name="confirmpassword" required="true">
                                                            </div>


                      
                                                         <div class="col-md-12 col-sm-12 col-lg-12">
                                <button class="red-bg brd-rd3" type="submit" name="changepassword" style="color: white;">Change Password</button>
                            </div>
                                                        </form>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-settings">
                                       <div class="tabs-wrp account-settings brd-rd5">
                                          <h4 itemprop="headline">My Profile</h4>
                                          <div class="account-settings-inner">
                                             <div class="row">
                                     

<?php
$pid=$_SESSION['cust_id'];
$ret=mysqli_query($con,"select * from customer where cust_id='$pid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>    
<form method="post" class="profile-info-form">
                                                <div class="col-md-12 col-sm-12 col-lg-12">
                                                   <div class="profile-info-form-wrap">
                                                      <form class="profile-info-form">
                                                         <div class="row mrg20">
                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                               <label>Full Name<sup>*</sup></label>
                                                               <input class="brd-rd3" type="text" value="<?php  echo $row['cust_name'];?>" id="fullname" name="fullname" required="true">
                                                            </div>

                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                               <label>Username<sup>*</sup></label>
                                                               <input class="brd-rd3" type="text" value="<?php  echo $row['cust_username'];?>" id="username" name="username" required="true">
                                                            </div>

                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                               <label>Email address <sup>*</sup></label>
                                                               <input class="brd-rd3" type="text" name="email" value="<?php  echo $row['cust_email'];?>" readonly="true">
                                                            </div>
                                                      
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                               <label>Mobile Number <sup>*</sup></label>
                                                               <input class="brd-rd3" type="text" id="mobilenumber" name="mobilenumber" value="<?php  echo $row['cust_phone'];?>" readonly="true">
                                                            </div>
                                                       
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                               <label>Registraton Date </label>
                                                               <input class="brd-rd3" type="text" name="regdate" value="<?php  echo $row['RegDate'];?>" readonly="true">
                                                            </div>
                                                      
                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <button class="red-bg brd-rd3" type="submit" name="updateprofile" style="color: white;">Update Profile</button>
                                                         </div>
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
</form>
                                            <?php } ?>
                            
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Section Box -->
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php include_once('includes/footer.php');
               ?>
      </main><!-- Main Wrapper -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/plugins.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
      <script src="assets/js/google-map-int.js"></script>
      <script src="../../www.google.com/recaptcha/api.js"></script>
      <script src="assets/js/main.js"></script>
   </body>
</html>
<?php } ?>