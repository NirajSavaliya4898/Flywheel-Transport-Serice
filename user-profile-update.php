<?php
    require "Config.php";
    $obj=new Config();
    $obj->UserWall();

    if (isset($obj->UserKey)) 
    {
        if ($obj->RegisterType=="user") 
        {
             $Data=$obj->myQuery("SELECT * FROM `tbl_registration` where `email_id`='".$obj->UserKey."'")->fetch_assoc();
        }
        else
        {
            $error="<div  class=\"alert alert-success\">Something Is Wrong..</div>";
        }
    }
    $Country=$obj->myQuery("SELECT * FROM `tbl_location` WHERE `label`='country'");
    
    $u_city=$obj->myQuery("
            SELECT `location_id`,`name`,`parentkey` 
            FROM `tbl_location` 
            WHERE `label`='city' AND `location_id`='".$u_city['location_id']."'
                          ")->fetch_assoc();
    
    $u_state=$obj->myQuery("
        SELECT s.`location_id`,s.`name`,s.`parentkey` 
        FROM `tbl_location` as s,`tbl_location` as c 
        WHERE s.`location_id`=c.`parentkey` AND c.`location_id`='".$u_city['location_id']."' AND s.`label`='state' AND c.`label`='city'
                            ")->fetch_assoc();

     $u_country=$obj->myQuery("
        SELECT c.`location_id`, c.`name`
        FROM `tbl_location` AS s, `tbl_location` AS c 
        WHERE c.`location_id` = s.`parentkey` AND s.`location_id` = '".$u_state['location_id']."' AND s.`label`='state' AND c.`label`='country'
                            ")->fetch_assoc();

    
    $error="";
    if(isset($_POST['btn_send']))
    {
        if(file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) 
        { 
            unlink($obj->FileUploadPath.$Data['image']);

            $ext=".".pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
            $size=$_FILES["image"]["size"]/1024/1024;
            if ($size<5) 
            {
                $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                move_uploaded_file($_FILES["image"]["tmp_name"],$path);
                $InsData['image']=$obj->FileUploadName.$ext;                   
            }
            else
            {
                $error="<div class=\"alert alert-success\"Must select less then 5MB...</div>";
            }
        }
        
        $InsData["contactno"]=$_POST['contactno'];
        $InsData["dob"]=$_POST['dob'];
        $InsData["gender"]=$_POST['gender'];
        $InsData["address"]=$_POST['address'];
        $InsData["location_id"]=$_POST['city'];
        $InsData["google_map"]=$_POST['google_map'];
        $result= $obj->myUpdate("tbl_registration",$InsData,$where);
        if ($result>0) 
        {
            $obj->Redirect("user-profile-display.php");
        }else{            
            $error="<div  class=\"alert alert-success\">Profile Not Update..</div>";
        }
    }

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:02:51 GMT -->
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
						<!-- General Information -->
					<form method="post" enctype="multipart/form-data">	
						<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">

								<div class="avater-box">
								<img src="#"  id="myimg" alt="" class="img-responsive img-circle edit-avater" />
								<div class="upload-btn-wrapper">
								  <button class="btn theme-btn">Change Avatar</button>
								  <input type="file" name="image" id="myfile" />
								</div>
								</div>
								<h3><?php echo $Data['name']; ?></h3>
							</div>
							
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-12">
										<label>Phone</label>
										<input type="text" class="form-control" name="contactno" required="" value="<?php echo $Data['contactno'];  ?>">
									</div>
									<div class="col-sm-6">
										<label>DOB</label>
										<input class="form-control" type="date" id="dob" name="dob" value="<?php echo $Data['dob'];  ?>">
									</div>
									<div class="col-sm-6">
										<label class="px-5 mt-2">GENDER</label><br>
										<input type="radio" style="margin-top: 13px;margin-left: 17px;" name="gender" value="male"
											 <?php 
                                                        if ($Data['gender']=="male") 
                                                        {
                                                            ?> checked <?php
                                                        } 
                                                    ?> 
                                                
										> male
										<input type="radio" style="margin-left: 22px;" name="gender" value="female"
											<?php 
                                                        if ($Data['gender']=="female") 
                                                        {
                                                            ?> checked <?php
                                                        } 
                                            ?>
										> female
									</div>
								</div>
							
						</div>

						<!-- End General Information -->
						<div class="add-listing-box add-location mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">
								<i class="ti-location-pin theme-cl"></i>
								<h3>Location</h3>
							</div>
							
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-12">
										<label for="Address">Address</label>
                                         <input type="text" id="Address" name="address" class="form-control" value="<?php echo $Data['address'];  ?>">
									</div>
									<div class="col-sm-4">
										<label for="Country">Country</label><br>
                                        <select id="Country" name="Country" class="form-control">
                                           <option selected hidden value="<?php echo $u_country['location_id'];?>"><?php echo $u_country['name'];?></option>
                                                <?php 
                                                    while ($list=mysqli_fetch_assoc($Country)) 
                                                    {
                                                        ?>
                                                            <option value="<?php echo $list['location_id']; ?>"><?php echo $list['name'];?></option>
                                                        <?php    
                                                    }
                                                ?>
                                        </select>
									</div>
									<div class="col-sm-4">
										<label for="State">State</label><br>
                                        <select id="State" name="State" class="form-control">
                                            <option selected hidden value="<?php echo $u_state['location_id'];?>"><?php echo $u_state['name'];?></option>
                                        </select>
									</div>
									<div class="col-sm-4">
										<label for="City">City</label><br>
                                        <select id="City" name="city" class="form-control">
                                            <option selected hidden value="<?php echo $u_city['location_id'];?>"><?php echo $u_city['name'];?></option>
                                        </select>
									</div>
									
									
									<div class="col-sm-12">
										<label for="google_map">GoogleMap</label>
                                         <input type="text" id="Address" name="google_map" class="form-control" value="<?php echo $Data['google_map'];  ?>">
									</div>
								</div>
							
						</div>
						<!-- End Edit Location -->
								<div class="center">
										<button type="submit" name="btn_send" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200"> Update </button>
										<?php
			                    			echo  $error;
			                  			?>
								</div>
					</form>	
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

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:02:51 GMT -->
</html>