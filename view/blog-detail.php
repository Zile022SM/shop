<?php
require_once '../partials/header.php';
require_once '../partials/navigation.php';

$blogDetail=isset($blogDetail)?$blogDetail:array();
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
						<div class="single-blog-post">
							<h3><?php echo $blogDetail['title'];?></h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> <?php echo $blogDetail['user_name'];?></li>
									<li><i class="fa fa-clock-o"></i> <?php echo $blogDetail['time'];?></li>
									<li><i class="fa fa-calendar"></i> <?php echo $blogDetail['date'];?></li>
								</ul>
							</div>
							<p>
								<?php echo wordwrap($blogDetail['blog_text'],100,"<br>\n",TRUE);?>
							</p>
							<br>
							<br>
							<img class="img-responsive" src="../partials/images/blog/<?php echo (!empty($blogDetail['image']))?$blogDetail['image'] :'no-image-available.jpg';?>" style="margin:0 auto;border-radius:50px;width:600px;height:400px;">
				            <br>
				            <br>
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