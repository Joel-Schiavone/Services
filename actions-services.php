<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
require_once('modules/operaciones.php');
require_once("phpmailer/PHPMailerAutoload.php");
require_once("phpmailer/mailer-params.php");

$registro_servicio 	= new registro_servicio;
$answers    		= new answers;
$quotations 		= new quotations;
$clientes 			= new clientes;
$tiendas			= new tiendas;
$usuarios           = new usuarios;
$especiales 		= new especiales;
$oOpe				= new operaciones();
$tasks				= new tasks();
$back 				= explode('?', $_SESSION['actionsBack']);
$action 			= $_POST['action'];
$ID_emp 			= $_SESSION['ID_emp'];
if ($action=='registrar') 
{
	$oOpe					=	new operaciones();
	$ser_fecin				=	date('Y') . "-" . date('m') . "-" . date('d');
	$ser_hourin				=	date('H') . ":" . date('i') . ":" . date('s');
	$registro_servicio_dia	=	$oOpe->registro_servicio_dia($ser_fecin);
	$num_reg				=	mysql_num_rows($registro_servicio_dia);
    $ID_cli					=	$_POST['ID_cli'];	


    $tabla="registro_servicio";
    $ProximoId_registro_servicio=$especiales->ProximoId($tabla);
    $assoc_ProximoId_registro_servicio=mysql_fetch_assoc($ProximoId_registro_servicio);
    $ID_ser=$assoc_ProximoId_registro_servicio['NEXTID'];

	$ID_obr					=	$_POST['ID_obr'];
	if($_POST['ser_asig'] == 111){
	     $ID_sta				=	1;
	} else {
		 $ID_sta				=	2;
	}	
  	$ser_recCli					=	$_POST['ser_recCli'];
  	$ID_pri						=	$_POST['ID_pri'];
  	$ID_usu						=	$_SESSION['idu'];
 	$ser_cod						=	date('Y') . date('m') . date('d') . $ID_ser;
 	$ser_asig						=	$_POST['ser_asig'];
 	$ser_desc						=	str_replace('"','',$_POST['ser_desc']);
 	$ser_tipo     				= 	1;
 	$ser_telefono 				=	$_POST['ser_telefono'];
 	$ser_mail     				=	$_POST['ser_mail'];
  	$ser_contacto 				=	$_POST['ser_contacto'];

  	/*
  	$getAnswersA  				=   $answers->getAnswers($ID_ser);
 	$num_getAnswersA				=	mysql_num_rows($getAnswersA);
  	$getAnswersB 					= 	$answers->getAnswers($ID_ser);
  	$num_getAnswersB				=	mysql_num_rows($getAnswersB);
  	$getAnswersC 					= 	$answers->getAnswers($ID_ser);
  	$num_getAnswersC 				= 	mysql_num_rows($getAnswersC);
  	$getAnswersD 					= 	$answers->getAnswers($ID_ser);
  	$num_getAnswersD 				= 	mysql_num_rows($getAnswersD);
  	*/

  $crea = $registro_servicio->insert_registro_servicioNuevoB($ID_cli, $ID_obr, $ID_sta, $ID_pri, $ID_usu, $ser_tipo, $ser_asig, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_fecin, $ser_hourin, $ser_recCli, $ser_cod, $ID_emp);

  
  $cont							=	$ser_asig;

  $contratistas_id				=	$oOpe->contratistas_id($cont);
  $cont_id						=	mysql_fetch_assoc($contratistas_id);
  $obras_id						=	$oOpe->obras_id($ID_obr);
  $obr_id						=	mysql_fetch_assoc($obras_id);

	//Trae datos del call center del cliente

  $getTiendaById 		= $tiendas->getTiendaById($ID_obr);
  $assoc_getTiendaById= mysql_fetch_assoc($getTiendaById);
  $obr_callcenter  	= $assoc_getTiendaById['obr_callcenter'];
  $obr_telcall  		= $assoc_getTiendaById['obr_telcall'];
  $obr_contactocall  	= $assoc_getTiendaById['obr_contactocall'];
  $obr_camailcall  	= $assoc_getTiendaById['obr_camailcall'];
  $obr_ticketinterno  = $assoc_getTiendaById['obr_ticketinterno'];

  $UN_SALTO="\r\n";
  $DOS_SALTOS="\r\n\r\n";

///////////////////////////////////////////////////////// AVISO CLIENTE
if($ser_mail != '')
{
	$para = $ser_mail;
	$asunto = "Pedido de Servicio " . $ser_cod . " - COSTAN";
	$texto ="<html><head><style type='text/css'>";
	$texto .="body,td,th {";
	$texto .="font-family: Arial, Helvetica, sans-serif;";
	$texto .="font-size: 12px;";
	$texto .="}";
	$texto .="</style></head><body>";
	$texto .="<table width='640'>";
	$texto .="<tr>";
	$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
	$texto .="</tr>";
	$texto .="</table>";
	$texto .="<br >";
	$texto .="<table width='640' border='0'>";
	$texto .="<tr>";
	$texto .="<td width='100'><em>Código del servicio:</em></td>";
	$texto .="<td>" . $ser_cod . "</td>";
	$texto .="</tr>";
	$texto .="<td width='100'><em>Fecha / Hora (Apertura):</em></td>";
	$texto .="<td>" . $ser_fecin . " / " . $ser_hourin . "</td>";
	$texto .="</tr>";
	$texto .="<tr>";
	$texto .="<td width='100'><em>Cliente / Obra:</em></td>";
	$texto .="<td>" . $obr_id['cli_desc'] . " / " . $obr_id['obr_desc'] . "</td>";
	$texto .="</tr>";
	if($ser_asig != 69){
	$texto .="<tr>";
	$texto .="<td><em>Persona asignada:</em></td>";
	$texto .="<td>" . $cont_id['usu_apellido'] .  " " . $cont_id['usu_nombre'] . "</td>";
	$texto .="</tr>";
	}
	$texto .="<tr>";
	$texto .="<td><em>Descripción del problema:</em></td>";
	$texto .="<td>" . $ser_desc . "</td>";
	$texto .="</tr>";


	$texto .="<tr>";
	$texto .="<td><em>Call Center: </em></td>";
	$texto .="<td>" . $obr_callcenter. "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Telefono Call Center: </em></td>";
	$texto .="<td>" . $obr_telcall . "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Contacto Call Center: </em></td>";
	$texto .="<td>" . $obr_contactocall. "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Email Call Center: </em></td>";
	$texto .="<td>" . $obr_camailcall . "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Ticket Call Center: </em></td>";
	$texto .="<td>" . $obr_ticketinterno. "</td>";
	$texto .="</tr>";

	/*
	$texto .="<tr>";
	$texto .="<td><em>Troubleshooting:</em></td>";

	 for ($AnswersA=0; $AnswersA < $num_getAnswersA; $AnswersA++)
     { 
      $assoc_getAnswersA=mysql_fetch_assoc($getAnswersA);
      $texto .="<tr>";
        $texto .="<td style='text-align:center'>";
          $texto .=$assoc_getAnswersA['qts_desc'];
        $texto .="</td>";
        $texto .="<td style='text-align:center'>";
          $texto .=$assoc_getAnswersA['aws_desc'];
        $texto .="</td>";
      $texto .="</tr>";   
     }
 
	$texto .="</tr>";*/
	$texto .="</table>";
	$texto .="</body></html>";

	$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

	$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
	$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
	$header .= "MIME-Version: 1.0".$UN_SALTO;
	$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
	$header .= " boundary=$separador".$DOS_SALTOS;

	$mensaje ="--$separador".$UN_SALTO;
	$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
	$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
		$mensaje .= $texto;

	$cuerpo=$mensaje;

	mail($para, $asunto, $cuerpo, $header);
}

$UN_SALTO="\r\n";
$DOS_SALTOS="\r\n\r\n";

///////////////////////////////////////////////////////// AVISO CONTACTO DE OBRA
if($ser_mail != '')
{
$para = $obr_id['obr_mail'];
$asunto = "Pedido de Servicio " . $ser_cod . " - COSTAN";
$texto ="<html><head><style type='text/css'>";
$texto .="body,td,th {";
$texto .="font-family: Arial, Helvetica, sans-serif;";
$texto .="font-size: 12px;";
$texto .="}";
$texto .="</style></head><body>";
$texto .="<table width='640'>";
$texto .="<tr>";
$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
$texto .="</tr>";
$texto .="</table>";
$texto .="<br >";
$texto .="<table width='640' border='0'>";
$texto .="<tr>";
$texto .="<td width='100'><em>Código del servicio:</em></td>";
$texto .="<td>" . $ser_cod . "</td>";
$texto .="</tr>";
$texto .="<td width='100'><em>Fecha / Hora (Apertura):</em></td>";
$texto .="<td>" . $ser_fecin . " / " . $ser_hourin . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td width='100'><em>Cliente / Obra:</em></td>";
$texto .="<td>" . $obr_id['cli_desc'] . " / " . $obr_id['obr_desc'] . "</td>";
$texto .="</tr>";
if($ser_asig != 69){
$texto .="<tr>";
$texto .="<td><em>Persona asignada:</em></td>";
$texto .="<td>" . $cont_id['usu_apellido'] .  " " . $cont_id['usu_nombre'] . "</td>";
$texto .="</tr>";
}
$texto .="<tr>";
$texto .="<td><em>Descripción del problema:</em></td>";
$texto .="<td>" . $ser_desc . "</td>";
	$texto .="</tr>";

		$texto .="<tr>";
	$texto .="<td><em>Call Center: </em></td>";
	$texto .="<td>" . $obr_callcenter. "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Telefono Call Center: </em></td>";
	$texto .="<td>" . $obr_telcall . "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Contacto Call Center: </em></td>";
	$texto .="<td>" . $obr_contactocall. "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Email Call Center: </em></td>";
	$texto .="<td>" . $obr_camailcall . "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Ticket Call Center: </em></td>";
	$texto .="<td>" . $obr_ticketinterno. "</td>";
	$texto .="</tr>";

	/*
	$texto .="<tr>";
	$texto .="<td><em>Troubleshooting:</em></td>";
	 for ($AnswersB=0; $AnswersB < $num_getAnswersB; $AnswersB++)
     { 
      $assoc_getAnswersB=mysql_fetch_assoc($getAnswersB);
     $texto .="<tr>";
        $texto .="<td style='text-align:center'>";
          $texto .=$assoc_getAnswersB['qts_desc'];
        $texto .="</td>";
        $texto .="<td style='text-align:center'>";
          $texto .=$assoc_getAnswersB['aws_desc'];
        $texto .="</td>";
      $texto .="</tr>";   
     }
 	
	$texto .="</tr>";
	*/
	$texto .="</table>";$texto .="</body></html>";

$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
$header .= "MIME-Version: 1.0".$UN_SALTO;
$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
$header .= " boundary=$separador".$DOS_SALTOS;

$mensaje ="--$separador".$UN_SALTO;
$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
	$mensaje .= $texto;

$cuerpo=$mensaje;

mail($para, $asunto, $cuerpo, $header);
}

///////////////////////////////////////////////////////// AVISO CONTRATISTA


$UN_SALTO="\r\n";
$DOS_SALTOS="\r\n\r\n";

// Se envia el mail //
if($ser_mail != '')
{
$para = $cont_id['usu_email'];
$asunto = "Pedido de Servicio " . $ser_cod . " - COSTAN";
$texto ="<html><head><style type='text/css'>";
$texto .="body,td,th {";
$texto .="font-family: Arial, Helvetica, sans-serif;";
$texto .="font-size: 12px;";
$texto .="}";
$texto .="</style></head><body>";
$texto .="<table width='640'>";
$texto .="<tr>";
$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
$texto .="</tr>";
$texto .="</table>";
$texto .="<br >";
$texto .="<table width='640' border='0'>";
$texto .="<tr>";
$texto .="<td width='100'><em>Código del servicio:</em></td>";
$texto .="<td>" . $ser_cod . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td width='100'><em>Fecha / Hora (Apertura):</em></td>";
$texto .="<td>" . $ser_fecin . " / " . $ser_hourin . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td width='100'><em>Cliente / Obra:</em></td>";
$texto .="<td>" . $obr_id['cli_desc'] . " / " . $obr_id['obr_desc'] . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td width='100'><em>Direccion</em></td>";
$texto .="<td>" . $obr_id['obr_dir'] . " / " . $obr_id['ciu_desc'] . " - " . $obr_id['prv_desc'] . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>Contacto:</em></td>";
$texto .="<td>" . $ser_contacto . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>Teléfono:</em></td>";
$texto .="<td>" . $ser_telefono . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>email:</em></td>";
$texto .="<td>" . $ser_mail . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>Descripción del problema:</em></td>";
$texto .="<td>" . $ser_desc . "</td>";
	$texto .="</tr>";

		$texto .="<tr>";
	$texto .="<td><em>Call Center: </em></td>";
	$texto .="<td>" . $obr_callcenter. "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Telefono Call Center: </em></td>";
	$texto .="<td>" . $obr_telcall . "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Contacto Call Center: </em></td>";
	$texto .="<td>" . $obr_contactocall. "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Email Call Center: </em></td>";
	$texto .="<td>" . $obr_camailcall . "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Ticket Call Center: </em></td>";
	$texto .="<td>" . $obr_ticketinterno. "</td>";
	$texto .="</tr>";
	/*
	$texto .="<tr>";
	$texto .="<td><em>Troubleshooting:</em></td>";
	
	 for ($AnswersC=0; $AnswersC < $num_getAnswersC; $AnswersC++)
     { 
      $assoc_getAnswersC=mysql_fetch_assoc($getAnswersC);
     $texto .="<tr>";
        $texto .="<td style='text-align:center'>";
          $texto .=$assoc_getAnswersC['qts_desc'];
        $texto .="</td>";
        $texto .="<td style='text-align:center'>";
          $texto .=$assoc_getAnswersC['aws_desc'];
        $texto .="</td>";
      $texto .="</tr>";   
     }
 	
	$texto .="</tr>";*/
	$texto .="</table>";
$texto .="</body></html>";

$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
$header .= "MIME-Version: 1.0".$UN_SALTO;
$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
$header .= " boundary=$separador".$DOS_SALTOS;

$mensaje ="--$separador".$UN_SALTO;
$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
	$mensaje .= $texto;

$cuerpo=$mensaje;

mail($para, $asunto, $cuerpo, $header);
}

///////////////////////////////////////////////////////// AVISO SUPERVISOR

	$sup				=	$obr_id['obr_supervisor'];
	$supervisores_id	=	$oOpe->supervisores_id($sup);
	$sup_id				=	mysql_fetch_assoc($supervisores_id);

$UN_SALTO="\r\n";
$DOS_SALTOS="\r\n\r\n";

// Se envia el mail //
if($ser_mail != '')
{
$para = $sup_id['usu_email'];
$asunto = "Pedido de Servicio " . $ser_cod . " - COSTAN";
$texto ="<html><head><style type='text/css'>";
$texto .="body,td,th {";
$texto .="font-family: Arial, Helvetica, sans-serif;";
$texto .="font-size: 12px;";
$texto .="}";
$texto .="</style></head><body>";
$texto .="<table width='640'>";
$texto .="<tr>";
$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
$texto .="</tr>";
$texto .="</table>";
$texto .="<br >";
$texto .="<table width='640' border='0'>";
$texto .="<tr>";
$texto .="<td width='100'><em>Código del servicio:</em></td>";
$texto .="<td>" . $ser_cod . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td width='100'><em>Fecha / Hora (Apertura):</em></td>";
$texto .="<td>" . $ser_fecin . " / " . $ser_hourin . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td width='100'><em>Cliente / Obra:</em></td>";
$texto .="<td>" . $obr_id['cli_desc'] . " / " . $obr_id['obr_desc'] . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td width='100'><em>Direccion</em></td>";
$texto .="<td>" . $obr_id['obr_dir'] . " / " . $obr_id['ciu_desc'] . " - " . $obr_id['prv_desc'] . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>Persona asignada:</em></td>";
$texto .="<td>" . $cont_id['usu_apellido'] .  " " . $cont_id['usu_nombre'] . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>Contacto:</em></td>";
$texto .="<td>" . $ser_contacto . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>Teléfono:</em></td>";
$texto .="<td>" . $ser_telefono . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>email:</em></td>";
$texto .="<td>" . $ser_mail . "</td>";
$texto .="</tr>";
$texto .="<tr>";
$texto .="<td><em>Descripción del problema:</em></td>";
$texto .="<td>" . $ser_desc . "</td>";
	$texto .="</tr>";

		$texto .="<tr>";
	$texto .="<td><em>Call Center: </em></td>";
	$texto .="<td>" . $obr_callcenter. "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Telefono Call Center: </em></td>";
	$texto .="<td>" . $obr_telcall . "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Contacto Call Center: </em></td>";
	$texto .="<td>" . $obr_contactocall. "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Email Call Center: </em></td>";
	$texto .="<td>" . $obr_camailcall . "</td>";
	$texto .="</tr>";

	$texto .="<tr>";
	$texto .="<td><em>Ticket Call Center: </em></td>";
	$texto .="<td>" . $obr_ticketinterno. "</td>";
	$texto .="</tr>";
	/*
	$texto .="<tr>";
	
	$texto .="<td><em>Troubleshooting:</em></td>";
	 for ($AnswersD=0; $AnswersD < $num_getAnswersD; $AnswersD++)
     { 
      $assoc_getAnswersD=mysql_fetch_assoc($getAnswersD);
     $texto .="<tr>";
        $texto .="<td style='text-align:center'>";
          $texto .=$assoc_getAnswersD['qts_desc'];
        $texto .="</td>";
        $texto .="<td style='text-align:center'>";
          $texto .=$assoc_getAnswersD['aws_desc'];
        $texto .="</td>";
      $texto .="</tr>";   
     }
     
 
	$texto .="</tr>";  */
	$texto .="</table>";
$texto .="</body></html>";

$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
$header .= "MIME-Version: 1.0".$UN_SALTO;
$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
$header .= " boundary=$separador".$DOS_SALTOS;

$mensaje ="--$separador".$UN_SALTO;
$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
$mensaje .= $texto;

$cuerpo=$mensaje;

mail($para, $asunto, $cuerpo, $header);
}
header('Location: dashboard-services.php?codigo='.$ser_cod.'');
}

