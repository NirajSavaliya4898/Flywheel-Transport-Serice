<?php

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

	require "../../Config.php";
	$obj=new Config();

	if(isset($_GET['email_id']))
    {
    	$email=$_GET['email_id'];
		$otp=rand(100000,900000);
		$Send_Mail_Count=0;
		$name="";

		//Save Otp On Databse
        $Business=$obj->MyQuery("SELECT `name` FROM `tbl_business` WHERE `email_id`='$email'");
        $Business_Count=$Business->num_rows;
        if ($Business_Count!=0) 
        {
        	$Business_Data=$Business->fetch_assoc();
            $Business_Otp["otp"]=$otp;
	        $Business_Eamil_Id['email_id']=$email;
	        if($obj->MyUpdate("tbl_business",$Business_Otp,$Business_Eamil_Id)!=0)
	        {
	        	$Send_Mail_Count=1;
	        	$name=$Business_Data['name'];
	        }
        }
        else
        {
            $User=$obj->MyQuery("SELECT `email_id` FROM `tbl_registration` WHERE `email_id`='$email'");
            $User_Count=$User->num_rows;
            if ($User_Count!=0) 
            {
            	$User_Data=$User->fetch_assoc();
               	$User_Otp["otp"]=$otp;
		        $User_Eamil_Id['email_id']=$email;
		       	if( $obj->MyUpdate("tbl_registration",$User_Otp,$User_Eamil_Id)!=0)
		       	{
		       		$Send_Mail_Count=1;
		       		$name=$User_Data['name'];
		       	}
            }
            else
            {
            	$Send_Mail_Count=0;
            }
        }     

        //Send Otp From The Mails
        if ($Send_Mail_Count==1) 
        {
        	$date_time=date('d-m-Y h:i:s');
        	$remote_ip=$obj->remote_ip;
		   	$subject = $otp." Is Your Otp Confirmation Code";
	    	$message = "Hey ".$name.","."<br><br>".
	   				   "<b>Never Share Your Otp Or Reset Password</b>"."<br><br>".
	   				   "<b>Date & Time</b> :- ".$date_time."<br>".
	   				   "<b>IP Address</b> &nbsp;&nbsp;&nbsp;:- ".$remote_ip."<br>".
	   				   "<b>Browser</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:- ".get_browser_name($_SERVER['HTTP_USER_AGENT'])."<br>".
					   "<b>Detect By</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:- ".detectDevice()."<br>";

		    //Load composer's autoloader
    		require 'vendor/autoload.php';

		    $mail = new PHPMailer(true);                            
		    try 
		    {
		        //Server settings
		        $mail->isSMTP();                                     
		        $mail->Host = 'smtp.gmail.com';                      
		        $mail->SMTPAuth = true;                             
		        $mail->Username = 'lakkadrahulr4@gmail.com';     
		        $mail->Password = '1209@rahul';         
		        $mail->SMTPOptions = array(
		            'ssl' => array(
		            'verify_peer' => false,
		            'verify_peer_name' => false,
		            'allow_self_signed' => true
		            )
		        );                         
		        $mail->SMTPSecure = 'tls';                           
		        $mail->Port = 587;                                   

		        //Send Email
		        $mail->setFrom('lakkadrahulr4@gmail.com');
		        
		        //Recipients
		        $mail->addAddress($email);              
		        $mail->addReplyTo('lakkadrahulr4@gmail.com');
		        
		        //Content
		        $mail->isHTML(true);                                  
		        $mail->Subject = $subject;
		        $mail->Body    = $message;

		        $mail->send();
				
		       	$obj->Redirect("../../forgot.php?email_id=$email");
		    } 
		    catch (Exception $e) 
		    {
			   echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			   echo 'error';
		    }
        } 
    }

    function get_browser_name($user_agent)
	{
	    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
	    elseif (strpos($user_agent, 'Edge')) return 'Edge';
	    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
	    elseif (strpos($user_agent, 'Safari')) return 'Safari';
	    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
	    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
	    
	    return 'Other';
	}
	function detectDevice(){
	  $deviceName="";
	  $userAgent = $_SERVER["HTTP_USER_AGENT"];
	  $devicesTypes = array(
	        "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
	        "tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
	        "mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
	        "bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
	    );
	  foreach($devicesTypes as $deviceType => $devices) {
	        foreach($devices as $device) {
	            if(preg_match("/" . $device . "/i", $userAgent)) {
	                $deviceName = $deviceType;
	            }
	        }
	    }
	    return ucfirst($deviceName);
	  }

?>