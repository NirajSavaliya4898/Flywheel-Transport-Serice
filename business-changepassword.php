<?php
    require 'Config.php';
$obj=new Config();

// $obj->checkSuper();
    // $obj->ChAdmin();

    $error="";
    if (isset($_POST['btn_send'])) 
    {
        $oldpassword=md5($_POST['oldpassword']);
        $newpassword=md5($_POST['newpassword']);
        $conpassword=md5($_POST['conpassword']);
        $chk_user=$obj->myQuery("SELECT * FROM `tbl_business` WHERE `email_id`='".$obj->UserKey."' and `password`='".$oldpassword."'")->num_rows;
        if ($chk_user==1) 
        {
            if ($newpassword== $conpassword) 
            {
                $UpData["password"]=$newpassword;
                $Where["email_id"]=$obj->UserKey;
                $obj->myUpdate("tbl_business",$UpData,$Where);
                $obj->Redirect("index.php");
            }
            else
            {
                $error="<div  class=\"alert alert-success\">New Password & Confirm Password Not Same...</div>";
            }
        }
        else
        {
             $error="<div  class=\"alert alert-success\">Old Password Is Incorrect...</div>";
        }
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
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
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ================ End Page Title ======================= -->
			
			<!-- ================ Edit Section Start ======================= -->
			<section class="padd-0">
				<div class="container">
					<div class="col-md-10 translateY-60 col-sm-12 col-md-offset-1">
						<!-- Change Password Information -->
						<div class="add-listing-box opening-day mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">
								<i class="ti-lock theme-cl"></i>
								<h3>Change Password</h3>								
							</div>
							<form method="post">
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-6">
										<label>Old Password</label>
										<input type="Password" class="form-control"   name="oldpassword">
									</div>
									
									<div class="col-sm-6">
										<label>New Password</label>
										<input type="Password" class="form-control" name="newpassword" >
									</div>
									<div class="col-sm-12">
										<label>Confirm Password</label>
										<input type="Password" class="form-control" name="conpassword" >
									</div>
									<div class="center">
										<button type="submit" name="btn_send" id="subscribe" class="btn btn-midium theme-btn  width-200 glyphicon glyphicon-pencil"> Change Password</button>
										<?php
			                    			echo  $error;
			                  			?>
									</div>
								</div>
							</form>
						</div>
						<!-- End Change Password Information -->
					</div>
				</div>
			</section>
			<!-- ================ End Edit Section Start ======================= -->
			
			
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
</html>