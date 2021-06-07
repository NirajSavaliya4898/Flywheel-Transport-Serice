<?php
  require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
$error="";
$fileFlag=0;
    if(isset($_POST["btn_send"])){

    		if(file_exists($_FILES["image"]['tmp_name']) || is_uploaded_file($_FILES["image"]['tmp_name']))
          {
            
            $ext=".".pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
            $size=($_FILES["image"]["size"])/1024/1024;
              if($size<5)
                {
                	$count=$obj->myQuery("select * from tbl_category where category_id='".$_POST["category_id"]."'")->num_rows;
                    $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                    move_uploaded_file($_FILES["image"]["tmp_name"],$path);
                    $categoryData["image"] = $obj->FileUploadName.$ext;
                    $categoryData["name"] = $_POST["name"];
                  
		            $categoryData["remote_ip"] = $obj->remote_ip;
		            $categoryData["create_date"] = $obj->currentDate;
		            $categoryData["modify_date"] = $obj->currentDate; 
              		$result=$obj->myInsert("tbl_category",$categoryData);
              		if ($result>0) {
              			 $error="<div class=\"alert alert-success\">Category Add Successfully.</div>";
              		}else{
              			 $error="<div class=\"alert alert-success\">Category Not Add .</div>";
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
                            <li class="breadcrumb-item active">  Add Main Category</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="main-category-display.php" class="btn btn-primary"><i class="fa fa-list "></i> Main Category Display</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>ADD Main Category</h4>
									</div>
									<div class="card-body">
									   <form  method="post" action="#" id="form" enctype="multipart/form-data" class="bValidator">
                        <div class="row">
                           
                           <div class="form-group col-lg-12">
                             
                              <input type="text" class="form-control" name="name"  placeholder="Enter Name"  data-bvalidator="required" data-bvalidator-msg="Please Enter the Category name">
                               <input type="file" class="form-control" name="image" data-bvalidator="required" data-bvalidator-msg="Please Select Image" >
                           </div>
                          
                           
                        <div class="text-center m-auto">
                           <button type="submit" name="btn_send" class="btn btn-primary loginbtn">Submit</button>
                           <button type="reset" class="btn btn-default">Reset</button>
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