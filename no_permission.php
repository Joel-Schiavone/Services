<?php 
$url_name="Restringido";
	require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
require_once('inc/header.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sin Permisos</title>
	<style type="text/css">
		#sinPermiso
		{
			width: 100%;
			background-color: #222;
			border-left: 8px solid #f00;
			font-size: 200%;
			text-align: center;
			opacity: 0.8;
			position: absolute;
			top: 5%;
			padding-top: 2%;
			padding-left: 2%;
			padding-right: 2%;
			color: #fff;
			margin: 5%;
			width: auto;
		}
		#boton
		{border-radius: 50px 50px 0px 0px;
-moz-border-radius: 50px 50px 0px 0px;
-webkit-border-radius: 50px 50px 0px 0px;
			border: 0px solid #000000;
			background-color: #090;
			font-family: impact;
			width: 100%;
			font-size: 60%;
			cursor: pointer;
			color: #fff;
		}
		#boton:hover
		{
			border: 1px solid #fff;
			background-color: #0f0;
		}
		
             #izquierda 
             {
             	float: left;
             	 text-align: center;
             	    width: 25%;
             }
             #imagen
            	{
            		display: block;
            	}


            	@media (max-width: 900px) {
 .cargaexterna{
   float: none;
   width: 100%;
  }
   .filtros{
    float: none;
    width: 100%;
  }
}






          /*  @media (max-width: 400px) 
            {
            	#izquierda
            	{
            		display: none;
            	}
            	#imagen
            	{
            		display: none;
            	}
            }
            	 video
            {
            	position: fixed;
             	min-height: 100%;
             	min-width: 100%;
            	z-index: -1;
            	top: 0%;
                margin: 0;
            }*/
	</style>
</head>
<body>


<!-- FONDO CENSURADO POR PATRICIO 
<video src="../images/FondosVideos/sinPermiso/sinPermiso.mp4" autoplay loop muted poster="../images/poster.gif"></video>-->

	<div id='sinPermiso'>
		<div id='izquierda'>
			<img id='imagen' src='../images/stop.png'>
		</div>	
		<div id='derecha' style="float: right; width: 70%; padding-top: 5%;">
			Usted no tiene permisos para acceder a la página requerida !
			<br>
			<p style="font-size: 80%;">Comuníquese con el administrador</p>
			
		</div>	
		<div id='derecha' style="width: 100%;">
		<p style="margin-bottom: -3px;">
				<a href="index.php" style="text-orientation: none; color: #fff; ">
					<button id='boton'>
						Salir
					</button>
				</a>
			</p>
		</div>	
	</div>
</body>
</html>

