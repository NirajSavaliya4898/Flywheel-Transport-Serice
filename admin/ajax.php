<?php
require '../Config.php';
$obj=new Config();
//sleep(1);
			$action=$_POST["action"];
			if($action=="state_select"){
			    $country_id=$_POST["country_id"];
			    $result=$obj->myQuery("SELECT * FROM `tbl_location` WHERE `parentkey`='$country_id'");
			    echo "<option selected >Select State</option>";

			    while ($row=$result->fetch_assoc()){
			        ?>
			        <option value="<?php echo $row["location_id"]; ?>"><?php echo $row["name"]; ?></option>
			        <?php
			    }

			}
			else if($action=="select_notification")
			{
				$noti=$obj->myQuery("SELECT * FROM `tbl_notification` WHERE `status`='0'");
				while($lst_noti=$noti->fetch_assoc()) 
				{
					?>
					<a href="#" class="dropdown-item" style="position: relative;">
						<div style="position: absolute;right: 20px"><span class="fa fa-remove noti-remove" id="<?php echo $lst_noti['notification_id'];?>"></span></div>
						<div><span class="badge badge-success mb-2 mr-3"><?php echo $lst_noti['title'];?></span><?php echo $lst_noti['sender'];?></div>

			            <div class="dropdown-item-desc"> <b><?php echo $lst_noti['message'];?></b> </div>
			         </a>
				<?php
				}
			}
			else if($action=="remove_notification")
			{
				$updatedata["status"]=1;
	            $where["notification_id"]=$_POST['notification_id'];;
	            $obj->myUpdate("tbl_notification",$updatedata,$where);
				
			}
			else if($action=="Admin_status"){
	            $admin_login_id=$_POST['admin_login_id'];
	            $status=$obj->myQuery("SELECT `status` FROM `tbl_admin_login` WHERE `admin_login_id`='$admin_login_id'")->fetch_assoc();
	            if($status['status']=="E")
	            {
	                $updatedata["status"]="D";
	                $where["admin_login_id"]=$admin_login_id;
	                $obj->myUpdate("tbl_admin_login",$updatedata,$where);
	                             
	            }
	            else
	            {
	                 $updatedata["status"]="E";
	                 $where["admin_login_id"]=$admin_login_id;
	                 $obj->myUpdate("tbl_admin_login",$updatedata,$where);
	                 
	            }
			}
		else if($action=="Client_status"){
	            $admin_login_id=$_POST['registration_id'];
	            $status=$obj->myQuery("SELECT `status` FROM `tbl_registration` WHERE `registration_id`='$admin_login_id'")->fetch_assoc();
	            if($status['status']=="E")
	            {
	                $updatedata["status"]="D";
	                $where["registration_id"]=$admin_login_id;
	                $obj->myUpdate("tbl_registration",$updatedata,$where);
	                             
	            }
	            else
	            {
	                 $updatedata["status"]="E";
	                 $where["registration_id"]=$admin_login_id;
	                 $obj->myUpdate("tbl_registration",$updatedata,$where);
	                 
	            }
			}

			else if($action=="Business_status"){
	            $admin_login_id=$_POST['business_id'];
	            $status=$obj->myQuery("SELECT `status` FROM `tbl_business` WHERE `business_id`='$admin_login_id'")->fetch_assoc();
	            if($status['status']=="E")
	            {
	                $updatedata["status"]="D";
	                $where["business_id"]=$admin_login_id;
	                $obj->myUpdate("tbl_business",$updatedata,$where);
	                             
	            }
	            else
	            {
	                 $updatedata["status"]="E";
	                 $where["business_id"]=$admin_login_id;
	                 $obj->myUpdate("tbl_business",$updatedata,$where);
	                 
	            }
			}
			else if($action=="chk_notification")
			{
				echo $obj->myQuery("SELECT * FROM `tbl_notification` WHERE `status`='0'")->num_rows;
				
			}