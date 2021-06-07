<?php
session_start();
error_reporting(0);
class Config{

	public $con;
	public $currentDate;
    public  $remote_ip;
    public  $AdminKey;
    public  $UserKey;
    public $WebPath;
    public $FileUploadPath;
    public $FileUploadName;
    public $RegisterType;
	public function __construct(){

		$HOSTNAME="localhost";
		$USERNAME="root";
		$PASSWORD="";
		$DBNAME="db_transport";
		$this->con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DBNAME);
		if(!$this->con){
			
			echo "Not Connected";
		}


		if(isset($_SESSION["AdminWall"])){
			$this->AdminKey=$_SESSION["AdminWall"];
		}
		if(isset($_SESSION["UserWall"])){
			$this->UserKey=$_SESSION["UserWall"];
		}
		if(isset($_SESSION["RegisterType"])){
			$this->RegisterType=$_SESSION["RegisterType"];
		}
		$this->WebPath="http://localhost/transport/admin/img/uploads/";//Display
		$this->FileUploadPath=$_SERVER["DOCUMENT_ROOT"]."/transport/admin/img/uploads/";// Upload & Delete
		$this->FileUploadName=date("d-m-Y-h-i-s");
		$this->currentDate=date("Y-m-d h:i:s");
		$this->remote_ip=$_SERVER["REMOTE_ADDR"];
	}
	public function myInsert($tblName,$data){

		$setField="";

		foreach ($data as $fieldName => $value) {
			$setField.="`$fieldName`='$value',";
		}
		$setField=trim($setField,",");
		 $query="INSERT INTO `$tblName` SET $setField";

		// mysqli_query($this->con,$query);
		return $this->con->query($query);
	}
	public function myDelete($tblName,$where=null,$op="AND")
	{
		$wh="";
		if($where!=null){
			$wh=" WHERE ";
			foreach ($where as $fieldName => $value) {
				$wh.="`$fieldName`='$value' $op ";
			}
			$wh=trim($wh,"$op ");
		}
		$query="DELETE FROM $tblName $wh";
		return $this->con->query($query);
	}
	public function myUpdate($tblName,$data,$where=null,$op="AND")
	{
		$setField="";
		$wh="";
		if($where!=null){
			$wh=" WHERE ";
			foreach ($where as $fieldName => $value) {
				$wh.="`$fieldName`='$value' $op ";
			}
			$wh=trim($wh,"$op ");
		}
		foreach ($data as $fieldName => $value) {
			$setField.="`$fieldName`='$value',";
		}

		$setField=trim($setField,",");
	   	$query="UPDATE $tblName SET $setField $wh";
	    return $this->con->query($query);
	}
	 public function myQuery($query)
    {
       return $this->con->query($query);
    }
    public function Redirect($location){
	    header("Location:$location");
    }
   public function AdminWall(){
        if(!isset($this->AdminKey)){
            $this->Redirect("login.php");
        }
    }
     public function UserWall(){
        if(!isset($this->UserKey)){
            $this->Redirect("index.php");
        }
    }
    
    
    public function Businessid($email_id)
		{
			$Data=$this->myQuery("SELECT `business_id` FROM `tbl_business` WHERE `email_id`='".$email_id."'")->fetch_assoc();
			return $Data['business_id'];
		}
		public function Registrationid($email_id)
		{
			$Data=$this->myQuery("SELECT `registration_id` FROM `tbl_registration` WHERE `email_id`='".$email_id."'")->fetch_assoc();
			return $Data['registration_id'];
		}
     public function convertDate($date){
        return date("d-m-Y h:i:s",strtotime($date));
    }
    public  function checkSuper(){
       $count=$this->myQuery("select * from tbl_admin_login WHERE  email_id='".$this->AdminKey."' and type='1'")->num_rows;
        if($count==0){
           $this->Redirect("login.php");
        }
    }

  

    public function Counter($tbl_name,$label=null)
		{
			if ($label!=null) 
			{
				return $this->myQuery("SELECT * FROM `$tbl_name` WHERE `label`='$label'")->num_rows;
			}
			else{
				return $this->myQuery("SELECT * FROM `$tbl_name`")->num_rows;
			}
		}
}