elseif ($action=='registrarContacto') 
{
	$ID_ser		=$_POST['ID_ser'];
	$ser_contacto	=$_POST['ser_contacto'];
	$ser_telefono	=$_POST['ser_telefono'];
	$ser_mail 		=$_POST['ser_mail'];

	$UpdateRegistroServicio=$registro_servicio->updateRegisterServicesContactos($ID_ser, $ser_contacto, $ser_telefono, $ser_mail);

	$GetRegistroServicioByIdser=$registro_servicio->GetRegistroServicioByIdser($ID_ser);
	$assoc_GetRegistroServicioByIdser=mysql_fetch_assoc($GetRegistroServicioByIdser);
	$ser_contacto	=$assoc_GetRegistroServicioByIdser['ser_contacto'];
	$ser_telefono	=$assoc_GetRegistroServicioByIdser['ser_telefono'];
	$ser_mail 		=$assoc_GetRegistroServicioByIdser['ser_mail'];

	$ID_obr=$_POST['ID_obr'];
	$ID_cli=$_POST['ID_cli'];

	$obr_desc=$_POST['obr_desc'];
	$cli_marker=$_POST['cli_marker'];

	header('Location: new-services-request.php?m=1&contacto='.$ser_contacto.'&telefono='.$ser_telefono.'&mail='.$ser_mail.'&id='.base64_encode((12344*($ID_obr))/12).'&dato='.$obr_desc.'&logo='.$cli_marker.'&idB='.base64_encode((12344*($ID_cli))/12).'&datoB='.$obr_desc.'&ID_ser='.base64_encode((12344*($ID_ser))/12).'');

}

