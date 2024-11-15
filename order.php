<?php
session_start();
include("includes/db.php");
include("functions/functions.php");

if (isset($_GET['c_id'])) {
	$customer_id = $_GET['c_id'];
}

$ip_add = getUserIp();
$status = "pending";
$invoice_no = mt_rand(); // Random invoice number
$total_amount = 0; // Initialize total amount

// Select items from the cart based on the IP address
$select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";
$run_cart = mysqli_query($con, $select_cart);

while ($row_cart = mysqli_fetch_array($run_cart)) {
	$pro_id = $row_cart['p_id']; // Product ID (if it's a product)
	$cattle_id = $row_cart['c_id']; // Cattle ID (if it's cattle)
	$qty = $row_cart['qty']; // Quantity of product/cattle ordered
	
	if ($pro_id > 0) {
		// If it's a product, get details from the `prod` table
		$get_product = "SELECT * FROM prod WHERE id='$pro_id'";
		$run_pro = mysqli_query($con, $get_product);
		$row_pro = mysqli_fetch_array($run_pro);
		
		$sub_total = $row_pro['price'] * $qty; // Calculate subtotal for products
		$total_amount += $sub_total; // Add to total amount
	} 
	else {
		// If it's cattle, get details from the `cattle` table
		$get_cattle = "SELECT * FROM cattle WHERE cattle_id='$cattle_id'";
		$run_cattle = mysqli_query($con, $get_cattle);
		$row_cattle = mysqli_fetch_array($run_cattle);
		
		$sub_total = $row_cattle['Price'] * $qty; // Calculate subtotal for cattle
		$total_amount += $sub_total; // Add to total amount
	}
}

// Insert the total order details into `customer_order`
$insert_customer_order = "INSERT INTO customer_order 
	(customer_id, due_amount, invoice_no, order_date, order_status) 
	VALUES 
	('$customer_id', '$total_amount', '$invoice_no',  NOW(), '$status')";
mysqli_query($con, $insert_customer_order);

// Clear the cart after the order is processed
$delete_cart = "DELETE FROM cart WHERE ip_add='$ip_add'";
mysqli_query($con, $delete_cart);

// Alert the user and redirect after the order is submitted
echo "<script>alert('Your order has been submitted, Thank you!')</script>";
echo "<script>window.open('customer/my_account.php?my_order', '_self')</script>";
?>
