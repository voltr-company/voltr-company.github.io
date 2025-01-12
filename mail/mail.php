<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */
require 'phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['message']) && ( isset($_GET['website']) || isset($_GET['phone']) || isset($_GET['subject']) ) )  {
	//Set who the message is to be sent to
	$to_email = "business@nocaptechnology.com"; //RECEIVER EMAIL ADDRESS
	$to_name = "Nocap website query"; //RECEIVER NAME
	$subject = "New Contact Query";
	
	$sender_name = $_GET['name'];
	$from_mail = $_GET['email'];	
	$sender_message = $_GET['message'];
	
	$sender_subject = '';
	$sender_website = '';
	$sender_phone = '';	
	
	if( isset($_GET['subject']) ){
		$sender_subject = 'SENDER SUBJECT: ' . $_GET['subject'] . "</br>";
	}
	
	if( isset($_GET['website']) ){
		$sender_website = 'SENDER WEBSITE: ' . $_GET['website'] . "</br>";
	}
	
	if( isset($_GET['phone']) ){
		$sender_phone = 'SENDER PHONE NUMBER: ' . $_GET['phone'] . "</br>";
	}		
		
	$mail->SetFrom( $from_mail , $sender_name );
	$mail->AddReplyTo( $from_mail , $sender_name );
	$mail->AddAddress( $to_email , $to_name );
	//Set the subject line
	$mail->Subject = $subject;
	$received_content = "SENDER NAME : " . $sender_name . "</br> SENDER EMAIL : " . $from_mail . "</br>" . $sender_subject . $sender_website . $sender_phone . " </br> SENDER MESSAGE: </br/> " . $sender_message;
	$mail->MsgHTML( $received_content );
	echo $mail->Send();
	exit;	
}