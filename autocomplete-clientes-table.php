<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
error_reporting(0);
$ID_emp = $_SESSION['ID_emp'];
header( 'Content-type: text/html; charset=iso-8859-1' );
require('config.php');
$search = $_POST['icon_prefixB'];
$query_obras = mysql_query("SELECT * FROM obras, clientes WHERE clientes.ID_cli=obras.ID_cli AND (obr_desc like '%" . $search . "%' OR cli_desc like '%" . $search . "%') GROUP BY cli_desc ORDER BY cli_desc ASC ");
while ($row_obras = mysql_fetch_array($query_obras)) {
    echo '<div class="suggest-elementB" id="suggest-elementB"><a href="table-store.php?idB='.base64_encode((12344*($row_obras['ID_cli']))/12).'&datoB='.$row_obras['cli_desc'].'&logo='.$row_obras['cli_marker'].'" dataB="'.$row_obras['cli_desc'].'" id="icon_prefixxB" value='.$row_obras[''].'><img src="'.$row_obras['cli_marker'].'">'.utf8_encode($row_obras['cli_desc']).'</a></div><hr>';
}
?>

