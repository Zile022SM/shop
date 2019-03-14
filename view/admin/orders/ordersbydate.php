<?php
$pageUrl ='routes.php?page=ordersList';
$sec = "900";
?>
<!-- AUTOMATSKO REFRESOVANJE STRANICE -->
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $pageUrl;?>'">
<?php
require 'admin/includePages/navigation.php';
?>

<div id="wrapper">

<?php
require 'admin/includePages/sidebar.php';

$errors=isset($errors)?$errors:array();
$msgError=isset($msgError)?$msgError:"";
$msgSuccess=isset($msgSuccess)?$msgSuccess:"";

$ordersByDate=isset($ordersByDate)?$ordersByDate:array();
//var_dump($orders);
$ordersDate=isset($ordersDate)?$ordersDate:array();
//var_dump($ordersDate);
$numberOfPages=isset($numberOfPages)?$numberOfPages:"";
//var_dump($numberOfPages);
$totalNumberOfRows=isset($totalNumberOfRows)?$totalNumberOfRows:"";
//var_dump($totalNumberOfRows);
$totalNumberOfPages=isset($totalNumberOfPages)?$totalNumberOfPages:"";
//var_dump($totalNumberOfPages);
$page=isset($page)?$page:"";
//var_dump($page);
$date=isset($date)?$date:"";
//var_dump($date);

$newArray=array();
foreach ($ordersByDate as $value){
	$newArray[$value['orderId']]['orderId'] =$value['orderId'];
	$newArray[$value['orderId']]['user_id'] =$value['user_id'];
	$newArray[$value['orderId']]['user_name'] =$value['name'];
	$newArray[$value['orderId']]['last_name'] =$value['last_name'];
	$newArray[$value['orderId']]['address'] =$value['address'];
	$newArray[$value['orderId']]['email'] =$value['email'];
	$newArray[$value['orderId']]['phone'] =$value['phone'];
	$newArray[$value['orderId']]['time']=$value['time'];
	$newArray[$value['orderId']]['orderStatus']=$value['orderStatus'];
    $newArray[$value['orderId']]['orderItems'] =unserialize($value['orderItems']);
}

//var_dump($newArray);

?>
      
      <div id="content-wrapper">
        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="routes.php?page=adminIndex">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Orders by date</li>
          </ol>

          <!-- Page Content -->
          <h1>Orders by date  <span><a href="routes.php?page=ordersList" style="float:right;" class="btn btn-primary" role="button"><< back to orders list</a></span></h1>
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
				  	<div class="col-lg-10 offset-1">
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <?php 
                            	foreach ($newArray as $value){ 
                            ?>
                            <table width="100%" class="table  table-bordered table-hover" id="myTable" style="text-align:center; <?php echo ($value["orderStatus"]=="delivered")? "background-color:#a6a6a6;color:white":"";?>"> 
                                <thead>
                                   <br>
                                   <h1 class="offset-4">Order id: <?php echo $value["orderId"];?> <span <?php echo($value["orderStatus"]=="pending")? "class=blink":"";?> style="color:green"><b><?php echo($value["orderStatus"]=="pending")?"NEW!":"";?></b></span></h1>
                                   <br>
                                   <div class="mx-auto">
                                     <a class="btn btn-default btn btn-success fas fa-check" href="routes.php?page=updateOrder&orderId=<?php echo $value['orderId'];?>&numberOfPages=<?php echo $numberOfPages;?>&currentPage=<?php echo $page;?>&totalPages=<?php echo $totalNumberOfPages;?>&totalRows=<?php echo $totalNumberOfRows;?>"></a> <span> Check order as sent! </span>
                                     <a class="btn btn-default btn btn-danger fas fa-trash-alt" href="routes.php?page=deleteOrder&orderId=<?php echo $value['orderId'];?>&numberOfPages=<?php echo $numberOfPages;?>&currentPage=<?php echo $page;?>&totalPages=<?php echo $totalNumberOfPages;?>&totalRows=<?php echo $totalNumberOfRows;?>" style="float:right;"></a>
                                   </div>
                                    <tr><td colspan="6"><b>User :</b> <?php echo strtoupper($value['user_name'])." ".strtoupper($value['last_name'])."  <b>email : </b> ".strtoupper($value['email'])."   <b>address :</b> ".strtoupper($value['address'])."  <b>phone :</b> ".strtoupper($value['phone']);?> </td></tr>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price/Discount</th>
                                        <th>Quantity</th>
                                        <th>Total by item</th>
                                    </tr>
                                </thead>
                                <?php
                                $total=0;
		                         foreach ($value['orderItems'] as $one){
		                        ?>   
                                <tbody>
                                    <tr class="odd gradeX" style="text-align:center;">
                                        <td><img style="height:50px;" src="../partials/images/products/<?php echo (!empty($one['image']))?$one['image'] :'no-image-available.jpg';?>" alt="" /></td>
                                        <td><?php echo $one['name'];?></td>
                                        <td><?php echo (!empty($one['discount']))?"disc price ".$one['price']." / ".$one['discount']." %":$one['price'];?></td>
                                        <td><?php echo $one['quantity'];?></td>
                                        <td><?php  echo $one['totalByItem'];?> $</td>
                                    </tr>
                                </tbody>
	                            <?php
	                               $total+=$one['totalByItem'];
	                             }
	                            ?> 
	                            <tr style="text-align:center; <?php echo($value['orderStatus']=="delivered")?"color:white":"color:black;";?>">
	                            <td colspan="2">ORDER STATUS : <b><?php echo strtoupper($value['orderStatus']);?></b></td>
	                            <td colspan="1"> <i class="fas fa-calendar-alt" style="color:green;"></i>&nbsp; <b style="<?php echo($one['status']=="delivered")?"color:white":"color:green;";?>"> <?php echo $value['time'];?></b></td>
	                            <td colspan="2">TOTAL PRICE : <b style="<?php echo($value['orderStatus']=="delivered")?"color:white":"color:green;";?>"><?php echo $total;?> $</b></td>
	                            </tr>
                            </table>
                            <?php 
	                            }
                            ?>
                            <br>
                            <?php  
                            if(!($numberOfPages >= $totalNumberOfRows)){
                            ?>
			                   <ul class="pagination">
					                    <?php
					                        for ($i = 1; $i <= $totalNumberOfPages; $i++) {
					                            if($i == $page){
					                                $classActive = "page-item active";
					                            }else{
					                                $classActive = "page-item";
					                            }
					                            ?>
					                                <li class="<?php echo $classActive; ?>"><a href="routes.php?page=ordersByDate&date=<?php echo $date;?>&currentPage=<?php echo $i; ?>" class="page-link"> <?php echo $i; ?> <span class="sr-only">(current)</span></a></li>
					                            <?php
					                        }
					                    ?>
					             </ul>
		                	<?php
			                }
			                ?>
			                
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
    
  </body>
  <style type "text/css">
<!--
/* @group Blink */
.blink {
	-webkit-animation: blink .75s linear infinite;
	-moz-animation: blink .75s linear infinite;
	-ms-animation: blink .75s linear infinite;
	-o-animation: blink .75s linear infinite;
	 animation: blink .75s linear infinite;
}
@-webkit-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-moz-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-ms-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-o-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
/* @end */
-->
</style>
</html>
