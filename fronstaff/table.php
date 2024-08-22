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

    <style>
        .table-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0;
        }
        .table-item {
            width: calc(33.33% - 20px); /* 33.33% width for each table item with spacing */
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .table-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .table-item .status-btn {
            display: block;
            margin-top: 10px;
            padding: 8px 15px;
            border-radius: 3px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
        }
        .table-item .status-btn.available {
            background-color: #5cb85c; /* Green color for available */
            color: #fff;
        }
        .table-item .status-btn.unavailable {
            background-color: #d9534f; /* Red color for unavailable */
            color: #fff;
        }
        .w3-button {
}
.w3-content,
.w3-auto {
    margin-left: auto;
    margin-right: auto
}

.w3-content {
    max-width: 980px
}
.w3-center .w3-bar {
    display: inline-block;
    width: auto
}
.w3-bar-block.w3-center .w3-bar-item {
    text-align: center
}
.ibox-content {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            text-align: center;
            margin-bottom: 20px;
        }

        .ibox-content h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .ibox-content p {
            font-size: 16px;
            color: #666;
        }

    </style>
</head>
<body>

    <div id="wrapper">
        <?php include_once('includes/leftbar.php'); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php'); ?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12" style="margin-top:0.3%">
                        <div class="ibox w3-content">
                            <div class="ibox-content">
                            <h2>Manage Table Customer</h2>

                                <div class="table-container">
                                    <?php
                                    $query = "SELECT * FROM booktable";
                                    $ret = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($ret)) {
                                        $statusClass = ($row['table_status'] == 1) ? 'available' : 'unavailable';
                                        $statusText = ($row['table_status'] == 1) ? 'Available' : 'Unavailable';
                                    ?>
                                        <div class="table-item">
                                            <h3><?php echo $row['table_name']; ?></h3><br>
                                            <span><a href="available.php?table_id=<?php echo $row['table_id']; ?>&table_status=<?php echo ($row['table_status'] == 1) ? '0' : '1'; ?>" class="status-btn <?php echo $statusClass; ?>"><?php echo $statusText; ?></a></span>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<script>

</body>

</html>
