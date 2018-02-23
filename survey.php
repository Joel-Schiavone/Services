<!--
REFERENCIA:
* Head.
* Objetos.
* Funciones.
* Alertas.
* Estilos exclusivos
* loading general
* Div gral
  * Boton Nueva Busqueda
  * Tienda input disabled
    * Seleccionar sector
    * Boton nuevo sector
    * sector input disabled
      * Seleccionar sistema
      * Boton nuevo sistema
      *Tienda inpur disabled
        *Boton nuevo equipo
        *Equipo input disabled
        *Alerta Final del proceso
  * Selector de tiendas
* JQuery.
* Footer.
-->  

 <!-- Inicio Head -->
  <?php
    require_once('inc/required.php');
    $ID_emp			      = $_SESSION['ID_emp'];
	  $_SESSION['Nivel-1']  = $_SERVER['REQUEST_URI'];
  ?>
<!--Fin Head-->

<!-- Inicio Buscador Cliente / Tienda -->
<?php
    //No Modificar estas variables 
    @$id             =  round(12*((base64_decode($_GET['id']))/12344));  // ID_obr
    @$obr_desc       =  $_GET['dato'];  // obr_desc
    @$cli_marker     =  $_GET['logo'];  // cli_marker
    @$idB            =  round(12*((base64_decode($_GET['idB']))/12344));  // ID_obr
    @$ID_cli         =  $idB; 
    @$cli_desc       =  $_GET['datoB'];  // obr_desc
    if (isset($_GET['id']))
    {
    $seleccionado         = "si";
    }
    else
    {
    $seleccionado         = "no";
    } 
    //Modificar estas variables, en el caso de que se modifique $redireccion se debe pegar el la pagina seleccionada todas las variables superiores a esta linea.
    $AgregarCliente       = "si"; //Coloque "si" para habilitar el acceso a agregar cliente y "no" para deshabilitarlo  
    $AgregarTienda        = "si"; //Coloque "si" para habilitar el acceso a agregar Tienda y "no" para deshabilitarlo
    $redireccion          = $_SERVER['REQUEST_URI']; //Redireccion una vez seleccionado el resultado envia GET
    $placeholder          = "Cliente / Tienda"; 
    $Titulo               = "Cliente / Tienda";
    include('inc/buscadorClienteTienda.php');
?>
<!-- Fin Buscador Cliente / Tienda -->

<!--Inicio Objetos-->
  <?php
    @$ID_sec          =  round(12*((base64_decode($_GET['ID_sec']))/12344)); 
    if (isset($_GET['ID_obr']))
     {
        @$ID_obr          =  round(12*((base64_decode($_GET['ID_obr']))/12344));
    }  
    else
    {
       @$ID_obr          =  round(12*((base64_decode($_GET['id']))/12344));
    }     
    

    @$ID_sis          =  round(12*((base64_decode($_GET['ID_sis']))/12344));
    @$equ_desc        =  $_GET['equ_desc']; 
    @$sec_desc        =  $_GET['sec_desc']; 
    @$sis_desc        =  $_GET['sis_desc']; 
    @$ID_equ          =  round(12*((base64_decode($_GET['ID_equ']))/12344));
    $tiendas          =  new tiendas();
    $obras_sector     =  new obras_sector();
    $obras_sistema    =  new obras_sistema();
  ?>  
<!--Fin Objetos-->

<!--Inicio Funciones-->
  <?php
    $getTiendasById                 =   $tiendas->getTiendasById($ID_obr);
    $assoc_getTiendasById           =   mysql_fetch_assoc($getTiendasById);
    $getTiendasMap                  =   $tiendas->getTiendasMap($ID_emp);
    $getObras_sectorById_obr        =   $obras_sector->getObras_sectorById_obr ($ID_obr, $ID_emp);
    $num_getObras_sectorById_obr    =   mysql_num_rows($getObras_sectorById_obr);
    $getObras_sectorById            =   $obras_sector->getObras_sectorById($ID_sec);
    $assoc_getObras_sectorById      =   mysql_fetch_assoc($getObras_sectorById);
    $getobras_sistemaById_sec       =   $obras_sistema->getobras_sistemaById_sec ($ID_obr, $ID_sec);
    $num_getobras_sistemaById_sec   =   mysql_num_rows($getobras_sistemaById_sec);
    $getobras_sistemaById           =   $obras_sistema->getobras_sistemaById($ID_sis);
    $assoc_getobras_sistemaById     =   mysql_fetch_assoc($getobras_sistemaById);

    if (@isset($_GET['seleccion']))
    {
      $sec_desc                   =   $assoc_getObras_sectorById['sec_desc'];
      $sis_desc                   =   $assoc_getobras_sistemaById['sis_desc'];
    }
  ?>
