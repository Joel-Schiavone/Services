<!-- 
REFERENCIAS:

* Head
* Creacion de objetos
* Recepcion de variables
* Funciones
* Modal equipo Modificar
* Modal equipo Eliminar
* Modal adjuntos
* JQuery 
 -->

<!-- Inicio: Head -->
  <?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
  ?>  
<!-- Fin: Head -->

<!--Inicio: creacion de objetos-->
<?php
    $equipos_obras                 =  new equipos_obras(); 
    $tipo_equipos                  =  new tipo_equipos();
    $obras_sector                  =  new obras_sector();
    $obras_sistema                 =  new obras_sistema(); 
    $tiendas                       =  new tiendas();

   ?>  
<!--Fin: creacion de objetos-->

<!--Inicio: Recepcion de variables-->
<?php
    $ID_emp                        =  $_SESSION['ID_emp'];
    $ID_obr                        =  $_POST["ID_obr"];
    $_SESSION['ID_obr']            =  $ID_obr;
    $ID_sis                        =  $_POST["datosSistemas"];
    $ID_sec                        =  $_POST["ID_sec"];
   ?>  
<!--Fin: Recepcion de variables-->

<!--Inicio: Funciones-->
<?php
    $getEquipos_obrasById_sis      =  $equipos_obras ->getEquipos_obrasById_sis($ID_sis);
    $num_getEquipos_obrasById_sis  =  mysql_num_rows($getEquipos_obrasById_sis);
    $getEquipos_obrasById_sisB     =  $equipos_obras ->getEquipos_obrasById_sis($ID_sis);
    $num_getEquipos_obrasById_sisB =  mysql_num_rows($getEquipos_obrasById_sisB);
    $getEquipos_obrasById_sisC     =  $equipos_obras ->getEquipos_obrasById_sis($ID_sis);
    $num_getEquipos_obrasById_sisC =  mysql_num_rows($getEquipos_obrasById_sisC);
    $getEquipos_obrasById_sisD     =  $equipos_obras ->getEquipos_obrasById_sis($ID_sis);
    $num_getEquipos_obrasById_sisD =  mysql_num_rows($getEquipos_obrasById_sisD);
    $getTipo_equiposById_emp       =  $tipo_equipos->getTipo_equiposById_emp($ID_emp);
    $num_getTipo_equiposById_emp   =  mysql_num_rows($getTipo_equiposById_emp);
    $getObras_sectorById           =  $obras_sector->getObras_sectorById($ID_sec);
    $assoc_getObras_sectorById     =  mysql_fetch_assoc($getObras_sectorById);
    $getTiendasById                =  $tiendas->getTiendasById($ID_obr);
    $assoc_getTiendasById          =  mysql_fetch_assoc($getTiendasById);
    
    $getTipo_equiposById_empC        =   $tipo_equipos->getTipo_equiposById_emp($ID_emp);
    $num_getTipo_equiposById_empC    =   mysql_num_rows($getTipo_equiposById_empC);
   ?>  
 <!--Fin: Funciones-->

 <!--Inicio Modal equipo Modificar-->
    <?php
     for ($i=0; $i < $num_getEquipos_obrasById_sisB; $i++) 
                     { 
                            $assoc_getEquipos_obrasById_sisB    =   mysql_fetch_assoc($getEquipos_obrasById_sisB); 
                            $ID_sis                             =   $assoc_getEquipos_obrasById_sisB['ID_sis'];
                            $getobras_sistemaById               =   $obras_sistema->getobras_sistemaById($ID_sis);
                            $assoc_getobras_sistemaById         =   mysql_fetch_assoc($getobras_sistemaById); 
                            $ID_tpe                             =   $assoc_getEquipos_obrasById_sisB['ID_tpe'];
                            $getTipo_equiposById                =   $tipo_equipos->getTipo_equiposById($ID_tpe); 
                            $assoc_getTipo_equiposById          =   mysql_fetch_assoc($getTipo_equiposById);
                            $getTipo_equiposById_empB           =   $tipo_equipos->getTipo_equiposById_emp($ID_emp);
                            $num_getTipo_equiposById_empB       =   mysql_num_rows($getTipo_equiposById_empB);
                            $getObras_sectorById_obr            =   $obras_sector->getObras_sectorById_obr($ID_obr);
                            $num_getObras_sectorById_obr        =   mysql_num_rows($getObras_sectorById_obr);
                            $getobras_sistemaById_sec           =   $obras_sistema->getobras_sistemaById_sec($ID_obr, $ID_sec);
                            $num_getobras_sistemaById_sec       =   mysql_num_rows($getobras_sistemaById_sec);
                             echo "<div class='modal fade' id='".$assoc_getEquipos_obrasById_sisB['ID_equ']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                     <form action='modif-equipment.php' method='POST'>
                                        <div class='modal-dialog' role='document'>
                                           <div class='modal-content'>
                                               <div class='modal-header'>
                                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                  <H4 class='modal-title' id='myModalLabel' style='margin-top: 10px;'>  
                                                    <i style='vertical-align: middle;' class='material-icons'>
                                                       memory
                                                    </i>Equipos
                                                   </h4>
                                                </div>
                                                <div class='modal-body' align='center'>

                                                     <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                memory
                                                              </i>
                                                            </span>
                                                             <input type='text' name='equ_desc' class='form-control' value='".$assoc_getEquipos_obrasById_sisB['equ_desc']."'>
                                                          </div>
                                                        </div>

                                                         <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                settings
                                                              </i>
                                                            </span>
                                                               <select name='ID_sis' class='form-control'>

                                                           <option selected class='form-control' value='".$assoc_getEquipos_obrasById_sisB['ID_sis']."'>".$assoc_getobras_sistemaById['sis_desc']."
                                                           </option>";

                                                           for ($z=0; $z < $num_getobras_sistemaById_sec ; $z++)
                                                            { 
                                                              $assoc_getobras_sistemaById_sec = mysql_fetch_assoc($getobras_sistemaById_sec);
                                                              
                                                              if ($assoc_getobras_sistemaById_sec['ID_sis']!=$assoc_getEquipos_obrasById_sisB['ID_sis'])
                                                              {
                                                              echo "<option value='".$assoc_getobras_sistemaById_sec['ID_sis']."'>".$assoc_getobras_sistemaById_sec['sis_desc']."
                                                                    </option>";
                                                              }
                                                            }

                                                  echo "</select>
                                                          </div>
                                                        </div>

                                                        <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                code
                                                              </i>
                                                            </span>
                                                             <input type='text' name='equ_cod' class='form-control' value='".$assoc_getEquipos_obrasById_sisB['equ_cod']."'>
                                                          </div>
                                                        </div>

                                                      <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                select_all
                                                              </i>
                                                            </span>
                                                        <select  name='ID_sec' class='form-control'>

                                                           <option  class='form-control' value='".$assoc_getObras_sectorById['ID_sec']."'>".$assoc_getObras_sectorById['sec_desc']."
                                                           </option>";

                                                          

                                                  echo "</select>
                                                          </div>
                                                        </div>

                                                        <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                inbox
                                                              </i>
                                                            </span>
                                                              <select name='ID_tpe' class='form-control'>
                                                                
                                                                   <option selected class='form-control' value='".$assoc_getTipo_equiposById['ID_tpe']."'>".$assoc_getTipo_equiposById['tpe_desc']."
                                                                 </option>";
                                                                    for ($k=0; $k < $num_getTipo_equiposById_empB; $k++)
                                                                      { 
                                                                        $assoc_getTipo_equiposById_empB = mysql_fetch_assoc($getTipo_equiposById_empB);
                                                                        echo $assoc_getTipo_equiposById_empB['ID_tpe'];
                                                                        if ($assoc_getTipo_equiposById_empB['ID_tpe']!=$assoc_getEquipos_obrasById_sisB['ID_tpe'])
                                                                          {
                                                                              echo "<option value='".$assoc_getTipo_equiposById_empB['ID_tpe']."'>
                                                                                ".$assoc_getTipo_equiposById_empB['tpe_desc']."
                                                                                </option>";
                                                                            }     
                                                                      }
                                                            echo "</select>
                                                            </div>
                                                        </div>

                                                          <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                store
                                                              </i>
                                                            </span>
                                                        <select disabled name='ID_obr' class='form-control'>
                                                           <option selected class='form-control' value='".$assoc_getTiendasById['ID_obr']."'>".$assoc_getTiendasById['obr_desc']."
                                                           </option>";

                                                      
                                                    echo "</select>
                                                          </div>
                                                        </div>

                                                        <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                              sms
                                                              </i>
                                                            </span>
                                                             <textarea type='text' name='equ_detalles' class='form-control'>".$assoc_getEquipos_obrasById_sisB['equ_detalles']."</textarea>
                                                          </div>
                                                        </div>
                                                        <input hidden type='text' name='ID_obr' value='".$ID_obr."'>
                                                        <input hidden type='text' name='ID_equ' value='".$assoc_getEquipos_obrasById_sisB['ID_equ']."'>
                                                      
                                                </div>
                                              
                                                <div class='modal-footer'>

                                                 <button type='submit' name='modificar' id='modificar' value='modificar'  class='btn btn-success'><i class='material-icons' style='vertical-align: middle'> save </i> Guardar Cambios</button>
                                                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                                               </div>
                                            </div> 
                                        </div>
                                      </form>  
                                    </div>";
                    }   
            ?>                               
