 <?php
    require '../Config.php';
    $obj=new Config();
$obj->AdminWall();
      $result=$obj->myQuery("SELECT * FROM `tbl_bank`");
      $error="";
    if (isset($_POST['btn_send'])) 
    {
        $count1=$obj->MyQuery("SELECT * FROM `tbl_bank` WHERE `bank_name`='".$_POST['bname']."'")->num_rows;
        if ($count1==0) 
        {
            $bankData['bank_name']=$_POST['bname'];
            $bankData["remote_ip"] = $obj->remote_ip;
            $bankData["create_date"] = $obj->currentDate;
            $bankData["modify_date"] = $obj->currentDate;            
            $result=$obj->myInsert("tbl_bank",$bankData);
            if($result>0){
                $error="<div class=\"alert alert-success\">Bank Add Successfully.</div>";
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
                            <li class="breadcrumb-item active">  Add Bank</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="bank-display.php" class="btn btn-primary"><i class="fa fa-list "></i> Bank Display</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4> Add Bank</h4>
									</div>
									<div class="card-body">
									     <form  method="post" action="#" id="form" class="bValidator">
                      						  <div class="row">
						                           
						                           <div class="form-group col-lg-12">                                        
						                              <input  type="text" class="form-control" placeholder="Enter Bank name" name="bname" id="Bank" data-bvalidator="required" data-bvalidator-msg="Please Enter the Bank name">
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