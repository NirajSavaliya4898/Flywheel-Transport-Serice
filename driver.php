<?php
    require "Config.php";
    $obj=new Config();
    $obj->UserWall();
    
        	
             $Data_R=$obj->myQuery("SELECT * FROM `tbl_driver` WHERE `business_id`='".$obj->Businessid($obj->UserKey)."'");
            //$Data_R=$obj->myQuery("select * from tbl_driver ORDER by banner_id DESC");
            if(isset($_GET["id"])){
    	$wh["driver_id"]=$_GET["id"];
    	$obj->myDelete("tbl_driver",$wh);
    	$obj->Redirect("driver.php");
	}
            
    $error="";

?>
<!DOCTYPE html>
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
						<h1>DRIVER</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<a href="business-mydashboard.php">My Dashboard</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">DRIVER</span>
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
			<section class="padd-top-50">
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
						
								<div class="row mrg-0 mrg-bot-20">
								<div class="col-md-6">
									<h3>Our Driver</h3>
								</div>
								<div class="col-md-6">
									<div class="layout-option pull-right">
									<a href="adddriver.php" class="btn btn-success">Add Driver</a>
										
									</div>
								</div>
							</div>
							<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
								<div class="card">
									
									<div class="card-body table-responsive">
										<table class="table  table-bordered  mytable" >
                                    <thead>
                                       <tr>
                                            <th>No</th>
                                            <th>Profile Photo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Proof</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                        <?php
                                         $Data_R=$obj->myQuery("SELECT * FROM `tbl_driver` WHERE `business_id`='".$obj->Businessid($obj->UserKey)."'");
                                        $no=0;
                                        while($res=$Data_R->fetch_assoc()) 
                                        {
                                            $no++;
								             $City=$obj->myQuery("SELECT `name`,`parentkey` FROM `tbl_location` WHERE `location_id`='".$res['location_id']."' AND `label`='city'")->fetch_assoc();
								           
								            $State=$obj->myQuery("SELECT `name`,`parentkey` FROM `tbl_location` WHERE `location_id`='".$City['parentkey']."' AND `label`='state'")->fetch_assoc();
								            $Country=$obj->myQuery("SELECT `name` FROM `tbl_location` WHERE `location_id`='".$State['parentkey']."' AND `label`='country'")->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>

                                             <td><img src="<?php echo $obj->WebPath.$res["profile"]; ?>" class="zoom-img" width="100px"/></td>
                                            <td><?php echo $res["name"]; ?></td>
                                            <td><?php echo $res["email_id"]; ?></td>
                                            <td><?php echo $res["contactno"]; ?></td>
                                            <td><img src="<?php echo $obj->WebPath.$res["proof"]; ?>" class="zoom-img" width="100px"/></td>
                                            <td><?php echo $res["address"]; ?></td>
                                            <td><?php echo $City["name"]; ?></td>
                                            <td><?php echo $State["name"]; ?></td>
                                            <td><?php echo $Country["name"]; ?></td>
                                            <td><a href="adddriver.php?id=<?php echo $res["driver_id"]; ?>"><span  title="Update"><i style="font-size:23px;margin-left: 10px;" class="fa fa-pencil-square-o text-center" aria-hidden="true"></i>
                                                         </span></a>                                         
                                                 
                                                 <a href="driver.php?id=<?php echo $res["driver_id"]; ?>" onClick="return confirm('are you sure delete this record ?');"><span title="Delete"><i style="font-size:23px;" class="fa fa-trash-o" aria-hidden="true"></i>
                                                         </span></a></td>  
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
									</div>
								</div>
							</div>
							
						</div>

						</div>    
					</div>
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
