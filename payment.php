<?php
session_start();
$_SESSION['ID']= $_GET['ID'];
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
                <p class="float-end"  style="color: black;"><b>FPX Step 1 of 4</b></p><br><br>
            
              <div class="auth-form-light text-left p-3" style="background-color:#b0093d">
                <div class="brand-logo">
                </div>
                <center><h6 style="color: white; font-family: arial;" >WELCOME TO BANK ISLAM <br>INTERNET BANKING</h6><br></center>
                    
                        <form class="p-6" id="" role="form" method="post" action="paymentaction.php" aria-labelledby="nav-contact-tab">
                            <h6 style="color: white; font-family: arial;" >USER ID</h6>
                        <input class="input-group-text " style="width: 100%" name="dum_username" placeholder="Username"><br>
                            <button class="btn btn-secondary" type="submit" name="submit">Login</button><br>
                            <a class="btn btn-secondary float-end" type="button" name="cancel" href="index.php">Cancel Transaction</a>

                        </form><br><br>
                
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