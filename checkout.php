<?php
session_start();
include("includes/db.php");

include("functions/functions.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CattleMart</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- owl carousel css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">
    <style>


    </style>

</head>

<body>



    <div class="header-2">


        <nav class="navbar">


            <ul>
                <li>
                <li><a>CattleMart</a></li>

                <div class="col-md-6">
                    <ul class="menu">

                        <li><a href="index.php">HOME</a></li>

                        <li><a href="Market.php">Market</a></li>
                        <li><a href="Product.php">Product</a></li>
                        <li>
                            <a href="cart.php">
                                <span><?php item(); ?> items in cart</span>
                            </a>
                        </li>


                        <li>
                            <a href="customer_registration.php" >Register</a>
                        </li>
                        <li>
                            <?php

                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='checkout.php'>My Account</a>";

                            } else {

                                echo "<a href='customer/my_account.php?my_order'>My Account</a>";

                            }

                            ?>
                        </li>

                        <li>
                            <?php

                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='checkout.php'>Login</a>";

                            } else {

                                echo "<a href='logout.php'>Logout</a>";

                            }

                            ?>
                        </li>
                    </ul>
                </div>
            </ul>



        </nav>
    </div>
    </header>


    <div class="col-md-9">
        <?php

        if (!isset($_SESSION['customer_email'])) {
            include('customer/customer_login.php');
        } else {
            include('payment_options.php');
        }


        ?>
    </div>
    <!-- footer section starts  -->
    <?php
    include("includes/footer.php");
    ?>
    <!-- footer section   -->

</body>

</html>