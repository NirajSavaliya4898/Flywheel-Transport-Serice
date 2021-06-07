<?php

require "../Config.php";
$obj=new Config();
$updata["last_login"]=$_SESSION['LastLogin'];
$where["user_id"]=$obj->AdminKey;
$obj->myUpdate("tbl_admin_login",$updata,$where);

unset($_SESSION["AdminWall"]);
unset($_SESSION["LastLogin"]);
setcookie("user_id","bye");


$obj->Redirect("login.php");