elseif ($action=='CerrarDefinitivamente') 
{	
	$ID_ser=$_POST['ID_ser'];
	$ser_fc=$_POST['ser_fc'];
	$ser_costomp=$_POST['ser_costomp'];

	$UpdateRegistroServicioByFcYCostoMp=$registro_servicio->UpdateRegistroServicioByFcYCostoMp($ID_ser);

	header('Location: '.$back[0].'?m=2');

}	
elseif ($action=='borrarRegistro') 
{

	$ID_ser=$_POST['ID_ser'];
	$ID_sta=42;

	$UpdateRegistroServiciosIdStaBySIdSer=$registro_servicio->UpdateRegistroServiciosIdStaBySIdSer($ID_ser, $ID_sta);

	header('Location: '.$back[0].'?m=3');

}	

elseif ($action=='deleteTable') 
{

	$ID_ser=$_POST['ID_ser'];
	$ser_telefono=$_POST['ser_telefono'];
	$ser_contacto=$_POST['ser_contacto'];
	$ser_mail=$_POST['ser_mail'];
	$ID_obr=$_POST['ID_obr'];
	$obr_desc=$_POST['obr_desc'];
	$cli_marker=$_POST['cli_marker'];
	$ID_cli=$_POST['ID_cli'];
	$obr_desc=$_POST['obr_desc'];

	$dropAnswersByIdSer=$answers->dropAnswersByIdSer($ID_ser);

		header('Location: new-services-request.php?m=3&contacto='.$ser_contacto.'&telefono='.$ser_telefono.'&mail='.$ser_mail.'&id='.base64_encode((12344*($ID_obr))/12).'&dato='.$obr_desc.'&logo='.$cli_marker.'&idB='.base64_encode((12344*($ID_cli))/12).'&datoB='.$obr_desc.'&ID_ser='.base64_encode((12344*($ID_ser))/12).'');

}	

