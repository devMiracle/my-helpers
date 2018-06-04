<?php

function send_mail($email, $message, $subject) {
  require_once('mailer/class.phpmailer.php');
  $mail = new PHPMailer();
  /////$mail->IsSMTP(); 
  $mail->SMTPDebug = 0;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "vps.healthandsocialconnect.co.uk";
  $mail->Port = 465;
  $mail->AddAddress($email);
  $mail->Username = "registration@healthandsocialconnect.co.uk";
  $mail->Password = "admin01@";
  $mail->SetFrom('registration@healthandsocialconnect.co.uk');
  $mail->AddReplyTo("registration@healthandsocialconnect.co.uk");
  $mail->Subject = $subject;
  $mail->MsgHTML($message);
  $mail->Send();
}