<!-- Fin Modal equipo Modificar-->

<!--Inicio Modal Sector Eliminar-->

<?php
          for($cc=0; $cc<$num_getEquipos_obrasById_sisC; $cc++)
           {
              $assoc_getEquipos_obrasById_sisC  = mysql_fetch_assoc($getEquipos_obrasById_sisC);

              echo "<div class='modal fade' id='Eliminar".$assoc_getEquipos_obrasById_sisC['ID_equ']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                      <div class='modal-dialog' role='document'>
                         <div class='modal-content'>
                            <div class='modal-header'>
                               <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                               <h4 class='modal-title' id='myModalLabel'>Eliminar Registro</h4>
                            </div>

                            <div class='modal-body' align='center'>
                                <div class='alert alert-danger' role='alert'>
                                   <h5><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> ¿Está seguro?</h5>
                                   <p>Usted esta a punto de eliminar un registro</p>
                                </div>
                            </div>
                              
                            <div class='modal-footer'>
                            <form action='modif-equipment.php' method='POST'>
                             <input hidden type='text' name='ID_obr' value='".$ID_obr."'></input>
                              <input hidden type='text' name='ID_equ' value='".$assoc_getEquipos_obrasById_sisC['ID_equ']."'>
                              <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                                  <button type='submit' id='eliminar' name='eliminar' value='eliminar' class='btn btn-danger'>
                                      <i class='material-icons' style='height: 5px; margin-top: -12px;'>delete_forever</i> 
                                          eliminar
                                  </button>
                                 
                                 </form> 
                              </a>
                            </div>
                          </div>
                        </div> 
                    </div>";
             }

