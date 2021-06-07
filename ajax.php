<?php
 	require "Config.php";
	$obj=new Config();

	$action=$_POST['action'];

	if ($action=="emailsub") 
	{
		$count=$obj->myQuery("SELECT * FROM `tbl_email_subscribe` WHERE `email_id`='".$_POST['email_id']."'")->num_rows;
		if ($count==0) 
		{
			$insert_data['email_id'] = $_POST['email_id'];
			$res=$obj->myInsert("tbl_email_subscribe",$insert_data); 
			if ($res>0) 
			{
				echo "Thank You For Subscriber. <span class='pl-2 remove_es'>X</span>";
			} 			
		}
		else
		{
			echo "Sorry, This Email Already Subscribed. <span class='pl-2 remove_es'>X</span>";
		}
	}
	elseif ($action=="state_select")
    {	
        $country_id=$_POST['country_id'];
       	$state=$obj->myQuery("SELECT * FROM `tbl_location` WHERE `parentkey`='$country_id' and label='state'");
       	echo "<option selected hidden>Select State</option>";
       	while ($row=$state->fetch_assoc()) 
       	{
       		?>
       			<option value="<?php echo $row['location_id']; ?>"><?php echo $row['name']; ?></option>}
       		<?php
       	}
    }
	elseif ($action=="city_select")
    {	
        $state_id=$_POST['state_id'];
       	$city=$obj->myQuery("SELECT * FROM `tbl_location` WHERE `parentkey`='$state_id' and label='city'");
       	echo "<option selected hidden>Select City</option>";
       	while ($row=$city->fetch_assoc()) 
       	{
       		?>
       			<option value="<?php echo $row['location_id']; ?>"><?php echo $row['name']; ?></option>}
       		<?php
       	}
    }   
     elseif ($action=="sub_category_select")
    {   
        $location_id=$_POST['location_id'];
        $location=$obj->myQuery("SELECT * FROM `tbl_category` WHERE `parentkey`='$location_id' and label='sub'");
        echo "<option selected hidden>Select Sub Category</option>";
        while ($row=$location->fetch_assoc()) 
        {
            ?>
                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></option>}
            <?php
        }
    }
    elseif($action=="sub_category_checkbox"){
       $location_id=$_POST['location_id'];
        $location=$obj->myQuery("SELECT * FROM `tbl_category` WHERE `parentkey`='$location_id' and label='sub'");
      
        while ($row=$location->fetch_assoc()) 
        {

            $chkData=$obj->myQuery("select * from tbl_business where business_id=".$obj->Businessid($obj->UserKey)." and category_id like '%".$row["category_id"]."%'")->num_rows;
            if($chkData>=1){
              ?>
               <label><input type="checkbox" name="category_id[]" checked="" value="<?php echo $row['category_id']; ?>"> <?php echo $row['name']; ?></label>
              <?php
            }else{
            ?>


       <label><input type="checkbox" name="category_id[]" value="<?php echo $row['category_id']; ?>"> <?php echo $row['name']; ?></label>


       <?php
        }
        }
    }
    elseif($action=="Cancel_order"){
        
        echo $InsData["status"]='D';
        $where=$_POST['order_id'];
        $obj->myUpdate("tbl_order",$InsData,$where);
      
  
    }
?>