<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['fs_id']) == 0) {
    header('location:logout.php');
    exit();
} else {
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
            <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Order Details #<?php echo $_GET['orderid'];?></h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                      <?php // Retrieve saved date and status from session variables
                      $savedDate = isset($_SESSION['date']) ? $_SESSION['date'] : '';
                      $savedStatus = isset($_SESSION['status']) ? $_SESSION['status'] : '';

                      $oid = $_GET['orderid'];
                      $ret = mysqli_query($con, "select * from tblorderaddresses where tblorderaddresses.Ordernumber='$oid'");
                      
                      while ($row = mysqli_fetch_array($ret)) {
                          $ordertype = $row['ordertype'];
                          if ($ordertype === 'Dine-In') { ?>
                              <a href="confirmed-order.php?date=<?php echo urlencode($savedDate); ?>&status=<?php echo urlencode($savedStatus); ?>">Order Detail</a>
                          <?php } elseif ($ordertype === 'Pick-Up') { ?>
                              <a href="pickuporder1.php?date=<?php echo urlencode($savedDate); ?>&status=<?php echo urlencode($savedStatus); ?>">Order Detail</a>
                          <?php }
                      } ?>
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
                           <?php
$oid=$_GET['orderid'];
$ret=mysqli_query($con,"select * from tblorderaddresses join customer on customer.cust_id=tblorderaddresses.UserId where tblorderaddresses.Ordernumber='$oid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
<div class="row">
  <div class="col-6">
     <p style="font-size:16px; color:red; text-align: center"><?php if($msg){
    echo $msg;
  }  ?> </p>
<table border="1" class="table table-bordered mg-b-0">
 <tr align="center">
<td colspan="2" style="font-size:20px;color:blue">
 User Details</td></tr>

 <tr>
    <th>Order Number</th>
    <td><?php  echo $row['Ordernumber'];?></td>
  </tr>
  <tr>
    <th>Name</th>
    <td><?php  echo $row['cust_name'];?></td>
  </tr>
  <tr>
    <th>Mobile Number</th>
    <td><?php  echo $row['cust_phone'];?></td>
  </tr>
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
  <tr>
    <th>Order Status</th>
    <td> <?php  
    $orserstatus=$row['OrderFinalStatus'];
if($row['OrderFinalStatus']=="Food is being Prepared")
{
  echo "Food is being Prepared";
}

if($row['OrderFinalStatus']=="Cooking Completed")
{
  echo "Cooking Completed";
}
if($row['OrderFinalStatus']=="Food Picked Up")
{
  echo "Food Picked Up";
}
if($row['OrderFinalStatus']=="Food Served")
{
  echo "Food Served";
}
if($row['OrderFinalStatus']=="Confirmed Order" && $row['paystatus']=="Successful")
{
  echo "Order Confirmed";
}


     ;?></td>
  </tr>
</table>
     </div>
<div class="col-6" style="margin-top:1.3%">
  <?php  
$query=mysqli_query($con,"select tblfood.Image,tblfood.ItemName,tblfood.ItemDes,tblfood.ItemPrice,tblfood.ItemQty,tblfood.CategoryName, tblorders.FoodId,tblorders.FoodQty,tblorders.status from tblorders join tblfood on tblfood.ID=tblorders.FoodId where tblorders.IsOrderPlaced=1 and tblorders.OrderNumber='$oid'");
$num=mysqli_num_rows($query);
$cnt=1;?>
<table border="1" class="table table-bordered mg-b-0">
 <tr align="center">
<td colspan="6" style="font-size:20px;color:blue">
 Order  Details</td></tr> 

 <tr>
    <th>#</th>
<th>Food Name</th>
<th>Qty</th>
<th>Price/Unit</th>
<th>Total</th>
<th style="text-align: center;">Done</th>
</tr>
<?php  
while ($row1=mysqli_fetch_array($query)) {
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
                                                                    if ($foodStatus === 'completed') {
                                                                        echo '<input type="checkbox" disabled checked>';
                                                                    }
                                                                    ?>
                                                                </td>
<!-- Modify your checkbox like this -->                        
</tr>
<?php 
$grandtotal += $qty * $row1['ItemPrice']; // Update grandtotal without using formatted values
$cnt = $cnt + 1;
} ?>
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
                                                                <input type="button" id="completedButton" class="pagination-btn complete-button" name="completedButton" value="Picked Up" style="display: none;" onclick="completeOrder('<?php echo $oid; ?>')">
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
 
</div>
     </div>   
  
<?php } ?>

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
                window.location.href = "viewfoodorder3.php"; // Redirect after clicking OK
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
// Function to complete the order
function completeOrder(orderId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            if (response.success) {
                // Display success message using JavaScript alert
                alert(response.message);

                // Get today's date using PHP (server-side)
                var today = "<?php echo date('Y-m-d'); ?>";

                // Construct the dynamic URL with today's date and pickup status using PHP
                var dynamicURL = "pickuporder1.php?date=" + today + "&status=Cooking+Completed";

                // Redirect to the dynamic URL
                window.location.href = dynamicURL;
            } else {
                // Display failure or invalid request message using JavaScript alert
                alert(response.message);
            }
        }
    };

    // Replace "update_order_prepare.php" with the correct path to your PHP file
    xmlhttp.open("GET", "update_order_status1.php?orderId=" + orderId, true);
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


