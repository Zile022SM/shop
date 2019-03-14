<?php

if(!isset($_SESSION['loggedIn'])){
	session_start();
}
$login=unserialize($_SESSION['loggedIn']);
  
$loginUser=isset($loginUser)?$loginUser:"";
//var_dump($loginUser);
if ($login){


	$cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
	
	$name=isset($loginUser['name'])?$loginUser['name']:"$postUsername";
	$last_name=isset($loginUser['last_name'])?$loginUser['last_name']:"$postLastname";
	$address=isset($loginUser['address'])?$loginUser['address']:"$postAddress";
	$email=isset($loginUser['email'])?$loginUser['email']:"$postEmail";
	$phone=isset($loginUser['phone'])?$loginUser['phone']:"$postPhone";
	
	$errors=isset($errors)?$errors:array();
	
?>	
<html>
	<body>
          
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <h1 style="color:#FF8C00;">Checkout page</h1>
                    </div>
                </div>
                <?php if(!empty($msgError)){ ?>
			        <div class="container">
				        <div class="alert alert-danger" style="text-align:center;">
				 		<span style="color:red;"><b><?php echo $msgError;?></b></span>
						</div>
					</div>
			    <?php
		           }
		        ?>
                <br>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>    
            <div class="row cart-body">
                <div class="form-horizontal">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    
                    <div class="panel panel-info">
                        <div class="panel-heading" style="background-color:#FF8C00;color:white;">
                            Order list <div class="pull-right"><small><a class="btn" href="routes.php?page=backToCart" style="width:150px;height:30px;margin-top:-5px;margin-right:-7px;background-color:#FFD700;"> << Back to cart</a></small></div>
                        </div>
                        <div class="panel-body">
                        
                            <?php 
                        	$totalCartamount=0;
                        	foreach ($cart as $k) {
                        	?>
                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" src="../partials/images/products/<?php echo (!empty($k['img']))?$k['img'] :'no-image-available.jpg';?>">
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12"><h4><?php echo $k['name'];?></h4></div>
                                    <div class="col-xs-12"><h5>Price : <strong><span style="color:#FF8C00;"><?php if(!empty($k['discount_price'])){echo $k['discount_price'];}else{echo $k['price'];}?></span></strong></h5></div>
                                    <div class="col-xs-12"><h5>Quantity :<strong><span style="color:#FF8C00;"> <?php  echo $k['cart_quantity'];?>
												    </span></strong></h5></div>
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h5><span>Total: </span><strong><span style="color:#FF8C00;"><?php  
                                    if (!isset($k['discount_price']) || $k['discount_price']==0){echo $ukupno=$k['price']*$k['cart_quantity'];}else{echo $ukupno=$k['discount_price']*$k['cart_quantity'];}
                                    ?></span></strong>
                                    </h5>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <?php
                           		//$ukupno=$k['discount_price']*$k['cart_quantity'];
  								$totalCartamount=$totalCartamount+$ukupno;
                        	}?>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong style="color:#FF8C00;">Total cart amount: </strong>
                                    <div class="pull-right"><span style="color:#FF8C00;"> <strong><?php echo $totalCartamount;?></strong></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                </div>
                <!-- OVDE JE BIO POCETAK FORME -->
                <form class="form-horizontal" method="post" action="routes.php">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading" style="background-color:#FF8C00;color:white;">Shipping address</div>
                        <div class="panel-body">
                            
                            
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12">
                                    <strong style="color:#FF8C00;">Name:</strong>
                                    <input type="text" name="name" class="form-control" value="<?php echo $name;?>" />
                                    <?php 
				                        if (!empty($errors['name'])) {
				                            foreach($errors['name'] as $errorMessage) {
				                                ?>
				                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
				                                <?php
				                            }
				                        }
					                ?>
                                </div>
                                <br>
                                <br>
                                <div class="col-md-12 col-xs-12">
                                    <strong style="color:#FF8C00;">Last name:</strong>
                                     <br>
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $last_name;?>" />
                                    <?php 
				                        if (!empty($errors['last_name'])) {
				                            foreach($errors['last_name'] as $errorMessage) {
				                                ?>
				                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
				                                <?php
				                            }
				                        }
					                ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                <strong style="color:#FF8C00;">Address:</strong>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="<?php echo $address;?>" placeholder="fill in address"/>
                                    <?php 
				                        if (!empty($errors['address'])) {
				                            foreach($errors['address'] as $errorMessage) {
				                                ?>
				                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
				                                <?php
				                            }
				                        }
					                ?>
                                </div>
                            </div>
							<div class="form-group">
                                <div class="col-md-12">
                                <strong style="color:#FF8C00;">Email :</strong>
                                </div>
                                <div class="col-md-12">
                                <input type="text" name="email" class="form-control" value="<?php echo $email;?>" />
                                <?php 
			                        if (!empty($errors['email'])) {
			                            foreach($errors['email'] as $errorMessage) {
			                                ?>
			                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
			                                <?php
			                            }
			                        }
					            ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                <strong style="color:#FF8C00;">Phone:</strong>
                                </div>
                                <div class="col-md-12">
                                <input type="text" name="phone" class="form-control" value="<?php echo $phone;?>" placeholder="fill in phone" />
                                <?php 
			                        if (!empty($errors['phone'])) {
			                            foreach($errors['phone'] as $errorMessage) {
			                                ?>
			                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
			                                <?php
			                            }
			                        }
					            ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <input class="btn btn-warning" type="submit" name="page" value="Buy" style="margin-bottom:50px;margin-top:15px;height:35px;width:137px;">
                </div>
     
                </form>
                </div>
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>
	</body>
</html>	

<?php 
	
}else{
	header("Location:login.php");
}

?>
