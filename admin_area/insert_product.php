<?php
if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self')</script>";
} else {
	?>


	<!DOCTYPE html>
	<html>

	<head>
		<title>Insert Product</title>

		<script>tinymce.init({ selector: 'textarea' });</script>

	</head>

	<body>

		<div class="row"><!--breadcrump start-->
			<div class="col-lg-12">
				<div class="breadcrump">
					<li class="active">
						<i class="fa fa-bar-chart"></i>
						Dashboard / Insert Product
					</li>
				</div>
			</div>
		</div><!--breadcrump End-->
		<div class="row">
			<div class="col-lg-3">

			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading"><!--panel-heading start-->
						<h3 class="panel-title">
							<i class="fa fa-money fa-fw"> Insert Product </i>
						</h3>
					</div><!--panel-heading End-->
					<div class="panel-body">
						<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label class="col-md-3 control-label">Product Name</label>
								<input type="text" name="product_title" class="form-control"
									placeholder="Enter product title" required="">
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Product Image </label>
								<input type="file" name="product_img1" class="form-control" required="">
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Product Price</label>
								<input type="text" name="product_price" class="form-control" placeholder="Enter price"
									required="">
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Product quantity</label>
								<input type="text" name="quantity" class="form-control" placeholder="Enter keyword"
									required="">
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Product Description</label>
								<textarea name="product_desc" class="form-control" rows="6" cols="19"
									placeholder="Enter product description"></textarea>
							</div>

							<div class="form-group">
								<input type="submit" name="submit" value="Insert Product"
									class="btn btn-primary form-control">
							</div>
						</form>
					</div>

				</div>
			</div>
			<div class="col-lg-3">

			</div>
		</div>





	</body>

	</html>

	<?php
	if (isset($_POST['submit'])) {
		$product_title = $_POST['product_title'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_quantity = $_POST['quantity'];

		$product_img1 = $_FILES['product_img1']['name'];

		$temp_name1 = $_FILES['product_img1']['tmp_name'];

		move_uploaded_file($temp_name1, "../assets/$product_img1");

		$inset_product = "insert into prod(name,description,price,image_url,quantity) values ('$product_title','$product_desc','$product_price', '$product_img1','$product_quantity')";

		$run_product = mysqli_query($con, $inset_product);

		if ($run_product) {
			echo "<script>alert('Product Inserted Sucessfully')</script>";
			echo "<script>window.open('index.php?view_product')</script>";

		}
	}

	?>

<?php } ?>