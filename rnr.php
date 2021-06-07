<?php
	require 'config.php';
	$obj=new Config();
    $obj->UserWall();
  	$error="";
    if (isset($_GET['oid'])) 
    {
    	$oid=$_GET['oid'];
    	
   		$oData=$obj->myQuery("select * from tbl_order where order_id='".$_GET["oid"]."'")->fetch_assoc();
   		$business_id=$oData['business_id'];
   		$registration_id=$oData['registration_id'];

   		$selCount=$obj->myQuery("select * from tbl_rate where business_id='$business_id' and registration_id='$registration_id'");
   		$selCount1=$obj->myQuery("select * from tbl_review where business_id='$business_id' and registration_id='$registration_id'");

        $count=$selCount->num_rows;
        $selData=$selCount->fetch_assoc();

        $count1=$selCount1->num_rows;
        $selData1=$selCount1->fetch_assoc();

    }else{
    	$obj->Redirect("index.php");
    }

    if (isset($_POST['btn_send'])) 
    {
    	if(isset($_POST['rating']))
        {
 
            if($count==1){

                $insdatar["rate"]=$_POST["rating"];
                $insdatar["modify_date"]=$obj->currentDate;
                $insdatar["remote_ip"] =$obj->remote_ip;

                $wh["rate_id"]=$selData["rate_id"];
                if($obj->myUpdate("tbl_rate",$insdatar,$wh)>0)
                {
                	
                	$obj->Redirect('rnr.php?oid='.$oid.'&msg=Review Submitted - Thank You!');
                }

                $selCount=$obj->myQuery("select * from tbl_rate where business_id='$business_id' and registration_id='$registration_id'");
                $selData=$selCount->fetch_assoc();

            }else{
                $insdatau["registration_id"]=$registration_id;
                $insdatau["business_id"]=$business_id;
                $insdatau["rate"]=$_POST["rating"];
                $insdatau["create_date"]=$obj->currentDate;
                $insdatau["modify_date"]=$obj->currentDate;
                $insdatau["remote_ip"] =$obj->remote_ip;
                if($obj->myInsert("tbl_rate",$insdatau))
                {
                    $obj->Redirect('rnr.php?oid='.$oid.'&msg=Review Submitted - Thank You!');
                }
            }
        }

        if(isset($_POST["msg"])){
        	if ($_POST["msg"]!="") 
        	{  		
        		if ($count1==1) 
        		{
        			$UR["registration_id"]=$registration_id;
		            $UR["business_id"]=$business_id;
		            $UR["message"]=$_POST["msg"];
		            $UR["modify_date"]=$obj->currentDate;
		            $UR["remote_ip"] =$obj->remote_ip;
		            $URW["review_id"]=$selData1['review_id'];
		            $obj->myUpdate("tbl_review",$UR,$URW);
        		}
        		else
        		{
        			$insdata["registration_id"]=$registration_id;
		            $insdata["business_id"]=$business_id;
		            $insdata["message"]=$_POST["msg"];
		            $insdata["create_date"]=$obj->currentDate;
		            $insdata["modify_date"]=$obj->currentDate;
		            $insdata["remote_ip"] =$obj->remote_ip;
		            $obj->myInsert("tbl_review",$insdata);
        		}
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

	<style type="text/css">
		.rating {
      float:left;
      height: 30px !important;
      line-height: 30px !important;
    }

    /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
      follow these rules. Every browser that supports :checked also supports :not(), so
      it doesn’t make the test unnecessarily selective */
    .rating:not(:checked) > input {
        position:absolute;
        top:-9999px;
        clip:rect(0,0,0,0);
    }

    .rating:not(:checked) > label {
        float:right;
        width:1em;
        /* padding:0 .1em; */
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:300%;
        /* line-height:1.2; */
        color:#ddd;
    }

    .rating:not(:checked) > label:before {
        content: '★ ';
    }

    .rating > input:checked ~ label {
        color: dodgerblue;
        
    }

    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
        color: dodgerblue;
        
    }

    .rating > input:checked + label:hover,
    .rating > input:checked + label:hover ~ label,
    .rating > input:checked ~ label:hover,
    .rating > input:checked ~ label:hover ~ label,
    .rating > label:hover ~ input:checked ~ label {
        color: dodgerblue;
        
    }

    .rating > label:active {
        position:relative;
        top:2px;
        left:2px;
    }
.sidebar-categori ul li a:hover,
.sidebar-categori ul li a:hover span,
.sidebar-categori ul li a span:hover{
    color: #333 !important;
    font-weight: bold;
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
			<section class="title-transparent page-title" style="background:url(assets/images/banner-plane2.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Review And Rating</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Review And Rating</span>
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
			
			<!-- ================ Fill Forms ======================= -->
			
				<section id="section">
				<!--Section box starts Here -->
				<form method="post">
				<div class="section">
					<div class="amazing-features ">
						<div class="container">
							<div class="row">
								<div class="col-xs-2"></div>
								<div class="col-xs-8">
									<div class="amazing-text">
										<div class="detail-wrapper">
											<div class="detail-wrapper-header">
												<h4>Rate &amp; Write Reviews</h4>
											</div>
											<div class="detail-wrapper-body">
											
												<div class="row mrg-bot-10">
													<div class="col-md-12 my-2">
														<div class="rating">
														 <?php
				                                            $ratee=$selData["rate"];

				                                                for($i=5;$i>=1;$i--){
				                                                  
				                                                        if($i==$ratee){
				                                                            echo "<input type='radio' checked id='star$i' name='rating' value='$i' /><label for='star$i'  title='$i'>$i stars</label>";
				                                                        }    
				                                                        else{
				                                                            echo "<input type='radio' id='star$i' name='rating' value='$i' /><label for='star$i' title='$i'>$i stars</label>";      
				                                                        }
				                                                      
				                                                  }
				                                            ?>
				                                        </div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-sm-12 mt-2">
														<textarea name="msg" class="form-control height-110" placeholder="Tell us your experience..."><?php echo $selData1['message']; ?></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="center mt-5">
										<a href="contact.php">
											<button name="btn_send" class="btn btn-midium theme-btn  width-300">Submit</button>
										</a><br>
										<span class="py-3"></span>
										<?php
											if ($error!="") {
												echo $error;
										 }if (isset($_GET['msg'])) 
                	{
                		echo $_GET['msg'];
                	}?>	
									</div>
								</div>
							</div>
						</div>
					</div>				
				</div>
				</form>
				<!--Section box ends Here -->
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