    <?php
    require '../Config.php';
    $obj=new Config();
     $obj->AdminWall();
    if (isset($_GET['id'])) 
    {
      $rData=$obj->myQuery("SELECT 
 c.`location_id` as country_id,c.`name` as country,s.`location_id` as state_id,s.`name` as state,ci.*
FROM `tbl_location` as c ,`tbl_location` as s,`tbl_location` as ci
WHERE 
ci.`parentkey`=s.`location_id` and s.`parentkey`=c.`location_id` and ci.`location_id`='".$_GET['id']."'")->fetch_assoc();
    }
      $country=$obj->myQuery("select * from tbl_location where label='country'");
      $error="";
    if(isset($_POST["btn_send"])){      
            $locationData["name"] = $_POST["name"];
            $locationData["parentkey"]=$_POST["state_id"];
            $locationData["label"]="city";
            $locationData["remote_ip"] = $obj->remote_ip;
            $locationData["create_date"] = $obj->currentDate;
            $locationData["modify_date"] = $obj->currentDate; 
            $result=$obj->myUpdate("tbl_location", $locationData,array("location_id"=>$_GET["id"]));
            if($result>0){
              $obj->Redirect("city-display.php");
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
                            <li class="breadcrumb-item active">City Update</li>
							<li class="ml-auto d-lg-flex d-none">
								
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>City Update</h4>
									</div>
									<div class="card-body">
									    <form  method="post" action="#" id="form">
                        <div class="row">
                           
                           <div class="form-group col-lg-12">
                              <label class="cust-text">City Update</label>
                                
                                  <select class="form-control" name="cname" required="" id="Country">
                                                    <option selected hidden value="<?php if (isset($_GET['id'])) { echo $rData['country_id']; } ?>"><?php if (isset($_GET['id'])) { echo $rData['country']; } ?></option>
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
                                                    <option selected hidden value="<?php if (isset($_GET['id'])) { echo $rData['state_id']; } ?>"><?php if (isset($_GET['id'])) { echo $rData['state']; } ?></option>
                                                    
                                    </select>
                              <input style="margin-top:10px;" type="text" class="form-control" name="name"  placeholder="Enter City Name" id="State" value="<?php if (isset($_GET['id'])) { echo $rData['name']; } ?>" required="" >
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