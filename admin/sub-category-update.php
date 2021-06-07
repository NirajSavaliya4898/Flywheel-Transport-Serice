  <?php
  require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
   
    $error="";
    $mcategory=$obj->myQuery("select * from tbl_category where label='main'");
    if(isset($_GET["id"])){
        $rData=$obj->myQuery("SELECT m.name AS mcategory, m.`category_id` AS mcategory_id, s.* FROM `tbl_category` AS s, `tbl_category` AS m WHERE m.`category_id` = s.`parentkey` AND s.`category_id` = '".$_GET['id']."'")->fetch_assoc();
    
    }
    if(isset($_POST["btn_send"])){

            if(file_exists($_FILES["image"]['tmp_name']) || is_uploaded_file($_FILES["image"]['tmp_name']))
            {
                unlink($obj->FileUploadPath.$rData['image']);
                $ext=".".pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
                  $size=($_FILES["image"]["size"])/1024/1024;
                  if($size<5){
                    $path=$obj->FileUploadPath.$obj->FileUploadName.$ext;
                    move_uploaded_file($_FILES["image"]["tmp_name"],$path);
                    $subcategoryData["image"] = $obj->FileUploadName.$ext;
                  }
                  else
                  {
                    $error="<div class=\"alert alert-success\"Must select less then 5MB...</div>";
                  }
            }   
            $subcategoryData["name"] = $_POST["scategoryname"];
            $subcategoryData["parentkey"]=$_POST["mcname"];//maincategoryname(mc);//
            $subcategoryData["label"]="sub";
            $subcategoryData["remote_ip"] = $obj->remote_ip;
            $subcategoryData["create_date"] = $obj->currentDate;
            $subcategoryData["modify_date"] = $obj->currentDate; 
            $result=$obj->myUpdate("tbl_category", $subcategoryData,array("category_id"=>$_GET["id"]));
            if ($result>0) {
                        $obj->Redirect("sub-category-display.php");
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
                            <li class="breadcrumb-item active">Sub Category Update</li>
							<li class="ml-auto d-lg-flex d-none">
								
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Sub Category Update</h4>
									</div>
									<div class="card-body">
									    <form  method="post" action="#" id="form" enctype="multipart/form-data">
                        <div class="row">
                           
                           <div class="form-group col-lg-12">
                              
                            <select class="form-control" name="mcname" required="">
                                                    <option selected hidden value="<?php if (isset($_GET['id'])) { echo $rData['mcategory_id']; } ?>"><?php if (isset($_GET['id'])) { echo $rData['mcategory']; } ?></option>
                                                    <?php 
                                                        while ($list=mysqli_fetch_assoc($mcategory)) 
                                                        {
                                                            ?>
                                                                <option value="<?php echo $list['category_id']; ?>"><?php echo $list['name'];?></option>
                                                            <?php    
                                                        }
                                                    ?>
                                    </select>
                             <input type="text"  class="form-control" name="scategoryname"  placeholder="" value="<?php if (isset($_GET['id'])) { echo $rData['name']; }?>" required="">
                                <input type="file" class="form-control" name="image" required="">
                           </div>
                          
                           
                        <div class="text-center m-auto">
                           <button type="submit" name="btn_send" class="btn btn-primary loginbtn">Update</button>
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