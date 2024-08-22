<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['fs_id']==0)) {
  header('location:logout.php');
  exit;
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

<style>
.table {
  --bs-table-bg: transparent;
  --bs-table-accent-bg: transparent;
  --bs-table-striped-color: #212529;
  --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
  --bs-table-active-color: #212529;
  --bs-table-active-bg: rgba(0, 0, 0, 0.1);
  --bs-table-hover-color: #212529;
  --bs-table-hover-bg: #f0f1f6;
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  vertical-align: top;
  border-color: rgba(151, 151, 151, 0.3); }
  .page-title {
  color: #111;
  font-size: 1.125rem;
  margin-bottom: 0; }
  .filter-section {
        margin-bottom: 30px;
    }
  input.form-control[type='date'] {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ccc;
        /* Additional styles if needed */
    }

    /* Styles for select with class .form-select */
    select.form-select {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ccc;
        /* Additional styles if needed */
    }

    /* Optional: Hover and focus styles for better user interaction */
    input.form-control[type='date']:hover,
    select.form-select:hover {
        border-color: #333; /* Change border color on hover */
    }

    input.form-control[type='date']:focus,
    select.form-select:focus {
        outline: none; /* Remove outline on focus */
        border-color: #555; /* Change border color on focus */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Add a subtle box-shadow on focus */
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
            
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                                    <!-- ... (Previous HTML code remains unchanged) -->

<div class="row filter-section">
    <div class="col-md-5">
        <p style="color: blue; font-size: 20px">Order list [Pick-Up]</p>
    </div>
    <div class="col-md-7" >
        
    </div>
</div>

<!-- ... (Remaining HTML code remains unchanged) -->

                            <?php
                                                date_default_timezone_set('Asia/Kuala_Lumpur');
                                                $today = date('Y-m-d');
                        

                            $query = "SELECT * FROM tblorderaddresses WHERE paystatus='Successful' AND ordertype='Pick-Up' AND DATE(OrderTime) = '$today' AND OrderFinalStatus='Cooking Completed' ORDER BY OrderTime ASC";

                            $ret = mysqli_query($con, $query);
                            $cnt = 1;
                            if ($ret) {
                                if (mysqli_num_rows($ret) > 0) {
                            ?>

                            <table id="myTable" class="table table-striped ">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Order Number</th>
                                <th>Order Time</th>
                                <th>Pick-Up Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
    <!-- ... (Table headers remain unchanged) -->
    <tbody>
                <?php
               while ($row = mysqli_fetch_array($ret)) 
            {
        ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $row['Ordernumber']; ?></td>
                        <td><?php echo $row['OrderTime']; ?></td>
                        <td><?php echo $row['pickuptime']; ?></td>
                        <td><a href="viewpickup3.php?orderid=<?php echo $row['Ordernumber']; ?>">View Details</a></td>
                    </tr>
                <?php
                    $cnt++;
            }
            ?>
    </tbody>
</table>
<?php
            } else {
                echo '<div class="alert alert-info text-center">
                <p><strong>All orders for today have been picked.</strong></p>
                <p>Click on the button below to go to the dashboard.</p>
                <a href="dashboard.php" class="btn btn-primary">OK</a>
                </div>';
            }
        } else {
            echo '<h5>Something Went Wrong</h5>';
        }
        ?>

                           
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
    </script>
</body>

</html>
