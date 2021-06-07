<?php
	require 'Config.php';
    $obj=new Config();
	
	if (isset($_GET['order_id'])) 
	{
	 	$upData["status"]="E";
	    $where["order_id"]=$_GET['order_id'];
	    $obj->myUpdate("tbl_order",$upData,$where);
	}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/thank-you.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:02:55 GMT -->
<head>
	<?php
		require "header.php";
	?>
    <style type="text/css">
    	
    	.booking-confirm-cancle i {
		    font-size: 45px;
		    color: #bf0505;
		    border-radius: 50%;
		    border: 1px solid #ffabab;
		    box-shadow: 0 0 10px 1px #afffe5;
		    -webkit-box-shadow: 0 0 10px 1px #ffafba;
		    -moz-box-shadow: 0 0 10px 1px #afffe5;
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
			
			
			<!-- ================ Start Page Title ======================= -->
			<section class="title-transparent page-title" style="background:url(assets/img/title-bg.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Confirmation</h1>
						<div class="breadcrumbs">
							<a href="home.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Confirmation</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ================ End Page Title ======================= -->
			
			
			
			<?php
				if (isset($_GET['status'])) 
				{
				 ?>
				 	<section>
						<div class="container">
							<div class="booking-confirm-cancle booking-confirm padd-top-30 padd-bot-30">
								<i class="fa fa-times text-danger" aria-hidden="true"></i>
								<div class="mrg-top-15 text-danger h2">Cancle Your Order</div>

							</div>
						</div>
					</section>
				 <?php
				}else{
					?>
						<section>
							<div class="container">
								<div class="booking-confirm padd-top-30 padd-bot-30">
									<i class="fa fa-check" aria-hidden="true"></i>
									<h2 class="mrg-top-15">Thanks for your booking!</h2>

								</div>
							</div>
						</section>
					<?php
				}
			?>

			
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

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/thank-you.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:02:55 GMT -->
</html>