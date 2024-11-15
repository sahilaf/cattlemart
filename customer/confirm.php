<?php
session_start();
if (!isset($_SESSION['customer_email'])) {
  echo "<script>window.open('../checkout.php','_self')</script>";
} else {
  include("../includes/db.php");

  include("../functions/functions.php");

  if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

  }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CattleMart</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css">

  </head>

  <body>


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


      <div class="co-9">
        <div class="trx">
          <h1 align="center">Please confirm your payment</h1>
          <form action="confirm.php?update_id=<?php echo $order_id ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <?php
              $get_order = "select invoice_no,due_amount from customer_order where order_id='$order_id'";
              $run_order = mysqli_query($con, $get_order);
              $row_order = mysqli_fetch_array($run_order);
              $invoice_number = $row_order['invoice_no'];
              $due_amount = $row_order['due_amount'];

              ?>
              <label> Invoice Number</label>
              <input type="text" class="form-control" name="invoice_number" required="" value="<?php echo $invoice_number; ?>" >
            </div>
            <div class="form-group">
              <label> Amount</label>
              <input type="text" class="form-control" name="amount" required="" value="<?php echo $due_amount; ?>">
            </div>
            <div class="form-group">
              <label>Select Payment Mode</label>
              <select class="form-control" name="payment_mode">
                <option>Bank transfer</option>
                <option>Paypal</option>
                <option>Paytm</option>
                <option>google pay</option>
              </select>
            </div>
            <div class="form-group">
              <label>Transection Number </label>
              <input type="text" class="form-control" name="trfr_number" required="">
            </div>
            <div class="form-group">
              <label>Payment Date </label>
              <input type="date" class="form-control" name="date" required="">
            </div>
            <div class="text-center">
              <button type="submit" name="confirm_payment" class="btn btn-primary btn-lg">Confirm Payment</button>
            </div>
          </form>

          <?php

          if (isset($_POST['confirm_payment'])) {
            $update_id = $_GET['update_id'];
            $invoice_number = $_POST['invoice_number'];
            $amount = $_POST['amount'];
            $payment_mode = $_POST['payment_mode'];
            $trfr_number = $_POST['trfr_number'];
            $date = $_POST['date'];
            $complete = "Complete";
            $insert = "insert into payments (invoice_id,amount,payment_mode, ref_no, payment_date) values ('$invoice_number','$amount','$payment_mode','$trfr_number','$date')";
            $run_insert = mysqli_query($con, $insert);

            $update_q = "update customer_order set order_status ='$complete' where order_id='$update_id'";
            $run_insert = mysqli_query($con, $update_q);

            // $update_p="update pending_order set order_status ='$complete' where order_id='$update_id'";
            // $run_insert=mysqli_query($con,$update_p);
        
            echo "<script> alert('Your order has been received') </script>";
            echo "<script>window.open('my_account.php?my_order','_self') </script>";
          }

          ?>

        </div>
      </div>
    </div>


    <!-- footer section starts  -->
    <?php
    include("includes/footer.php");
    ?>
    <!-- footer section   -->


  <?php } ?>