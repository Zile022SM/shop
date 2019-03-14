<?php
require 'admin/includePages/navigation.php';
?>
    <div id="wrapper">
<?php
require 'admin/includePages/sidebar.php';
$user=isset($user)?$user:"";
$errors=isset($errors)?$errors:array();
$name=isset($name)?$name:"";
$lastName=isset($lastName)?$lastName:"";
$email=isset($email)?$email:"";
$password=isset($password)?$password:"";
$role=isset($role)?$role:"";

$msgSuccess=isset($msgSuccess)?$msgSuccess:"";
$msgError=isset($msgError)?$msgError:"";
?>
      
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="routes.php?page=adminIndex">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Edit user</li>
          </ol>

          <!-- Page Content -->
          <h1>Edit user</h1>
          <hr>
        </div>
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
        <!-- /.container-fluid -->
        <div class="row">
          <div class="col-lg-6 offset-3">

            <form role="form" action="routes.php" method="post">

              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Name: </b></label>
                <input class="form-control" type="text" name="name" value="<?php if (empty($user['name'])){echo $name;}else{echo $user['name'];}?>" placeholder="Enter name">
                <span style="color:red;" class="label label-default"><b><?php if(array_key_exists('name', $errors))echo $errors['name']?></b></span>
              </div>

              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Last name: </b></label>
                <input class="form-control" type="text" name="last_name" value="<?php if (empty($user['last_name'])){echo $lastName;}else{echo $user['last_name'];}?>" placeholder="Enter last name">
                <span style="color:red;" class="label label-default"><b><?php if(array_key_exists('last_name', $errors))echo $errors['last_name']?></b></span>
              </div>

              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Email: </b></label>
                <input class="form-control" type="email" name="email" value="<?php if (empty($user['email'])){echo $email;}else{echo $user['email'];}?>" placeholder="Enter email">
                <span style="color:red;" class="label label-default"><b><?php if(array_key_exists('email', $errors))echo $errors['email']?></b></span>
              </div>
              
              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Password: </b></label>
                <input class="form-control" type="password" name="password" value="<?php if (empty($user['password'])){echo $password;}else{echo $user['password'];}?>" placeholder="Enter password">
                <span style="color:red;" class="label label-default"><b><?php if(array_key_exists('password', $errors))echo $errors['password']?></b></span>
              </div>
              
              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Change role: </b></label>
                <select class="form-control" name="Role" style="text-align:center;">
                  <option value="">--choose role--</option>
                  <?php 
                    $fieldNamePossibleValues = array("key1" => "Admin", "key2" => "Moderator");
					foreach ($fieldNamePossibleValues as $key =>$value){
				  ?>
				  <option value="<?php echo $value; ?>"<?php echo isset($user['role']) && $user['role'] == $value ? " selected=\"\"" : "";?>"><?php  echo $value; ?></option>
				  <?php 
				 	}
				  ?>
                </select>
                <span style="color:red;" class="label label-default"><b><?php if(array_key_exists('Role', $errors))echo $errors['Role']?></b></span>
              </div>
              <input class="form-control" type="hidden" name="userId" value="<?php if (!empty($user['admin_id'])){echo $user['admin_id'];}?>" placeholder="Enter password">
             <div class="submit">
              <input type="submit"  name="page" value="Edit user" class="btn btn-default">
             </div>
            </form>

          </div>
         
        </div>
         <br><br><br><br><br><br><br><br><br>
        <br><br><br>
       </div>
       
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin.min.js"></script>
    <script type="text/javascript">
	    $(document).ready( function () {
	        $('#myTable').DataTable();
	    } );
    </script>
  </body>

</html>

