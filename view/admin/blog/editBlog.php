<script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
<?php
require 'admin/includePages/navigation.php';
?>
<div id="wrapper">

<?php
require 'admin/includePages/sidebar.php';

$oneBlog=isset($oneBlog)?$oneBlog:"";

$name=isset($name)?$name:"";
$title=isset($title)?$title:"";
$blogContent=isset($blogContent)?$blogContent:"";
$image=isset($image)?$image:"";

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
            <li class="breadcrumb-item active">Edit blog</li>
          </ol>
          <!-- Page Content -->
          <h1>Edit blog</h1>
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
                <label><span style="color:red;"><b>*</b></span> <b>User name: </b></label>
                <input class="form-control" type="text" name="name" value="<?php if (!empty($oneBlog['user_name'])){echo $oneBlog['user_name'];}else{echo $name;}?>" placeholder="Enter name">
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
                <label><span style="color:red;"><b>*</b></span> <b>Title: </b></label>
                <input class="form-control" type="text" name="title" value="<?php if (!empty($oneBlog['title'])){echo $oneBlog['title'];}else{echo $title;}?>" placeholder="Enter title">
                <?php 
                        if (isset($errors['title'])) {
                            foreach($errors['title'] as $errorMessage) {
                                ?>
                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
                                <?php
                            }
                        }
                ?>
              </div> 
              <div class="form-group">
                <label><span style="color:red;"><b>*</b></span> <b>Description: </b></label>
                <textarea class="form-control" id="editor1" name="text"><?php echo isset($oneBlog['blog_text']) ? htmlspecialchars($oneBlog['blog_text']) : "$blogContent";?></textarea>
                <?php 
                        if (isset($errors['text'])) {
                            foreach($errors['text'] as $errorMessage) {
                                ?>
                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
                                <?php
                            }
                        }
                ?>
              </div>
              <br>
              <div class="form-group">
                <?php
                        if(isset($oneBlog['image']) && !empty($oneBlog['image'])){
                            ?>
                                <label>Current blog image</label><br>
                                <img style="width: 200px; height: auto;" src="../partials/images/blog/<?php echo $oneBlog['image'];?>">
                            <?php
                        }
                ?>
                    <br>
                <label><b>Blog image:</b></label>
                <input class="form-control" type="file" name="image" style="border: none;">
                <input class="form-control" type="hidden" name="blogImage" value="<?php if (!empty($oneBlog['image'])){ echo $oneBlog['image'];}?>">
                <input class="form-control" type="hidden" name="blogId" value="<?php if (!empty($oneBlog['id'])){ echo $oneBlog['id'];}?>">
                
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
              <br>
              <div class="submit">
              <input type="submit"  name="page" value="Edit blog" class="btn btn-default">
              </div>
            </form>
            <script>
			CKEDITOR.replace( 'editor1' );
		    </script>
          </div>
        </div>
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



