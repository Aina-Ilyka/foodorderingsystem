<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
// Retrieve order number from URL
$ordernumber = isset($_GET['onumber']) ? $_GET['onumber'] : null;

if (strlen($_SESSION['cust_id']) == 0 || empty($ordernumber)) {
    header('location:logout.php');
  } else{

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
    <script language="javascript" type="text/javascript">
    var popUpWin=0;
    function popUpWindow(URLStr, left, top, width, height)
    {
    if(popUpWin)
    {
    if(!popUpWin.closed) popUpWin.close();
    }
    popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
    }
    </script>
    <style>
    /* Style for the payment button link */
    a.payment-link {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        border: 2px solid #c33332;
        color: #fff;
        background-color: #c33332;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Hover effect */
    a.payment-link:hover {
        background-color: #fd9f13;
        border-color: #fd9f13;
    }


</style>
</head>
<body itemscope>
<?php include_once('includes/header.php');?>


        <section>
            <div class="block">
            <div class="fixed-bg" style="background-image: url(assets/images/dish3.svg);"></div>
                <div class="page-title-wrapper text-center">
					<div class="col-md-12 col-sm-12 col-lg-12">
						<div class="page-title-inner">
							<h1 itemprop="headline">Order #<?php echo $_GET['onumber'];?> Details</h1>
						
				
						</div>
					</div>
                </div>
            </div>
        </section>

        <div class="bread-crumbs-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Payment page</li>
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


    <div class="col-md-12 col-sm-12 col-lg-12" > 
<div class="booking-table">

 <?php
$userid= $_SESSION['cust_id'];
$oid=$_GET['onumber'];
    $updateQuery = "UPDATE tblorderaddresses SET paystatus='Pending' WHERE UserId='$userid' AND Ordernumber='$oid'";
    $result = mysqli_query($con, $updateQuery);

      $query=mysqli_query($con,"select * from  tblorderaddresses  where UserId='$userid' and Ordernumber='$oid'");
      if ($query) {
      $count=1;
              while($row=mysqli_fetch_array($query))
              { ?>     
                <h3 align="center">Order #<?php echo $oid;?> Details</h3>
<table border="1" style="padding-left:10%">
<tr>
<th style="text-align: center;">Order Number</th>
<td><?php echo $row['Ordernumber'];?></td>   
<th style="text-align: center;">Order Date/Time</th>
<td><?php echo $row['OrderTime']?></td>
</tr>
<tr>
<th style="text-align: center;">Order Status</th> 
<td colspan="3" style=" padding-right:70px;"><?php $status = $row['OrderFinalStatus'];
if($status==''){
 echo "Payment is pending";   
} else{
echo $status;
}

    ?> </td>   
</tr>
<tr>
    <th colspan="4" style="text-align:center;color:blue; font-size:20px; padding-left:130px;">Other Details</th>
</tr>

<tr>
<th style="text-align: center;">Order Type</th>
<td><?php echo $row['ordertype']?></td> 
    <?php if ($row['ordertype'] === 'Dine-In') { ?>
<th style="text-align: center;">Order Table</th>
<td><?php echo $row['Ordertable']; ?></td>
    <?php } elseif ($row['ordertype'] === 'Pick-Up') { ?>
<th style="text-align: center;">Pick-Up Time</th>
<td><?php echo date("h:i A", strtotime($row['pickuptime'])); ?></td>
    <?php } ?>
</tr>

<?php if (!empty($row['Orderrequest'])) { ?>
  <tr>
    <th style="text-align: center;">Order Request</th>
    <td><?php echo $row['Orderrequest']; ?></td>
<?php } else { ?>
    <th style="text-align: center;">Order Request</th>
    <td>No order request</td>
<?php } ?>
<th style="text-align: center;">Payment Status</th>
<td><?php echo $row['paystatus']?></td>
</tr>

</table>
<?php } 

} else {
    // Debugging: Print SQL error
    echo "SQL Error: " . mysqli_error($con);
}?>


<hr />
<p style="font-size:22px; color:red; font-weight:bold; margin-top:40px; text-align:center;">Order Details</p>
<table>
<thead>
<tr>
    <th>#</th>
    <th>Food Item</th>
    <th>Qty</th>
    <th>Per Unit Price</th>
       <th>Total</th>

</tr>
</thead>
<tbody>
<?php 
$userid = $_SESSION['cust_id'];
$oid = $_GET['onumber'];
$query=mysqli_query($con,"select tblfood.Image,tblfood.ItemName,tblfood.ItemDes,tblfood.ItemPrice,tblfood.ItemQty,tblorders.FoodId,tblorders.FoodQty 
    from tblorders 
    join tblfood on tblfood.ID=tblorders.FoodId 
    where tblorders.UserId='$userid' and tblorders.IsOrderPlaced=1 and tblorders.OrderNumber='$oid'");
$num=mysqli_num_rows($query);
$grandtotal = 0; // Initialize grand total
while ($row=mysqli_fetch_array($query)) {
    // Calculation of total for each food item
    $qty = $row['FoodQty'];
    $ppu = $row['ItemPrice'];
    $total = $qty * $ppu;
    $grandtotal += $total; // Accumulate the total for grand total
?>
<tr>
    <td><img src="admin/itemimages/<?php echo $row['Image']?>" width="100" height="80" alt="<?php echo $row['ItemName']?>"></td>
<td>
    <a href="food-detail.php?fid=<?php echo $row['FoodId'];?>" title="" itemprop="url"><?php echo $row['ItemName']?></a>
</td>
    <td><?php echo $qty ?></td>
    <td><?php echo 'RM '. $ppu ?></td>
    <td><?php echo 'RM '. number_format($total = $qty * $ppu, 2); ?></td>
</tr>

<?php }?>
<thead>
<tr>
    <th colspan="4" style="text-align:center;">Grand Total</th>
<th style="text-align:center;"><?php echo 'RM '. number_format($grandtotal, 2);?></th>
</tr>
</thead>
<tr>

<?php
        $userid= $_SESSION['cust_id'];
        $oid=$_GET['onumber'];

        // Update the payment column in tblorderaddresses
        $updateQuery = "UPDATE tblorderaddresses SET payamnt='$grandtotal', paystatus='Pending' WHERE UserId='$userid' AND Ordernumber='$oid'";
        $result = mysqli_query($con, $updateQuery);

        $query=mysqli_query($con,"select * from  tblorderaddresses  where UserId='$userid' and Ordernumber='$oid'");
        $count=1;
        while($row=mysqli_fetch_array($query)) {
            if ($row['paystatus'] == "Pending" ) {
                echo '<td colspan="6">';
                echo '<a href="#" class="payment-link" onclick="showPayLink(\'' . $row['ID'] . '\')">Confirm To Pay</a>';
                echo '<a class="payment-link" id="payLink_' . $row['ID'] . '" href="payment0.php?ID=' . $row['ID'] . '" title="Make Payment" data-toggle="tooltip" style="display: none;"> Pay </a>';
                echo '</td>';
            }
        }
        ?>

</tr>
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

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script src="assets/js/google-map-int2.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
function showPayLink(orderId) {
    var confirmation = confirm("Are you sure you want to proceed with the payment? Please note that once the payment is completed, no changes or cancellations can be made to the order.");
    if (confirmation) {
        // User clicked "OK," hide "Confirm To Pay" and show "Pay"
        document.querySelector('.payment-link').style.display = 'none';
        document.getElementById('payLink_' + orderId).style.display = 'inline';
    } else {
        // User clicked "Cancel," do nothing
    }
}
</script>

</body>	

</html>
<?php } ?>
