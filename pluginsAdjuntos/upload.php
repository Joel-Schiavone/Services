<?php 


	 $adjuntos     			= new adjuntos();
	 $especiales            = new especiales();
  	 $generateRandomString  = $especiales->generateRandomString();

  	 $adj_idRelacion		= 402;
	 $adj_tablaRelacion		= "quotations";
	 $adj_fecha				= date("Y-m-d")." ".date("h:i:s");
	 $ID_usu				= 1742;


$carpetaAdjunta="adjuntos/";
// Contar envían por el plugin
$Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
$infoImagenesSubidas = array();
for($i = 0; $i < $Imagenes; $i++) {

	// El nombre y nombre temporal del archivo que vamos para adjuntar
	$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
	$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;
		
 	$extension 		= 	end(explode(".", $_FILES['imagenes']['name'][$i]));
	$adj_desc 		=	$nombreArchivo;
	$rutaArchivo 	=	$generateRandomString.".".$extension;
	$adj_ruta		=	"adjuntos/".$rutaArchivo;
	move_uploaded_file($nombreTemporal,"$carpetaAdjunta"."$rutaArchivo");
	
	$infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>"borrar.php","key"=>$rutaArchivo);
	$ImagenesSubidas[$i]="<img  height='120px'  src='$adj_ruta' class='file-preview-image'>";
	$insertAdjuntos 	= $adjuntos -> insertAdjuntos($ID_usu, $adj_idRelacion, $adj_tablaRelacion, $adj_ruta, $adj_desc, $adj_fecha);

	}

$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
			 "initialPreview"=>$ImagenesSubidas);
echo json_encode($arr);
?>


