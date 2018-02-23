<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
$adjuntos= new adjuntos();
$tasks= new tasks();

$ID_adj	=12*((base64_decode($_GET['ID_adj']))/12344);
$dropAdjuntos = $adjuntos -> dropAdjuntos($ID_adj);



 $getAdjuntosById=$adjuntos -> getAdjuntosById($ID_adj);
 $assoc_getAdjuntosById=mysql_fetch_assoc($getAdjuntosById);
 $ID_tas=$assoc_getAdjuntosById['adj_idRelacion'];

$getregistro_servicio_tas=$tasks->getregistro_servicio_tas($ID_tas);
 $assoc_getregistro_servicio_tas=mysql_fetch_assoc($getregistro_servicio_tas);
$ID_ser=$assoc_getregistro_servicio_tas['ID_ser'];
$back 				= $_SESSION['actionsBack'];



header('Location: '.$back.'');
									  
?>                                                                                                                      