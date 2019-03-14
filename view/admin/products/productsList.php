<?php
require 'admin/includePages/navigation.php';
?>
    <div id="wrapper">

<?php
require 'admin/includePages/sidebar.php';

$products=isset($products)?$products:array();
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
            <li class="breadcrumb-item active">Products list</li>
          </ol>

          <!-- Page Content -->
          <h1>Products list</h1>
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
	      <div class="row">
                <div class="col-lg-10 offset-1">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Discount price</th>
                                        <th>Discount</th>
                                        <th>Type</th>
                                        <th>Edit Product</th>
                                        <th>Delete Product</th>
                                    </tr>
                                </thead>
                                <tbody>
	                                <?php
                                    $counter=0;
	                                foreach ($products as $value) { 
	                                $counter++;
	                                ?>
	                                    <tr class="odd gradeX" style="text-align:center;">
	                                        <td><?php echo $value['id_product'];?></td>
	                                        <td><img style="height:50px;" src="../partials/images/products/<?php echo (!empty($value['img']))?$value['img'] :'no-image-available.jpg';?>" alt="" /></td>
	                                        <td><?php echo $value['name'];
	                                         if ($counter<=6){
	                                         	echo "<span style='color:red;'><b> New</b></span>";
	                                         }
	                                        ?></td>
	                                        <td><?php echo $value['price'];?></td>
	                                        <td><?php echo $value['discount_price'];?></td>
	                                        <td><?php echo (isset($value['discount']))?$value['discount'].'%':"";?> </td>
	                                        <td><?php echo $value['type'];?></td>
	                                        <td  style="color:orange;"><a class="dropdown-item fas fa-edit" href="routes.php?page=ShowEditProduct&productId=<?php echo $value['id_product']; ?>" style="color:orange;"></a></td>
	                                        <td  style="color:red;"><a class="dropdown-item fas fa-trash-alt" href="routes.php?page=showDeleteProduct&productId=<?php echo $value['id_product']; ?>" style="color:red;"></td>
	                                    </tr>
	                                <?php
                                    }
                                    ?>
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
	 </div>
        <!-- /#page-wrapper -->
        </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

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

