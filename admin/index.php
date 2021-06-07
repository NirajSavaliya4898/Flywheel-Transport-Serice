<?php
	require '../Config.php';
	$obj=new Config();
	$obj->AdminWall();
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<?php
			require "header.php";
		?>
		
	</head>

	<body class="app ">
		<!-- <div id="spinner"></div> -->
		<div id="app" class="page">
			<div class="main-wrapper page-main" >
				<?php
					require "navigation.php"
				?>
				<div class="container content-area">
					<section class="section">
                    	<ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>

						<div class="row">
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-briefcase"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
													<div class='numscroller text-info h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_business'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_business'); ?></div>
														 Total Business
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-users"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
													 <div class='numscroller text-purple h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_registration'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_registration'); ?></div>
                                    					Total Users
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-eye""></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
												    <div class='numscroller text-danger h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_email_subscribe'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_email_subscribe'); ?></div>
                                						Today Visitor
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-envelope-o"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
												    <div class='numscroller text-primary h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_email_subscribe'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_email_subscribe'); ?></div>
                                    					Total Subscriber
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-bars"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
													<div class='numscroller text-info h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_category','main'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_category','main'); ?></div>
                                    					Total Main Category
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-bars"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
													<div class='numscroller text-purple h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_category','sub'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_category','sub'); ?></div>
                                    					Total Sub Category
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-globe""></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
												    <div class='numscroller text-primary h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_location','country'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_location','country'); ?></div>
                                    					Total Country
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-location-arrow"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
												    <div class='numscroller text-danger h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_location','state'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_location','state'); ?></div>
                                    					Total State
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-home"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
													<div class='numscroller text-info h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_location','city'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_location','city'); ?></div>
                                    					Total City
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-university"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
												    <div class='numscroller text-danger h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_bank'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_bank'); ?></div>
                                    					Total Bank
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<!-- <div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="m-auto" style="font-size: 53px;margin-top: 10px;"><i class="fa fa-location-arrow"></i></span>
											</div>
											<div class="col-7">
												<div class="numbers">
												    <div class='numscroller text-danger h1' data-min='1' data-max='<?php echo $obj->Counter('tbl_location','state'); ?>' data-delay='5' data-increment='1'><?php echo $obj->Counter('tbl_location','state'); ?></div>
                                    					Today State
												</div>
											</div>
										</div>
                                    </div>
							    </div>
							</div> -->
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

<!-- Mirrored from spruko.com/demo/asta/Horizontal-Light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 03:49:38 GMT -->
</html>