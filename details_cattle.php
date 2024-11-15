<?php
session_start();
include("includes/db.php");

include("functions/functions.php");
?>


<?php
if (isset($_GET['pro_id'])) {
  $pro_id = $_GET['pro_id'];

  // Query for the product
  $get_product = "SELECT * FROM cattle WHERE cattle_id='$pro_id'";
  $run_product = mysqli_query($con, $get_product);

  // Check if product query returned any results

  if (mysqli_num_rows($run_product) > 0) {
    $row_product = mysqli_fetch_array($run_product);

    // Fetch product details
    $p_title = $row_product['breed'];
    $p_price = $row_product['Price'];
    $p_desc = $row_product['health_history'];
    $p_img1 = $row_product['image'];
    $p_qty = $row_product['qty'];


  } else {
    echo "<p>Product not found.</p>";
  }
}
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

  <!-- header section starts  -->
  <header>

    <div class="header-2">


      <nav class="navbar">


        <ul>
          <li>
          <li><a>CattleMart</a></li>

          <div class="col-md-6">
            <ul class="menu">

              <li><a href="index.php">HOME</a></li>

              <li><a class="active" href="Market.php">Market</a></li>
              <li><a  href="Product.php">Product</a></li>
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



  <div class="co-md-6">
    <div class="bx">
      <div class="col-xs-4">
        <a href="#" class="thumb">
          <img src="./assets/<?php echo $p_img1; ?>" class="img-responsive">
        </a>
      </div>
      <h1 class="text-center"><?php echo $p_title ?></h1>
      <p><?php echo $p_desc ?></p>
      <?php add_cattle_Cart(); ?>

      <form action="details_cattle.php?add_cattle_cart=<?php echo $pro_id ?>" method="post" class="form-horizontal">
        <div class="form-group">
          <label class="col-md-5 control-label">Product Quantity</label>
          <div class="col-md-7">
            <button type="button" class="btn btn-default" onclick="decreaseQuantity()">-</button>
            <input type="text" name="product_qty" class="form-control" value="1" id="product_qty" readonly>
            <button type="button" class="btn btn-default" onclick="increaseQuantity()">+</button>
          </div>
        </div>
        <p class="price">Price: <?php echo $p_price; ?> $</p>
        <button class="btn-prim" type="submit"><i class=" fa fa-shopping-cart">Add to cart</i></button>
      </form>

      <script>
        function decreaseQuantity() {
          var qty = document.getElementById('product_qty').value;
          if (qty > 1) {
            document.getElementById('product_qty').value = --qty;
          }
        }

        function increaseQuantity() {
          var qty = document.getElementById('product_qty').value;
          if (qty < <?php echo $p_qty; ?>) {
            document.getElementById('product_qty').value = ++qty;
          }
        }
      </script>
    </div>
  </div>
  </div>
  </div>


  <!-- footer section starts  -->
  <?php
  include("includes/footer.php");
  ?>
  <!-- footer section   -->

</body>

</html>