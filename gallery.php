<?php
    require "Config.php";
    $obj=new Config();
    	if(isset($_GET["Did"])){
    	$wh["gallery_id"]=$_GET["Did"];
    	$obj->myDelete("tbl_gallery",$wh);
    	$obj->Redirect("gallery.php");
	}
  ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/grid-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:01:36 GMT -->
<head>
	<?php
		require "header.php";
	?>
	</head>
	<body class="home-2">
		<div class="wrapper">  
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
						<h1>Gallery</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<a href="business-mydashboard.php">MyDeshboard</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Gallery</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ================ End Page Title ======================= -->
			
			<!-- ================ Listing In Grid Style ======================= -->
			<section class="padd-top-0 padd-bot-0 overlap">
				<div class="container">
					<div class="row">
						
					</div>
				</div>
			</section>
			
			<!-- ================ Listing In Grid Style ======================= -->
			<section class="padd-top-20">
				<div class="container">
					<div class="row">
						<!-- Start Sidebar -->
						<div class="col-md-4 col-sm-12">
							<?php
							  require "sidebar.php";
							?>
						</div>
						<!-- End Start Sidebar -->
						
						<!-- Start All Listing -->
						<div class="col-md-8 col-sm-12">
							<!-- Filter option -->
							<div class="row mrg-0 mrg-bot-20">
								<div class="col-md-6">
									<h5>Gallery</h5>
								</div>
								<div class="col-md-6">
									<div class="layout-option pull-right">
									<a href="addgallery.php" class="btn btn-black">Add Gallery</a>
										
									</div>
								</div>
							</div>
							<!-- End Filter option -->
							
							<div class="row mrg-0">
							<?php
								$Data=$obj->myQuery("SELECT * FROM `tbl_gallery` WHERE `business_id`='".$obj->Businessid($obj->UserKey)."'");
								while ($lstgallery=$Data->fetch_assoc()) 
								{
									?>
										<div class="col-md-6 col-sm-6">
									<div class="listing-shot grid-style">
										<a href="addgallery.php?Eid=<?php echo $lstgallery['gallery_id']; ?>">
											<div class="listing-shot-img">
												<img src="<?php echo $obj->WebPath.$lstgallery['path'];?>" class="img-responsive" alt="">
											</div>
											<div class="listing-shot-caption">
												<div class="h4 font-weight-bold"><?php echo $lstgallery['title'];?></div>
												<div class="h4">Description</div>
												<p class="listing-location">- <?php echo $lstgallery['description'];?></p>
												<div class="listing-location pt-2 ">- <?php echo $lstgallery['create_date'];?></div>
												<span class="like-listing style-2"><i class="fa fa-edit" aria-hidden="true"></i></span>
											</div>
										</a>
										<div class="listing-shot-info rating">
											<div class="row extra">
												<div class="col-md-7 col-sm-7 col-xs-6">
													
												</div>
												<div class="col-md-5 col-sm-5 col-xs-6 pull-right">
													<a href="gallery.php?Did=<?php echo $lstgallery['gallery_id']; ?>" onClick="return confirm('are you sure delete this record ?');" class="detail-link"><i class="glyphicon glyphicon-trash"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
									<?php	
								}
							?>
							</div>
						</div>
						<!-- End All Listing -->
					</div>
					<!-- Start Pagination -->
					<div class="row">
					</div>
					<!-- End Pagination -->
				</div>
			</section>
			<!-- ================ End Listing In Grid Style ======================= -->
			
			
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
			
		</div>
	</body>

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/grid-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:01:46 GMT -->
</html>