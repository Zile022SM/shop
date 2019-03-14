<?php
require_once '../partials/header.php';
require_once '../partials/navigation.php';
$msg=isset($msg)?$msg:"";
//var_dump($msg);
$login=isset($login)?$login:"";
//var_dump($login);
$msgSuccess=isset($msgSuccess)?$msgSuccess:"";
$msgError=isset($msgError)?$msgError:"";
?>
	 
	 <div id="contact-page" class="container">
	 
	            <?php   	
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
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
					<div id="gmap" class="contact-map">
					</div>
				</div>
			</div>  
			
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" action="routes.php" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" value="" class="form-control"  placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" value="" class="form-control"  placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control"  placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message"  class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="page" value="Send email" class="btn btn-primary pull-right">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>E-Shopper Inc.</p>
							<p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
							<p>Newyork USA</p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Fax: 1-714-252-0026</p>
							<p>Email: info@e-shopper.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	
   <?php
	require_once '../partials/footer.php';
	require_once '../partials/js.php';
   ?>
</body>
</html>