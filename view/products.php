<?php

require_once '../partials/header.php';
require_once '../partials/navigation.php';
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
$productsBySubId=isset($productsBySubId)?$productsBySubId:array();
//var_dump($productsBySubId);
$subName=isset($subName)?$subName:"";
//var_dump($subName);
$pageByType=isset($pageByType)?$pageByType:"";
//var_dump($pageByType);
$numberOfPagesByType=isset($numberOfPagesByType)?$numberOfPagesByType:"";
//var_dump($numberOfPagesByType);
$totalNumberOfPagesByType=isset($totalNumberOfPagesByType)?$totalNumberOfPagesByType:"";
//var_dump($totalNumberOfPagesByType);
$totalNumberOfRowsByType=isset($totalNumberOfRowsByType)?$totalNumberOfRowsByType:"";
//var_dump($totalNumberOfRowsByType);
$ItemById=isset($ItemById)?$ItemById:array();
//var_dump($ItemById);
$subId=isset($subId)?$subId:"";
//var_dump($subId); 


$subNameFix=isset($subNameFix)?$subNameFix:"";
//var_dump($subNameFix);
$fixItemsBySubCatIdJBG=isset($fixItemsBySubCatIdJBG)?$fixItemsBySubCatIdJBG:array();
//var_dump($fixItemsBySubCatIdJBG);
$numberOfPagesForProductPage=isset($numberOfPagesForProductPage)?$numberOfPagesForProductPage:"";
//var_dump($numberOfPagesForProductPage);
$totalNumberOfRows=isset($totalNumberOfRows)?$totalNumberOfRows:"";
//var_dump($totalNumberOfRows);
$totalNumberOfPages=isset($totalNumberOfPages)?$totalNumberOfPages:"";
//var_dump($totalNumberOfPages);
$page=isset($page)?$page:"";
//var_dump($page);

$msgCartSuccess=isset($msgCartSuccess)?$msgCartSuccess:"";
//var_dump($msgCartSuccess);
$msgCartError=isset($msgCartError)?$msgCartError:"";
//var_dump($msgCartError);

