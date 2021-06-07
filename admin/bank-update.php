 	<?php
    require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
 $query="select * from tbl_bank where bank_id='".$_POST["bank_id"]."'  and bank_id!=".$_GET["id"];
      
      $error="";
    if (isset($_POST['btn_send'])) 
    {
      $count=$obj->myQuery($query)->num_rows;
        if ($count==0) 
        {
            $bankData['bank_name']=$_POST['bname'];
            $bankData["remote_ip"] = $obj->remote_ip;
            $bankData["create_date"] = $obj->currentDate;
            $bankData["modify_date"] = $obj->currentDate;            
            $result=$obj->myUpdate("tbl_bank",$bankData,array("bank_id"=>$_GET["id"]));
            if($result>0){
                $obj->Redirect("bank-display.php");
            }else{
                $error="<div class=\"alert alert-danger\">Something Wrong...</div>";
            }
        }
    }
if (isset($_GET['id'])) {
$rData=$obj->myQuery("select * from tbl_bank where bank_id=".$_GET["id"])->fetch_assoc();
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
                            <li class="breadcrumb-item active">Bank Update</li>
							<li class="ml-auto d-lg-flex d-none">								
							</li>
                        </ol>
						<div class="row">
							<div class="col-xs-12 col-sm-6 m-auto" > 
								<div class="card">
									<div class="card-header">
										<h4>Bank Update</h4>
									</div>
									<div class="card-body">
									    <form  method="post" action="#" id="form">
                        					<div class="row">
                           
					                           <div class="form-group col-lg-12">
					                             
					                                
					                              <input  type="text" class="form-control" placeholder="" name="bname" value="<?php if(isset($_GET['id'])) { echo $rData  ['bank_name']; } ?>" id="Bank" required="" >
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