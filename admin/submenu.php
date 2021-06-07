    <?php
    require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
    $child=$obj->myQuery("SELECT * FROM `tbl_menu` WHERE child = 1");
    if(isset($_POST["btn_send"])){
    	

        $count=$obj->myQuery("select * from tbl_menu where menu_id='".$_POST["menu_id"]."'")->num_rows;
        if($count==0) {
            $locationData["name"] = $_POST["name"];
            
				$locationData["link"] = $_POST["link"];
            
            $locationData["parentkey"] = $_POST["parentkey"];
            $locationData["child"] = 2;

            $locationData["remote_ip"] = $obj->remote_ip;
            $locationData["create_date"] = $obj->currentDate;
            $locationData["modify_date"] = $obj->currentDate; 
            $result=$obj->myInsert("tbl_menu", $locationData);
            if($result>0){
                $error="<div class=\"alert alert-success\">Add Successfully.</div>";
            }else{
                $error="<div class=\"alert alert-danger\">Something Wrong...</div>";
            }
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
                            <li class="breadcrumb-item active">  Add New Menu</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Add New Menu</h4>
									</div>
									<div class="card-body">
									     <form  method="post"  id="form">
                                            <div class="row">
                           						<div class="form-group col-lg-12">
                           							 <select class="form-control" name="parentkey"  required="" >
                                                    <option value="">Select Child</option>
                                                    <?php 
                                                        while ($list=mysqli_fetch_assoc($child)) 
                                                        {
                                                            ?>
                                                                <option value="<?php echo $list['menu_id']; ?>"><?php echo $list['name'];?></option>
                                                            <?php    
                                                        }
                                                    ?>
                                    				</select>
                           						</div>
                                               <div class="form-group col-lg-12">
                                                  <input  type="text" class="form-control" name="name" placeholder="Enter Menu Name" required="">
                                                   <input  type="text" class="form-control" name="link" placeholder="Enter link" required="" style="margin-top:10px;">
                                               </div>               
                                                <div class="text-center m-auto">
                                                   <button type="submit" name="btn_send" class="btn btn-primary">Submit</button>
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