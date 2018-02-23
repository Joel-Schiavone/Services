<!--
REFERENCIA:
* Head.
* Objetos.
* Funciones.
* Alertas.
* Estilos exclusivos
* loading general
* Div gral
* JQuery.
* Footer.
-->  


 <!-- Inicio Head -->
  <?php
    require_once('inc/required.php');
    $_SESSION['dropBack']           = $_SERVER['REQUEST_URI'];
    $_SESSION['actionsBack']        = $_SERVER['REQUEST_URI'];
  ?>
<!--Fin Head-->
<!--Inicio Objetos-->
  <?php
    $registro_servicio = new registro_servicio;
    $questions = new questions;
    $answers = new answers;
    $oOpe     = new operaciones();
    $ID_usu = $_SESSION['ID_usu'];
  ?>  
<!--Fin Objetos-->
<!--Inicio Funciones-->
  <?php
  
    $GetRegistroServicioAsignado = $registro_servicio->GetRegistroServicioAsignadoPorUsuarios($ID_usu);
    $num_GetRegistroServicioAsignado=mysql_num_rows($GetRegistroServicioAsignado);
    
    $GetRegistroServicioPendientes = $registro_servicio->GetRegistroServicioPendientesPorUsuarios($ID_usu);
    $num_GetRegistroServicioPendientes=mysql_num_rows($GetRegistroServicioPendientes);

    $GetRegistroServicioRepuestos = $registro_servicio->GetRegistroServicioRepuestosPorUsuarios($ID_usu);
    $num_GetRegistroServicioRepuestos=mysql_num_rows($GetRegistroServicioRepuestos);

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

 #botones
 {
  margin-top: 10px;
 }   
 #botonDentroDeDiv
 {
 }
@media (max-width: 900px) {
 .cargaexterna{
   float: none;
   width: 100%;
  }
   .filtros{
    float: none;
  }
}

/* INICIO ESTILOS SOLAPAS */

#cuadros
{
  background-color:#fff;
  margin:4px;
  border: 2px solid #000;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  text-align: center;
}
#barraTareas
{
  width: 100%;
  text-align: right;
  border-bottom: 1px solid #000;
  cursor: pointer;
  font-size: 10px;
}
.solapa
{
  display: none; 
  margin:4px;
  background-color: #efefef;
  height: 30px;
  width: 90%;
  position: absolute;
  bottom: 0px;
  padding-left: 10px; 
  padding-right: 20px;
  border-radius: 20px 20px 10px 10px;
  -moz-border-radius: 20px 20px 10px 10px;
  -webkit-border-radius: 20px 20px 10px 10px;
  border: 1px solid #000000;
  cursor: pointer;
  padding-bottom: 40px;
 }


#iconoAsignado
{
  text-align: center;
}
#expandirAsignado:hover
{
  color: #0bb;
}
#contraerAsignado:hover
{
  color: #0bb;
}
#cerrarColumnaAsignado:hover
{
  color: #f00;
}
#minimizarAsignado:hover
{
  color: #0bb;
}


#iconoPendiente
{
  text-align: center;
}
#expandirPendiente:hover
{
  color: #0bb;
}
#contraerPendiente:hover
{
  color: #0bb;
}
#cerrarColumnaPendiente:hover
{
  color: #f00;
}
#minimizarPendiente:hover
{
  color: #0bb;
}


