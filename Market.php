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
  <link rel="stylesheet" href="style.css">
  <style>
    /* Add your custom styles here */
  </style>
</head>

<body>
  <div class="header-2">
    <nav class="navbar">
      <ul>
        <li><a>CattleMart</a></li>
        <div class="col-md-6">
          <ul class="menu">
            <li><a href="index.php">HOME</a></li>
            <li><a class="active" href="Market.php">Market</a></li>
            <li><a href="Product.php">Product</a></li>
            <li>
              <a href="cart.php">
                <i class="fa fa-shopping-cart"></i>
                <span><?php item(); ?> items in cart</span>
              </a>
            </li>
            <li><a href="customer_registration.php"><i class="fa fa-user-plus"></i>Register</a></li>
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

  <!-- header section End  -->
  <div class="market">
    <form method="GET" action="Market.php">
      <label for="max_price">Enter price range</label>
      <input type="number" name="max_price" id="max_price" placeholder="" required>
      <button type="submit">Filter</button>
    </form>
    <div class="layout">
      <?php
      getPro(); // Call the function to display products
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
