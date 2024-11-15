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

            <li><a  href="index.php">HOME</a></li>

            <li><a href="Market.php">Market</a></li>
            <li><a class="active" href="Product.php">Product</a></li>
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




    </nav>
  </div>
  </header>

  <!-- header section End  -->



  <div class="market">
    <div class="layout">
      <?php

      getProducts();


      ?>
    </div>
  </div>

  <!--Page Session End-->






  <div class="foot">

    <!-- footer section starts  -->

    <!-- footer section   -->
  </div>
</body>

</html>