elseif ($action=='RespuestaAnterior') 
{

	$ID_ser=$_POST['ID_ser'];
	$ser_telefono=$_POST['ser_telefono'];
	$ser_mail=$_POST['ser_mail'];
	$ID_obr=$_POST['ID_obr'];
	$obr_desc=$_POST['obr_desc'];
	$cli_marker=$_POST['cli_marker'];
	$ID_cli=$_POST['ID_cli'];
	$obr_desc=$_POST['obr_desc'];

	$dropAnswersByIdSerUltima=$answers->dropAnswersByIdSerUltima($ID_ser);

		header('Location: new-services-request.php?m=1&contacto='.$ser_contacto.'&telefono='.$ser_telefono.'&mail='.$ser_mail.'&id='.base64_encode((12344*($ID_obr))/12).'&dato='.$obr_desc.'&logo='.$cli_marker.'&idB='.base64_encode((12344*($ID_cli))/12).'&datoB='.$obr_desc.'&ID_ser='.base64_encode((12344*($ID_ser))/12).'');

}	

elseif ($action=='modificar') 
{

	$ID_ser=$_POST['ID_ser'];

	$ser_recCli			= 	$_POST['ser_recCli'];
	$ID_pri				=	$_POST['ID_pri'];
	$ser_asig			=	$_POST['ser_asig'];
	$ser_desc			=	str_replace('"','',$_POST['ser_desc']);
	$ser_contacto		=	$_POST['ser_contacto'];
	$ser_telefono		=	$_POST['ser_telefono'];
	$ser_mail			=	$_POST['ser_mail'];

	$GetRegistroServicioByIdser=$registro_servicio->GetRegistroServicioByIdser($ID_ser);
	$assoc_GetRegistroServicioByIdser=mysql_fetch_assoc($GetRegistroServicioByIdser);
	$ser_asigActual=$assoc_GetRegistroServicioByIdser['ser_asig'];

	if (($ser_asigActual!=$ser_asig)&&($ser_asig!=0))
	{
		
	// Inicio Modulo Envia maiL


		//trae correro y nombre del pto_asignado o responsable del pedido
		$getUsuariosByIdC 		=	$usuarios->getUsuariosById($ser_asig);
		$assoc_getUsuariosByIdC =	mysql_fetch_assoc($getUsuariosByIdC);
		$correo 				=	$assoc_getUsuariosByIdC['usu_email'];
		$nombreVendedor 		=	$assoc_getUsuariosByIdC['usu_nombre'];
		$apellidoVendedor		=	$assoc_getUsuariosByIdC['usu_apellido'];

		//Define el ID del nuevo estado: "Asignado"
		$ID_sta 				=	2;

    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =	 "Nueva asignación de servicio - Código: ".$assoc_GetRegistroServicioByIdser['ser_cod'];
    $texto                       =   "<p>El Servicio: ".$assoc_GetRegistroServicioByIdser['ser_cod']." ha sido Asignado por ".$_SESSION['nombre']." ".$_SESSION['apellido']." a " . $nombreVendedor . " " . $apellidoVendedor . "</p>";
    $destinatario                =   $correo;
   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
	{ 
		$mail->AddCC($CadenMail[$CadenaMailCount]);  
	}
	
  $recipients = array(
   'ayelen.casamassa@hotmail.com' => 'Ayelen Casamassa',
   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
  );
 
    $copiasOcultas             =   $correoEmisor;
     */
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail
	}
	elseif ($ser_asigActual==$ser_asig)
	{
		//Deja el ID del estado como estaba
		$ID_sta 				= 	$assoc_GetRegistroServicioByIdser['ID_sta'];
	}
	elseif ($ser_asig==0)
	{
		//Cambia el ID del estado y lo vuelve a Abierto
		$ID_sta 				= 	1;
	}

	$updateRegisterServices=$registro_servicio->updateRegisterServices($ID_ser, $ID_sta, $ID_pri, $ser_asig, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_recCli);

	header('Location: /services/dashboard-services.php?m=2');
}

