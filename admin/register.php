 <?php
    require '../Config.php';
    $obj=new Config();

    $error="";
    if(isset($_POST["btn_send"])){


        $count=$obj->myQuery("select * from tbl_admin_login where email_id='".$_POST["email_id"]."'")->num_rows;
        if ($count==0)
        {
          if(file_exists($_FILES['profile']['tmp_name']) || is_uploaded_file($_FILES['profile']['tmp_name'])) 
          {
              $ext=".".pathinfo($_FILES["profile"]["name"],PATHINFO_EXTENSION);
              $size=$_FILES["profile"]["size"]/1024/1024;
              if ($size<5) 
              {
                  $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                  move_uploaded_file($_FILES["profile"]["tmp_name"],$path);
                  $insData["name"] = $_POST["name"];
                  $insData["email_id"] = $_POST["email_id"];
                  $insData["password"] = md5($_POST["password"]);
                  $insData["remote_ip"] = $obj->remote_ip;
                  $insData["create_date"] = $obj->currentDate;
                  $insData["modify_date"] = $obj->currentDate;
                  $insData["profile"]=$obj->FileUploadName.$ext;
                  $insData["last_login"] = $obj->currentDate;

                   $result=$obj->myInsert("tbl_admin_login", $insData);
                  if($result>0){
                       $obj->Redirect("login.php");
                  }else{
                      $error="<div class=\"alert alert-danger\">Something Wrong...</div>";
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
        }else{
            $error="<div class=\"alert alert-warning\">Email Id Already Existed!</div>";
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
                            <li class="breadcrumb-item active">Register</li>
							<li class="ml-auto d-lg-flex d-none">								
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Register</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form" enctype="multipart/form-data">
                                            <div class="row">
                           
                                               <div class="form-group col-lg-12">
                                                   <input class="form-control" type="file" name="profile" required="">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                	<input type="text" class="form-control" name="name"  placeholder="Enter Name" required="">
                                                </div>   
                                                <div class="form-group col-lg-6"> 
                                                    <input type="text" class="form-control" name="email_id" placeholder="Enter Email Id" required="">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required="">
                                               </div>               
                                                <div class="text-center m-auto">
                                                   <button type="submit" name="btn_send" class="btn btn-primary loginbtn">Register</button>
                                                   <button type="reset" class="btn btn-default">Reset</button>
                                                </div>
                                                  <?php
                                                                echo $error;
                                                   ?>
                                             </div>	
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