<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

?>
<div class="row"><!--breadcrumb start-->
	<div class="col-lg-12">
		<div class="breadcrumb">
			<li class="active">
				<i class="fa fa-bar-chart"></i>
				Dashboard / View Orders
			</li>
		</div>
	</div>
</div><!--breadcrumb End-->

<!-- First Table: Display All Orders -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"> View All Orders </i>
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th> Order No: </th>
								<th>Customer Email: </th>
								<th>Invoice No: </th>
								<th> Order Date: </th>
								<th> Due Amount: </th>
								<th> Order Status: </th>
								<th> Delete Order: </th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 0;
							$get_orders = "SELECT * FROM customer_order";
                            $run_orders = mysqli_query($con, $get_orders);
                            
                            while ($row_orders = mysqli_fetch_array($run_orders)) {
                            	$order_id = $row_orders['order_id'];
                            	$c_id = $row_orders['customer_id'];
                            	$invoice_no = $row_orders['invoice_no'];
                            	$order_date = $row_orders['order_date'];
                            	$due_amount = $row_orders['due_amount'];
                            	$order_status = $row_orders['order_status'];

                            	// Get customer email from customers table
                            	$get_customer = "SELECT customer_email FROM customers WHERE customer_id='$c_id'";
                            	$run_customer = mysqli_query($con, $get_customer);
                            	$row_customer = mysqli_fetch_array($run_customer);
                            	$customer_email = $row_customer['customer_email'];

                            	$i++;
                            	?>

							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $customer_email; ?></td>
								<td><?php echo $invoice_no; ?></td>
								<td><?php echo $order_date; ?></td>
								<td><?php echo $due_amount; ?> Bdt</td>
								<td><?php echo $order_status == 'pending' ? 'pending' : 'complete'; ?></td>
								<td>
									<a href="index.php?order_delete=<?php echo $order_id;  ?>">
										<i class="fa fa-trash"></i> Delete
									</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Second Table: Display Pending Orders without Payment -->

<?php } ?>
