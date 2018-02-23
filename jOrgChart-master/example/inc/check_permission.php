<?php
require_once('modules/classes.php');
	$location[2]	= explode('/',$_SERVER['REQUEST_URI']);
	$loc			= $location[2];
	$for_a			= explode('?',$loc[2]);
	$for			= $for_a[0];
	$usu			= $_SESSION['ID_usu'];
	$oOpe			= new permisos();
	$permiso		= $oOpe->checkPermiso($usu, $for);
	$num			= mysql_num_rows($permiso);
	$permi			= mysql_fetch_assoc($permiso);
	$url_name		= $permi['for_nombre'];
	$url_desc		= $permi['for_desc'];
	if($num == 0){
		header("Location: no_permission.php");
		exit();
	}
?>