<?php
    require "config.php";
    $obj=new config();
     $rerror="";
    $error="";
     if (isset($_POST['btnregister'])) 
    {
        $register_type=$_POST['r_radio'];
        if ($register_type=="user") 
        {
            if (isset($_POST['tnc']))
            {
                $email_id=$_POST['email_id'];
                $password=$_POST['password'];
                $conpassword=$_POST['conpassword'];

                $count=$obj->myQuery("select * from tbl_registration where email_id='".$_POST["email_id"]."'")->num_rows;

                if ($count==0)
                {
                    if ($password==$conpassword) 
                    {
                        $insData["name"]=$_POST["name"];
	                    $insData["email_id"]=$_POST["email_id"];
			            $insData["password"]=md5($_POST["password"]);
			            $insData["remote_ip"] = $obj->remote_ip;
			            $insData["create_date"] = $obj->currentDate;
			            $insData["modify_date"] = $obj->currentDate;
                        
                        $result=$obj->myInsert("tbl_registration",$insData);
                        if ($result>0) 
                        {
                             $rerror="<div  class=\"alert alert-success\">User Account Create.</div>";
                        }else{
                             $rerror="<div  class=\"alert alert-success\">User Not Create.</div>";
                        }   
                    }
                    else
                    {
                        $rerror="<div  class=\"alert alert-success\">Password Does Not Match.</div>";
                    }
                }
                else
                {
                     $rerror="<div  class=\"alert alert-success\">this email is already registerd.</div>";
                }       
            }
            else
            {
                
                 $rerror="<div  class=\"alert alert-success\">Team & Condition Not Selected.</div>";
            }   
        }
        else
        {
            if (isset($_POST['tnc']))
            {
                $email_id=$_POST['email_id'];
                $password=$_POST['password'];
                $conpassword=$_POST['conpassword'];

                $count=$obj->myQuery("SELECT * FROM `tbl_business` WHERE `email_id`='".$email_id."'")->num_rows;

                if ($count==0)
                {
                    if ($password==$conpassword) 
                    {
                        $insData["name"]=$_POST["name"];
	                    $insData["email_id"]=$_POST["email_id"];
			            $insData["password"]=md5($_POST["password"]);
			            $insData["remote_ip"] = $obj->remote_ip;
			            $insData["create_date"] = $obj->currentDate;
			            $insData["modify_date"] = $obj->currentDate;
                        
                        $result=$obj->myInsert("tbl_business",$insData);
                        if ($result>0) 
                        {
                             $rerror="<div  class=\"alert alert-success\">Business Account 	Create.</div>";
                        }else{
                            $rerror="<div  class=\"alert alert-success\">Business Account Not Create.</div>";
                        }   
                    }
                    else
                    {
                         $rerror="<div  class=\"alert alert-success\">Password Does Not Match.</div>";
                    }
                }
                else
                {
                     $rerror="<div  class=\"alert alert-success\">this email is already registerd.</div>";
                }       
            }
            else
            {
                $rerror="<div  class=\"alert alert-success\">Team & Condition Not Selected.</div>";
            } 
        }
    }
    if(isset($_POST['btn_login']))
    {
        $user_email_id=$_POST['l_email_id'];
        $user_password=md5($_POST['l_password']);
        $error=MyLogin($user_email_id,$user_password);
    }

    function MyLogin($email_id,$password)
    { 
   
        $obj=new Config();
        $logindata=$obj->myQuery("select * from `tbl_registration` where `email_id`='$email_id' AND `password`='$password'");
        $count=$logindata->num_rows;

        if($count==1)
        { 

            $loginfid=$logindata->fetch_array();
             if($count==1)
	        {
	            if($loginfid["status"]=="E")
	            {
	               
	                $_SESSION['UserWall']= $email_id;
	                $_SESSION['LastLogin']= $obj->current_date;
	               $_SESSION["RegisterType"]="user";
	                $obj->Redirect("index.php");
	            }
	            else
	            {
	                		return  $error="<div  class=\"alert alert-success\">You Have No Authority For Login ! Plz Contact Admin...</div>";
	            }
	        }
	        else
	        {
	        	 return $error="<div  class=\"alert alert-success\">You Have No Authority For Login ! Plz Contact Admin...</div>";
	        }   
        }
        else
        {
	        $logindata=$obj->myQuery("select * from `tbl_business` where `email_id`='$email_id' AND `password`='$password'");
	        $count=$logindata->num_rows;
	    
	        if($count==1)
	        {

	            $loginfid=$logindata->fetch_array();
	            if($loginfid["status"]=="E")
	            {
	        		       
	                $_SESSION['UserWall']= $email_id;
	                $_SESSION['LastLogin']= $obj->current_date;
	                $_SESSION["RegisterType"]="business";
	                
	                $obj->Redirect("business-mydashboard.php");
	                
	            }
	            else
	            {
	          		 return $error="<div  class=\"alert alert-success\">You Have No Authority For Login ! Plz Contact Admin...</div>";
	            }

	        }
	        else
	        {
	        	 return $error="<div  class=\"alert alert-success\">Username & Password Is Wrong...</div>";
	        }
	    }   
    }


