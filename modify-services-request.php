<?php
    require_once('inc/required.php');
    mysql_query("SET NAMES 'utf8'");
  ?>
<!--Fin Head-->
<!--Inicio Objetos-->
  <?php
    $registro_servicio = new registro_servicio;
    $tasks = new tasks;
    $questions = new questions;
    $answers = new answers;
  ?>  
<!--Fin Objetos-->
<!--Inicio Funciones-->
  <?php
  $back     = explode('?', $_SESSION['actionsBack']);
  $ID_ser=12*((base64_decode($_GET['ID_ser']))/12344);
  if ($back[0]=="/services/dashboard-services-user.php") 
  {
    $OcultaFormularioParaTecnicos="display:none;";
  }
  else
   {
    $OcultaFormularioParaTecnicos="";
   } 
   $getTasksByIdSer=$tasks->getTasksByIdSer($ID_ser);
   $num_getTasksByIdSer=mysql_num_rows($getTasksByIdSer);
   $GetRegistroServicioByIdser=$registro_servicio->GetRegistroServicioByIdserForTecnicos($ID_ser);
   $assoc_GetRegistroServicioByIdser=mysql_fetch_assoc($GetRegistroServicioByIdser);
   $qts_tipo=1;
   $getQuestions=$questions->getQuestions($qts_tipo);
   $num_getQuestions=mysql_num_rows($getQuestions);
   $usuario=$_SESSION['nombre']." ".$_SESSION['apellido'];
   $ID_usu=$_SESSION['ID_usu'];
   $horaActual=date("H:i:s");
   $fechaActual=date("Y-m-d");
  ?>
<!--Fin Funciones-->
<!--Inicio Alertas-->
   <?php
  if(isset($_GET['m']))
  {
    $ID_ale = $_GET['m'];
    $especiales = new especiales();
    $getAlerta  = $especiales->getAlerta($ID_ale);
    $assoc_getAlerta = mysql_fetch_assoc($getAlerta);
    echo $assoc_getAlerta['ale_desc'];
  }
?>
<div id='alertas' name='alertas'></div>
<!--Fin Alertas-->
<!--Inicio Estilos exclusivos-->
  <style type="text/css">
  
    hr {
    display: block;
    height: 5px;
    border: 0;
    border-top: 1px solid #fff;
    margin: 1em 0;
    padding: 0; 
}

  hr.negra {
    display: block;
    height: 5px;
    border: 0;
    border-top: 1px solid #333;
    margin: 1em 0;
    padding: 0; 
}
.cargaexterna
{
  background-color: #fff;
  height: auto;
  width:80%;
  float: right;
}
.filtros
{
  background-color: #fff;
  height: auto;
  width: 20%;
  float: left;
}

