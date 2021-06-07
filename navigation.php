<?php
    if (isset($obj->UserKey)) 
    {
        if ($obj->RegisterType=="user") 
        {
            $Data=$obj->myQuery("SELECT * FROM `tbl_registration` where `email_id`='".$obj->UserKey."'")->fetch_assoc();
        }
        else
        {
            $Data=$obj->myQuery("SELECT * FROM `tbl_business` where `email_id`='".$obj->UserKey."'")->fetch_assoc();
        }
        
    }
?>

<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
				<div class="container-fluid">         
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
						<i class="ti-align-left"></i>
					</button>
					
					<!-- Start Header Navigation -->
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">
							<img src="assets/img/logo2.png" class="logo logo-display" alt="" style="position: absolute;height: 100%;width: 379%;">
							<img src="assets/img/logo2.png" class="logo logo-scrolled" alt="">
						</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbar-menu">
						<ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
							<li class="dropdown">
								<a href="index.php" style="font-weight:900;">HOME</a>
								
							</li>							
							<li class="dropdown">
									<a href="about-us.php" style="font-weight:900;">ABOUT US</a>
							</li>
							<li class="dropdown">
									<a href="contact.php" style="font-weight:900;">CONTACT</a>
							</li>
							<?php
								if (!isset($obj->UserKey)) 
								{
									?>
										<li><a  href="login-register.php" style="font-weight:900;">LOG IN</a></li>
									<?php
								}
								else
								{
									if ($obj->RegisterType=="user") 
									{
										?>
										<li><a  href="mydashboard.php" style="font-weight:900;">My DASHBOARD</a></li><?php
									}
									else{
										?>
										<li><a  href="business-mydashboard.php" style="font-weight:900;">My DASHBOARD</a></li><?php
									}
						
								}	
							?>
						</ul>
			<?php
				if (isset($obj->UserKey)) 
				{
					if ($obj->RegisterType=="user") 
					{
						?>
										
							<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
								<li class="no-pd dropdown">
									<a href="user-profile.php" class="addlist dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $obj->WebPath.$Data['image']; ?>" class="img-responsive img-circle avater-img" alt=""><strong style="color: black;"><?php echo $Data['name']; ?></strong></a>
									<ul class="dropdown-menu animated navbar-left fadeOutUp" style="display: none; opacity: 1;">
										<li><a href="user-profile.php" class="dropdown-toggle">Profile</a></li>
										<li><a href="user-changepassword.php" class="dropdown-toggle">Change Password</a></li>
<!-- 										<li><a href="add-question.php" class="dropdown-toggle">Security Question</a></li> -->
										<li><a href="logout.php" class="">Logout</a></li>
									</ul>
								</li>
							</ul>
						<?php
					}
					else
					{
						?>
										
							<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
								<li class="no-pd dropdown">
									<a href="business-profile-display.php" class="addlist"><img src="<?php echo $obj->WebPath.$Data['logo']; ?>" class="img-responsive img-circle avater-img" alt=""><strong style="color:black;"><?php echo $Data['name']; ?></strong></a>
									<ul class="dropdown-menu animated navbar-left fadeOutUp" style="display: none; opacity: 1;">
										<li><a href="business-profile-display.php">Profile</a></li>
										<li><a href="business-changepassword.php">Change Password</a></li>
										<!-- <li><a href="add-question.php">Security Question</a></li> -->
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>
							</ul>
						<?php
					}
				}	
			?>
			
					</div>
					<!-- /.navbar-collapse -->
				</div>   
			</nav>