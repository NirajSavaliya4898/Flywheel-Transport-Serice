    <?php
require '../Config.php';
$obj=new Config();
$obj->AdminWall();
// $obj->checkSuper();
$country=$obj->myQuery("select * from tbl_location where label='country'");
     $error="";
    if(isset($_POST["btn_send"])){      
            $locationData["name"] = $_POST["statename"];
            $locationData["parentkey"]=$_POST["cname"];
            $locationData["label"]="state";
            $locationData["remote_ip"] = $obj->remote_ip;
            $locationData["create_date"] = $obj->currentDate;
            $locationData["modify_date"] = $obj->currentDate; 
            $result=$obj->myUpdate("tbl_location", $locationData,array("location_id"=>$_GET["id"]));
            if($result>0){
                $obj->Redirect("state-display.php");
            }else{
                $error="<div class=\"alert alert-danger\">Something Wrong...</div>";
            }
    }
if (isset($_GET['id'])) {

$rData=$obj->myQuery("SELECT c.name AS country, c.`location_id` AS country_id, s.* FROM `tbl_location` AS s, `tbl_location` AS c WHERE c.`location_id` = s.`parentkey` AND s.`location_id` = '".$_GET['id']."'")->fetch_assoc();
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
                            <li class="breadcrumb-item active">State Update</li>
							<li class="ml-auto d-lg-flex d-none">
								
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>State Update</h4>
									</div>
									<div class="card-body">
									    <form  method="post" action="#" id="form">
                        <div class="row">
                           
                           <div class="form-group col-lg-12">
                              
                              <select class="form-control" name="cname" required="">
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
                              <input type="text"  class="form-control" name="statename" required="" placeholder="" value="<?php if (isset($_GET['id'])) { echo $rData['name']; }?>" style="margin-top: 12px">
                           </div>
                          
                           
                        <div class="text-center m-auto">
                           <button type="submit" name="btn_send" class="btn btn-primary loginbtn">Update</button>
                           <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                          <?<?php  ?>
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