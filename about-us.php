<?php
session_start();
include_once('includes/dbconnection.php');
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
                            <h1 itemprop="headline">About Us</h1>
                            <span>Mee PokSu Dir's Restaurant</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="bread-crumbs-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" title="" itemprop="url">Home</a></li>
                    <li class="breadcrumb-item active">About Us</li>
                </ol>
            </div>
        </div>

        <section>
            <div class="block less-spacing gray-bg top-padd30">
                
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="sec-box">
                                <div class="about-feat text-center wow fadeIn" data-wow-delay="0.2s">
                                    
                                    <img style="width: 400px; height: auto;" src="assets/images/resource/logo1.png" alt="logo1.png" itemprop="image">
                                </div>
                               
                             
                                <div class="title1-wrapper text-center style2">
                                    <div class="title1-inner">
                                        <h2 itemprop="headline">Mee PokSu Dir's Restaurant</h2>
                                        <p itemprop="description"><p style="text-align:justify;">Welcome to Mee Pok Su Dir's Restaurant, a culinary haven established in 2017 by the visionary Abdul Kadir Bin Awang Ali. Our journey began with a humble start, focusing on crafting delectable noodles and beverages. From the outset, our passion for authentic flavors led us to introduce the signature dish, Mee Celup, which quickly gained acclaim. As the years unfolded, our commitment to quality and innovation has transformed us into a beloved dining destination in Jerteh. Today, Mee Pok Su Dir's Restaurant is synonymous with a diverse range of noodles, ensuring a delightful culinary experience for all our patrons. Join us on this gastronomic adventure, where tradition meets innovation, and every dish tells a story of dedication and flavor mastery.</p></p>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        

           <?php include_once('includes/footer.php');
include_once('includes/signin.php');
include_once('includes/signup.php');
      ?>

    </main><!-- Main Wrapper -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
</body>	

</html>