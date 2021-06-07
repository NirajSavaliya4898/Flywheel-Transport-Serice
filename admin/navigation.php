<?php
	 $chk_Admin=$obj->myQuery("select * from tbl_admin_login WHERE  email_id='".$_SESSION["AdminWall"]."' and type='1'")->num_rows;
?>
<nav class="navbar navbar-expand-lg main-navbar" id="headerMenuCollapse">
					<div class="container">

						<a id="horizontal-navtoggle" class="animated-arrow"><span></span></a>
						<a class="header-brand mr-auto" href="index.php">
							<img src="img/brand/logo3.png" class="header-brand-img" alt="  transport  logo">
						</a>

						<ul class="navbar-nav navbar-right ">
							<?php 
										if (isset($_SESSION["AdminWall"])) 
										{
											?>
										<li class="dropdown dropdown-list-toggle d-none d-lg-block">
										   <a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg" aria-expanded="false"><i class="fa fa-bell-o"></i>
										   </a><span class=" bg-danger chk_noti"></span> 
										   <div class="dropdown-menu dropdown-list dropdown-menu-right">
										      <div class="dropdown-header">
										         Notifications 
										         <div class="float-right"></div>
										      </div>
										      <div class="dropdown-list-content">
										         
										      </div>
										   </div>
										</li>	
										<?php
									}
									?>
							
							<li class="dropdown">
								<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg" aria-expanded="false">
									<?php 
										$Data_R=$obj->myQuery("SELECT * FROM `tbl_admin_login` where email_id='".$_SESSION["AdminWall"]."'")->fetch_assoc();
										if (isset($_SESSION["AdminWall"])) 
										{
											?>
										<img src="<?php echo $obj->WebPath.$Data_R["profile"]; ?>" class="rounded-circle w-32">
										<div class="d-sm-none d-lg-inline-block text-capitalize pr-2"><?php echo $Data_R["name"]; ?></div>
										<?php
									}
									?>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<ul>
										<?php
												if (isset($_SESSION["AdminWall"])) 
												{
													?>
										<li href="#" class="dropdown-item has-icon">
											<a href="changepassword.php" style="text-decoration: none;">Change Password</a><br><br>
												<?php
											if ($chk_Admin==1) 
											{
												?>
															<a href="register.php" style="text-decoration: none;">Add New Admin</a>			
												<?php
											}
										?>
										
										</li>
										<?php
									}
									?>
										<li href="#" class="dropdown-item has-icon">
											<?php
												if (isset($_SESSION["AdminWall"])) 
												{
													?>
														<a href="logout.php" style="text-decoration: none;">Logout</a>
													<?php
												}
												else
												{
													?>
														<a href="login.php" style="text-decoration: none;">Login</a>
													<?php
												}
											?>
										</li>

									</ul>
								</div>
							</li>
						</ul>	
					</div>
				</nav>
				<!--Horizontal-menu-->
				<div class="horizontal-main clearfix">
					<div class="horizontal-mainwrapper container clearfix">
						<nav class="horizontalMenu clearfix">
							<ul class="horizontalMenu-list">
								<li aria-haspopup="true"><a href="index.php" ><i class="fa fa-desktop"></i> Dashboard</a>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon active"><i class="fa fa-home" aria-hidden="true"></i>Location</a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="country-display.php">Country</a></li>
										<li aria-haspopup="true"><a href="state-display.php">State</a></li>
										<li aria-haspopup="true"><a href="city-display.php">City</a></li>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-list"></i>Category<span class="wsarrow"></span></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="main-category-display.php">Main Category</a></li>
										<li aria-haspopup="true"><a href="sub-category-display.php">Sub Category</a></li>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-user"></i>Register<span class="wsarrow"></span></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="adminregister-display.php">Admin Register Display</a></li>
										<li aria-haspopup="true"><a href="client-register-display.php">Client Register Display</a></li>
										<li aria-haspopup="true"><a href="business-register-display.php">Business Register Display</a></li>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-info"></i>User-info<span class="wsarrow"></span></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="email-subscribe.php">Email Subscribe</a></li>
										<li aria-haspopup="true"><a href="contact.php">Contact</a></li>
										<!-- <li aria-haspopup="true"><a href="feedback.php">Feedback</a></li> -->
									</ul>
								</li>
								<li aria-haspopup="true"><a href="" class="sub-icon"><i class="fa fa-bars"></i>Pages<span class="wsarrow"></span></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="bank-display.php">Bank</a></li>
										<!-- <li aria-haspopup="true"><a href="banner-display.php">Banner</a></li> -->
										<li aria-haspopup="true"><a href="package-display.php">Package</a></li>
									</ul>		
								</li>
								<?php
											$Data=$obj->myQuery("SELECT * FROM `tbl_menu` where parentkey=0");
											while ($lstmenu=$Data->fetch_assoc()) 
											{
												if($lstmenu["child"]==0){
													?>
													<li aria-haspopup="true"><a href="<?php echo $lstmenu["link"]; ?>"><i class="fa fa-menu"></i><?php  echo $lstmenu['name']; ?><span class="wsarrow"></span></a>										
													</li>
													<?php
												}else{
													?>
													<li aria-haspopup="true" class="sub-icon"><a href="#"><i class="fa fa-menu"></i><?php  echo $lstmenu['name']; ?><span class="wsarrow"></span>
													<ul class="sub-menu">
													<?php
														$Data2=$obj->myQuery("SELECT * FROM `tbl_menu` where parentkey={$lstmenu['menu_id']}");
														while ($lstmenu1=$Data2->fetch_assoc()) 
														{
													?>
													<li aria-haspopup="true"><a href="<?php echo $lstmenu1["link"]; ?>"><?php  echo $lstmenu1['name']; ?></a></li>
													<?php
														}
													?>
												</ul>
																						
													</li>
													<?php
												}
												?>
															
												<?php
											}
									?>								
								<li aria-haspopup="true"><a href="" class="sub-icon"><i class="fa fa-bars"></i>Menu<span class="wsarrow"></span></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="addmenu.php">Add menu</a></li>
										<!-- <li aria-haspopup="true"><a href="banner-display.php">Banner</a></li> -->
										<li aria-haspopup="true"><a href="submenu.php">Sub menu</a></li>
									</ul>		
								</li>
							</ul>
						</nav>
						<!--Menu HTML Code-->
					</div>
				</div>
