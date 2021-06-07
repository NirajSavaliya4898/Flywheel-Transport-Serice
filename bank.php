<?php
    require "Config.php";
    $obj=new Config();
    	if(isset($_GET["Did"])){
    	$wh["add_bank_id"]=$_GET["Did"];
    	$obj->myDelete("tbl_add_bank",$wh);
    	$obj->Redirect("bank.php");
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
						<h1>Bank</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<a href="business-mydashboard.php">My Dashboard</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Bank</span>
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
									<h3>Bank</h3>
								</div>
								<div class="col-md-6">
									<div class="layout-option pull-right">
									<a href="addbank.php" class="btn btn-black">Add Bank</a>
										
									</div>
								</div>
							</div>
							<!-- End Filter option -->
							
					<div class="row mrg-0">
						<?php
	if (isset($obj->UserKey)) 
	{

		if ($obj->RegisterType=="business") 
		{
			?>
				
			<?php
			$Data=$obj->myQuery("SELECT * FROM `tbl_add_bank` WHERE  `business_id`='".$obj->Businessid($obj->UserKey)."'");	
			while ($Res=$Data->fetch_assoc())
			{
				$bank=$obj->myQuery("SELECT * FROM `tbl_bank` WHERE  `bank_id`='".$Res["bank_id"]."'")->fetch_assoc();	
				?>
				<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-5">
						<div class="preview-info-header text-center">
							<h3 class="glyphicon glyphicon-info-sign mt-0"> Bank Account Info</h3>
						 </div>
						 <div class="preview-info-body">
							<ul class="info-list ">
								<li>
									<label>Bank Name:</label>
									<span><?php echo $bank['bank_name']; ?></span>
								</li>
								<li>
									<label>Ac Number:</label>
								    <span><?php echo $Res['account_no'];  ?></span>
								</li>
								<li>
									<label>Card Number:</label>
									<span><?php echo $Res['card_number'];  ?></span>
								</li>
								<li>
									<label>Card Holder Name: </label>
									<span><?php echo $Res['card_holdername'];  ?></span>
								</li>
								<li>
									<label>Amount:</label>
									<span><?php echo $Res['wallet']." Rs"; ?></span>
								</li>
							</ul>
						 </div>
						 <div class="col-md-5 col-sm-5 col-xs-6 pull-right">
								<span class="like-listing style-2">
								<a href="bank.php?Did=<?php echo $Res['add_bank_id']; ?>" class="detail-link"><i class="glyphicon glyphicon-trash"></i></a>
							</span>												
						 </div>
				</div>
				<?php

			}	
		}
		else
		{
			?>
			  
			<?php
			$Data=$obj->myQuery("SELECT * FROM `tbl_add_bank` WHERE  `registration_id`='".$obj->registrationid($obj->UserKey)."'");	
			while ($Res=$Data->fetch_assoc())
			{
				$bank=$obj->myQuery("SELECT * FROM `tbl_bank` WHERE  `bank_id`='".$Res["bank_id"]."'")->fetch_assoc();	
				?>
				<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-5">
						<div class="preview-info-header text-center">
							<h3 class="glyphicon glyphicon-info-sign mt-0"> Bank Account Info</h3>
						 </div>
						 <div class="preview-info-body">
							<ul class="info-list">
								<li>
									<label>Bank Name:</label>
									<span><?php echo $bank["bank_name"]; ?></span>
								</li>
								<li>
									<label>Acc Number:</label>
								    <span><?php echo $Res['account_no'];  ?></span>
								</li>
								<li>
									<label>Card Number:</label>
									<span><?php echo $Res['card_number'];  ?></span>
								</li>
								<li>
									<label>Amount:</label>
									<span><?php echo $Res['wallet']." Rs"; ?></span>
								</li>
							</ul>
						 </div>
						  <div class="col-md-5 col-sm-5 col-xs-6 pull-right">
								<span class="like-listing style-2">
								<a href="bank.php?Did=<?php echo $Res['add_bank_id']; ?>" onclick="return confirm('are you sure delete this record ?');" class="detail-link"><i class="glyphicon glyphicon-trash"></i></a>
							</span>												
						 </div>
				</div>
				<?php

			}	
		}
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
