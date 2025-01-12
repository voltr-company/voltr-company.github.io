<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */
require 'phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']) && ( isset($_POST['website']) || isset($_POST['phone']) || isset($_POST['subject']) ) )  {
	//Set who the message is to be sent to
	$to_email = ""; //RECEIVER EMAIL ADDRESS
	$to_name = ""; //RECEIVER NAME
	$subject = "New Contact Query";
	
	$sender_name = $_POST['name'];
	$from_mail = $_POST['email'];	
	$sender_message = $_POST['message'];
	
	$sender_subject = '';
	$sender_website = '';
	$sender_phone = '';	
	
	if( isset($_POST['subject']) ){
		$sender_subject = 'SENDER SUBJECT: ' . $_POST['subject'] . "</br>";
	}
	
	if( isset($_POST['website']) ){
		$sender_website = 'SENDER WEBSITE: ' . $_POST['website'] . "</br>";
	}
	
	if( isset($_POST['phone']) ){
		$sender_phone = 'SENDER PHONE NUMBER: ' . $_POST['phone'] . "</br>";
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