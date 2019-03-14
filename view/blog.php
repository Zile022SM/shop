<?php
 require_once '../partials/header.php';
 require_once '../partials/navigation.php';
 
 $blogList=isset($blogList)?$blogList:array();
 $totalNumberOfBlogPages=isset($totalNumberOfPages)?$totalNumberOfPages:"";
 $totalNumberOfBlogRows=isset($totalNumberOfRows)?$totalNumberOfRows:"";
 $numberOfBlogPages=isset($numberOfPages)?$numberOfPages:"";
 $pageBlog=isset($page)?$page:"";
?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<?php require_once '../partials/categories.php'; ?>
				</div>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						
						<?php foreach ($blogList as $oneBlog){?>
						<div class="single-blog-post">
							<h3><?php echo $oneBlog['title'];?></h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> <?php echo $oneBlog['user_name'];?></li>
									<li><i class="fa fa-clock-o"></i> <?php echo $oneBlog['time'];?></li>
									<li><i class="fa fa-calendar"></i> <?php echo $oneBlog['date'];?></li>
								</ul>
								
							</div>
							
							<p><?php echo  substr(wordwrap($oneBlog['blog_text'],80,"<br>\n",TRUE),0,250)?></p>
							<a  class="btn btn-primary" href="routes.php?page=showBlogDetail&blogId=<?php echo $oneBlog['id'];?>">Read More...</a>
						</div>
						<br><br>
						 
						<?php }
						if(!($numberOfBlogPages >= $totalNumberOfBlogRows)){ 
                        ?>
                        <div class="pagination-area">
	                        <ul class="pagination">
			                    <?php
			                        for ($i = 1; $i <= $totalNumberOfBlogPages; $i++) {
			                            if($i == $pageBlog){
			                                $classActive = "active";
			                            }else{
			                                $classActive = "";
			                            }
			                            ?>
			                                <li><a href="routes.php?page=showBlogList&pageNumber=<?php echo $i;?>" class="<?php echo $classActive; ?>"><?php echo $i; ?></a></li>
			                            <?php
			                        }
			                    ?>
			                </ul>
		                </div>
		                <?php
			            }	
			            ?>
			            
					</div>
				</div>
			</div>
		</div>
	</section>
   <?php
	require_once '../partials/footer.php';
	require_once '../partials/js.php';
   ?>
</body>
</html>