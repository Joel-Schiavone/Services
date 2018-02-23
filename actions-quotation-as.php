<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
require_once('modules/operaciones.php');
require_once("phpmailer/PHPMailerAutoload.php");
require_once("phpmailer/mailer-params.php");
@$ID_pto			=	$_POST['ID_pto'];
$action 			=	$_POST['actionAS'];
$quotations 		= 	new quotations;
$forecast 			= 	new forecast;
$usuarios   		= 	new usuarios;
$especiales 		=	new especiales;
$status 			=	new status;
$tipo_presupuesto	= 	new tipo_presupuesto;
$registro_servicio	= 	new registro_servicio;
$oOpe				=	new operaciones();
$back 				= 	explode('?', $_SESSION['actionsBack']);

//INICIO UTILIZADOS POR MAIL 
		$ID_usu					=	$_SESSION['ID_usu'];
 		$getUsuariosById		= 	$usuarios->getUsuariosById($ID_usu);
	    $assoc_getUsuariosById  = 	mysql_fetch_assoc($getUsuariosById);
	    $ID_usu_ger   			=  	$assoc_getUsuariosById['ID_usu_ger'];
	    $correoEmisor   		=  	$_SESSION['usu_email'];
	    $usu_nombre   			=  	$assoc_getUsuariosById['usu_nombre'];
	    $usu_apellido   		=  	$assoc_getUsuariosById['usu_apellido'];
	    $getUsuariosByIdB		= 	$usuarios->getUsuariosById($ID_usu_ger);
	    $assoc_getUsuariosByIdB = 	mysql_fetch_assoc($getUsuariosByIdB);
	    $fecha 					=	date("Y-m-d");
	    $fechaInvertida 		=	date("d-m-Y");
	    $fechaYhora 			=	date("Y-m-d H:i:s");

//FIN UTILIZADOS POR MAIL 	 

		$getUsuariosById = $usuarios->getUsuariosById($ID_usu);
		$assoc_getUsuariosById = mysql_fetch_assoc($getUsuariosById);
		$iniciales=$assoc_getUsuariosById['usu_iniciales'];

//Inicio: Genera codigo

	    $registro_presupuesto_nextid	=	$especiales->registro_presupuesto_nextid();
		$reg_pto_nextid					=	mysql_fetch_assoc($registro_presupuesto_nextid);	
	 	$fic_cod						=	date('Y') . date('m') . date('d') . $reg_pto_nextid['NEXTID'];
 		
 		//modifica la tabla quotation_numeracion incrementando en uno el valor de qnu_ultimo 
		//$qnu_ultimo								=  $NEXTID;
		//$ID_qno 								=  $assoc_GetUltimoQuotationsNumeracion['ID_qno'];
 		//$UpdateUltimoQuotationsNumeracion  		= $quotations_numeracion->UpdateUltimoQuotationsNumeracion($ID_qno, $qnu_ultimo);
 		
//Fin: Genera codigo

if($action=="insertQuotationAS")
	{
		$ID_tpp				=	$_POST['ID_tpp'];
		$pto_contacto		=	$_POST['pto_contacto'];
		$pto_telefono 		= 	$_POST['pto_telefono'];		
		$pto_asignado 		= 	$_POST['pto_asignado'];
		$ID_pri 			= 	$_POST['ID_pri'];	
		$pto_desc 			= 	$_POST['pto_desc'];	
		$ID_obr 			= 	$_POST['ID_obr'];
		$ID_cli				= 	$_POST['ID_cli'];
		$ID_sta 			= 	'12';	
		$ID_emp 			= 	'1';
		$pto_fecIngreso 	=   $fechaYhora;	


//inicio: trae responsable
	$getUsuariosById 		= 	$usuarios->getUsuariosById($pto_asignado);
	$assoc_getUsuariosById 	=   mysql_fetch_assoc($getUsuariosById);
	$correo 				= 	$assoc_getUsuariosById['usu_email'];
	$responsable 			= 	$assoc_getUsuariosById['usu_nombre']." ".$assoc_getUsuariosById['usu_apellido'];
//fin: trae responsable		

	if ($_POST['pto_mail']!="") 
		{
			$pto_mail=$_POST['pto_mail'];
		}
		if($_POST['pto_mail1']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail1'];
		}
		if($_POST['pto_mail2']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail2'];
		}
		if($_POST['pto_mail3']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail3'];
		}
		if($_POST['pto_mail4']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail4'];
		}
		if($_POST['pto_mail5']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail5'];
		}

	 //Inicio: crea codigo
		$pto_pedidoCod 		= $fic_cod;
		//Fin Crea codigo

		$insertQuotationAs=$quotations->insertQuotationAs($ID_tpp, $pto_contacto, $pto_telefono, $pto_mail, $pto_asignado, $ID_pri, $ID_sta, $pto_desc, $ID_obr, $ID_cli, $ID_emp, $ID_usu, $pto_fecIngreso, $pto_pedidoCod);
	

		//Inicio: Trae ultimo ID de Quotations	
			$getUltimoQuotationsByIdpto 		= 	$quotations->getUltimoQuotationsByIdpto();
			$assoc_getUltimoQuotationsByIdpto	= 	mysql_fetch_assoc($getUltimoQuotationsByIdpto);
			$ID_pto								=   $assoc_getUltimoQuotationsByIdpto['ID_pto'];
		
		//Fin: Trae ultimo ID de Quotations
			
//Inicio: separa cadena de mail para poder enviar a todas las direcciones
			/* 
$CadenMail=explode(",",$pto_mail);
$numeroDeMail=count($CadenMail);
$NuevacadenaDeMails="";
 */
//Fin: separa cadena de mail para poder enviar a todas las direcciones		

// Inicio Modulo Envia maiL

			$tiendasMail 							=	new tiendas;
			$getTiendasByIdMail						=	$tiendasMail->getTiendasById($ID_obr);
			$assoc_getTiendasByIdMail				= 	mysql_fetch_assoc($getTiendasByIdMail);
			$ClienteTiendaMail 						= 	$assoc_getTiendasByIdMail['cli_desc']. " / " . $assoc_getTiendasByIdMail['obr_desc']; 

    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =  "Presupuesto Aceptado No. ".$pto_pedidoCod." - COSTAN";
    $texto                       =   "<p>Se lo ha asignado al pedido de presupuesto No ".$pto_pedidoCod."</p><p>Fecha y Hora: " . $pto_fecIngreso . "</p><p>Cliente / Tienda: ".$ClienteTienda."</p><p>Descripción del pedido: " . $pto_desc . "</p><p><strong>Para continuar con el proceso de presupuestación ingrese al sistema y acepte este pedido.</strong></p>";
    $destinatario                =   $correo;
	   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
		{ 
			$mail->AddCC($CadenMail[$CadenaMailCount]);  
		}
		
	  $recipients = array(
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	  );
	  */
    $copiasOcultas  =  $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail
    
		
		echo "<script type='text/javascript'>
  window.location.assign('dashboard-backoffice-AS.php?m=7&ID_pto=".base64_encode((12344*($ID_pto))/12)."');
  </script>";
  //header('Location: dashboard-backoffice-AS.php?m=7&ID_pto='.base64_encode((12344*($ID_pto))/12).'');
	}

