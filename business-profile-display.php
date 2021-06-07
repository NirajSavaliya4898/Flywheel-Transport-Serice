<?php
    require "Config.php";
    $obj=new Config();
    $obj->UserWall();

    if (isset($obj->UserKey)) 
    {
        if ($obj->RegisterType=="business") 
        {
           $Data=$obj->myQuery("SELECT * FROM `tbl_business` where `email_id`='".$obj->UserKey."'")->fetch_assoc();
            $City=$obj->myQuery("SELECT `name`,`parentkey` FROM `tbl_location` WHERE `location_id`='".$Data['location_id']."' AND `label`='city'")->fetch_assoc();
           
            $State=$obj->myQuery("SELECT `name`,`parentkey` FROM `tbl_location` WHERE `location_id`='".$City['parentkey']."' AND `label`='state'")->fetch_assoc();
            $Country=$obj->myQuery("SELECT `name` FROM `tbl_location` WHERE `location_id`='".$State['parentkey']."' AND `label`='country'")->fetch_assoc();
          
          	$Rating_data=$obj->myQuery("SELECT r.image,rate.create_date,review.message,rate.rate,r.name 
                                    FROM `tbl_rate` AS rate, `tbl_review` AS review, `tbl_registration` AS r 
                                    WHERE rate.`business_id` = '".$obj->businessid($obj->UserKey)."' AND review.business_id = rate.business_id AND review.create_date = rate.create_date AND review.message <> '' AND r.registration_id=review.registration_id")   ;

            $Categoryarr=explode(",",$Data["category_id"]);
            $subcategorydata="";
            foreach ($Categoryarr as $value) {

            	$subdata=$obj->myQuery("
                   SELECT `category_id`,`name`,`parentkey` 
                   FROM `tbl_category` 
                   WHERE `category_id`='".$value."' AND  `label`='sub'
                                  ")->fetch_assoc();


            	$subcategorydata.=$subdata["name"].",";
            }

          $subcategorydata =trim($subcategorydata,",");


            $up_main_category=$obj->myQuery("
                   SELECT m.`name`,m.`category_id` 
                   FROM `tbl_category` as s,`tbl_category` as m 
                   WHERE s.`parentkey`=m.`category_id` AND s.`category_id`='".$Categoryarr[0]."' AND  m.`label`='main'
                                  ")->fetch_assoc();

            if($Data['contactno']==""  AND $Data['address']=="")
            {
                		 $obj->Redirect("business-profile.php");
            }
        }
        else
        {
             $error="<div  class=\"alert alert-success\">Something is Wrong...</div>";
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
							<img src="<?php echo $obj->WebPath.$Data['logo']; ?>" class="img-responsive img-circle edit-avater uprofile" alt="" />
							</div>
							<h3><?php echo $Data['name'];?></h3>
							<a class="text-danger font-weight-bold" href="business-profile-update.php" title="Edit Information">Edit Profile</a>
						</div>
						<div class="row mrg-r-10 mrg-l-10 preview-info">
							<div class="col-sm-6">
								<label><i class="ti-mobile preview-icon call mrg-r-10"></i><?php echo $Data["contactno"]; ?></label>
							</div>
							<div class="col-sm-6">
								<label><i class="ti-email preview-icon email mrg-r-10"></i><?php echo $Data["email_id"]; ?></label>
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
										<label>Business Name:</label>
										<span><?php echo $Data["name"]; ?></span>
									</li>
									<li>
										<label>Main Category:</label>
										<span><?php echo $up_main_category['name'];  ?></span>
									</li>
									<li>
										<label>Sub Category:</label>
										<span><?php echo $subcategorydata;  ?></span>
									</li>
									<li>
										<label>City:</label>
										<span><?php echo $City['name'];  ?></span>
									</li>
									<li>
										<label>State:</label>
										<span><?php echo $State['name'];  ?></span>
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
										<label>Visiting Card:</label>
										<span>
											<img src="<?php echo $obj->WebPath.$Data['visiting_card']; ?>" class="zoom-img" width="100px"/>
										</span>
									</li>
									<li>
										<label>Certificate:</label>
										<span>
											<img src="<?php echo $obj->WebPath.$Data['certificate']; ?>" class="zoom-img" width="100px"/>
										</span>
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
					<div class=" col-sm-12 mob-padd-0 ml-0">
						<!-- Address Information -->
						
								<div class="col-sm-12">
									<iframe src="<?php  echo $Data["google_map"]; ?>" width="1200" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
								</div>
						
										<!-- End Address Information -->
					</div>
					<div class="col-sm-12 mob-padd-0 ml-0">
					        <div class="detail-wrapper">
								<div class="detail-wrapper-header">
									<h4>Reviews And Rating</h4>
								</div>
								<?php
		                            while ($lst=$Rating_data->fetch_assoc()) 
		                            {
		                                ?>

		                                <div class="detail-wrapper-body">
											<ul class="review-list">
												<li>
													<div class="reviews-box">
														<div class="review-body">
															<div class="review-avatar">
																<img alt="" src="<?php echo $obj->WebPath.$lst['image']; ?>" class="avatar avatar-140 photo">
															</div>
															<div class="review-content">
																<div class="review-info">
																	<div class="review-comment">
																		<div class="review-author">
																			<?php echo $lst['name']; ?>			
																		</div>
																		<div class="rating">
																			<?php
				                                            					$ratee=$lst["rate"];
								                                                for($i=1;$i<=5;$i++){
								                                                        if($i<=$ratee){
								                                                            echo "<i class='fa fa-star' style='color:blue'></i>";
								                                                        }    
								                                                        else{
								                                                            echo "<i class='fa fa-star'></i>";      
								                                                        }
								                                                      
								                                                  }
				                                            				?>

																			<!-- <i class="fa fa-star"></i>
																			<i class="fa fa-star empty"></i> -->
																		</div>
																	</div>
																	<div class="review-comment-date">
																		<div class="review-date">
																			<span><?php echo date("d-m-Y",strtotime($lst['create_date'])); ?></span>
																		</div>
																	</div>
																</div>
																<p><?php echo $lst['message']; ?></p>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
		                                <?php
		                            }
                        		?>
								
							</div>
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