<?php
    require "Config.php";
    $obj=new Config();
    	if(isset($_GET["id"])){
    	$myUpdate["status"]='D';
    	$wh["order_id"]=$_GET["id"];
    	$obj->myUpdate("tbl_order",$myUpdate,$wh);
    	$obj->Redirect("business-myorder.php");
	}
	if(isset($_POST["btn"]))
	{
		$myUpdate["price"]=$_POST["price"];
    	$myUpdate["vehicle_id"]=$_POST["vehicle_id"];
    	$wh["order_id"]=$_POST["order_id"];
    	
    	$obj->myUpdate("tbl_order",$myUpdate,$wh);
    	$obj->Redirect("business-myorder.php");	
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
									<div class="col-md-12 col-sm-12">
								<div class="panel-group style-1" id="accordion" role="tablist" aria-multiselectable="true">
									<?php
										$j=0;
										$bdisplay=$obj->myQuery("SELECT r.name, mainc.name as main, cat.name AS category,cat.category_id, o.* FROM `tbl_order` AS o, `tbl_registration` AS r, `tbl_category` AS cat, `tbl_category` as mainc WHERE o.business_id ='".$obj->Businessid($obj->UserKey)."' AND r.registration_id = o.registration_id AND cat.category_id = o.category_id and mainc.category_id=cat.parentkey and o.category_id=cat.category_id");
										while ($res=$bdisplay->fetch_assoc()) 
										{
											$j++;
											?>
												<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="designing">
														<h4 class="panel-title">
															<a class="px-4 py-4" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $j; ?>" aria-expanded="true" aria-controls="collapseOne" style="font-size: 14px">
                                    		 						<span class="pl-3"><?php echo $j; ?>&nbsp;&nbsp;|</span>
																	<span class="glyphicon glyphicon-user pl-3 pr-2" style="color: black;font-size: 16px;"></span>
																	<?php echo $res["name"]; ?>
															 </a>
														</h4>
													</div>
													<div id="collapse<?php echo $j; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="designing">
														<div class="panel-body">
															<?php
																$oid=$res["order_id"];
															?>
															<table class="table table-striped table-bordered" >
																<tr>
																	<td><span class="glyphicon glyphicon-calendar pr-2"></span>Date</td>
																	<td><?php echo  date("m-d-Y", strtotime($res["order_date"])) ?></td>
																</tr>
																<tr>
																	<td><span class="glyphicon glyphicon-menu-left pr-2"></span>From</td>
																	<td><?php echo $res["from"]; ?></td>
																</tr>
																<tr>
																	<td><span class="glyphicon glyphicon-menu-right pr-2"></span>To</td>
																	<td><?php echo $res["to"]; ?></td>
																</tr>
																<tr>
																	<td><span class="fa fa-cubes pr-2"></span>Avg Weight</td>
																	<td><?php echo $res["avg_weight"]; ?></td>
																</tr>
																<tr>
																	<td><span class="glyphicon glyphicon-calendar pr-2"></span>Day</td>
																	<td><?php echo $res["day"]; if($res["day"]==1){ echo ' Day'; }else{ echo' Days'; } ?> </td>
																</tr>
																<tr>
																	<td><?php
																			if ($res["main"]=="Truck") 
																			{
																				?>
																					<i class="fa fa-truck"></i>
																				<?php
																			}else if($res["main"]=="Flight"){
																				?>
																					<i class="fa fa-plane"></i>
																				<?php
																			}
																			else if($res["main"]=="Ship"){
																				?>
																					<i class="fa fa-ship"></i>
																				<?php
																			}
																		?> Vehicle Type</td>
																	<td><?php echo $res["category"]; ?></td>
																</tr>
																<tr>
																	<td><?php
																			if ($res["main"]=="Truck") 
																			{
																				?>
																					<i class="fa fa-truck"></i>
																				<?php
																			}else if($res["main"]=="Flight"){
																				?>
																					<i class="fa fa-plane"></i>
																				<?php
																			}
																			else if($res["main"]=="Ship"){
																				?>
																					<i class="fa fa-ship"></i>
																				<?php
																			}
																		?> Vehicle Number</td>
																	<td><?php 
																		$vno=$obj->myQuery("select * from tbl_vehicle where vehicle_id={$res['vehicle_id']}")->fetch_assoc();

																		echo $vno["plate_no"];



																	?></td>
																</tr>
																<tr>
																	<td><span class="fa fa-road pr-2"></span>Status</td>
																	<td>
																		  <?php if($res["status"]=="E"){
							                                                    ?><span class="badge badge-success" style="background-color: yellow;color:black;">Confirm</span>
							                                                    <?php
							                                                }elseif($res["status"]=="S"){
							                                                    ?><span class="badge badge-danger" style="background-color:green;">Success</span><?php
							                                                }else{
							                                                	?><span class="badge badge-danger" style="background-color:red;">Cancle</span><?php
							                                                } ?>
																	</td>
																</tr>
															</table>	
																	<?php
																	   if($res["status"]=="E")
																	   {
																	   	 ?>
																	   	 	<form method="post">
																			   	 <div class="row">
																					<div class="col-sm-5">
																						<input type="text" name="price" value="<?php echo $res["price"]; ?>" class="form-control" placeholder="Enter the total bill Amount">
																					</div>
																					<div class="col-sm-5">
																						<select name="vehicle_id" class="form-control">
																							<option> --Select Vehicle Plate Number--</option>
																							<?php
																								$vdata=$obj->myQuery("select * from  tbl_vehicle where category_id='{$res['category_id']}' and business_id ='".$obj->Businessid($obj->UserKey)."'");

																								while ($vrow=$vdata->fetch_assoc()) {
																									?>
																									<option value="<?php echo $vrow["vehicle_id"]; ?>"><?php echo $vrow["plate_no"]; ?></option>
																									<?php
																								}
																							?>	
																						</select>
																						<input type="hidden" name="order_id" class="form-control" value="<?php echo $res["order_id"]; ?>">
																					</div>
																					<div class="col-sm-2">
																						<button class="btn btn-success" name="btn" type="submit">Send to User</button>
																					</div>
																				</div>
																	   	 	</form>
																	   	 <?php
																	   }
																	?>
																
															
															<div class="row mb-4">
																<div class="col-md-12 text-right">
																	<?php 
																		if($res["status"]=="E")
																	{
																		?>
																	<a href="business-myorder.php?id=<?php echo $res["order_id"]; ?>" onClick="return confirm('are you sure Cancel this record ?');"><span title="Delete" class="badge" style="background-color: red">Cancel</span>
                                                                    </span></a>
                                                                    <?php
                                                                }
                                                                ?>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php
										}
									?>
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