if($action=="modifQuotationAS")
	{
		$ID_tpp				=	$_POST['ID_tpp'];
	    $pto_contacto		=	$_POST['pto_contacto'];
		$pto_telefono 		= 	$_POST['pto_telefono'];		
		$pto_asignado 		= 	$_POST['pto_asignado'];
		$ID_pri 			= 	$_POST['ID_pri'];	
		$pto_desc 			= 	$_POST['pto_desc'];	
		$ID_pto				= 	$_POST['ID_pto'];
		$ID_obr 			= 	$_POST['ID_obr'];
		$pto_pedidoCod 		= 	$_POST['pto_pedidoCod'];

		echo $pto_asignado;

		if ($_POST['pto_mail']!="") 
		{
			$pto_mail=$_POST['pto_mail'];
		}
		if($_POST['pto_mail1']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail1'];
		}
		if($_POST['pto_mail2']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail2'];
		}
		if($_POST['pto_mail3']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail3'];
		}
		if($_POST['pto_mail4']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail4'];
		}
		if($_POST['pto_mail5']!="")
		{
			$pto_mail=$pto_mail.",".$_POST['pto_mail5'];
		}


		$updateQuotationAs=$quotations->updateQuotationAs($ID_tpp, $pto_contacto, $pto_telefono, $pto_mail, $pto_asignado, $ID_pri, $pto_desc, $ID_pto);

		
		/*echo "<script type='text/javascript'>
  window.location.assign('modify-quotation-as.php?m=2&ID_pto=".base64_encode((12344*($ID_pto))/12)."&ID_obr=".base64_encode((12344*($ID_obr))/12)."');
  </script>";
  //header('Location: '.$back[0].'?m=2&ID_pto='.base64_encode((12344*($ID_pto))/12).'&ID_obr='.base64_encode((12344*($ID_obr))/12).'');
*/
	}


