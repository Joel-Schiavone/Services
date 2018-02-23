<?php
require_once('../inc/conectar.php');
require_once('../modules/classes.php');

$ID_sta=33;
$quotations = new quotations;
$getQuotationsInserted=$quotations->getQuotationsByIdSta($ID_sta);
$num_getQuotationsInserted = mysql_num_rows($getQuotationsInserted);

$getQuotationsInsertedB=$quotations->getQuotationsByIdSta($ID_sta);
$num_getQuotationsInsertedB = mysql_num_rows($getQuotationsInsertedB);

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cubes Advent Calendar | Demo 2 | Codrops</title>
		<meta name="description" content="An Advent calendar made of 3D cubes with different styles and effects." />
		<meta name="keywords" content="advent calendar, web, html template, 3d, cubes, css, javascript, anime.js" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Droid+Sans+Mono" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/common.css" />
		<link rel="stylesheet" type="text/css" href="css/style2.css" />
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]--><script>document.documentElement.className = 'js';</script>
	</head>
	<body>
		<svg class="hidden">
			<defs>
				<symbol id="icon-arrow" viewBox="0 0 24 24">
					<title>arrow</title>
					<polygon points="6.3,12.8 20.9,12.8 20.9,11.2 6.3,11.2 10.2,7.2 9,6 3.1,12 9,18 10.2,16.8 "/>
				</symbol>
				<symbol id="icon-drop" viewBox="0 0 24 24">
					<title>drop</title>
					<path d="M12,21c-3.6,0-6.6-3-6.6-6.6C5.4,11,10.8,4,11.4,3.2C11.6,3.1,11.8,3,12,3s0.4,0.1,0.6,0.3c0.6,0.8,6.1,7.8,6.1,11.2C18.6,18.1,15.6,21,12,21zM12,4.8c-1.8,2.4-5.2,7.4-5.2,9.6c0,2.9,2.3,5.2,5.2,5.2s5.2-2.3,5.2-5.2C17.2,12.2,13.8,7.3,12,4.8z"/><path d="M12,18.2c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7c1.3,0,2.4-1.1,2.4-2.4c0-0.4,0.3-0.7,0.7-0.7c0.4,0,0.7,0.3,0.7,0.7C15.8,16.5,14.1,18.2,12,18.2z"/>
				</symbol>
				<symbol id="icon-github" viewBox="0 0 32.58 31.77">
					<title>github</title>
					<path d="M16.29,0a16.29,16.29,0,0,0-5.15,31.75c.81.15,1.11-.35,1.11-.79s0-1.41,0-2.77C7.7,29.18,6.74,26,6.74,26a4.31,4.31,0,0,0-1.81-2.38c-1.48-1,.11-1,.11-1a3.42,3.42,0,0,1,2.5,1.68,3.47,3.47,0,0,0,4.74,1.35,3.48,3.48,0,0,1,1-2.18C9.7,23.08,5.9,21.68,5.9,15.44a6.3,6.3,0,0,1,1.68-4.37,5.86,5.86,0,0,1,.16-4.31s1.37-.44,4.48,1.67a15.44,15.44,0,0,1,8.16,0c3.11-2.11,4.48-1.67,4.48-1.67A5.85,5.85,0,0,1,25,11.07a6.29,6.29,0,0,1,1.67,4.37c0,6.26-3.81,7.63-7.44,8a3.89,3.89,0,0,1,1.11,3c0,2.18,0,3.93,0,4.47s.29.94,1.12.78A16.29,16.29,0,0,0,16.29,0Z"/>
				</symbol>
			</defs>
		</svg>
		<main>
		
			<div class="calendar-wrap">
				<div class="calendar">
					<?php 
						for ($i=0; $i <$num_getQuotationsInserted ; $i++)
						 { 
							$asoc_getQuotationsInserted = mysql_fetch_assoc($getQuotationsInserted);
							
							echo '<div class="cube"  data-bg-color="#6161616" data-title="Presupuesto:'.$asoc_getQuotationsInserted['pto_pedidoCod'].'"></div>';

						 }
					 ?>
				
				</div>
				<div class="content">

					<?php 
						for ($A=0; $A <$num_getQuotationsInsertedB ; $A++)
						 { 
							$assoc_getQuotationsInsertedB = mysql_fetch_assoc($getQuotationsInsertedB);
							
							echo '<div class="content__block">
									<h3 class="content__title">"'.$assoc_getQuotationsInsertedB['pto_pedidoCod'].'"</h3>
									<p class="content__description">"Presupuestado:'.$assoc_getQuotationsInsertedB['pto_fecPresupuestado'].'"</p>
									<p class="content__meta">"Presupuesto:'.$assoc_getQuotationsInsertedB['pto_pedidoCod'].'"</p>
								 </div>';
						
						 }
					 ?>

					
			
					<div class="content__number">0</div>
					<button class="btn-back" aria-label="Back to the grid view">&crarr;</button>
				</div><!-- /content -->
			</div>
		</main>
		<script src="js/charming.min.js"></script>
		<script src="js/anime.min.js"></script>
		<script src="js/textfx.js"></script>
		<script src="js/main2.js"></script>
	</body>
</html>
