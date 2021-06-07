<?php
	 require 'Config.php';
     $obj=new Config();
	
	 $obj->UserWall();

	 $driver=$obj->myQuery("SELECT * FROM `tbl_driver`");   	
    $Country=$obj->myQuery("SELECT * FROM `tbl_location` WHERE `label`='country'");
     $Main_Category=$obj->myQuery("SELECT * FROM `tbl_category` WHERE `label`='main'");

     $up_sub_category=$obj->myQuery("
           SELECT `category_id`,`name`,`parentkey` 
           FROM `tbl_category` 
           WHERE `category_id`='".$Data['category_id']."' AND  `label`='sub'
                          ")->fetch_assoc();

    $up_main_category=$obj->myQuery("
           SELECT m.`name`,m.`category_id` 
           FROM `tbl_category` as s,`tbl_category` as m 
           WHERE s.`parentkey`=m.`category_id` AND s.`category_id`='".$up_sub_category['category_id']."' AND  m.`label`='main'
                          ")->fetch_assoc();

    $error="";
			if (isset($_GET['id'])) 
            {
                $u_vehicle=$obj->myQuery("SELECT * FROM `tbl_vehicle` WHERE `business_id`='".$obj->Businessid($obj->UserKey)."'")->fetch_assoc();
            }
		    if (isset($_POST['btn_send'])) 
            {
                if(!isset($_GET["id"]))
                {
                	if(file_exists($_FILES['proof']['tmp_name']) || is_uploaded_file($_FILES['proof']['tmp_name'])) 
                    {
			            $ext=".".pathinfo($_FILES["proof"]["name"],PATHINFO_EXTENSION);
			            $size=$_FILES["proof"]["size"]/1024/1024;
                        if ($size<5) 
                        {
                             
			                 $path=$obj->FileUploadPath.$obj->FileUploadName."proof".$ext;           
    						 move_uploaded_file($_FILES["proof"]["tmp_name"],$path);

                            $InsData["plate_no"]=$_POST['plate_no'];
                            $InsData["category_id"]=$_POST['category_id'];
                            $InsData["driver_id"]=$_POST['driver_id'];
			                $InsData["weight"]=$_POST['weight'];
			               	$InsData["business_id"]=$obj->businessid($obj->UserKey);
			               	$InsData["proof"]=$obj->FileUploadName."proof".$ext;
			               	$InsData["remote_ip"] = $obj->remote_ip;
				            $InsData["create_date"] = $obj->currentDate;
				            $InsData["modify_date"] = $obj->currentDate; 
                            $result=$obj->myInsert("tbl_vehicle",$InsData);
                            if ($result>0) 
                            {
                                $obj->Redirect("vehicle.php");
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
                	if(file_exists($_FILES['proof']['tmp_name']) || is_uploaded_file($_FILES['proof']['tmp_name'])) 
                    {
                        $ext=".".pathinfo($_FILES["proof"]["name"],PATHINFO_EXTENSION);
			            $size=$_FILES["proof"]["size"]/1024/1024;
                        if ($size<5) 
                        {
                            unlink($obj->FileUploadPath.$u_vehicle['proof']);
                            $path=$obj->FileUploadPath.$obj->FileUploadName."proof".$ext;           
    						move_uploaded_file($_FILES["proof"]["tmp_name"],$path);
                           
			               	$InsData["proof"]=$obj->FileUploadName."proof".$ext;
                        }
                        else
                        {
                            $error="<div  class=\"alert alert-success\">Must select less then 5MB...</div>";
                        }
                    }
                    		$InsData["plate_no"]=$_POST['plate_no'];
                            $InsData["category_id"]=$_POST['category_id'];
                            $InsData["driver_id"]=$_POST['driver_id'];
			                $InsData["weight"]=$_POST['weight'];
			               	$InsData["business_id"]=$obj->businessid($obj->UserKey);
			               	$InsData["proof"]=$obj->FileUploadName."proof".$ext;
			               	$InsData["remote_ip"] = $obj->remote_ip;
				            $InsData["create_date"] = $obj->currentDate;
				            $InsData["modify_date"] = $obj->currentDate;
				            $where['vehicle_id']=$_GET['id'];
                    		$result=$obj->myUpdate("tbl_vehicle",$InsData,$where);
                    		if ($result>0) 
                    		{
                        		$obj->Redirect("vehicle.php");
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
    <style type="text/css">
    	.btn-ll
    	{
    		background: #ff431e !important;
    		color: #fff !important;
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
				<section class="title-transparent page-title" style="background:url(assets/img/title-bg.jpg);">
				<div class="container">
					<div class="title-content">
						
						<?php
							if($_GET["id"])
							{?>
								<h1>EDIT VEHICLE DETAIL</h1>
								<?php
							}
							else
							{?>
								<h1>ADD VEHICLE DETAIL</h1>
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
								<span class="current">EDIT VEHICLE DETAIL</span>
								<?php
							}
							else
							{?>
								<span class="current">ADD VEHICLE DETAIL</span>
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
											<!-- <div class="listing-box-header">
												<i class="ti-location-pin theme-cl"></i>
												<h3>Location</h3>
											</div> -->
											<div class="row mrg-r-10 mrg-l-10">
												<div class="col-sm-6">
													 <label for="Main_Category">Main Category</label>
			                                        <select id="Main_Category" data-bvalidator="required" class="form-control">
			                                           <option selected hidden value="<?php echo $up_main_category['category_id']; ?>"><?php echo $up_main_category['name']; ?></option>
			                                                <?php 
			                                                    while ($list=mysqli_fetch_assoc($Main_Category)) 
			                                                    {
			                                                        ?>
			                                                            <option value="<?php echo $list['category_id']; ?>"><?php echo $list['name'];?></option>
			                                                        <?php    
			                                                    }
			                                                ?>
			                                        </select>
												</div>
												<div class="col-sm-6">
													<label for="Sub_Category">Sub Category</label>
			                                        <select id="Sub_Category" name="category_id" data-bvalidator="required" class="form-control">
			                                            <option selected hidden value="<?php echo $up_sub_category['category_id']; ?>"><?php echo $up_sub_category['name']; ?></option>
			                                        </select>
												</div>
												<div class="col-sm-6">
													<label>Proof</label>
													<input type="file" name="proof" class="form-control" />
												</div>
												<div class="col-sm-6">
													<label for="driver">Driver</label><br>
			                                        <select id="driver" class="form-control" name="driver_id">
			                                            <option selected hidden value="">Select Driver</option>
			                                            <?php 
			                                                    while ($list=mysqli_fetch_assoc($driver)) 
			                                                    {
			                                                        ?>
			                                                            <option value="<?php echo $list['driver_id']; ?>"><?php echo $list['name'];?></option>
			                                                        <?php    
			                                                    }
			                                                ?>
			                                        </select>
												 </div>
												<div class="col-sm-6">
													<label>Plate Number</label>
													<input type="text" class="form-control" name="plate_no" required="" value="<?php echo $u_vehicle['plate_no'];  ?>">
												</div>
												<div class="col-sm-6">
													<label>Weight</label>
													<input type="text" class="form-control" name="weight" required="" value="<?php echo $u_vehicle['weight'];  ?>">
												</div>
									</div>

									<!-- End General Information -->
						<!-- End Edit Location -->
										<div class="center">
												<button type="submit" name="btn_send" id="subscribe" class="btn-ll mt-3 btn btn-midium width-200 py-3 btn-radius ">

													 <?php 
														if(!$_GET["id"])
														{
															echo "ADD";
														}
														else
														{
															echo "EDIT";
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