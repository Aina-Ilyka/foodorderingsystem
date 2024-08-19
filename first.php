<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mee Pok Su Dir's Restaurant</title>
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
    <link rel="shortcut icon" href="assets/images/resource/logo poksu.png"/>
  </head>
  <style>
    .content-wrapper{
  background-image: url("assets/images/dish7.svg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
    }
  </style>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow" >
            <div class="col-lg-4 mx-auto" >
              <div class="auth-form-light text-left p-4" >
                <div class="brand-logo">
                  <center><img style="width:40%" src="assets/images/resource/logo poksu.png"></center>
                </div>
                <h5 style="color: black;" >Welcome to the Restaurant Management Center</h5>
                <h6 class="font-weight-light" >Sign in to continue.</h6>

                    <!-- fade start -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="font-size: 14px;">Front Staff</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style="font-size: 14px;">Kitchen Staff</button>
                            <button class="nav-link" id="nav-admin-tab" data-bs-toggle="tab" data-bs-target="#nav-admin" type="button" role="tab" aria-controls="nav-admin" aria-selected="false" style="font-size: 14px;">Admin</button>
                        </div>
                    </nav>
                        <div class="tab-content" id="nav-tabContent">
                        <form class="tab-pane fade show active" id="nav-home" role="form" method="post" action="logincustaction.php" aria-labelledby="nav-home-tab">
                            <center><input class="input-group-text" name="cust_username" placeholder="Username"><br>
                            <input class="input-group-text" type="password" name="cust_password" placeholder="Password"><br>
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            <button class="btn btn-light" type="reset">Cancel</button></center>
                            <center><div class="row">
                            </div></center>
                        </form>
                       
                        <form class="tab-pane fade" id="nav-profile" role="form" method="post" action="loginfstaffaction.php" aria-labelledby="nav-profile-tab">
                        <center><input class="input-group-text" name="fs_username" placeholder="Username"><br>
                            <input class="input-group-text" type="password"name="fs_password" placeholder="Password"><br>
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            <button class="btn btn-light" type="reset">Cancel</button></center>
                        </form>

                        <form class="tab-pane fade" id="nav-contact" role="form" method="post" action="loginkstaffaction.php" aria-labelledby="nav-contact-tab">
                            <center><input class="input-group-text" name="ks_username" placeholder="Username"><br>
                            <input class="input-group-text" type="password" name="ks_password" placeholder="Password"><br>
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            <button class="btn btn-light" type="reset">Cancel</button></center>
                        </form>

                        <form class="tab-pane fade" id="nav-admin" role="form" method="post" action="loginadminaction.php" aria-labelledby="nav-admin-tab">
                            <center><input class="input-group-text" name="admin_username" placeholder="Username"><br>
                            <input class="input-group-text" type="password" name="admin_password" placeholder="Password"><br>
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            <button class="btn btn-light" type="reset">Cancel</button></center>
                        </form>
                        
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
    <script src="assets/js/main.js"></script>
    <!-- endinject -->
  </body>
</html>