elseif($action=='asignado')
	{
		 $ID_pto 					=	$_POST['ID_pto'];
		 $pto_fecEntregaEstimada	=	$_POST['pto_fecEntregaEstimada'];
		 $pto_asignado				=	$_POST['pto_asignado'];
		 $pto_ayudaOt 				= 	" ";	
		 $pto_pedidoCod				=	$_POST['pto_pedidoCod'];
		 $assignQuotations			=	$quotations->assignQuotations($ID_pto, $pto_fecEntregaEstimada, $pto_asignado, $pto_ayudaOt);
		$getUsuariosById 		= 	$usuarios->getUsuariosById($pto_asignado);
		$assoc_getUsuariosById 	=   mysql_fetch_assoc($getUsuariosById);
		$correo 				= 	$assoc_getUsuariosById['usu_email'];



		//Fin: Trae ultimo ID de Quotations
			$quotationsMail 						= 	new quotations;
	    	$getQuotationsMail						= 	$quotationsMail->getQuotations($ID_pto);
	    	$assoc_getQuotationsMail 				= 	mysql_fetch_assoc($getQuotationsMail);
	    	$ID_obrMail 							= 	$assoc_getQuotationsMail['ID_obr'];
			$tiendasMail 							=	new tiendas;
			$getTiendasByIdMail						=	$tiendasMail->getTiendasById($ID_obrMail);
			$assoc_getTiendasByIdMail				= 	mysql_fetch_assoc($getTiendasByIdMail);
			$ClienteTiendaMail 						= 	$assoc_getTiendasByIdMail['cli_desc']. " / " . $assoc_getTiendasByIdMail['obr_desc']; 
//Inicio: separa cadena de mail para poder enviar a todas las direcciones
			/* 
$CadenMail=explode(",",$pto_mail);
$numeroDeMail=count($CadenMail);
$NuevacadenaDeMails="";
 */
//Fin: separa cadena de mail para poder enviar a todas las direcciones		

// Inicio Modulo Envia maiL


    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =  "Presupuesto Aceptado No. ".$pto_pedidoCod." - COSTAN";
    $texto                       =   "<p>Se lo ha asignado al pedido de presupuesto No ".$pto_pedidoCod."</p><p>Fecha y Hora: " . $pto_fecIngreso . "</p><p>Cliente / Tienda: ".$ClienteTienda."</p><p>Descripción del pedido: " . $pto_desc . "</p><p><strong>Para continuar con el proceso de presupuestación ingrese al sistema y acepte este pedido.</strong></p>";
    $destinatario                =   $correo;
	   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
		{ 
			$mail->AddCC($CadenMail[$CadenaMailCount]);  
		}
		
	  $recipients = array(
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	  );
	  */
    $copiasOcultas  =  $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail
    
		echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=7');
  </script>";
  //header('Location: '.$back[0].'?m=7');

	} 
	elseif($action=='bloqueado')
	{
		$pto_fecBloqueo			=	$_POST['pto_fecBloqueo'];
		$motivo					=	$_POST['motivo'];
		$ID_usu					=	$_POST['ID_usu'];
		$pto_pedidoCod			=	$_POST['pto_pedidoCod'];
		$ID_pto					=	$_POST['ID_pto'];
		$bloquearQuotations		=	$quotations->bloquearQuotations($ID_pto, $pto_fecBloqueo);

		$getUsuariosById 		= 	$usuarios->getUsuariosById($ID_usu);
		$assoc_getUsuariosById 	=   mysql_fetch_assoc($getUsuariosById);
		$correo 				= 	$assoc_getUsuariosById['usu_email'];

		echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=14');
  </script>";
  //header('Location: '.$back[0].'?m=14');

	} 


	elseif ($action=='rechazado') 
	{
		$ID_pto 				= $_POST['ID_pto'];
		$ID_sta 				= $_POST['ID_sta'];
		$pto_pedidoCod 			= $_POST['pto_pedidoCod'];
		$pto_asignado			= $_POST['pto_asignado'];
		$ID_mot 				= $_POST['ID_mot'];

		$getQuotations 			=   $quotations->getQuotations($ID_pto);
	    $assoc_getQuotations 	=   mysql_fetch_assoc($getQuotations);
	    $ID_usuario 			=   $assoc_getQuotations['ID_usu'];
		//trae correro y nombre del pto_asignado o responsable del pedido
		$getUsuariosByIdC 		=	$usuarios->getUsuariosById($ID_usuario);
		$assoc_getUsuariosByIdC =	mysql_fetch_assoc($getUsuariosByIdC);
		$correo 				=	$assoc_getUsuariosByIdC['usu_email'];
		$nombreVendedor 		=	$assoc_getUsuariosByIdC['usu_nombre'];
		$apellidoVendedor		=	$assoc_getUsuariosByIdC['usu_apellido'];

	    $changeStatusQuotations	=	$quotations->changeStatusQuotations($ID_pto, $ID_sta, $ID_mot);

	
	// Inicio Modulo Envia maiL

    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =  "Presupuesto Aceptado No. ".$pto_pedidoCod." - COSTAN";
    $texto                       =   "<p>El pedido de presupuesto No. ".$pto_pedidoCod." ha sido rechazado por el vendedor. </p><p><strong>No ".$pto_pedidoCod."</strong></p>";
    $destinatario                =   $correo;
	   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
		{ 
			$mail->AddCC($CadenMail[$CadenaMailCount]);  
		}
		
	  $recipients = array(
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	  );
	  */
    $copiasOcultas  =  $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail

				echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=11');
  </script>";
  //header('Location: '.$back[0].'?m=11');
	} 


	elseif ($action=='devolver') 
	{
		$ID_pto 				= $_POST['ID_pto'];
		$ID_sta 				= $_POST['ID_sta'];
		$pto_pedidoCod 			= $_POST['pto_pedidoCod'];
		$pto_asignado			= $_POST['pto_asignado'];

		//trae correro y nombre del pto_asignado o responsable del pedido
		$getUsuariosByIdC 		=	$usuarios->getUsuariosById($pto_asignado);
		$assoc_getUsuariosByIdC =	mysql_fetch_assoc($getUsuariosByIdC);
		$correo 				=	$assoc_getUsuariosByIdC['usu_email'];
		$nombreVendedor 		=	$assoc_getUsuariosByIdC['usu_nombre'];
		$apellidoVendedor		=	$assoc_getUsuariosByIdC['usu_apellido'];

	    $DevolverQuotations	=	$quotations->DevolverQuotations($ID_pto, $ID_sta, $pto_asignado);

				echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=11');
  </script>";
  //header('Location: '.$back[0].'?m=11');
	} 

	elseif ($action=='changeStatus') 
	{

		$ID_pto 				= $_POST['ID_pto'];
		$ID_sta 				= $_POST['ID_sta'];
		$pto_pedidoCod 			= $_POST['pto_pedidoCod'];
		$pto_asignado			= $_POST['pto_asignado'];

		//trae correro y nombre del pto_asignado o responsable del pedido
		$getUsuariosByIdC 		=	$usuarios->getUsuariosById($pto_asignado);
		$assoc_getUsuariosByIdC =	mysql_fetch_assoc($getUsuariosByIdC);
		$correo 				=	$assoc_getUsuariosByIdC['usu_email'];
		$nombreVendedor 		=	$assoc_getUsuariosByIdC['usu_nombre'];
		$apellidoVendedor		=	$assoc_getUsuariosByIdC['usu_apellido'];

	    $changeStatusQuotations	=	$quotations->changeStatusQuotations($ID_pto, $ID_sta);

	    $getStatusById = $status->getStatusById($ID_sta);
	    $assoc_getStatusById = mysql_fetch_assoc($getStatusById);

				echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=11');
  </script>";
  //header('Location: '.$back[0].'?m=11');
	} 

	elseif ($action=='aceptado') 
	{

		$ID_pto 				= $_POST['ID_pto'];
		$pto_pedidoCod 			= $_POST['pto_pedidoCod'];
		$pto_asignado			= $_POST['pto_asignado'];
		$ID_sta					= $_POST['ID_sta'];
		$pto_fecAceptado		= $fechaYhora;

	    $QuotationsAssignAS	=	$quotations->QuotationsAssignAS($ID_pto, $pto_pedidoCod, $pto_fecAceptado, $ID_sta);

	    $getQuotations=$quotations->getQuotations($ID_pto);
	    $assoc_getQuotations=mysql_fetch_assoc($getQuotations);
	    $pto_mail=$assoc_getQuotations['pto_mail'];
	    //Inicio: separa cadena de mail para poder enviar a todas las direcciones
		$CadenMail=explode(",",$pto_mail);
		$numeroDeMail=count($CadenMail);
		$NuevacadenaDeMails="";
		$contacto=$assoc_getQuotations['pto_contacto'];
	 
// Inicio Modulo Envia maiL
      
			$quotationsMail 					    = 	new quotations;
	    	$getQuotationsMail						= 	$quotationsMail->getQuotations($ID_pto);
	    	$assoc_getQuotationsMail 				= 	mysql_fetch_assoc($getQuotationsMail);
	    	$ID_obrMail 							= 	$assoc_getQuotationsMail['ID_obr'];
			$tiendasMail 							=	new tiendas;
			$getTiendasByIdMail						=	$tiendasMail->getTiendasById($ID_obrMail);
			$assoc_getTiendasByIdMail				= 	mysql_fetch_assoc($getTiendasByIdMail);
			$ClienteTiendaMail 						= 	$assoc_getTiendasByIdMail['cli_desc']. " / " . $assoc_getTiendasByIdMail['obr_desc']; 
//Inicio: separa cadena de mail para poder enviar a todas las direcciones
			/* 
$CadenMail=explode(",",$pto_mail);
$numeroDeMail=count($CadenMail);
$NuevacadenaDeMails="";
 */
//Fin: separa cadena de mail para poder enviar a todas las direcciones		


    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =  "Presupuesto Aceptado No. ".$pto_pedidoCod." - COSTAN";
    $texto                       =   "<p>Estimado ".$assoc_getQuotations['pto_contacto']."</p><p>Se ha generado un pedido de presupuesto con el No. <strong>" . $assoc_getQuotations['pto_pedidoCod'] . "</strong> con el siguiente detalle:</p><p>Fecha y Hora: " . $assoc_getQuotations['pto_fecIngreso'] . "</p><p>Cliente / Tienda: " . $ClienteTiendaMail . "</p><p>Descripción del pedido: " . $assoc_getQuotations['pto_desc'] . "</p>";
    $destinatario                =   $correo;
	   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
		{ 
			$mail->AddCC($CadenMail[$CadenaMailCount]);  
		}
		
	  $recipients = array(
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	  );
	  */
    $copiasOcultas  =  $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail


   	echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=11');
  </script>";
	} 


	elseif ($action=='quotate') 
	{
		$ID_tipoMonedaPres		=	$_POST['ID_tipoMonedaPres'];
		$tipoCambioPres			=	$_POST['tipoCambioPres'];
		$pto_montoPresupuesto	=	$_POST['pto_montoPresupuesto'];
		$pto_pedidoCod			=	$_POST['pto_pedidoCod'];
		$ID_pto					=	$_POST['ID_pto'];
		$pto_contacto			=	$_POST['pto_contacto'];
		$pto_asignado			=	$_POST['pto_asignado'];
		$pto_diasEntrega		=	$_POST['pto_diasEntrega'];
		$ID_tpp					=	$_POST['ID_tpp'];
		$pto_fecPresupuesto 	= 	$fechaYhora;
		$ID_sta 				= 	"13";
		$correo 				=	"carlos.sosa@epta-argentina.com";
	
		//buca en presupuesto tpp_prep por tipo de presupuesto 
		$getTipoPresupuestoByIdTpp = $tipo_presupuesto->getTipoPresupuestoByIdTpp($ID_tpp);
		$assoc_getTipoPresupuestoByIdTpp=mysql_fetch_assoc($getTipoPresupuestoByIdTpp);
		$tpp_prep=$assoc_getTipoPresupuestoByIdTpp['tpp_prep'];
		

		//Arma el numero de codigo
		//$pto_numero 			= 	$ser_id['tpp_prep'].$v_id['usu_iniciales'].$ser_id['ser_cod']
		$pto_numero 			= 	$tpp_prep.$iniciales.$pto_pedidoCod;

      $QuotationsQuotateAS = $quotations->QuotationsQuotateAS($ID_pto, $ID_tipoMonedaPres, $tipoCambioPres, $pto_montoPresupuesto, $pto_fecPresupuesto, $ID_sta, $pto_diasEntrega, $pto_numero);
		
	    $getQuotations=$quotations->getQuotations($ID_pto);
	    $assoc_getQuotations=mysql_fetch_assoc($getQuotations);
	    $pto_mail=$assoc_getQuotations['pto_mail'];
	    $pto_OV=$assoc_getQuotations['pto_OV'];
	    //Inicio: separa cadena de mail para poder enviar a todas las direcciones
		$CadenMail=explode(",",$pto_mail);
		$numeroDeMail=count($CadenMail);
		$NuevacadenaDeMails="";
		$contacto=$assoc_getQuotations['pto_contacto'];
	 
// Inicio Modulo Envia maiL
      
			$quotationsMail 					    = 	new quotations;
	    	$getQuotationsMail						= 	$quotationsMail->getQuotations($ID_pto);
	    	$assoc_getQuotationsMail 				= 	mysql_fetch_assoc($getQuotationsMail);
	    	$ID_obrMail 							= 	$assoc_getQuotationsMail['ID_obr'];
			$tiendasMail 							=	new tiendas;
			$getTiendasByIdMail						=	$tiendasMail->getTiendasById($ID_obrMail);
			$assoc_getTiendasByIdMail				= 	mysql_fetch_assoc($getTiendasByIdMail);
			$ClienteTiendaMail 						= 	$assoc_getTiendasByIdMail['cli_desc']. " / " . $assoc_getTiendasByIdMail['obr_desc']; 
		//Inicio: separa cadena de mail para poder enviar a todas las direcciones
		/* 
		$CadenMail=explode(",",$pto_mail);
		$numeroDeMail=count($CadenMail);
		$NuevacadenaDeMails="";
		 */
		//Fin: separa cadena de mail para poder enviar a todas las direcciones		


    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =  "Presupuesto No. ".$pto_pedidoCod." - COSTAN";
    $texto                       =   "<p>Estimado ".$assoc_getQuotations['pto_contacto']."</p><p>Adjunto se encuentra el presupuesto No. <strong>" . $assoc_getQuotations['pto_numero'] . "</strong> según pedido  No. <strong>" . $assoc_getQuotations['pto_pedidoCod'] . "</strong>.</p><p><strong>Orden de Venta: </strong>".$pto_OV."</p>";
    $destinatario                =   $correo;
	   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
		{ 
			$mail->AddCC($CadenMail[$CadenaMailCount]);  
		}
		
	  $recipients = array(
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	  );
	  */
    $copiasOcultas  =  $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail
	

   	echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=12');
  </script>";
  //header('Location: '.$back[0].'?m=12');
}


