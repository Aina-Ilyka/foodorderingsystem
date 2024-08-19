<?php
include "includes/dbconnection.php";
session_start();
$_SESSION['ID'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FPX Payment Gateway</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="first/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="first/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="first/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="first/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="first/images/fpx.jpg" />
  </head>
  <style>
    .content-wrapper{
  background-color: white;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  padding-top: 0px;
}
  </style>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" >
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto" >
                <img style="width: 60%" src="first/images/bankislam.png" alt="">
                <img class="float-end" style="width: 30%" src="first/images/fpx.jpg" alt="">
                <div class="auth-form-light text-left p-0" style="background-color:#b0093d">
                            <p class="ms-3 mdi mdi-lock" style="color:white; font-size: 14px">  You are in a secure site</p>
                        </div>
                        <p style="color: black;"><b>FPX Step (3 of 4)</b></p>
                        <form method="post" action="paymentaction3.php">
                        <p class="float-end" style='color: black'>at as <input style="border: none; background-color: transparent" type="text" name="pay_date" value=" <?php
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $date = date('d-m-Y h:i:s ', time());
                echo $date;  
                ?>">MYT
                </p><br>
              <div class="auth-form-light " style="background-color:white">
                <div class="brand-logo">
                </div>
                <div class="auth-form-light text-left p-0" style="background-color:#b0093d">
                            <p class="ms-3 " style="color:white; font-size: 14px"> Payment Details </p>
                        </div>
            
                   <p style="color: black;"><b>From Account*</b><br> <?php echo $_SESSION ['dum_type'] ?> - <?php echo $_SESSION ['dum_accno'] ?>
                      MYR <?php echo $_SESSION ['dum_acctot'] ?></p>
                   <?php 
                    $sql="SELECT * FROM tblorderaddresses AS p
                          JOIN customer AS s
                          ON p.UserId = s.cust_id
                          WHERE ID= '{$_SESSION['ID']}' ";

                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                   ?>
                   <p style="color: black;"><b>Name</b><br><?php echo $row ['cust_name'] ?><br></p>
                   <?php
                   if (!isset($_SESSION['dum_transid'])) {
                    // Generate a new value
                    $_SESSION['dum_transid'] = (sprintf("%'.016d", mt_rand(1, 9999999999999999)));
                }
                
                // Display the stored value
                
                
                   ?>
                   <p style="color: black;"><b>FPX Transaction ID</b><br><input style="border: none;" name="pay_transid" value="<?php echo $_SESSION['dum_transid']; ?>"></p>
                   <p style="color: black;"><b>Order No</b><br><?php echo $row ['Ordernumber'] ?><br></p>
                   <p style="color: black;"><b>Amount</b><br>MYR <input style="border: none" type="text" name="pay_amount" value= "<?php echo number_format((float)$row ['payamnt'], 2, '.', ''); ?>" ></p>
                   <p style="color: black;"><b>*Indicades Mandatory Field</b><br></p>
                   <center><button class="btn btn-danger" style="background-color: #b0093d"  type="submit" name="submit">Pay</button>
                          <a class="btn btn-danger" style="background-color: #b0093d" type="button" href="payment.php?ID=<?php echo $_SESSION['ID']; ?>">Cancel</a><br><br></center>
                    <?php
                    }

                    ?>
                  </form>                 
                        </div>
                        <div class="auth-form-light text-left p-3" style="background-color:#582625">
                            <p class="text-center" style="color:white; font-size: 12px">Bank Islam Malaysia Berhad (98127-X). All right reserved.</p>
                            <p class="text-center" style="color:white; font-size: 12px">The webpage is best viewed using IE 7.0 and above, Chrome 33.0 and
                                    above, Mozilla Firefox 26.0 and above, Safari 5.1.6 and above.</p>
                        </div>
                     <!--fade end -->
                                

              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="first/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="first/js/off-canvas.js"></script>
    <script src="first/js/hoverable-collapse.js"></script>
    <script src="first/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>