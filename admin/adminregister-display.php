    <?php
require '../Config.php';
$obj=new Config();
$obj->AdminWall();
$obj->checkSuper();
if(isset($_GET["id"])){
    $wh["admin_login_id"]=$_GET["id"];
    $obj->myDelete("tbl_admin_login",$wh);
    $obj->Redirect("adminregister-display.php");
}


$rData=$obj->myQuery("select * from tbl_admin_login ORDER by email_id DESC ");

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
                            <li class="breadcrumb-item active" aria-current="page">Register Display</li>
							<li class="ml-auto d-lg-flex d-none">
								
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Register Display</h4>
									</div>
									<div class="card-body">
										<table class="table table-bordered   mytable" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email Id</th>
                                            <th>Remote IP</th>
                                            <th>Create Date</th>
                                            <th>Modify Date</th>
                                            <th>Last Login</th>
                                            <th>Status</th>
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
                                                <td><?php echo $row["email_id"]; ?></td>
                                                <td><?php echo $row["remote_ip"]; ?></td>
                                                <td><?php echo $obj->convertDate($row["create_date"]); ?></td>
                                                <td><?php echo $obj->convertDate($row["modify_date"]); ?></td>
                                                <td><?php echo $obj->convertDate($row["last_login"]); ?></td>
                                                <td data-priority="1"><input id="Admin_status" type="checkbox" data-toggle="toggle" <?php if ($row['status']=="E") { ?> checked <?php } ?> value="<?php echo $row['admin_login_id']; ?>" data-on="True" data-off="False">
                                                </td>
                                                <td><a href="adminregister-display.php?id=<?php echo $row["admin_login_id"]; ?>" onClick="return confirm('are you sure delete this record ?');"><span title="Delete"><i style="font-size:23px;" class="fa fa-trash-o" aria-hidden="true"></i>
                                                         </span></a>
                                                
                                                 </td>
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