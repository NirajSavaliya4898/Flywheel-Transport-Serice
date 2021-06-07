<?php
    require "Config.php";
    $obj=new Config();
    	if(isset($_GET["id"])){
    	$wh["order_id"]=$_GET["id"];
    	$obj->myDelete("tbl_order",$wh);
    	$obj->Redirect("orderdisplay.php");
	}
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
						<h1>Your Order</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<a href="mydashboard.php">MyDeshboard</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Your Order</span>
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
							<!-- Filter option -->
							
							  
							  <!-- Button to Open the Modal -->

							
							<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
								<div class="card">
									
									<div class="card-body table-responsive">
										<table class="table  table-bordered  mytable">
                                    <thead>
                                       <tr>
                                            <th style="background-color:#fff;color:black;"><span class=""></span> No</th>
                                            <th style="background-color:#fff;color:black;"><span class=""></span> Order Date</th>
                                            <th style="background-color:#fff;color:black;"><span class=""></span> From Location</th>
                                            <th style="background-color:#fff;color:black;"><span class=""></span> To Location</th>
                                            <th style="background-color:#fff;color:black;"><span class=""></span> Vehicle Type</th>
                                            <th style="background-color:#fff;color:black;"><span class=""></span> Vehicle Plat No.</th>
                                            <th style="background-color:#fff;color:black;"><span class=""></span> Payment price</th>
                                            <th style="background-color:#fff;color:black;">Status</th>
                                            <th style="background-color:#fff;color:black;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                        <?php
                                          $Data_R=$obj->myQuery("SELECT c.name,o.* FROM `tbl_order` as o,`tbl_category` as c WHERE c.`category_id`=o.category_id and o.registration_id='".$obj->Registrationid($obj->UserKey)."' order by `order_id` desc");
                                        $no=0;
                                        while($res=$Data_R->fetch_assoc()) 
                                        {
                                            $no++;
                                        ?>
                                        <tr>
                                            <td style="color:black;"><?php echo $no; ?></td>

                                             

                                            <td style="color:black;"><?php echo date("d-m-Y", strtotime($res["order_date"])); ?></td>
                                            <td style="color:black;"><?php echo $res["from"]; ?></td>
                                            <td style="color:black;"><?php echo $res["to"]; ?></td>
                                            <td style="color:black;"><?php echo $res["name"]; ?></td>
                                            <td style="color:black;"><?php 
																		$vno=$obj->myQuery("select * from tbl_vehicle where vehicle_id={$res['vehicle_id']}")->fetch_assoc();

																		echo $vno["plate_no"];



																	?>
																</td>
                                            <td style="color:black;"><?php echo ($res["price"]=="")?"not set":$res["price"]; 
                                            	if($res["status"]=="E"){
                                                    ?><a href="payment.php?oid=<?php echo $res["order_id"]; ?>"> payment</a>
                                                    <?php
                                                }
                                            ?></td>
                                            <td style="color:black;">
                                                <?php if($res["status"]=="E"){
                                                    ?><span class="badge badge-success" style="background-color: yellow;color:black;">Confirm</span>
                                                    <?php
                                                }elseif($res["status"]=="S"){
                                                    ?><span class="badge badge-danger" style="background-color:green;">Success</span><?php
                                                }else{
                                                	?><span class="badge badge-danger" style="background-color:red;">Cancle</span><?php
                                                } ?>
                                            </td>
                                            <td> <a href="orderdisplay.php?id=<?php echo $res["order_id"]; ?>" onClick="return confirm('are you sure delete this record ?');"><span title="Delete"><i style="font-size:23px;" class="fa fa-trash-o" aria-hidden="true"></i>
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