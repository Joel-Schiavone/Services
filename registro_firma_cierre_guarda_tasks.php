<?php

require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
require_once('modules/operaciones.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php 
	echo $ID_tas=$_POST['ID_tas'];
  echo "</br>";
  $baseFromJavascript=$_POST['firma'];
   echo "<br>";
   $base_to_php = explode(',', $baseFromJavascript);
    echo "<br>";
    echo $data = base64_decode($base_to_php[1]);
	$filepath = "images/firmas/".$ID_tas.".png"; 
	 $ser_firma=file_put_contents($filepath, $data);

        echo $baseFromJavascript=$_POST['firma'];
                echo "<br>";
               	$base_to_php = explode(',', $baseFromJavascript);
                echo "<br>";
                echo $data = base64_decode($base_to_php[1]);

$imagen="images/firmas/".$ID_tas.".png";

$tasks = new tasks;
$insert_registro_servicio = $tasks->insert_registro_servicio_tas($ID_tas, $imagen);


 header('Location: dashboard-services-user.php?m=2'); 
?>

</body>
</html>