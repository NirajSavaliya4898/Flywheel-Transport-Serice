    <?php
    require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
    if(isset($_POST["btn_send"])){

        $count=$obj->myQuery("select * from tbl_location where location_id='".$_POST["location_id"]."'")->num_rows;
        if($count==0) {
            $locationData["name"] = $_POST["name"];
            $locationData["remote_ip"] = $obj->remote_ip;
            $locationData["create_date"] = $obj->currentDate;
            $locationData["modify_date"] = $obj->currentDate; 
            $result=$obj->myInsert("tbl_location", $locationData);
            if($result>0){
                $error="<div class=\"alert alert-success\">Country Add Successfully.</div>";
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
                            <li class="breadcrumb-item active">  Add country</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="country-display.php" class="btn btn-primary"><i class="fa fa-list "></i> Country Display</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>ADD COUNTRY</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form" class="bValidator">
                                            <div class="row">
                           
                                               <div class="form-group col-lg-12" >
                                                  <input  type="text" class="form-control" name="name"  placeholder="Enter Country Name" data-bvalidator="required" data-bvalidator-msg="Please Enter the Country Name">
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