.filasFiltros
{
  margin: 10px;
}
 #formularioInput
    {
      margin-top: 10px;
      text-align: left;

    }
    #formularioBoton
    {
      margin: 20px;
      text-align: center;
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
<!-- Inicio Buscador Cliente / Tienda -->
<?php
echo "  <div class='alert alert-dismissible alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <h3><strong>Codigo de Servicio Nº : </strong> ".$assoc_GetRegistroServicioByIdser['ser_cod']."
                      </h3>
                      </div>";
    //No Modificar estas variables 
    @$id             =  $assoc_GetRegistroServicioByIdser['ID_obr'];  // ID_obr
    @$ID_obr         =  $assoc_GetRegistroServicioByIdser['ID_obr'];        
    @$obr_desc       =  $_GET['dato'];  // obr_desc
    @$cli_marker     =  $_GET['logo'];  // cli_marker
    @$idB            =  $assoc_GetRegistroServicioByIdser['ID_cli'];  // ID_obr
    @$ID_cli         =  $idB; 
    @$cli_desc       =  $assoc_GetRegistroServicioByIdser['cli_desc'];  // obr_desc
    if (isset($assoc_GetRegistroServicioByIdser['ID_ser']))
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
<!--Fin Script de loading general-->



<?php



  echo "<div class='container-fluid' style='background-color: #fff;'>          
           <div class='row'>

               
            <a href='".$back[0]."'>
              <button class='btn btn-info' style='margin:10px;'>
                  <i class='material-icons' style='vertical-align: middle;'>
                    backspace
                  </i> 
                  Volver
              </button>
            </a>
            <div class='col-md-12' style='align:center; margin-top: 20px;'> ";
          if ($num_getTasksByIdSer!=0)
            {
              echo  '<div class="panel-body">';
                 echo  '<div class="col-md-12"  style=" background-color:#fff; margin-top:10px; border: 4px solid #333; -webkit-border-radius: 15px; -moz-border-radius: 15px;">
                              <h3><i class="material-icons" style="vertical-align: middle;">local_shipping</i> Tareas ('.$num_getTasksByIdSer.')</h3>';
              echo  '<div class="table-responsive">
                      <table class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                              <td>
                              </td>   
                            </tr>
                        </thead>
                        <tbody id="myTable">
                          <tr class="info">
                            <td>';
                             echo   "<h3 class='modal-title' id='myModalLabel' style='margin-top: 20px;  background-color: #333; color: #fff; text-align: center; height: 70px; padding-top:20px;'>";
                                echo '<i class="material-icons" style="vertical-align: middle;">
                                  assignment
                                </i>
                                 Tareas 
                             
                               <button type="submit" class="btn btn-primary" id="agregarTarea" style="right"><i class="material-icons" style="vertical-align: middle">add</i> </button> </h3>
                            </td>
                             
                          </tr>
                        
                        <form action="actions-services.php" method="POST" enctype="multipart/form-data">';

                          echo '<tr class="info" id="trA" style="display:none;">
                            <th id="tdA" style="display:none; text-align: center;">
                            <input hidden type="date" name="pto_fecIngreso" value="'.$fechaActual.'" >
                               <input hidden type="date" name="tas_fecin" value="'.$fechaActual.'"  style="text-align:center;">
                              <input  type="hidden" name="action" value="NuevaTarea" style="text-align:center;">
                               <input  type="hidden" name="ID_ser" value="'.$ID_ser.'" style="text-align:center;">
                               
                             <input hidden type="time" name="tas_hourin" value="'.$horaActual.'"  style="text-align:center; ">
                         
                              <input type="hidden" name="usuario" value="'.$usuario.'"  style="text-align:center;" disabled>
                              <input type="hidden" name="ID_usu" value="'.$ID_usu.'" style="text-align:center;">
                             
                             <h3> Seleccione Tipo de Tarea </h3>
                                   <p id="tas_tipoA" >
                                    <input class="form-control" type="radio" name="tas_tipo" value="4" checked> Generica</p>
                                    <input class="form-control" type="radio" name="tas_tipo" id="tas_tipoB" value="6"> Repuesto
                                  <br>
                                  <p id="tas_tipoC"  style="display:none;"><input  type="radio" name="tas_tipo_repuesto"  value="1"> Enviar repuesto al cliente<br></p>

                                  <p id="tas_tipoD"  style="display:none;"><input  type="radio" name="tas_tipo_repuesto"  value="2"> El tecnico lo retira<br></p>

                                  <p id="tas_tipoE"  style="display:none;"><input  type="radio" name="tas_tipo_repuesto"  value="3"> El tecnico utiliza stock propio<br></p>
                                
                              <textarea name="tas_desc"></textarea>
                              <br><br>
                                 <!-- File Button --> 
                                <div class="form-group">
                                  <label for="adj_ruta"></label>
                                    <input type="file" name="adj_ruta[]" multiple>
                                </div>
                                 <br><br>
                             <input type="hidden" name="ser_cod" value="'.$assoc_GetRegistroServicioByIdser['ser_cod'].'">
                             <button type="submit" class="btn btn-success" id="guardarTarea" style="display: none;"><i class="material-icons" style="vertical-align: middle">add</i> Guardar Tarea</button>
                            </th>
                           </tr>
                         </form>';

                        

                    for ($tasksCount=0; $tasksCount < $num_getTasksByIdSer; $tasksCount++) 
                    { 
                      $assoc_getTasksByIdSer=mysql_fetch_assoc($getTasksByIdSer);
                      $ID_serA=$assoc_getTasksByIdSer['tas_tipo'];

                 
                    echo  '<tr class="info">';
                   
                    echo   '<td style="text-align: left;">';

                     echo "<div id='".$assoc_getTasksByIdSer['ID_tas']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
                      echo "<div class='col-md-12'>
                          <div class='col-md-11'>
                            <a data-toggle='collapse' data-parent='#".$assoc_getTasksByIdSer['ID_tas']."' href='#collapse".$assoc_getTasksByIdSer['ID_tas']."' aria-expanded='true' aria-controls='collapse".$assoc_getTasksByIdSer['ID_tas']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getTasksByIdSer['ID_tas']."</b> - " .$assoc_getTasksByIdSer['tas_desc']."</a></div>";


                           echo '<div class="col-md-1"><form action="actions-services.php" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="action" value="borrarTarea">
                              <input type="hidden" name="ID_ser" value="'.$ID_ser.'">
                              <input type="hidden" name="ID_tas" value="'.$assoc_getTasksByIdSer['ID_tas'].'">
                                <button type="submit" class="btn btn-danger" style="float:right;">
                                  <i class="material-icons" style="vertical-align: middle">
                                    delete_forever
                                  </i>
                                </button>
                              </form>';


                          echo "</div></div></div>
                             <div id='collapse".$assoc_getTasksByIdSer['ID_tas']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>";


                    echo ' <i class="material-icons" style="vertical-align: middle;">
                              face
                            </i> <strong>Usuario: </strong> ' .  $assoc_getTasksByIdSer['usu_nombre'] . ' ' . $assoc_getTasksByIdSer['usu_apellido'] .'<br><br>';
                    echo      '<i class="material-icons" style="vertical-align: middle;">
                               access_time
                            </i> <strong>Hora: </strong> ' . $assoc_getTasksByIdSer['tas_hourin'] . '<br><br>';
                    echo      '<i class="material-icons" style="vertical-align: middle;">
                              date_range
                            </i> <strong> Fecha: </strong>' . $assoc_getTasksByIdSer['tas_fecin'] . "<br><br>";
                    
                    if ($assoc_getTasksByIdSer['tas_tipo']==1) 
                    {
                     $tas_tipo="Generica";
                     $ID_sta=4;
                    }
                    else
                     {
                      $tas_tipo="Repuesto";
                      $ID_sta=6;
                     } 

                    echo    '<i class="material-icons" style="vertical-align: middle">
                                  class
                                </i><strong>Tipo: </strong> '.$tas_tipo.'<br><br>';

                                     
                    echo    '<i class="material-icons" style="vertical-align: middle;">
                                  reorder
                                </i>
                                  <strong>Descripción: </strong> '.$assoc_getTasksByIdSer['tas_desc'].'<br><br>';
                    echo      '  <i class="material-icons" style="vertical-align: middle;">
                              fingerprint
                              </i> 
                              Persona Conforme <br> <img src="' . $assoc_getTasksByIdSer['tas_firma'] . '" style="width:30%;">'. '<br><br>';   

                            // Inicio adjuntos -->
                              $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];;
                              $adj_idRelacion   = $assoc_getTasksByIdSer['ID_tas'];
                              $adj_tablaRelacion    = "tasks";
                              include('/inc/adjuntos.php');
                            // Fin adjuntos -->

                    $ID_tas =$assoc_getTasksByIdSer['ID_tas'];
                            
                              echo '</div>
                            </td>';
                    echo  '</tr>';
                    }
                    
                       echo  ' </tbody>
          <tfoot>
            <tr>
              <th></th>
            </tr>
          </tfoot>
        </table>
        
      </div>';
                          echo '<div class="col-md-12" style="text-align:center">';
                        
                

                 
                
                 echo "<script>
                 $('#agregarTarea').click(function(){
                    $('#trA').toggle('slow');
                    $('#tdA').toggle('slow');
                    $('#tdB').toggle('slow');
                    $('#tdC').toggle('slow');
                    $('#tdD').toggle('slow');
                    $('#tdE').toggle('slow');
                    $('#tdF').toggle('slow');
                    $('#tdG').toggle('slow');
                    $('#guardarTarea').toggle('slow');
                    $('#agregarTarea').toggle('slow');  
                 });
                 </script>";

            echo "</div>";
                  } 

                else
                {
                          echo '<div class="alert alert-primary" role="alert">';
                           
                               echo '<div class="col-md-12" style="text-align:center">';
                            
                                    echo "<form action='actions-services.php' method='POST' enctype='multipart/form-data'><h3 class='modal-title' id='myModalLabel' style='margin-top: 20px;  background-color: #333; color: #fff; text-align: center; height: 70px; padding-top:20px;'>";
                                       echo '<i class="material-icons" style="vertical-align: middle;">
                                     assignment
                                    </i>';
                                    echo ' Tareas  <a class="btn btn-primary"  id="agregarTareaB"  style="right"><i  class="material-icons" style="vertical-align: middle">add</i> </a>
                                   </h3>';
                                      
                                   echo '<div class="col-md-12" style="text-align:center">';
                                        echo '<h5><i class="material-icons" style="vertical-align: middle">thumb_up</i> No se registran tareas</h5>';
                                      echo '</div></div>';  


                  echo  '<div class="col-md-12" style="text-align:center; display: none;" id="fomularioNuevaTarea">
                          <div class="table-responsive">
                            <table class="table table-striped table-responsive">
                            <tr class="info">
                              <td colspan="6">
                                <h4>
                                  <i class="material-icons" style="vertical-align: middle;">
                                    assignment
                                  </i>
                                   Tareas 
                                </h4>
                              </td>
                            </tr>
                          
                              <tr class="info" id="trAB" style="display:none;">
                                <th id="tdAB" style="display:none; text-align: center;">
                                  <input hidden type="date" name="tas_fecin" value="'.$fechaActual.'" style="text-align:center;">

                                  <input  type="hidden" name="action" value="NuevaTarea" style="text-align:center;">
                                  
                                   <input  type="hidden" name="ID_ser" value="'.$ID_ser.'" style="text-align:center;">
                             
                                  <input hidden type="time" name="tas_hourin" value="'.$horaActual.'" style="text-align:center; ">
                          
                                  <input hidden type="text" name="usuario" value="'.$usuario.'"style="text-align:center;" disabled>
                                  <input type="hidden" name="ID_usu" value="'.$ID_usu.'" style="text-align:center;">
                                   <h3>Seleccione Tipo de Tarea</h3>
                                  <p id="tas_tipoA2" >
                                   <input class="form-control" type="radio" name="tas_tipo" value="4" checked> Generica

                                    <input class="form-control" type="radio" name="tas_tipo" id="tas_tipoB2" value="6"> Repuesto<br><br> 

                                 <p id="tas_tipoC2"  style="display:none;"><input  type="radio" name="tas_tipo_repuesto"  value="1"> Enviar repuesto al cliente<br></p>

                                  <p id="tas_tipoD2"  style="display:none;"><input  type="radio" name="tas_tipo_repuesto"  value="2"> El tecnico lo retira<br></p>

                                  <p id="tas_tipoE2"  style="display:none;"><input  type="radio" name="tas_tipo_repuesto"  value="3"> El tecnico utiliza stock propio<br></p>
                                
                                <br> <br> 
                                  <textarea name="tas_desc" ></textarea>
                                   <br> <br> 
                        
                                 
                                    <input type="file" name="adj_ruta[]" multiple>
                                
                                 <br><br>
                                 <input type="hidden" name="ser_cod" value="'.$assoc_GetRegistroServicioByIdser['ser_cod'].'">
                                 <button type="submit" class="btn btn-success" id="guardarTareaB" style="display: none;"><i class="material-icons" style="vertical-align: middle">add</i> Guardar Nueva Tarea</button>
                                </th>
                               </tr>
                             </form>
                            </table>
                           </div>
                          </div>';

                 echo '<div class="col-md-12" style="text-align:center">';
               
                echo "</div>";
                
                 echo "<script>
                 $('#agregarTareaB').click(function(){
                    $('#trAB').toggle('slow');
                    $('#tdAB').toggle('slow');
                    $('#tdBB').toggle('slow');
                    $('#tdCB').toggle('slow');
                    $('#tdDB').toggle('slow');
                    $('#tdEB').toggle('slow');
                    $('#tdFB').toggle('slow');
                    $('#guardarTareaB').toggle('slow');
                    $('#agregarTareaB').toggle('slow');  
                    $('#fomularioNuevaTarea').toggle('slow');  
                 });
                 </script>";

                }   
                                       echo "<form action='actions-services.php' method='POST'>
                                          <div class='col-md-12' style='align:center; margin-top: 20px;'>";
                                            $getAnswers=$answers->getAnswers($ID_ser);
                                             $num_getAnswers=mysql_num_rows($getAnswers);
                                                if ($num_getAnswers!=0)
                                                 {
                                        
                                          echo "<h3 class='modal-title' id='myModalLabel' style='margin-top: 20px;  background-color: #333; color: #fff; text-align: center; height: 70px; padding-top:20px; '>
                                                 Troubleshooting
                                               </h3>"; 
                                             

                                                echo "<div class='col-md-12' >";
                                                  echo "<table class='table table-striped table-responsive' style='text-align:center'>";
                                                    echo "<tr>";
                                                      echo "<td  style='text-align:center'>";
                                                        echo "<h4>Preguntas Realizadas</h4>";
                                                      echo "</td>";
                                                      echo "<td style='text-align:center'>";
                                                        echo "<h4>Respuestas Enviadas</h4>";
                                                      echo "</td>";
                                                    echo "</tr>";
                                                    for ($i=0; $i < $num_getAnswers; $i++)
                                                     { 
                                                      $assoc_getAnswers=mysql_fetch_assoc($getAnswers);
                                                     echo "<tr>";
                                                        echo "<td style='text-align:center'>";
                                                          echo $assoc_getAnswers['qts_desc'];
                                                        echo "</td>";
                                                        echo "<td style='text-align:center'>";
                                                          echo $assoc_getAnswers['aws_desc'];
                                                        echo "</td>";
                                                      echo "</tr>";   
                                                     }
                                                  echo "</table>";
                                                echo "</div>";
                                                       }                                   echo "</div> 
                                           <hr>          
                                           <div class='col-md-12' style='text-align:left; margin-top: 20px; ".$OcultaFormularioParaTecnicos."'>
                                              <h3 class='modal-title' id='myModalLabel' style='margin-top: 20px;  background-color: #333; color: #fff; text-align: center; height: 70px; padding-top:20px; '>
                                                  Formulario de Registro de Serivicio
                                               </h3>



                                          <div class='col-md-4' id='formularioInput'>  
                                            <i class='material-icons' style='vertical-align: middle;'>
                                              mode_edit
                                            </i> Descripción del problema:
                                          </div> 
                                          <div class='col-md-8' id='formularioInput'> 
                                            <textarea name='ser_desc' cols='50' rows='10'>".$assoc_GetRegistroServicioByIdser['ser_desc']."</textarea>
                                          </div> 


                                          <div class='col-md-4' id='formularioInput'>  
                                            <i class='material-icons' style='vertical-align: middle;''>
                                             contact_phone
                                            </i> Contacto:
                                          </div> 
                                          <div class='col-md-8' id='formularioInput'> 
                                            <input type='text' name='ser_contacto' class='form-control' value='".$assoc_GetRegistroServicioByIdser['ser_contacto']."'>
                                          </div> 


                                          <div class='col-md-4' id='formularioInput'>  
                                            <i class='material-icons' style='vertical-align: middle;''>
                                             phone
                                             </i> Teléfono:
                                          </div> 
                                          <div class='col-md-8' id='formularioInput'> 
                                            <input type='text' class='form-control' name='ser_telefono' value='".$assoc_GetRegistroServicioByIdser['ser_telefono']."' >
                                          </div> 

                                          <div class='col-md-4' id='formularioInput'>  
                                            <i class='material-icons' style='vertical-align: middle;''>
                                             email
                                             </i> email:
                                          </div> 
                                          <div class='col-md-8' id='formularioInput'> 
                                            <input type='text' class='form-control' name='ser_mail' value='".$assoc_GetRegistroServicioByIdser['ser_mail']."'>
                                          </div> 

                                           <div class='col-md-4' id='formularioInput'>  
                                            <i class='material-icons' style='vertical-align: middle;''>
                                             receipt
                                             </i> Numero de parte:
                                          </div> 
                                          <div class='col-md-8' id='formularioInput'> 
                                            <input type='text' class='form-control' name='ser_recCli' value='".$assoc_GetRegistroServicioByIdser['ser_recCli']."'>
                                          </div> 
                                          
                                          

                                          <div class='col-md-4' id='formularioInput'>  
                                            <i class='material-icons' style='vertical-align: middle;''>
                                             person</i>
                                              Responsable:
                                          </div> 
                                          <div class='col-md-8' id='formularioInput'>
                                          <select class='form-control'  name='ser_asig' style='width:172px'>";
                                            if ($assoc_GetRegistroServicioByIdser['ser_asig']==0)
                                            {
                                              echo '<option value=0>Seleccione</option>';
                                            }
                                            else
                                            {
                                              $ID_usuAsig=$assoc_GetRegistroServicioByIdser['ser_asig'];
                                              $getUsuariosById=$usuarios->getUsuariosById($ID_usuAsig);
                                              $getUsuariosById=mysql_fetch_assoc($getUsuariosById);

                                              echo  '<option value="'.$assoc_GetRegistroServicioByIdser['ser_asig'].'" selected>'.$getUsuariosById['usu_apellido'].' '.$getUsuariosById['usu_nombre'].'</option>'; 
                                            }  
                                           

                                      echo $optionResponsables=$registro_servicio->optionResponsables();
                                      echo "<option value='1'>Patricio Peña</option>";
                                    echo "</select>
                                        </div>

                                          <div class='col-md-4' id='formularioInput'>  
                                            <i class='material-icons' style='vertical-align: middle;'>
                                             priority_high
                                             </i> Prioridad:
                                          </div> 
                                          <div class='col-md-8' id='formularioInput'> 
                                            <select class='form-control'  name='ID_pri' style='width:172px'>";
                                              echo  '<option value="'.$assoc_GetRegistroServicioByIdser['ID_pri'].'" selected>'.$assoc_GetRegistroServicioByIdser['pri_desc'].'</option>'; 
                                              echo $optionPrioridades=$registro_servicio->optionPrioridades();
                                      
                                    echo "</select>
                                          </div> 
                                         

                                            </div>
                                      
                                     </div>
                                  ";
                        
                                  echo "<input type='hidden' name='action' value='modificar'>
                                        <input type='hidden' name='ID_ser' value='".$assoc_GetRegistroServicioByIdser['ID_ser']."' />
                                        <button type='submit' class='btn btn-success' name='carga' value='Registrar' style='margin-top: 20px; width:100%; ".$OcultaFormularioParaTecnicos."'>
                                          <i class='material-icons' style='vertical-align: middle;'>
                                            done
                                          </i>
                                           Modificar
                                        </button></p>
                                 </form> 
                                                     </div>
                      </div></div></div></div></div>";
                        
                          

                      ?>





            <!-- Inicio footer -->
            <?php
            require_once ('inc/footer.php');
            ?>
            <!-- Fin footer -->

