<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>::: SERVICES - <?php echo $url_name ?> :::</title>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="images/logo-epta.png">
	<link rel="stylesheet" href="../css/materialize.css" type="text/css"/>
	<link rel="stylesheet" href="css/component.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/demo.css">
	<link href="../css/font-awesome.css" rel="stylesheet">
	<link href="../css/motion-ui.min.css" rel="stylesheet"  />
	<link href="css/material-icons.css" rel="stylesheet">	
	<script src="../dist/Chart.js"></script>
	<script src="../js/jquery.js"></script>
	<script src="../js/conditionize.jquery.js"></script>
    <script type="text/javascript" src="inc/fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="inc/fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/modernizr.custom.js"></script>



<!--
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({
  selector: 'textarea',
  height: 100,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });</script>
 -->
<?php
	@$ID_for				=	12*((base64_decode(@$_GET['id']))/12344);
	$formularios		=	new formularios();
	$getFormulariosById	=	$formularios->getFormulariosById($ID_for);
	$for				=	mysql_fetch_assoc($getFormulariosById);

	if($for['for_muestra'] == 1){
		$checked	=	'checked="checked"';
	} else {
		$checked	=	'';
	}

	
?>


	 <!-- Inicio: DataTable-->
					<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
					<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<!--reloj de esquinero-->
<script language="JavaScript"> 
function mueveReloj(){ 
   	momentoActual = new Date() 
   	hora = momentoActual.getHours() 
   	minuto = momentoActual.getMinutes() 
   	segundo = momentoActual.getSeconds() 

   	horaImprimible = hora + " : " + minuto + " : " + segundo 

   	document.form_reloj.reloj.value = horaImprimible 

   	setTimeout("mueveReloj()",1000) 
} 
</script> 

<!--<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">-->
    
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<link rel="stylesheet" href="../css/bootstrap.css" crossorigin="anonymous">
<link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<script src="../js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<style type="text/css">


    body
  {
    background-color:#fff;
    font-family: Dosis, sans-serif;
  }

  #Esquinero
  {

  	border-radius: 200px 0px 0px 0px;
	-moz-border-radius: 200px 0px 0px 0px;
	-webkit-border-radius: 200px 0px 0px 0px;
	border-top: 3px solid #fff;
	background-color: #333;
	color: #fff;
	width: 400px;
	height: 90px;
	position: fixed;
	bottom: 0px;
	right: 0px;
	padding-top:10px;
	z-index: 2000;
	opacity: 0.8;
  }	

		#Esquineroizquierda
		{
		float: left;
		width: 250px;
		margin-top: 10px;
		height: 50%;
		margin-left: 70px;
		}

			#EsquineroDerIzquierda
			{
			float: left;
			width: 125px;
			}

			#EsquineroDerDerecha
			{
			float: right;
			width: 125px;
			}

		#Esquineroderecha
		{
			float: right;
			width: 100px;
			height: 400px;
		}
   #cargando
    {
      position:absolute;
      width:100%;
      height:100%;
      background:#E2E2E2 url(images/cargando3.gif) no-repeat center;
      z-index: 150;
    }    

</style>
<body onload="mueveReloj()">
<?php
if(@$_SESSION['estado'] == 'conectado'){
	require_once('inc/menu.php');
}
?>

<div class="modal fade" id="cambioUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cambiar usuario</h4>
                  </div>
                  <div class="modal-body">
                  	<?php 
                   		$usuarios = new usuarios;
                   		$getUsuarios=$usuarios->getUsuarios();
                   		$num_getUsuarios=mysql_num_rows($getUsuarios);
                   		for ($usu=0; $usu < $num_getUsuarios; $usu++)
                   		 { 
                   			$assoc_getUsuarios=mysql_fetch_assoc($getUsuarios);
                   			$empresaB=$assoc_getUsuarios['ID_emp'];

                   			if($empresaB==1 or $empresaB==5)
								{
									$banderaB="arg.png";
								}
								if($empresaB==6)
								{
									$banderaB="chi.png";
								}
								if($empresaB==7)
								{
									$banderaB="pas.png";
								}	

								echo "<img src='../../images/banderas/".$banderaB."' style='width: 30px; height: auto; vertical-align: middle; margin-bottom: 4px; margin-right:10px;'>";
                   			echo "<a href='cambioUsuario.php?username=".$assoc_getUsuarios['usu_username']."&password=".$assoc_getUsuarios['usu_password']."&empCod=".$assoc_getUsuarios['emp_cod']."'";
                   			echo "<h5 style='width:70%;'>";
                   			echo $assoc_getUsuarios['usu_nombre'];
                   			echo " ";
                   			echo $assoc_getUsuarios['usu_apellido'];
                   			echo "</h5>";
                   			echo "  ";
                   			
                   			
                   				echo "<h7 style='float:right; width:20%; font-size: 10px;'>";
                   				echo "<i class='material-icons' style='vertical-align: middle;'>work</i> " . $assoc_getUsuarios['tpu_desc'];
							echo "</h7>";
                   			
							echo "  ";
							
                   			echo "<h7 style='float:right; width:20%; font-size: 10px;'>";
                   				$ID_gcm=$assoc_getUsuarios['ID_gcm'];
                   				$gerencias_comerciales= new gerencias_comerciales;
                   				$getGerencias_comercialesBYId=$gerencias_comerciales->getGerencias_comercialesBYId($ID_gcm);
                   				$assoc_getGerencias_comercialesBYId=mysql_fetch_assoc($getGerencias_comercialesBYId);
                   				if ($assoc_getGerencias_comercialesBYId['gcm_desc']!="") {

							echo "<i class='material-icons' style='vertical-align: middle;'>store</i> " . $assoc_getGerencias_comercialesBYId['gcm_desc'];
							}
							
							echo "</h7>";

                   			echo "</a>";
                   			echo "<hr>";
                   		 }

                   	?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">assignment_turned_in</i> Cambiar</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          </div>






