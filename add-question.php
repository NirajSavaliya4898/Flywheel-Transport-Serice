<?php
    require "Config.php";
    $obj=new Config();
    $obj->UserWall();
    $error="";
    if (isset($obj->UserKey)) 
    {
        if ($obj->RegisterType=="user") 
        {
            if (isset($_POST['btn_send'])) 
            {
                $registration_id=$obj->myQuery("SELECT `registration_id` FROM `tbl_registration` WHERE `email_id`='$obj->UserKey'")->fetch_assoc();
                $selectQue=$obj->myQuery("select * from tbl_security where registration_id=".$registration_id['registration_id'])->num_rows;
                if($selectQue<3)
                {
                    $insert_data["que"]=$_POST["que"];
                    $insert_data["answer"]=$_POST["answer"];
                    $insert_data["registration_id"]=$registration_id['registration_id'];
                    $result=$obj->myInsert("tbl_security",$insert_data);
                    if ($result>0) 
                    {
                      // $rerror = "<span class='text-success'>Your Card No :".$_POST['card_no']." Is Added Successfully</span>";
                    	$error="<div  class=\"alert alert-success\">Security Question Add successfully...</div>";
                    }else{
                       // $rerror = "<span class='text-success'>Your Card No :".$_POST['card_no']." Is Can't Added..</span>";
                    	$error="<div  class=\"alert alert-success\">Security Question Can't Add </div>";
                    }
                }else{
                    // no authority to add more question..
                }
            }
        }
        else
        {
            if (isset($_POST['btn_send'])) 
            {
                 $business_id=$obj->Businessid($obj->UserKey);

                $selectQue=$obj->myQuery("select * from tbl_security where business_id=".$business_id)->num_rows;


                if($selectQue<3)
                {
                    $insert_data["que"]=$_POST["que"];
                    $insert_data["answer"]=$_POST["answer"];
                    $insert_data["business_id"]=$business_id;
                    $result=$obj->myInsert("tbl_security",$insert_data);
                    if ($result>0) 
                    {
                      $error="<div  class=\"alert alert-success\">Security Question Add successfully...</div>";
                    }else{
                    $error="<div  class=\"alert alert-success\">Security Question Can't Add </div>";
                    }
                }else{
                    // no authority to add more question..
                }
                
            }
        }        
    }
    else
    {
       $obj->Redirect("login-register.php");
    }
    ?>
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
						<h1>SECURITY QUESTION</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>						
							<span class="current">SECURITY QUESTION</span>
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
							<div class="col-md-12">
									<div class="layout-option pull-right">	
									</div>
								</div>
							<div class="col-md-12">
						<!-- General Information -->
						<div class="add-listing-box full-detail mrg-top-25 mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">
							</div>
							<form method="post">
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-12">
										<label for="Bank">SECURITY QUESTION</label><br>
                                        <select id="que" data-bvalidator="required" name="que" class="form-control">
                                            <option selected hidden value="">Select Question</option>
                                            <option >Your Childhood Name ?</option>
                                            <option >Your Birth Place ?</option>
                                            <option>Your Nick Name ?</option>
                                            <option>Your Pet Name ?</option>
                                            <option>Your Favourite Teacher Name ?</option>
                                        </select>
									</div>
									<div class="col-sm-12">
										<label>Answer</label>
										 <input type="text" name="answer" placeholder="Enter Answer" data-bvalidator="required" class="form-control">
									</div>										
								</div>
								<div class="center">
									<?php
									 echo $error;
									?>

									<button type="submit" name="btn_send" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200">Send</button>
									
								</div>
								
									
							</form>
						</div>
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