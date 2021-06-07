<?php
    require "Config.php";
    $obj=new Config();
    $obj->UserWall();

    if (isset($obj->UserKey)) 
    {
        if ($obj->RegisterType=="user") 
        {
           $Data=$obj->myQuery("SELECT * FROM `tbl_registration` where `email_id`='".$obj->UserKey."'")->fetch_assoc();
            $City=$obj->myQuery("SELECT `name`,`parentkey` FROM `tbl_location` WHERE `location_id`='".$Data['location_id']."' AND `label`='city'")->fetch_assoc();
           
            $State=$obj->myQuery("SELECT `name`,`parentkey` FROM `tbl_location` WHERE `location_id`='".$City['parentkey']."' AND `label`='state'")->fetch_assoc();
            $Country=$obj->myQuery("SELECT `name` FROM `tbl_location` WHERE `location_id`='".$State['parentkey']."' AND `label`='country'")->fetch_assoc();
            if($Data['dob']=="0000-00-00"  AND $Data['gender']=="")
            {
                $obj->Redirect("user-profile.php");
            }
        }
        else
        {
             $obj->Redirect("business-profile-display.php");
        }
    }
    $error="";
   

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/profile-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:07:53 GMT -->
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
			
			
			<!-- Page Title -->
			<section class="title-transparent page-title" style="background:url(assets/img/title-bg.jpg);">
				<div class="container">
					<div class="title-content">
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Page Title -->
			
			<section class="padd-0">
				<div class="container">
					<!-- General Information -->
					<div class="add-listing-box translateY-60 edit-info mrg-bot-25 padd-bot-30 padd-top-25">
						<div class="listing-box-header">
							<div class="avater-box">
							<img src="<?php echo $obj->WebPath.$Data['image']; ?>" class="img-responsive img-circle edit-avater uprofile" alt="" />
							</div>
							<h3><?php echo $Data['name'];?></h3>
							<a class="text-danger font-weight-bold" href="user-profile-update.php" title="Edit Information">Edit Profile</a>
						</div>
						<div class="row mrg-r-10 mrg-l-10 preview-info">
							<div class="col-sm-6">
								<label><i class="ti-mobile preview-icon call mrg-r-10"></i><?php echo $Data["contactno"]; ?></label>
							</div>
							<div class="col-sm-6">
								<label><i class="ti-email preview-icon email mrg-r-10"></i><?php echo $Data["email_id"]; ?></label>
							</div>
							<div class="col-sm-6">
								<label><i class="ti-gift preview-icon birth mrg-r-10"></i><?php echo $Data["dob"]; ?></label>
							</div>
							<div class="col-sm-6">
								<label><i class="ti-world preview-icon web mrg-r-10"></i><?php echo $City['name'];  ?></label>
							</div>
						</div>
					</div>
					<!-- End General Information -->
				</div>
			</section>
			
			<section class="padd-top-0">
				<div class="container">
					<div class="col-md-6 col-sm-12 mob-padd-0">
						<!-- Basic Information -->
						<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-5">
							<div class="preview-info-header">
								<h4>Basic Info</h4>
							</div>
							<div class="preview-info-body">
								<ul class="info-list">
									<li>
										<label>Name:</label>
										<span><?php echo $Data["name"]; ?></span>
									</li>
									<li>
										<label>Birth:</label>
										<span><?php echo $Data["dob"]; ?></span>
									</li>
									<li>
										<label>Gender</label>
										<span><?php echo $Data["gender"]; ?></span>
									</li>
									<li>
										<label>Country:</label>
										<span><?php echo $Country['name'];  ?></span>
									</li>
								</ul>
							</div>
						</div>
						<!-- End Basic Information -->
					</div>
					
					<div class="col-md-6 col-sm-12 mob-padd-0">
						<!-- Address Information -->
						<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-5">
							<div class="preview-info-header">
								<h4>Contact Info</h4>
							</div>
							<div class="preview-info-body">
								<ul class="info-list">
									<li>
										<label>Phone:</label>
										<span><?php echo $Data["contactno"]; ?></span>
									</li>
									<li>
										<label>Email:</label>
										<span><?php echo $Data["email_id"]; ?></span>
									</li>
									<li>
										<label>State:</label>
										<span><?php echo $State['name'];  ?></span>
									</li>
									
									<li>
										<label>Address:</label>
										<span><?php echo $Data["address"]; ?></span>
									</li>
								</ul>
							</div>
						</div>
						<!-- End Address Information -->
					</div>
					<div class="col-md-6 col-sm-12 mob-padd-0">
						<!-- Address Information -->
						
								<div class="col-sm-12">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29756.575433417172!2d72.84063384525962!3d21.20915760660211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f02397941bd%3A0xf103a23101102563!2sVarachha%2C+Surat%2C+Gujarat!5e0!3m2!1sen!2sin!4v1551577906806" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
								</div>
						
										<!-- End Address Information -->
					</div>
				</div>
			</section>
			
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

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/profile-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:07:53 GMT -->
</html>