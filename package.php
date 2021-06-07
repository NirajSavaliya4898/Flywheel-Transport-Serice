<?php
    require 'Config.php';
    $obj=new Config();
    $error="";
    if (isset($_GET['package_id'])) 
    {
    	$Data=$obj->myQuery("SELECT * FROM `tbl_package` WHERE `package_id`='".$_GET['package_id']."'")->fetch_assoc();
    	$month=$Data['duration'];
    	$insData["business_id"]=$obj->Businessid($obj->UserKey);
        $insData["package_id"]=$_GET['package_id'];
        $insData["end_date"]=date("Y-m-d", strtotime("+".$month." month", date('Y-m-d')));
        $insData["method"]="cash";
        $insData["remote_ip"] = $obj->remote_ip;
        $insData["create_date"] = $obj->currentDate;
        $insData["modify_date"] = $obj->currentDate; 
        $result=$obj->myInsert("tbl_buy_package",$insData);
        
        if($result>0){
            $obj->Redirect("business-mydashboard.php");
        }else{
            
        }
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
		
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:07:54 GMT -->
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
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Package</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ================ End Page Title ======================= -->
			
			<!-- ================ Office Address ======================= -->
			<section class="padd-0">
				<div class="container">
				</div>
			</section>
			<!-- ================ End Office Address ======================= -->
			
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
			
			<!-- ================ End Fill Forms ======================= -->
			
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

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:07:54 GMT -->
</html>