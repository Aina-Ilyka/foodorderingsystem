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

   <h4 class="m-t-0 header-title">Between Dates Reports</h4>
                                    <?php
$fdate=$_GET['fromdate'];
$_SESSION['fromdate']=$fdate;
$tdate=$_GET['todate'];
$_SESSION['todate']=$tdate;
$rtype=$_GET['requesttype'];
$_SESSION['requesttype']=$rtype;
?>
<h5 align="center" style="color:blue">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
<?php if($rtype=="all"){?>                          
                                 <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Order Number</th>
                  <th>Order Type</th>
                  <th>Order Date/Time</th>
                  <th>Served/Picked at</th>
                  <th>Time Taken</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
$ret = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderTime BETWEEN '$fdate' AND '$tdate' AND (OrderFinalStatus = 'Food Picked Up' OR OrderFinalStatus = 'Food Served')");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['Ordernumber'];?></td>
                  <td><?php  echo $row['ordertype'];?></td>
                  <td><?php  echo $row['OrderTime'];?></td>
                  <td><?php  echo $row['completetime'];?></td>
                  <td><?php  echo $row['timetaken'];?></td>
                  <td><a href="viewfoodorder.php?orderid=<?php echo $row['Ordernumber'];?>">View Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
<?php } ?>                                                
            
            <?php if($rtype=="Food Pickup"){?>                          
                                 <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Order Number</th>
                  <th>Order Date</th>
                  <th>Served/Picked at</th>
                  <th>Time Taken</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
$ret=mysqli_query($con,"select * from tblorderaddresses where OrderFinalStatus='Food Picked Up' && OrderTime between '$fdate' and '$tdate'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['Ordernumber'];?></td>
                  <td><?php  echo $row['OrderTime'];?></td>
                  <td><?php  echo $row['completetime'];?></td>
                  <td><?php  echo $row['timetaken'];?></td>
                                    <td><a href="viewfoodorder.php?orderid=<?php echo $row['Ordernumber'];?>">View Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
            <?php } if($rtype=="Food Served"){?>                          
                                 <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Order Number</th>
                  <th>Order Date</th>
                  <th>Served/Picked at</th>
                  <th>Time Taken</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
$ret=mysqli_query($con,"select * from tblorderaddresses where OrderFinalStatus='Food Served' && OrderTime between '$fdate' and '$tdate'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['Ordernumber'];?></td>
                  <td><?php  echo $row['OrderTime'];?></td>
                  <td><?php  echo $row['completetime'];?></td>
                  <td><?php  echo $row['timetaken'];?></td>
                                    <td><a href="viewfoodorder.php?orderid=<?php echo $row['Ordernumber'];?>">View Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
             <?php }?>                          
                                 
<div class="text-center">
    <button class="btn btn-primary" style="margin-left:93%;" onclick="printTable()">Print Report</button>
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
    </script>

    <script>
    function printTable() {
        var printWindow = window.open('', '_blank');
        printWindow.document.open('text/html', 'replace');
        printWindow.document.write('<html><head><title>Food Ordering System</title></head><body>');

        // Add styles for table borders
        printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; } table, th, td { border: 1px solid black; }</style>');

        // Add the title
        printWindow.document.write('<h4 align="center" style="color: blue;">Between Dates Reports</h4>');
        printWindow.document.write('<h5 align="center" style="color: blue;">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>');

        // Add the table content
        printWindow.document.write(document.querySelector('.table').outerHTML);

        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

    

</body>

</html>
<?php }  ?>
