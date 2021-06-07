<?php
	require "Config.php";
	$obj=new Config();
	// $noti["sender"]="visitor";
	//         $noti["reciver"]="admin";
	//         $noti["title"]="feedback";
	//         $noti["msg"]=$_POST["msg"];
	//         $noti["status"]=0;
	//         $result=$obj->myInsert("tbl_notification",$noti);
	if (isset($obj->UserKey)) 
	{
		if ($obj->RegisterType=="user") 
		{
			$Data=$obj->myQuery("SELECT * FROM `tbl_registration` where `email_id`='".$obj->UserKey."'")->fetch_assoc();
		}
		else
		{
			$Data=$obj->myQuery("SELECT * FROM `tbl_business` where `email_id`='".$obj->UserKey."'")->fetch_assoc();
		}
		
	}
 ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:07:21 GMT -->
<head>
	<?php
		require "header.php";
	?>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"> -->
	<style type="text/css">
		.bg-lakkad
		{
			height: 400px;
			margin-top: 80px;
			background-image: url('assets/images/background-kolkata.png');
			background-repeat: no-repeat;
			background-repeat: repeat-x;
			background-position: -450px;
		}
		.bg1
		{
			background-image: url(assets/images/home-page-sprit.png);
			background-position: -25px -76px;
			width: 165px;
			height: 68px;
			top: 170px;
			left: 100%;
			z-index: 6;
			position: relative;
			animation:bgone 8s linear infinite;
		}
		@keyframes bgone{
			0%{ left: 100%; }
			25%{ left: 75%; }
			50%{ left:50%; }
			75%{ left: 25%; }
			100%{ left: 0%; }
		}
		.bg2
		{
			background-image: url(assets/images/home-page-sprit.png);
			width: 86px;
			height: 43px;
			top: 130px;
			left: 0%;
			z-index: 10;
			background-position: -25px -167px;
			position: relative;
			animation:bgtwo 10s linear infinite;
		}
		@keyframes bgtwo{
			0%{ left: 0%; }
			25%{ left: 25%; }
			50%{ left:50%; }
			75%{ left: 75%; }
			100%{ left: 100%; }
		}
		.bg3
		{
			background-image: url(assets/images/1.png);
			background-repeat: no-repeat;
			width: 86px;
			height: 86px;
			top: -205px;
			left: 0%;
			transform: rotate(45deg);
			z-index: 15;
			position: relative;
			animation:bgtwo 10s linear infinite;
		}
		@media (max-width:991px){
			.bg3
			{
				margin-top:40px;
			}
			.bg1
			{
				margin-top:35px;
			}
		}
	</style>
	</head>
	<body class="home-2">
		<div class="wrapper">  
			<!-- Start Navigation -->
			<?php
				require "navigation.php";
			?>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			
			<!-- Slider Section Start -->
			</div>
			<!-- End  bootstrap-touch-slider Slider -->
			<div class="clearfix"></div>
			<!-- Main Banner Section End -->
			
			<!-- Option Search Form -->

			
			<!-- Start Pricing -->

			<section class="bg-lakkad" >
				<div class="bg1"></div>
				<div class="bg2"></div>
				<div class="bg3"></div>
			</section>
			<?php
				if (isset($obj->UserKey)) 
				{
					if ($obj->RegisterType=="user") 
					{
						?>
							 <section class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="tab style-1" role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs nav-justified" role="tablist">
								<?php
								$i=1;
								$DataM=$obj->myQuery("SELECT * FROM  `tbl_category` WHERE  `label` =  'main'");
								while ($lstmain=$DataM->fetch_assoc()) 
								{
									?>
										<li role="presentation"><a href="#tab-list<?php echo $i; ?>" aria-controls="home" role="tab" data-toggle="tab"><img width="55px" class="pr-3" src="<?php echo $obj->WebPath.$lstmain['image']; ?>"> <?php echo $lstmain['name']; ?></a></li>
									<?php
								$i++;
								}
								?>

							</ul>
							<!-- Tab panes -->
							<div class="tab-content tabs">
								<?php
								$i=1;
								$Data=$obj->myQuery("SELECT * FROM  `tbl_category` WHERE  `label` =  'main'");
								while ($lstmain=$Data->fetch_assoc()) 
								{
									?>
										<div role="tabpanel" class="tab-pane fade in" id="tab-list<?php echo $i; ?>">
											<div class="container">
												<div class="row">
													<?php
														$sub=$obj->myQuery("SELECT * FROM  `tbl_category` WHERE  `label` =  'sub' and parentkey='".$lstmain['category_id']."'");
														$j=1;
														while ($lstsub=$sub->fetch_assoc()) 
														{
															?>
																<div class="category-slide slick-initialized slick-slider">
																	 <div class="list-slide-box slick-slide slick-cloned slick-center" data-slick-index="-1" aria-hidden="true" style="width: 350px;" tabindex="-1">
																			<div class="category-full-widget">
																				<div class="category-widget-bg" style="background-image: url(<?php echo $obj->WebPath.$lstsub['image']; ?>);">
																					<i class="bg-g fa cat-icon fa-briefcase" aria-hidden="true"></i>
																				</div>
																				<div class="cat-box-name">
																					<h4><?php echo $lstsub['name']; ?></h4>
																					<a href="availale-business.php?id=<?php echo $lstsub["category_id"]; ?>" class="btn-btn-wrowse" tabindex="-1">See Business</a>
																				</div>
																			</div>
																		</div>
																</div>		
															<?php
															$j++;
														}
													?>
												</div> 
											</div>
										</div>
									<?php
								$i++;
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</section>		

			<section class="features">
				<div class="container">
					<!-- <div style="position: absolute;top: 52%;left: 0;margin: 5px 19%;width: 62%;height: 9px;background: #ff431e;"></div> -->
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						<div class="heading">
							<h2>HOW WE WORK ?</h2>
						</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="feature-box">
							<span class="glyphicon glyphicon-user"></span>
							<h4>CUSTOMER BOOK THROUGH WEBSITE</h4>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="feature-box">
							<span class="ti-map-alt"></span>
							<h4>THE NEAREST PARTNER DRIVER & TRUCK LOCATED FOR BOOKING</h4>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="feature-box">
							<span class="glyphicon glyphicon-list-alt"></span>
							<h4>ORDER IS COMPLETED AND STATUS IS UPDATED VIA SMS</h4>
						</div>
					</div>
				</div>
			</section>
						<?php
					}



					else
					{
						?>
			<section class="features">
				<div class="container">
					<!-- <div style="position: absolute;top: 52%;left: 0;margin: 5px 19%;width: 62%;height: 9px;background: #ff431e;"></div> -->
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						<div class="heading">
							<h2>HOW WE WORK ?</h2>
						</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="feature-box">
							<span class="glyphicon glyphicon-user"></span>
							<h4>CUSTOMER BOOK THROUGH WEBSITE</h4>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="feature-box">
							<span class="ti-map-alt"></span>
							<h4>THE NEAREST PARTNER DRIVER & TRUCK LOCATED FOR BOOKING</h4>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="feature-box">
							<span class="glyphicon glyphicon-list-alt"></span>
							<h4>ORDER IS COMPLETED AND STATUS IS UPDATED VIA SMS</h4>
						</div>
					</div>
				</div>
			</section>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						<div class="heading">
							<h2>Our Best <span>Packages</span></h2>
						</div>
						</div>
					</div>
					<div class="row">
			<?php
				$Data=$obj->myQuery("SELECT * FROM `tbl_package`");
				while ($lstpackage=$Data->fetch_assoc()) 
				{
					?>

						<div class="col-md-4 col-sm-4">
							<div class="active package-box">
								<div class="package-header">
									<i class="fa fa-star-half-o" aria-hidden="true"></i>
									<h3><?php  echo $lstpackage['name']; ?></h3>
								</div>
								<div class="package-price">
									<div class="h3"><?php  echo $lstpackage['prize']; ?></div>
								</div>
								<div class="package-info">
									<ul>
										<li><?php  echo $lstpackage['duration']; ?> Per Month</li>
										<li><?php  echo $lstpackage['description']; ?></li>
										<li>24/7</li>
									</ul>
								</div>
								<a href="package.php?package_id=<?php  echo $lstpackage['package_id']; ?>" class="btn btn-package mt-4">Buy Now</a>
							</div>
						</div>
					<?php
				}
			?>
					</div>
				</div>
			</section>
							
						<?php
					}
				}	
			?>
			
			<!-- End Pricing Section -->
			
			<!-- ================ Start Newsletter ======================= -->
			<section class="newsletter bg-newsletter inverse-theme" style="background:#2a3646 url(assets/img/svg-bg.svg);">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1">
							<div class="text-center">
								<h2>Join Thousand of Happy Customers!</h2>
								<p>Subscribe our newsletter & get latest news and updation!</p>
								<form class="sup-form" method="post">
									<input id="emailsubid" type="email" placeholder="Email Address" class="form-control sigmup-me" name="email_id" required="">
									<input type="button" id="emailsub" class="btn theme-btn" value="Get Started">
								</form>
								<p class="email-error"></p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ================ Start Newsletter ======================= -->
			
			<!-- ================ Start Footer ======================= -->
			
			<!-- ================ End Footer Section ======================= -->
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

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:07:38 GMT -->
</html>