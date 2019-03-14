<?php 
$login=isset($login)?$login:"";
//var_dump($login);
$cart=isset($cart)?$cart:array();
//var_dump($cart);
?>
<style media="screen" type="text/css">

    ul.dropdown-cart{
    min-width:280px;
    text-align:center;
}
ul.dropdown-cart li .item{
    display:block;
    padding:3px 10px;
    margin: 3px 0;
    text-alig:center;
}
ul.dropdown-cart li .item:hover{
    background-color:#f3f3f3;
}
ul.dropdown-cart li .item:after{
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

ul.dropdown-cart li .item-left{
    float:left;
}
ul.dropdown-cart li .item-left img,
ul.dropdown-cart li .item-left span.item-info{
    float:left;
    
}
ul.dropdown-cart li .item-left img{
 width:50px;
 height:50px;
}
ul.dropdown-cart li .item-left span.item-info{
}
ul.dropdown-cart li .item-left span.item-info span{
    display:block;
}
ul.dropdown-cart li .item-right{
    float:right;
    margin-left:25px;
}
ul.dropdown-cart li .item-right button{
     margin-left:25px;
}
</style>


<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="../partials/images/home/logo.png" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							
							<ul class="nav navbar-nav navbar-right">
							<li class="dropdown"><a href="#"><i class="fa fa-user"></i><?php if (!empty($login)){echo $login['email'];}?></a>
					        <li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> <?php if(empty($_SESSION['cart'])){
					          	echo $kolicina=0;
					          }else{
					            $numberItem=0;
					            foreach ($cart as $pom){
									
                                  $numberItem=$numberItem+$pom['cart_quantity'];
                                }
                                echo $numberItem;
                              }
                              
					          ?> - Items<span class="caret"></span></a>
					          <ul class="dropdown-menu dropdown-cart" role="menu">
					          <?php 
					          if(empty($cart)){
					             echo "<br><br><br><p style=color:red;><b>Cart is empty please add items</b></p>";
					          }else{
					           $totalCartamount=0;
					           foreach ($cart as $one){?>
					              <li>
					                  <span class="item">
					                    <span class="item-left">
					                        <img src="../partials/images/products/<?php echo (!empty($one['img']))?$one['img'] :'no-image-available.jpg';?>" alt="" />
					                        <span class="item-info">
					                            <span><?php echo $one['name'];?></span>
					                            <span> quantity <b style="color:red;"><?php echo $one['cart_quantity'];?></b></span>
					                            <span> price: <b style="color:red;"><?php if (!isset($one['discount_price'])|| $one['discount_price']==0){echo $one['price'];}else{echo $one['discount_price'];}?></b> $</span>
					                            <span> total price: <b style="color:red;"><?php if (!isset($one['discount_price'])|| $one['discount_price']==0){echo $totalByItem=$one['price']*$one['cart_quantity'];}else{echo $totalByItem=$one['discount_price']*$one['cart_quantity'];}?></b> $</span>
					                        </span>
					                    </span>
					                    
					                </span>
					              </li>
					            <?php 
					             $totalCartamount=$totalCartamount+$totalByItem;
					             }
					            }
					            ?> 
					             <br><br> 
					             <li>
					             <?php 
					                if(!empty($totalCartamount)){
					             ?>
                                      <p>Total cart amount: <b style="color:red;"><b>$ <?php echo $totalCartamount;?></b></b></p>
                                 <?php 
					                }					             
					             ?>
					              	
					             </li>
					         
					              <br><br>
					              <?php 
					              if(!empty($cart)){
					              ?> 
					              <li><a class="text-center btn btn-xs btn-warning" style="background-color:orange; color:white;height:30px;width:100px;text-align:center;padding-top:5px;" href="routes.php?page=ViewCart">View Cart</a></li>
					              <?php 
					              }else{
					              ?> 
					              <li><a class="text-center btn btn-xs btn-warning" style="background-color:orange; color:white;height:30px;width:100px;text-align:center;padding-top:5px;" href="#">View Cart</a></li>
					              <?php 
					              }
					              ?>
					              
					              <br><br>
					          </ul>
					        </li>
					        <?php 
					          if (!empty($login)){   
					        ?> 
					          <li><a href="routes.php?page=logout"><i class="icon-off"></i> Logout</a></li>
					        <?php 	
					          }else{
					        ?> 
					          <li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
					        <?php 
					          }
					        ?>
					      </ul>
					      
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="routes.php?page=ContinueShopping" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="routes.php?page=Products">Products</a></li>
										<?php if (!empty($_SESSION['cart'])){
										?> 
										<li><a href="routes.php?page=ViewCart">Cart</a></li>
										<?php 
										}else{
										?> 
										<li><a href="#">Cart</a></li>
										<?php 
										}?> 
										
										<li><a href="login.php">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="routes.php?page=showBlogList">Blog List</a></li>
                                    </ul>
                                </li> 
								<li><a href="routes.php?page=showContact">Contact</a></li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->