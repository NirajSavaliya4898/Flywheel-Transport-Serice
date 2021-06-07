<?php
  require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
   
	$error="";
	if(isset($_GET["id"])){
		$Udata=$obj->myQuery("SELECT * FROM `tbl_banner` WHERE `banner_id`='".$_GET['id']."'")->fetch_assoc();
	
	}
    if(isset($_POST["btn_send"])){

    		if(file_exists($_FILES["path"]['tmp_name']) || is_uploaded_file($_FILES["path"]['tmp_name']))
          	{
          		$result=$obj->myQuery("SELECT `image` FROM `tbl_banner` WHERE 'banner_id'='".$_GET['id']."'")->fetch_assoc();
          		unlink($obj->FileUploadPath.$result['image']);
          		$ext=".".pathinfo($_FILES["path"]["name"],PATHINFO_EXTENSION);
          		  $size=($_FILES["path"]["size"])/1024/1024;
          		  if($size<5){
          		  	$path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                    move_uploaded_file($_FILES["path"]["tmp_name"],$path);
                    $insData["image"] = $obj->FileUploadName.$ext;
          		  }
          		  else
          		  {
          		  	$error="<div class=\"alert alert-success\"Must select less then 5MB...</div>";
          		  }
          	}	
          	$insData["link"] = $_POST["link"];
            $insData["name"] = $_POST["name"];	
            $where['banner_id']=$_GET['id'];
            $result=$obj->myUpdate("tbl_banner",$insData,$where);
            if ($result>0) {
              			$obj->Redirect("banner-display.php");
              		}else{
              			 $error="<div class=\"alert alert-success\">Banner Not Update.</div>";
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
                            <li class="breadcrumb-item active">Update Banner</li>
							<li class="ml-auto d-lg-flex d-none">
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Update Banner</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form" enctype="multipart/form-data">
                                            <div class="row">
                           
                                               <div class="form-group col-lg-12">
                                                   <input type="file" class="form-control" name="path" id="exampleInputEmail1">
                                                    <input type="text" class="form-control"name="link" id="exampleInputEmail1" placeholder="link" value="<?php echo $Udata["link"] ?>">
                                                    <input type="text" class="form-control"  name="name" id="exampleInputEmail1" placeholder="name" value="<?php echo $Udata["name"]; ?>">
                                               </div>               
                                                <div class="text-center m-auto">
                                                   <button type="submit" name="btn_send" class="btn btn-primary loginbtn">Submit</button>
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