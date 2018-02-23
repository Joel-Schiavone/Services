<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>::: CRM-PRO - <?php echo $url_name ?> :::</title>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="images/logo-epta.png">
	<link rel="stylesheet" href="../css/materialize.css" type="text/css"/>
	<link rel="stylesheet" href="css/component.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/demo.css">
	<link href="../css/foundation-icons.css" rel="stylesheet">
	<link href="../css/font-awesome.css" rel="stylesheet">
	<link href="../css/motion-ui.min.css" rel="stylesheet"  />
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">	
	<script src="../dist/Chart.js"></script>
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery-3.1.0.min"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/modernizr.custom.js"></script>
    
<link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="../js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body style="font-family: Dosis, sans-serif;">
<?php
if(@$_SESSION['estado'] == 'conectado'){
	require_once('inc/menu.php');
}
?>

