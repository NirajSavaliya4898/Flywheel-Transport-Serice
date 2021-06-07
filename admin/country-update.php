<?php
require '../Config.php';
$obj=new Config();
$obj->AdminWall();
// $obj->checkSuper();
if(isset($_POST["btn_send"])){
    $query="select * from tbl_location where location_id='".$_POST["location_id"]."'  and location_id!=".$_GET["id"];
     $count=$obj->myQuery($query)->num_rows;
    if($count==0) {
        $locationData["name"] = $_POST["name"];
            $locationData["remote_ip"] = $obj->remote_ip;
            $locationData["create_date"] = $obj->currentDate;
            $locationData["modify_date"] = $obj->currentDate;

        //$wh["admin_login_id"]=$_GET["id"];
        $result=$obj->myUpdate("tbl_location", $locationData,array("location_id"=>$_GET["id"]));
        if($result>0){
            $obj->Redirect("country-display.php");
        }else{
            $error="<div class=\"alert alert-danger\">Something Wrong...</div>";
        }
    }
}
if (isset($_GET['id'])) {

$rData=$obj->myQuery("select * from tbl_location where location_id=".$_GET["id"])->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from spruko.com/demo/asta/Horizontal-Light/formelements.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 03:50:58 GMT -->
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
                            <li class="breadcrumb-item active">country Update</li>
							<li class="ml-auto d-lg-flex d-none">
								<!-- <span class="float-left border-">
									<a href="country-display.php" class="btn btn-primary"><i class="fa fa-list "></i> Country Display</a>
								</span> -->
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Country Update</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form">
                                            <div class="row">
                           
                                               <div class="form-group col-lg-12">
                                                 <!--  <label class="cust-text" >
                                                    Country
                                                  </label> -->
                                                
                                                  <input  type="text" class="form-control" name="name" required="" value="<?php echo $rData["name"]; ?>">
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

<!-- Mirrored from spruko.com/demo/asta/Horizontal-Light/formelements.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 03:50:58 GMT -->
</html>