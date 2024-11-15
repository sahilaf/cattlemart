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
  <title>Cattlemax</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">

</head>

<body>

  <header>

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
                <a href="cart.php" >
                  <span><?php item(); ?> items in cart</span>
                </a>
              </li>


              <li>
                <a href="customer_registration.php" class="active">Register</a>
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


















  <!-- Reg start-->
  <div class="c-9">
    <div class="rx">
      <div class="box-header">
        <center>
          <h2>Register A New Account</h2>

        </center>
      </div>
      <div>
        <form action="customer_registration.php" method="post" enctype="multipart/form-data">
          <div class="roup">
            <label>Customer Name</label>
            <input type="text" name="c_name" required="" class="form-control">
          </div>
          <div class="roup">
            <label>Customer Email</label>
            <input type="text" name="c_email" class="form-control" required="">

          </div>
          <div class="roup">
            <label>Customer Password</label>
            <input type="password" name="c_password" class="form-control" required="">

          </div>
          
          <div class="roup">
            <label>Contact Number</label>
            <input type="text" name="c_contact" class="form-control" required="">

          </div>
          <div class="roup">
            <label>Address</label>
            <input type="text" name="c_address" class="form-control" required="">

          </div>
          <div class="">
            <button type="submit" name="submit" class="btn-prim">
              Register
            </button>
          </div>
        </form>
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

<?php

if (isset($_POST['submit'])) {
  $c_name = $_POST['c_name'];
  $c_email = $_POST['c_email'];
  $c_password = $_POST['c_password'];
  $c_country = $_POST['c_country'];
  $c_city = $_POST['c_city'];
  $c_contact = $_POST['c_contact'];
  $c_address = $_POST['c_address'];
  $c_image = $_FILES['c_image']['name'];
  $c_tmp_image = $_FILES['c_image']['tmp_name'];
  $c_ip = getUserIp();

  move_uploaded_file($c_tmp_image, "customer/customer_images/$c_image");
  $insert_customer = "insert into customers (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip) values('$c_name','$c_email','$c_password','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";
  $run_customer = mysqli_query($con, $insert_customer);
  $sel_cart = "select * from cart where ip_add='$c_ip'";
  $run_cart = mysqli_query($con, $sel_cart);
  $check_cart = mysqli_num_rows($run_cart);
  if ($check_cart > 0) {
    $_SESSION['customer_email'] = $c_email;
    echo "<script>alert('you have been registered successfully')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
  } else {
    $_SESSION['customer_email'] = $c_email;
    echo "<script>alert('you have been registered successfully')</script>";
    echo "<script>window.open('index.php','_self')</script>";
  }
}


?>