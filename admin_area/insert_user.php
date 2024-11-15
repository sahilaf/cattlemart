<?php
if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self')</script>";
} else {

	?>

	<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrump">
				<li class="active">
					<i class="fa fa-bar-chart"> </i>
					Dashboard / Insert Admin
				</li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-money fa-fw"></i>
						Insert Admin
					</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-md-3 control-label"> Admin Name: </label>
							<div class="col-md-6">
								<input type="text" name="admin_name" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"> Admin Email: </label>
							<div class="col-md-6">
								<input type="text" name="admin_email" class="form-control" required="">
							</div>

						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"> Admin Password: </label>
							<div class="col-md-6">
								<input type="text" name="admin_pass" class="form-control" required="">
							</div>

						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"> Admin Image: </label>
							<div class="col-md-6">
								<input type="file" name="admin_image" class="form-control" required="">
							</div>

						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-6">
								<input type="submit" name="submit" value="Insert      " class="btn btn-primary form-control">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
	if (isset($_POST['submit'])) {
		$admin_name = $_POST['admin_name'];
		$admin_email = $_POST['admin_email'];
		$admin_pass = $_POST['admin_pass'];
		$admin_image = $_FILES['admin_image']['name'];
		$temp_admin_image = $_FILES['admin_image']['tmp_name'];

		move_uploaded_file($temp_admin_image, "assets/$admin_image");

		$insert_admin = "insert into admins (admin_name,admin_email,admin_pass,admin_image) values ('$admin_name','$admin_email','$admin_pass','$admin_image')";

		$run_admin = mysqli_query($con, $insert_admin);
		if ($run_admin) {
			echo "<script>alert('One New Admin has been inserted')</script>";
			echo "<script>window.open('index.php?view_admin','_self')</script>";
		}
	}


	?>

<?php } ?>


