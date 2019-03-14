<?php
require 'admin/includePages/navigation.php';
?>

<div id="wrapper">

<?php
require 'admin/includePages/sidebar.php';
$reviewsList=isset($reviewsList)?$reviewsList:"";
//var_dump($reviewsList);
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
            <li class="breadcrumb-item active">Reviews list</li>
          </ol>

          <!-- Page Content -->
          <h1>Reviews list</h1>
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
<!-- /.row -->
            <div class="row">
                <div class="col-lg-10 offset-1">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Product id</th>
                                        <th>Product image</th>
                                        <th>Product title</th>
                                        <th>User</th>
                                        <th>Comment</th>
                                        <th>Time/Date</th>
                                        <th>Status</th>
                                        <th>Approve review</th>
                                        <th>Delete review</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
	                                <?php foreach ($reviewsList as $value) { ?>
	                                	
	                                
	                                    <tr class="odd gradeX" style="text-align:center;">
	                                        <td><?php echo $value['product_id'];?></td>
	                                        <td><img style="height:50px;" src="../partials/images/products/<?php echo (!empty($value['img']))?$value['img'] :'no-image-available.jpg';?>" alt="" /></td>
	                                        <td><?php echo $value['name'];?></td>
	                                        <td><?php echo $value['user_name'];?></td>
	                                        <td><?php echo wordwrap($value['comment'],15,"<br>\n",TRUE);?></td>
	                                        <td><?php echo $value['time']." / ".$value['date'];?></td>
	                                        <td <?php echo ($value['status']=='approved')?"style='color:green'":"";?>><b><?php echo $value['status'];?></b></td>
	                                        <td  style="color:orange;">
	                                        <?php if ($value['status']=='not approved'){ ?> 
	                                        <a class="dropdown-item fas fa-check-circle" href="routes.php?page=approveReview&reviewId=<?php echo $value['review_id']; ?>&productId=<?php echo $value['product_id']; ?>" style="color:orange;"></a>
	                                        </td>
	                                        <?php }?>
	                                        <td  style="color:red;"><a class="dropdown-item fas fa-trash-alt" href="routes.php?page=deleteReview&reviewId=<?php echo $value['review_id']; ?>" style="color:red;"></td>
	                                    </tr>
	                                 <?php }?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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