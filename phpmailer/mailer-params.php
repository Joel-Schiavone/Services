<?php
	$mail = new PHPMailer();$mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->Host = "10.108.2.54";
    $mail->Port = "25";
    $mail->IsHTML(true);
?>