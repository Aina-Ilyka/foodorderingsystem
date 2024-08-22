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

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
<div id="wrapper">
<?php include_once('includes/leftbar.php');?>

        <div id="page-wrapper" class="gray-bg">
       <?php include_once('includes/header.php');?>
            <div class="wrapper wrapper-content">


<div class="row" >
<div class="col-lg-12">
    <div class="ibox" style=" border: 2px solid #B8860B;">
        <div class="ibox-title">
            <h2 style="color: #B8860B; font-weight: 400;">Pick-Up Orders</h2>
            <?php
                    // Get today's date in the format matching your OrderTime attribute (assuming it's in 'Y-m-d' format)
                    $today = date('Y-m-d'); ?>

                    <form id="pickupForm" action="" method="GET">
                        <div class="row align-items-end">
                            <div class="col-lg-5" style="margin-left: 5px; margin-bottom: 2px; margin-top: 1px;">
                                <div class="input-group">
                                <select name="pickup" id="pickupSelect" required class="form-control" style="width: 100%; border: 2px solid #B8860B;">
                                <option value="" >Select Pick-Up Time</option>
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
                            </div>
                        </div>
                    
                    <?php
                    $condition = "";
                    if (isset($_GET['pickup']) && $_GET['pickup'] != '') {
                        $pickup = $_GET['pickup'];
                        $_SESSION['pickup'] = $pickup;
                        $condition .= " AND pickuptime = '$pickup'";
                    }
                    // Query to fetch confirmed pick-up orders for today
                    $queryConfirmed = mysqli_query($con, "SELECT * FROM tblorderaddresses 
                        WHERE OrderFinalStatus = 'Confirmed Order' 
                        AND paystatus = 'Successful' 
                        AND ordertype = 'Pick-Up' 
                        AND DATE(OrderTime) = '$today' $condition");

                    if (!$queryConfirmed) {
                        die('Query Error: ' . mysqli_error($con));
                    }

                    $confirmedOrders = mysqli_num_rows($queryConfirmed);
                    ?>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-6">
                <div class="ibox" style="background-color: #FFF8DC; border: 2px solid #B8860B;">
                    <div class="ibox" style="background-color: #f2f2f2; border-radius: 10px;">
                    <div class="ibox-title">
                        <?php
                        // Get today's date
                        $today = date('Y-m-d');
                        if (isset($_GET['pickup']) && $_GET['pickup']) {
                            $pickup = $_GET['pickup'];
                            $_SESSION['pickup'] = $pickup;
                        }
                        // Construct the dynamic URL with today's date
                        $dynamicURL = "viewpickup1.php?date=$today&pickup=$pickup&page-nr=1";
                        ?>
                        <a id="foodSectionLink" href="<?php echo $dynamicURL; ?>" style="color: #B8860B;" onclick="return validatePickupTime();"><strong style="color: #B8860B;">FOOD SECTION</strong></a>
                    </div>
                    </form>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $confirmedOrders; ?></h1>
                            <small>New Order for food</small>
                        </div>
                    </div>
                </div>
                </div>
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

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('.chart').easyPieChart({
                barColor: '#f8ac59',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            var data2 = [
                [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
                [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
                [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
                [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
                [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
                [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
                [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
                [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
            ];

            var data3 = [
                [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
                [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
                [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
                [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
                [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
                [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
                [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
                [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
            ];


            var dataset = [
                {
                    label: "Number of orders",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Payments",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
        });
    </script>
    <script>
    document.getElementById('pickupSelect').addEventListener('change', function() {
        document.getElementById('pickupForm').submit();
    });
</script>
<script>
    function validatePickupTime() {
        var pickupSelect = document.getElementById('pickupSelect');
        
        // Check if a pick-up time is selected
        if (pickupSelect.value === "") {
            alert("Please select a pick-up time.");
            return false; // Cancel the link click
        }

        return true; // Allow the link click
    }
</script>

</body>
</html>
