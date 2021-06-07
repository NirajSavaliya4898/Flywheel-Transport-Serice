<?php
	 require 'Config.php';
     $obj=new Config();
	
	 $obj->UserWall();
//     $data=$obj->myQuery("SELECT country.name as country,state.name as state,city.name as city,d.* FROM `tbl_driver` as d,`tbl_location` as city,`tbl_location` as state,`tbl_location` as country WHERE  d.`driver_id`='".$_GET['id']."' and city.`location_id`=d.`location_id` and
// state.`location_id`=city.`parentkey` and country.`location_id`=state.`parentkey`");
    $Country=$obj->myQuery("SELECT * FROM `tbl_location` WHERE `label`='country'");

    $u_city=$obj->myQuery("
            SELECT `location_id`,`name`,`parentkey` 
            FROM `tbl_location` 
            WHERE `label`='city' AND `location_id`='".$u_driver['location_id']."'
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
			if (isset($_GET['id'])) 
            {
                $u_driver=$obj->myQuery("SELECT * FROM `tbl_driver` WHERE `business_id`='".$obj->Businessid($obj->UserKey)."'")->fetch_assoc();
            }
		    if (isset($_POST['btn_send'])) 
            {
                if(!isset($_GET["id"]))
                {
                	if(file_exists($_FILES['profile']['tmp_name']) || is_uploaded_file($_FILES['profile']['tmp_name']) && file_exists($_FILES['proof']['tmp_name']) || is_uploaded_file($_FILES['proof']['tmp_name'])) 
                    {
                        $ext=".".pathinfo($_FILES["profile"]["name"],PATHINFO_EXTENSION);
			            $ext2=".".pathinfo($_FILES["proof"]["name"],PATHINFO_EXTENSION);
			            $size=$_FILES["profile"]["size"]/1024/1024;
			            $size2=$_FILES["proof"]["size"]/1024/1024;
                        if ($size<5 && $size2<5) 
                        {
                             $path=$obj->FileUploadPath.$obj->FileUploadName."profile".$ext;           
			                 move_uploaded_file($_FILES["profile"]["tmp_name"],$path);

			                 $path2=$obj->FileUploadPath.$obj->FileUploadName."proof".$ext2;           
    						 move_uploaded_file($_FILES["proof"]["tmp_name"],$path2);

                            $InsData["name"]=$_POST['name'];
			                $InsData["contactno"]=$_POST['contactno'];
			                $InsData["address"]=$_POST['address'];
			                $InsData["email_id"]=$_POST['email_id'];
			                $InsData["location_id"]=$_POST['city'];
			               	$InsData["business_id"]=$obj->businessid($obj->UserKey);
			                $InsData["profile"]=$obj->FileUploadName."profile".$ext;
			               	$InsData["proof"]=$obj->FileUploadName."proof".$ext2;
                            $result=$obj->myInsert("tbl_driver",$InsData);
                            if ($result>0) 
                            {
                                $obj->Redirect("driver.php");
                            }else{
                                
                                 $error="<div  class=\"alert alert-success\">Something is Wrong...</div>";
                            }
                        }
                        else
                        {
                             $error="<div  class=\"alert alert-success\">Must select less then 5MB...</div>";
                        }
                    }
                    else
                    {
                        
                        $error="<div  class=\"alert alert-success\">Image Not Selected..</div>";
                    }	
                }
                else
                {
                	if(file_exists($_FILES['profile']['tmp_name']) || is_uploaded_file($_FILES['profile']['tmp_name']) && file_exists($_FILES['proof']['tmp_name']) || is_uploaded_file($_FILES['proof']['tmp_name'])) 
                    {
                        $ext=".".pathinfo($_FILES["profile"]["name"],PATHINFO_EXTENSION);
			            $ext2=".".pathinfo($_FILES["proof"]["name"],PATHINFO_EXTENSION);
			            $size=$_FILES["profile"]["size"]/1024/1024;
			            $size2=$_FILES["proof"]["size"]/1024/1024;
                        if ($size<5 && $size2<5) 
                        {
                            unlink($obj->FileUploadPath.$u_driver['profile']);
                            $path=$obj->FileUploadPath.$obj->FileUploadName."profile".$ext;           
			                move_uploaded_file($_FILES["profile"]["tmp_name"],$path);

                            unlink($obj->FileUploadPath.$u_driver['proof']);
                            $path2=$obj->FileUploadPath.$obj->FileUploadName."proof".$ext2;           
    						move_uploaded_file($_FILES["proof"]["tmp_name"],$path2);
                            
                            $InsData["profile"]=$obj->FileUploadName."profile".$ext;
			               	$InsData["proof"]=$obj->FileUploadName."proof".$ext2;
                        }
                        else
                        {
                            $error="<div  class=\"alert alert-success\">Must select less then 5MB...</div>";
                        }
                    }
                    		$InsData["name"]=$_POST['name'];
			                $InsData["contactno"]=$_POST['contactno'];
			                $InsData["address"]=$_POST['address'];
			                $InsData["email_id"]=$_POST['email_id'];
			                $InsData["location_id"]=$_POST['city'];
			               	$InsData["business_id"]=$obj->businessid($obj->UserKey);
                    		$result=$obj->myUpdate("tbl_driver",$InsData,$where);
                    		if ($result>0) 
                    		{
                        		$obj->Redirect("driver.php");
                    		}else{
                        	$error="<div  class=\"alert alert-success\">Something is Wrong...</div>";
                    		}
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
					<div class="title-content">
						
						<?php
							if($_GET["id"])
							{?>
								<h1>EDIT DRIVER DETAIL</h1>
								<?php
							}
							else
							{?>
								<h1>ADD DRIVER DETAIL</h1>
								<?php
						    }
						    ?>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<a href="business-mydashboard.php">My Dashboard</a>
							<span class="gt3_breadcrumb_divider"></span>
							<?php
							if($_GET["id"])
							{?>
								<span class="current">EDIT DRIVER DETAIL</span>
								<?php
							}
							else
							{?>
								<span class="current">ADD DRIVER DETAIL</span>
								<?php
						    }
						    ?>

							
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>

			<section class="padd-top-0 padd-bot-0 overlap">
				<div class="container">
					<div class="row">
						
					</div>
				</div>
			</section>

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
						<div class="col-md-8 col-sm-12">
								<div class="col-md-12">
									<div class="layout-option pull-right">
									<a href="business-mydashboard.php" class="btn btn-success">Go back</a>
									</div>
								</div>			
								<form method="post" enctype="multipart/form-data">	

									<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-25">
										<div class="listing-box-header">

											<div class="avater-box">
											<img src="#"  id="myimg" alt=""  class="img-responsive img-circle edit-avater uprofile"/>
											<div class="upload-btn-wrapper">
											  <button class="btn theme-btn">Profile Photo</button>
											  <input type="file" name="profile" id="myfile" />
											</div>
											</div>
										</div>
										
											<div class="row mrg-r-10 mrg-l-10">
												<div class="col-sm-12">
													<label>Name</label>
													<input type="text" class="form-control" name="name" required="" value="<?php echo $u_driver['name'];  ?>">
												</div>
												<div class="col-sm-6">
													<label>Phone</label>
													<input type="text" class="form-control" name="contactno" required="" value="<?php echo $u_driver['contactno'];  ?>">
												</div>
												<?php
												  if(!$_GET["id"])
												  	{?>
												  		<div class="col-sm-6">
															<label>Email</label>
															<input type="email" class="form-control" name="email_id" required="" value="<?php echo $u_driver['email_id'];  ?>">
														</div>
												  		<?php
												  	}
												  ?>	
												<div class="col-sm-12">
													<label>Proof</label>
													<input type="file" name="proof" class="form-control" />
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
			                                         <input type="text" id="Address" name="address" class="form-control" value="<?php echo $u_driver['address'];  ?>">
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
											</div>
									</div>
						<!-- End Edit Location -->
										<div class="center">
												<button type="submit" name="btn_send" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200"> 

													 <?php
                                                        if (isset($_GET['id'])) 
                                                        {
                                                            echo("Edit");
                                                        }
                                                        else{
                                                            echo("Add");
                                                        }
                                                    ?>
												</button>
												<?php
					                    			echo  $error;
					                  			?>
										</div>
								</form>			
						</div>
					</div>
				</div>
			</section>
			<!-- ================ End Page Title ======================= -->
			
			<!-- ================ Edit Section Start ======================= -->
			
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