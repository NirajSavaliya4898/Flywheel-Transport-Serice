<?php
    require "Config.php";
    $obj=new Config();
    $obj->UserWall();
    $error="";
    	if (isset($obj->UserKey))
    	{
    			if ($obj->RegisterType=="user") 
		        {
		            $obj->Redirect("mydashboard.php");
		        }
		        else
		        {
		        	 	if (isset($_GET['Eid'])) 
			            {
			                $u_gallery=$obj->myQuery("SELECT * FROM `tbl_gallery` WHERE  `gallery_id`='".$_GET['Eid']."'")->fetch_assoc();
			            }
			            if (isset($_POST['btn_send'])) 
			            {
			                if(!isset($_GET["Eid"]))
			                {
			                	if(file_exists($_FILES['path']['tmp_name']) || is_uploaded_file($_FILES['path']['tmp_name'])) 
			                    {
			                        $ext=".".pathinfo($_FILES["path"]["name"],PATHINFO_EXTENSION);
			                        $size=$_FILES["image"]["size"]/1024/1024;
			                        if ($size<5) 
			                        {
			                            $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
			                            move_uploaded_file($_FILES["path"]["tmp_name"],$path);
			                            $InsData["title"]=$_POST['title'];
			                            $InsData["path"]=$obj->FileUploadName.$ext;
			                            $InsData["description"]=$_POST['description'];
			                            $InsData["remote_ip"] = $obj->remote_ip;
							            $InsData["create_date"] = $obj->currentDate;
							            $InsData["modify_date"] = $obj->currentDate; 
							            $InsData["business_id"]=$obj->Businessid($obj->UserKey);
			                            $result=$obj->myInsert("tbl_gallery",$InsData);
			                            if ($result>0) 
			                            {
			                                $obj->Redirect("gallery.php");
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
			                	if(file_exists($_FILES['path']['tmp_name']) || is_uploaded_file($_FILES['path']['tmp_name'])) 
			                    {
			                        $ext=".".pathinfo($_FILES["path"]["name"],PATHINFO_EXTENSION);
			                        $size=$_FILES["path"]["size"]/1024/1024;
			                        if ($size<5) 
			                        {
			                            unlink($obj->FileUploadPath.$u_gallery['path']);
			                            $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
			                            move_uploaded_file($_FILES["path"]["tmp_name"],$path);     
			                            $InsData["path"]=$obj->FileUploadName.$ext; 
			                        }
			                        else
			                        {
			                            $error="<div  class=\"alert alert-success\">Must select less then 5MB...</div>";
			                        }
			                    }
			                   $InsData["title"]=$_POST['title'];
			                    $InsData["description"]=$_POST['description'];
			                    $where['gallery_id']=$_GET['Eid'];
			                    $result=$obj->myUpdate("tbl_gallery",$InsData,$where);
			                    if ($result>0) 
			                    {
			                        $obj->Redirect("gallery.php");
			                    }else{
			                        $error="<div  class=\"alert alert-success\">Something is Wrong...</div>";
			                    }
			                }    
			                    
			            }
		        }
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
						<h1>Gallery</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<a href="mydeshboard.php">MyDeshboard</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Gallery</span>
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
									<a href="gallery.php" class="btn btn-black">Go back</a>
										
									</div>
								</div>
							<div class="col-md-12">
						<!-- General Information -->
						<div class="add-listing-box full-detail mrg-top-25 mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">
								<i class="ti-gallery theme-cl"></i>
								<?php
								if(isset($_GET["Eid"]))
								{
									?>
									<h3>Update Gallery</h3>
									<?php
								}
								else
								{
									?>
									<h3>Add Gallery</h3>
									<?php
								}
							?>		
								
							</div>
							<form method="post" enctype="multipart/form-data">
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-12">
										<label>Title</label>
										<input type="text" class="form-control" name="title" required="" value="<?php if (isset($_GET['Eid'])) { echo $u_gallery['title']; } ?>">
									</div>	
									<div class="col-sm-12">
										<label>Upload Image</label>
										<input type="file" name="path" class="form-control" required="">
									</div>
									<div class="col-sm-12">
										<label>Description</label>
										<textarea class="h-100 form-control" name="description" required=""><?php if (isset($_GET['Eid'])) { echo $u_gallery['description']; } ?></textarea>
									</div>
								</div>
								<div class="center">
									<button type="submit" name="btn_send" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200"> 
										 <?php
                                                        if (isset($_GET['Eid'])) 
                                                        {
                                                            echo("Edit");
                                                        }
                                                        else{
                                                            echo("Add");
                                                        }
                                                    ?>
									</button>
									<?php
									 echo $error;
									?>
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