$from=isset($from)?$from:"";
//var_dump($from);
?>

	
	
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
					<br><br><br>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Products by brand - <?php echo isset($subName['sub_name'])?$subName['sub_name']:$subNameFix['sub_name'];?></h2>
						
						<?php if(empty($productsBySubId)){
						    foreach ($fixItemsBySubCatId as $oneBySubId){
						    	if (!empty($oneBySubId['discount_price'])){
						?>
						    <div class="col-sm-4">
							 <div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img style="height:200px;" src="../partials/images/products/<?php echo (!empty($oneBySubId['img']))?$oneBySubId['img'] :'no-image-available.jpg';?>" alt="" />
										<h2><del>Full price $<?php echo $oneBySubId['price'];?></del></h2>
										<h2>-<?php echo $oneBySubId['discount'];?>% &nbsp;$<?php echo $oneBySubId['discount_price'];?></h2>
										<p><?php echo $oneBySubId['name'];?></p>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2><del>Full price $<?php echo $oneBySubId['price'];?></del></h2>
										    <h2>-<?php echo $oneBySubId['discount'];?>% &nbsp;$<?php echo $oneBySubId['discount_price'];?></h2>
											<p><?php echo $oneBySubId['name'];?></p>
											<a href="routes.php?page=productDetail&idproduct=<?php echo $oneBySubId['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
										</div>
									</div>
									<img src="../partials/images/home/sale.png" class="new" alt="" />
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
									    <li><a href="routes.php?page=addToCart&currentPage=<?php echo $page;?>&numberofPages=<?php echo $numberOfPagesForProductPage;?>&from=<?php echo 'products';?>&subId=<?php echo $subId=1;?>&idItem=<?php echo $oneBySubId['id_product'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									</ul>
								</div>
							 </div>
						   </div>
						<?php 
						    }else{
						?>    	
						    <div class="col-sm-4">
							 <div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img style="height:200px;" src="../partials/images/products/<?php echo (!empty($oneBySubId['img']))?$oneBySubId['img'] :'no-image-available.jpg';?>" alt="" />
										<h2>Full price </h2>
										<h2>$<?php echo $oneBySubId['price'];?></h2>
										<p><?php echo $oneBySubId['name'];?></p>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$<?php echo $oneBySubId['price'];?></h2>
											<p><?php echo $oneBySubId['name'];?></p>
											<a href="routes.php?page=productDetail&idproduct=<?php echo $oneBySubId['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
									    <li><a href="routes.php?page=addToCart&currentPage=<?php echo $page;?>&numberofPages=<?php echo $numberOfPagesForProductPage;?>&from=<?php echo 'products';?>&subId=<?php echo $subId=1;?>&idItem=<?php echo $oneBySubId['id_product'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									</ul>
								</div>
							 </div>
						   </div>
						    	
						  <?php     	
						    }
						   }
						  }else{
						   foreach ($productsBySubId as $one){
						   	  if (!empty($one['discount_price'])){
						  ?>   	
						   	<div class="col-sm-4">
							  <div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img style="height:200px;" src="../partials/images/products/<?php echo (!empty($one['img']))?$one['img'] :'no-image-available.jpg';?>" alt="" />
										<h2><del>Full price $<?php echo $one['price'];?></del></h2>
										<h2>-<?php echo $one['discount'];?>% &nbsp;$<?php echo $one['discount_price'];?></h2>
										<p><?php echo $one['name'];?></p>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2><del>Full price $<?php echo $one['price'];?></del></h2>
										    <h2>-<?php echo $one['discount'];?>% &nbsp;$<?php echo $one['discount_price'];?></h2>
											<p><?php echo $one['name'];?></p>
											<a href="routes.php?page=productDetail&idproduct=<?php echo $one['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
										</div>
									</div>
									<img src="../partials/images/home/sale.png" class="new" alt="" />
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
									    <li><a href="routes.php?page=addToCart&currentPage=<?php echo $pageByType;?>&numberofPages=<?php echo $numberOfPagesByType;?>&from=<?php echo 'products';?>&subId=<?php echo $subId=$_GET['subId'];?>&idItem=<?php echo $one['id_product'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									</ul>
								</div>
							 </div>
						  </div>
						<?php
						   }else{
						?> 
						   <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img style="height:200px;" src="../partials/images/products/<?php echo (!empty($one['img']))?$one['img'] :'no-image-available.jpg';?>" alt="" />
										<h2>Full price </h2>
										<h2>$<?php echo $one['price'];?></h2>
										<p><?php echo $one['name'];?></p>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$<?php echo $one['price'];?></h2>
											<p><?php echo $one['name'];?></p>
											<a href="routes.php?page=productDetail&idproduct=<?php echo $one['id_product'];?>" class="btn btn-default add-to-cart">Product detail</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
									    <li><a href="routes.php?page=addToCart&currentPage=<?php echo $pageByType;?>&numberofPages=<?php echo $numberOfPagesByType;?>&from=<?php echo 'products';?>&subId=<?php echo $subId=$_GET['subId'];?>&idItem=<?php echo $one['id_product'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
									</ul>
								</div>
							</div>
						 </div>
						<?php    	 
						   }
						  }
						 }
						?>
						
						<?php
						 if(empty($productsBySubId)){
		                   if(!($numberOfPagesForProductPage >= $totalNumberOfRows)){
		                ?>
                        <ul class="pagination">
		                    <?php
		                        for ($i = 1; $i <= $totalNumberOfPages; $i++) {
		                            if($i == $page){
		                                $classActive = "active";
		                            }else{
		                                $classActive = "";
		                            }
		                    ?>
		                        <li class="<?php echo $classActive; ?>"><a href="products.php?page=<?php echo $i; ?>#tshirt"><?php echo $i; ?></a></li>
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
		                        <li class="<?php echo $classActive; ?>"><a href="routes.php?page=productsBySubId&pageByType=<?php echo $i;?>&subId=<?php echo $subId=$_GET['subId'];?>#tshirt"><?php echo $i; ?></a></li>
		                    <?php
		                        }
		                    ?>
		                </ul>
		                <?php
			                 }	
							}
		                ?>
					</div><!--features_items-->
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