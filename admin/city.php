  <?php
    require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();

      $country=$obj->myQuery("select * from tbl_location where label='country'");
      $error="";
    if(isset($_POST["btn_send"])){      
            $locationData["name"] = $_POST["name"];
            $locationData["parentkey"]=$_POST["state_id"];
            $locationData["label"]="city";
            $locationData["remote_ip"] = $obj->remote_ip;
            $locationData["create_date"] = $obj->currentDate;
            $locationData["modify_date"] = $obj->currentDate; 
            $result=$obj->myInsert("tbl_location", $locationData);
            if($result>0){
                $error="<div class=\"alert alert-success\">City Add Successfully.</div>";
            }else{
                $error="<div class=\"alert alert-danger\">Something Wrong...</div>";
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
                            <li class="breadcrumb-item active">  Add City</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="city-display.php" class="btn btn-primary"><i class="fa fa-list "></i> City Display</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>ADD City</h4>
									</div>
									<div class="card-body">
									    <form  method="post" action="#" id="form" class="bValidator">
                        <div class="row">
                           
                           <div class="form-group col-lg-12">
                             
                                
                                  <select class="form-control" name="country_id" required="" id="Country">
                                                    <option value="" >Select Country</option>
                                                    <?php 
                                                        while ($list=mysqli_fetch_assoc($country)) 
                                                        {
                                                            ?>
                                                                <option value="<?php echo $list['location_id']; ?>"><?php echo $list['name'];?></option>
                                                            <?php    
                                                        }
                                                    ?>
                                    </select>
                                    <select  style="margin-top:10px;" class="form-control" name="state_id" id="State" required="" >
                                                    <option value="">Select State</option>
                                                    
                                    </select>
                              <input style="margin-top:10px;" type="text" class="form-control" name="name"  placeholder="Enter City Name" id="city" data-bvalidator="required" data-bvalidator-msg="Please Enter the City Name">
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