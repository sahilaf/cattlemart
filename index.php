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
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="header-2">


        <nav class="navbar">


            <ul>
                <li>
                <li><a>CattleMart</a></li>

                <div class="col-md-6">
                    <ul class="menu">

                        <li><a class="active" href="index.php">HOME</a></li>

                        <li><a href="Market.php">Market</a></li>
                        <li><a href="Product.php">Product</a></li>
                        <li>
                            <a href="cart.php" class="">
                                <i class="fa fa-shopping-cart"></i>
                                <span><?php item(); ?> items in cart</span>
                            </a>
                        </li>


                        <li>
                            <a href="customer_registration.php"><i class="fa fa-user-plus"></i>Register</a>
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






            <!-- header section ends -->

            <!-- hero section starts  -->
            <section class="hero">
                <div>
                    <h2>Efficient Cattle Management at Your Fingertips</h2>
                    <p>Buy-Sell and Manage your herd with ease.</p>
                    <a href="customer_registration.php"><button>Get Started</button></a>
                </div>
            </section>

            <!-- home section ends -->
            <!-- Market Place section starts -->

            <div class="hot">
                <div class="box">
                    <div class="container">
                        <div class="col-md-121">
                            <h2>Market Place

                            </h2>

                            <div class=" col-sm-4">
                                <div class="row">
                                    <?php

                                    getProHome();


                                    ?>
                                </div>
                            </div>
                            <p class='buttons'>
                                <a href='Market.php' class='btn btn-default'>View all</a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>






            <!-- Market Place section ends -->
            <!--Product start-->
            <div class="hot">
                <div class="box">
                    <div class="container">
                        <div class="col-md-121">
                            <h2>Products

                            </h2>

                            <div class=" col-sm-4">
                                <div class="row">
                                    <?php

                                    getProductsHome();


                                    ?>
                                </div>
                            </div>
                            <p class='buttons'>
                                <a href='Product.php' class='btn btn-default'>View all</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--product end-->

            <!--footer start-->

            <footer class="footer" id="footer">
                <div class="cuntainer">
                    <div class="wolf">

                        <div class="footer-ol">
                            <h4>company</h4>
                            <ul>
                                <li><a href="#">about us</a></li><br><br>
                                <li><a href="#">our services</a></li><br><br>
                                <li><a href="#">privacy policy</a></li><br><br>
                                <li><a href="#">affiliate program</a></li><br><br>
                            </ul>
                        </div>
                        <div class="footer-ol">
                            <h4>get help</h4>
                            <ul>
                                <li><a href="#">FAQ</a></li><br><br>
                                <li><a href="#">shipping</a></li><br><br>
                                <li><a href="#">returns</a></li><br><br>
                                <li><a href="#">order status</a></li><br><br>
                                <li><a href="#">payment options</a></li><br><br>
                            </ul>
                        </div>
                        <div class="footer-ol">
                            <h4>online shop</h4>
                            <ul>
                                <li><a href="#">Market Products</a></li><br><br>
                                <li><a href="#">Prtoducts</a></li><br><br>
                            </ul>
                        </div>
                        <div class="footer-ol">
                            <h4>follow us</h4>
                            <ul>
                                <li><a href="#">Facebook</a></li><br><br>
                                <li><a href="#">Instagram</a></li><br><br>
                                <li><a href="#">Twitter</a></li><br><br>
                                <li><a href="#">Others</a></li><br><br>
                            </ul>
                        </div>

            </footer>

            <!-- footer section ends -->
            <!-- footer section ends -->

        </nav>
    </div>
    </header>


    <!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- owl carousel js file cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- custom js file link  -->
    <script src="main/js.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";

        }
    </script>



</body>

</html>