<!--Start of Tawk.to Script-->

<div id='Esquinero'>

	<div id='Esquineroizquierda'>
	<div id='EsquineroDerIzquierda'>
				
				<?php
					
					if ($_SESSION['ID_usu']==1742 or $_SESSION['ID_usu']==1) 
					{
						echo "<td data-toggle='modal' data-target='#cambioUsuario'>";
						
								$empresa=$_SESSION['ID_emp'];
								if($empresa==1 or $empresa==5)
								{
									$bandera="arg.png";
								}
								if($empresa==6)
								{
									$bandera="chi.png";
								}
								if($empresa==7)
								{
									$bandera="pas.png";
								}	

								echo "<img src='../../images/banderas/".$bandera."' style='width: 15px; height: auto; vertical-align: middle; margin-bottom: 4px;'>";
								echo " ";
								echo $_SESSION['nombre'];
								echo " ";
								echo$_SESSION['apellido'];

					} 		
					else
					 {
					
								$empresa=$_SESSION['ID_emp'];
								if($empresa==1 or $empresa==5)
								{
									$bandera="arg.png";
								}
								if($empresa==6)
								{
									$bandera="chi.png";
								}
								if($empresa==7)
								{
									$bandera="pas.png";
								}	

								echo "<img src='../../images/banderas/".$bandera."' style='width: 15px; height: auto; vertical-align: middle; margin-bottom: 4px;'>";
								echo " ";
								echo $_SESSION['nombre'];
								echo " ";
								echo$_SESSION['apellido'];
					
					}	
				
				?>			
			<br><br>
				
					<i class="material-icons" style="font-size: 15px; vertical-align: middle; margin-bottom: 4px;">work</i> 
					<?php
						$url 						   = $_SERVER['REQUEST_URI'];	
						$tal						   = explode("/",$url);   
	  					echo $tal[1];      
  					?>
				</div>				
				<div id='EsquineroDerDerecha'>
			
				<i class="material-icons" style="font-size: 15px; vertical-align: middle; margin-bottom: 4px;">today</i>
					<?php 
						echo $fecha=date("d-m-Y");
					?>
			
					<br><br>
					<form name="form_reloj"> 
					<i class="material-icons" style="font-size: 15px; vertical-align: middle; margin-bottom: 4px;">watch_later</i>
					<input type="text" name="reloj" size="8" style="background-color: #333; color: #fff; border: none;"> 
					</form> 

			</div>
	</div>
	<div id='Esquineroderecha'>
	
<!--Start of Tawk.to Script
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5804ca682d3b340651718602/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
End of Tawk.to Script-->



	<?php 
	if ($ID_usu==1742 or $ID_usu==1)
	{
		//echo "<a href='https://dashboard.tawk.to/' target='_blank' style='position: fixed; bottom: 14px; '><i class='material-icons' style='font-size: 15px; vertical-align: middle; margin-left: -270px;'>vpn_key</i> </a>";

	echo "<a data-toggle='modal' data-target='#cambioUsuario' style='position: fixed; bottom: 40px; cursor:pointer;'><i class='material-icons' style='font-size: 15px; vertical-align: middle; margin-left: -270px;'>accessibility</i> </a>";
	}
	?>
		

	</div>	



</div>
<!--End of Tawk.to Script-->


<script type="text/javascript">
var altura = $(document).height();
 
$(window).scroll(function(){
      if($(window).scrollTop() >= 5) {
            $("#Esquinero").fadeOut(500);
      }
      if($(window).scrollTop() <= 5) {
            $("#Esquinero").fadeIn(500);
      }
                
});

      $("#Esquinero").click(function(){
      	 $("#Esquinero").fadeOut(500);
      });

</script>
