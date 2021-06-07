<?php
	 require 'Config.php';
     $obj=new Config();
	
	 $obj->UserWall();
    if (isset($obj->UserKey)) 
    {
        if ($obj->RegisterType=="business") 
        {
             $Data=$obj->myQuery("SELECT * FROM `tbl_business` where `email_id`='".$obj->UserKey."'")->fetch_assoc();
            if($Data['contactno']!="" AND $Data['address']!="")
            {
                 $obj->Redirect("business-profile-display.php");
            }
        }
        else
        {
            $obj->Redirect("business-profile.php");
        }
    }
    $Country=$obj->myQuery("SELECT * FROM `tbl_location` WHERE `label`='country'");
    $Main_Category=$obj->myQuery("SELECT * FROM `tbl_category` WHERE `label`='main'");
    $error="";
    if(isset($_POST['btn_send']))
    {

    	 $category= implode(",",$_POST["category_id"] );
               
        if(file_exists($_FILES['logo']['tmp_name']) || is_uploaded_file($_FILES['logo']['tmp_name']) && file_exists($_FILES['visiting_card']['tmp_name']) || is_uploaded_file($_FILES['visiting_card']['tmp_name']) && file_exists($_FILES['certificate']['tmp_name']) || is_uploaded_file($_FILES['certificate']['tmp_name'])) 
        {
            $ext=".".pathinfo($_FILES["logo"]["name"],PATHINFO_EXTENSION);
            $ext2=".".pathinfo($_FILES["visiting_card"]["name"],PATHINFO_EXTENSION);
            $ext3=".".pathinfo($_FILES["certificate"]["name"],PATHINFO_EXTENSION);
            $size=$_FILES["logo"]["size"]/1024/1024;
            $size2=$_FILES["visiting_card"]["size"]/1024/1024;
            $size3=$_FILES["certificate"]["size"]/1024/1024;
            if ($size<5 && $size2<5 && $size3<5 )
            {
                $path=$obj->FileUploadPath.$obj->FileUploadName."logo".$ext;           
                move_uploaded_file($_FILES["logo"]["tmp_name"],$path);

                $path2=$obj->FileUploadPath.$obj->FileUploadName."vc".$ext2;           
                move_uploaded_file($_FILES["visiting_card"]["tmp_name"],$path2);
                
                $path3=$obj->FileUploadPath.$obj->FileUploadName."ct".$ext3;           
                move_uploaded_file($_FILES["certificate"]["tmp_name"],$path3);
                $InsData["contactno"]=$_POST['contactno'];
                $InsData["address"]=$_POST['address'];
                $InsData["location_id"]=$_POST['city'];
                
                $InsData["category_id"]=$category;


                $InsData["google_map"]=$_POST['google_map'];
                $InsData["logo"]=$obj->FileUploadName."logo".$ext;
               	$InsData["visiting_card"]=$obj->FileUploadName."vc".$ext2;
               	$InsData["certificate"]=$obj->FileUploadName."ct".$ext3;
               	
                $where['email_id']= (isset($obj->UserKey)) ?  $Data['email_id'] : null;
                $result= $obj->myUpdate("tbl_business",$InsData,$where);
                if ($result>0) 
                {
                      $obj->Redirect("business-profile-display.php");
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
            $error="<div  class=\"alert alert-success\">Document Not Selected..</div>";
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
								<img src="#"  id="myimg" alt=""  class="img-responsive img-circle edit-avater uprofile"/>
								<div class="upload-btn-wrapper">
								  <button class="btn theme-btn">Company Logo</button>
								  <input type="file" name="logo" id="myfile" />
								</div>
								</div>
								<h3><?php echo $Data['name']; ?></h3>
							</div>
							
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-12">
										<label>Phone</label>
										<input type="text" class="form-control" name="contactno" required="">
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
                                         <input type="text" id="Address" name="address" class="form-control">
									</div>
									<div class="col-sm-4">
										<label for="Country">Country</label><br>
                                        <select id="Country" name="Country" class="form-control">
                                           <option selected hidden value="">Select Country</option>
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
                                        <select id="State" class="form-control">
                                            <option selected hidden value="">Select State</option>
                                        </select>
									</div>
									<div class="col-sm-4">
										<label for="City">City</label><br>
                                        <select id="City" name="city" class="form-control">
                                            <option selected hidden value="">Select City</option>
                                        </select>
									</div>
									<div class="col-sm-6">
										 <label for="Main_Category">Main Category</label>
                                        <select id="Main_Categorys" data-bvalidator="required" class="form-control">
                                           <option selected hidden value="">Select Main Category</option>
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
                                        <div id="Sub_Category" >
                                           
                                        </div>
									</div>
									
									
									<div class="col-sm-12">
										<label for="google_map">GoogleMap</label>
                                         <input type="text" id="Address" name="google_map" class="form-control">
									</div>
								</div>
						</div>
						<div class="add-listing-box full-detail mrg-bot-25 padd-bot-30 padd-top-25">
									<div class="listing-box-header">
										<i class="ti-gallery theme-cl"></i>
										<h3>Add Gallery</h3>
										<label>Upload Your Company Visiting Card And Certificate</label>
                                         <input type="file" name="visiting_card" class="form-control" />
                                         <input type="file" name="certificate" class="form-control"  />
									</div>						
						</div>
						<!-- End Edit Location -->
								<div class="center">
										<button type="submit" name="btn_send" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200"> Submit </button>
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