elseif ($action=='vendido') 
	{
		$pto_OC					=	$_POST['pto_OC'];
		$pto_OV					=	$_POST['pto_OV'];
		$pto_proyecto			=	$_POST['pto_proyecto'];
		$pto_fecEntrega			=	$_POST['pto_fecEntrega'];
		$ID_tipoMonedaVenta		=	$_POST['ID_tipoMonedaVenta'];
		$tipoCambioVenta		=	$_POST['tipoCambioVenta'];
		$pto_montoOV			=	$_POST['pto_montoOV'];
		$pto_mail 				=	$_POST['pto_mail'];
		$pto_pedidoCod			=	$_POST['pto_pedidoCod'];
		$ID_pto					=	$_POST['ID_pto'];
		$ID_tpp					=	$_POST['ID_tpp'];
		$pto_contacto			=	$_POST['pto_contacto'];
		$pto_asignado			=	$_POST['pto_asignado'];
		$pto_fecVenta 		 	= 	$fechaYhora;
		// Validador de estado siguiente
		$getTipoPresupuestoByIdTpp=$tipo_presupuesto->getTipoPresupuestoByIdTpp($ID_tpp);
		$assoc_getTipoPresupuestoByIdTpp=mysql_fetch_assoc($getTipoPresupuestoByIdTpp);
		$despacho 		= $assoc_getTipoPresupuestoByIdTpp['tpp_despacho'];
		$instalacion 	= $assoc_getTipoPresupuestoByIdTpp['tpp_instalacion'];
		if ($despacho=='1' AND $instalacion=='1')
		 {
			$ID_sta='15'; // Pendiente de despacho 
			$texto ='Pendiente de despacho';
		 }
		 if ($despacho==0 AND $instalacion==1)
		 {
		 	$ID_sta='20'; // Pendiente de instalacion 
		 	$texto ='Pendiente de instalacion'; 
		 }
		 if ($despacho==1 AND $instalacion==0)
		 {
		 	$ID_sta='15'; // Pendiente de despacho 
		 	$texto ='Pendiente de despacho';
		 }
		 if ($despacho==0 AND $instalacion==0)
		 {
		 	$ID_sta='14'; // Pendiente de Cierre 
		 	$texto ='Pendiente de Cierre';
		 }
		
		//trae correro y nombre del pto_asignado o responsable del pedido
		$getUsuariosByIdC 		=	$usuarios->getUsuariosById($pto_asignado);
		$assoc_getUsuariosByIdC =	mysql_fetch_assoc($getUsuariosByIdC);
		$correo 				=	$assoc_getUsuariosByIdC['usu_email'];
		$nombreVendedor 		=	$assoc_getUsuariosByIdC['usu_nombre'];
		$apellidoVendedor		=	$assoc_getUsuariosByIdC['usu_apellido'];
		$pto_asignado			=	@$assoc_getUsuariosByIdC['pto_asignado'];

    	$QuotationsSaleAS = $quotations->QuotationsSaleAS($ID_pto, $pto_OC, $pto_OV, $pto_proyecto, $pto_fecEntrega, $ID_tipoMonedaVenta, $tipoCambioVenta, $pto_montoOV, $ID_sta, $pto_fecVenta);

      $getQuotations=$quotations->getQuotations($ID_pto);
	    $assoc_getQuotations=mysql_fetch_assoc($getQuotations);
	    $pto_mail=$assoc_getQuotations['pto_mail'];
	    $pto_OV=$assoc_getQuotations['pto_OV'];
	    //Inicio: separa cadena de mail para poder enviar a todas las direcciones
		$CadenMail=explode(",",$pto_mail);
		$numeroDeMail=count($CadenMail);
		$NuevacadenaDeMails="";
		$contacto=$assoc_getQuotations['pto_contacto'];
	 
// Inicio Modulo Envia maiL
      
			$quotationsMail 					    = 	new quotations;
	    	$getQuotationsMail						= 	$quotationsMail->getQuotations($ID_pto);
	    	$assoc_getQuotationsMail 				= 	mysql_fetch_assoc($getQuotationsMail);
	    	$ID_obrMail 							= 	$assoc_getQuotationsMail['ID_obr'];
			$tiendasMail 							=	new tiendas;
			$getTiendasByIdMail						=	$tiendasMail->getTiendasById($ID_obrMail);
			$assoc_getTiendasByIdMail				= 	mysql_fetch_assoc($getTiendasByIdMail);
			$ClienteTiendaMail 						= 	$assoc_getTiendasByIdMail['cli_desc']. " / " . $assoc_getTiendasByIdMail['obr_desc']; 
		//Inicio: separa cadena de mail para poder enviar a todas las direcciones
					
		$CadenMail=explode(",",$pto_mail);
		$numeroDeMail=count($CadenMail);
		$NuevacadenaDeMails="";
		 
		//Fin: separa cadena de mail para poder enviar a todas las direcciones		

    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =  "Confirmación de Pedido Vendido No ".$pto_pedidoCod." - COSTAN";
    $texto                       =   "<p>Estimado ".$assoc_getQuotations['pto_contacto']."</p><p> Se registro como Vendido el presupuesto No. <strong>" . $assoc_getQuotations['pto_numero'] . "</strong> . </p><p><strong>Orden de Venta: </strong>".$pto_OV."</p>";
    $destinatario                =   $correo;
	   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
		{ 
			$mail->AddCC($CadenMail[$CadenaMailCount]);  
		}
		
	  $recipients = array(
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	  );
	  */
    $copiasOcultas  =  $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail
	
		
		
   	echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=12');
  </script>";
  // header('Location: '.$back[0].'?m=12');


}

