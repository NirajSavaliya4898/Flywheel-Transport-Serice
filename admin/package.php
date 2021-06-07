 <?php
    require '../Config.php';
    $obj=new Config();
$obj->AdminWall();
      $result=$obj->myQuery("SELECT * FROM `tbl_package`");
      $error="";
    if (isset($_POST['btn_send'])) 
    {
        $count1=$obj->MyQuery("SELECT * FROM `tbl_package` WHERE `package_id`='".$_POST['package_id']."'")->num_rows;
        if ($count1==0) 
        {
            $packageData['name']=$_POST['name'];
            $packageData['description']=$_POST['description'];
            $packageData['prize']=$_POST['prize'];
            $packageData['duration']=$_POST['duration'];
            $packageData["remote_ip"] = $obj->remote_ip;
            $packageData["create_date"] = $obj->currentDate;
            $packageData["modify_date"] = $obj->currentDate;            
            $result=$obj->myInsert("tbl_package",$packageData);
            if($result>0){
                $error="<div class=\"alert alert-success\">Package Add Successfully.</div>";
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
                            <li class="breadcrumb-item active">  Add Package</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="package-display.php" class="btn btn-primary"><i class="fa fa-list "></i> Package Display</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>  Add Package</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form" class="bValidator">
                      						  <div class="row">
						                           
						                           <div class="form-group col-lg-12">
						                             
						                                
						                              <input  type="text" class="form-control" placeholder="Enter Package name" name="name" id="Bank"  data-bvalidator="required" data-bvalidator-msg="Please Enter the Package name">
						                              <textarea name="description" class="form-control" placeholder="Description" data-bvalidator="rangelength[5:150],required" data-bvalidator-msg="Description must be between 5 and 150 characters!"></textarea>
						                              <input  type="text" class="form-control" placeholder="Enter Price" name="prize" id="Bank"data-bvalidator="number,required" data-bvalidator-msg="Please enter a price">
						                               <input  type="text" class="form-control" placeholder="Duration on Month" name="duration" id="Bank" data-bvalidator="number,required" data-bvalidator-msg="Please Enter the Duration On Month" >
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