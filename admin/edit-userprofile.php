<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['admin_id']==0)) {
  header('location:logout.php');
  } else{
    if (isset($_POST['submit'])) {
        $sid = $_GET['userid'];
        $fname = $_POST['firstname'];
        $password= md5($_POST['password']);
        $email = $_POST['email'];
        $mobilenumber = $_POST['mobilenumber'];
        $icnum = $_POST['icnum'];
        $status = $_POST['status'];

        $query = mysqli_query($con, "UPDATE fstaff SET fs_name='$fname', fs_password='$password', fs_email='$email', fs_phone='$mobilenumber', fs_ic='$icnum', fs_status='$status' WHERE fs_id='$sid'");

        if ($query) {
            $msg = "User profile has been updated";
        } else {
            $msg = "Something went wrong. Please try again";
        }
    }

 ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Food Ordering System</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="../first/vendors/mdi/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        .card-title {
            color: #001737;
            margin-bottom: 1.625rem;
            text-transform: capitalize;
            font-family: "nunito-regular", sans-serif;
            font-size: 1.125rem;
            font-weight: 600;
        }

        .wrong .mdi-check {
            display: none;
        }

        .good .mdi-close {
            display: none;
        }

        .valid-feedback,
        .invalid-feedback {
            margin-left: calc(2em + 0.25rem + 1.5rem);
        }
    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once('includes/leftbar.php');?>

        <div id="page-wrapper" class="gray-bg">
             <?php include_once('includes/header.php');?>
        <div class="row border-bottom">
       
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Staff Details</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="user-detail.php">Staff Details</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Update</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <p style="font-size:16px; color:red;"> <?php if($msg){
    echo $msg;
  }  ?> </p> 
                      <?php
$sid=$_GET['userid'];
$ret=mysqli_query($con,"SELECT * FROM fstaff where fs_id=$sid
");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
    $fs_password = $row['fs_password'];
    $masked_password = str_repeat('*', strlen($fs_password)); // Masking the password characters
?>
                        <h4 class="card-title"> Front Staff Profile </h4>
                            <form id="submit" action="#" class="wizard-big" method="post" name="submit">
                                    <fieldset>
                                          <div class="form-group row"><label class="col-sm-2 col-form-label" style="font-weight: bold;">Full Name:</label>
                                                <div class="col-sm-10"><input name='firstname' id="firstname" class="form-control white_bg" value="<?php  echo $row['fs_name'];?>">
     
       
   </div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label" style="font-weight: bold;">Username:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" name="lastname" readonly="true" value="<?php  echo $row['fs_username'];?>"></div>
                                            </div>
                                            <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="font-weight: bold;">Password:</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="staffpassword" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" value="<?php  echo $masked_password;?>" required>
                                                <div class="col-6 mt-4 mt-xxl-0 w-auto h-auto">
                                                    <div class="valid-feedback">Good</div>
                                                    <div class="invalid-feedback">Wrong</div>
                                                    <div class="alert px-4 py-3 mb-0 d-none" role="alert" data-mdb-color="warning" id="password-alert">
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="requirements leng">
                                                                <i class="mdi mdi-check text-success me-2"></i>
                                                                <i class="mdi mdi-close text-danger me-3"></i>
                                                                Your password must have at least 8 chars</li>
                                                            <li class="requirements big-letter">
                                                                <i class="mdi mdi-check text-success me-2"></i>
                                                                <i class="mdi mdi-close text-danger me-3"></i>
                                                                Your password must have at least 1 big letter.</li>
                                                            <li class="requirements num">
                                                                <i class="mdi mdi-check text-success me-2"></i>
                                                                <i class="mdi mdi-close text-danger me-3"></i>
                                                                Your password must have at least 1 number.</li>
                                                            <li class="requirements special-char">
                                                                <i class="mdi mdi-check text-success me-2"></i>
                                                                <i class="mdi mdi-close text-danger me-3"></i>
                                                                Your password must have at least 1 special char.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label" style="font-weight: bold;">Email:</label>
                                                <div class="col-sm-10">
                                                 <input type="email" class="form-control" name="email" value="<?php  echo $row['fs_email'];?>">
                                            </div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label" style="font-weight: bold;">Mobile Number:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" name="mobilenumber"  value="<?php  echo $row['fs_phone'];?>"></div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label" style="font-weight: bold;">NRIC:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" name="icnum" value="<?php  echo $row['fs_ic'];?>"></div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label" style="font-weight: bold;">Status:</label>
                                                <div class="col-sm-10"><select class="form-control" name="status" required="true">
                                                    <?php
                                                    $cid = $_GET['userid'];
                                                    $query = "SELECT fs_status FROM fstaff WHERE fs_id='$cid'";
                                                    $result = mysqli_query($con, $query);

                                                    if ($result && mysqli_num_rows($result) > 0) {
                                                        $row = mysqli_fetch_assoc($result);
                                                        $currentStatus = $row['fs_status'];

                                                        $StatusOptions = array("Active", "Taking Leave");

                                                        foreach ($StatusOptions as $status) {
                                                            if ($status == $currentStatus) {
                                                                echo "<option value='$status' selected>$status</option>";
                                                            } else {
                                                                echo "<option value='$status'>$status</option>";
                                                            }
                                                        }
                                                    } else {
                                                        // Default options if no status found in the database
                                                        $stockStatusOptions = array("Active", "Taking Leave");

                                                        foreach ($stockStatusOptions as $status) {
                                                            echo "<option value='$status'>$status</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select></div>
                                            </div>
                                        </fieldset>

                                </fieldset>
                                
                             <?php } ?>
                               
                             <p style="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Update</button></p>
        
            
                                
                               
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        <?php include_once('includes/footer.php');?>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>


    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
       });
    </script>

