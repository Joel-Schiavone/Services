<?php
	require_once('validacion.php'); 
	require_once('inc/conectar.php');
	require_once('modules/classes.php');
	require_once('modules/operaciones.php');
	require_once("phpmailer/PHPMailerAutoload.php");
	require_once("phpmailer/mailer-params.php");
	$oOpe						=	new operaciones();
	$ID_ser						=	$_GET['ID_pto'];
	$registro_presupuesto_id	=	$oOpe->registro_presupuesto_id($ID_ser);
	$ser_id						=	mysql_fetch_assoc($registro_presupuesto_id);
	$ser_fecDespacho			=	date('Y') . "-" . date('m') . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
	$tpp_instalacion			=	$ser_id['tpp_instalacion'];
	$ser_remito					=	$_GET['pto_remito'];
	$despacha					=	$oOpe->registro_presupuesto_despacho($ID_ser, $ser_remito, $ser_fecDespacho, $tpp_instalacion);
	
	$ID_obr						=	$ser_id['ID_obr'];
	$obras_id					=	$oOpe->obras_id($ID_obr);
	$obr_id						=	mysql_fetch_assoc($obras_id);
	
	$explode_mail				=	explode(',',$ser_id['ser_mail']);
	$count_mail					=	count($explode_mail);
	
	if($count_mail == 1){
		$ser_mail	=	$ser_id['ser_mail'];
	} else {
		$ser_mail	=	$explode_mail[0];
	}
	
///////////////////////////////////////////////////////// AVISO CLIENTE
	$body ="<html><head><style type='text/css'>";
	$body .="body,td,th {";
	$body .="font-family: Arial, Helvetica, sans-serif;";
	$body .="font-size: 12px;";
	$body .="}";
	$body .="</style></head><body>";
	$body .="<p>Estimado " . $ser_id['ser_contacto'] . ",</p>";
	$body .="<p>Confirmamos que se ha despachado el pedido No. " . $ser_id['ser_cod'] . "</p>";
	$body .="<p>Saludos Cordiales,</p>";
	$body .="<p>" . $_SESSION['nombre'] . " " . $_SESSION['apellido'] . " - Epta Argentina";
			
	$mail->CharSet = 'UTF-8';
	$mail->From     = $_SESSION['usu_email'];
	$mail->FromName = $_SESSION['apellido'] . " " . $_SESSION['nombre'] . " - Epta Argentina";
	$mail->AddAddress($ser_mail);
	if($count_mail > 1){
		for($r=1; $r<$count_mail; $r++){
			$mail->AddCC($explode_mail[$r]);
		}
	}
	$mail->AddReplyTo($_SESSION['usu_email'], $_SESSION['apellido'] . " " . $_SESSION['nombre'] . " - Epta Argentina");		

	$mail->Subject  = "Confirmación de Despacho pedido No. " . $ser_id['ser_cod'] . " - COSTAN";
	$mail->Body     = $body;
	$mail->WordWrap = 50;  
	 
	if(!$mail->Send()) {
		$msg_mailc = '<div class="alert callout"><div class="row">El mensaje no ha sido enviado: ' . $mail->ErrorInfo . '</div></div>';
		
	} else {
		$msg_mailc = '<div class="success callout"><div class="row">Mensaje enviado correctamente al cliente: <b>' . $ser_id['ser_mail'] . '</b>.</div></div>';
	}

		echo "<script type='text/javascript'>
  window.location.assign('dashboard-expedicion-AS.php?m=12');
  </script>";
?>
