 <?php
require '../Config.php';
$obj=new Config();
$obj->AdminWall();
// $obj->checkSuper();
 $rData=$obj->myQuery("SELECT * FROM `tbl_email_subscribe`");
if(isset($_GET["id"])){
    $wh["email_subscribe_id"]=$_GET["id"];
    $obj->myDelete("tbl_email_subscribe",$wh);
    $obj->Redirect("email-subscribe.php");
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
                            <li class="breadcrumb-item active" aria-current="page">Email Subscribe Display</li>
							<li class="ml-auto d-lg-flex d-none">
								
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Email Subscribe Display</h4>
									</div>
									<div class="card-body">
										<table class="table table-bordered  mytable" >
                                    <thead>
                                         <tr>
                                            <th>No</th>
                                            <th>Email Id</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>               
                                    <tbody>
                                    <?php
                                        $no=0;
                                        while($row=$rData->fetch_assoc()) {
                                            $no++;
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row["email_id"]; ?></td> 
                                                <td> <a href="email-subscribe.php?id=<?php echo $row["email_subscribe_id"]; ?>" onClick="return confirm('are you sure delete this record ?');"><span title="Delete"><i style="font-size:23px;" class="fa fa-trash-o" aria-hidden="true"></i>
                                                         </span></a></td>                                          
                                                 
                                                
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
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