elseif ($action=='NuevaTarea') 
{
	$ID_ser=$_POST['ID_ser'];
	$tas_tipo=$_POST['tas_tipo'];
	$tas_fecin=$_POST['tas_fecin'];
	$tas_hourin=$_POST['tas_hourin'];
	$ID_usu=$_POST['ID_usu'];
	$tas_desc=$_POST['tas_desc'];
	$ser_cod=$_POST['ser_cod'];
	@$tas_tipo_repuesto=@$_POST['tas_tipo_repuesto'];

	 

	 				 if ($tas_tipo==4) 
                    {
                     $tas_tipo="1";
                     $ID_sta=4; //pendiente


                    }
                    else
                    {
					     //Inicio: Genera codigo

						    $registro_presupuesto_nextid	=	$especiales->registro_presupuesto_nextid();
							$reg_pto_nextid					=	mysql_fetch_assoc($registro_presupuesto_nextid);	
						 	$fic_cod						=	date('Y') . date('m') . date('d') . $reg_pto_nextid['NEXTID'];
					 		

					 		
					//Fin: Genera codigo

							//Busca mas datos del resigtro servicio 

							$GetRegistroServicioByIdser=$registro_servicio->GetRegistroServicioByIdser($ID_ser);
							$assoc_GetRegistroServicioByIdser=mysql_fetch_assoc($GetRegistroServicioByIdser);

						//Corrobora si el tecnico retira el repuesto, lo despachan al cliente o lo tiene en el auto, en el caso de que lo utilice de su propio stock el servicio se mantiene en estado asignado, en caso de que se retire o lo despachen pasa a espera de repuesto para que lo presupuesten y se lo envien
						
						if ($tas_tipo_repuesto==3)
						  {
							$ID_sta 		= 4; //pendiente
						  }	
						 else
						 {
						 	$ID_sta 		= 6; // espera de repuesto
						 }


                      	$tas_tipo 			="2";
                      	$ID_tpp 			= 5;
						$pto_contacto		= $assoc_GetRegistroServicioByIdser['ser_contacto'];
						$ser_cod			= $assoc_GetRegistroServicioByIdser['ser_cod'];
						$pto_telefono		= $assoc_GetRegistroServicioByIdser['ser_telefono'];		
						$pto_mail			= $assoc_GetRegistroServicioByIdser['ser_mail'];	
						$pto_asignado		= 0;
						$ID_pri				= 3;
						$pto_desc			= $tas_desc;
						$ID_obr				= $assoc_GetRegistroServicioByIdser['ID_obr'];
						$ID_cli				= $assoc_GetRegistroServicioByIdser['ID_cli'];
						$ID_emp				= $assoc_GetRegistroServicioByIdser['ID_emp'];
						$ID_usu				= $assoc_GetRegistroServicioByIdser['ID_usu'];
						$pto_fecIngreso		= $_POST['tas_fecin'];
						$pto_pedidoCod		= $fic_cod;
	
                      $insertQuotationAs=$quotations->insertQuotationAs($ID_tpp, $pto_contacto, $pto_telefono, $pto_mail, $pto_asignado, $ID_pri, $ID_sta, $pto_desc, $ID_obr, $ID_cli, $ID_emp, $ID_usu, $pto_fecIngreso, $pto_pedidoCod, $ser_cod);

                     } 
$ID_usu=$_POST['ID_usu'];
$insertTasks=$tasks->insertTask($ID_ser, $ID_usu, $tas_fecin, $tas_hourin, $tas_desc, $tas_tipo);

$getUltimoregistro_servicio_tas=$tasks->getUltimoregistro_servicio_tas();
$assoc_getUltimoregistro_servicio_tas=mysql_fetch_assoc($getUltimoregistro_servicio_tas);
$id=$assoc_getUltimoregistro_servicio_tas['ID_tas'];


  for($adjuntoTarea=0; $adjuntoTarea<count($_FILES['adj_ruta']['name']); $adjuntoTarea++)
         {
     		
            $tmpFilePath = $_FILES['adj_ruta']['tmp_name'][$adjuntoTarea];
           	$shortname = $_FILES['adj_ruta']['name'][$adjuntoTarea];
			$generateRandomString   = 	$especiales->generateRandomString();
        	$extension 				= 	end(explode(".", $_FILES['adj_ruta']['name'][$adjuntoTarea]));
	   	 	$adj_ruta				= 	"adjuntos/".$generateRandomString."".$adjuntoTarea.".".$extension;
	   
            move_uploaded_file($tmpFilePath, $adj_ruta);

            $TareaInsertAdjuntos = $tasks->TareaInsertAdjuntos($ID_usu, $id, $adj_ruta, $ser_cod);
         }
    


 $updateRegisterServicesStatus=$registro_servicio->updateRegisterServicesStatus($ID_ser, $ID_sta);



// Inicio Modulo Envia maiL

    //Trae Modulo para construir el asunto del mensaje
 
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $texto                       =   "<p>Se registro una nueva tarea en el servicio ".$ser_cod." con la siguiente descripcion: ".$tas_desc." </p>";
    $destinatario                =  $_SESSION['usu_email'];
   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
	{ 
		$mail->AddCC($CadenMail[$CadenaMailCount]);  
	}
	
  $recipients = array(
   'ayelen.casamassa@hotmail.com' => 'Ayelen Casamassa',
   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
  );
 
    $copiasOcultas             =   $correoEmisor;
     */
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail
    

		header('Location: signatureTask.php?id='.base64_encode((12344*($id))/12).'');
}


elseif ($action=='borrarTarea') 
{
	$ID_ser=$_POST['ID_ser'];
	$ID_tas=$_POST['ID_tas'];
	
	$deleteTasks=$tasks->deleteTask($ID_tas);

	header('Location: modify-services-request.php?m=3&ID_ser='.base64_encode((12344*($ID_ser))/12).'');
}

elseif ($action=='Asignar') 
{

	$ID_ser=$_POST['ID_ser'];
	$ser_asig=$_POST['ser_asig'];
	$TiempoDeLlegada=$_POST['TiempoDeLlegada'];

	$actionAsignar=$registro_servicio->actionAsignar($ID_ser, $ser_asig);

	$GetRegistroServicioByIdser=$registro_servicio->GetRegistroServicioByIdser($ID_ser);
	$assoc_GetRegistroServicioByIdser=mysql_fetch_assoc($GetRegistroServicioByIdser);

	$getUsuariosById 		= 	$usuarios->getUsuariosById($ser_asig);
		$assoc_getUsuariosById 	=   mysql_fetch_assoc($getUsuariosById);
		$correo 				= 	$assoc_getUsuariosById['usu_email'];

// Inicio Modulo Envia maiL


    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $texto                       =   "<p>Se le ha asignado el servicio <strong> " . $assoc_GetRegistroServicioByIdser['ser_cod']	. " </strong></p>";
    $destinatario                =   $correo;
   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
	{ 
		$mail->AddCC($CadenMail[$CadenaMailCount]);  
	}
	
  $recipients = array(
   'ayelen.casamassa@hotmail.com' => 'Ayelen Casamassa',
   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
  );
  */
    $copiasOcultas             =   $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail
    
		header('Location: '.$back[0].'?m=2');
}

