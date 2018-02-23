<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
$ID_cli= $_POST["elegido"];
$ID_usu = $_SESSION['ID_usu'];
  $registro_servicio = new registro_servicio;
                $getRegistroServiciosHistorialNETiendas = $registro_servicio-> getRegistroServiciosHistorialNETiendasUser($ID_cli, $ID_usu);
                $num_getRegistroServiciosHistorialNETiendas = mysql_num_rows($getRegistroServiciosHistorialNETiendas);
                for ($tiendai=0; $tiendai < $num_getRegistroServiciosHistorialNETiendas; $tiendai++)
                 { 
                    $assoc_getRegistroServiciosHistorialNETiendas = mysql_fetch_assoc($getRegistroServiciosHistorialNETiendas);
                    echo "<option value='".$assoc_getRegistroServiciosHistorialNETiendas['ID_obr']."'>".$assoc_getRegistroServiciosHistorialNETiendas['obr_desc']."</option>";
                 }
            

require_once('inc/footer.php');
?> 
