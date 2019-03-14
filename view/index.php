<?php

require_once '../partials/header.php';
require_once '../controller/noActionController.php';

$login=isset($login)?$login:"";
//var_dump($login);

if (!empty($login)){
	if(time()- $_SESSION['time']>900){
		session_destroy();
	}else{
	    $_SESSION['time']= time(); 
	}
}


$cart=isset($cart)?$cart:array();
//var_dump($cart);

$productType=isset($productType)?$productType:"";
//var_dump($productType);
$itemsByType=isset($itemsByType)?$itemsByType:array();
//var_dump($itemsByType);
$type=isset($type)?$type:"";
//var_dump($type);
$newItems=isset($newItems)?$newItems:array();
//var_dump($newItems);
$onSale=isset($onSale)?$onSale:array();
//var_dump($onSale);

$numberOfPagesByType=isset($numberOfPagesByType)?$numberOfPagesByType:"";
//var_dump($numberOfPagesByType);
$pageByType=isset($pageByType)?$pageByType:"";
//var_dump($pageByType);
$totalNumberOfRowsByType=isset($totalNumberOfRowsByType)?$totalNumberOfRowsByType:"";
//var_dump($totalNumberOfRowsByType);
$totalNumberOfPagesByType=isset($totalNumberOfPagesByType)?$totalNumberOfPagesByType:"";
//var_dump($totalNumberOfPagesByType);
$page=isset($page)?$page:"";
//var_dump($page);
$totalNumberOfRowsFix=isset($totalNumberOfRowsFix)?$totalNumberOfRowsFix:"";
//var_dump($totalNumberOfRowsFix);
$totalNumberOfPagesFix=isset($totalNumberOfPagesFix)?$totalNumberOfPagesFix:"";
//var_dump($totalNumberOfPagesFix);
$msgSuccess=isset($msgSuccess)?$msgSuccess:"";
//var_dump($msgSuccess);
$msgError=isset($msgError)?$msgError:"";
//var_dump($msgError);
$msgCartError=isset($msgCartError)?$msgCartError:"";
//var_dump($msgCartError);
$idItem=isset($idItem)?$idItem:"";
//var_dump($idItem);
$ItemById=isset($ItemById)?$ItemById:array();
//var_dump($ItemById);
$from=isset($from)?$from:"";
//var_dump($from);
$msgOrderSuccess=isset($msgOrderSuccess)?$msgOrderSuccess:"";
//var_dump($msgOrderSuccess);
?>

<body>
<?php 
require_once '../partials/navigation.php';
   
  if(!empty($msgSuccess)){
?>
     <div class="container">
        <div class="alert alert-success" style="text-align:center;">
 		<span style="color:green;"><?php echo $msgSuccess;?></span>
		</div>
	 </div>
<?php
  }
?>
<?php 
  if(!empty($msgError)){
?>    
     <div class="container">
        <div class="alert alert-danger" style="text-align:center;">
 		<span style="color:red;"><?php echo $msgError;?></span>
		</div>
     </div>
<?php
  }
