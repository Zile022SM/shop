<?php
require 'admin/includePages/navigation.php';
?>
<div id="wrapper">

<?php
require 'admin/includePages/sidebar.php';

$name=isset($name)?$name:"";
$price=isset($price)?$price:"";
$disc=isset($discount)?$discount:"";
$typeOfProduct=isset($type)?$type:"";
$subcategoryId=isset($subcategoryId)?$subcategoryId:"";
$subcategories=isset($subcategories)?$subcategories:array();
$errors=isset($errors)?$errors:array();
$msgError=isset($msgError)?$msgError:"";
$msgSuccess=isset($msgSuccess)?$msgSuccess:"";
?>
      
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="routes.php?page=adminIndex">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Insert product</li>
          </ol>
          <!-- Page Content -->
          <h1>Insert product</h1>
          <hr>
          <?php if(!empty($msgError)){
	      ?>
	        <div class="container">
		        <div class="alert alert-danger" style="text-align:center;">
		 		<span style="color:red;"><b><?php echo $msgError;?></b></span>
				</div>
			</div>
		  <?php
	           }
          ?>
          <?php if(!empty($msgSuccess)){
	      ?>
	        <div class="container">
		        <div class="alert alert-success" style="text-align:center;">
		 		<span style="color:green;"><b><?php echo $msgSuccess;?></b></span>
				</div>
			</div>
		  <?php
	           }
          ?>
         <div class="row">
          <div class="col-lg-6 offset-3">
            <form role="form" action="routes.php" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Name: </b></label>
                <input class="form-control" type="text" name="name" value="<?php if (!empty($name)){echo $name;}?>" placeholder="Enter name">
                <?php 
                        if (isset($errors['name'])) {
                            foreach($errors['name'] as $errorMessage) {
                                ?>
                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
                                <?php
                            }
                        }
                ?>
              </div>

              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Price: </b></label>
                <input class="form-control" type="text" name="price" value="<?php if (!empty($price)){echo $price;}?>" placeholder="Enter price">
                <?php 
                        if (isset($errors['price'])) {
                            foreach($errors['price'] as $errorMessage) {
                                ?>
                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
                                <?php
                            }
                        }
                ?>
              </div>

              <div class="form-group">
                <label> <b>Discount % : </b></label>
                <select class="form-control" name="discount" style="text-align:center;">
                  <option value="">--choose discount %--</option>
                  <?php 
                  $discount= array(10,30,50);
					foreach ($discount as $value){
				  ?>
				  <option value="<?php echo $value;?>"<?php echo isset($disc) && $disc==$value ? " selected=\"\"" : "";?>><?php  echo $value; ?></option>
				  <?php 
				 	}
				  ?>
                </select>
                <?php 
                        if (isset($errors['discount'])) {
                            foreach($errors['discount'] as $errorMessage) {
                                ?>
                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
                                <?php
                            }
                        }
                ?>
              </div>
              
              <div class="form-group">
                <label><b>Product image:</b></label>
                <input class="form-control" type="file" name="image" style="border: none;">
                <?php 
                        if (isset($errors['image'])) {
                            foreach($errors['image'] as $errorMessage) {
                                ?>
                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
                                <?php
                            }
                        }
                ?>
              </div>
              <br>
              <div class="form-group">
                <label> <b>Description: </b></label>
                <textarea class="form-control" name="description"><?php echo isset($formData["description"]) ? htmlspecialchars($formData["description"]) : "";?></textarea>
                <span style="color:red;" class="label label-default"><b><?php if(array_key_exists('description', $errors))echo $errors['description']?></b></span>
              </div>
              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Type: </b></label>
                <select class="form-control" name="type" style="text-align:center;">
                  <option value="">--choose type--</option>
                  <?php 
                  $type= array("shoes","t-shirt","cap","sweatsuit");
				  foreach ($type as $value){
				  ?>
				  <option value="<?php echo $value;?>"<?php echo isset($typeOfProduct) && $typeOfProduct==$value ? " selected=\"\"" : "";?>><?php  echo $value; ?></option>
				  <?php 
				 	}
				  ?>
                </select>
                <?php 
                        if (isset($errors['type'])) {
                            foreach($errors['type'] as $errorMessage) {
                                ?>
                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
                                <?php
                            }
                        }
                ?>
              </div>
              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Category/ Subcategory : </b></label>
                <select class="form-control" name="subcategoryId" style="text-align:center;">
                  <option value="">--choose subcategory--</option>
                  <?php 
					foreach ($subcategories as $value){
				  ?>
				  <option value="<?php echo $value['sub_id'];?>"<?php echo isset($subcategoryId) && $subcategoryId==$value['sub_id'] ? " selected=\"\"" : "";?>><?php  echo $value['cat_name']."/ ".$value['sub_name']; ?></option>
				  <?php 
				 	}
				  ?>
                </select>
                <?php 
                        if (isset($errors['subcategoryId'])) {
                            foreach($errors['subcategoryId'] as $errorMessage) {
                                ?>
                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
                                <?php
                            }
                        }
                ?>
              </div>
             <div class="submit">
              <input type="submit"  name="page" value="Insert Product" class="btn btn-default">
             </div>
            </form>

          </div>
         
        </div>
         <br><br><br><br><br><br><br><br><br>
        <!-- /.container-fluid -->

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

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

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin.min.js"></script>

  </body>

</html>


