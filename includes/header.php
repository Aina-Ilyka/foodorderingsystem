   <?php 
error_reporting(0);
   ?>
    <main>
     <!--    <div class="preloader">
            <div id="cooking">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div id="area">
                    <div id="sides">
                        <div id="pan"></div>
                        <div id="handle"></div>
                    </div>
                    <div id="pancake">
                        <div id="pastry"></div>
                    </div>
                </div>
            </div>
        </div> -->
        
        <header class="stick">
            <style>
                /* Add this CSS to your stylesheet or in a style block in the head of your HTML document */
.logo {
    text-align: center; /* Adjust the alignment according to your design */
}

.logo-text {
    font-size: 3.5rem; /* Adjust the value according to your needs */
    /* Add any additional styling if necessary */
}

.dir-text {
    font-size: 2rem; /* Adjust the value according to your needs */
    /* Add any additional styling if necessary */
}
            </style>
            <div class="topbar" style="background-color: #9F1513;">
                <div class="container" style="background-color: #9F1513;">
               
                    <div class="topbar-register">
                         <?php if (strlen($_SESSION['cust_id']==0)) {?> 
                    <a class="log-popup-btn" href="#" title="Login" itemprop="url">LOGIN</a> / <a class="sign-popup-btn" href="#" title="Register" itemprop="url">REGISTER</a>
                <?php }?>
                     <?php if (strlen($_SESSION['cust_id']>0)) {?>
   <a  href="my-account.php" title="My Account" itemprop="url">My Account</a>
                     <?php } ?>
                    </div>

                </div>                
            </div><!-- Topbar -->
            <div class="logo-menu-sec">
                <div class="container">
                <div class="logo">
    <h1 itemprop="headline">
        <a href="index.php" title="Home" itemprop="url">
            <span class="logo-text">MEE POKSU</span> <span class="dir-text">DIR</span>
        </a>
    </h1>
</div>
                    <nav>
                        <div class="menu-sec">
                            <ul>
<li style="margin-left:170px;"><a href="index.php" title="Home" itemprop="url">Home</li>

<li class="menu-item-has-children"><a href="our-menu.php" title="RESTAURANTS" itemprop="url">Food Menu</a>
                                    <ul class="sub-dropdown">
                                        <?php
     $query=mysqli_query($con,"select * from  tblcategory");
              while($row=mysqli_fetch_array($query))
              {
              ?> 
                                        <li><a href="categorywise-menu.php?catid=<?php echo $row['CategoryName'];?>" title="<?php echo $row['CategoryName'];?>" itemprop="url"><?php echo $row['CategoryName'];?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>


<li><a href="about-us.php" title="Contact us" itemprop="url">About us </a></li>

                          
                            </ul>
         <?php if (strlen($_SESSION['cust_id']==0)) {?> 
                    <a class="log-popup-btn red-bg brd-rd4" href="#" title="Login" itemprop="url">My Cart</a> 
                <?php }?>

                                   <?php if (strlen($_SESSION['cust_id']>0)) {?>
                            <a class="red-bg brd-rd4" href="cart.php" title="" itemprop="url">My Cart</a>
                        <?php } ?>
                    </div>
                    </nav><!-- Navigation -->
                </div>
            </div><!-- Logo Menu Section -->
        </header><!-- Header -->

        <div class="responsive-header">
    
            <div class="responsive-logomenu">
                <div class="logo"><h1 itemprop="headline"><a href="index-2.html" title="Home" itemprop="url">Mee Pok Su Dir's Restaurant</h1></div>
                <span class="menu-btn yellow-bg brd-rd4"><i class="fa fa-align-justify"></i></span>
            </div>
            <div class="responsive-menu">
                <span class="menu-close red-bg brd-rd3"><i class="fa fa-close"></i></span>
                <div class="menu-lst">
                    <ul>
 <li><a href="index.php" title="Home" itemprop="url">Home</li>
<li class="menu-item-has-children"><a href="our-menu.php" title="RESTAURANTS" itemprop="url">Food Menu</a>
                                    <ul class="sub-dropdown">
                                        <?php
     $query=mysqli_query($con,"select * from  tblcategory");
              while($row=mysqli_fetch_array($query))
              {
              ?> 
                                        <li><a href="categorywise-menu.php?catid=<?php echo $row['CategoryName'];?>" title="<?php echo $row['CategoryName'];?>" itemprop="url"><?php echo $row['CategoryName'];?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>

                    </ul>
                </div>
              
                <div class="topbar-register">
                        <?php if (strlen($_SESSION['cust_id']==0)) {?> 
                    <a class="log-popup-btn" href="#" title="Login" itemprop="url">LOGIN</a> / <a class="sign-popup-btn" href="#" title="Register" itemprop="url">REGISTER</a>
                <?php }?>
                     <?php if (strlen($_SESSION['cust_id']>0)) {?>
   <a  href="my-account.php" title="My Account" itemprop="url">My Account</a>
                     <?php } ?>
                </div>
                <
                <div class="social1">
                    <a href="#" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook-square"></i></a>
                    <a href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="#" title="Google Plus" itemprop="url" target="_blank"><i class="fa fa-google-plus"></i></a>
                </div>
                <div class="register-btn">

                            <?php if (strlen($_SESSION['cust_id']==0)) {?> 
                    <a class="log-popup-btn red-bg brd-rd4" href="#" title="Login" itemprop="url">My Cart</a> 
                <?php }?>
                     <?php if (strlen($_SESSION['cust_id']>0)) {?>
                    <a class="yellow-bg brd-rd4" href="cart.php" title="" itemprop="url">My Cart</a>
                <?php } ?>
                </div>
            </div><!-- Responsive Menu -->
        </div><!-- Responsive Header -->