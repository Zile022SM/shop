<?php
require_once '../partials/header.php';
require_once '../partials/navigation.php';
$msgSuccess=isset($msgSuccess)?$msgSuccess:"";
$msgError=isset($msgError)?$msgError:"";
$errors=isset($errors)?$errors:array();

$name=isset($name)?$name:"";
$lastName=isset($lastName)?$lastName:"";
$email=isset($email)?$email:"";
$address=isset($address)?$address:"";
$phone=isset($phone)?$phone:"";
?>
        <?php if(!empty($msgError)){
	    ?>
	        <div class="container">
		        <div class="alert alert-danger" style="text-align:center;">
		 		<span style="color:red;"><?php echo $msgError;?></span>
				</div>
			</div>
		<?php
	    }
        ?>
        <?php if(!empty($msgSuccess)){
        ?>
	        <div class="container">
		        <div class="alert alert-success" style="text-align:center;">
		 		<span style="color:green;"><?php echo $msgSuccess;?></span>
				</div>
			</div>
	    <?php
	    }
        ?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="routes.php" method="post">
							<input type="text" name="email" placeholder="email" />
							<input type="password" name="password" placeholder="password" />

							<button type="submit" name="page" value="login" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="routes.php" method="post">
							<input type="text" name="name" value="<?php echo (!empty($name))?$name:""; ?>" placeholder="Name"/>
							<?php 
		                        if (isset($errors['name'])) {
		                            foreach($errors['name'] as $errorMessage) {
		                                ?>
		                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
		                                <?php
		                            }
		                        }
			                ?>
							<input type="text" name="last_name" value="<?php echo (!empty($lastName))?$lastName:""; ?>" placeholder="Last name"/>
							<?php 
		                        if (isset($errors['last_name'])) {
		                            foreach($errors['last_name'] as $errorMessage) {
		                                ?>
		                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
		                                <?php
		                            }
		                        }
			                ?>
			                <input type="text" name="address" value="<?php echo (!empty($address))?$address:""; ?>" placeholder="Address"/>
							<?php 
		                        if (isset($errors['address'])) {
		                            foreach($errors['address'] as $errorMessage) {
		                                ?>
		                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
		                                <?php
		                            }
		                        }
			                ?>
							<input type="text" name="email" value="<?php echo (!empty($email))?$email:""; ?>" placeholder="Email Address"/>
							<?php 
		                        if (isset($errors['email'])) {
		                            foreach($errors['email'] as $errorMessage) {
		                                ?>
		                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
		                                <?php
		                            }
		                        }
			                ?>
			                <input type="text" name="phone" value="<?php echo (!empty($phone))?$phone:""; ?>" placeholder="Phone"/>
							<?php 
		                        if (isset($errors['phone'])) {
		                            foreach($errors['phone'] as $errorMessage) {
		                                ?>
		                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
		                                <?php
		                            }
		                        }
			                ?>
							<input type="password" name="password" placeholder="Password"/>
							<?php 
		                        if (isset($errors['password'])) {
		                            foreach($errors['password'] as $errorMessage) {
		                                ?>
		                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
		                                <?php
		                            }
		                        }
			                ?>
			                <input type="password" name="repeat-password" placeholder="Repeat Password"/>
							<?php 
		                        if (isset($errors['repeat-password'])) {
		                            foreach($errors['repeat-password'] as $errorMessage) {
		                                ?>
		                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
		                                <?php
		                            }
		                        }
			                ?>
			                <br><br>
							<button type="submit" name="page" value="register" class="btn btn-default">Register</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
		<br>
		
	</section><!--/form-->
    
    
	<?php
	require_once '../partials/footer.php';
	require_once '../partials/js.php';
	?>

</body>
</html>