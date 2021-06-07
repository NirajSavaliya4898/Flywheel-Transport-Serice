<?php
	require "Config.php";
    $obj=new Config();

     $RegisterType=$obj->RegisterType;
     if($RegisterType=="user")
     {
     	$upData["last_login"]=$_SESSION['LastLogin'];
	    $where["email_id"]=$obj->UserKey;
	    $obj->myUpdate("tbl_registration",$upData,$where);
     }
     else
     {
     	$upData["last_login"]=$_SESSION['LastLogin'];
	    $where["email_id"]=$obj->UserKey;
	    $obj->myUpdate("tbl_business",$upData,$where);
     }
	
    unset($_SESSION['RegisterType']);
	unset($_SESSION['UserWall']); 	
	unset($_SESSION['LastLogin']);
	
    $obj->Redirect("index.php");
?>
 
   