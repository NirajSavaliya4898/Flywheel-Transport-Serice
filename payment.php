<?php
    require "Config.php";
    $obj=new Config();

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
	//Request hash
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';	
	if(strcasecmp($contentType, 'application/json') == 0){
		$data = json_decode(file_get_contents('php://input'));
		$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
		$json=array();
		$json['success'] = $hash;
    	echo json_encode($json);
	
	}
	exit(0);
}
 
function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol . $_SERVER['HTTP_HOST'] . "/transport/PHP_Bolt-master/" . 'response.php';
}



    $error="";
    if (isset($_GET['oid'])) 
    {
    	$oid=$_GET['oid'];
    	$result=$obj->myQuery(
	 	"SELECT 
	 		admin.`wallet` AS a_wallet,
	 		business.`wallet` AS b_wallet, 
	 		register.`wallet` AS r_wallet, 
	 		register.`cvv` AS r_cvv, 
	 		register.`card_number` as r_card_number, 
	 		register.`account_no` as r_account_no, 
	 		c.`name` as vehicle_type, 
	 		o.`price` as price, 
	 		business.`card_holdername` as business,
	 		o.`business_id` as business_id
	 	FROM 
	 		`tbl_order` AS o, 
	 		`tbl_add_bank` AS admin, 
	 		`tbl_add_bank` AS business, 
	 		`tbl_add_bank` AS register, 
	 		`tbl_category` AS c 
	 	WHERE 
	 		o.`order_id` = '".$_GET['oid']."' AND 
	 		admin.`admin_login_id` = '1' AND 
	 		o.business_id = business.business_id AND 
	 		o.registration_id = register.registration_id and 
	 		c.category_id=o.category_id")->fetch_assoc();
    }else
    {
    	//$obj->Redirect("orderdisplay.php");
    }
	 		
		

		// if(isset($_POST["btn"]))
		// {
		// 	if ($_POST['payment_type']!="") 
  //           {
  //           	$payment_type=$_POST['payment_type'];

  //           	$b_wallet=$result['b_wallet'];
  //               $r_wallet=$result['r_wallet'];
  // 				$a_wallet=$result['a_wallet'];
  

  //               $per=$result['price']/10;

  //           	if ($payment_type=="cash") 
  //           	{
  //           		$A_U_wallet=$a_wallet+$per;
  //           		$B_U_wallet=$b_wallet-$per;
                

  //               	$A_UpData["wallet"]=$A_U_wallet;
	 //                $A_Where["admin_login_id"]=1;
	 //                $result1=$obj->myUpdate("tbl_add_bank",$A_UpData,$A_Where);
	                
	 //                $B_UpData["wallet"]=$B_U_wallet;
	 //                $B_Where["business_id"]=$result['business_id'];
	 //                $result2=$obj->myUpdate("tbl_add_bank",$B_UpData,$B_Where);

	 //                $O_Status["status"]="S";
	 //                $O_S_Wh["order_id"]=$_GET['oid'];
	 //                $result3=$obj->myUpdate("tbl_order",$O_Status,$O_S_Wh);

	 //                $InsData["order_id"]=$_GET['oid'];
	 //                $InsData["total_prize"]=$result['price'];
	 //                $InsData["type"]=$payment_type;
	 //                $InsData["remote_ip"] = $obj->remote_ip;
		//             $InsData["create_date"] = $obj->currentDate;
		//             $InsData["modify_date"] = $obj->currentDate; 
	 //                $result4=$obj->myInsert("tbl_bill",$InsData);

	 //                if ($result1>0 && $result2>0 && $result3>0 && $result4>0) 
	 //                {
	 //                	$error="<span class='text-success pr-3'>Payment Successfull</span>"."<br>".
		// 		                	"<a href='rnr.php?oid=".$_GET['oid']."' target='_BLANK'>Give Review & Rating</a>";	
	 //                }
  //           	}
  //           	else
  //           	{
  //           		if ($result['r_cvv']!="" && $result['r_account_no']!="") 
  //           		{
	 //            		if ($_POST['cvv']==$result['r_cvv']) 
	 //            		{
	 //            			if ($result['r_wallet']>=$result['price']) 
	 //                        {
	 //                        	$A_U_wallet=$a_wallet+$per;
	 //                			$R_U_wallet=$r_wallet-$result['price'];
	 //                			$B_U_wallet=$b_wallet+$result['price']-$per;

  //                               $A_UpData["wallet"]=$A_U_wallet;
  //                               $A_Where["admin_login_id"]=1;
  //                               $result1=$obj->myUpdate("tbl_add_bank",$A_UpData,$A_Where);

  //                               $R_UpData["wallet"]=$R_U_wallet;
  //                               $R_Where["registration_id"]=$obj->Registrationid($obj->UserKey);
  //                               $result2=$obj->myUpdate("tbl_add_bank",$R_UpData,$R_Where);
                                
  //                               $B_UpData["wallet"]=$B_U_wallet;
  //                               $B_Where["business_id"]=$result['business_id'];
  //                               $result3=$obj->myUpdate("tbl_add_bank",$B_UpData,$B_Where);

  //                               $O_Status["status"]="S";
  //                               $O_S_Wh["order_id"]=$_GET['oid'];
  //                               $result4=$obj->myUpdate("tbl_order",$O_Status,$O_S_Wh);

  //                               $InsData["order_id"]=$_GET['oid'];
	 //                            $InsData["total_prize"]=$result['price'];
	 //                            $InsData["type"]=$payment_type;
	 //                            $InsData["remote_ip"] = $obj->remote_ip;
		// 			            $InsData["create_date"] = $obj->currentDate;
		// 			            $InsData["modify_date"] = $obj->currentDate; 
	 //                            $result5=$obj->myInsert("tbl_bill",$InsData);

  //                               if ($result1>0 && $result2>0 && $result3>0 &&  $result4>0 && $result5>0) 
		// 		                {
		// 		                	$error="<span class='text-success pr-3'>Payment Successfull</span>"."<br>".
		// 		                	"<a href='rnr.php?oid=".$_GET['oid']."' target='_BLANK'>Give Review & Rating</a>";
		// 		                }

	 //                        }
	 //                        else
	 //                        {
	 //                        	$error="<span class='text-danger'>You Have Not Enough Balance...</span>";
	 //                        }
	 //            		}
	 //            		else
	 //            		{
	 //            			$error="<span class='text-danger'>Cvv Does Not Match! Please Enter Valied Cvv...</span>";	
	 //            		}
	 //            	}
	 //            	else
	 //            	{
	 //            		$error="<span class='text-danger'>First Enter The Card...</span>";	
	 //            	}
  //           	}
  //           }
  //           else
  //           {
  //           	$error="<span class='text-danger'>First Select Payment Type...</span>";
  //           }
		// }
	 
  ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/grid-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:01:36 GMT -->
<head>
	<style type="text/css">
	.main {
		margin-left:30px;
		font-family:Verdana, Geneva, sans-serif, serif;
	}
	.text {
		float:left;
		width:180px;
	}
	.dv {
		margin-bottom:5px;
	}
</style>
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
						<h1>Payment</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<a href="mydashboard.php">MyDeshboard</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Payment</span>
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
							<!--form-->
									
										<label class="px-5 mt-2" style="color:black;font-size: 18px;margin-left: 277px;">Payment Details</label><br>
											<form method="POST"  id="payment_form">
										    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
										    <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
										    <div class="dv">
										    
										    <span><input type="hidden" id="key" name="key" placeholder="Merchant Key" value="Qz5eG5B0" /></span>
										    </div>
										    
										    <div class="dv">
										    
										    <span><input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="qAzKTLQdSe" /></span>
										    </div>
										    
										    <div class="dv">
										
										    <span><input type="hidden" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" /></span>
										    </div>
										    
										    <div class="dv">
										   
										    <span><input type="hidden" id="amount" name="amount" placeholder="Amount" value="<?php echo $result["price"]; ?>" /></span>    
										    </div>
										    
										    <div class="dv">
										    <span><input type="hidden" id="pinfo" name="pinfo" placeholder="Product Info" value="<?php echo $oid; ?>" /></span>
										    </div>
										    
										    <div class="dv">
										   
										    <span><input type="hidden" id="fname" name="fname" placeholder="First Name" value="<?php echo $Data['name']; ?>" /></span>
										    </div>
										    
										    <div class="dv">
										    <span><input type="hidden" id="email" name="email" placeholder="Email ID" value="<?php echo $Data['email_id']; ?>" /></span>
										    </div>
										    
										    <div class="dv">
										    
										    <span><input type="hidden" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="<?php echo $Data['contactno']; ?>" /></span>
										    </div>
										    
										    <div class="dv">
										    
										    <span><input type="hidden" id="hash" name="hash" placeholder="Hash" value="" /></span>
										    </div>
										    
										    
										    <!-- <div><input type="submit" value="Pay"  onclick="launchBOLT(); return false;"  /></div> -->
											
									</div>

									<div class="booking-price padd-15 hs-card-Details">
										<div class="booking-price-detail side-list no-border">
											<ul>
												<li>To<strong class="theme-cl pull-right"><?php echo $result["business"]; ?></strong></li>
											</ul>
										</div>
										<div class="booking-price-detail side-list no-border">
											<ul>
												<li>Vehicle Type<strong class="theme-cl pull-right"><?php echo $result["vehicle_type"]; ?></strong></li>
											</ul>
										</div>
										<div class="booking-price-detail side-list no-border">
											<ul>
												<li>Total Cost<strong class="theme-cl pull-right"><?php echo $result["price"]; ?></strong></li>
											</ul>
										</div>
										<div class="form-group px-5 text-center mt-5">
											<button class="btn btn-success" type="submit" value="pay" onclick="launchBOLT(); return false;"  />Pay Now</button>
										</div>
										<!-- Total Cost -->
										<?php
											if ($error!="") 
											{
												echo $error;
											}
										?>
									</div>
									</form>
								<!--</form>-->
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
			
			<script type="text/javascript">
					
				$("#hs-card-Details").hide();
				$(document).on("change",".payment_type",function(){
					if ($(this).val()=="cash") 
					{
						$("#hs-card-Details").hide();
					}else{
						$("#hs-card-Details").show();
					}
				})
			</script>
		</div>
	</body>

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/grid-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:01:46 GMT -->
</html>