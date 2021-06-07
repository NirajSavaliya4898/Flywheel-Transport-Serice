<?php
  require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
   
	$error="";
	if(isset($_GET["id"])){
		$rData=$obj->myQuery("select * from tbl_category where category_id=".$_GET["id"])->fetch_assoc();
	
	}
    if(isset($_POST["btn_send"])){

    		if(file_exists($_FILES["image"]['tmp_name']) || is_uploaded_file($_FILES["image"]['tmp_name']))
          	{
          		$query="select * from tbl_category where category_id='".$_POST["category_id"]."'  and category_id!=".$_GET["id"];
          		unlink($obj->FileUploadPath.$query['image']);
          		$ext=".".pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
          		  $size=($_FILES["image"]["size"])/1024/1024;
          		  if($size<5){
          		  	$path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                    move_uploaded_file($_FILES["image"]["tmp_name"],$path);
                    $categoryData["image"] = $obj->FileUploadName.$ext;
          		  }
          		  else
          		  {
          		  	$error="<div class=\"alert alert-success\"Must select less then 5MB...</div>";
          		  }
          	}	
          	 $categoryData["name"] = $_POST["name"];
            $categoryData["remote_ip"] = $obj->remote_ip;
            $categoryData["create_date"] = $obj->currentDate;
            $categoryData["modify_date"] = $obj->currentDate;
            $result=$obj->myUpdate("tbl_category",$categoryData,array("category_id"=>$_GET["id"]));
            if ($result>0) {
              			$obj->Redirect("main-category-display.php");
              		}else{
              			 $error="<div class=\"alert alert-success\">Image Not Update.</div>";
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
                            <li class="breadcrumb-item active">Main category Update</li>
							<li class="ml-auto d-lg-flex d-none">							
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Main category Update</h4>
									</div>
									<div class="card-body">
									    <form  method="post" action="#" id="form" enctype="multipart/form-data">
                        					<div class="row">
                           
					                           <div class="form-group col-lg-12">
					                              <label class="cust-text" >Main-Category Update</label>
					                              <input type="text"  class="form-control" name="name"  placeholder=""  value="<?php echo $rData["name"]; ?>" >
					                               <input type="file" class="form-control" name="image" required="">
					                           </div>
                          
						                           
						                        <div class="text-center m-auto">
						                           <button type="submit" name="btn_send" class="btn btn-primary loginbtn">Update</button>
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