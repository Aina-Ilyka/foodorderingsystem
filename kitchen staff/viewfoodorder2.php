<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ks_id']==0)) {
  header('location:logout.php');
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
   /* Style for the Next button */
   .pagination-btn.next-button {
            padding: 8px 16px;
            margin-right: 10px;
            text-decoration: none;
            background-color: #28a745; /* Green color for Prepare and Complete buttons */
            color: #fff;
            border: 1px solid #28a745;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }

        .pagination-btn.next-button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: black;
        }

        /* Style for the Prepare and Complete buttons */
        .prepare-button,
        .complete-button {
            padding: 8px 16px;
            margin-right: 10px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }

        .prepare-button:hover,
        .complete-button:hover {
            background-color: #218838; /* Darker green on hover */
            border-color: #218838;
            color: #fff;
        }

        .pagination-section {
            margin-top: 20px;
            text-align: right;
        }

        .pagination-info {
            margin-top: 10px;
            margin-right: 10px;
            font-size: 14px;
            color: #888;
        }

        .pagination-buttons {
            margin-top: 10px;
        }

        /* Style for the Next button */
        .next-button {
            padding: 8px 16px;
            margin-right: 10px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }

        .next-button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: black;
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
                <?php
                    date_default_timezone_set('Asia/Kuala_Lumpur');
                    $today = date('Y-m-d');

                    $start=0;
                    $rows_per_page =1;

                    $records = $con->query("SELECT * FROM tblorderaddresses WHERE paystatus='Successful' AND ordertype='Dine-In' AND OrderFinalStatus='Food is being Prepared' AND DATE(OrderTime) = '$today' ORDER BY OrderTime ASC");
                    $nr_of_rows=$records->num_rows;

                    $pages=$nr_of_rows / $rows_per_page;

                    if(isset($_GET['page-nr'])){
                        $page = $_GET['page-nr']-1;
                        $start = $page * $rows_per_page;
                    }
                    
                    $result = $con->query("SELECT * FROM tblorderaddresses WHERE paystatus='Successful' AND ordertype='Dine-In' AND OrderFinalStatus='Food is being Prepared' AND DATE(OrderTime) = '$today' ORDER BY OrderTime ASC LIMIT $start,$rows_per_page ");
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                ?>

                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-10">
                            <h2>Order Details #<?php echo $row['Ordernumber'];?></h2>
                        </div>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <?php
                                        $oid = $row['Ordernumber'];
                                        $ret = mysqli_query($con, "SELECT * FROM tblorderaddresses JOIN customer ON customer.cust_id = tblorderaddresses.UserId WHERE tblorderaddresses.Ordernumber='$oid'");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p style="font-size:16px; color:red; text-align: center">
                                                        <?php if ($msg) {
                                                            echo $msg;
                                                        } ?>
                                                    </p>
                                                    <table border="1" class="table table-bordered mg-b-0">
                                                        <tr align="center">
                                                            <td colspan="2" style="font-size:20px;color:blue">User Details</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-3">Order Number</th>
                                                            <td><?php  echo $row['Ordernumber'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Name</th>
                                                            <td><?php  echo $row['cust_name'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Order Type</th>
                                                            <td><?php echo $row['ordertype']; ?></td>
                                                        </tr>

                                                        <?php if ($row['ordertype'] === 'Dine-In') { ?>
                                                        <tr>
                                                            <th>Order Table</th>
                                                            <td><?php echo $row['Ordertable']; ?></td>
                                                        </tr>
                                                        <?php } elseif ($row['ordertype'] === 'Pick-Up') { ?>
                                                        <tr>
                                                            <th>Pick-Up Time</th>
                                                            <td><?php echo $row['pickuptime']; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                        <?php if (!empty($row['Orderrequest'])) { ?>
                                                        <tr>
                                                            <th>Order Request</th>
                                                            <td><?php echo $row['Orderrequest']; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <th>Order Date</th>
                                                            <td><?php  echo $row['OrderTime'];?></td>
                                                        </tr>
                                                            <th>Order Status</th>
                                                            <td>
                                                                <?php
                                                                $orderStatus = $row['OrderFinalStatus'];
                                                                if ($orderStatus == "Food is being Prepared") {
                                                                    echo "Food is being Prepared";
                                                                } elseif ($orderStatus == "Cooking Completed") {
                                                                    echo "Cooking Completed";
                                                                } elseif ($orderStatus == "Food Picked Up") {
                                                                    echo "Food Picked Up";
                                                                } elseif ($orderStatus == "Food Served") {
                                                                    echo "Food Served";
                                                                } elseif ($orderStatus == "Confirmed Order" && $row['paystatus'] == "Successful") {
                                                                    echo "Payment for your order has been received. Your meal is on its way to the kitchen.";
                                                                } 
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="col-6" style="margin-top:1.3%">
                                                    <?php
                                                    $oid = $row['Ordernumber'];
                                                    $query = mysqli_query($con, "SELECT tblfood.Image, tblfood.ItemName, tblfood.ItemDes, tblfood.ItemPrice, tblfood.ItemQty, tblfood.CategoryName, tblorders.FoodId, tblorders.FoodQty, tblorders.status FROM tblorders JOIN tblfood ON tblfood.ID = tblorders.FoodId WHERE tblorders.IsOrderPlaced = 1 AND tblorders.OrderNumber = '$oid'");
                                                    $num = mysqli_num_rows($query);
                                                    $cnt = 1;
                                                    ?>
                                                    <table border="1" class="table table-bordered mg-b-0">
                                                        <tr align="center">
                                                            <td colspan="6" style="font-size:20px;color:blue">Order Details</td>
                                                        </tr> 
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Food Name</th>
                                                            <th>Qty</th>
                                                            <th>Price/Unit</th>
                                                            <th>Total</th>
                                                            <th style="text-align: center;">Done</th>
                                                        </tr>
                                                        <?php  
                                                        while ($row1 = mysqli_fetch_array($query)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $cnt; ?></td>
                                                                <td><?php echo $row1['ItemName']; ?></td>
                                                                <td><?php echo $qty = $row1['FoodQty']; ?></td>
                                                                <td><?php echo $ppu = number_format($row1['ItemPrice'], 2); ?></td>
                                                                <td><?php echo $total = number_format($qty * $ppu, 2); ?></td>
                                                                <td style="text-align: center;">
                                                                    <?php
                                                                    $foodCategory = $row1['CategoryName'];
                                                                    $foodStatus = $row1['status'];
                                                                    
                                                                    // Disable checkbox and keep it checked if category is not "Drink" and status is "completed"
                                                                    if ($foodCategory !== 'Drink' && $foodStatus === 'completed') {
                                                                        echo '<input type="checkbox" disabled checked>';
                                                                    } else {
                                                                        // For other cases, render the checkbox as usual
                                                                        echo '<input id="food_done_' . $row1['FoodId'] . '_' . $oid . '" type="checkbox" name="food_done[]" value="' . $row1['FoodId'] . '" onchange="updateStatus(this, \'' . $row1['FoodId'] . '\', \'' . $oid . '\')">';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php 
                                                            $grandtotal += $qty * $row1['ItemPrice']; // Update grandtotal without using formatted values
                                                            $cnt = $cnt + 1;?>

                                                            <div class="row col-6">
                                                        <?php } ?>
                                                        <tr>
                                                            <th colspan="5" style="text-align:center">Grand Total</th>
                                                            <td><?php echo number_format($grandtotal, 2); ?></td>
                                                        </tr>
                                                    </table> 
                                                    <?php if ($drinkCategoryExists) { ?>
                                                        <tr>
                                                            <td colspan="6" style="text-align: center;">
                                                                <!-- Display only the Drink button when 'Drink' category exists -->
                                                                <button id="drinkButton" class="pagination-btn prepare-button" onclick="openDrinkPopup()">Prepare Drink</button>
                                                            </td>
                                                        </tr>
                                                    <?php } else { ?>
                                                        <!-- Display the Completed button if 'Drink' category doesn't exist -->
                                                        <tr>
                                                            <td colspan="6" style="text-align: center;">
                                                                <input type="button" id="completedButton" class="pagination-btn complete-button" name="completedButton" value="Completed" style="display: none;" onclick="completeOrder('<?php echo $oid; ?>')">
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    <div class="row pagination-section">
                                                        <div class="col-lg-12 text-right" style="margin-top:15%;">
                                                            <?php
                                                                if(!isset($_GET['page-nr'])){
                                                                    $page = 1;
                                                                }else{
                                                                    $page = $_GET['page-nr'];
                                                                }

                                                            ?>
                                                            <div class="pagination-info">Showing <?php echo $page ?> of <?php echo $pages?> pages</div>
                                                        </div>
                                                        <div class="col-lg-12 text-right" style="margin-top:3%;"> <!-- Aligning content to the right -->
                                                            <?php
                                                            if (!isset($_GET['page-nr']) || ($_GET['page-nr'] < $pages) || ($pages == 1)) {
                                                                $nextPage = isset($_GET['page-nr']) ? ($_GET['page-nr'] + 1) : 2;
                                                                $nextPage = ($nextPage > $pages) ? 1 : $nextPage;
                                                            ?>
                                                                <a href="?page-nr=1" class="next-button">First Order</a>
                                                                <a href="?page-nr=<?php echo $nextPage; ?>" class="next-button">Next</a>
                                                            <?php } else { ?>
                                                                <a href="?page-nr=1" class="next-button">First Order</a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                        <?php }} else {
                                                    // If no rows are fetched, display a message indicating no records for today
                                                    echo '
                                                    <script>
                                                        if(confirm("All drink orders for today have been completed. Click OK to go to dashboard.")) {
                                                            window.location.href = "dashboard.php";
                                                        }
                                                    </script>';

                                                    echo '
                                                    <div class="container mt-5">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <div class="alert alert-info text-center">
                                                                <p><strong>All drink orders for today have been completed.</strong></p>
                                                                <p>Click on the button below to go to the dashboard.</p>
                                                                <a href="dashboard.php" class="btn btn-primary">OK</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';}
                                        ?>

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
    // Function to update checkbox status based on order ID
    function updateStatus(checkbox, foodId, orderId) {
        if (checkbox.checked) {
            // Update local storage with checkbox state
            localStorage.setItem('food_done_' + foodId + '_' + orderId, 'checked');

            // AJAX request to update status to 'completed' when checkbox is checked
            updateDatabaseStatus(foodId, orderId, 'completed');
        } else {
            // Remove checkbox state from local storage if unchecked
            localStorage.removeItem('food_done_' + foodId + '_' + orderId);

            // AJAX request to update status to null when checkbox is unchecked
            updateDatabaseStatus(foodId, orderId, null);
        }
        

        checkAllCheckboxes(orderId);
    }

    // Function to update status in the database via AJAX
    function updateDatabaseStatus(foodId, orderId, statusValue) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // On success, perform any additional actions if needed
                console.log("Status updated successfully");
            }
        };

        // Replace "update_status.php" with your server-side script or endpoint URL
        xmlhttp.open("GET", "update_status.php?foodId=" + foodId + "&orderId=" + orderId + "&status=" + statusValue, true);
        xmlhttp.send();
    }

        // Function to open the drink popup and change the OrderFinalStatus
   // Function to open the drink popup and change the OrderFinalStatus
function openDrinkPopup() {
    var orderId = '<?php echo $oid; ?>';

    // AJAX request to update OrderFinalStatus to 'Food is being Prepared'
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            if (response.success) {
                // Display success message using JavaScript alert
                alert(response.message);
                window.location.href = "viewfoodorder2.php"; // Redirect after clicking OK
            } else {
                // Display failure or invalid request message using JavaScript alert
                alert(response.message);
            }
        }
    };

    // Replace "update_order_prepare.php" with the correct path to your PHP file that updates the status
    xmlhttp.open("GET", "update_order_prepare.php?orderId=" + orderId + "&status=Food is being Prepared", true);
    xmlhttp.send();
}



    // Function to enable/disable the Completed button based on checkbox status
    function checkAllCheckboxes(orderId) {
        var checkboxes = document.querySelectorAll('input[name="food_done[]"][id^="food_done_"]');
        var allChecked = true;

        checkboxes.forEach(function (checkbox) {
            if (!checkbox.checked) {
                allChecked = false;
            }
        });

        var completedButton = document.getElementById('completedButton');
        if (allChecked) {
            completedButton.style.display = 'block';
        } else {
            completedButton.style.display = 'none';
        }
    }

// Function to complete the order
function completeOrder(orderId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            if (response.success) {
                // Display success message using JavaScript alert
                alert(response.message);
                window.location.href = "viewfoodorder2.php"; // Redirect after clicking OK
            } else {
                // Display failure or invalid request message using JavaScript alert
                alert(response.message);
            }
        }
    };

    // Replace "update_order_prepare.php" with the correct path to your PHP file
    xmlhttp.open("GET", "update_order_status.php?orderId=" + orderId, true);
    xmlhttp.send();
}



    // Load checkbox states for a specific order when the page is loaded
    document.addEventListener('DOMContentLoaded', function () {
        loadCheckboxStatesForOrder('<?php echo $oid; ?>');
        checkAllCheckboxes('<?php echo $oid; ?>'); // Check initial status on page load
    });
    </script>

    <script>
    // Function to load checkbox states from local storage based on order number
    function loadCheckboxStatesForOrder(orderId) {
        var checkboxes = document.querySelectorAll('input[name="food_done[]"][id^="food_done_"]');
        checkboxes.forEach(function (checkbox) {
            var foodId = checkbox.value;
            var isChecked = localStorage.getItem('food_done_' + foodId + '_' + orderId);
            if (isChecked === 'checked') {
                checkbox.checked = true;
            }
        });
    }

    // Load checkbox states for a specific order when the page is loaded
    document.addEventListener('DOMContentLoaded', function () {
        loadCheckboxStatesForOrder('<?php echo $oid; ?>');
    });
    </script>

</body>
</html>


