<?php
require 'admin/includePages/navigation.php';
?>

    <div id="wrapper">

<?php
require 'admin/includePages/sidebar.php';
$oneProduct=isset($oneProduct)?$oneProduct:"";
$errors=isset($errors)?$errors:array();
$msgError=isset($msgError)?$msgError:"";
$msgSuccess=isset($msgSuccess)?$msgSuccess:"";
//var_dump($users);
?>
      
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="routes.php?page=adminIndex">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Delete product</li>
          </ol>

          <!-- Page Content -->
          <h1>Delete product</h1>
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
        <br><br><br>
	 <div id="page-wrapper">
	        
	            <div class="container">
				  <div class="jumbotron">
				  <div class="offset-3">
					 <div class=”row”>
					  <h1>Do you really want to delete product?</h1>
					  <br>
					  <h1><?php echo $oneProduct['name'];?></h1>
					  <img class="img-thumbnail" style="width: 350px; height: auto;" src="../partials/images/products/<?php echo $oneProduct['img'];?>">
					 </div>
				  </div>
				  <br>
				  <div class="offset-3">
				  <form method="post" action="routes.php">
				      <input type="hidden" name="productId" value="<?php echo $oneProduct['id_product'];?>">
                      <input style="background: green;" class="btn btn-success" type="submit" name="page" value="Delete product">
                      <input type="hidden" name="productId" value="<?php echo $oneProduct['id_product'];?>">
                      <input style="background: red;" class="btn btn-danger" type="submit" name="page" value="Cancel deleting product">
                   </form>
                   </div>
				  </div>
				</div>
	       
	 </div>
        <!-- /#page-wrapper -->
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
              <span aria-hidden="true">Ã—</span>
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

