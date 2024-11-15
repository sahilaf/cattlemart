<?php
session_start();
if (!isset($_SESSION['customer_email'])) {
  echo "<script>window.open('../checkout.php','_self')</script>";
} else {

  include("../includes/db.php");
  include("../functions/functions.php");
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CattleMart</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css">
    <style>


    </style>

  </head>

  <body>

    <!-- header section starts  -->

    <header>


      <div class="header-2">


        <nav class="navbar">


          <ul>
            <li>
            <li><a>CattleMart</a></li>

            <div class="col-md-6">
              <ul class="menu">

                <li><a href="../index.php">HOME</a></li>

                <li><a href="../Market.php">Market</a></li>
                <li><a href="../Product.php">Product</a></li>
                <li>
                  <a href="../cart.php">
                    <i class="fa fa-shopping-cart"></i>
                    <span><?php item(); ?> items in cart</span>
                  </a>
                </li>


                <li>
                  <a href="../customer_registration.php"><i class="fa fa-user-plus"></i>Register</a>
                </li>
                <li>
                  <?php

                  if (!isset($_SESSION['customer_email'])) {
                    echo "<a href='../checkout.php'>My Account</a>";

                  } else {

                    echo "<a href='my_account.php?my_order'>My Account</a>";

                  }

                  ?>
                </li>

                <li>
                  <?php

                  if (!isset($_SESSION['customer_email'])) {
                    echo "<a href='checkout.php'>Login</a>";

                  } else {

                    echo "<a href='../logout.php'>Logout</a>";

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
    <div class="container">
      <div class="content1" id="content1">
        <div class="container1">
          <div class="col-md-3">
            <?php
            include("includes/sidebar.php");
            ?>

          </div>
        </div>
      </div>
      <div class="col-m-9">

        <!-- including my_order.php starts  -->

        <?php
        if (isset($_GET['my_order'])) {
          include("my_order.php");
        }
        ?>

        <!-- including my_order.php End  -->


        <!-- including Edit_account.php page start  -->
        <?php
        if (isset($_GET['edit_act'])) {
          include("edit_act.php");
        }
        ?>

        <!-- including Edit_account.php page End  -->
        <!-- including change_pass.php page Start  -->
        <?php
        if (isset($_GET['change_pass'])) {
          include("change_password.php");
        }
        ?>

        <!-- including change_pass.php page End  -->
        <!-- including delete_pass.php page Start  -->

        <?php
        if (isset($_GET['delete_ac'])) {
          include("delete_ac.php");
        }
        ?>

        <!-- including delete_pass.php page End  -->
      </div>
    </div>

    <!-- footer section starts  -->
    <?php
    include("includes/footer.php");
    ?>
    <!-- footer section   -->

  <?php } ?>
</body>

</html>