elseif ($action=='cerrar') 
{
	echo "Procesando Cierre por pendiente";
	///////////////////////////////////////////// RECIBE PARA FUNCIONAR /////////////////////////////////////////////

		$ID_ser					=	$_POST['ID_ser'];
		$ser_solucion			=	str_replace('"','',$_POST['ser_solucion']);
		$ser_persconforme		=	$_POST['ser_persconforme'];
		$ser_hs					=	$_POST['ser_hs'];
		$ser_costo				=	$_POST['ser_costo'];
		$ser_fecout				=	date('Y') . "-" . date('m') . "-" . date('d');
		$ser_hourout			=	date('H') . ":" . date('i') . ":" . date('s');
		$ser_cerrado			=	1;
		$ID_staQuotations 		=  	14;
		$ser_cod 				=  	$_POST['ser_cod'];

	/////////////////////////////////////////////// VALIDA VARIABLES RECIBIDAS /////////////////////////////////////////////

		if(isset($_POST['ser_conforme'])){
				$ser_conforme		=	1;
			} else {
				$ser_conforme		=	0;
			}
			
		
	///////////////////////////////////////////// EJECUTA CIERRE EN QUOTATIONS	/////////////////////////////////////////////
		
		//BUSCA EL PRESUPUESTO QUE CONTENGA EL CODIGO DE SERVICIO 
			$GetquotationsBySerCod=$quotations->GetquotationsBySerCod($ser_cod);
			$num_GetquotationsBySerCod=mysql_num_rows($GetquotationsBySerCod);

			//COMPRUEBA SI EXISTEN PRESUPUESTOS QUE CONTENGAN ESTE CODIGO DE SERVICIO 
				if($num_GetquotationsBySerCod!=0)
				{
					for ($presupuestos=0; $presupuestos < $num_GetquotationsBySerCod; $presupuestos++)
					{ 
					  $assoc_GetquotationsBySerCod=mysql_fetch_assoc($GetquotationsBySerCod);

					//SI EXISTEN LOS TRAE A TODOS PARA PASARLOS A CERRADO YA QUE EL TECNICO INDICO COMO CERRADO EL SERVICIO
					$fecha 					=	date("Y-m-d");
				    $fechaInvertida 		=	date("d-m-Y");
				    $fechaYhora 			=	date("Y-m-d H:i:s");
					$pto_fecInstalacion		= 	$fechaYhora;
					
					$ID_pto					=	$assoc_GetquotationsBySerCod['ID_pto'];
					
					$ID_sta='14'; // Pendiente de Cierre
					
			    	$QuotationsInstalacionAS = $quotations->QuotationsInstalacionAS($ID_pto, $ID_sta, $pto_fecInstalacion);
					}
					
				}

  		/////////////////////////////////////// EJECUTA FUNCIONES DE CIERRE DE SERVICIO//////////////////////////////////////
		
					$modifica				=	$oOpe->registro_servicio_cierra($ID_ser, $ser_solucion, $ser_persconforme, $ser_conforme, $ser_hs, $ser_costo, $ser_fecout, $ser_hourout, $ser_cerrado);
				
					
					$registro_servicio_id	=	$oOpe->registro_servicio_id($ID_ser);
					$ser_id					=	mysql_fetch_assoc($registro_servicio_id);
					$obras_id				=	$oOpe->obras_id($ser_id['ID_obr']);
					$obr_id					=	mysql_fetch_assoc($obras_id);
			
		$UN_SALTO="\r\n";
		$DOS_SALTOS="\r\n\r\n";



		///////////////////////////////////////////// ENVIA CORREOS	/////////////////////////////////////////////
		if($ser_id['ser_mail'] != ''){
		$para = $ser_id['ser_mail'];
		$asunto = "Servicio Completado " . $ser_id['ser_cod'] . " - COSTAN";
		$texto ="<html><head><style type='text/css'>";
		$texto .="body,td,th {";
		$texto .="font-family: Arial, Helvetica, sans-serif;";
		$texto .="font-size: 12px;";
		$texto .="}";
		$texto .="</style></head><body>";
		$texto .="<table width='640'>";
		$texto .="<tr>";
		$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
		$texto .="</tr>";
		$texto .="</table>";
		$texto .="<br >";
		$texto .="<table width='640' border='0'>";
		$texto .="<tr>";
		$texto .="<td width='150'><em>Código del servicio:</em></td>";
		$texto .="<td>" . $ser_id['ser_cod'] . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Cliente / Obra:</em></td>";
		$texto .="<td>" . $ser_id['cli_desc'] . " / " . $ser_id['obr_desc'] . " - " . $ser_id['obr_dir'] . "</td>";
		$texto .="</tr>";
		$texto .="<td><em>Fecha / Hora (Cierre):</em></td>";
		$texto .="<td>" . $ser_fecout . " / " . $ser_hourout . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Persona Conforme:</em></td>";
		$texto .="<td>" . $ser_persconforme . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Solcuión:</em></td>";
		$texto .="<td>" . $ser_solucion . "</td>";
		$texto .="</tr></table>";
		$texto .="</body></html>";
		$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

		$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
		$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
		$header .= "MIME-Version: 1.0".$UN_SALTO;
		$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
		$header .= " boundary=$separador".$DOS_SALTOS;

		$mensaje ="--$separador".$UN_SALTO;
		$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
		$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
			$mensaje .= $texto;

		$cuerpo=$mensaje;

		mail($para, $asunto, $cuerpo, $header);
		}

		///////////////////////////////////////////////////////// AVISO CLIENTE

		if($obr_id['obr_supervisor'] != 0){
			$sup				=	$obr_id['obr_supervisor'];
			$supervisores_id	=	$oOpe->supervisores_id($sup);
			$sup_id				=	mysql_fetch_assoc($supervisores_id);

		$para = $sup_id['usu_email'];
		$asunto = "Servicio Completado " . $ser_id['ser_cod'] . " - COSTAN";
		$texto ="<html><head><style type='text/css'>";
		$texto .="body,td,th {";
		$texto .="font-family: Arial, Helvetica, sans-serif;";
		$texto .="font-size: 12px;";
		$texto .="}";
		$texto .="</style></head><body>";
		$texto .="<table width='640'>";
		$texto .="<tr>";
		$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
		$texto .="</tr>";
		$texto .="</table>";
		$texto .="<br >";
		$texto .="<table width='640' border='0'>";
		$texto .="<tr>";
		$texto .="<td width='150'><em>Código del servicio:</em></td>";
		$texto .="<td>" . $ser_id['ser_cod'] . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Cliente / Obra:</em></td>";
		$texto .="<td>" . $ser_id['cli_desc'] . " / " . $ser_id['obr_desc'] . " - " . $ser_id['obr_dir'] . "</td>";
		$texto .="</tr>";
		$texto .="<td><em>Fecha / Hora (Cierre):</em></td>";
		$texto .="<td>" . $ser_fecout . " / " . $ser_hourout . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Persona Conforme:</em></td>";
		$texto .="<td>" . $ser_persconforme . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Solución:</em></td>";
		$texto .="<td>" . $ser_solucion . "</td>";
		$texto .="</tr></table>";
		$texto .="</body></html>";

		$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

		$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
		$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
		$header .= "MIME-Version: 1.0".$UN_SALTO;
		$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
		$header .= " boundary=$separador".$DOS_SALTOS;

		$mensaje ="--$separador".$UN_SALTO;
		$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
		$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
			$mensaje .= $texto;

		$cuerpo=$mensaje;

		mail($para, $asunto, $cuerpo, $header);
		}
		$para = "JuanManuel.Gomez@epta-argentina.com";
		$asunto = "Servicio Completado " . $ser_id['ser_cod'] . " - COSTAN";
		$texto ="<html><head><style type='text/css'>";
		$texto .="body,td,th {";
		$texto .="font-family: Arial, Helvetica, sans-serif;";
		$texto .="font-size: 12px;";
		$texto .="}";
		$texto .="</style></head><body>";
		$texto .="<table width='640'>";
		$texto .="<tr>";
		$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
		$texto .="</tr>";
		$texto .="</table>";
		$texto .="<br >";
		$texto .="<table width='640' border='0'>";
		$texto .="<tr>";
		$texto .="<td width='150'><em>Código del servicio:</em></td>";
		$texto .="<td>" . $ser_id['ser_cod'] . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Cliente / Obra:</em></td>";
		$texto .="<td>" . $ser_id['cli_desc'] . " / " . $ser_id['obr_desc'] . " - " . $ser_id['obr_dir'] . "</td>";
		$texto .="</tr>";
		$texto .="<td><em>Fecha / Hora (Cierre):</em></td>";
		$texto .="<td>" . $ser_fecout . " / " . $ser_hourout . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Persona Conforme:</em></td>";
		$texto .="<td>" . $ser_persconforme . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Solución</em></td>";
		$texto .="<td>" . $ser_solucion . "</td>";
		$texto .="</tr></table>";
		$texto .="</body></html>";

		$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

		$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
		$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
		$header .= "MIME-Version: 1.0".$UN_SALTO;
		$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
		$header .= " boundary=$separador".$DOS_SALTOS;

		$mensaje ="--$separador".$UN_SALTO;
		$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
		$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
		$mensaje .= $texto;

		$cuerpo=$mensaje;

		mail($para, $asunto, $cuerpo, $header);

		if ($ser_id['ID_pto']!=0) 
		 	{
		 		$quotations = new quotations;
				$pto_fecInstalacion		= 	date("Y-m-d H:i:s");
				$pto_mail 				=	$ser_id['pto_mail'];
				$ID_pto					=	$ser_id['ID_pto'];
				
				$ID_sta='14'; // Pendiente de Cierre
				
		    	$QuotationsInstalacionAS = $quotations->QuotationsInstalacionAS($ID_pto, $ID_sta, $pto_fecInstalacion);
		    }

		header('Location: signature.php?id='.base64_encode((12344*($ID_ser))/12).'');

}


