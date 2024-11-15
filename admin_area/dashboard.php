<?php
if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self')</script>";
} else {

	?>


	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
			<ol class="breadcrumb">
				<li class="active"><i class="fa fa-bar-chart"></i> Dashboard </li>
			</ol>
		</div>




		<div class="row1">
			<div class="col-lg-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							<i class="fa fa-money fa-fw"></i> New orders
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
									$total_pending_amount = 0; // Initialize total pending amount

									$get_pending_orders = "
										SELECT 
											customer_order.order_id,
											customers.customer_email,
											customer_order.invoice_no,
											customer_order.order_date,
											customer_order.due_amount,
											customer_order.order_status
										FROM 
											customer_order
										JOIN 
											customers ON customer_order.customer_id = customers.customer_id
										LEFT JOIN 
											payments ON customer_order.invoice_no = payments.invoice_id
										WHERE 
											customer_order.order_status = 'pending'
											AND payments.payment_id IS NULL
									";

									$run_pending_orders = mysqli_query($con, $get_pending_orders);
									
									while ($row_pending_orders = mysqli_fetch_array($run_pending_orders)) {
										$order_id = $row_pending_orders['order_id'];
										$customer_email = $row_pending_orders['customer_email'];
										$invoice_no = $row_pending_orders['invoice_no'];
										$order_date = $row_pending_orders['order_date'];
										$due_amount = $row_pending_orders['due_amount'];
										$order_status = $row_pending_orders['order_status'];

										$total_pending_amount += $due_amount; // Accumulate pending amounts

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
												<a href="index.php?order_delete=<?php echo $order_id; ?>">
													<i class="fa fa-trash"></i> Delete
												</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						
						<!-- Display Total Pending Amount -->
						<div class="alert alert-info">
							<strong>Total Pending Amount:</strong> <?php echo $total_pending_amount; ?> Bdt
						</div>

						<div class="text-right">
							<a href="index.php?view_order"> View all orders
								<i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel">
					<div class="panel-body">
						<div class="thumb-info mb-md">
							<img src="assets/<?php echo $admin_image ?>" class="rounded img-responsive" width="200"
								height="200" style="border-radius: 50%;">
							<div class="thumb-info-title">
								<span class="thumb-info-inner"><?php echo $admin_name; ?></span><br>
							</div>
						</div>

						<div class="mb-md">
							<div class="widget-content-expanded">
								<i class="fa fa-user"></i> <span>Email : </span> <?php echo $admin_email ?> <br>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

<?php } ?>
