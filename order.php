<?php
	
	 require 'Config.php';
     $obj=new Config();
	
	 $obj->UserWall();
	 if (isset($_GET['b_id'])) {
	 	$Ins=$obj->myQuery("SELECT * FROM `tbl_business` WHERE `business_id`='".$_GET['b_id']."' AND `category_id`='".$_GET['cat_id']."'");
	 }
	
	$Country=$obj->myQuery("SELECT * FROM `tbl_location` WHERE `label`='country'");

	$error="";
    if(isset($_POST['btn_send']))
    {
        if(file_exists($_FILES['document']['tmp_name']) || is_uploaded_file($_FILES['document']['tmp_name'])) 
        {
            $ext=".".pathinfo($_FILES["document"]["name"],PATHINFO_EXTENSION);
            $size=$_FILES["document"]["size"]/1024/1024;
            if ($size<5) 
            {
                $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                move_uploaded_file($_FILES["document"]["tmp_name"],$path);
                $InsData["from"]=$_POST['from'];
                $InsData["to"]=$_POST['to'];
                $InsData["day"]=$_POST['day'];
                $InsData["order_date"]=$_POST['order_date'];
                $InsData["avg_weight"]=$_POST['avg_weight'];
                $InsData["address"]=$_POST['address'];
                $InsData["business_id"]=$_GET['b_id'];
                $InsData["category_id"]=$_GET['cat_id'];
                $InsData["location_id"]=$_POST['city'];
                $InsData["registration_id"]=$obj->Registrationid($obj->UserKey);
                $InsData["document"]=$obj->FileUploadName.$ext;
               	$InsData["remote_ip"] = $obj->remote_ip;
				$InsData["create_date"] = $obj->currentDate;
			    $InsData["modify_date"] = $obj->currentDate; 
                
                $result=$obj->myInsert("tbl_order",$InsData);
                if ($result>0) 
                {
                	$order_Data=$obj->myQuery("SELECT `order_id` FROM `tbl_order` WHERE `registration_id` ='".$obj->Registrationid($obj->UserKey)."' ORDER BY `order_id` DESC LIMIT 1")->fetch_assoc();

                	$order_id=$order_Data['order_id'];

                   $obj->Redirect("admin/mail/con-order.php?order_id=$order_id");
                }else{
                     $error="<div  class=\"alert alert-success\">Fail...</div>";
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
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/top-author.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:03:50 GMT -->
<head>
	<?php
		require "header.php";
	?>
    <style>
    	#pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }
    </style>
	</head>
	<body class="home-2">
		<div class="wrapper">  
			<!-- Start Navigation -->
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
						<h1>ORDER NOW</h1>
						<div class="breadcrumbs">
							<a href="index.php">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">ORDER NOW</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ================ End Page Title ======================= -->
			
			<section class="padd-30">
				<div class="container">
					<div class="col-md-10 translateY-60 col-sm-12 col-md-offset-1">
						<!-- General Information -->
					<form method="post" enctype="multipart/form-data">	
						<div class="add-listing-box general-info mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">
								<i class="ti-files theme-cl"></i>
								<h3>General Information</h3>
							</div>
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-6">
										<label>From</label>
										<input type="text" class="form-control" id="search" name="from" required="">
									</div>
									<div class="col-sm-6">
										<label>To</label>
									<input type="text" class="form-control" id="search1" name="to" required="">
									</div>
									
									<div class="col-sm-6">
													<label for="Day">Day</label><br>
		                                        <select id="bank" data-bvalidator="required" name="day" class="form-control" required="">
		                                            <option selected hidden value="">Select Number of Day</option>
		                                            <option >1</option>
		                                            <option >2</option>
		                                            <option >3</option>
		                                            <option >4</option>
		                                            <option >5</option>
		                                            <option >6</option>
		                                            <option >7</option>
		                                            <option >8</option>
		                                            <option >9</option>
		                                            <option >10</option>
		                                        </select>
									</div>
									<div class="col-sm-6">
										<label>Document</label>
                                         <input type="file" name="document" required="" class="form-control" />
									</div>
									<div class="col-sm-6">
										<label>Order Date</label>
										<input class="form-control" type="date"  name="order_date" required="">
									</div>
									<div class="col-sm-6">
										<label for="Address">Avg Weight</label>
                                         <input type="text"  name="avg_weight" class="form-control" required="">
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
                                         <input type="text" id="Address" name="address" class="form-control" required="">
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
						</div>
						<!-- End Edit Location -->
								<div class="center mt-5">
										<button type="submit" name="btn_send" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200">Order Now </button>
										<?php
			                    			echo  $error;
			                  			?>
								</div>
								<div class="pt-2 text-right px-3">
									<?php
										if (isset($_GET['status'])) 
										{
											if ($_GET['status']=="success") 
											{
												echo "<span class='text-success'>Check Your Email Account & Confirm Your Order.</span>";
											}
											else if($_GET['status']=="failed"){
												echo "<span class='text-danger'>Somthing Wrong...</span>";
											}
										}
										
									?>
								</div>
					</form>	
					</div>
				</div>
			</section>
			<!-- ================ End Top Author ======================= -->

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
				$(".tab.style-1 li:nth-child(1)").addClass("active");
				$(".tab-content.tabs .tab-pane:nth-child(1)").addClass("active");
			</script>
			
			<script type="text/javascript">
			  function initAutocomplete() {
			    // Create the autocomplete object, restricting the search to geographical
			    // location types.
			    autocomplete = new google.maps.places.Autocomplete(
			        /** @type {!HTMLInputElement} */(document.getElementById('search')),
			        {types: ['geocode']});

			    // When the user selects an address from the dropdown, populate the address
			    // fields in the form.
			    autocomplete = new google.maps.places.Autocomplete(
			        /** @type {!HTMLInputElement} */(document.getElementById('search1')),
			        {types: ['geocode']});
			    autocomplete.addListener('place_changed', fillInAddress);
			  }

			  function fillInAddress() {
			    // Get the place details from the autocomplete object.
			    var place = autocomplete.getPlace();

  			}
    			</script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEfSsc4eurbW7kk4wnZVCOPR4xkfKgi6Q&libraries=places&callback=initAutocomplete"
        async defer></script>
		</div>
	</body>

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/top-author.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:03:50 GMT -->
</html>