?>     
<!-- Fin Modal Sector eliminar-->

<!--Inicio Modal adjuntos-->

<?php
          for($dd=0; $dd<$num_getEquipos_obrasById_sisD; $dd++)
           {
              $assoc_getEquipos_obrasById_sisD  = mysql_fetch_assoc($getEquipos_obrasById_sisD);

              echo "<div class='modal fade' id='adjuntos".$assoc_getEquipos_obrasById_sisD['ID_equ']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                      <div class='modal-dialog' role='document'>
                         <div class='modal-content'>
                            <div class='modal-header'>
                               <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                               <h4 class='modal-title' id='myModalLabel'>Archivos Adjuntos</h4>
                            </div>

                            <div class='modal-body' align='center'>";
                              
                           
                              $adj_idRelacion       = $assoc_getEquipos_obrasById_sisD['ID_equ'];
                              $adj_tablaRelacion    = "equipos_obras";
                              include('inc/adjuntos.php');
                                              

                            echo "</div>
                            <div class='modal-footer'>
                            <form action='modif-equipment.php' method='POST'>
                             <input hidden type='text' name='ID_obr' value='".$ID_obr."'></input>
                              <input hidden type='text' name='ID_equ' value='".$assoc_getEquipos_obrasById_sisC['ID_equ']."'>
                              <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                                  
                                 </form> 
                              </a>
                            </div>
                          </div>
                        </div> 
                    </div>";
             }

