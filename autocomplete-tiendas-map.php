<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
$ID_emp = $_SESSION['ID_emp'];
header( 'Content-type: text/html; charset=iso-8859-1' );
require('config.php');
$search = $_POST['icon_prefix'];
$num_search = strlen($search);
if ($num_search>=2)
{
$query_obras = mysql_query("SELECT * FROM obras, clientes WHERE clientes.ID_cli=obras.ID_cli AND (obr_desc like '%" . $search . "%' OR cli_desc like '%" . $search . "%') ORDER BY obr_desc ASC ");
while ($row_obras = mysql_fetch_array($query_obras)) {
    echo '<div class="suggest-element" id="suggest-element">
    		<a href="customer-map.php?id='.base64_encode((12344*($row_obras['ID_obr']))/12).'&dato='.$row_obras['obr_desc'].'&logo='.$row_obras['cli_marker'].'" data="'.$row_obras['obr_desc'].'" id="icon_prefixx" value='.$row_obras['obr_desc'].'>
    			<img src="'.$row_obras['cli_marker'].'">
    				 '.utf8_encode($row_obras['cli_desc']).' '.utf8_encode($row_obras['obr_desc']).'
    		</a>
    	 </div>
    	 <hr>';
}
}
?>

