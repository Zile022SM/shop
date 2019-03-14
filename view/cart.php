<?php
if(!isset($_SESSION['loggedIn'])){
	session_start();
}
$login=unserialize($_SESSION['loggedIn']);
//var_dump($login);

if ($login){
	
require_once '../partials/header.php';
require_once '../partials/navigation.php';



$cart=isset($cart)?$cart:array();
//var_dump($cart);

$msgCartSuccess=isset($msgCartSuccess)?$msgCartSuccess:"";
//var_dump($msgCartSuccess);
$msgCartError=isset($msgCartError)?$msgCartError:"";
//var_dump($msgCartError);
$ItemById=isset($ItemById)?$ItemById:"";
//var_dump($ItemById);
$from=isset($_GET['fromPage'])?$_GET['fromPage']:"";
//var_dump($from);
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="routes.php?page=ContinueShopping">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="container">
				 <div class="row">
				    <div class="col-lg-5 col-offset-md-4">
				      <a class="btn btn-info" role="button" href="routes.php?page=ContinueShopping" style="float:left;left;margin-left:-15px;">Continue shopping</a>
				    </div>
				    <div class="col-md-5">
				      <a class="btn btn-success" role="button" href="routes.php?page=checkPage" style="float:left;left;margin-left:15px;">Proceed to checkout</a>
				    </div>
				    <div class="col-md-2 offset-md-2">
				      <a class="btn btn-danger" role="button" href="routes.php?page=empty&emptyCart=<?php echo"empty";?>" style="float:left;margin-left:55px;">Empty cart</a>
				    </div>
	  			</div>
			</div>
			
			<?php if(!empty($cart)){?>
			<div class="table-responsive cart_info">
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
			    
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php 
					$totalCartamount=0;
					foreach ($cart as $value) {
					?>	
						<tr>
							<td class="cart_product">
								<a href=""><img style="width:70px;height:70px;" src="../partials/images/products/<?php echo (!empty($value['img']))?$value['img'] :'no-image-available.jpg';?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $value['name'];?></a></h4>
								<p>Web ID: <?php echo $value['id_product'];?></p>
							</td>
							<td class="cart_price">
								<p><?php if(!isset($value['discount_price'])|| $value['discount_price']==0){echo "$ ".$value['price'];}else{echo "Disc price : $".$value['discount_price'];}?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_down" href="routes.php?page=decrement&quantity=<?php echo $value['cart_quantity'];?>&id=<?php echo $value['id_product'];?>"> - </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $value['cart_quantity'];?>" autocomplete="on" size="2">
									<a class="cart_quantity_up" href="routes.php?page=increment&quantity=<?php echo $value['cart_quantity'];?>&id=<?php echo $value['id_product'];?>"> + </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$ <?php if (!isset($value['discount_price'])|| $value['discount_price']==0){echo $totalByItem=$value['price']*$value['cart_quantity'];}else{echo $totalByItem=$value['discount_price']*$value['cart_quantity'];}?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="routes.php?page=deleteItem&id=<?php echo $value['id_product'];?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					<?php 
					   $totalCartamount=$totalCartamount+$totalByItem;
	                  }
	                ?>
						<tr>
							<td style="color:green;" colspan="6"><div class="alert alert-success" role="alert" align="center" style="margin-top:30px;">TOTAL AMOUNT  : <b>$ <?php echo $totalCartamount;?></b> <span class="glyphicon glyphicon-eur"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php }else{
			?>
			        <div class="alert alert-danger" style="text-align:center;">
			 		<span style="color:red;"><?php echo"Cart is empty";?></span>
					</div>
			<?php 		
			      } 
			?>
		</div>
	</section> <!--/#cart_items-->
   
   <?php
	require_once '../partials/footer.php';
	require_once '../partials/js.php';
   ?>
</body>
</html>
<?php 
}else{
	header("Location:login.php");
}
?>