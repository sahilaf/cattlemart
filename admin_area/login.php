<?php
session_start();
include("includes/db.php");


  ?>

<!DOCTYPE html>
<html>
<head>
	
	   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>



<div class="container">
	<form class="form-login" action="" method="post">
		<h2 class="form-login-heading">Admin Login</h2>
		<input type="text" class="form-control" name="admin_email" placeholder="Email Address" required="">
		<input type="password" class="form-control" name="admin_pass" placeholder="Password" required="">
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="admin login"> Log In </button>
		<h4 class="forgot-password">
			<a href="forgot_password.php"> Lost your password? Forgot Password </a>
		</h4>
	</form>
</div>
</body>
</html>

<?php
if (isset($_POST['admin_login'])){
	$admin_email=mysqli_real_escape_string($con,$_POST['admin_email']);
	$admin_pass=mysqli_real_escape_string($con,$_POST['admin_pass']);
	$get_admin="select * from admins where admin_email='$admin_email' AND admin_pass='$admin_pass'";
	$run_admin=mysqli_query($con,$get_admin);
	$count=mysqli_num_rows($run_admin);
	if ($count==1) {
		$_SESSION['admin_email']=$admin_email;
		echo "<script>alert('You are logged')</script>";
		echo "<script>window.open('index.php?dashboard','_self')</script>";
	}else{
		echo "<script>alert('Email / Password Wrong')</script>";
	}
}


  ?>