<!-- Inicio JQuery -->

<script>
  $(document).ready(function() {
      // apply filterTable to all tables on this page
      $('table').filterTable({filterExpression: 'filterTableFindAll'});
  });
</script>
<script>
  $(function () {
    $('[data-toggle="modal"]').tooltip()
  })
</script>
<script>
  $('.collapse').collapse()
</script>
<script>
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    e.target // newly activated tab
    e.relatedTarget // previous active tab
})
  $('#myTabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
})
</script>

<script>
  $("#file-3").fileinput({
  showCaption: false,
  browseClass: "btn btn-primary btn-lg",
  fileType: "any"
  });
</script>

<!-- Fin JQuery -->

     <script type="text/javascript">

        $("#tas_tipoB").click(function() {  
            if($("#tas_tipoB").is(':checked')) {  
                $("#tas_tipoA").toggle("slow");
                $("#tas_tipoC").toggle("slow");
                $("#tas_tipoD").toggle("slow");
                $("#tas_tipoE").toggle("slow");
            } else {  
                 $("#tas_tipoA").toggle("slow");
                 $("#tas_tipoC").toggle("slow");
                 $("#tas_tipoD").toggle("slow");
                 $("#tas_tipoE").toggle("slow");
            }  
        });  

         $("#tas_tipoB2").click(function() {  
            if($("#tas_tipoB2").is(':checked')) {  
                $("#tas_tipoA2").toggle("slow");
                $("#tas_tipoC2").toggle("slow");
                $("#tas_tipoD2").toggle("slow");
                $("#tas_tipoE2").toggle("slow");
            } else {  
                 $("#tas_tipoA2").toggle("slow");
                 $("#tas_tipoC2").toggle("slow");
                 $("#tas_tipoD2").toggle("slow");
                 $("#tas_tipoE2").toggle("slow");
            }  
        });  
      
     </script>