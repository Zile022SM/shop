<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link href="admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    
    <div id="wrapper">
<?php

$email=isset($email)?$email:"";

$msgSuccess=isset($msgSuccess)?$msgSuccess:"";
$msgError=isset($msgError)?$msgError:"";
?>
      
      <div id="content-wrapper">

        <div class="container-fluid">

         
        <?php if(!empty($msgSuccess)){ ?>
	        <div class="container">
		        <div class="alert alert-success" style="text-align:center;">
		 		<span style="color:green;"><b><?php echo $msgSuccess;?></b></span>
				</div>
			</div>
	    <?php
           }
        ?>
        <?php if(!empty($msgError)){ ?>
	        <div class="container">
		        <div class="alert alert-danger" style="text-align:center;">
		 		<span style="color:red;"><b><?php echo $msgError;?></b></span>
				</div>
			</div>
	    <?php
           }
        ?>
        <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form role="form" action="routes.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                  
                <input type="text" id="inputEmail" class="form-control" name="email" value="<?php if (!empty($email)){echo $email;}?>" placeholder="Enter email" required="required" autofocus="autofocus">
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" value="<?php if (!empty($password)){echo $password;}?>" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            
             <div class="submit">
              <input type="submit"  name="page" value="Login admin" class="btn btn-info">
             </div>
            </form>
          
        </div>
      </div>

      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
  </body>

</html>