elseif ($action=='Instalar') 
	{
		$ID_pto					=	$_POST['ID_pto'];
		$ID_sta 				=   14; //PENDIENTE DE CIERRE
		$pto_fecInstalacion 	= 	$fechaYhora;
		$QuotationsInstalacionAS = $quotations->QuotationsInstalacionAS($ID_pto, $ID_sta, $pto_fecInstalacion);
		echo "<script type='text/javascript'>
			  window.location.assign('".$back[0]."?m=12');
			  </script>";
	}
elseif ($action=='despachado') 
	{
		$pto_remito				=	$_POST['pto_remito'];
		$pto_fecDespacho		= 	$fechaYhora;
		$pto_mail 				=	$_POST['pto_mail'];
		$pto_pedidoCod			=	$_POST['pto_pedidoCod'];
		$ID_pto					=	$_POST['ID_pto'];
		$ID_tpp					=	$_POST['ID_tpp'];
		$pto_contacto			=	$_POST['pto_contacto'];
		$pto_asignado			=	$_POST['pto_asignado'];
		$ser_cod				=	$_POST['ser_cod'];


				//trae correro y nombre del pto_asignado o responsable del pedido
					$getUsuariosByIdC 		=	$usuarios->getUsuariosById($pto_asignado);
					$assoc_getUsuariosByIdC =	mysql_fetch_assoc($getUsuariosByIdC);
					$correo 				=	$assoc_getUsuariosByIdC['usu_email'];
					$nombreVendedor 		=	$assoc_getUsuariosByIdC['usu_nombre'];
					$apellidoVendedor		=	$assoc_getUsuariosByIdC['usu_apellido'];


//Busca el presupuesto mediante el ID_pto y traer el remito
			$getQuotationsByIdPto=$quotations->getQuotationsByIdPto($ID_pto);
			$assoc_getQuotationsByIdPto=mysql_fetch_assoc($getQuotationsByIdPto);
			$pto_remitoAnterior=$assoc_getQuotationsByIdPto['pto_remito'];
			$pto_OV=$assoc_getQuotationsByIdPto['pto_OV'];
			//Si ese remito que trae esta vacio agrega solo el codigo de remito en caso contrario agrega una coma y el numero de remito

			if ($pto_remitoAnterior=="") 
			{
				$pto_remito=$pto_remito;
				$pto_remito_mail=$pto_remito;
				$pto_remito_mail_anterior="";
			}
			else
			{
				$pto_remito_mail=$pto_remito;
			    $pto_remito=$pto_remitoAnterior." ,".$pto_remito;
			    $pto_remito_mail_anterior=" relacionado a los remitos ".$pto_remitoAnterior;
			}	

		$getQuotations=$quotations->getQuotations($ID_pto);
	    $assoc_getQuotations=mysql_fetch_assoc($getQuotations);
	    $pto_mail=$assoc_getQuotations['pto_mail'];
	    //Inicio: separa cadena de mail para poder enviar a todas las direcciones
		$CadenMail=explode(",",$pto_mail);
		$numeroDeMail=count($CadenMail);
		$NuevacadenaDeMails="";

		// Comprueba si es un envio parcial o total, si es un envio parcial solo mantiene el estado y agrega el numero de  remito
	if (@$_POST['Parcial']) 
		{
			$ID_sta=15;


	        // Inicio Modulo Envia maiL

			    //Trae Modulo para construir el asunto del mensaje
			/*
			    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
			    $asunto 					 =  "Confirmación de Despacho Pedido No ".$pto_pedidoCod." - COSTAN";
			    $texto                       =   "<p> Estimado ".$assoc_getQuotations['pto_contacto']." </p><p> Confirmamos que se ha despachado Parcialmente el pedido No ".$pto_pedidoCod." con Numero de remito<p><strong>Orden de Venta: </strong>".$pto_OV."</p>".$pto_remito_mail."  ".$pto_remito_mail_anterior."</p>";
			    $destinatario                =   $correo;
			
			    
			  $recipients = array(
			  'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
			   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
			  );
			
			    $copiasOcultas             =   $correo;
			    include('../inc/envio_mail.php');
			     */ 
			// Fin Modulo Envia mail
		
		}
		else
		{

	          // Inicio Modulo Envia maiL

			    //Trae Modulo para construir el asunto del mensaje
			/*
			    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
			    $asunto 					 =  "Confirmación de Despacho Pedido No ".$pto_pedidoCod." - COSTAN"; 
			    $texto                       =   "<p> Estimado ".$assoc_getQuotations['pto_contacto']." </p><p> Confirmamos que se ha despachado el pedido No ".$pto_pedidoCod." con Numero de remito  ".$pto_remito_mail."  ".$pto_remito_mail_anterior."</p><p><strong>Orden de Venta: </strong>".$pto_OV."</p>";
			    $destinatario                =   $correo;
			
			 /*   
			  $recipients = array(
			  'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
			   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
			  );
			
			    $copiasOcultas             =   $correo;
			    include('../inc/envio_mail.php');
			   */   
			// Fin Modulo Envia mail
		

					
		// Validador de estado siguiente
		$getTipoPresupuestoByIdTpp=$tipo_presupuesto->getTipoPresupuestoByIdTpp($ID_tpp);
		$assoc_getTipoPresupuestoByIdTpp=mysql_fetch_assoc($getTipoPresupuestoByIdTpp);
		$instalacion = $assoc_getTipoPresupuestoByIdTpp['tpp_instalacion'];


		 if ($instalacion==1)
		 {
		 	$ID_sta='20'; // Pendiente de instalacion 
		 	$texto ='Pendiente de instalacion';
		 	// Verifica si tiene codigo de servicio

		 	if ($ser_cod=="")
		 	{
		 		    $tabla="registro_servicio";
					    $ProximoId_registro_servicio=$especiales->ProximoId($tabla);
					    $assoc_ProximoId_registro_servicio=mysql_fetch_assoc($ProximoId_registro_servicio);
					    $ID_ser=$assoc_ProximoId_registro_servicio['NEXTID'];

		 		$ID_sta='20'; // Pendiente de instalacion 
		 		$texto ='Pendiente de instalacion';
		 		// Si no tiene codigo de servicio crea un servicio nuevo 
		 		$ID_cli				   = $_POST['ID_cli'];
		 		$ID_obr 				= $_POST['ID_obr'];
		 		$ID_usu 				= $_POST['ID_usu'];
		 		$ser_tipo 				= 1;
		 		$ser_fecin				= date('Y') . "-" . date('m') . "-" . date('d');
				$ser_hourin				= date('H') . ":" . date('i') . ":" . date('s');
				$registro_servicio_dia	= $oOpe->registro_servicio_dia($ser_fecin);
				$num_reg				= mysql_num_rows($registro_servicio_dia);
				$ser_cod				= date('Y') . date('m') . date('d') . $ID_ser;
		 		$ser_desc 				= $_POST['pto_desc'];
		 		$ID_staB 				= 1;
		 		$ID_pri 				= 3;
		 		$ser_telefono			= $_POST['pto_telefono'];
		 		$ser_mail				= $_POST['pto_mail'];
		 		$ser_contacto			= $_POST['pto_contacto'];

		 	$insert_registro_servicioNuevo=$registro_servicio->insert_registro_servicioNuevoDesdeQuotationsAS($ID_cli, $ID_obr, $ID_usu, $ser_tipo, $ser_cod, $ser_fecin, $ser_hourin, $ID_staB, $ID_pri, $pto_pedidoCod, $ser_desc, $ser_telefono, $ser_mail, $ser_contacto);

		 	//Modifica el codigo de servicio que vincula al presupuesto
		 	$UpdateQuotationsSerCod=$quotations->UpdateQuotationsSerCod($ID_pto, $ser_cod);

		 	/*
		 	$getUltimoRegistroServicio=$registro_servicio->getUltimoRegistroServicio();
			$assoc_getUltimoRegistroServicio=mysql_fetch_assoc($getUltimoRegistroServicio);
			$ID_ser=$assoc_getUltimoRegistroServicio['ID_ser'];

			modifica el codigo de servicio en la base de datos por la vercion nueva que cambia los ultimos numeros por el ID del servicio
			$ser_codB	=	date('Y') . date('m') . date('d') . $ID_ser;

			$UpdateRegistroServiciosSerCod=$registro_servicio->UpdateRegistroServiciosSerCod($ser_codB, $ID_ser);
			*/
		 	}
		 	else 
		 	{
		 		$ID_sta='20'; // Pendiente de instalacion 
		 		$texto ='Pendiente de instalacion';

					//Cambia el estado del servicio de esperando repuesto a pendiente para que el tecnico se entere de de que ya se despacho el repuesto
					$ID_staSer="4";
					$UpdateRegistroServiciosBySerCod=$registro_servicio->UpdateRegistroServiciosBySerCod($ser_cod, $ID_staSer);

					 $GetRegistroServicioBySerCod=$registro_servicio->GetRegistroServicioBySerCod($ser_cod);
					 $assoc_GetRegistroServicioBySerCod=mysql_fetch_assoc($GetRegistroServicioBySerCod);

		 	}
		 }
		 else
		 {
		 	$ID_sta='14'; 
		 }	
	}
	
	
 $QuotationsDespachoAS = $quotations->QuotationsDespachoAS($ID_pto, $pto_remito, $ID_sta, $pto_fecDespacho);
	echo "<script type='text/javascript'>
window.location.assign('".$back[0]."?m=12');
</script>";
 
//header('Location: '.$back[0].'?m=12');



}