?>     
<!-- Fin Modal adjuntos-->


<!-- Inicio Modal tipos de equipamientos -->

<?php

 echo "<div class='modal fade' id='ModalTipo-equipos' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                        <div class='modal-dialog' role='document'>
                                           <div class='modal-content'>
                                               <div class='modal-header'>
                                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                   <h4 class='modal-title' id='myModalLabel'>Tipos de objetivos</h4>
                                                </div>
                                              <div class='modal-body' align='center'>
                                                  <div class='cargando'>
                                                            </div>
                                                            <div class='muestra'>
                                                            </div>";
                                            
                                                      echo "<table class='table table-bordered'>";
                                                        echo "<tr>";
                                                          echo "<td>";
                                                            echo "<h4>Tipo de equipos</h4>";
                                                          echo "</td>";
                                                          echo "<td colspan='2' style='text-align:center;'>";
                                                            echo "<h4>Agregar</h4>";
                                                          echo "</td>";
                                                        echo "</tr>";
                                                        echo "<tr>";
                                                          echo "<td>";
                                                            echo "<input class='form-control' name='tpe_desc' id='tpe_desc' type='text' placeholder='Intruduce un nuevo tipo de equipamiento'>";
                                                          echo "</td>";
                                                          echo "<td colspan='2' style='text-align:center;'>";
                                                          echo "<a type='button' class='btn btn-primary' id='enviar'><i class='material-icons' style='vertical-align: middle;'> add </i> Agregar</a>";

                                                          echo "</td>";
                                                        echo "</tr>";
                                                         echo "</form>";                     
                                                           for($u=0; $u<$num_getTipo_equiposById_empC; $u++)
                                                                  {
                                                        
                                                        echo "<tr>"; 
                                                            echo "<td colspan='3'>"; 
                                                              $assoc_getTipo_equiposById_empC = mysql_fetch_assoc($getTipo_equiposById_empC);

                                                            echo "<input class='form-control'  type='text' value='".$assoc_getTipo_equiposById_empC['tpe_desc']."'>";
                                                      
                                                                   
                                                            echo "</td>";             
                                                 
                                                        echo "</tr>";
                                                          
                                                        }
                                                      echo "</table>
                                                    </div>
                                                <div class='modal-footer'>
                                                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                                                
                                               </div>  
                                               </div>
                                            </div> 
                                        </div>
                                    </div>";

    echo "</div>";
?>
 <script type="text/javascript">
     $("#enviar").click(function() 
     {  
      $('.muestra').html("<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><img src='images/loading2.gif' style='width: 20px; height: auto;'> Cargando, aguarde por favor</div>");
      var tpe_desc = $("#tpe_desc").val();
      $(".muestra").load('insert-type-equipment.php?tpe_desc='+tpe_desc); 
      
    });

    </script>
