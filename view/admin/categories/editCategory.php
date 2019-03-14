<?php
require 'admin/includePages/navigation.php';
?>
    <div id="wrapper">
<?php
require 'admin/includePages/sidebar.php';
$category=isset($category)?$category:"";
$categoryName="";
$errors=isset($errors)?$errors:array();
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
            <li class="breadcrumb-item active">Edit category</li>
          </ol>

          <!-- Page Content -->
          <h1>Edit category</h1>
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
                <label><span style="color:red;"><b>*</b></span> <b>Category name: </b></label>
                <input class="form-control" type="text" name="category_name" value="<?php if (!empty($category['cat_name'])){echo $category['cat_name'];}else{ echo $categoryName;}?>" placeholder="Enter name">
                <span style="color:red;" class="label label-default"><b><?php if(array_key_exists('name', $errors))echo $errors['name']?></b></span>
              </div>

              <input class="form-control" type="hidden" name="categoryId" value="<?php if (!empty($category['id'])){echo $category['id'];}?>">
             <div class="submit">
              <input type="submit"  name="page" value="Edit category" class="btn btn-default">
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
    <script src="admin/partials/js/sb-admin.min.js"></script>
    <script type="text/javascript">
	    $(document).ready( function () {
	        $('#myTable').DataTable();
	    } );
    </script>
  </body>

</html>