elseif ($action=='Instalacion') 
	{
		
		$pto_fecInstalacion		= 	$fechaYhora;
		
		$pto_mail 				=	$_POST['pto_mail'];
		$pto_pedidoCod			=	$_POST['pto_pedidoCod'];
		$ID_pto					=	$_POST['ID_pto'];
		$ID_tpp					=	$_POST['ID_tpp'];
		$pto_contacto			=	$_POST['pto_contacto'];
		$pto_asignado			=	$_POST['pto_asignado'];
		
		$ID_sta='14'; // Pendiente de Cierre
		
		//trae correro y nombre del pto_asignado o responsable del pedido
		$getUsuariosByIdC 		=	$usuarios->getUsuariosById($pto_asignado);
		$assoc_getUsuariosByIdC =	mysql_fetch_assoc($getUsuariosByIdC);
		$correo 				=	$assoc_getUsuariosByIdC['usu_email'];
		$nombreVendedor 		=	$assoc_getUsuariosByIdC['usu_nombre'];
		$apellidoVendedor		=	$assoc_getUsuariosByIdC['usu_apellido'];
		$pto_asignado			=	$assoc_getUsuariosByIdC['pto_asignado'];

    	$QuotationsInstalacionAS = $quotations->QuotationsInstalacionAS($ID_pto, $ID_sta, $pto_fecInstalacion);
		
		   $getQuotations=$quotations->getQuotations($ID_pto);
	    $assoc_getQuotations=mysql_fetch_assoc($getQuotations);
	    $pto_mail=$assoc_getQuotations['pto_mail'];
	     $pto_OV=$assoc_getQuotations['pto_OV'];
	    //Inicio: separa cadena de mail para poder enviar a todas las direcciones
		$CadenMail=explode(",",$pto_mail);
		$numeroDeMail=count($CadenMail);
		$NuevacadenaDeMails="";
		$contacto=$assoc_getQuotations['pto_contacto'];
	 
// Inicio Modulo Envia maiL
      
			$quotationsMail 					    = 	new quotations;
	    	$getQuotationsMail						= 	$quotationsMail->getQuotations($ID_pto);
	    	$assoc_getQuotationsMail 				= 	mysql_fetch_assoc($getQuotationsMail);
	    	$ID_obrMail 							= 	$assoc_getQuotationsMail['ID_obr'];
			$tiendasMail 							=	new tiendas;
			$getTiendasByIdMail						=	$tiendasMail->getTiendasById($ID_obrMail);
			$assoc_getTiendasByIdMail				= 	mysql_fetch_assoc($getTiendasByIdMail);
			$ClienteTiendaMail 						= 	$assoc_getTiendasByIdMail['cli_desc']. " / " . $assoc_getTiendasByIdMail['obr_desc']; 
		//Inicio: separa cadena de mail para poder enviar a todas las direcciones
					
		$CadenMail=explode(",",$pto_mail);
		$numeroDeMail=count($CadenMail);
		$NuevacadenaDeMails="";
		 
		//Fin: separa cadena de mail para poder enviar a todas las direcciones		

    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =   "Confirmación de Instalación Pedido No ".$pto_pedidoCod." - COSTAN";
    $texto                       =   "<p>Estimado ".$assoc_getQuotations['pto_contacto']."</p><p> Confirmamos que se ha realizado la instalación de los elementos solicitados en el pedido No. <strong>" . $assoc_getQuotations['pto_numero'] . "</strong> . </p> <p> <strong>Orden de Venta: </strong> " . $pto_OV . " </p>";
    $destinatario                =   $correo;
	   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
		{ 
			$mail->AddCC($CadenMail[$CadenaMailCount]);  
		}
		
	  $recipients = array(
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	  );
	  */
    $copiasOcultas  =  $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail
   	echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=12');
  </script>";
  // header('Location: '.$back[0].'?m=12');

}

