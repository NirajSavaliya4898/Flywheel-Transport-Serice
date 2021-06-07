 <?php
require '../Config.php';
$obj=new Config();
$obj->AdminWall();
// $obj->checkSuper();
 $rData=$obj->myQuery("SELECT * FROM `tbl_contact`");
if(isset($_GET["id"])){
    $wh["contact_id"]=$_GET["id"];
    $obj->myDelete("tbl_contact",$wh);
    $obj->Redirect("contact.php");
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
                            <li class="breadcrumb-item active" aria-current="page">Contact Display</li>
							<li class="ml-auto d-lg-flex d-none">
								
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Contact Display</h4>
									</div>
									<div class="card-body">
										<table class="table table-bordered mytable" >
                                    <thead>
                                         <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Contact No</th>
                                            <th>Email Id</th>
                                            <th>Message</th>
                                            <th>Remote Ip</th>
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
                                                <td><?php echo $row["name"]; ?></td>
                                                <td><?php echo $row['contactno']; ?></td>
                                                <td><?php echo $row['email_id']; ?></td>
                                                <td><?php echo $row['message']; ?></td>
                                                <td><?php echo $row["remote_ip"]; ?></td>
                                                <td><?php echo $obj->convertDate($row["create_date"]); ?></td>
                                                <td><?php echo $obj->convertDate($row["modify_date"]); ?></td> 
                                                <td> <a href="contact.php?id=<?php echo $row["contact_id"]; ?>" onClick="return confirm('are you sure delete this record ?');"><span title="Delete"><i style="font-size:23px;" class="fa fa-trash-o" aria-hidden="true"></i>
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