#iconoRepuesto
{
  text-align: center;
}
#expandirRepuesto:hover
{
  color: #0bb;
}
#contraerRepuesto:hover
{
  color: #0bb;
}
#cerrarColumnaRepuesto:hover
{
  color: #f00;
}
#minimizarRepuesto:hover
{
  color: #0bb;
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

<ul class="nav nav-tabs"    style="background-color: #fff; margin-top: 5px; ">
  <li><a href="#inicio"     data-toggle="tab">Principal</a></li>
  <li><a href="#Historial"  data-toggle="tab">Historial</a></li>
</ul>

<div class="tab-content" >
  <div class="tab-pane fade in active" id="inicio" >

<!-- Inicio div Asignados -->
      <div class="col-md-4" id="ExpandirAsignado">
     
      <div class="col-md-12" id="cuadros">
      
      <!--Inicio Barra de herramientas de ventana-->
       <div class="col-md-12" id="barraTareas">
          <i id="cerrarColumnaAsignado" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
          <i id="expandirAsignado" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
          <i id="contraerAsignado" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
          <i id="minimizarAsignado" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
       </div>   
      <hr>
      <!--Fin Barra de herramientas de ventana-->
    <h3>Asignados (<?php echo $num_GetRegistroServicioAsignado;?>)</h3>
    <div class='table-responsive'>
      <table id='asignadoTabla' class='table table-condensed table-hover table-striped' >
        <thead>
          <tr>
            <th style='text-align: center;'>Cod. de Servicio / Nombre de Tienda</th>
          </tr>
         </thead>
          <tfoot>
            <tr>
              <th style='text-align: center;'></th>
            </tr>
          </tfoot>
        <tbody >

 <?php

 for ($Asignado=0; $Asignado < $num_GetRegistroServicioAsignado; $Asignado++)
  { 
    $assoc_GetRegistroServicioAsignado=mysql_fetch_assoc($GetRegistroServicioAsignado);
   
    $ID_ser = $assoc_GetRegistroServicioAsignado['ID_ser'];

      $tasks = new tasks;
      $getTasksByIdSer=$tasks->getTasksByIdSer($ID_ser);
      $num_getTasksByIdSer=mysql_num_rows($getTasksByIdSer);
       
  /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_GetRegistroServicioAsignado['ID_ser'].'EliminarAsignado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Registro - '.$assoc_GetRegistroServicioAsignado['ser_cod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <form action="actions-services.php" method="POST">
                     <input type="hidden" name="action" value="borrarRegistro">
                     <input type="hidden" name="ID_ser" value="'.$assoc_GetRegistroServicioAsignado['ID_ser'].'">
                      <button type="submit" class="btn btn-danger"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button>
                     </form> 
                  </div>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Eliminar */

   /* Inicio Modal Cerrar */
   echo '<div class="modal fade bs-example-modal-lg" id="'.$assoc_GetRegistroServicioAsignado['ID_ser'].'Cerrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cerrar desde Asignados - '.$assoc_GetRegistroServicioAsignado['ser_cod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                 
                    <form action="actions-services.php" method="POST">
                      <div class="alert alert-warning" role="alert">
                        <h5>
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
                          </span>
                        </h5>
                        <p>
                          Usted esta a punto de Cerrar un Registro
                        </p>
                     </div>';
                     echo  "<input type='hidden' name='action' value='cerrarAsignado'>";
                              echo " <div class='col-md-12' id='formularioInput'>
                                      <div class='col-md-4' id='formularioInput'>  
                                        <i class='material-icons' style='vertical-align: middle;'>
                                          mode_edit
                                        </i> Descripción del problema:
                                      </div> 
                                      <div class='col-md-8' id='formularioInput'> 
                                       ".$assoc_GetRegistroServicioAsignado['ser_desc']."
                                      </div> 
                                     </div>  

                                     <div class='col-md-12' id='formularioInput'>
                                        <div class='col-md-4' id='formularioInput'>  
                                          <i class='material-icons' style='vertical-align: middle;''>
                                           contact_phone
                                          </i> Contacto:
                                        </div> 
                                        <div class='col-md-8' id='formularioInput'> 
                                          <input type='text' name='ser_contacto' class='form-control' value='".$assoc_GetRegistroServicioAsignado['ser_contacto']."' disabled>
                                        </div> 
                                    </div>  

                                   <div class='col-md-12' id='formularioInput'>
                                    <div class='col-md-4' id='formularioInput'>  
                                      <i class='material-icons' style='vertical-align: middle;''>
                                       phone
                                       </i> Teléfono:
                                    </div> 
                                    <div class='col-md-8' id='formularioInput'> 
                                      <input type='text' class='form-control' name='ser_telefono' value='".$assoc_GetRegistroServicioAsignado['ser_telefono']."' disabled>
                                    </div> 
                                  </div> 

                                 <div class='col-md-12' id='formularioInput'>
                                    <div class='col-md-4' id='formularioInput'>  
                                      <i class='material-icons' style='vertical-align: middle;''>
                                       email
                                       </i> email:
                                    </div> 
                                    <div class='col-md-8' id='formularioInput'> 
                                      <input type='text' class='form-control' name='ser_mail' value='".$assoc_GetRegistroServicioAsignado['ser_mail']."' disabled>
                                    </div> 
                                </div>";



                             echo "<div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;''>
                                   person</i>
                                    Responsable:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                    <select class='form-control'  name='ser_asig' disabled>";
                                   echo  '<option value="'.$assoc_GetRegistroServicioAsignado['ser_asig'].'" selected>'.$assoc_GetRegistroServicioAsignado['usu_nombre'].' '.$assoc_GetRegistroServicioAsignado['usu_apellido'].'</option>'; 
                            echo "</select>
                                </div>
                             </div>

                             <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   priority_high
                                   </i> Prioridad:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <select class='form-control'  name='ID_pri' disabled>";
                                    echo  '<option value="'.$assoc_GetRegistroServicioAsignado['ID_pri'].'" selected>'.$assoc_GetRegistroServicioAsignado['pri_desc'].'</option>'; 
                                   
                          echo "</select>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   mode_edit
                                   </i> Solución:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                 <textarea name='ser_solucion' class='form-control' style='height: 50px;' required><?php echo $ser_solucion ?><span id='number-negative'></textarea>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   person
                                   </i> Persona conforme:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <input type='text' class='form-control' name='ser_persconforme' required><span id='number-negative'>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   receipt
                                   </i> Comprobante de conformidad:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <input type='checkbox' class='check' name='ser_conforme'>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   query_builder
                                   </i> Horas trabajadas:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <input type='time' class='form-control' name='ser_hs'>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'> 
                                 <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   attach_money
                                   </i>  Costo (ARS)(xxxxx.xx):
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <input type='text' class='form-control' name='ser_costo'>
                                </div>   
                             </div>    

                               <hr><br>
                                <div  class='col-md-12' >
                                     <H4><i class='material-icons' style='vertical-align: middle;'>touch_app</i> Seleccione los tipos de servicios en los que ha trabajado
                                    </H4>
                                 </div> ";
                               
                      

                                  $tipos_servicio     = $oOpe->tipo_servicio();
                                  $num_tse       = mysql_num_rows($tipos_servicio);
                                  for($w=0; $w<$num_tse; $w++)
                                  {
                                        $c=$w+1;
                                        $tse    = mysql_fetch_assoc($tipos_servicio);
                                        

                           
                                      echo "<div class='container-fluid'><div class='col-md-12'>";
                                        if($tse['tse_um'] != 'N/D'){
                                          $um   = ' <input type="text" class="form-control" style="width: 100px; float: left; margin: 5px;" name="rst_cant[]" size="5" placeholder="Cant. ' . $tse['tse_um'] . '">';

                                        } else {
                                          $um   = '<input type="hidden" class="form-control" style="width: 100px; float: left; margin: 5px;" name="rst_cant[]" value="0">';
                                        }        

                                          echo  "<div class='col-md-3'>";
                                              echo '<i class="material-icons" style="vertical-align: middle; float: left; margin: 5px;">filter_'.$c.'</i>
                                                       ' . $tse['tse_desc'] . '
                                                      </div>';

                                          echo  "<div class='col-md-3'>";
                                                echo  '<select  class="form-control" style="width: 100px; float: left; margin: 5px;" name="ID_tse[]" id="selectSiNo'.$assoc_GetRegistroServicioAsignado['ID_ser'].''.$tse['ID_tse'].'">
                                                        <option value="0">NO</option>
                                                        <option value="' . $tse['ID_tse'] . '">SI</option>
                                                      </select> 
                                                  </div>';
                                                    echo  "<div class='col-md-3'>";
                                                      echo '<select class="form-control" style="width: 150px; float: left; margin: 5px;" name="rst_reqmat[]">
                                                              <option selected disabled> Req. mat.? </option>
                                                              <option value="0">NO</option><option value="1">SI</option>
                                                            </select>
                                                       </div>';  
                                                echo  "<div class='col-md-3'>    
                                                   " . $um . "
                                                      </div>";
                                       echo  '</div></div>';

                                   echo "<script>
                                          $(document).ready(function(){
                                              $('#selectSiNo".$assoc_GetRegistroServicioAsignado['ID_ser']."".$tse['ID_tse']."').change(function(){
                                                  var selector = ($('select[id=selectSiNo".$assoc_GetRegistroServicioAsignado['ID_ser']."".$tse['ID_tse']."]').val());
                                                  if (selector)
                                                  {
                                                    $('#botonFalso".$assoc_GetRegistroServicioAsignado['ID_ser']."').fadeOut('slow');
                                                    $('#botonVerdadero".$assoc_GetRegistroServicioAsignado['ID_ser']."').fadeIn('slow');
                                                  }
                                              }); });
                                        </script>";

                                   }
                          
                    echo "
                        </div>";
                     
                    echo "
                      <input type='hidden' name='action' value='cerrarAsignado'>
                      <input type='hidden' name='ID_ser' value='".$assoc_GetRegistroServicioAsignado['ID_ser']."'>
                      
                           <button type='button' class='btn btn-warning' style='margin-top:10px; margin-bottom:10px; width: 100%' id='botonFalso".$assoc_GetRegistroServicioAsignado['ID_ser']."'><i class='material-icons' style='vertical-align: middle'>warning</i> Seleccione al menos un tipo de servicio</button>

                       <button type='submit' class='btn btn-success' style='margin-top:10px; margin-bottom:10px; width: 100%; display: none;' id='botonVerdadero".$assoc_GetRegistroServicioAsignado['ID_ser']."'><i class='material-icons' style='vertical-align: middle'>check_circle</i> Guardar y Firmar</button>

                        </form>
                    
                </div>
              </div>
            </div>
          </div>";
        /* Fin Modal Cerrar */

    echo "<tr>
            <th style='vertical-align: middle;'>
            
            <div id='".$assoc_GetRegistroServicioAsignado['ID_ser']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
             if ($assoc_GetRegistroServicioAsignado['pto_pedidoCod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioAsignado['ID_ser']."' href='#abierto".$assoc_GetRegistroServicioAsignado['ID_ser']."' aria-expanded='true' aria-controls='abierto".$assoc_GetRegistroServicioAsignado['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioAsignado['ser_cod']. "</b> - " .$assoc_GetRegistroServicioAsignado['cli_desc']." - ". $assoc_GetRegistroServicioAsignado['pto_pedidoCod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioAsignado['ID_ser']."' href='#abierto".$assoc_GetRegistroServicioAsignado['ID_ser']."' aria-expanded='true' aria-controls='abierto".$assoc_GetRegistroServicioAsignado['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioAsignado['ser_cod']. "</b> - " .$assoc_GetRegistroServicioAsignado['cli_desc']."</a>";
           }
            echo "</div>
            <div id='abierto".$assoc_GetRegistroServicioAsignado['ID_ser']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>";

                  //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaAsignado   = $assoc_GetRegistroServicioAsignado['obr_URL'];
                  $diremapAsignado         = explode('?', $direccionMapaAsignado);
                  if (!isset($diremapAsignado[1])) 

                  {
                      $Mobile_DetectAsignado="http://maps.google.com?daddr=".$assoc_GetRegistroServicioAsignado['obr_dir']."";
                      $direccionAsignado="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionAsignado="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectAsignado="geo:0,0?daddr=".$diremapAsignado[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectAsignado="http://maps.apple.com/maps?saddr=".$diremapAsignado[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectAsignado="maps:".$diremapAsignado[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectAsignado = "http://maps.google.com?daddr=".$diremapAsignado[1]."";
                      } 
                    }  
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo
                      echo "   <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_GetRegistroServicioAsignado['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_GetRegistroServicioAsignado['obr_desc']."</a></p>


               <p><strong><i class='material-icons' style='vertical-align: middle'>store</i> Tienda: </strong><a href='".$Mobile_DetectAsignado."'> ".$assoc_GetRegistroServicioAsignado['obr_desc']."  ".$assoc_GetRegistroServicioAsignado['obr_desc']."</a> ".$assoc_GetRegistroServicioAsignado['obr_dir']." ".$direccionAsignado."</p>


              <p><i class='material-icons' style='vertical-align: middle'>assignment_late</i><strong> Prioridad: </strong> ".$assoc_GetRegistroServicioAsignado['pri_desc']." </p>

          <p><i class='material-icons' style='vertical-align: middle'>date_range</i> <strong>Fecha de Apertura:  </strong>".$assoc_GetRegistroServicioAsignado['ser_fecin']." </p>

                <p><i class='material-icons' style='vertical-align: middle'>alarm</i> <strong>Hora de Apertura: </strong> ".$assoc_GetRegistroServicioAsignado['ser_hourin']." </p>


              <p> <i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Descripción:</strong> ".$assoc_GetRegistroServicioAsignado['ser_desc']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>accessibility</i> <strong>Contacto:  </strong> ".$assoc_GetRegistroServicioAsignado['ser_contacto']."</p>

              <p> <i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong> <a href='tel:".$assoc_GetRegistroServicioAsignado['ser_telefono']."'> ".$assoc_GetRegistroServicioAsignado['ser_telefono']." </a></p>

              <p><i class='material-icons' style='vertical-align: middle'>email</i> <strong>Email: </strong> <a href='mailto:".$assoc_GetRegistroServicioAsignado['ser_mail']."'> ".$assoc_GetRegistroServicioAsignado['ser_mail']."</a></p>";


               if ($assoc_GetRegistroServicioAsignado['pto_pedidoCod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio:</strong> ".$assoc_GetRegistroServicioAsignado['pto_pedidoCod']."</p>";
                 } 
                             echo "<p><i class='material-icons' style='vertical-align: middle'>account_circle</i> <strong>Asignado: </strong> ".$assoc_GetRegistroServicioAsignado['usu_nombre']." ".$assoc_GetRegistroServicioAsignado['usu_apellido']." </p>
               <div class='col-md-12'>
                 <div class='col-md-4' id='botones'>
                  <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' disabled data-placement='top' data-target='#".$assoc_GetRegistroServicioAsignado['ID_ser']."EliminarAsignado' id='botonDentroDeDiv' >
                    <i class='material-icons'>delete_forever</i> 
                  </button>
                 </div> 

                 <div class='col-md-4' id='botones'>
                  <a href='modify-services-request.php?ID_ser=".base64_encode((12344*($assoc_GetRegistroServicioAsignado['ID_ser']))/12)."'>
                     <button class='btn btn-primary' data-toggle='modal' title='Modificar' data-placement='top' data-target='#".$assoc_GetRegistroServicioAsignado['ID_ser']."ModificarCerrados' id='botonDentroDeDiv' >
                      <i class='material-icons'>
                        edit
                      </i>
                     </button>
                 </a>
                </div> 

                 <div class='col-md-4' id='botones'>
                    <button type='button' class='btn btn-success' data-toggle='modal' title='Cerrar' data-placement='top' data-target='#".$assoc_GetRegistroServicioAsignado['ID_ser']."Cerrar' id='botonDentroDeDiv' >
                <i class='material-icons'>
                  check_circle 
                </i>  
               </button>
            </div> 
             </div> 
            </th>
          </tr>";
 }
 
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' colspan='3'>Cod. de Servicio / Nombre de Tienda</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
 </div>
<!-- Fin div Asignado -->



<!-- Inicio div Pendientes-->
      <div class="col-md-4" id="ExpandirPendiente">
     
      <div class="col-md-12" id="cuadros">
      
      <!--Inicio Barra de herramientas de ventana-->
       <div class="col-md-12" id="barraTareas">
          <i id="cerrarColumnaPendiente" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
          <i id="expandirPendiente" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
          <i id="contraerPendiente" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
          <i id="minimizarPendiente" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
       </div>   
      <hr>
      <!--Fin Barra de herramientas de ventana-->
    <h3>Pendientes (<?php echo $num_GetRegistroServicioPendientes;?>)</h3>

    <div class='table-responsive'>
      <table id='pendienteTabla' class='table table-condensed table-hover table-striped'>
        <thead>
          <tr>
            <th style='text-align: center;'>Cod. de Servicio / Nombre de Tienda</th>
          </tr>
         </thead>
          <tfoot>
            <tr>
              <th style='text-align: center;'></th>
            </tr>
          </tfoot>
        <tbody >

 <?php

 for ($Pendientes=0; $Pendientes < $num_GetRegistroServicioPendientes; $Pendientes++)
  { 
    $assoc_GetRegistroServicioPendientes=mysql_fetch_assoc($GetRegistroServicioPendientes);
    $tipos_servicioPendientes     = $oOpe->tipo_servicio();
    $num_tsePendientes       = mysql_num_rows($tipos_servicioPendientes);
    $ID_ser = $assoc_GetRegistroServicioPendientes['ID_ser'];
    


  /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_GetRegistroServicioPendientes['ID_ser'].'EliminarPendientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Registro - '.$assoc_GetRegistroServicioPendientes['ser_cod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <form action="actions-services.php" method="POST">
                     <input type="hidden" name="action" value="borrarRegistro">
                     <input type="hidden" name="ID_ser" value="'.$assoc_GetRegistroServicioPendientes['ID_ser'].'">
                      <button type="submit" disabled  class="btn btn-danger"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button>
                     </form> 
                  </div>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Eliminar */




  /* Inicio Modal Cerrar */
   echo '<div class="modal fade bs-example-modal-lg" id="'.$assoc_GetRegistroServicioPendientes['ID_ser'].'Cerrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cerrar - '.$assoc_GetRegistroServicioPendientes['ser_cod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                 
                    <form action="actions-services.php" method="POST">
                      <div class="alert alert-warning" role="alert">
                        <h5>
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
                          </span>
                        </h5>
                        <p>
                          Usted esta a punto de Cerrar un Registro
                        </p>
                     </div>';

                              echo " <div class='col-md-12' id='formularioInput'>
                                      <div class='col-md-4' id='formularioInput'>  
                                        <i class='material-icons' style='vertical-align: middle;'>
                                          mode_edit
                                        </i> Descripción del problema:
                                      </div> 
                                      <div class='col-md-8' id='formularioInput'> 
                                       ".$assoc_GetRegistroServicioPendientes['ser_desc']."
                                      </div> 
                                     </div>  

                                     <div class='col-md-12' id='formularioInput'>
                                        <div class='col-md-4' id='formularioInput'>  
                                          <i class='material-icons' style='vertical-align: middle;''>
                                           contact_phone
                                          </i> Contacto:
                                        </div> 
                                        <div class='col-md-8' id='formularioInput'> 
                                          <input type='text' name='ser_contacto' class='form-control' value='".$assoc_GetRegistroServicioPendientes['ser_contacto']."' disabled>
                                        </div> 
                                    </div>  

                                   <div class='col-md-12' id='formularioInput'>
                                    <div class='col-md-4' id='formularioInput'>  
                                      <i class='material-icons' style='vertical-align: middle;''>
                                       phone
                                       </i> Teléfono:
                                    </div> 
                                    <div class='col-md-8' id='formularioInput'> 
                                      <input type='text' class='form-control' name='ser_telefono' value='".$assoc_GetRegistroServicioPendientes['ser_telefono']."' disabled>
                                    </div> 
                                  </div> 

                                 <div class='col-md-12' id='formularioInput'>
                                    <div class='col-md-4' id='formularioInput'>  
                                      <i class='material-icons' style='vertical-align: middle;''>
                                       email
                                       </i> email:
                                    </div> 
                                    <div class='col-md-8' id='formularioInput'> 
                                      <input type='text' class='form-control' name='ser_mail' value='".$assoc_GetRegistroServicioPendientes['ser_mail']."' disabled>
                                    </div> 
                                </div>";



                             echo "<div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;''>
                                   person</i>
                                    Responsable:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                    <select class='form-control'  name='ser_asig' disabled>";
                                   echo  '<option value="'.$assoc_GetRegistroServicioPendientes['ser_asig'].'" selected>'.$assoc_GetRegistroServicioPendientes['usu_nombre'].' '.$assoc_GetRegistroServicioPendientes['usu_apellido'].'</option>'; 
                            echo "</select>
                                </div>
                             </div>

                             <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   priority_high
                                   </i> Prioridad:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <select class='form-control'  name='ID_pri' disabled>";
                                    echo  '<option value="'.$assoc_GetRegistroServicioPendientes['ID_pri'].'" selected>'.$assoc_GetRegistroServicioPendientes['pri_desc'].'</option>'; 
                                   
                          echo "</select>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   mode_edit
                                   </i> Solución:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                 <textarea name='ser_solucion' class='form-control' style='height: 50px;' required><?php echo $ser_solucion ?><span id='number-negative'></textarea>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   person
                                   </i> Persona conforme:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <input type='text' class='form-control' name='ser_persconforme' required><span id='number-negative'>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   receipt
                                   </i> Comprobante de conformidad:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <input type='checkbox' class='check' name='ser_conforme'>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'>
                                <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   query_builder
                                   </i> Horas trabajadas:
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <input type='time' class='form-control' name='ser_hs'>
                                </div> 
                              </div> 

                              <div class='col-md-12' id='formularioInput'> 
                                 <div class='col-md-4' id='formularioInput'>  
                                  <i class='material-icons' style='vertical-align: middle;'>
                                   attach_money
                                   </i>  Costo (ARS)(xxxxx.xx):
                                </div> 
                                <div class='col-md-8' id='formularioInput'> 
                                  <input type='text' class='form-control' name='ser_costo'>
                                </div>   
                             </div>    


                               <hr><br>
                                <div  class='col-md-12' >
                                     <H4><i class='material-icons' style='vertical-align: middle;'>touch_app</i> Seleccione los tipos de servicios en los que ha trabajado
                                    </H4>
                                 </div> ";
                               
                                   
                                $tipos_servicioB     = $oOpe->tipo_servicio();
                                $num_tseB       = mysql_num_rows($tipos_servicioB);

                                  for($wB=0; $wB<$num_tseB; $wB++)
                                  {
                                        $cB=$wB+1;
                                        $tseB    = mysql_fetch_assoc($tipos_servicioB);
                                        
                           
                                      echo "<div class='container-fluid'><div class='col-md-12'>";
                                        if($tseB['tse_um'] != 'N/D'){
                                          $umB   = ' <input type="text" class="form-control" style="width: 100px; float: left; margin: 5px;" name="rst_cant[]" size="5" placeholder="Cant. ' . $tseB['tse_um'] . '">';

                                        } else {
                                          $umB   = '<input type="hidden" class="form-control" style="width: 100px; float: left; margin: 5px;" name="rst_cant[]" value="0">';
                                        }        

                                          echo  "<div class='col-md-3'>";
                                              echo '<i class="material-icons" style="vertical-align: middle; float: left; margin: 5px;">filter_'.$cB.'</i>
                                                       ' . $tseB['tse_desc'] . '
                                                      </div>';

                                          echo  "<div class='col-md-3'>";
                                                echo  '<select  class="form-control" style="width: 100px; float: left; margin: 5px;" name="ID_tse[]" id="selectSiNo'.$assoc_GetRegistroServicioPendientes['ID_ser'].''.$tseB['ID_tse'].'">
                                                        <option value="0">NO</option>
                                                        <option value="' . $tseB['ID_tse'] . '">SI</option>
                                                      </select> 
                                                  </div>';
                                                    echo  "<div class='col-md-3'>";
                                                      echo '<select class="form-control" style="width: 150px; float: left; margin: 5px;" name="rst_reqmat[]">
                                                              <option selected disabled> Req. mat.? </option>
                                                              <option value="0">NO</option><option value="1">SI</option>
                                                            </select>
                                                       </div>';  
                                                echo  "<div class='col-md-3'>    
                                                   " . $umB . "
                                                      </div>";
                                       echo  '</div></div>';

                                   echo "<script>
                                          $(document).ready(function(){
                                              $('#selectSiNo".$assoc_GetRegistroServicioPendientes['ID_ser']."".$tseB['ID_tse']."').change(function(){
                                                  var selector = ($('select[id=selectSiNo".$assoc_GetRegistroServicioPendientes['ID_ser']."".$tseB['ID_tse']."]').val());
                                                  if (selector)
                                                  {
                                                    $('#botonFalso".$assoc_GetRegistroServicioPendientes['ID_ser']."').fadeOut('slow');
                                                    $('#botonVerdadero".$assoc_GetRegistroServicioPendientes['ID_ser']."').fadeIn('slow');
                                                  }
                                              }); });
                                        </script>";

                                   }
                 
                     
                    echo " </div>  ";
                     
                    echo  "
                      <input type='hidden' name='action' value='cerrar'>
                      <input type='hidden' name='ID_ser' value='".$assoc_GetRegistroServicioPendientes['ID_ser']."'>
                       <input type='hidden' name='ser_cod' value='".$assoc_GetRegistroServicioPendientes['ser_cod']."'>
                         <button type='button' class='btn btn-warning' style='margin-top:10px; margin-bottom:10px; width: 100%' id='botonFalso".$assoc_GetRegistroServicioPendientes['ID_ser']."'><i class='material-icons' style='vertical-align: middle'>warning</i> Seleccione al menos un tipo de servicio</button>

                       <button type='submit' class='btn btn-success' style='margin-top:10px; margin-bottom:10px; width: 100%; display: none;' id='botonVerdadero".$assoc_GetRegistroServicioPendientes['ID_ser']."'><i class='material-icons' style='vertical-align: middle'>check_circle</i> Guardar y Firmar</button>
                        </form>
                    
                </div>
              </div>
            </div>
          </div>";
        /* Fin Modal Cerrar */



    echo "<tr>
            <th style='vertical-align: middle;'>
            <div id='".$assoc_GetRegistroServicioPendientes['ID_ser']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
             if ($assoc_GetRegistroServicioPendientes['pto_pedidoCod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioPendientes['ID_ser']."' href='#abierto".$assoc_GetRegistroServicioPendientes['ID_ser']."' aria-expanded='true' aria-controls='abierto".$assoc_GetRegistroServicioPendientes['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioPendientes['ser_cod']. "</b> - " .$assoc_GetRegistroServicioPendientes['cli_desc']." - ". $assoc_GetRegistroServicioPendientes['pto_pedidoCod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioPendientes['ID_ser']."' href='#abierto".$assoc_GetRegistroServicioPendientes['ID_ser']."' aria-expanded='true' aria-controls='abierto".$assoc_GetRegistroServicioPendientes['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioPendientes['ser_cod']. "</b> - " .$assoc_GetRegistroServicioPendientes['cli_desc']."</a>";
           }
            echo " </div>
            <div id='abierto".$assoc_GetRegistroServicioPendientes['ID_ser']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

             <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_GetRegistroServicioPendientes['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_GetRegistroServicioPendientes['obr_desc']."</a></p>";

                  //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaPendientes=$assoc_GetRegistroServicioPendientes['obr_URL'];
                  $diremapPendientes         = explode('?', $direccionMapaPendientes);
                   if (!isset($diremapPendientes[1])) 

                  {
                      $Mobile_DetectPendientes="http://maps.google.com?daddr=".$assoc_GetRegistroServicioPendientes['obr_dir']."";
                      $direccionPendientes="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                        $direccionPendientes="";
                        if( $detect->isAndroid() ) {
                         // Android
                         $Mobile_DetectPendientes="geo:0,0?daddr=".$diremapPendientes[1]."";
                        } elseif ( $detect->isIphone() ) {
                         // iPhone
                         $Mobile_DetectPendientes="http://maps.apple.com/maps?saddr=".$diremapPendientes[1]."";
                        } elseif ( $detect->isWindowsphone() ) {
                         // Windows Phone
                         $Mobile_DetectPendientes="maps:".$diremapPendientes[1]."";
                        } else{
                         // Por defecto
                         $Mobile_DetectPendientes= "http://maps.google.com?daddr=".$diremapPendientes[1]."";
                        } 
                   }     
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

             echo "  <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectPendientes."'> ".$assoc_GetRegistroServicioPendientes['obr_desc']."   ".$assoc_GetRegistroServicioPendientes['obr_desc']." </a> ".$assoc_GetRegistroServicioPendientes['obr_dir']." ".$direccionPendientes."</p>

              <p><i class='material-icons' style='vertical-align: middle'>assignment_late</i> <strong>Prioridad: </strong> ".$assoc_GetRegistroServicioPendientes['pri_desc']." </p>

               <p><i class='material-icons' style='vertical-align: middle'>date_range</i> <strong>Fecha de Apertura: </strong> ".$assoc_GetRegistroServicioPendientes['ser_fecin']."</p>

                <p><i class='material-icons' style='vertical-align: middle'>alarm</i> <strong>Hora de Apertura: </strong> ".$assoc_GetRegistroServicioPendientes['ser_hourin']."</p>


              <p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Descripción: </strong>".$assoc_GetRegistroServicioPendientes['ser_desc']."</p>

              <p><i class='material-icons' style='vertical-align: middle'>accessibility</i> <strong>Contacto:</strong>".$assoc_GetRegistroServicioPendientes['ser_contacto']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono: </strong><a href='tel:".$assoc_GetRegistroServicioPendientes['ser_telefono']."'> ".$assoc_GetRegistroServicioPendientes['ser_telefono']." </a></p>

              <p><i class='material-icons' style='vertical-align: middle'>email</i> <strong>Email: </strong><a href='mailto:".$assoc_GetRegistroServicioPendientes['ser_mail']."'>".$assoc_GetRegistroServicioPendientes['ser_mail']." </a></p>";


               if ($assoc_GetRegistroServicioPendientes['pto_pedidoCod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio: </strong>".$assoc_GetRegistroServicioPendientes['pto_pedidoCod']."</p>";
                 } 
               

                             echo "<p> <i class='material-icons' style='vertical-align: middle'>account_circle</i> <strong>Asignado: </strong> ".$assoc_GetRegistroServicioPendientes['usu_nombre']." ".$assoc_GetRegistroServicioPendientes['usu_apellido']." </p>

               <div class='col-md-12'>
                 <div class='col-md-4' id='botones'>
                  <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' disabled  data-placement='top' data-target='#".$assoc_GetRegistroServicioPendientes['ID_ser']."EliminarAsignado' id='botonDentroDeDiv' >
                    <i class='material-icons'>delete_forever</i> 
                  </button>
                 </div> 

                 <div class='col-md-4' id='botones'>
                  <a href='modify-services-request.php?ID_ser=".base64_encode((12344*($assoc_GetRegistroServicioPendientes['ID_ser']))/12)."'>
                     <button class='btn btn-primary' data-toggle='modal' title='Modificar' data-placement='top' data-target='#".$assoc_GetRegistroServicioPendientes['ID_ser']."ModificarCerrados' id='botonDentroDeDiv' >
                      <i class='material-icons'>
                        edit
                      </i>
                     </button>
                 </a>
                </div> 

                 <div class='col-md-4' id='botones'>
                    <button type='button' class='btn btn-success' data-toggle='modal' title='Cerrar' data-placement='top' data-target='#".$assoc_GetRegistroServicioPendientes['ID_ser']."Cerrar' id='botonDentroDeDiv' >
                <i class='material-icons'>
                  check_circle 
                </i>  
               </button>
            </div> 

            </div>  


            </th>
          </tr>";
 }
 
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;'>Cod. de Servicio / Nombre de Tienda</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
 </div>
<!-- Fin div Pendientes -->

<!-- Inicio div Repuestos -->
      <div class="col-md-4" id="ExpandirRepuesto">
        <div class="col-md-12" id="cuadros">
          <!--Inicio Barra de herramientas de ventana-->
           <div class="col-md-12" id="barraTareas">
              <i id="cerrarColumnaRepuesto" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
              <i id="expandirRepuesto" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
              <i id="contraerRepuesto" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
              <i id="minimizarRepuesto" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
           </div>   
          <hr>
<!--Fin Barra de herramientas de ventana-->
    <h3>Esperando Repuestos (<?php echo $num_GetRegistroServicioRepuestos;?>)</h3>

    <div class='table-responsive'>
      <table id='repuestoTabla' class='table table-condensed table-hover table-striped'>
        <thead>
          <tr>
            <th style='text-align: center;'>Cod. de Servicio / Nombre de Tienda</th>
          </tr>
         </thead>
          <tfoot>
            <tr>
              <th style='text-align: center;'></th>
            </tr>
          </tfoot>
        <tbody >

 <?php

 for ($Repuestos=0; $Repuestos < $num_GetRegistroServicioRepuestos; $Repuestos++)
  { 
    $assoc_GetRegistroServicioRepuestos=mysql_fetch_assoc($GetRegistroServicioRepuestos);
      $tipos_servicioRepuestos     = $oOpe->tipo_servicio();
    $num_tseRepuestos       = mysql_num_rows($tipos_servicioRepuestos);
    $ID_ser = $assoc_GetRegistroServicioRepuestos['ID_ser'];
    
        
  /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_GetRegistroServicioRepuestos['ID_ser'].'EliminarRepuestos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Registro - '.$assoc_GetRegistroServicioRepuestos['ser_cod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <form action="actions-services.php" method="POST">
                     <input type="hidden" name="action" value="borrarRegistro">
                     <input type="hidden" name="ID_ser" value="'.$assoc_GetRegistroServicioRepuestos['ID_ser'].'">
                      <button type="submit" class="btn btn-danger"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button>
                     </form> 
                  </div>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Eliminar */


  /* Inicio Modal Cerrar */
   echo '<div class="modal fade bs-example-modal-lg" id="'.$assoc_GetRegistroServicioRepuestos['ID_ser'].'Cerrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cerrar - '.$assoc_GetRegistroServicioRepuestos['ser_cod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">';
                 
                 echo "<div class='alert alert-warning' role='alert' style='text-align: center;' >
                    <h1><i class='material-icons' style='vertical-align: middle; font-size:30px;'>warning</i>  No puede cerrar un servicio con un pedido de presupuesto por repuestos iniciado.<br> COMUNIQUESE CON ADMINISTRACIÓN.</h1>
                    </div>";

                echo '</div>';
                echo " <input type='hidden' name='action' value='cerrar'>
                      <input type='hidden' name='ID_ser' value='".$assoc_GetRegistroServicioRepuestos['ID_ser']."'>
                       
                        </form>
                    
                </div>
              </div>
            </div>
          </div>";
        /* Fin Modal Cerrar */


    echo "<tr>
            <th style='vertical-align: middle;'>
            <div id='".$assoc_GetRegistroServicioRepuestos['ID_ser']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
             if ($assoc_GetRegistroServicioRepuestos['pto_pedidoCod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioRepuestos['ID_ser']."' href='#abierto".$assoc_GetRegistroServicioRepuestos['ID_ser']."' aria-expanded='true' aria-controls='abierto".$assoc_GetRegistroServicioRepuestos['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioRepuestos['ser_cod']. "</b> - " .$assoc_GetRegistroServicioRepuestos['cli_desc']." - ". $assoc_GetRegistroServicioRepuestos['pto_pedidoCod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioRepuestos['ID_ser']."' href='#abierto".$assoc_GetRegistroServicioRepuestos['ID_ser']."' aria-expanded='true' aria-controls='abierto".$assoc_GetRegistroServicioRepuestos['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioRepuestos['ser_cod']. "</b> - " .$assoc_GetRegistroServicioRepuestos['cli_desc']."</a>";
           }
            echo "</div>
            <div id='abierto".$assoc_GetRegistroServicioRepuestos['ID_ser']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

                 <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_GetRegistroServicioRepuestos['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_GetRegistroServicioRepuestos['obr_desc']."</a></p>";

                 //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaRepuestos=$assoc_GetRegistroServicioRepuestos['obr_URL'];
                  $diremapRepuestos         = explode('?', $direccionMapaRepuestos);
                  if (!isset($diremapRepuestos[1])) 
                  {
                      $Mobile_DetectRepuestos="http://maps.google.com?daddr=".$assoc_GetRegistroServicioRepuestos['obr_dir']."";
                       $direccionRepuestos="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                        $direccionRepuestos="";
                        if( $detect->isAndroid() ) {
                         // Android
                         $Mobile_DetectRepuestos="geo:0,0?daddr=".$diremapRepuestos[1]."";
                        } elseif ( $detect->isIphone() ) {
                         // iPhone
                         $Mobile_DetectRepuestos="http://maps.apple.com/maps?saddr=".$diremapRepuestos[1]."";
                        } elseif ( $detect->isWindowsphone() ) {
                         // Windows Phone
                         $Mobile_DetectRepuestos="maps:".$diremapRepuestos[1]."";
                        } else{
                         // Por defecto
                         $Mobile_DetectRepuestos = "http://maps.google.com?daddr=".$diremapRepuestos[1]."";
                        } 
                     }    
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                       echo "  <p><i class='material-icons' style='vertical-align: middle'>store</i><strong> Tienda:</strong><a href='".$Mobile_DetectRepuestos."'>".$assoc_GetRegistroServicioRepuestos['obr_desc']." ".$assoc_GetRegistroServicioRepuestos['obr_desc']." </a> ".$assoc_GetRegistroServicioRepuestos['obr_dir']." ".$direccionRepuestos."</p>


              <p> <strong> <i class='material-icons' style='vertical-align: middle'>assignment_late</i> Prioridad:</strong>".$assoc_GetRegistroServicioRepuestos['pri_desc']." </p>


                <p><i class='material-icons' style='vertical-align: middle'>date_range</i> <strong>Fecha de Apertura:</strong>  ".$assoc_GetRegistroServicioRepuestos['ser_fecin']." </p>

                <p><i class='material-icons' style='vertical-align: middle'>alarm</i> <strong>Hora de Apertura: </strong> ".$assoc_GetRegistroServicioRepuestos['ser_hourin']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>assignment</i><strong> Descripción: </strong>  ".$assoc_GetRegistroServicioRepuestos['ser_desc']."</p>

              <p> <i class='material-icons' style='vertical-align: middle'>accessibility</i><strong> Contacto: </strong> ".$assoc_GetRegistroServicioRepuestos['ser_contacto']."</p>

              <p><i class='material-icons' style='vertical-align: middle'>phone</i><strong> Telefono:  </strong><a href='tel:".$assoc_GetRegistroServicioRepuestos['ser_telefono']."'>  ".$assoc_GetRegistroServicioRepuestos['ser_telefono']."</a></p>

              <p><i class='material-icons' style='vertical-align: middle'>email</i><strong> Email: </strong><a href='mailto:".$assoc_GetRegistroServicioRepuestos['ser_mail']."'> ".$assoc_GetRegistroServicioRepuestos['ser_mail']." </a></p>";


                               if ($assoc_GetRegistroServicioRepuestos['pto_pedidoCod']=="")
                                {
                                 
                                }
                                else
                                 {
                                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i><strong> Codigo de Servicio:</strong> ".$assoc_GetRegistroServicioRepuestos['pto_pedidoCod']."</p>";
                                 } 
                               

                             echo "<p> <i class='material-icons' style='vertical-align: middle'>account_circle</i> <strong> Asignado:</strong>".$assoc_GetRegistroServicioRepuestos['usu_nombre']." ".$assoc_GetRegistroServicioRepuestos['usu_apellido']." </p>

                  <div class='col-md-12'>
                 <div class='col-md-4' id='botones'>
                  <button type='button' disabled  class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_GetRegistroServicioRepuestos['ID_ser']."EliminarAsignado' id='botonDentroDeDiv' >
                    <i class='material-icons'>delete_forever</i> 
                  </button>
                 </div> 

                 <div class='col-md-4' id='botones'>
                  <a href='modify-services-request.php?ID_ser=".base64_encode((12344*($assoc_GetRegistroServicioRepuestos['ID_ser']))/12)."'>
                     <button class='btn btn-primary' data-toggle='modal' title='Modificar' data-placement='top' data-target='#".$assoc_GetRegistroServicioRepuestos['ID_ser']."ModificarCerrados' id='botonDentroDeDiv' >
                      <i class='material-icons'>
                        edit
                      </i>
                     </button>
                 </a>
                </div> 
                   <div class='col-md-4' id='botones'>
                    <button type='button' class='btn btn-success' data-toggle='modal' title='Cerrar' data-placement='top' data-target='#".$assoc_GetRegistroServicioRepuestos['ID_ser']."Cerrar' id='botonDentroDeDiv' >
                <i class='material-icons'>
                  check_circle 
                </i>  
               </button>
            </div> 
            </div>  
            </th>
          </tr>";
 }
 
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' >Cod. de Servicio / Nombre de Tienda</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
 
<!-- Fin div Pendientes -->



</div>
 </div>



<div class="tab-pane fade" id="Historial">   
  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-2" style="background-color: #fff;">
             <div class="col-md-12" style="margin-top: 15px;">
         <h5 style="margin: 5px;"><strong>BUSCAR POR CODIGO:</strong></h5>
         
         <input type="text" name="codigo" class="form-control" id="codigo"></input> 
         <button  type='button' class='btn btn-success' title='buscar'  id='buscar' name='buscar' data-placement='top' style='margin-top: 10px; width: 100%;'>
           <i class='material-icons center'>
             autorenew
            </i>
            Buscar
         
            
            <br>
             </div>  
               <br>
                <HR class='negra'>
                 <br>
        <div class="col-md-12" style="margin-top: 15px;">
          <h4>Filtrar por: </h4>
        </div> 
        <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON CLIENTES-->
          <div class='col-md-12' name='formulario_cliente' class='formulario_cliente' id='formulario_cliente' style="margin-top: 15px;">
            <select class='form-control' name='filtro_cliente' id='filtro_cliente'>
              <option selected disabled>CLIENTES:</option>
               <?php 
                $getRegistroServiciosHistorialNEClientes = $registro_servicio->getRegistroServiciosHistorialNEClientesUser($ID_usu);
                $num_getRegistroServiciosHistorialNEClientes = mysql_num_rows($getRegistroServiciosHistorialNEClientes);
                for ($clientei=0; $clientei < $num_getRegistroServiciosHistorialNEClientes; $clientei++)
                 { 
                    $assoc_getRegistroServiciosHistorialNEClientes = mysql_fetch_assoc($getRegistroServiciosHistorialNEClientes);

                    echo "<option value='".$assoc_getRegistroServiciosHistorialNEClientes['ID_cli']."'>".$assoc_getRegistroServiciosHistorialNEClientes['cli_desc']."</option>";
                 }
                 ?>
             </select> 
          </div>
          <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON CLIENTES-->

          <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON TIENDA-->
          <div class='col-md-12' name='formulario_tienda' class='formulario_tienda' id='formulario_tienda' style="margin-top: 15px;">
             <select class='form-control' name='filtro_tienda' id='filtro_tienda'>
               <option selected disabled>TIENDAS:</option>
             </select> 
          </div>
              <script language="javascript">
                $(document).ready(function(){
                   $("#filtro_cliente").change(function () {
                           $("#filtro_cliente option:selected").each(function () {
                            elegido=$(this).val();
                            $.post("registroServicio-combosDependientes-user.php", { elegido: elegido }, function(data){
                            $("#filtro_tienda").html(data);
                            });            
                        });
                   })
                });
              </script>
            <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON CLIENTES-->

          <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON ESTADOS-->
          <div class='col-md-12' name='formulario_Estados' class='formulario_Estados' id='formulario_Estados' style="margin-top: 15px;">
             <select class='form-control' name='filtro_estados' id='filtro_estados'>
               <option selected disabled>ESTADOS:</option>
                 <?php 
                  $getRegistroServiciosHistorialEstados = $registro_servicio->getRegistroServiciosHistorialEstadosUser($ID_usu);
                  $num_getRegistroServiciosHistorialEstados = mysql_num_rows($getRegistroServiciosHistorialEstados);
                  for ($estadosi=0; $estadosi < $num_getRegistroServiciosHistorialEstados; $estadosi++)
                   { 
                      $assoc_getRegistroServiciosHistorialEstados = mysql_fetch_assoc($getRegistroServiciosHistorialEstados);

                      echo "<option value='".$assoc_getRegistroServiciosHistorialEstados['ID_sta']."'>".$assoc_getRegistroServiciosHistorialEstados['sta_desc']."</option>";
                   }
                   ?>
             </select> 
          </div>
          <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON ESTADOS-->

          <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON PRIORIDADES-->
          <div class='col-md-12'  name='formulario_Prioridad' class='formulario_Prioridad' id='formulario_Prioridad' style="margin-top: 15px;">
             <select class='form-control' name='filtro_Prioridad' id='filtro_Prioridad'>
               <option selected disabled>PRIORIDAD:</option>
                 <?php 
                  $getRegistroServiciosHistorialPrioridad = $registro_servicio->getRegistroServiciosHistorialPrioridadUser($ID_usu);
                  $num_getRegistroServiciosHistorialPrioridad = mysql_num_rows($getRegistroServiciosHistorialPrioridad);
                  for ($prioridadi=0; $prioridadi < $num_getRegistroServiciosHistorialPrioridad; $prioridadi++)
                   { 
                      $assoc_getRegistroServiciosHistorialPrioridad = mysql_fetch_assoc($getRegistroServiciosHistorialPrioridad);

                      echo "<option value='".$assoc_getRegistroServiciosHistorialPrioridad['ID_pri']."'>".$assoc_getRegistroServiciosHistorialPrioridad['pri_desc']."</option>";
                   }
                   ?>
             </select> 
          </div>
          <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON PRIORIDADES-->

          

          <!--INICIO BOTON FILTRAR-->
          <div class='col-md-12'  name='BotonFiltrar' class='BotonFiltrar' id='BotonFiltrar' style="margin-top: 15px; ">
            <button class='btn btn-success' style="width: 100%; height: 100px;" title='filtrar'  id='filtrar' name='filtrar' >
              <i class="material-icons">
                filter_list
              </i> 
              Filtrar
              <br>
              <img src=images/cargando4.gif id='cargandoBoton' style="display: none; width: 100%; height: auto;" > 
            </button>
            
          </div>
          <!--FIN BOTON FILTRAR-->

          

           <!--INICIO LIMPIAR FILTROS-->
           <div class='col-md-12'  name='limpiar' class='limpiar' id='limpiar' style=" margin-bottom: 15px;">
              <button  type='button' class='btn btn-default' title='limpiarFiltros'  id='limpiarFiltros' name='limpiarFiltros' data-placement='top' style='margin-top: 10px; width: 100%;'>
                <i class='material-icons center'>
                 layers_clear
                </i>
                 Limpiar filtros
              </button>
          </div>
           <!--FIN LIMPIAR FILTROS-->
        </div>
          <div class="col-md-10" style="background-color: #fff;">
                 <div  name='cargaexterna' class='cargaexterna' id='cargaexterna'">
                 </div>
          </div>
        </div>     
      </div>
    </div> 

  </div>  

</div>

<!-- Fin: Div general-->

<!--Inicio: Jquery-->  
<script>
  $('.collapse').collapse()

  // Inicio: barra cargando de ajax
  var cargandoBoton = $("#cargandoBoton");

  $(document).ajaxStart(function() {
    cargandoBoton.show();
  });

  $(document).ajaxSuccess(function() {
    cargandoBoton.hide();
  });
// Fin: barra cargando de ajax 
</script>
<!--Fin: Jquery-->  

<?php

  echo '<script>

               $("#limpiarFiltros").click(function(evento)
               {
                 $("#filtro_cliente").prop("selectedIndex",0);
                 $("#filtro_tienda").prop("selectedIndex",0);
                 $("#filtro_estados").prop("selectedIndex",0);
                 $("#filtro_Prioridad").prop("selectedIndex",0);
                 $("#filtro_Asignados").prop("selectedIndex",0);
               });

               $(document).ready(function(evento){

                  $("#cargarFiltros").click(function(evento){
                        evento.preventDefault();
                        var ID_cli       = "vacio";
                        var ID_obr       = "vacio";
                        var ID_sta       = "vacio";
                        var ID_pri       = "vacio";
                        var ser_asig     = "vacio";
                            $("#cargaexterna").load
                        ("registroServicio-filtro-user.php", {
                                                    ID_cli : ID_cli,
                                                    ID_obr: ID_obr,
                                                    ID_sta: ID_sta,
                                                    ID_pri: ID_pri,
                                                    ser_asig: ser_asig
                                                  }, function(){
                         });
 }); 


                        $("#filtrar").click(function(evento){
                          
                          if ($("#filtro_Prioridad").val()!=null) {
                            var ID_pri      = "ID_pri="+$("#filtro_Prioridad").val();
                          }
                         else
                         {
                          var ID_pri      = "vacio";
                         }


                          if ($("#filtro_Asignados").val()!=null) {
                            var ser_asig      = "ser_asig="+$("#filtro_Asignados").val();
                          }
                         else
                         {
                          var ser_asig      = "vacio";
                         }

                         

                         if ($("#filtro_cliente").val()!=null) {
                          var ID_cli            = "ID_cli="+$("#filtro_cliente").val();
                          }
                           else
                         {
                          var ID_cli      = "vacio";
                         }

                         if ($("#filtro_tienda").val()!=null) {
                          var ID_obr            = "ID_obr="+$("#filtro_tienda").val();
                          }
                          else
                           {
                          var ID_obr      = "vacio";
                         }
                            

                          if ($("#filtro_estados").val() !=null)

                           { 
                            var ID_sta            = "ID_sta="+$("#filtro_estados").val();
                          }
                          else
                           {
                          var ID_sta      = "vacio";
                           }     
                        

                           
                  
                           evento.preventDefault();
                         $("#cargaexterna").load
                        ("registroServicio-filtro-user.php", {
                                                    ID_cli : ID_cli,
                                                    ID_obr: ID_obr,
                                                    ID_sta: ID_sta,
                                                    ID_pri: ID_pri,
                                                    ser_asig: ser_asig
                                                  }, function(){

                      });
                        });

                    });
  </script>';

  

 echo '<script>
              $(document).ready(function(){
                     $("#cargarFiltros").click(function(evento){
                        evento.preventDefault();
                        $("#cargaexterna").load
                        ("registroServicio-filtro-user.php", {ID_ser: "'.@$ID_ser.'"}, function(){
                      });});});
  </script>';
 echo '<script>
              $(document).ready(function(){
                     $("#buscar").click(function(evento){
                        evento.preventDefault();
                        var codigo      = $("#codigo").val();
                        $("#cargaexterna").load
                        ("registroServicio-filtro-user.php", {codigo: codigo}, function(){
                      });});});

  </script>';
?>

     <div class="col-md-12" style="bottom: 0px; position: absolute;">
   
        <div class="col-md-2">
            <div id="SolapaAsignado" class="solapa">
              <h5>
                Asignados (<?php echo $num_GetRegistroServicioAsignado?>)  <i id="contraerBAsignado" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
        <div class="col-md-2">
           <div id="SolapaPendiente" class="solapa">
              <h5>
                Pendientes (<?php echo $num_GetRegistroServicioPendientes?>)  <i id="contraerBPendiente" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
          </div>
       </div>
       <div class="col-md-2">
            <div id="SolapaRepuesto" class="solapa">
              <h5>
                Repuestos (<?php echo $num_GetRegistroServicioRepuestos?>)  <i id="contraerBRepuesto" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
    </div>



<!-- Inicio jquery controles de columnas -->
<script type="text/javascript">

   $("#expandirAsignado").click(function() {
   $("#ExpandirAsignado").removeClass( "col-md-4 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirAsignado").css("display", "none");
   $("#contraerAsignado").css("display", "block");
   $("#iconoAsignado").css("display", "none");
   });
   $("#contraerAsignado").click(function() {
   $("#ExpandirAsignado").removeClass( "col-md-12 noClass" ).addClass( "col-md-4" );
   $("#expandirAsignado").css("display", "block");
   $("#contraerAsignado").css("display", "none");
   $("#iconoAsignado").css("display", "block");
   });
   $("#cerrarColumnaAsignado").click(function() {
   $("#ExpandirAsignado").hide( 1000 )});
   $("#minimizarAsignado").click(function() {
   $("#ExpandirAsignado").hide(1000);
   $("#SolapaAsignado").css("display", "block").fadeIn(100);
   });
   $("#contraerBAsignado").click(function() {
   $("#ExpandirAsignado").css("display", "block").fadeIn(100);
   $("#SolapaAsignado").css("display", "none");
});

  
   $("#expandirPendiente").click(function() {
   $("#ExpandirPendiente").removeClass( "col-md-4 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirPendiente").css("display", "none");
   $("#contraerPendiente").css("display", "block");
   $("#iconoPendiente").css("display", "none");
   });
   $("#contraerPendiente").click(function() {
   $("#ExpandirPendiente").removeClass( "col-md-12 noClass" ).addClass( "col-md-4" );
   $("#expandirPendiente").css("display", "block");
   $("#contraerPendiente").css("display", "none");
   $("#iconoPendiente").css("display", "block");
   });
   $("#cerrarColumnaPendiente").click(function() {
   $("#ExpandirPendiente").hide( 1000 )});
   $("#minimizarPendiente").click(function() {
   $("#ExpandirPendiente").hide(1000);
   $("#SolapaPendiente").css("display", "block").fadeIn(100);
   });
   $("#contraerBPendiente").click(function() {
   $("#ExpandirPendiente").css("display", "block").fadeIn(100);
   $("#SolapaPendiente").css("display", "none");
});
   
   $("#expandirRepuesto").click(function() {
   $("#ExpandirRepuesto").removeClass( "col-md-4 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirRepuesto").css("display", "none");
   $("#contraerRepuesto").css("display", "block");
   $("#iconoRepuesto").css("display", "none");
   });
   $("#contraerRepuesto").click(function() {
   $("#ExpandirRepuesto").removeClass( "col-md-12 noClass" ).addClass( "col-md-4" );
   $("#expandirRepuesto").css("display", "block");
   $("#contraerRepuesto").css("display", "none");
   $("#iconoRepuesto").css("display", "block");
   });
   $("#cerrarColumnaRepuesto").click(function() {
   $("#ExpandirRepuesto").hide( 1000 )});
   $("#minimizarRepuesto").click(function() {
   $("#ExpandirRepuesto").hide(1000);
   $("#SolapaRepuesto").css("display", "block").fadeIn(100);
   });
   $("#contraerBRepuesto").click(function() {
   $("#ExpandirRepuesto").css("display", "block").fadeIn(100);
   $("#SolapaRepuesto").css("display", "none");
});

</script>

<!--Inicio: script -->
   <script type='text/javascript'>

  $(document).ready( function () {
    $('#asignadoTabla').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'print',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                download: 'open'
            }
        ],
        responsive: true,
      
    });

} );

   </script>
<!--Fin: script -->

<!--Inicio: script -->
   <script type='text/javascript'>

  $(document).ready( function () {
    $('#pendienteTabla').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'print',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                download: 'open'
            }
        ],
        responsive: true,
      
    });

} );

   </script>
<!--Fin: script -->

<!--Inicio: script -->
   <script type='text/javascript'>

  $(document).ready( function () {
    $('#repuestoTabla').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'print',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                download: 'open'
            }
        ],
        responsive: true,
      
    });

} );

   </script>
<!--Fin: script -->
<!-- Inicio footer -->
<?php
require_once ('inc/footer.php');
?>
<!-- Fin footer -->




