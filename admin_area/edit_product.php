<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

?>

<?php

if (isset($_GET['edit_product'])) {
	$edit_id=$_GET['edit_product'];
	$get_p="select * from prod where id='$edit_id'";
	$run_edit=mysqli_query($con,$get_p);
	$row_edit=mysqli_fetch_array($run_edit);
	$p_id=$row_edit['id'];
	$p_title=$row_edit['name'];
	$p_image1=$row_edit['image_url'];
	$p_price=$row_edit['price'];
	$p_desc=$row_edit['description'];
	$p_quantity=$row_edit['quantity'];

}


?>

<!DOCTYPE html>
<html>
<head>

	<title>Edit Products</title>

<script>tinymce.init({selector:'textarea'});</script>

</head>
<body>

<div class="row"><!--breadcrump start-->
	<div class="col-lg-12">
		<div class="breadcrump">
			<li class="active">
				<i class="fa fa-bar-chart"></i>
				Dashboard / Edit Product
			</li>
		</div>
	</div>
</div><!--breadcrump End-->
<div class="row1">
	<div class="col-lg-12">
		
	</div>
	<div class="row">
		<div class="panel panel-default1">
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"> Edit Products </i>
				</h3>
			</div><!--panel-heading End-->
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Name</label>
						<input type="text" name="name" class="form-control" required value="<?php echo $p_title; ?>">
					</div>
					
					
					<div class="form-group">
						<label class="col-md-3 control-label">Product Price</label>
						<input type="text" name="price" class="form-control" required value="<?php echo $p_price; ?>">
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Product quantity</label>
						<input type="text" name="quantity" class="form-control" required value="<?php echo $p_quantity; ?>">
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Product Description</label>
						<textarea name="description" class="form-control" rows="6" cols="19"><?php echo $p_desc; ?></textarea>
					</div>
					<div class="form-group">
					
						<input type="submit" name="update" value="update product" class="btn btn-primary form-control">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		
	</div>
</div>

</head>
<body>

</body>
</html>


<?php
if (isset($_POST['update'])) {
	$name=$_POST['name'];
	$description=$_POST['description'];
	$price=$_POST['price'];
	
	$quantity=$_POST['quantity'];


	$update_product="update prod set name='$name',description='$description',price='$price',quantity='$quantity' where id='$p_id'";
	$run_product=mysqli_query($con,$update_product);
	if ($run_product) {
		echo "<script>alert('Product has been updated successfully')</script>";
		echo "<script>window.open('index.php?view_product','_self')</script>";
	}


}


  ?>


<?php } ?>