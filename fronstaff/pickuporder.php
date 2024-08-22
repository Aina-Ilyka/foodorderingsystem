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
        <form action="" method="GET">
            <div class="row align-items-end">
                <div style="width: 20%; margin-right: 5px;">
                    <input type="date" name="date" required value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>" class="form-control">
                </div>
                <div  style="width: 22%; margin-right: 5px;">
                    <select name="status" required class="form-select" >
                        <option value="">Select Status</option>
                        <option value="Confirmed Order" <?= isset($_GET['status']) == true ? ($_GET['status'] == 'Confirmed Order' ? 'selected' : '') : '' ?>>Confirmed Order</option>
                        <option value="Food is being Prepared" <?= isset($_GET['status']) == true ? ($_GET['status'] == 'Food is being Prepared' ? 'selected' : '') : '' ?>>Food is being prepared</option>
                        <option value="Cooking Completed" <?= isset($_GET['status']) == true ? ($_GET['status'] == 'Cooking Completed' ? 'selected' : '') : '' ?>>Cooking completed</option>
                        <option value="Food Picked Up" <?= isset($_GET['status']) == true ? ($_GET['status'] == 'Food Picked Up' ? 'selected' : '') : '' ?>>Food Picked Up</option>
                    </select>
                </div>
                <div style="width: 24%;">
                    <select name="pickup" required class="form-select" style="width: 100%;">
                    <option value="">Select Pick-Up Time</option>
                    <option value="11:00 AM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '11:00 AM' ? 'selected' : '') : '' ?>>11:00 AM</option>
                    <option value="11:30 AM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '11:30 AM' ? 'selected' : '') : '' ?>>11:30 AM</option>
                    <option value="12:00 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '12:00 PM' ? 'selected':'') :'' ?>>12:00 PM</option>
                    <option value="12:30 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '12:30 PM' ? 'selected':'') :'' ?>>12:30 PM</option>
                    <option value="1:00 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '13:00 PM' ? 'selected':'') :'' ?>>13:00 PM</option>
                    <option value="1:30 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '13:30 PM' ? 'selected':'') :'' ?>>13:30 PM</option>
                    <option value="2:00 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '14:00 PM' ? 'selected':'') :'' ?>>14:00 PM</option>
                    <option value="2:30 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '14:30 PM' ? 'selected':'') :'' ?>>14:30 PM</option>
                    <option value="3:00 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '15:00 PM' ? 'selected':'') :'' ?>>15:00 PM</option>
                    <option value="3:30 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '15:30 PM' ? 'selected':'') :'' ?>>15:30 PM</option>
                    <option value="4:00 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '16:00 PM' ? 'selected':'') :'' ?>>16:00 PM</option>
                    <option value="4:30 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '16:30 PM' ? 'selected':'') :'' ?>>16:30 PM</option>
                    <option value="5:00 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '17:00 PM' ? 'selected':'') :'' ?>>17:00 PM</option>
                    <option value="5:30 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '17:30 PM' ? 'selected':'') :'' ?>>17:30 PM</option>
                    <option value="6:00 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '18:00 PM' ? 'selected':'') :'' ?>>18:00 PM</option>
                    <option value="6:30 PM" <?= isset($_GET['pickup']) == true ? ($_GET['pickup'] == '18:30 PM' ? 'selected':'') :'' ?>>18:30 PM</option>
                    </select>
                </div>
                <div style="margin-left: 20px; margin-bottom:3px;">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="pickuporder.php" class="btn btn-danger">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ... (Remaining HTML code remains unchanged) -->

                            <?php
                            $condition = "";
                            if (isset($_GET['date']) && $_GET['date'] != '') {
                                $date = $_GET['date'];
                                $_SESSION['date'] = $date;
                                $condition .= " AND DATE(OrderTime) = '$date'";
                            }
                            if (isset($_GET['status']) && $_GET['status'] != '') {
                                $status = $_GET['status'];
                                $_SESSION['status'] = $status;
                                $condition .= " AND OrderFinalStatus = '$status'";
                            }
                            if (isset($_GET['pickup']) && $_GET['pickup'] != '') {
                                $pickup = $_GET['pickup'];
                                $_SESSION['pickup'] = $pickup;
                                $condition .= " AND pickuptime = '$pickup'";
                            }

                            $query = "SELECT * FROM tblorderaddresses WHERE paystatus='Successful' AND ordertype='Pick-Up' $condition ORDER BY OrderTime ASC";

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
                        <td><?php echo date("h:i A", strtotime($row['pickuptime'])); ?></td>
                        <td><a href="viewfoodorder.php?orderid=<?php echo $row['Ordernumber']; ?>">View Details</a></td>
                    </tr>
                <?php
                    $cnt++;
            }
            ?>
    </tbody>
</table>
<?php
            } else {
                echo '<h5>No Record Found</h5>';
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
