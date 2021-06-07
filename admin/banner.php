<?php
  require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
   $Countrys=$obj->myQuery("SELECT * FROM `tbl_banner`");
$error="";
$fileFlag=0;
    if(isset($_POST["btn_send"])){

    		if(file_exists($_FILES["image"]['tmp_name']) || is_uploaded_file($_FILES["image"]['tmp_name']))
          {
            
            $ext=".".pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
            $size=($_FILES["image"]["size"])/1024/1024;
              if($size<5)
                {
                    $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                    move_uploaded_file($_FILES["image"]["tmp_name"],$path);
                    $insData["image"] = $obj->FileUploadName.$ext;
                    $insData["link"] = $_POST["link"];
              		$insData["name"] = $_POST["name"];
              		$result=$obj->myInsert("tbl_banner",$insData);
              		if ($result>0) {
              			 $error="<div class=\"alert alert-success\">Banner Insert Successfully.</div>";
              		}else{
              			 $error="<div class=\"alert alert-success\">Banner Not Insert.</div>";
              		}
                }
                else
                {
                	$error="<div class=\"alert alert-success\"Must select less then 5MB...</div>";
                }
            }else{
                  $error="<div class=\"alert alert-success\"Files Not Selected...</div>";
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
                            <li class="breadcrumb-item active">  Add banner</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="banner-display.php" class="btn btn-primary"><i class="fa fa-list "></i> Banner Display</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>ADD Banner</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form" enctype="multipart/form-data">
                                            <div class="row">
                           
                                               <div class="form-group col-lg-12">
                                                   <input type="file" class="form-control" name="image" required="" id="exampleInputEmail1" >
                                                    <input type="text" class="form-control"name="link" required="" id="exampleInputEmail1" placeholder="link" >
                                                    <input type="text" class="form-control" required="" name="name" id="exampleInputEmail1" placeholder="name">
                                               </div>               
                                                <div class="text-center m-auto">
                                                   <button type="submit" name="btn_send" class="btn btn-primary loginbtn">Submit</button>
                                                   <button type="reset" class="btn btn-default">Reset</button>
                                                </div>
                                                  
                                             </div>
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