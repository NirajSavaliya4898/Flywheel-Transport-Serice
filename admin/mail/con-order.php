<?php
		
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    ?>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <?php
	require "../../Config.php";
	$obj=new Config();

	$Send_Mail_Count=0;

	if(isset($_GET['order_id']))
    {
    	$order_Data=$obj->myQuery("SELECT 
    									r.email_id,o.from,o.to,o.day,cat.name as category,o.order_date,b.name as business,r.name as user,o.order_id
    							   FROM `tbl_order` as o,`tbl_registration` as r,`tbl_category` as cat,`tbl_business` as b 
    							   WHERE o.`registration_id`=r.`registration_id` and o.`order_id`='".$_GET['order_id']."' and cat.category_id=o.category_id and b.business_id=o.business_id");
    	$order_Data_counter=$order_Data->num_rows;
    	if ($order_Data_counter==1) 
    	{
    		$Send_Mail_Count=1;
    	}
  		
        //Send Otp From The Mails
        if ($Send_Mail_Count==1) 
        {
        	$lst=$order_Data->fetch_assoc();
        	$email=$lst['email_id'];
		   	$subject = "Your Flywheel Order Confirmation Details [ '".$lst['order_date']."' ]";
	    	$message = "Hey ".$lst['user'].","."<br><br>".
	   				   "<b>Thanks For Order Using Flywheel Service!"."<br>".
	   				   "Your Order From '".$lst['business']."'</b>"."<br><br>".
	   				   "<b>From &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>.'".$lst['from']."'"."<br>".
	   				   "<b>To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>'".$lst['to']."'"."<br>".
	   				   "<b>Category : </b>.'".$lst['category']."'"."<br>".
	   				   "<b>Days &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>'".$lst['day']."'"."<br>".
	   				   "<b>Confirm Your Order : </b> <a class='btn btn-success' href='192.168.2.113/transport/thank-you.php?order_id=".$lst['order_id']."'>Yes</a>
	   				   <a class='btn btn-danger' href='192.168.2.113/transport/thank-you.php?status=failed'>No</a>";

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
					echo "string";
		       	$obj->Redirect("../../order.php?email_id=$email&status=success");
		    } 
		    catch (Exception $e) 
		    {
			   echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			   $obj->Redirect("../../order.php?email_id=$email&status=failed");
		    }
        } 
    }

?>