<?php
require_once '../partials/header.php';
require_once '../partials/navigation.php';
$oneProduct=isset($oneProduct)?$oneProduct:"";
//var_dump($oneProduct);
$idProduct=isset($idProduct)?$idProduct:"";
//var_dump($idProduct);
$errors=isset($errors)?$errors:"";
$msgSuccess=isset($msgSuccess)?$msgSuccess:"";
$msgError=isset($msgError)?$msgError:"";
$reviewsById=isset($reviewsById)?$reviewsById:array();
//var_dump($reviewsById);
 
$counter=0;
foreach ($reviewsById as $value) {
    if ($value['status']=="approved"){
    $counter++;
    }
}

?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<?php require_once '../partials/categories.php'; ?>
				</div>
				<div class="col-sm-9 padding-right">
				<?php 
				  if(!empty($msgSuccess)){
				?>
				        <div class="alert alert-success" style="text-align:center;">
				 		<span style="color:green;"><b><?php echo $msgSuccess;?></b></span>
						</div>
				<?php
				  }
				?>
				<?php 
				  if(!empty($msgError)){
				?>    
				     <div class="container">
				        <div class="alert alert-danger" style="text-align:center;">
				 		<span style="color:red;"><b><?php echo $msgError;?></b></span>
						</div>
				     </div>
				<?php
				  }
				?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="../partials/images/products/<?php echo (!empty($oneProduct['img']))?$oneProduct['img'] :'no-image-available.jpg';?>" alt="" />
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								
								<h2><?php echo $oneProduct['name'];?></h2>
								<p><b>Category /Subcategory : </b> <?php echo $oneProduct['cat_name']." / ". $oneProduct['sub_name'];?></p>
								<p><b>Type : </b> <?php echo strtoupper($oneProduct['type']);?></p>
								<p><b>Condition :</b> <?php echo (!empty($oneProduct['discount']))?"<b style='color:green;'>ON SALE</b>":"";?></p>
								<p><b>Discount :</b> <?php echo (!empty($oneProduct['discount']))?$oneProduct['discount'].'%':"";?> </p>
								<p><b>Price : </b> <?php echo (!empty($oneProduct['discount_price']))?' disc price  '.$oneProduct['discount_price']:$oneProduct['price'];?> $ </p>
								<p><b>Brand :</b> E-SHOPPER</p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (<?php echo $counter;?>)</a></li>
							</ul>
						</div>
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
								  <?php foreach ($reviewsById as $review) {
								          if ($review['status']=="approved"){
								  ?>
									<ul>
										<li><a href=""><i class="fa fa-user"></i><?php echo $review['user_name'];?></a></li>
										<li><a href=""><i class="fa fa-clock-o"></i><?php echo $review['time'];?></a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i><?php echo $review['date'];?></a></li>
									</ul>
									<p><?php echo $review['comment'];?></p>
									<?php 
								          }
								        }  
								    ?>
									
									<p><b>Write Your Review</b></p>
								  
									<form action="routes.php" method="post">
										<span>
											<input type="text" name="name" value="" placeholder="Your Name"/>
											<?php 
							                        if (isset($errors['name'])) {
							                            foreach($errors['name'] as $errorMessage) {
							                                ?>
							                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
							                                <?php
							                            }
							                        }
							                ?>
											<input type="email" name="email" value="" placeholder="Email Address"/>
											<?php 
							                        if (isset($errors['email'])) {
							                            foreach($errors['email'] as $errorMessage) {
							                                ?>
							                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
							                                <?php
							                            }
							                        }
							                ?>
										</span>
										     <textarea name="review" ></textarea>
										     <?php 
							                        if (isset($errors['review'])) {
							                            foreach($errors['review'] as $errorMessage) {
							                                ?>
							                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
							                                <?php
							                            }
							                        }
							                 ?>
							                 <br><br>
											 <input class="form-control" type="hidden" name="productId" value="<?php if (!empty($idProduct)){echo $idProduct;}?>">
							                 <input type="submit"  name="page" value="Submit review" class="btn btn-default" style="background-color:#ff8000;color:white;">
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
				</div>
			</div>
		</div>
	</section>
    <?php
	require_once '../partials/footer.php';
	require_once '../partials/js.php';
	?>
</body>
</html>