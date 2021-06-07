    <?php
    require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
    if(isset($_POST["btn_send"])){

        $count=$obj->myQuery("select * from tbl_menu where menu_id='".$_POST["menu_id"]."'")->num_rows;
        if($count==0) {
            $locationData["name"] = $_POST["name"];
            if($_POST["child"]==0){
				$locationData["link"] = $_POST["link"];
            }
            $locationData["child"] = $_POST["child"];
            $locationData["parentkey"] = 0;
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
                           							<input type="radio" name="child" value="1" checked > Child
                           							<input type="radio" name="child" value="0"> No Child
                           						</div>
                                               <div class="form-group col-lg-12">
                                                  <input  type="text" class="form-control" name="name" placeholder="Enter Menu Name" required="">
                                                   <input type="text" id="link" class="form-control" style="margin-top: 10px;display: none;" name="link"  placeholder="link" >
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
		<script type="text/javascript">
			
				$("input[name=child]").click(function(event) {
					if($(this).val()==1){

						$("#link").hide();

					}else{
						$("#link").show();
					}
				});

		</script>
	 </body>
</html>