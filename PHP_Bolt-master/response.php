<?php

    require "../Config.php";
    $obj=new Config();
    
    $postdata = $_POST;

    if (isset($postdata ['key'])) 
    {
    	$oid  		= 	$postdata['productinfo'];
    }
    $O_Status["status"]="S";
    $O_S_Wh["order_id"]=$oid;
    $result4=$obj->myUpdate("tbl_order",$O_Status,$O_S_Wh);
    if ($result4>0) 
    {   
        $obj->Redirect('../rnr.php?oid='.$oid);
    }
?>