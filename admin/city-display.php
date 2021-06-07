<?php
require '../Config.php';
$obj=new Config();
$obj->AdminWall();
// $obj->checkSuper();
if(isset($_GET["id"])){
    $wh["location_id"]=$_GET["id"];
    $obj->myDelete("tbl_location",$wh);
    $obj->Redirect("city-display.php");
}


$rData=$obj->myQuery( "SELECT c.`name` AS country_name, s.`name` As state_name,ci.* 
                            FROM `tbl_location` AS c, `tbl_location` AS s,`tbl_location` AS ci 
                            WHERE ci.`parentkey` = s.`location_id` AND s.`parentkey`=c.`location_id` AND ci.`label`='city'" );
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
                            <li class="breadcrumb-item active" aria-current="page"> City Display</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="city.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add City</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>City Display</h4>
									</div>
									<div class="card-body">
										<table class="table table-bordered mytable" >
                                    <thead>
                                       <tr>
                                            <th>NO</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Remote IP</th>
                                            <th>Create Date</th>
                                            <th>Modify Date</th>
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
                                                <td><?php echo $row['country_name']; ?></td>
                                                <td><?php echo $row['state_name']; ?></td>
                                                <td><?php echo $row["name"]; ?></td>
                                                <td><?php echo $row["remote_ip"]; ?></td>
                                                <td><?php echo $obj->convertDate($row["create_date"]); ?></td>
                                                <td><?php echo $obj->convertDate($row["modify_date"]); ?></td>
                                                <td><a href="city-update.php?id=<?php echo $row["location_id"]; ?>"><span  title="Update"><i style="font-size:23px;margin-left: 10px;" class="fa fa-pencil-square-o text-center" aria-hidden="true"></i>
                                                         </span></a>                                         
                                                 
                                                 <a href="city-display.php?id=<?php echo $row["location_id"]; ?>" onClick="return confirm('are you sure delete this record ?');"><span title="Delete"><i style="font-size:23px;" class="fa fa-trash-o" aria-hidden="true"></i>
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