<script>
        addEventListener("DOMContentLoaded", (event) => {
    const password = document.getElementById("staffpassword");
    const passwordAlert = document.getElementById("password-alert");
    const requirements = document.querySelectorAll(".requirements");
    let lengBoolean, bigLetterBoolean, numBoolean, specialCharBoolean;
    let leng = document.querySelector(".leng");
    let bigLetter = document.querySelector(".big-letter");
    let num = document.querySelector(".num");
    let specialChar = document.querySelector(".special-char");
    const specialChars = "!@#$%^&*()-_=+[{]}\\|;:'\",<.>/?`~";
    const numbers = "0123456789";

    requirements.forEach((element) => element.classList.add("wrong"));

    password.addEventListener("focus", () => {
        passwordAlert.classList.remove("d-none");
        if (!password.classList.contains("is-valid")) {
            password.classList.add("is-invalid");
        }
    });

    password.addEventListener("input", () => {
        let value = password.value;
        if (value.length < 8) {
            lengBoolean = false;
        } else if (value.length > 7) {
            lengBoolean = true;
        }

        if (value.toLowerCase() == value) {
            bigLetterBoolean = false;
        } else {
            bigLetterBoolean = true;
        }

        numBoolean = false;
        for (let i = 0; i < value.length; i++) {
            for (let j = 0; j < numbers.length; j++) {
                if (value[i] == numbers[j]) {
                    numBoolean = true;
                }
            }
        }

        specialCharBoolean = false;
        for (let i = 0; i < value.length; i++) {
            for (let j = 0; j < specialChars.length; j++) {
                if (value[i] == specialChars[j]) {
                    specialCharBoolean = true;
                }
            }
        }

        if (lengBoolean == true && bigLetterBoolean == true && numBoolean == true && specialCharBoolean == true) {
            password.classList.remove("is-invalid");
            password.classList.add("is-valid");

            requirements.forEach((element) => {
                element.classList.remove("wrong");
                element.classList.add("good");
            });
            passwordAlert.classList.remove("alert-warning");
            passwordAlert.classList.add("alert-success");
        } else {
            password.classList.remove("is-valid");
            password.classList.add("is-invalid");

            passwordAlert.classList.add("alert-warning");
            passwordAlert.classList.remove("alert-success");

            if (lengBoolean == false) {
                leng.classList.add("wrong");
                leng.classList.remove("good");
            } else {
                leng.classList.add("good");
                leng.classList.remove("wrong");
            }

            if (bigLetterBoolean == false) {
                bigLetter.classList.add("wrong");
                bigLetter.classList.remove("good");
            } else {
                bigLetter.classList.add("good");
                bigLetter.classList.remove("wrong");
            }

            if (numBoolean == false) {
                num.classList.add("wrong");
                num.classList.remove("good");
            } else {
                num.classList.add("good");
                num.classList.remove("wrong");
            }

            if (specialCharBoolean == false) {
                specialChar.classList.add("wrong");
                specialChar.classList.remove("good");
            } else {
                specialChar.classList.add("good");
                specialChar.classList.remove("wrong");
            }
        }
    });

    password.addEventListener("blur", () => {
        passwordAlert.classList.add("d-none");
    });
});
    </script>

</body>

</html>
   <?php } ?>