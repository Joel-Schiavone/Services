<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
require_once('modules/operaciones.php');
$retorno         = explode('?', $_SESSION['actionsBack']);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php 
	echo $ID_ser=$_POST['ID_ser'];
  $baseFromJavascript=$_POST['firma'];
   echo "<br>";
   $base_to_php = explode(',', $baseFromJavascript);
    echo "<br>";
    echo $data = base64_decode($base_to_php[1]);
	$filepath = "images/firmas/".$ID_ser.".png"; 
	 $ser_firma=file_put_contents($filepath, $data);

        echo $baseFromJavascript=$_POST['firma'];
                echo "<br>";
               	$base_to_php = explode(',', $baseFromJavascript);
                echo "<br>";
                echo $data = base64_decode($base_to_php[1]);

$imagen="images/firmas/".$ID_ser.".png";

$registro_servicio = new registro_servicio;

$insert_registro_servicio = $registro_servicio->insert_registro_servicio($ID_ser, $imagen);


 header('Location: '.$retorno[0].'?m=2'); 
?>

</body>
</html>