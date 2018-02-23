<ul id="gn-menu" class="gn-menu-main">
	<li class="gn-trigger">
		<a class="gn-icon-menu"><i class="material-icons" style="font-size:36px;padding: 10px;">menu</i></a>
			<nav class="gn-menu-wrapper" style="z-index:99">
			<div class="gn-scroller">
				<ul class="gn-menu">
<?php
	$menu				=	new menu();
	$modulosBySistema	=	$menu->getModulosBySistema('NCR', $_SESSION['ID_usu']);
	for($i=0; $i<$menu->modBySisRows; $i++){
		$modulos				=	mysql_fetch_assoc($modulosBySistema);
		$ID_mod					=	$modulos['ID_mod'];
		$formulariosByModulos	=	$menu->getFormulariosByModulos($ID_mod);
		$submodulosByModulos	=	$menu->getSubmodulosByModulos($ID_mod);
		echo '<li><a href="#">' . $modulos['mod_nom_muestra'] . '</a>';
		echo '<ul class="gn-submenu">';
		for($a=0; $a<$menu->subByModRows; $a++){
			$submodulos					=	mysql_fetch_assoc($submodulosByModulos);
			$ID_sub						=	$submodulos['ID_sub'];
			$formulariosBySubmodulos	=	$menu->getFormulariosBySubmodulos($ID_sub);
			echo '<li>' . $submodulos['sub_desc'] . '</a>';
			echo '<ul class="gn-icon gn-icon-cog">';
			for($c=0; $c<$menu->forBySubRows; $c++){
				$form_submod	=	mysql_fetch_assoc($formulariosBySubmodulos);
				echo '<li><a href="' . $form_submod['for_desc'] . '">' . $form_submod['for_nom_muestra'] . '</a></li>';
			}
			echo '</ul>';
		}
		for($b=0; $b<$menu->forByModRows; $b++){
			$for_mod		=	mysql_fetch_assoc($formulariosByModulos);
			echo ' <li> <a href="' . $for_mod['for_desc'] . '"> ' . $for_mod['for_nom_muestra'] . '</a></li>';
		}
		echo '</ul>';
	}
	echo '</li>';
?>
				</ul>
			</div><!-- /gn-scroller -->
		</nav>
	</li>
	<li><a class="codrops-icon" href="logout.php"><i class="material-icons" style="font-size:36px;vertical-align:middle;padding: 10px;">power_settings_new</i></a></li>
</ul>
<script src="../js/classie.js"></script>
<script src="../js/gnmenu.js"></script>
<script>
	new gnMenu( document.getElementById( 'gn-menu' ) );
</script>