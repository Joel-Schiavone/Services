
<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
$ID_emp = $_SESSION['ID_emp'];
header( 'Content-type: text/html; charset=iso-8859-1' );
require('config.php');
$search = $_POST['icon_prefix'];
@$redireccion = $_POST['redireccion'];
$num_search = strlen($search);
if ($num_search>=2)
{



	$query_obras = mysql_query("SELECT * FROM obras, clientes WHERE clientes.ID_cli=obras.ID_cli AND (obr_desc like '%" . $search . "%' OR cli_desc like '%" . $search . "%')  AND obras.ID_obr<>obras.ID_cli ORDER BY cli_desc ASC");
	while ($row_obras = mysql_fetch_array($query_obras))
	 {
	 	/*echo "fecha inicio: " . */ $row_obras['obr_fecinreal'];
	 	/*echo "<br>";*/
	 	/*echo "fecha fin: " . */ $row_obras['obr_fecfinreal'];
	 	$fechaFin=$row_obras['obr_fecfinreal'];
	 	/*echo "<br>"; */
	 	//Suma 1 año a la fecha
		$fecha =  $row_obras['obr_fecfinreal'];
		$nuevafecha = strtotime ( '+1 year' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	 	/*echo "fecha suamda un año: " .*/$nuevafecha;
	 	/*echo "<br>";*/
	 	/*echo "fecha actual: " .*/$fechaActual=date("Y-m-d");
	 	/*echo "<br>";*/
	 	if ($fechaActual>=$fechaFin and $fechaActual<=$nuevafecha)
	 	 {
	 		$garantia="../images/garantia.png";
	 	 }
	 	else 
	 	 {
	 		$garantia="../images/nogarantia.png";
	 	 }
	 	
	 	if(!$row_obras['cli_marker'])
	 	{
	 		$logo='../images/markers/otros.png';
	 	}
	 	else
	 	{
	 		$logo=$row_obras['cli_marker'];
	 	}




   		echo "<div class='suggest-element' id='suggest-element' style='text-align:left'>
   				<a href='".$redireccion."?id=".base64_encode((12344*($row_obras['ID_obr']))/12)."&dato=".$row_obras['obr_desc']."&logo=".$row_obras['cli_marker']."&idB=".base64_encode((12344*($row_obras['ID_cli']))/12)."&datoB=".$row_obras['obr_desc']."'>
        			<button type='button' class='btn btn-success' style='height: auto; width: 95%; margin-top: 30px; text-align:left;'>
        				<img src='".$logo."'>	
        					".$row_obras['cli_desc']." / ".utf8_encode($row_obras['obr_desc'])."  / <img src='".$garantia."' style='width:50px; float: right;'>
        			</button>
        		</a>
        	</div>";
 	}  
    
}
?>