<!-- Fin Modal tipos de equipamientos -->
<div class="col-md-4" style=" background-color:#fff; margin-top:10px; border: 4px solid #333; -webkit-border-radius: 15px; -moz-border-radius: 15px;">
  <H4 class='modal-title' id='myModalLabel' style='margin-top: 10px;'>  
    <i style='vertical-align: middle;' class='material-icons'>
       memory
    </i>EQUIPOS<button type='button' class='btn btn-success' id='nuevoEquipo' style='float: right; margin-bottom: 10px; margin-right: 5px;'><i class='material-icons' style='vertical-align: middle'> add </i></button></h4>
         <div id='inputNuevoEquipo' style="display: none;">
                   <form action='insert-equipment.php' method='POST'>
                    <table class='table table-responsive'>
                        <tr>
                          <td>Nuevo equipo</td>
                        </tr>
                        <tr>
                          <td>
                            <input hidden type='text' name='ID_sec' value='<?php echo $ID_sec; ?>'></input>
                            <input hidden type='text' name='ID_sis' value='<?php echo $ID_sis; ?>'></input>
                            <input hidden type='text' name='ID_obr' value='<?php echo $ID_obr; ?>'></input>
                            <input type='text' name='equ_desc' class='form-control' placeholder='Denominación'></input>
                          </td>  
                        </tr>
                        <tr>
                          <td>
                            <select  name='ID_tpe' class='form-control' style=' width:80%; float:left; '>
                            <option>
                              tipo de equipo
                            </option>  
                              <?php
                                for ($i=0; $i < $num_getTipo_equiposById_emp; $i++)
                                  { 
                                    $assoc_getTipo_equiposById_emp = mysql_fetch_assoc($getTipo_equiposById_emp);
                                    echo "<option value='".$assoc_getTipo_equiposById_emp['ID_tpe']."'>
                                      ".$assoc_getTipo_equiposById_emp['tpe_desc']."
                                      </option>";
                                  }
                              ?>
                            </select>

                             <a data-target='#ModalTipo-equipos' data-toggle='modal'><i style='width:15%; float: right; height: 50px; vertical-align: middle; margin-left: 4%;' class='material-icons'>
                                          add_box 
                                        </i></a>
                                    
                           </td> 
                        </tr>
                        <tr>
                          <td>
                            <input type='text' name='equ_cod' class='form-control' placeholder='Código'></input>
                          </td>
                        </tr>
                         <tr>
                          <td>
                            <textarea name='equ_detalles' class='form-control' placeholder='Detalle'></textarea>
                          </td>
                        </tr>
                         <tr>
                          <td>
                           <button type='submit' class='btn btn-success' data-toggle='modal' style=' height: 30px; text-align: center;' >
                            <i class='material-icons' style='vertical-align: middle'>
                             save 
                            </i>
                             Guardar
                          </button>
                          </td>
                         </tr>
                    </table>
                  </form>
              </div>

<?php
                echo "<table class='table table-responsive'>
                        <tr>
                            <td>
                              Descripción
                            </td>
                            <td>
                              Editar
                            </td>
                            <td>
                              Eliminar
                            </td>
                              <td>
                              Ver adjuntos
                            </td>
                        </tr>"; 

                          for ($b=0; $b < $num_getEquipos_obrasById_sis; $b++) 
                          { 
                             $assoc_getEquipos_obrasById_sis =  mysql_fetch_assoc($getEquipos_obrasById_sis);    
                             
                                  echo "<tr>
                                          <td>
                                           <button data-target='#".$assoc_getEquipos_obrasById_sis['ID_equ']."' data-toggle='modal' class='btn btn-info'>".$assoc_getEquipos_obrasById_sis['equ_cod']."</button>
                                          </td>
                                          <td>
                                               <button type='button' class='btn btn-success' data-toggle='modal' style='width: 40px; height: 30px; text-align: center;' data-target='#".$assoc_getEquipos_obrasById_sis['ID_equ']."'><i class='material-icons' style='vertical-align: middle'> edit </i></button>
                                          </td>
                                          <td>
                                          <button type='bottom' class='btn btn-danger' style='width: 40px; height: 30px; text-align: center' data-toggle='modal' data-target='#Eliminar".$assoc_getEquipos_obrasById_sis['ID_equ']."'><i class='material-icons' style='vertical-align: middle;'> delete_forever </i></button>
                                             
                                          </td>
                                           <td>
                                               <button type='button' class='btn btn-info' data-toggle='modal' style='width: 40px; height: 30px; text-align: center;' data-target='#adjuntos".$assoc_getEquipos_obrasById_sis['ID_equ']."'><i class='material-icons' style='vertical-align: middle'> attach_file </i></button>
                                          </td>
                                      </tr>";             
                              
                          } 
                          echo "</table>";
          ?>
</div>
  <!-- Inicio JQuery -->
  <script type='text/javascript'>
                   $('#nuevoEquipo').click(function(){
                     $('#inputNuevoEquipo').toggle('slow');
                  });
                
                 $('#ModalTipo-equipos').on('hidden.bs.modal', function (e) {
                       location.reload();
                    });
   </script>

 
  <!-- Fin JQuery -->
