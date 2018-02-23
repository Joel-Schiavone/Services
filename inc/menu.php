<ul id="gn-menu" class="gn-menu-main" style="position: fixed; z-index: 1000; background-color: #00449e; ">
	<li class="gn-trigger">
		<a class="gn-icon-menu"><i class="material-icons" style="font-size:36px;padding: 10px; color: #fff">menu</i></a>
			<nav class="gn-menu-wrapper" style="z-index:99">
			<div class="gn-scroller">
				<ul class="gn-menu">
                <li style="background-color:#00449e; color:#fff;  opacity:0.7;"><a class="gn-icon gn-icon-home" href="index.php" style="color:#fff;">Inicio</a></li>
                </ul>
				<ul class="gn-menu" style="margin-bottom: 100px;">
<?php
	$formularios 					   = new formularios;
	$for_desc 						   = $_SERVER['REQUEST_URI'];	 
	$ID_usu 						     = $_SESSION['ID_usu'];
	$tal							       = explode("/",$for_desc);       //TRAE URL Y CORTA LA CADENA EN LA / 
  $talB                     = $tal[2];                    //GUARDA LA SEGUNDA PARTE DE LA CADENA LUEGO DE / EN TALB
  $talC                    = explode("?",$talB);         //CORTA LA CADENA GUARDA EN TALB EN EL SIGNO ?
	$getFormulariosByDesc    = $formularios->getFormulariosByDesc($talC[0]); //EJECUTA LA FUNCION QUE TRAE LOS FORMULARIOS CON QUE TENGAN TALC EN SU FOR_DESC



	$menu				=	new menu();
	$modulosBySistema	=	$menu->getModulosBySistema('SVS', $_SESSION['ID_usu']);
	for($i=0; $i<$menu->modBySisRows; $i++){
		$modulos				=	mysql_fetch_assoc($modulosBySistema);
		$ID_mod					=	$modulos['ID_mod'];
		$formulariosByModulos	=	$menu->getFormulariosByModulos($ID_mod);
		$submodulosByModulos	=	$menu->getSubmodulosByModulos($ID_mod);
		echo '<li style="color:#fff"><a href="#" ' . $modulos['mod_icon'] . '>' . $modulos['mod_nom_muestra'] . '</a>';
		echo '<ul class="gn-submenu" >';
		for($a=0; $a<$menu->subByModRows; $a++){
			$submodulos					=	mysql_fetch_assoc($submodulosByModulos);
			$ID_sub						=	$submodulos['ID_sub'];
			$formulariosBySubmodulos	=	$menu->getFormulariosBySubmodulos($ID_sub);
			echo '<li>' . $submodulos['sub_desc'] . '</a>';
			echo '<ul class="gn-icon gn-icon-cog">';
			for($c=0; $c<$menu->forBySubRows; $c++){
				$form_submod	=	mysql_fetch_assoc($formulariosBySubmodulos);
				echo '<li><a href="' . $form_submod['for_desc'] . '">' . $form_submod['for_nombre'] . '</a>';
			}
			echo '</ul>';
		}
		for($b=0; $b<$menu->forByModRows; $b++){
			$for_mod		=	mysql_fetch_assoc($formulariosByModulos);
			echo ' <li> <a href="' . $for_mod['for_desc'] . '" ' . $for_mod['for_icon'] . ' style="margin-left: 20px">' . $for_mod['for_nombre'] . '</a></li>';
		}
		echo '</ul>';
	}
	echo '</li>';
?>
				</ul>
			</div><!-- /gn-scroller -->
		</nav>
	</li>
	
	<li style="vertical-align: middle;"><img src="../images/LogosSistemas/services.png" height="50px" style="padding-top: 10px"></li>





	<li style="vertical-align: middle;  text-overflow:ellipsis;
  white-space:nowrap; width:30%;  overflow:hidden; text-align: left; "><h4 style="padding: 10px; color: #fff;"><?php echo $url_name ?></h4></li>




		

	<li style="vertical-align: middle; float:right">
		<a class="codrops-icon" href="../logout.php">
			<i class="material-icons" style="font-size:36px;vertical-align:middle;padding: 10px; color: #fff;">
				power_settings_new
			</i>
		</a>
	</li>


  <li style="vertical-align: middle; float:right; color: #fff;">
    <a class="codrops-icon" href="../" >
      <i class="material-icons" style="font-size:36px;vertical-align:middle;padding: 10px; color: #fff;">
        home
      </i>
    </a>
  </li>

<li style="vertical-align: middle; float:right">
				<i data-target='#ayudaUsu' data-toggle='modal' class="material-icons" alt='Soporte' title='Soporte' data-placement='top' style="font-size:36px;vertical-align:middle;padding: 10px;cursor: pointer; color: #fff;">
					help
				</i>
		</li>

