<?php
  require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
$error="";
$fileFlag=0;
 $maincategory=$obj->myQuery("select * from tbl_category where label='main'");
    if(isset($_POST["btn_send"])){

        if(file_exists($_FILES["image"]['tmp_name']) || is_uploaded_file($_FILES["image"]['tmp_name']))
          {
            
            $ext=".".pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
            $size=($_FILES["image"]["size"])/1024/1024;
              if($size<5)
                {
                    
                    $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                    move_uploaded_file($_FILES["image"]["tmp_name"],$path);
                    $subcategoryData["image"] = $obj->FileUploadName.$ext;
                    $subcategoryData["name"] = $_POST["subcategoryname"];
                    $subcategoryData["parentkey"]=$_POST["mcname"];//maincategoryname(mc);//
                    $subcategoryData["label"]="sub";
                    $subcategoryData["remote_ip"] = $obj->remote_ip;
                    $subcategoryData["create_date"] = $obj->currentDate;
                    $subcategoryData["modify_date"] = $obj->currentDate; 
                    $result=$obj->myInsert("tbl_category", $subcategoryData);
                  if ($result>0) {
                     $error="<div class=\"alert alert-success\">Sub Category Add Successfully.</div>";
                  }else{
                     $error="<div class=\"alert alert-success\">Sub Category Not Add .</div>";
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
                            <li class="breadcrumb-item active">  Add Sub Category</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="sub-category-display.php" class="btn btn-primary"><i class="fa fa-list "></i>Sub Category Display</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4> Add Sub Category</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form" enctype="multipart/form-data" class="bValidator">
                        <div class="row">
                           
                           <div class="form-group col-lg-12">
                            
                                
                                  <select class="form-control" name="mcname" required="" >
                                                    <option value="" selected hidden>Select Main-Category</option>
                                                    <?php 
                                                        while ($list=mysqli_fetch_assoc($maincategory)) 
                                                        {
                                                            ?>
                                                                <option value="<?php echo $list['category_id']; ?>"><?php echo $list['name'];?></option>
                                                            <?php    
                                                        }
                                                    ?>
                                    </select>
                              <input style="margin-top:10px;" type="text" class="form-control" name="subcategoryname"  placeholder="Enter sub Category" data-bvalidator="required" data-bvalidator-msg="Please Enter the Sub Category name">
                              <input type="file" class="form-control" name="image" data-bvalidator="required" data-bvalidator-msg="Please Select Image">
                           </div>
                          
                           
                        <div class="text-center m-auto">
                           <button type="submit" name="btn_send" class="btn btn-primary loginbtn">Submit</button>
                           <button type="reset" class="btn btn-default">Reset</button>

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