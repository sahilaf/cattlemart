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
  <style>


  </style>

</head>

<body>



  <!--nav section starts-->
  <div class="header-2">
    <nav class="navbar">


      <ul>
        <li>
        <li><a>CattleMart</a></li>

        <div class="col-md-6">
          <ul class="menu">

            <li><a href="index.php">HOME</a></li>

            <li><a  href="Market.php">Market</a></li>
            <li><a href="Product.php">Product</a></li>
            <li>
              <a href="cart.php" class="active">
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
  <!--nav section ends-->


  <div class="col-md-9" id="cart">
    <div class="box">
      <form action="cart.php" method="post" enctype="multipart/form-data">
        <h1>Shopping Cart</h1>
        <?php
        $ip_add = getUserIp();
        $select_cart = "select * from cart where ip_add='$ip_add'";
        $run_cart = mysqli_query($con, $select_cart);
        $count = mysqli_num_rows($run_cart);

        ?>
        <p class="text-muted">Currently you have <?php echo $count ?> items in your cart</p>
        <div class="table-responsive"></div>


        <table class="table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Delete</th>
              <th>Sub Total</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $total = 0;
            while ($row = mysqli_fetch_array($run_cart)) {
              $pro_id = $row['p_id'];
              $c_id = $row['c_id'];
              $pro_qty = $row['qty'];
              $sub_total = 0;
              if (!empty($pro_id)) {
                $get_product = "select * from prod where id='$pro_id'";
                $run_pro = mysqli_query($con, $get_product);
                if (mysqli_num_rows($run_pro) > 0) {
                  while ($row_pro = mysqli_fetch_array($run_pro)) {
                    $p_title = $row_pro['name'];
                    $p_img1 = $row_pro['image_url'];
                    $p_price = $row_pro['price'];
                    $sub_total = $row_pro['price'] * $pro_qty;
                    $total += $sub_total;
                  }
                }
              } else {
                $get_cattle = "select * from cattle where cattle_id='$c_id'";
                $run_cat = mysqli_query($con, $get_cattle);
                while ($row_cat = mysqli_fetch_array($run_cat)) {
                  $c_title = $row_cat['breed'];
                  $c_img1 = $row_cat['image'];
                  $c_price = $row_cat['Price'];
                  $sub_total = $row_cat['Price'] * $pro_qty;
                  $total += $sub_total;
                }
              }
              ?>

              <tr>
                <td class="product-info">
                  <div class="product-image-title">
                    <img src="assets/<?php echo isset($p_img1) ? $p_img1 : $c_img1 ?>"
                      alt="<?php echo isset($p_title) ? $p_title : $c_title ?>">
                    <div class="product-title"><?php echo isset($p_title) ? $p_title : $c_title ?></div>
                  </div>
                </td>
                <td><?php echo $pro_qty ?></td>
                <td><?php echo isset($p_price) ? $p_price : $c_price ?>$</td>
                <td><input type="checkbox" name="remove[]"
                    value="<?php echo isset($pro_id) ? 'p_' . $pro_id : 'c_' . $c_id ?>"></td>
                <td><?php echo $sub_total ?>$</td>
              </tr>

            <?php } ?>
          </tbody>

        </table>




        <div class="box-footer">
          <div class="pull-left">
            <h4>Total Price</h4>
          </div>
          <div class="pull-right">
            <h4> <?php echo $total; ?>$</h4>
          </div>
        </div>


        <div class="box-footer">
          <div class="pull-left">
            <a href="index.php" class="btn btn-default">
              <i class="fa fa-chevron-left"></i>Continue Shopping
            </a>
          </div>
          <div class="pull-right">
            <button class="btn btn-default" type="submit" name="update" value="update cart">
              <i class="fa fa-refresh">Update Cart</i>
            </button>
            <a href="checkout.php" class="btn btn-default">
              Processed to checkout<i class="fa fa-chevron-right"></i>
            </a>
          </div>
        </div>
      </form>
    </div>

    <?php

    function update_cart()
    {
      global $con;
      if (isset($_POST['update'])) {
        if (isset($_POST['remove'])) {
          foreach ($_POST['remove'] as $remove_id) {
            if (strpos($remove_id, 'p_') === 0) {
              $id = substr($remove_id, 2);
              $delete_product = "delete from cart where p_id='$id'";
              $run_del = mysqli_query($con, $delete_product);
            } elseif (strpos($remove_id, 'c_') === 0) {
              $id = substr($remove_id, 2);
              $delete_cattle = "delete from cart where c_id='$id'";
              $run_del = mysqli_query($con, $delete_cattle);
            }
            if ($run_del) {
              echo "<script>window.open('cart.php','_self')</script>";
            }
          }
        }
      }
    }
    echo @$up_cart = update_cart();
    ?>

    <div class="col-m-3">
      <div class="box" id="order-summary">
        <div class="box-header">
          <h3>Order Summary</h3>
        </div>
        <p class="text-muted">
          Shipping and additional costs are calculated based on the values you have entered
        </p>
        <div class="table-responsive">
          <table class="table">
            <tr>
              <td>Order Sub Total</td>
              <th><?php echo $total ?>$</th>
            </tr>
            <tr>
              <td>Shipping and handling</td>
              <td> 0 $</td>
            <tr>
              <td>Tax</td>
              <td> 0 $</td>
            </tr>
            <tr class="Total">
              <td>Total</td>
              <th><?php echo $total ?>$</th>

            </tr>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--shopping cart section ends-->


  <!-- footer section starts  -->
  <?php
  include("includes/footer.php");
  ?>
  <!-- footer section   -->