?>

<!DOCTYPE html>
<html class="no-js" lang="en">
	
<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:00:10 GMT -->
<head>
	<?php
		require "header.php";
	?>
    
	</head>
	<body class="bodyimage">
		<div class="wrapper">  
			<!-- Start Navigation -->
			<?php
				require "navigation.php";
			?>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			
			
			<section>
				<div class="container">
					<!-- Tab Style 1 -->
					<div class="col-md-3 col-sm-12"></div>
					<div class="col-md-6 col-sm-12">
						<div class="tab style-1" role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs nav-justified" role="tablist">
								<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Login</a></li>
								<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Register</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content tabs">
								<div role="tabpanel" class="tab-pane fade in active" id="home">
									<img src="assets/img/logo.png" class="img-responsive" alt="" />
									<form  method="post">
									<div class="form-group" style="position: relative;">
										<input type="email"  name="l_email_id"  class="form-control" placeholder="Email ID" required="">
										<input type="password" name="l_password" class="form-control hs-control"  placeholder="Password" required="">
										<i class="fa fa-eye hs-pass" style="color: black;position: absolute;top: 78px;right: 11px;font-size: 19px;"></i>
										<div class="center">
										<button type="submit" id="login-btn" name="btn_login" class="btn btn-midium theme-btn btn-radius width-200"> Login </button>
										
										<?php
                    						echo  $error;
                  					  	?>

					                    	
										</div> 


										<div class="center pt-4">
											<a href="forgot.php" class="center" style="color: #ff431e;">Forgot Password ?</a>
										</div>
										<div class="text-center">
											<p style="color:black;">Flywheel admin ?<a href="admin/login.php" class="center" style="color: #ff431e;"> Login</a></p>
										</div>
									</div>
								</form>
								
								</div>
								<div role="tabpanel" class="tab-pane fade" id="profile">
									<form method="post"  onsubmit=" return (grecaptcha.getResponse(widgetId1) == '')? false : true;" class="bValidator">
									<img src="assets/img/logo.png" class="img-responsive" alt="" />
									<div style="width: 50%;">
												<input id="user" type="radio"  name="r_radio" value="user">
												<label for="user">User</label>
											</div>
											<div class="center" style="margin-top:-30px;">
												<input id="business" type="radio" name="r_radio" value="business">
												<label for="business">Business</label>
											</div>
									<div class="form-group">
												<input type="text"   name="name" class="form-control" placeholder="Enter the Name" placeholder="Name" data-bvalidator="rangelength[3:32],required" data-bvalidator-msg="Name must be between 3 and 32 characters !" >
												<input type="email"   name="email_id" class="form-control" placeholder="Email ID" data-bvalidator="email,required" data-bvalidator-msg="E-Mail Address does not appear to be valid!">
												<input type="password"  name="password" class="form-control"  placeholder="Password" required="">
												<input type="password"  name="conpassword" class="form-control"  placeholder="Confirm Password" required="">
												<input type="checkbox" class="checkbox" name="tnc" required="" style="position: absolute;">
                                                    <label class="custom-control-label" for="customControlInline"> <p style="padding-left:22px;">I Accept All<a href="terms-conditions.php" title="" style="padding-left:4px;">T&C</a></p> </label>
												<div class="center">

										        <div id="example1" style="margin-left:15px;"></div>
      											<br>
												<button type="submit" name="btnregister" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200" value="getResponse"> Register </button>
												<?php
			                    					echo  $rerror;
			                  					  ?>
												</div>
											</div>
								</div>
								</form>
							</div>
						</div>
					</div>
					<!-- End Tab Style 1 -->
				</div>
			</section>
			
			<!-- End Login Section -->

			<!-- ================ Start Footer ======================= -->
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
      var verifyCallback = function(response) {
       
      };
      var onloadCallback = function() {
        
        widgetId1 = grecaptcha.render('example1', {
          'sitekey' : '6Lcnnx4UAAAAAPVZzowFZPkxxHyOm5RsFQWE1SKo',
          'callback' : verifyCallback,
          'theme' : 'light'
        });
      };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
			
		</div>
	</body>

<!-- Mirrored from codeminifier.com/new-listing-hub-template/listing/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Mar 2019 14:00:10 GMT -->
</html>