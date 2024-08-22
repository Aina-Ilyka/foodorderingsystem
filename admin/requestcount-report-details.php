<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['admin_id']==0)) {
  header('location:logout.php');
  } else{

  

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
<?php
 $fdate = isset($_GET['fromdate']) ? $_GET['fromdate'] : '';
 $_SESSION['fromdate'] = $fdate;
 $tdate = isset($_GET['todate']) ? $_GET['todate'] : '';
 $_SESSION['todate'] = $tdate;
 $rtype = isset($_GET['requesttype']) ? $_GET['requesttype'] : '';
 $_SESSION['requesttype'] = $rtype;
?>

<?php if($rtype=='mtwise'){
$month1=strtotime($fdate);
$month2=strtotime($tdate);
$m1=date("F",$month1);
$m2=date("F",$month2);
$y1=date("Y",$month1);
$y2=date("Y",$month2);
    ?>
<h4 align="center" style="color:blue">Product Sales Report from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h4>
<hr />
<div class="row">
                        <div class="col-md-6">
                            <h4 class="header-title m-t-0 m-b-30"> Monthly Product Sales Report</h4>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="filter-section">
                                <div class="row g-3">
                                    <div class="col-md-8"> <!-- Adjusted to col-md-8 for a wider dropdown -->
                                        <select name="itemFilter" id="itemFilter" class="form-select w-100">
                                            <option value="">Select Product</option>
                                            <?php
                                            $sql = "SELECT DISTINCT ItemName FROM tblfood";
                                            $result = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['ItemName'] . "'>" . $row['ItemName'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        $savedDate = isset($_SESSION['fromdate']) ? $_SESSION['fromdate'] : '';
                                        $savedStatus = isset($_SESSION['todate']) ? $_SESSION['todate'] : '';
                                        $savedType = isset($_SESSION['requesttype']) ? $_SESSION['requesttype'] : '';
                                        ?>
                                        <a href="requestcount-report-details.php?fromdate=<?php echo urlencode($savedDate); ?>&todate=<?php echo urlencode($savedStatus); ?>&requesttype=<?php echo urlencode($savedType); ?>" class="btn btn-danger float-end">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
<tr>
<th>S.NO</th>
<th>Month / Year </th>
<th>Product Name</th>
<th>Quantity Sold</th>
<th>Sales Made</th>
</tr>
</thead>
<?php
$fstatus='Successful';
$ret=mysqli_query($con,"select month(OrderTime) as lmonth,year(OrderTime) as lyear, tblfood.ID,tblfood.ItemName as ItemName,
    sum(tblorders.FoodQty) as QuantitySold,sum(ItemPrice*tblorders.FoodQty) as totalitmprice from tblorders 
    join tblorderaddresses on tblorderaddresses.Ordernumber=tblorders.OrderNumber 
    join tblfood on tblfood.ID=tblorders.FoodId 
    where date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate' 
    and tblorderaddresses.paystatus='$fstatus'  group by lmonth,lyear, tblfood.ID ORDER BY lmonth,lyear");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                    <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['lmonth']."/".$row['lyear'];?></td>
                  <td><?php echo $row['ItemName']; ?></td>
                  <td><?php echo $row['QuantitySold']; ?></td>
                  <td><?php echo 'RM ',number_format($total = $row['totalitmprice'], 2); ?></td>

             
                    </tr>
                <?php
$ftotal+=$total;
$cnt++;
}?>
   
   <tr>
                  <td colspan="4" align="right">Total </td>
              <td><?php  echo 'RM ', number_format($ftotal,2);?></td>
   
                 
                 
                </tr>   

</table>

<?php } else {
$year1=strtotime($fdate);
$year2=strtotime($tdate);
$y1=date("Y",$year1);
$y2=date("Y",$year2);
$fstatus='Successful';
 ?>
    <h4 align="center" style="color:blue">Product Sales Report  from <?php echo $y1;?> to <?php echo $y2;?></h4>
<hr />
<div class="row">
                        <div class="col-md-6">
                            <h4 class="header-title m-t-0 m-b-30">Yearly Product Sales Report</h4>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="filter-section">
                                <div class="row g-3">
                                    <div class="col-md-8"> <!-- Adjusted to col-md-8 for a wider dropdown -->
                                        <select name="itemFilter" id="itemFilter" class="form-select w-100">
                                            <option value="">Select Product</option>
                                            <?php
                                            $sql = "SELECT DISTINCT ItemName FROM tblfood";
                                            $result = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['ItemName'] . "'>" . $row['ItemName'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        $savedDate = isset($_SESSION['fromdate']) ? $_SESSION['fromdate'] : '';
                                        $savedStatus = isset($_SESSION['todate']) ? $_SESSION['todate'] : '';
                                        $savedType = isset($_SESSION['requesttype']) ? $_SESSION['requesttype'] : '';
                                        ?>
                                        <a href="requestcount-report-details.php?fromdate=<?php echo urlencode($savedDate); ?>&todate=<?php echo urlencode($savedStatus); ?>&requesttype=<?php echo urlencode($savedType); ?>" class="btn btn-danger float-end">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
<tr>
<th>S.NO</th>
<th>Month / Year </th>
<th>Product Name</th>
<th>Quantity Sold</th>
<th>Sales Made</th>
</tr>
</thead>
<?php
$fstatus='Successful';
$ret=mysqli_query($con,"select year(OrderTime) as lyear, tblfood.ID,tblfood.ItemName as ItemName,
    sum(tblorders.FoodQty) as QuantitySold,sum(ItemPrice*tblorders.FoodQty) as totalitmprice from tblorders 
    join tblorderaddresses on tblorderaddresses.Ordernumber=tblorders.OrderNumber 
    join tblfood on tblfood.ID=tblorders.FoodId 
    where date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate' 
    and tblorderaddresses.paystatus='$fstatus'  group by lyear, tblfood.ID ORDER BY lyear");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
              <tr>
                    <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['lyear'];?></td>
                  <td><?php echo $row['ItemName']; ?></td>
                  <td><?php echo $row['QuantitySold']; ?></td>
                  <td><?php echo 'RM ',number_format($total = $row['totalitmprice'], 2); ?></td>

             
                    </tr>
                <?php
$ftotal+=$total;
$cnt++;
}?>
   
   <tr>
                  <td colspan="4" align="right">Total </td>
              <td><?php  echo 'RM ', number_format($ftotal,2);?></td>
   
                 
                 
                </tr>  

</table>
<?php } ?>
<!-- ... Your existing code ... -->

<!-- ... Your existing code ... -->

<div class="text-center">
    <button class="btn btn-primary" style="margin-left:89%;" onclick="printProductReport()">Print Product Report</button>
</div>

<!-- Script to Print Product Report -->
<script>


    function printProductReport() {
        var printWindow = window.open('', '_blank');
        printWindow.document.open('text/html', 'replace');
        printWindow.document.write('<html><head><title>Product Sales Report</title></head><body>');

        // Add styles for table borders
        printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; } table, th, td { border: 1px solid black; }</style>');

        // Add the title
        printWindow.document.write('<h4 align="center" style="color: blue;"><?php echo $rtype == "mtwise" ? "Monthly Product Sales Report" : "Yearly Product Sales Report"; ?> from <?php echo $rtype == "mtwise" ? $m1 . "-" . $y1 : $y1; ?> to <?php echo $rtype == "mtwise" ? $m2 . "-" . $y2 : $y2; ?></h4>');

        // Add the table content
        printWindow.document.write(document.getElementById('datatable').outerHTML);

        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

<!-- ... Your existing code ... -->


<!-- ... Your existing code ... -->


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
$(document).ready(function() {
    $('#itemFilter').change(function() {
        var itemName = $(this).val();
        $.ajax({
            type: 'GET',
            url: 'filter_script.php', // Replace with the PHP script handling the filtering logic
            data: { itemName: itemName, fromdate: '<?php echo $_GET["fromdate"]; ?>', todate: '<?php echo $_GET["todate"]; ?>', requesttype: '<?php echo $_GET["requesttype"]; ?>' },
            success: function(response) {
                $('#datatable tbody').html(response); // Update the table with filtered data
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>



</body>

</html>
<?php } ?>