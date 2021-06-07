<?php
    require "Config.php";
    $obj=new Config();
    $obj->UserWall();
    $error="";
    if(isset($obj->UserKey))
    {
 		$bank=$obj->myQuery("SELECT * FROM `tbl_bank`");   	
    	if ($obj->RegisterType=="user") 	
    	{
    		if(isset($_POST["btn_send"]))
    		{
    		    $count=$obj->myQuery("select * from tbl_add_bank where add_bank_id='".$_POST["add_bank_id"]."'")->num_rows;
    		    if($count==0) 
    		    {
	    		 	 $InsData["bank_id"]=$_POST['bank_id'];
				     $InsData["account_no"]=$_POST['account_no'];
				     $InsData["card_number"]=$_POST['card_number'];
				     $InsData["card_holdername"]=$_POST['card_holdername'];
				     $InsData["cvv"]=$_POST['cvv'];
				     $InsData["expire_date"]=$_POST['mm']."-".$_POST['yyyy'];
				     $InsData["remote_ip"] = $obj->remote_ip;
					 $InsData["create_date"] = $obj->currentDate;
					 $InsData["modify_date"] = $obj->currentDate; 
					 $InsData["registration_id"]=$obj->Registrationid($obj->UserKey);
					 $InsData["wallet"]=rand(20000,100000);
				     $result=$obj->myInsert("tbl_add_bank",$InsData);
				     if ($result>0) 
				     {
				         $obj->Redirect("bank.php");
				     	
				     }else{                           
				          $error="<div  class=\"alert alert-success\">Something is Wrong...</div>";
				     }
				}     
			}   
 
    	}
    	else
    	{
    		if(isset($_POST["btn_send"]))
    		{
    			 $count=$obj->myQuery("select * from tbl_add_bank where add_bank_id='".$_POST["add_bank_id"]."'")->fetch_assoc();
    		    if($count==0) 
    		  {
    		  	 $InsData["bank_id"]=$_POST['bank_id'];
			     $InsData["account_no"]=$_POST['account_no'];
			     $InsData["card_number"]=$_POST['card_number'];
			     $InsData["card_holdername"]=$_POST['card_holdername'];
			     $InsData["cvv"]=$_POST['cvv'];
			     $InsData["expire_date"]=$_POST['mm']."-".$_POST['yyyy'];
			     $InsData["remote_ip"] = $obj->remote_ip;
				 $InsData["create_date"] = $obj->currentDate;
				 $InsData["modify_date"] = $obj->currentDate; 
				 $InsData["business_id"]=$obj->businessid($obj->UserKey);
			     $InsData["wallet"]=rand(20000,100000);
			     $result=$obj->myInsert("tbl_add_bank",$InsData);
			     if ($result>0) 
			     {
			         $obj->Redirect("bank.php");
			     	
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
						<h1>ADD BANK</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<a href="mydashboard.php">My Dashboard</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Add BANK</span>
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
									<a href="business-mydashboard.php" class="btn btn-black">Go back</a>
										
									</div>
								</div>
							<div class="col-md-12">
						<!-- General Information -->
						<div class="add-listing-box full-detail mrg-top-25 mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">
								<i class="glyphicon glyphicon-home"></i>
								
							<h3>ADDBANK</h3>
								
							</div>
							<form method="post">
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-12">
										<label for="Bank">Bank</label><br>
                                        <select id="bank" class="form-control" name="bank_id">
                                            <option selected hidden value="">Select Bank</option>
                                            <?php 
                                                    while ($list=mysqli_fetch_assoc($bank)) 
                                                    {
                                                        ?>
                                                            <option value="<?php echo $list['bank_id']; ?>"><?php echo $list['bank_name'];?></option>
                                                        <?php    
                                                    }
                                                ?>
                                        </select>
									</div>
									<div class="col-sm-12">
										<label>Account Number</label>
										<input type="text" class="form-control" name="account_no" required="">
									</div>	
											   <div class="payment-card">
												<header class="payment-card-header cursor-pointer collapsed" data-toggle="collapse" data-target="#debit-credit" aria-expanded="false">
													<div class="payment-card-title flexbox">
														<h4>Credit / Debit Card</h4>
													</div>
													<div class="pull-right">
														<img src="assets/img/credit.png" class="img-responsive" alt=""> 
													</div>
												</header>
													<div class="collapse" id="debit-credit" aria-expanded="false" style="height: 0px;">
														<div class="payment-card-body">
														   <div class="row mrg-r-10 mrg-l-10">
																<div class="col-sm-6 mt-5	">
																	<label>Card Holder Name</label>
																	<input type="text" class="form-control" name="card_holdername" placeholder="EXAMPLE">
																</div>
																<div class="col-sm-6 mt-5">
																	<label>Card No.</label>
																	<input type="text" class="form-control" name="card_number" placeholder="1235 4785 4758 1458">
																</div>
															</div>
															<div class="row mrg-r-10 mrg-l-10">
																<div class="col-sm-4 col-md-4">
																	<label>Expire Month</label>
																	<input type="text" class="form-control" placeholder="MM" name="mm">
																</div>
																<div class="col-sm-4 col-md-4">
																	<label>Expire Year</label>
																	<input type="text" class="form-control" placeholder="YY" name="yyyy">
																</div>
																<div class="col-sm-4 col-md-4">
																	<label>CCV Code</label>
																	<input type="password" class="form-control" id="cvCode" placeholder="CVV" required="" name="cvv">
																</div>
															</div>
														</div>
													</div>
											</div>
								</div>
								<div class="center">
									<?php
									 echo $error;
									?>

									<button type="submit" name="btn_send" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200">Insert</button>
									
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