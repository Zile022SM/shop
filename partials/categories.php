<?php 
   require_once '../controller/noActionController.php';  
   $categories=isset($categories)?$categories:array();
   //var_dump($categories);
   
   $noviNiz = array();

	foreach($categories as $key => $item)
	{
	   $noviNiz[$item['cat_name']][$key]['sub_id']=$item['sub_id'];
	   $noviNiz[$item['cat_name']][$key]['sub_name']=$item['sub_name'];
	   $noviNiz[$item['cat_name']][$key]['total']=$item['total'];
	
	}

  krsort($noviNiz, SORT_NUMERIC);

//var_dump($noviNiz);

?>

<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						
						  <?php foreach ($noviNiz as $key=>$value) {
						  ?>	
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									    <?php $res = preg_replace("/[^a-zA-Z]/", "", $key);?>
										<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo strtolower($res);?>">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											<p style="color:orange;"><?php echo $key;?></p>
										</a>
									</h4>
								</div>
								<div id="<?php echo strtolower($res);?>" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
										<?php foreach ($value as $jedna) {
										?>
										<li><a style="a:hover{color:yellow;}" href="routes.php?page=productsBySubId&subId=<?php echo $jedna['sub_id'];?>"><h6><strong><?php echo $jedna['sub_name'];?>(<span style="color:red;"><?php echo $jedna['total'];?></span>)</strong></h6></a></li>
										<?php 
										}?>
										</ul>
									</div>
								</div>
							</div>
							<?php 
							}?>
						
						</div><!--/category-products-->
	
						<div class="shipping text-center"><!--shipping-->
							<img src="../partials/images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>