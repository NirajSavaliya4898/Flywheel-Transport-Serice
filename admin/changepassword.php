 <?php
    require '../Config.php';
$obj=new Config();
$obj->AdminWall();
// $obj->checkSuper();
    // $obj->ChAdmin();

    $error="";
    if (isset($_POST['btn_send'])) 
    {
        $oldpassword=md5($_POST['oldpassword']);
        $newpassword=md5($_POST['newpassword']);
        $conpassword=md5($_POST['conpassword']);
        $chk_user=$obj->myQuery("SELECT * FROM `tbl_admin_login` WHERE `email_id`='$obj->AdminKey' and `password`='$oldpassword'")->num_rows;
        if ($chk_user==1) 
        {
            if ($newpassword== $conpassword) 
            {
                $UpData["password"]=$newpassword;
                $Where["email_id"]=$obj->AdminKey;
                $obj->myUpdate("tbl_admin_login",$UpData,$Where);
                $obj->Redirect("index.php");
            }
            else
            {
                $error="New Password & Confirm Password Not Same...";
            }
        }
        else
        {
            $error="Old Password Is Incurrect...";
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

	<body class="app ">
		<div id="spinner"></div>
		<div id="app" class="page">
			<div class="main-wrapper page-main" >
				<?php
					require "navigation.php"
				?>
				<!--Horizontal-menu-->
				

				<div class="container content-area">
					<section class="section">
                    	<ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
							<li class="ml-auto d-lg-flex d-none">					
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Change Password</h4>
									</div>
									<div class="card-body">
									     <form method="post">
                              <div class="form-group">  
                                
                                
                                <input type="password" name="oldpassword" class="form-control" id="Username" placeholder="Current password">
                              </div>
                              <div class="form-group">
                              
                                 <input type="password" class="form-control" name="newpassword" id="pwd" placeholder="New password" >
                              </div>
                               <div class="form-group">
                                
                                  <input type="password" class="form-control" name="conpassword" id="pwd" placeholder="Retype New password" >
                               </div>
                      <div class="text-center m-auto">
                        <button type="submit" class="btn btn-primary" name="btn_send">Save Changes</button>
                      </div>
                      
                        <?php echo $error;?>
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