<!--Fin Funciones-->

<!--Inicio: Alertas -->
<?php
  if(isset($_GET['m']))
  {
    $ID_ale = $_GET['m'];
    $especiales = new especiales();
    $getAlerta  = $especiales->getAlerta($ID_ale);
    $assoc_getAlerta = mysql_fetch_assoc($getAlerta);
    echo  $assoc_getAlerta['ale_desc'];
  }
?>
<!--Fin: Alertas-->

<!--Inicio Estilos exclusivos-->
  <style type="text/css">

   body
    {
      background-color:#34495e;
    }
  </style>
<!--Fin Estilos exclusivos-->

<!--Inicio Script de loading general-->
  <script type="text/javascript">
    $(window).load(function () {
      $('#cargando').hide();
    });
    </script>
    <div id="cargando">
    </div>
<!--Fin Script de loading general-->

<!-- Inicio div gral -->

               
  <div class='row' style='margin-right: 5px; margin-left: 5px; margin-top: 20px; margin-bottom:20px;'>
          <?php 
              if (isset($_GET['id']) or isset($_GET['ID_obr']))
              {
                 
                  if(isset($_GET['ID_sec']))
                  {
                    echo "<div class='col-md-12'>
                            <div class='form-group'>
                               <a href='survey.php?ID_obr=".base64_encode((12344*($ID_obr))/12)."&dato=".$assoc_getTiendasById['obr_desc']."&logo=%20../images/markers/otros.png'>
                                   <div class='input-group' id='divAnimadoC' name='divAnimadoC'>
                                        <span class='input-group-addon' id='basic-addon1'>
                                            <i style='vertical-align: middle;' class='material-icons'>
                                                select_all
                                            </i>
                                             Sector:&nbsp;&nbsp;&nbsp; 
                                        </span>
                                      <input id='icon_prefix' aria-describedby='basic-addon1'  type='text'  name='sec_desc' class='form-control'   placeholder='".$sec_desc."' autocomplete='off' style='height: 50px;'  disabled>
                                  </div>
                                  </a> 
                              </div>
                          </div>";

                         if(isset($_GET['ID_sis'])) 
                         {
                             echo "<div class='col-md-12'>
                                      <div class='form-group'>
                                        <a href='survey.php?ID_obr=".base64_encode((12344*($ID_obr))/12)."&dato=".$assoc_getTiendasById['obr_desc']."&logo=%20../images/markers/otros.png&ID_sec=".base64_encode((12344*($ID_sec))/12)."'>
                                          <div class='input-group' id='divAnimadoB' name='divAnimadoB'>
                                                <span class='input-group-addon' id='basic-addon1'>
                                                    <i style='vertical-align: middle;' class='material-icons'>
                                                       settings
                                                    </i>
                                                     Sistema: 
                                                </span>
                                                <input id='icon_prefix' aria-describedby='basic-addon1'  type='text'  name='sis_desc' class='form-control'  placeholder='".@$sis_desc."' autocomplete='off' style='height: 50px;'  disabled>
                                            </div>
                                           </a>  
                                        </div>
                                    </div>";

                                if(isset($_GET['ID_equ']))
                                {
                                   echo "<div class='col-md-12'>
                                              <a href='new-equipment.php?ID_obr=".base64_encode((12344*($ID_obr))/12)."&ID_sec=".base64_encode((12344*($ID_sec))/12)."&ID_sis=".base64_encode((12344*($ID_sis))/12)."&sec_desc=".$sec_desc."&sis_desc=".$sis_desc."'>
                                                <button type='submit' class='btn btn-success' style='height: auto; width: 100%; margin-top: 20px; margin-bottom: 20px; font-size: 18px;'>
                                                  Agregar nuevo equipo
                                                </button></a>
                                            </div>";

                                        echo "<div class='col-md-12'>
                                              <div class='form-group'><div id='alertaFinal' name='alertaFinal' class='alert alert-success' role='alert' style='margin-right: 5px; margin-left: 5px; margin-top: 10px; margin top: 10px; display:none;'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                      <span aria-hidden='true'>&times;</span>
                                                    </button>
 
                                                    <h4><i style='vertical-align: middle;' class='material-icons'>
                                                           cloud_done
                                                      </i> Se Cargo correctamente el equipo ".$_GET['equ_desc']."
                                                </div>
                                              </div>";
                                }
                                else
                                {  
                                     echo "<div class='col-md-12'>
                                              <a href='new-equipment.php?ID_obr=".base64_encode((12344*($ID_obr))/12)."&ID_sec=".base64_encode((12344*($ID_sec))/12)."&ID_sis=".base64_encode((12344*($ID_sis))/12)."&sec_desc=".$sec_desc."&sis_desc=".$sis_desc."'>
                                                <button type='submit' class='btn btn-success' style='height: auto; width: 100%; margin-top: 20px; margin-bottom: 20px; font-size: 18px;'>
                                               Agregar nuevo equipo
                                                </button></a>
                                            </div>";
                                }  

                         }
                         else
                         {
                             echo "<div class='col-md-12'>
                                      <div class='form-group'>
                                        <form action='survey.php' method='GET'>
                                            <input hidden type='text' name='ID_obr'   value='".base64_encode((12344*($ID_obr))/12)."'>
                                            <input hidden type='text' name='ID_sec'   value='".base64_encode((12344*($ID_sec))/12)."'>
                                            <input hidden type='text' name='dato'     value='".$assoc_getTiendasById['obr_desc']."'>
                                            <input hidden type='text' name='logo'     value='../images/markers/otros.png'>
                                            <input hidden type='text' name='seleccion' value='seleccion'>
                                            <input hidden type='text' name='m' value='1'>
                                            <div  class='input-group'>";
                                            if ($num_getobras_sistemaById_sec!=0)
                                    {
                                             echo "<span class='input-group-addon' id='basic-addon1'>
                                                <i style='vertical-align: middle;' class='material-icons'>
                                                  settings
                                                </i> ";
                                                echo " Sistema:
                                              </span>
                                              <select class='form-control' name='ID_sis' style='height: 50px; width: 70%; float: left;'>";

                                                for ($ii=0; $ii < $num_getobras_sistemaById_sec; $ii++) 
                                                { 
                                                      $assoc_getobras_sistemaById_sec  =   mysql_fetch_assoc($getobras_sistemaById_sec);
                                                 echo "<option value='".base64_encode((12344*($assoc_getobras_sistemaById_sec['ID_sis']))/12)."'>
                                                      ".$assoc_getobras_sistemaById_sec['sis_desc']."  
                                                      </option>";
                                                }

                                              echo "</select>
                                              
                                              <button type='submit' class='btn btn-default' style='height: 50px; width: 30%; text-align: center; float:right'>
                                                  <i class='material-icons md-48 md-light' style='vertical-align: middle;'>
                                                    touch_app 
                                                  </i>
                                              </button>
                                            </div>";
                                            } 
                                        echo "</form>
                                      </div>
                                    </div>";

                                    echo "<div class='col-md-12'>
                                            <a href='new-system.php?ID_obr=".base64_encode((12344*($ID_obr))/12)."&ID_sec=".base64_encode((12344*($ID_sec))/12)."&sec_desc=".$sec_desc."'>
                                              <button type='submit' class='btn btn-success' style='height: auto; width: 100%; margin-top: 20px; margin-bottom: 20px; font-size: 18px;'>
                                                Agregar nuevo sistema
                                              </button></a>
                                          </div>";

                         } 
                 
                  } 
                  else
                  {

                     echo "<div class='col-md-12'>
                            <div class='form-group'>
                              <form action='survey.php' method='GET'>
                                  <input hidden type='text' name='ID_obr' value='".base64_encode((12344*($ID_obr))/12)."'>
                                  
                                  <input hidden type='text' name='dato' value='".$assoc_getTiendasById['obr_desc']."'>
                                  <input hidden type='text' name='logo'  value='../images/markers/otros.png'>
                                  <input hidden type='text' name='seleccion' value='seleccion'>
                                  <input hidden type='text' name='m' value='1'>
                                  <div  class='input-group'>";
                                  
                                    if ($num_getObras_sectorById_obr!=0)
                                    {
                                      echo "<span class='input-group-addon' id='basic-addon1'>
                                      <i style='vertical-align: middle;' class='material-icons'>
                                        select_all
                                      </i>";
                                      echo " Sector:&nbsp;&nbsp;
                                    </span>";
                                       echo "<select class='form-control' name='ID_sec' style='height: 50px; width: 70%; float: left;'>";  
                                         for ($i=0; $i < $num_getObras_sectorById_obr; $i++) 
                                      { 
                                            $assoc_getObras_sectorById_obr  =   mysql_fetch_assoc($getObras_sectorById_obr);

                                       echo "<option value='".base64_encode((12344*($assoc_getObras_sectorById_obr['ID_sec']))/12)."'>
                                            ".$assoc_getObras_sectorById_obr['sec_desc']."  
                                            </option>";
                                      }

                                    echo "</select>";
                                   
                                   
                                    echo "<button type='submit' class='btn btn-default' style='height: 50px; width: 30%; text-align: center; float:right'>
                                        <i class='material-icons md-48 md-light' style='vertical-align: middle;'>
                                          touch_app 
                                        </i>
                                    </button>
                                  </div>";
                                   }
                              echo "</form>
                            </div>
                          </div>";

                          echo "<div class='col-md-12'>
                                  <a href='new-sector.php?ID_obr=".base64_encode((12344*($ID_obr))/12)."&obr_desc=".$assoc_getTiendasById['obr_desc']."'>
                                    <button type='submit' class='btn btn-success' style='height: auto; width: 100%; margin-top: 20px; margin-bottom: 20px; font-size: 18px;'>
                                       Agregar nuevo sector
                                    </button></a>
                                </div>";
                  }  
              } 
              else
              {
                // Inicio: Selector de tiendas
                echo "
                <div class='row' id='selectTiendas' name='selectTiendas' style='display:none; margin-right: 5px; margin-left: 5px; margin-top: 10px; '>
                <div class='col-md-12'>
                    <span >
                    <h2 style='color: #fff'>Seleccione una Tienda</h2>
                        </span>
                        <div class='form-group'>
                          <div class='input-group'>
                         
                              <span class='input-group-addon' id='basic-addon1'>
                                  <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                      store
                                  </i>
                              </span>
                              <input id='icon_prefix' aria-describedby='basic-addon1'  type='text'  name='icon_prefix' class='form-control' placeholder='Tiendas' autocomplete='off' style='height: 50px; width: 80%;'>
                               <a href='new-store.php?url=".$_SERVER['REQUEST_URI']."'>
                                  <button type='bottom' class='btn btn-success' style='height: 50px; width: 20%; text-align: center;'>
                                      <i class='material-icons' style='vertical-align: middle;'> add </i>
                                  </button>
                                </a>
                          </div>
                          <div id='suggestions' class='suggestions'>
                          </div>
                      </div>
                    </div> </div>";
                // Fin: Selector de tiendas 
              } 
          ?>
  </div>
		
<!-- fin div gral -->

<!-- Inicio JQuery -->
  <script>

$(window).ready(function(){ 
  $('#alertaFinal').fadeIn(2000);
  $('#alertaFinalB').fadeIn(2000);
});




  </script>
<!-- Fin JQuery -->

 <!-- Inicio footer -->
<?php
require_once ('inc/footer.php');
?>
 <!-- Fin footer -->
