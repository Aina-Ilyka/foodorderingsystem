<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');

if (strlen($_SESSION['cust_id'] == 0)) {
    header('location:logout.php');
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // getting address
        $empgender = $_POST['empgender'];
        $otable = $_POST['tablenum'];
        $pickup = $_POST['pickup'] . ':00'; // Append ':00' to the selected pickup time
        $Orequest = $_POST['request'];
        $userid = $_SESSION['cust_id'];
        // generating order number
        $orderno = mt_rand(100000000, 999999999);

// Construct the query based on order type
if ($empgender == 'Pick-Up') {
    $updateQuery = "UPDATE tblorders SET OrderNumber='$orderno', IsOrderPlaced='1' WHERE UserId='$userid' AND IsOrderPlaced IS NULL";

    // Execute the update query
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Perform the insertion
        $insertQuery = "INSERT INTO tblorderaddresses(UserId, Ordernumber, pickuptime, ordertype, Orderrequest) VALUES('$userid', '$orderno', '$pickup', '$empgender', '$Orequest')";
        $insertResult = mysqli_query($con, $insertQuery);

        if ($insertResult) {
            echo '<script>alert("Order placed successfully")</script>';
            echo "<script>window.location.href='paypage.php?onumber=$orderno'</script>";
        } else {
            echo '<script>alert("Failed to insert order details: ' . mysqli_error($con) . ' Query: ' . $insertQuery . '")</script>';
        }
    } else {
        echo '<script>alert("Failed to update order status: ' . mysqli_error($con) . '")</script>';
    }
}     // Construct the query based on order type
if ($empgender == 'Dine-In') {
    $updateQuery = "UPDATE tblorders SET OrderNumber='$orderno', IsOrderPlaced='1' WHERE UserId='$userid' AND IsOrderPlaced IS NULL";

    // Execute the update query
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Attempt to perform the insertion for 'Dine-In'
        $insertQuery = "INSERT INTO tblorderaddresses(UserId, Ordernumber, ordertype, Orderrequest, Ordertable) VALUES('$userid', '$orderno', '$empgender', '$Orequest', '$otable')";

        $insertResult = mysqli_query($con, $insertQuery);

        if ($insertResult) {
            // Insertion successful
            echo '<script>alert("Order placed successfully")</script>';
            echo "<script>window.location.href='paypage.php?onumber=$orderno'</script>";
        } else {
            // Check for duplicate entry on 'Ordertable'
            if (strpos(mysqli_error($con), 'Duplicate entry') !== false) {
                // Handle duplicate entry for 'Dine-In' - you can choose your appropriate action here
                echo '<script>alert("The table is already occupied. Please refer to the staff for following assistance.")</script>';
            } else {
                // Some other error during insertion
                echo '<script>alert("Failed to insert order details: ' . mysqli_error($con) . ' Query: ' . $insertQuery . '")</script>';
            }
        }
    } else {
        echo '<script>alert("Failed to update order status: ' . mysqli_error($con) . '")</script>';
    }
}
    }

    // Code deletion
    if (isset($_GET['delid'])) {
        $rid = $_GET['delid'];
        $deleteQuery = "DELETE FROM tblorders WHERE ID='$rid'";
        $deleteResult = mysqli_query($con, $deleteQuery);

        if ($deleteResult) {
            echo '<script>alert("Food item deleted")</script>';
            echo "<script>window.location.href='cart.php'</script>";
        } else {
            echo '<script>alert("Failed to delete food item: ' . mysqli_error($con) . '")</script>';
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Mee PokSu Dir's Restaurant</title>
    <link rel="shortcut icon" href="assets/images/resource/logo poksu.png" type="image/png">

    <link rel="stylesheet" href="assets/css/icons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/red-color.css">
    <link rel="stylesheet" href="assets/css/yellow-color.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body itemscope>
<?php include_once('includes/header.php');?>


        <section>
            <div class="block">
				<div class="fixed-bg" style="background-image: url(assets/images/dish3.svg);"></div>
                <div class="page-title-wrapper text-center">
					<div class="col-md-12 col-sm-12 col-lg-12">
						<div class="page-title-inner">
							<h1 itemprop="headline">Cart</h1>
						
				
						</div>
					</div>
                </div>
            </div>
        </section>

        <div class="bread-crumbs-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" title="" itemprop="url">Home</a></li>
                    <li class="breadcrumb-item active">My Cart</li>
                </ol>
            </div>
        </div>

        <section>
            <div class="block gray-bg bottom-padd210 top-padd30">
                
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="sec-box">
    							<div class="sec-wrapper">

    							



    <div class="col-md-12 col-sm-12 col-lg-12">

<div class="booking-table">
<table>
<thead>
<tr>
    <th>#</th>
    <th>Food Item</th>
    <th>Qty</th>
    <th>Per Unit Price</th>
       <th>Total</th>
          <th>Action</th>
</tr>
</thead>
<tbody>
    <?php 
$userid= $_SESSION['cust_id'];
$query=mysqli_query($con,"select tblorders.ID as frid,tblfood.Image,tblfood.ItemName,tblfood.ItemDes,tblfood.ItemPrice,tblfood.ItemQty,tblorders.FoodId,tblorders.FoodQty from tblorders join tblfood on tblfood.ID=tblorders.FoodId where tblorders.UserId='$userid' and tblorders.IsOrderPlaced is null");
$num=mysqli_num_rows($query);
if($num>0){
while ($row=mysqli_fetch_array($query)) {
 

?>
<tr>
    <td><img src="admin/itemimages/<?php echo $row['Image']?>" width="100" height="80" alt="<?php echo $row['ItemName']?>"></td>
<td>
    <a href="food-detail.php?fid=<?php echo $row['FoodId'];?>" title="" itemprop="url"><?php echo $row['ItemName']?></a>
</td>
<td>
    <?php echo $qty=$row['FoodQty']?></td>
<td><?php echo 'RM '. $ppu=$row['ItemPrice']?></td>
<td><?php echo 'RM '. number_format($total = $qty * $ppu, 2); ?></td>
<td><a href="cart.php?delid=<?php echo $row['frid'];?>" onclick="return confirm('Do you really want to delete?');";><i class="fa fa-trash" aria-hidden="true" title="Delete this food item"></i><a></span></td>
</tr>

<?php $grandtotal+=$total;}?>
<thead>
<tr>
    <th colspan="4" style="text-align:center;">Grand Total</th>
    <th style="text-align:center;"><?php echo 'RM '. number_format($grandtotal, 2); ?></th>  
<th></th>
</tr>
</thead>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="orderForm">
<tr>                           
<td colspan="4">
     <h4>Order Type<h4><br>
        <div class="container sign-form">
        <label>
            <input type="radio" name="empgender" value="Dine-In" <?php if ($empgender == 'Dine-in') {echo "checked=\"checked\"";}?> onclick="showDiv('dineinDiv')"><span>Dine-In</span>
        </label>
        <label>
            <input  type="radio" name="empgender" value="Pick-Up" <?php if ($empgender == 'Pick-Up') {echo "checked=\"checked\"";}?> onclick="showDiv('pickupDiv')"><span>Pick-Up</span>
        </label>
        </div>

        <?php
        $sql = "SELECT table_id, table_name, table_status FROM booktable";

        $result = $con->query($sql);

        echo '<div id="dineinDiv" style="display: none;">'; // Change 'none' to 'block' to display the div

        if ($result->num_rows > 0) {
            // Output a label for the dropdown
            echo '<label style="margin-top: 20px;">Select Table:</label>';

            // Output the dropdown list
            echo '<select name="tablenum" class="form-control">';
            echo '<option value="">Select Table</option>';

            while ($row = $result->fetch_assoc()) {
                // Use table_id as the value and display table_name in the dropdown
                echo '<option value="' . $row["table_name"] . '"';

                // Check if the table is available (table_status = 1)
                if ($row["table_status"] == 0) {
                    // If not available, disable the option and display a message
                    echo ' disabled';
                    echo '>' . $row["table_name"] . ' (Occupied)</option>';
                } else {
                    // If available, allow the user to select it
                    echo '>' . $row["table_name"] . '</option>';
                }
            }

            echo '</select>';
        } else {
            echo "0 results";
        }

        echo '</div>';

        ?>
        <div id="pickupDiv" style="display: none;">
            <label style="margin-top: 20px;">Pick-Up Time:</label>
            <select name="pickup" class="form-control">
            <option value="">Select Pick-Up Time</option>
            <option value="11:00">11:00 AM</option>
            <option value="11:30">11:30 AM</option>
            <option value="12:00">12:00 PM</option>
            <option value="12:30">12:30 PM</option>
            <option value="13:00">01:00 PM</option>
            <option value="13:30">01:30 PM</option>
            <option value="14:00">02:00 PM</option>
            <option value="14:30">02:30 PM</option>
            <option value="15:00">03:00 PM</option>
            <option value="15:30">03:30 PM</option>
            <option value="16:00">04:00 PM</option>
            <option value="16:30">04:30 PM</option>
            <option value="17:00">05:00 PM</option>
            <option value="17:30">05:30 PM</option>
            <option value="18:00">06:00 PM</option>
            <option value="18:30">06:30 PM</option>
            </select>
        </div>

</td>
</tr>    
<tr>
<td colspan="6"> 
<h3>Special Request</h3><input type="text" name="request" placeholder="Special Request" class="form-control">  
</td>
</tr>
<tr>
    <td colspan="6">
       <button type="submit" name="placeorder" class="btn theme-btn btn-lg">Place order</button>
   </td></tr>
</form>

<script>
document.getElementById('orderForm').addEventListener('submit', function(event) {
        const orderType = document.querySelector('input[name="empgender"]:checked').value;

        if (orderType === 'Dine-In') {
            const tableNumber = document.querySelector('select[name="tablenum"]').value;
            if (tableNumber === '') {
                alert('Please select a Table Number for Dine-In.');
                event.preventDefault();
            }
        } else if (orderType === 'Pick-Up') {
            const pickupTime = document.querySelector('select[name="pickup"]').value;
            if (pickupTime === '') {
                alert('Please select a Pick-Up Time.');
                event.preventDefault();
            }
        }
    });
</script>

<?php } else {?>
    <tr>
        <td colspan="6" style="color:red">You cart is empty</td>
    </tr>
<?php } ?>
</tbody>
</table>
</div>
                                    </div>

    							</div>
                            </div>
                        </div>
                    </div>
                </div><!-- Section Box -->
            </div>
        </section>

    <!-- red section -->
    <?php include_once('includes/footer.php');
      ?>
    </main><!-- Main Wrapper -->
    
    <script>
    function showDiv(divId) {
        // Hide all divs initially
        const divs = document.querySelectorAll('div[id$="Div"]');
        divs.forEach(div => {
            div.style.display = 'none';
        });

        // Display the selected div
        const selectedDiv = document.getElementById(divId);
        if (selectedDiv) {
            selectedDiv.style.display = 'block';
        }
    }
    </script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script src="assets/js/google-map-int2.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
</body>	

</html>
