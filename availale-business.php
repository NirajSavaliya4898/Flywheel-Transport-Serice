<?php
	require "config.php";
	$obj=new config();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/top-author.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:03:50 GMT -->
<head>
	<?php
		require "header.php";
	?>
    
	</head>
	<body class="home-2">
		<div class="wrapper">  
			<!-- Start Navigation -->
			<!-- Start Navigation -->
			<?php
				require "navigation.php";
			?>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			
			<!-- ================ Start Page Title ======================= -->
			<section class="title-transparent page-title" style="background:url(assets/img/title-bg.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>AVAILALE BUSINESS</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Availale Business</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ================ End Page Title ======================= -->
			
			<!-- ================ Start Category Style 1 ======================= -->
			<section>
				<div class="container">
				

					<?php
								$Data=$obj->myQuery("SELECT * FROM `tbl_business` WHERE `category_id` like '%".$_GET['id']."%'");
								while ($lstbusiness=$Data->fetch_assoc()) 
								{
									?>
										<div class="col-md-4 col-sm-6">
									<div class="listing-shot grid-style">
									<a href="#">
										<div class="listing-shot-img">
											<img src="<?php echo $obj->WebPath.$lstbusiness['logo']; ?>" class="img-responsive" alt="">
										</div>
										<div class="listing-shot-caption">
											<h4><?php echo $lstbusiness['name']; ?></h4>
											<span><i class="fa fa-map-marker" aria-hidden="true"></i>   <?php echo $lstbusiness["address"]; ?></span>
											<span class="like-listing style-2"></span>
										</div>
									</a>
									<div class="listing-shot-info">
										<div class="row extra">
											<div class="col-md-12">
												<div class="listing-detail-info">
													<span><i class="ti-mobile preview-icon call" aria-hidden="true"></i><?php echo $lstbusiness["contactno"]; ?></span>
													<span><i class="ti-email preview-icon email" aria-hidden="true"></i><?php echo $lstbusiness["email_id"]; ?></span>
												</div>
											</div>
										</div>
									</div>
									<div class="listing-shot-info rating">
										<div class="row extra">
											<div class="col-md-5 col-sm-5 col-xs-6 pull-right">
												<a href="order.php?cat_id=<?php echo $lstbusiness["category_id"]; ?>&b_id=<?php echo $lstbusiness["business_id"]; ?>" class="detail-link">Order Now</a>
											</div>
										</div>
									</div>
						</div>
					</div>
									<?php	
								}
							?>
					<!-- Single top author -->
				</div>
			</section>
			<!-- ================ End Top Author ======================= -->
			<!-- ================ Start Footer ======================= -->
			<?php
				require "footer.php";
			?>
			<!-- ================== Login & Sign Up Window ================== -->
			 
			<!-- ===================== End Login & Sign Up Window =========================== -->
			<!-- Switcher -->
			
			
			<!-- /Switcher -->
			<a id="back2Top" class="theme-bg" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>

			
			<!-- START JAVASCRIPT -->
			<?php
				require "script.php";
			?>
			<script type="text/javascript">
				$(".tab.style-1 li:nth-child(1)").addClass("active");
				$(".tab-content.tabs .tab-pane:nth-child(1)").addClass("active");
			</script>
			
		</div>
	</body>

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/top-author.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:03:50 GMT -->
</html>