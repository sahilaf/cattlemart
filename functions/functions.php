
<?php

$db=mysqli_connect("localhost","root","","e_com");
//for getting user ip start
function getUserIp(){
	switch (true) {
		case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
			case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
			case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
				default : return $_SERVER['REMOTE_ADDR'];
	}
}


function addCart(){
	global $db;
	if(isset($_GET['add_cart'])) {
		$ip_add=getUserIp();
		$p_id=$_GET['add_cart'];
		$product_qty=$_POST['product_qty'];
		$check_product="select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
		$run_check=mysqli_query($db,$check_product);
		if (mysqli_num_rows($run_check)>0) {
			echo "<script>alert('This product is already added in your cart')</script>";
			echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
		}else{
			$query="insert into cart(p_id,ip_add,qty ) values('$p_id','$ip_add','$product_qty')";
			$run_query=mysqli_query($db,$query);
			echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
		}
	}
}

function add_cattle_Cart(){
	global $db;
	if(isset($_GET['add_cattle_cart'])) {
		$ip_add=getUserIp();
		$p_id=$_GET['add_cattle_cart'];
		$product_qty=$_POST['product_qty'];
		$check_product="select * from cart where ip_add='$ip_add' AND c_id='$p_id'";
		$run_check=mysqli_query($db,$check_product);
		if (mysqli_num_rows($run_check)>0) {
			echo "<script>alert('This product is already added in your cart')</script>";
			echo "<script>window.open('details_cattle.php?pro_id=$p_id','_self')</script>";
		}else{
			$query="insert into cart(c_id,ip_add,qty ) values('$p_id','$ip_add','$product_qty')";
			$run_query=mysqli_query($db,$query);
			echo "<script>window.open('details_cattle.php?pro_id=$p_id','_self')</script>";
		}
	}
}

//items count start

function item(){
	global $db;
	$ip_add=getUserIp();
	$get_items="select * from cart where ip_add='$ip_add'";
	$run_item=mysqli_query($db,$get_items);
	$count=mysqli_num_rows($run_item);
	echo $count;
}

//items count End

//total price start

function totalPrice(){
	global $db;
	$ip_add=getUserIp();
	$total=0;
	$select_cat="select * from cart where ip_add='$ip_add'";
	$run_cart=mysqli_query($db,$select_cat);
	while ($record=mysqli_fetch_array($run_cart)) {
		$pro_id=$record['p_id'];
		$pro_qty=$record['qty'];
		$get_price="select * from products where product_id='$pro_id' ";
		$run_price=mysqli_query($db,$get_price);
		while ($row=mysqli_fetch_array($run_price)) {
			$sub_total=$row['product_price']*$pro_qty;
			$total += $sub_total;
		}
	}
echo $total;
}


//total price End
//for getting user ip start

//Cattle info on MArket
function getPro() {
    global $db;

    // Check if the max_price parameter is set and get its value
    $max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : PHP_INT_MAX; // Default to a very high value

    // Prepare the query to select cattle below the specified price
    $get_product = "SELECT * FROM cattle WHERE Price <= $max_price"; 
    $run_products = mysqli_query($db, $get_product);

    while ($row_product = mysqli_fetch_array($run_products)) {
        $pro_id = $row_product['cattle_id'];
        $pro_title = $row_product['breed'];
        $pro_price = $row_product['Price'];
        $pro_img1 = $row_product['image'];

        echo "<div class='col-md-4 col-sm-6 single'>
            <div class='product'>
                <a href='details.php?pro_id=$pro_id'>
                    <img src='assets/$pro_img1' class='img-responsive' width='300' height='300'>
                </a>
                <h3><a href='details.php?pro_id=$pro_id'><span>$pro_title </span> </a></h3>
                <p class='price'> Price $pro_price</p>
                <p class='buttons'> 
                    <a href='details_cattle.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
                    <a href='details_cattle.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>Add to Cart</a>
                </p>
            </div>
        </div>";
    }
}


//Cattle in home page
function getProHome(){
	global $db;
	$get_product="select * from cattle order by 1 DESC LIMIT 0,6";
	$run_products=mysqli_query($db,$get_product);
	while ($row_product=mysqli_fetch_array($run_products)) {
		$pro_id=$row_product['cattle_id'];
		$pro_title=$row_product['breed'];
		$pro_price=$row_product['Price'];
		$pro_img1=$row_product['image'];
		

		echo "<div class='col-md-4 col-sm-6 single'>
		<div class='product'>
		<a href='details.php?pro_id=$pro_id'>
		<img src='assets/$pro_img1' class='img-responsive' width='300' height='300'>
		</a>
		<h3><a href='details.php?pro_id=$pro_id'><span>$pro_title </span> </a></h3>
		<p class='price'> Price $pro_price</p>
		<p class='buttons'> 
		<a href='details_cattle.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
		<a href='details_cattle.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>Add to Cart</a>
		 </p>

		

        </div>
        </div>";

	}
}


//product images start

//Get products in home page
function getProductsHome(){
	global $db;
	$get_product="select * from prod order by 1 DESC LIMIT 0,6";
	$run_products=mysqli_query($db,$get_product);
	while ($row_product=mysqli_fetch_array($run_products)) {
		$pro_id=$row_product['id'];
		$pro_title=$row_product['name'];
		$pro_price=$row_product['price'];
		$pro_des=$row_product['description'];
		$pro_img=$row_product['image_url'];
		

		echo "<div class='col-md-4 col-sm-6 single'>
		<div class='product'>
		<a href='details.php?pro_id=$pro_id'>
		<img src='assets/$pro_img' class='img-responsive' width='300' height='300'>
		</a>
		
		<h3><a href='details.php?pro_id=$pro_id'><span>$pro_title </span> </a></h3>
		<p class='price'> Price $pro_price</p>
		<p class='buttons'> 
		<a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
		<a href='details.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>Add to Cart</a>
		 </p>

		

        </div>
        </div>";

	}
}

//Product page
function getProducts(){
	global $db;
	$get_product="select * from prod ";
	$run_products=mysqli_query($db,$get_product);
	while ($row_product=mysqli_fetch_array($run_products)) {
		$pro_id=$row_product['id'];
		$pro_title=$row_product['name'];
		$pro_price=$row_product['price'];
		$pro_des=$row_product['description'];
		$pro_img=$row_product['image_url'];
		

		echo "<div class='col-md-4 col-sm-6 single'>
		<div class='product'>
		<a href='details.php?pro_id=$pro_id'>
		<img src='assets/$pro_img' class='img-responsive' width='300' height='300'>
		</a>
		
		<h3><a href='details.php?pro_id=$pro_id'><span>$pro_title </span> </a></h3>
		<p class='price'> Price $pro_price</p>
		<p class='buttons'> 
		<a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
		<a href='details.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>Add to Cart</a>
		 </p>

		

        </div>
        </div>";

	}
}


  ?>
 





        