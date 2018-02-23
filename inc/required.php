<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('inc/check_permission.php');
require_once('modules/classes.php');
require_once('modules/operaciones.php');
require_once('inc/header.php');
require_once("phpmailer/PHPMailerAutoload.php");
require_once("phpmailer/mailer-params.php");
include('../inc/Mobile_Detect.php');
$detect = new Mobile_Detect();
?>