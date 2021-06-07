 <?php

    require "../Config.php";
    $obj=new Config();

   $error="";
    if(isset($_SESSION["AdminWall"])){
        $obj->Redirect("index.php");
    }
    if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"]!="bye"){
        $user_id= $_COOKIE["user_id"];
        $password= $_COOKIE["password"];
        $error=login($user_id,$password);
    }

    if(isset($_POST["btn_send"])){
        $user_id=$_POST["user_id"];
        $password=$_POST["password"];
       $error=login($user_id,$password);
    }

 function login($user_id,$password){
    $obj=new Config();
    $loginData=$obj->myQuery("select * from tbl_admin_login where `email_id`='$user_id' and `password`='".md5($password)."' ");
    $count=$loginData->num_rows;

    if($count==1){
        $loginInfo=$loginData->fetch_assoc();
        if($loginInfo["status"]=="E"){

            if(isset($_POST["rmb"])){
                setcookie("user_id",$user_id);
                setcookie("password",$password);    
            }

           $_SESSION["AdminWall"]=$user_id;
            $_SESSION["LastLogin"]=$obj->currentDate;
              $obj->Redirect("index.php");
        }else{
            return $error="<div class=\"alert alert-danger\">You Have No Authority For Login ! Plz Contact Admin..</div>";
        }


    }else{
        return $error="<div class=\"alert alert-danger\">Your Email Id And Password IS Wrong....</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

		<?php
			require "header.php";
		?>

	</head>

	<body class="app bg">
		<div id="spinner"></div>
		<div id="app" class="page">
			<div class="main-wrapper page-main" >
			
				<!--Horizontal-menu-->
				

				<div class="container content-area">
					<section class="section">
                   

						<div class="row" style="margin-top: 15%;">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Login</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form">
                                            <div class="row">
                           
                                               <div class="form-group col-lg-12">
                                                   <input type="text" class="form-control" id="Username" placeholder="Enter Email ID" name="user_id" required="">
                                                </div>
                                                <div class="form-group col-lg-12" style="position: relative;">
                                                	 <input type="password" class="form-control hs-control" id="pwd" placeholder="Enter password" name="password" required="">
                                                     <i class="fa fa-eye hs-pass mr-5" style="color: black;position: absolute;top: 11px;right: -20px;font-size: 19px;"></i>
                                                </div>   
                                                <div class="form-group  form-check ml-3">
                                                      
                                                         
                                                     <input type="checkbox" name="rmb" class="form-check-input" >Remember me
                                                 </div>  
                                                <div class="text-center ml-3">
                                                   <button type="submit" name="btn_send" class="btn btn-primary loginbtn mt-5 ml-5">Login</button>
                                                </div>
                                                 
                                             </div>	
                                             <br>
                                              <?php
                                                                echo $error;
                                                   ?>
                                        </form>
									</div>
								</div>
							</div>
							
						</div>


					</section>
				</div>

			
			</div>
		</div>

		<!--Jquery.min js-->
		<?php
			require "script.php";
		?>

	 </body>
</html>