</ul>
<ul id="gn-menu" class="gn-menu-main" style="position: relative; z-index: 0; height: 60px; ">

</ul>
<script src="../js/classie.js"></script>
<script src="../js/gnmenu.js"></script>
<script>
	new gnMenu( document.getElementById( 'gn-menu' ) );
	$(function () {
  $('[data-toggle="modal"]').tooltip()
})
</script>



<!-- Inicio Soporte para el usuario -->

<?php

$assoc_getFormulariosByDesc = mysql_fetch_assoc($getFormulariosByDesc);
 echo "<div class='modal fade' id='ayudaUsu' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                        <div class='modal-dialog' role='document'>
                                           <div class='modal-content'>
                                               <div class='modal-header'>
                                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                   <h4 class='modal-title' id='myModalLabel'>Documentación soporte de ".$assoc_getFormulariosByDesc['for_nom_muestra']." para el usuario</h4>
                                                </div>
                                              <div class='modal-body' align='center'>";
												
                                           
                                              			if ($assoc_getFormulariosByDesc['for_ayudaUsu']=="") 
                                              			{
                                              				echo "<i class='material-icons' style='font-size: 100px;'>sentiment_very_dissatisfied</i>";
                                              				echo "<br>";
                                              				echo "<p style='text-align: center'> Esta pagina no cuenta con documentación de soporte para el usuario, igualmente puede contactar a los administradores mediante el chat ubicado en la parte inferior izquierda de su pantalla.</p>";
                                              				echo "<br>";
                                              				echo "<p style='text-align: left;'><u>Contacto de autores:</u> </p>";
                                              				echo "<ul  style='text-align: left'>";
                                              				echo "<li>schiavone.joel@gmail.com</li>";
                                              				echo "<li>Patricio.pena@epta-argentina.com</li>";
                                              				echo "</ul>";
                                              				echo "<br>";
                                              				echo "<p style='float: right;'>Disculpe las molestias...</p>";
                                              				echo "<br>";
                                              			}
                                              			else
                                              			{
                                              				echo "<p>".$assoc_getFormulariosByDesc['for_ayudaUsu']."</p>";
                                              			}

                                              			

                                                   echo "</div>
                                                <div class='modal-footer'>";
  													                        echo "<i data-target='#ayudaDes' data-toggle='modal' class='material-icons' style='font-size:36px;vertical-align:middle;cursor:pointer;float:left;'>
															                           	code
															                           </i>  ";
                           
                                                if ($ID_usu==1742 or $ID_usu==1)
                                                 {

                                                	echo "<a target='_blank' href='../manager/formularios_modifica.php?id=".base64_encode((12344*($assoc_getFormulariosByDesc['ID_for']))/12)."'><i class='material-icons'  style='font-size:36px;vertical-align:middle;cursor: pointer;float:left;'>flight_takeoff</i></a>";
                                                 }

                                             
                                                  echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                                                 
                                               </div>  
                                               </div>
                                            </div> 
                                        </div>
                                    </div>";

    echo "</div>";

     
?>
<!-- Fin Soporte para el usuario -->


<!-- Inicio Soporte para el Desarrollador-->

<?php

 echo "<div class='modal fade' id='ayudaDes' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                        <div class='modal-dialog' role='document'>
                                           <div class='modal-content'>
                                               <div class='modal-header'>
                                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                   <h4 class='modal-title' id='myModalLabel'>Documentación soporte de ".$assoc_getFormulariosByDesc['for_nom_muestra']." para desarrolladores</h4>
                                                </div>
                                              <div class='modal-body'>";

                                                	
                                                	

                                              			if ($assoc_getFormulariosByDesc['for_ayudaDes']=="") 
                                              			{	
                                              				echo "<div  align='center'><i class='material-icons' style='font-size: 100px;'>sentiment_very_dissatisfied</i>";
                                              				echo "<br>";
                                              				echo "<p style='text-align: center'> Esta pagina no cuenta con documentación para desarrolladores</p>";
                                              				echo "<br>";
                                              				echo "<p style='text-align: left;'><u>Contacto de autores:</u> </p>";
                                              				echo "<ul  style='text-align: left'>";
                                              				echo "<li>schiavone.joel@gmail.com</li>";
                                              				echo "<li>Patricio.pena@epta-argentina.com</li>";
                                              				echo "</ul>";
                                              				echo "<br>";
                                              				echo "<p style='float: right;'>Disculpe las molestias...</p>";
                                              				echo "<br></div>";
                                              			}
                                              			else
                                              			{
                                              				echo "<p>".$assoc_getFormulariosByDesc['for_ayudaDes']."</p>";
                                              			}

                                                    echo "</div>
                                                <div class='modal-footer'>

                                                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                                                 
                                               </div>  
                                               </div>
                                            </div> 
                                        </div>
                                    </div>";



    echo "</div>";

     
?>
<!-- Fin Soporte para el Desarrollador -->