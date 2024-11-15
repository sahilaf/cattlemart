<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

?>

<div class="row"><!--breadcrump start-->
	<div class="col-lg-12">
		<div class="breadcrump">
			<li class="active">
				<i class="fa fa-bar-chart"></i>
				Dashboard / View Categories
			</li>
		</div>
	</div>
</div><!--breadcrump End-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i>
					View Categories
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">

					<table class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th>Cattle Id</th>
									<th>Breed</th>
									<th>Health history</th>
									<th>Price</th>
									<th>Age</th>
									<th>Weight</th>
									<th>Quantity</th>
									<th>Delete Category</th>
									<th>Edit Category</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
								$i=0;
								$get_cats="select * from cattle";
								$run_cats=mysqli_query($con,$get_cats);

								while ($row_cats=mysqli_fetch_array($run_cats)) {

									$cat_id=$row_cats['cattle_id'];
									$cat_title=$row_cats['breed'];
									$cat_health_history=$row_cats['health_history'];
									$cat_price=$row_cats['Price'];
									$cat_age=$row_cats['age'];
									$cat_weight=$row_cats['weight'];
									$cat_quantity=$row_cats['qty'];

									$i++;
								
								  ?>
                                <tr>
                                	<td><?php echo $cat_id; ?></td>
                                	<td><?php echo $cat_title; ?></td>
                                	<td width="300"><?php echo $cat_health_history; ?></td>
									<td width="300"><?php echo $cat_price; ?></td>
									<td width="300"><?php echo $cat_age; ?></td>
									<td width="300"><?php echo $cat_weight; ?></td>
									<td width="300"><?php echo $cat_quantity; ?></td>

                                	<td>
                                		<a href="index.php?delete_cat=<?php echo $cat_id; ?>">
										<i class="fa fa-trash"></i> Delete
                                		</a>
                                	</td>
                                      <td>
                                      	<a href="index.php?edit_cat=<?php echo $cat_id; ?>">
                                      		<i class="fa fa-pen"></i> Edit
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

<?php } ?>