<?php
    $mailto = $_POST['email'];
    $mailSub = "Password Reset Code";
	//$pwd = bin2hex(openssl_random_pseudo_bytes(4));
	//$message="Your Password reset code is :".$pwd;
	//echo $pwd;
	$message="This is email";
    $mailMsg = $message;

   require 'PHPMailer-master/PHPMailerAutoload.php';
   
   $mail = new PHPMailer();
   
   $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
	);
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'ssl';
   $mail ->Host = "smtp.gmail.com";
  // $mail ->Port = 465; // or 587
   $mail ->Port = 465; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = "Gmail username";
   $mail ->Password = "Gmail Password";
   $mail->setFrom('OnTrac BD', 'OnTrac BD');
	
   $mail ->Subject = $mailSub;
   $mail ->Body = $mailMsg;
   $mail ->AddAddress($mailto);

   if(!$mail->Send())
   {
      echo "Mail Not Sent";
   }
   else
   {
	   echo "Mail Sent";
     // header('location:forgot_password.php?sent=1');
   }





   

