<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
//Load composer's autoloader

if(isset($_POST['btn_send']))
{
	$subject = $_POST['subject'];
	$message = $_POST['msg'];

    if (isset($_POST['chk'])) 
    {
        $chk=$_POST['chk'];
        foreach ($chk as $value) 
        {
		
		    $mail = new PHPMailer(true);                            
		    try 
		    {
		        //Server settings
		        $mail->isSMTP();                                     
		        $mail->Host = 'smtp.gmail.com';                      
		        $mail->SMTPAuth = true;                             
		        $mail->Username = 'eserviceexpert@gmail.com';     
		        $mail->Password = 'vijayvishalsavan';         
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
		        $mail->setFrom('eserviceexpert@gmail.com');
		        
		        //Recipients
		        $mail->addAddress($value);              
		        $mail->addReplyTo('eserviceexpert@gmail.com');
		        
		        //Content
		        $mail->isHTML(true);                                  
		        $mail->Subject = $subject;
		        $mail->Body    = $message;

		        $mail->send();
				
		       echo 'Message has been sent';
			   echo 'ok';
		    } 
		    catch (Exception $e) 
		    {
			   echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			   echo 'error';
		    }
        }
    }
    else
    {
    	echo "Please Select Emails";
    }
	header("location:../email-subscribe.php");
}
?>