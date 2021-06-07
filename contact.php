<?php
    require 'Config.php';
    $obj=new Config();
    $error="";
    if(isset($_POST["btn_send"])){

        $count=$obj->myQuery("select * from tbl_contact where contact_id='".$_POST["contact_id"]."'")->num_rows;
        if($count==0) {
            $insData["name"] = $_POST["name"];
            $insData["contactno"] = $_POST["contactno"];
            $insData["email_id"] = $_POST["email_id"];
            $insData["message"] = $_POST["message"];
            $insData["remote_ip"] = $obj->remote_ip;
            $insData["create_date"] = $obj->currentDate;
            $insData["modify_date"] = $obj->currentDate; 
             $result=$obj->myInsert("tbl_contact", $insData);

            if (isset($obj->UserKey)) 
		    {
		        if ($obj->RegisterType=="user") 
		        {
		             $noti["sender"]="User";
		        }
		        else
		        {
		             $noti["sender"]="Business";
		        }	        
		    }
		    else
		    {
		    	 $noti["sender"]="visitor";
		    }
            $noti["reciver"]="admin";
            $noti["title"]="contact";
            $noti["message"]=$_POST["message"];
            $noti["status"]=0;
            $result=$obj->myInsert("tbl_notification",$noti);
            
            if($result>0){
                $error="<div class=\"alert alert-success\">Contact Successfully.</div>";
            }else{
                $error="<div class=\"alert alert-danger\">Something Wrong...</div>";
            }
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
	<!-- <link href="assets/css/bvalidator.css"> -->
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
						<h1>Get In Touch</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Contact US</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ================ End Page Title ======================= -->
			
			<!-- ================ Office Address ======================= -->
			<section class="padd-0">
				<div class="container">
					<div class="col-md-10 col-md-offset-1 col-sm-12 translateY-60">
						<div class="col-md-6 col-sm-6">
							<div class="detail-wrapper text-center padd-top-40 mrg-bot-10 padd-bot-40 light-bg">
								<i class="theme-cl font-30 ti-location-pin"></i>
								<h4>India Office</h4>
								Sco 23, Yogini Bulding, Near Hirabug<br>
								Surat (9925878607)
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="detail-wrapper text-center padd-top-40 mrg-bot-10 padd-bot-40 light-bg">
								<i class="theme-cl font-30 ti-location-pin"></i>
								<h4>Uk Office</h4>
								Tower Road, Sector 52, Near Manchester<br>
								UK (56598989)
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ================ End Office Address ======================= -->
			
			<!-- ================ Fill Forms ======================= -->
			
				<div class="container py-5">
					<div class="col-md-3 col-sm-3"></div>
					<div class="col-md-6 col-sm-6">
						<form method="post" class="bValidator">
							<div class="form-group">
								<label>Name:</label>
								<input type="text" class="form-control" name="name" placeholder="Name" data-bvalidator="rangelength[3:32],required" data-bvalidator-msg="Name must be between 3 and 32 characters !" />
							</div>
							<div class="form-group">
								<label>Contact Number:</label>
								<input type="text" class="form-control" name="contactno" placeholder="Contact Number" data-bvalidator="number,minlength[10],maxlength[10],required" data-bvalidator-msg="Please enter a valid phone number" />
							</div>
							<div class="form-group">
								<label>Email:</label>
								<input type="email" class="form-control" name="email_id" placeholder="Email" data-bvalidator="email,required" data-bvalidator-msg="E-Mail Address does not appear to be valid!" />
							</div>
							<div class="form-group">
								<label>Message:</label>
								<textarea class="form-control height-120" name="message" placeholder="Message" data-bvalidator="rangelength[5:3000],required" data-bvalidator-msg="Message must be between 10 and 3000 characters!"></textarea>
							</div>
							<div class="center">
								<img src="assets/img/barcode.png">
							</div>
							<div class="form-group px-5 text-center mt-5">
								<button class="btn btn-success" type="submit" name="btn_send">Submit</button>
								<button class="btn btn-danger ml-3 " type="reset">Reset</button>
							</div>
							 <?php
			                    	echo $error;
			                 ?>
						</form>
					</div>
				
				</div>
			
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