<?php
require_once($_SERVER['SRVROOT']."/cms/lib/mail/class.phpmailer.php");
require_once("database.inc.php");
require_once("std.inc.php");
function send_smtp( $subject, $body, $target_address, $is_auth = false, $altbody = "", $target_name = "",$attachment = "", $attachment_dir = ""){
	$mail	=	new	PHPMailer();
	$mail->CharSet = "UTF-8";
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host	=	get_config("smtp_host"); // SMTP server
	if($is_auth){
		$mail->SMTPAuth = $is_auth; // turn on SMTP authentication
		$mail->Username = get_config("smtp_account"); // SMTP username
		$mail->Password = get_config("smtp_password"); // SMTP password
	}
	$mail->From	=	get_config("smtp_from");
	$mail->FromName	=	get_config("smtp_from_name");

	$mail->Subject	= $subject;
	$mail->Body = $body;
	$mail->AltBody	= $altbody; // optional, comment out and test

	
	//$mail->MsgHTML($body);
	$mail->AddAddress($target_address, $target_name);
	if(!empty($attachment))
		$mail->AddAttachment($attachment_dir);// attachment

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  //echo "Message sent!";
	}		
}
function send_smtp_gmail($subject, $body, $target_address, $altbody = "", $target_name = "",$attachment = "", $attachment_dir = ""){
	$mail             = new PHPMailer();
	$mail->CharSet	= "UTF-8";
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

	$mail->Username   = get_config("mail_account");  // GMAIL username
	$mail->Password   = get_config("mail_password");            // GMAIL password

	//$mail->AddReplyTo("yourusername@gmail.com","First Last");

	$mail->From       = get_config("mail_from");
	$mail->FromName   = get_config("mail_from_name");

	$mail->Subject    = $subject;

	$mail->Body       = $body;                      //HTML Body
	$mail->AltBody    = $altbody; // optional, comment out and test
	$mail->WordWrap   = 50; // set word wrap

	//$mail->MsgHTML($body);

	$mail->AddAddress($target_address, $target_name);
	if(!empty($attachment))
		$mail->AddAttachment($attachment_dir);// attachment

	$mail->IsHTML(true); // send as HTML

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  //echo "Message sent!";
	}		
}
function send_mail($subject, $body, $target_address, $altbody = "", $target_name = "",$attachment = "", $attachment_dir = ""){
	$mail             = new PHPMailer(); // defaults to using php "mail()"

	//$body             = $mail->getFile('contents.html');
	//$body             = eregi_replace("[\]",'',$body);
	$mail->CharSet	= "UTF-8";
	$mail->From       = get_config("mail_from");
	$mail->FromName   = get_config("mail_from_name");

	$mail->Subject    = $subject;

	$mail->AltBody    = "";//"To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

	$mail->Body       = $body; //$mail->MsgHTML($body);

	$mail->AddAddress($target_address, $target_name);
	if(!empty($attachment))
		$mail->AddAttachment($attachment_dir);// attachment

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  echo "Message sent!";
	}		
}
?>