?>
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								</div>
								<div class="col-sm-6">
									<img src="https://www.makemyorders.com/media/webrication/offers/banner-f9fd9.jpg" class="girl img-responsive" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									
								</div>
								<div class="col-sm-6">
									<img src="../partials/images/home/girl2.jpg" class="girl img-responsive" alt="" />
									<img src="../partials/images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								</div>
								<div class="col-sm-6">
									<img src="https://image.freepik.com/free-vector/happy-kids-illustration_23-2147531838.jpg" class="girl img-responsive" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	<?php if (!empty($msgOrderSuccess)){
	?>
	<div class="container">
		<div class="jumbotron jumbotron-fluid">
		  <div class="container">
		    <h1 class="display-4">Successful shopping!</h1>
		    <p class="lead"><span><b><?php echo $msgOrderSuccess['name'];?></b> </span><span> <b><?php echo $msgOrderSuccess['last_name'];?></b></span></p>
		    <p class="lead"><b>Order will be sent to address : </b></p>
		    <p><b><?php echo $msgOrderSuccess['address'];?></b></p>
		  </div>
		</div>
	</div>
	<?php	
	}?>
	
	
	<section>
		<div class="container">
			<div class="row">
			    <?php 
                if(!empty($msgCartSuccess)){
				?>
				        <div class="alert alert-success" style="text-align:center;">
				 		<span style="color:green;"><?php echo $msgCartSuccess;?></span>
						</div>
				<?php
					}
				?>
				<?php 
                if(!empty($msgCartError)){
				?>
				        <div class="alert alert-danger" style="text-align:center;">
				 		<span style="color:red;"><?php echo $msgCartError;?></span>
						</div>
				<?php
					}
				?>
				<div class="col-sm-3">
					<?php require_once '../partials/categories.php'; ?>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">New Items</h2>
						<?php foreach ($newItems as $oneItem){?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center" id="new">
											<img style="height:200px;" src="../partials/images/products/<?php echo (!empty($oneItem['img']))?$oneItem['img'] :'no-image-available.jpg';?>" alt="" />
											<h2>$<?php echo $oneItem['price'];?></h2>
											<p><?php echo $oneItem['name'];?></p>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>$<?php echo $oneItem['price'];?></h2>
												<p><?php echo $oneItem['name'];?></p>
												<a href="routes.php?page=productDetail&idproduct=<?php echo $oneItem['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
											</div>
										</div>
										<img src="../partials/images/home/new.png" class="new" alt="" />
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="routes.php?page=addToCart&from=<?php echo 'index';?>&idItem=<?php echo $oneItem['id_product'];?>#new" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php 
						  }
						?>
					</div><!--features_items-->
					
                   <div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
							   <?php foreach ($productType as $oneType){ ?>
							   
								<li class="<?php if($oneType['type']==$type || $oneType['type']=="shoes"&&empty($type)) echo'active';?>"><a href="routes.php?page=itemsType&Type=<?php echo $oneType['type'];?>#tshirt"><?php echo $oneType['type'];?></a></li>
								
							   <?php }?>
							</ul>
						</div>
						<div class="tab-content">
						<?php 
						 
	                     if(empty($itemsByType)){
	                     	foreach ($fixItemsByType as $value) {
	                     		if(!empty($value['discount_price'])){
	                     ?>
	                     <div class="tab-pane fade active in" id="fix">
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img style="height:140px;" src="../partials/images/products/<?php echo (!empty($value['img']))?$value['img'] :'no-image-available.jpg';?>" alt="" />
												<h2><del>Full price $<?php echo $value['price'];?></del></h2>
												<h2>-<?php echo $value['discount'];?>% &nbsp;$<?php echo $value['discount_price'];?></h2>
												<p><?php echo $value['name'];?></p>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													<h2>Disc price $<?php echo $value['discount_price'];?></h2>
													<p><?php echo $value['name'];?></p>
													<a href="routes.php?page=productDetail&idproduct=<?php echo $value['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
												</div>
										    </div>
											<img src="../partials/images/home/sale.png" class="new" alt="" />
										</div>
										<ul class="nav nav-pills nav-justified">
									    <li><a href="routes.php?page=addToCart&currentPage=<?php echo $page;?>&numberofPages=<?php echo $numberOfPages;?>&type=<?php echo $type='shoes';?>&from=<?php echo 'index';?>&idItem=<?php echo $value['id_product'];?>#tshirt" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									    </ul>
									</div>
								</div>
						  </div>
						  <?php }else{ ?>
						  <div class="tab-pane fade active in" id="fix">
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img style="height:140px;" src="../partials/images/products/<?php echo (!empty($value['img']))?$value['img'] :'no-image-available.jpg';?>" alt="" />
												<h2>Full price </h2>
												<h2>$<?php echo $value['price'];?></h2>
												<p><?php echo $value['name'];?></p>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													<h2>$<?php echo $value['price'];?></h2>
													<p><?php echo $value['name'];?></p>
													<a href="routes.php?page=productDetail&idproduct=<?php echo $value['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
												</div>
										   </div>
										</div>
										<ul class="nav nav-pills nav-justified">
									    <li><a href="routes.php?page=addToCart&currentPage=<?php echo $page;?>&numberofPages=<?php echo $numberOfPages;?>&type=<?php echo $type='shoes';?>&from=<?php echo 'index';?>&idItem=<?php echo $value['id_product'];?>#tshirt" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									    </ul>
									</div>
									
								</div>
						   </div>
						   <?php 	
							   }
	                     	 }
						   ?>
					 </div><!--/category-tab-->
					 <?php 
	                     }else{
	                       foreach ($itemsByType as $oneType){
	                       
	                       	if(!empty($oneType['discount_price'])){
	                  ?>
							<div class="tab-pane fade active in" id="tshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img style="height:140px;" src="../partials/images/products/<?php echo (!empty($oneType['img']))?$oneType['img'] :'no-image-available.jpg';?>" alt="" />
												<h2><del>Full price $<?php echo $oneType['price'];?></del></h2>
												<h2>-<?php echo $oneType['discount'];?>% &nbsp;$<?php echo $oneType['discount_price'];?></h2>
												<p><?php echo $oneType['name'];?></p>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													<h2>Disc price $<?php echo $oneType['discount_price'];?></h2>
													<p><?php echo $oneType['name'];?></p>
													<a href="routes.php?page=productDetail&idproduct=<?php echo $oneType['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
												</div>
										   </div>
											  <img src="../partials/images/home/sale.png" class="new" alt="" />
										</div>
										<ul class="nav nav-pills nav-justified">
									    <li><a href="routes.php?page=addToCart&currentPage=<?php echo $pageByType;?>&numberofPages=<?php echo $numberOfPagesByType;?>&type=<?php echo $type;?>&from=<?php echo 'index';?>&idItem=<?php echo $oneType['id_product'];?>#tshirt" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									    </ul>
									</div>
								</div>
							</div>
							<?php 
	                       	    }else{
	                       	 ?>
	                       	    <div class="tab-pane fade active in" id="tshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img style="height:140px;" src="../partials/images/products/<?php echo (!empty($oneType['img']))?$oneType['img'] :'no-image-available.jpg';?>" alt="" />
												<h2>Full price </h2>
												<h2>$<?php echo $oneType['price'];?></h2>
												<p><?php echo $oneType['name'];?></p>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													<h2>$<?php echo $oneType['price'];?></h2>
													<p><?php echo $oneType['name'];?></p>
													<a href="routes.php?page=productDetail&idproduct=<?php echo $oneType['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
												</div>
										   </div>
										</div>
										<ul class="nav nav-pills nav-justified">
									    <li><a href="routes.php?page=addToCart&currentPage=<?php echo $pageByType;?>&numberofPages=<?php echo $numberOfPagesByType;?>&type=<?php echo $type;?>&from=<?php echo 'index';?>&idItem=<?php echo $oneType['id_product'];?>#tshirt" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									    </ul>
									</div>
								</div>
							</div>
						  <?php 
	                       	    } 	
	                          } 
						    ?>
					</div><!--/category-tab-->
	                 <?php     
	                     }				
					?>
				</div>
				<?php
				if(empty($itemsByType)){
                  if(!($numberOfPages >= $totalNumberOfRowsFix)){
                ?>
                   <ul class="pagination">
		                    <?php
		                        for ($i = 1; $i <= $totalNumberOfPagesFix; $i++) {
		                            if($i == $page){
		                                $classActive = "active";
		                            }else{
		                                $classActive = "";
		                            }
		                            ?>
		                                <li class="<?php echo $classActive; ?>"><a href="index.php?page=<?php echo $i;?>#fix"><?php echo $i; ?></a></li>
		                            <?php
		                        }
		                    ?>
		             </ul>
                <?php
	                }
					}else{
				     if(!($numberOfPagesByType >= $totalNumberOfRowsByType)){
                ?>
                   <ul class="pagination">
		                    <?php
		                        for ($i = 1; $i <= $totalNumberOfPagesByType; $i++) {
		                            if($i == $pageByType){
		                                $classActive = "active";
		                            }else{
		                                $classActive = "";
		                            }
		                            ?>
		                                <li class="<?php echo $classActive; ?>"><a href="routes.php?page=itemsType&Type=<?php echo $type;?>&pageNumber=<?php echo $i;?>#tshirt"><?php echo $i; ?></a></li>
		                            <?php
		                        }
		                    ?>
		             </ul>
                <?php
	                 }	
					}
                ?>
				
				<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">On sale items</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
						
								<div class="item active" id="onsale">
								<?php 
								  $i=0;
								  foreach ($onSale as $sale){
									$i++;
								    if($i<=3){ 
								?>	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="height:130px;width:150px;" src="../partials/images/products/<?php echo (!empty($sale['img']))?$sale['img'] :'no-image-available.jpg';?>" alt="" />
													<h2><del>$<?php echo $sale['price'];?></del></h2>
													<h2>-<?php echo $sale['discount'];?>% &nbsp;$<?php echo $sale['discount_price'];?></h2>
													<p><?php echo $sale['name'];?></p>
													<a href="routes.php?page=addToCart&from=<?php echo 'index';?>&idItem=<?php echo $sale['id_product'];?>#onsale" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												<img src="../partials/images/home/sale.png" class="new" alt="" />
											</div>
										</div>
									</div>
								<?php }
								  }
								?>
								</div>
								<div class="item" id="onsale">
								<?php 
									 $i=0;
									 foreach ($onSale as $sale){
									  $i++;
									  if($i>3 && $i<=6){ 
								?> 
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="height:130px;width:150px;" src="../partials/images/products/<?php echo (!empty($sale['img']))?$sale['img'] :'no-image-available.jpg';?>" alt="" />
													<h2><del>$<?php echo $sale['price'];?></del></h2>
													<h2><span class="discount-label red">-<?php echo $sale['discount'];?>% </span> $<?php echo $sale['discount_price'];?></h2>
													<p><?php echo $sale['name'];?></p>
													<a href="routes.php?page=addToCart&from=<?php echo 'index';?>&idItem=<?php echo $sale['id_product'];?>#onsale" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												<img src="../partials/images/home/sale.png" class="new" alt="" />
											</div>
										</div>
									</div>
								<?php }
								   }
								?>
									
								</div>
								
							    <div class="item" id="onsale">
										<?php 
											 $i=0;
											 foreach ($onSale as $sale){
											  $i++;
											 if($i>6 && $i<=9){ 
										?> 
											<div class="col-sm-4" id="tshirt">
												<div class="product-image-wrapper">
													<div class="single-products">
														<div class="productinfo text-center">
															<img style="height:130px;width:150px;" src="../partials/images/products/<?php echo (!empty($sale['img']))?$sale['img'] :'no-image-available.jpg';?>" alt="" />
															<h2><del>$<?php echo $sale['price'];?></del></h2>
															<h2><span class="discount-label red">-<?php echo $sale['discount'];?>% </span> $<?php echo $sale['discount_price'];?></h2>
															<p><?php echo $sale['name'];?></p>
															<a href="routes.php?page=addToCart&from=<?php echo 'index';?>&idItem=<?php echo $sale['id_product'];?>#onsale" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
														 </div>
														<img src="../partials/images/home/sale.png" class="new" alt="" />
													</div>
												 </div>
											 </div>
										<?php 
											 }
										   }
										?>
							     </div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
			</div>
		</div>
	</section>
	<?php
	require_once '../partials/footer.php';
	require_once '../partials/js.php';
	?>
</body>
</html>