elseif ($action=='cerrarAsignado') 
{
	echo "Procesando Cierre por asignado";
	///////////////////////////////////////////// RECIBE PARA FUNCIONAR /////////////////////////////////////////////

		$ID_ser					=	$_POST['ID_ser'];
		$ser_solucion			=	str_replace('"','',$_POST['ser_solucion']);
		$ser_persconforme		=	$_POST['ser_persconforme'];
		$ser_hs					=	$_POST['ser_hs'];
		$ser_costo				=	$_POST['ser_costo'];
		$ser_fecout				=	date('Y') . "-" . date('m') . "-" . date('d');
		$ser_hourout			=	date('H') . ":" . date('i') . ":" . date('s');
		$ser_cerrado			=	1;
		$ID_staQuotations 		=  	14;
	

	/////////////////////////////////////////////// VALIDA VARIABLES RECIBIDAS /////////////////////////////////////////////

		if(isset($_POST['ser_conforme'])){
				$ser_conforme		=	1;
			} else {
				$ser_conforme		=	0;
			}
			
			
	///////////////////////////////////////////// EJECUTA CIERRE EN QUOTATIONS	/////////////////////////////////////////////
		
		//BUSCA EL PRESUPUESTO QUE CONTENGA EL ID DE SERVICIO 
			$GetRegistroServicioByIdser 			= 	$registro_servicio->GetRegistroServicioByIdser($ID_ser);
			$assoc_GetRegistroServicioByIdser 		= 	mysql_fetch_assoc($GetRegistroServicioByIdser);

			//COMPRUEBA SI EXISTEN SERVICIOS QUE TENGAN PRESUPUESTOS
				if($assoc_GetRegistroServicioByIdser['pto_pedidoCod']!=" ")
				{

					//SI EXISTEN LOS TRAE A TODOS PARA PASARLOS A CERRADO YA QUE EL TECNICO INDICO COMO CERRADO EL SERVICIO
					$fecha 							=	date("Y-m-d");
				    $fechaInvertida 				=	date("d-m-Y");
				    $fechaYhora 					=	date("Y-m-d H:i:s");
					$pto_fecInstalacion				= 	$fechaYhora;
					$pto_pedidoCod					=   $assoc_GetRegistroServicioByIdser['pto_pedidoCod'];
					
				$GetquotationsByPtoPedidoCod  		= 	$quotations->GetquotationsByPtoPedidoCod($pto_pedidoCod);
				$assoc_GetquotationsByPtoPedidoCod	= 	mysql_fetch_assoc($GetquotationsByPtoPedidoCod);
					$ID_pto					= 	$assoc_GetquotationsByPtoPedidoCod['ID_pto'];	
					$ID_sta='14'; // Pendiente de Cierre
					
			    	$QuotationsInstalacionAS = $quotations->QuotationsInstalacionAS($ID_pto, $ID_sta, $pto_fecInstalacion);
					}
					
				
	


  ////////////////////////////////////////// EJECUTA FUNCIONES DE CIERRE DE SERVICIO/////////////////////////////////////////
						
					$modifica				=	$oOpe->registro_servicio_cierra($ID_ser, $ser_solucion, $ser_persconforme, $ser_conforme, $ser_hs, $ser_costo, $ser_fecout, $ser_hourout, $ser_cerrado);
					
						$ID						=	$_POST['ID_tse'];
						$reqmat					=	$_POST['rst_reqmat'];
						$cant					=	$_POST['rst_cant'];
						$n						=	count($ID);
						$i						=	0;	
						while (@$i < @$n){
							$ID_tse				=	$ID[$i];
							$rst_reqmat			=	$reqmat[$i];
							$rst_cant			=	$cant[$i];
							if($ID_tse != 0){
							$insert				=	$oOpe->insert_rel_sertse($ID_ser, $ID_tse, $rst_reqmat, $rst_cant);
							}
							$i++;
						}

					$registro_servicio_id	=	$oOpe->registro_servicio_id($ID_ser);
					$ser_id					=	mysql_fetch_assoc($registro_servicio_id);
					$obras_id				=	$oOpe->obras_id($ser_id['ID_obr']);
					$obr_id					=	mysql_fetch_assoc($obras_id);
					





		$UN_SALTO="\r\n";
		$DOS_SALTOS="\r\n\r\n";

		///////////////////////////////////////////// ENVIA CORREOS	/////////////////////////////////////////////
		if($ser_id['ser_mail'] != ''){
		$para = $ser_id['ser_mail'];
		$asunto = "Servicio Completado " . $ser_id['ser_cod'] . " - COSTAN";
		$texto ="<html><head><style type='text/css'>";
		$texto .="body,td,th {";
		$texto .="font-family: Arial, Helvetica, sans-serif;";
		$texto .="font-size: 12px;";
		$texto .="}";
		$texto .="</style></head><body>";
		$texto .="<table width='640'>";
		$texto .="<tr>";
		$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
		$texto .="</tr>";
		$texto .="</table>";
		$texto .="<br >";
		$texto .="<table width='640' border='0'>";
		$texto .="<tr>";
		$texto .="<td width='150'><em>Código del servicio:</em></td>";
		$texto .="<td>" . $ser_id['ser_cod'] . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Cliente / Obra:</em></td>";
		$texto .="<td>" . $ser_id['cli_desc'] . " / " . $ser_id['obr_desc'] . " - " . $ser_id['obr_dir'] . "</td>";
		$texto .="</tr>";
		$texto .="<td><em>Fecha / Hora (Cierre):</em></td>";
		$texto .="<td>" . $ser_fecout . " / " . $ser_hourout . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Persona Conforme:</em></td>";
		$texto .="<td>" . $ser_persconforme . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Solcuión:</em></td>";
		$texto .="<td>" . $ser_solucion . "</td>";
		$texto .="</tr></table>";
		$texto .="</body></html>";
		$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

		$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
		$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
		$header .= "MIME-Version: 1.0".$UN_SALTO;
		$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
		$header .= " boundary=$separador".$DOS_SALTOS;

		$mensaje ="--$separador".$UN_SALTO;
		$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
		$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
			$mensaje .= $texto;

		$cuerpo=$mensaje;

		mail($para, $asunto, $cuerpo, $header);
		}

		///////////////////////////////////////////////////////// AVISO CLIENTE

		if($obr_id['obr_supervisor'] != 0){
			$sup				=	$obr_id['obr_supervisor'];
			$supervisores_id	=	$oOpe->supervisores_id($sup);
			$sup_id				=	mysql_fetch_assoc($supervisores_id);

		$para = $sup_id['usu_email'];
		$asunto = "Servicio Completado " . $ser_id['ser_cod'] . " - COSTAN";
		$texto ="<html><head><style type='text/css'>";
		$texto .="body,td,th {";
		$texto .="font-family: Arial, Helvetica, sans-serif;";
		$texto .="font-size: 12px;";
		$texto .="}";
		$texto .="</style></head><body>";
		$texto .="<table width='640'>";
		$texto .="<tr>";
		$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
		$texto .="</tr>";
		$texto .="</table>";
		$texto .="<br >";
		$texto .="<table width='640' border='0'>";
		$texto .="<tr>";
		$texto .="<td width='150'><em>Código del servicio:</em></td>";
		$texto .="<td>" . $ser_id['ser_cod'] . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Cliente / Obra:</em></td>";
		$texto .="<td>" . $ser_id['cli_desc'] . " / " . $ser_id['obr_desc'] . " - " . $ser_id['obr_dir'] . "</td>";
		$texto .="</tr>";
		$texto .="<td><em>Fecha / Hora (Cierre):</em></td>";
		$texto .="<td>" . $ser_fecout . " / " . $ser_hourout . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Persona Conforme:</em></td>";
		$texto .="<td>" . $ser_persconforme . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Solución:</em></td>";
		$texto .="<td>" . $ser_solucion . "</td>";
		$texto .="</tr></table>";
		$texto .="</body></html>";

		$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

		$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
		$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
		$header .= "MIME-Version: 1.0".$UN_SALTO;
		$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
		$header .= " boundary=$separador".$DOS_SALTOS;

		$mensaje ="--$separador".$UN_SALTO;
		$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
		$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
			$mensaje .= $texto;

		$cuerpo=$mensaje;

		mail($para, $asunto, $cuerpo, $header);
		}
		$para = "JuanManuel.Gomez@epta-argentina.com";
		$asunto = "Servicio Completado " . $ser_id['ser_cod'] . " - COSTAN";
		$texto ="<html><head><style type='text/css'>";
		$texto .="body,td,th {";
		$texto .="font-family: Arial, Helvetica, sans-serif;";
		$texto .="font-size: 12px;";
		$texto .="}";
		$texto .="</style></head><body>";
		$texto .="<table width='640'>";
		$texto .="<tr>";
		$texto .="<td align='left'><img src='http://194.196.130.9:8080/crm_pro/images/top_crm.png'></td>";
		$texto .="</tr>";
		$texto .="</table>";
		$texto .="<br >";
		$texto .="<table width='640' border='0'>";
		$texto .="<tr>";
		$texto .="<td width='150'><em>Código del servicio:</em></td>";
		$texto .="<td>" . $ser_id['ser_cod'] . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Cliente / Obra:</em></td>";
		$texto .="<td>" . $ser_id['cli_desc'] . " / " . $ser_id['obr_desc'] . " - " . $ser_id['obr_dir'] . "</td>";
		$texto .="</tr>";
		$texto .="<td><em>Fecha / Hora (Cierre):</em></td>";
		$texto .="<td>" . $ser_fecout . " / " . $ser_hourout . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Persona Conforme:</em></td>";
		$texto .="<td>" . $ser_persconforme . "</td>";
		$texto .="</tr>";
		$texto .="<tr>";
		$texto .="<td><em>Solución</em></td>";
		$texto .="<td>" . $ser_solucion . "</td>";
		$texto .="</tr></table>";
		$texto .="</body></html>";

		$separador = "_separador_de_trozos_".md5 (uniqid (rand()));

		$header = "From: " . $_SESSION['usu_email'] . "".$UN_SALTO;
		$header .="X-Mailer: PHP/" . phpversion() . "".$UN_SALTO;
		$header .= "MIME-Version: 1.0".$UN_SALTO;
		$header .= "Content-Type: multipart/mixed;".$UN_SALTO;
		$header .= " boundary=$separador".$DOS_SALTOS;

		$mensaje ="--$separador".$UN_SALTO;
		$mensaje .="Content-Type: text/html; charset=\"utf-8\"".$UN_SALTO;
		$mensaje .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
		$mensaje .= $texto;

		$cuerpo=$mensaje;

		mail($para, $asunto, $cuerpo, $header);

		if ($ser_id['ID_pto']!=0) 
		 	{
		 		$quotations = new quotations;
				$pto_fecInstalacion		= 	date("Y-m-d H:i:s");
				$pto_mail 				=	$ser_id['pto_mail'];
				$ID_pto					=	$ser_id['ID_pto'];
				
				$ID_sta='14'; // Pendiente de Cierre
				
		    	$QuotationsInstalacionAS = $quotations->QuotationsInstalacionAS($ID_pto, $ID_sta, $pto_fecInstalacion);
		    }

		header('Location: signature.php?id='.base64_encode((12344*($ID_ser))/12).'');

}

?>

