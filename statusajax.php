<?php
	require 'Config.php';
	$obj=new Config();
		$action=$_POST["edstatus"];
		$registration_id=$_POST['registration_id'];
        $status=$obj->myQuery("SELECT `status` FROM `tbl_registration` WHERE `registration_id`='$registration_id'")->fetch_assoc();
        if($status['status']=="E")
        {
            $updatedata["status"]="D";
            $where["registration_id"]=$registration_id;
            $obj->myUpdate("tbl_registration",$updatedata,$where);
        }
        else
        {
            $updatedata["status"]="E";
            $where["registration_id"]=$registration_id;
            $obj->myUpdate("tbl_registration",$updatedata,$where);
        }
?>        