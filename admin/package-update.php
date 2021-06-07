 	<?php
    require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
 $query="select * from tbl_package where package_id='".$_POST["package_id"]."'  and package_id!=".$_GET["id"];
      
      $error="";
    if (isset($_POST['btn_send'])) 
    {
      $count=$obj->myQuery($query)->num_rows;
        if ($count==0) 
        {
             $packageData['name']=$_POST['name'];
            $packageData['description']=$_POST['description'];
            $packageData['prize']=$_POST['prize'];
            $packageData['duration']=$_POST['duration'];
            $packageData["remote_ip"] = $obj->remote_ip;
            $packageData["create_date"] = $obj->currentDate;
            $packageData["modify_date"] = $obj->currentDate;             
            $result=$obj->myUpdate("tbl_package",$packageData,array("package_id"=>$_GET["id"]));
            if($result>0){
                $obj->Redirect("package-display.php");
            }else{
                $error="<div class=\"alert alert-danger\">Something Wrong...</div>";
            }
        }
    }
if (isset($_GET['id'])) {
$rData=$obj->myQuery("select * from tbl_package where package_id=".$_GET["id"])->fetch_assoc();
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
                            <li class="breadcrumb-item active">Package Update</li>
							<li class="ml-auto d-lg-flex d-none">								
							</li>
                        </ol>
						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Package Update</h4>
									</div>
									<div class="card-body">
									    <form  method="post" action="#" id="form">
                        					<div class="row">
                           
					                           <div class="form-group col-lg-12">
					                             
					                                
					                              
					                                <input  type="text" class="form-control" placeholder="Enter Package name" name="name" id="Bank" required="" value="<?php if(isset($_GET['id'])) { echo $rData  ['name']; } ?>" >
						                              <textarea name="description" placeholder="Description" required="" value="<?php if(isset($_GET['id'])) { echo $rData  ['description']; } ?>"></textarea>
						                              <input  type="text" class="form-control" placeholder="Enter Prize" name="prize" id="Bank" required="" value="<?php if(isset($_GET['id'])) { echo $rData  ['prize']; } ?>">
						                               <input  type="text" class="form-control" placeholder="Duration on Month" name="duration" id="Bank" required="" value="<?php if(isset($_GET['id'])) { echo $rData  ['duration']; } ?>">
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