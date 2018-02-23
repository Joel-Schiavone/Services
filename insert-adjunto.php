<?php
	 require_once('inc/required.php');

	 $adjuntos     			= new adjuntos();
	 $especiales            = new especiales();
  	 $generateRandomString  = $especiales->generateRandomString();

	 $ID_usu				= $_POST['ID_usu'];
	 $adj_idRelacion		= $_POST['adj_idRelacion'];
	 $adj_tablaRelacion		= $_POST['adj_tablaRelacion'];
	 $adj_fecha				= $_POST['adj_fecha'];
	 $adj_desc				= $_POST['adj_desc'];

	 $archivo 				= $_FILES['adj_ruta']['tmp_name'];
	 $name_adj_ruta			= $_FILES['adj_ruta']['name'];
	 $tipo_archivo			= $_FILES['adj_ruta']['type']; 
	 $extension 			= end(explode(".", $_FILES['adj_ruta']['name']));
	 $adj_ruta				= "adjuntos/".$generateRandomString.".".$extension;
	 $ID_obr 				= $_SESSION['ID_obr'];
	
     move_uploaded_file($archivo, $adj_ruta);
			
	 $insertAdjuntos 		= $adjuntos -> insertAdjuntos($ID_usu, $adj_idRelacion, $adj_tablaRelacion, $adj_ruta, $adj_desc, $adj_fecha);

	 $url 		 			= $_SESSION['url3'] ;
	 $urlCortada  			= explode("?",$url);

	 if ($urlCortada[0]=='/newCrm/autocomplete-table-equipos.php') 
			{
	 			header('Location: equipment.php?m=2&ID_obr='.base64_encode((12344*($ID_obr))/12).'');
	 		}
	 		else 
	 		{
	 			header('Location: '.$_SESSION['adjuntos'].'&m=4');
	 		}	
?>