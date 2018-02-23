<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
$ID_cli= $_POST["elegido"];

  $quotations = new quotations;
                $getQuotationsTiendas = $quotations->getQuotationsTiendasByIdCli($ID_cli);
                $num_getQuotationsTiendas = mysql_num_rows($getQuotationsTiendas);
                echo "<option selected='' disabled=''>TIENDAS:</option>";
                for ($tiendai=0; $tiendai < $num_getQuotationsTiendas; $tiendai++)
                 { 
                    $assoc_getQuotationsTiendas = mysql_fetch_assoc($getQuotationsTiendas);

                    echo "<option value='".$assoc_getQuotationsTiendas['ID_obr']."'>".$assoc_getQuotationsTiendas['obr_desc']."</option>";
                 }
            

require_once('inc/footer.php');
?> 