elseif ($action=='cierreAdministrativo') 
	{
			
		$ID_pto					=	$_POST['ID_pto'];
		
		$ID_sta='8'; //vendido
	
    	$QuotationsCierreAS = $quotations->QuotationsCierreASAdministrativo($ID_pto, $ID_sta);
		
		
	        for($i=0; $i<count($_FILES['adj_ruta']['name']); $i++)
         {
            $tmpFilePath = $_FILES['adj_ruta']['tmp_name'][$i];
           	$shortname = $_FILES['adj_ruta']['name'][$i];
			$generateRandomString   = 	$especiales->generateRandomString();
        	$extension 				= 	end(explode(".", $_FILES['adj_ruta']['name'][$i]));
	   	 	$adj_ruta				= 	"adjuntos/".$generateRandomString."".$i.".".$extension;
	   
            move_uploaded_file($tmpFilePath, $adj_ruta);

            $QuotationsASInsertAdjuntos = $quotations->QuotationsASInsertAdjuntos($ID_usu, $ID_pto, $adj_ruta,$pto_pedidoCod);

    		
         }


   	echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=12');
  </script>";
  // header('Location: '.$back[0].'?m=12');

}

elseif ($action=='cerrar') 
	{
		
		$pto_fecModif		= 	$fechaYhora;
		$pto_cerrado 		=	"1";
		$pto_mail 				=	$_POST['pto_mail'];
		$pto_pedidoCod			=	$_POST['pto_pedidoCod'];
		$ID_pto					=	$_POST['ID_pto'];
		$ID_tpp					=	$_POST['ID_tpp'];
		$pto_contacto			=	$_POST['pto_contacto'];
		$pto_asignado			=	$_POST['pto_asignado'];
		
		$ID_sta='5'; // cerrado
		
		$correo 			=	"pablo.uranga@epta-argentina.com";

    	$QuotationsCierreAS = $quotations->QuotationsCierreAS($ID_pto, $ID_sta, $pto_fecModif, $pto_cerrado);
	// Inicio Modulo Envia maiL
      
    //Trae Modulo para construir el asunto del mensaje
    $PaginaActual                =   explode('/', $_SERVER['REQUEST_URI']);
    $asunto 					 =   "Presupuesto No. ".$pto_pedidoCod." Cerrado";
    $texto                       =   "<p>Estimado </p><p> Informamos que el presupuesto No. ".$pto_pedidoCod." <strong>" . $assoc_getQuotations['pto_numero'] . "</strong> ha sido cerrado. Ingrese al sistema para efectuar el cierre administrativo </p>";
    $destinatario                =   $correo;
	   /*   for ($CadenaMailCount=0; $CadenaMailCount < $numeroDeMail; $CadenaMailCount++) 
		{ 
			$mail->AddCC($CadenMail[$CadenaMailCount]);  
		}
		
	  $recipients = array(
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	   'joel.schiavone@epta-argentina@gmail.com' => 'Joel Trabajo',
	  );
	  */
    $copiasOcultas  =  $correoEmisor;
    include('../inc/envio_mail.php');
// Fin Modulo Envia mail

   	echo "<script type='text/javascript'>
  window.location.assign('".$back[0]."?m=12');
  </script>";
  // header('Location: '.$back[0].'?m=12');

}


	elseif ($action=='delete') 
	{
		$ID_pto 				= $_POST['ID_pto'];	
		
		$ID_sta 				= 	'41'; //Status Eliminado

		$QuotationsCierreASAdministrativo		=	$quotations->QuotationsCierreASAdministrativo($ID_pto, $ID_sta);
				echo "<script type='text/javascript'>
 						 window.location.assign('".$back[0]."?m=11');
					  </script>";
					  //header('Location: '.$back[0].'?m=11');
	} 






?>


	

	  