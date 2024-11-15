<?php
if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self')</script>";
} else {

	?>

	<?php

	if (isset($_GET['edit_cat'])) {
		$edit_id = $_GET['edit_cat'];
		$edit_cat = "select * from cattle where cattle_id='$edit_id'";

		$run_edit = mysqli_query($con, $edit_cat);
		$row_edit = mysqli_fetch_array($run_edit);

		$c_id = $row_edit['cattle_id'];
		$c_breed = $row_edit['breed'];
		$c_desc = $row_edit['health_history'];
		$c_price = $row_edit['Price'];
		$c_quantity = $row_edit['qty'];
		$c_image = $row_edit['image'];
		$c_age = $row_edit['age'];
		$c_weight = $row_edit['weight'];

	}

	?>

	<div class="row"><!--breadcrump start-->
		<div class="col-lg-12">
			<div class="breadcrump">
				<li class="active">
					<i class="fa fa-bar-chart"></i>
					Dashboard / Edit cattle
				</li>
			</div>
		</div>
	</div><!--breadcrump End-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><!--panel-heading start-->
					<h3 class="panel-title">
						<i class="fa fa-money fa-fw"> Edit cattle</i>
					</h3>
				</div><!--panel-heading End-->
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="">
						<div class="form-group">
							<label class="col-md-3 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" name="breed" class="form-control" required
									value="<?php echo $c_breed; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Health history</label>
							<div class="col-md-6">
								<textarea type="text" name="health_history"
									class="form-control"><?php echo $c_desc; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Price</label>
							<div class="col-md-6">
								<input type="text" name="price" class="form-control" required
									value="<?php echo $c_price; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Quantity</label>
							<div class="col-md-6">
								<input type="text" name="quantity" class="form-control" required
									value="<?php echo $c_quantity; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"> Age</label>
							<div class="col-md-6">
								<input type="text" name="age" class="form-control" required value="<?php echo $c_age; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"> Weight</label>
							<div class="col-md-6">
								<input type="text" name="weight" class="form-control" required
									value="<?php echo $c_weight; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-6">
								<input type="submit" name="update" value="Update    "
									class="btn btn-primary form-control">
							</div>
						</div>
				</div>






				</form>
			</div>
		</div>
	</div>
	</div>

	<?php
	if (isset($_POST['update'])) {
		// Get values from the form fields (use $_POST to capture the new values)
		$c_breed = $_POST['breed'];
		$c_health_history = $_POST['health_history'];
		$c_price = $_POST['price'];
		$c_quantity = $_POST['quantity'];
		$c_age = $_POST['age'];
		$c_weight = $_POST['weight'];

		// Prepare the update query with the new values
		$update_cat = "UPDATE cattle 
					   SET breed='$c_breed', 
						   health_history='$c_health_history', 
						   Price='$c_price', 
						   qty='$c_quantity', 
						   age='$c_age', 
						   weight='$c_weight' 
					   WHERE cattle_id='$c_id'";

		// Execute the update query
		$run_cat = mysqli_query($con, $update_cat);

		if ($run_cat) {
			echo "<script>alert('Cattle details have been updated successfully')</script>";
			echo "<script>window.open('index.php?view_cattle','_self')</script>";
		}
	}


	?>

<?php } ?> // End of Selection