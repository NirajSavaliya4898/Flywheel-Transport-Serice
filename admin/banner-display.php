<?php

    require '../Config.php';
    $obj=new Config();
    $obj->AdminWall();
    // $obj->checkSuper();
    if(isset($_GET["id"]))
    {
        $wh["banner_id"]=$_GET["id"];

        $filename=$obj->myQuery("SELECT `image` FROM `tbl_banner` WHERE  `banner_id`=".$_GET["id"])->fetch_assoc();
        $filename=$filename["image"];
        unlink($obj->FileUploadPath.$filename);

        $obj->myDelete("tbl_banner",$wh);
        $obj->Redirect("banner-display.php");
    }


$rData=$obj->myQuery("select * from tbl_banner ORDER by banner_id DESC ");

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
                            <li class="breadcrumb-item active" aria-current="page">Banner Display</li>
							<li class="ml-auto d-lg-flex d-none">
								<span class="float-left border-">
									<a href="banner.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add Banner</a>
								</span>
																
							</li>
                        </ol>

						<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Banner Display</h4>
									</div>
									<div class="card-body">
										<table class="table  table-bordered mytable" >
                                    <thead>
                                       <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>link</th>
                                            <th>Name</th>
                                            <th>remoteip</th>
                                            <th>createdate</th>
                                            <th>modifydate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                        <?php

                                        $no=0;
                                        $row;
                                        while($row=$rData->fetch_assoc()) 
                                        {
                                            $no++;
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>

                                             <td><img src="<?php echo $obj->WebPath.$row["image"]; ?>" class="zoom-img" width="100px"/></td>
                                             <td><?php echo $row["link"]; ?></td>
                                            <td><?php echo $row["name"]; ?></td>
                                            <td><?php echo $row["remote_ip"]; ?></td>
                                            <td><?php echo $obj->convertDate($row["create_date"]); ?></td>
                                            <td><?php echo $obj->convertDate($row["modify_date"]); ?></td>
                                            <td><a href="banner-update.php?id=<?php echo $row["banner_id"]; ?>"><span  title="Update"><i style="font-size:23px;margin-left: 10px;" class="fa fa-pencil-square-o text-center" aria-hidden="true"></i>
                                                         </span></a>                                         
                                                 
                                                 <a href="banner-display.php?id=<?php echo $row["banner_id"]; ?>" onClick="return confirm('are you sure delete this record ?');"><span title="Delete"><i style="font-size:23px;" class="fa fa-trash-o" aria-hidden="true"></i>
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