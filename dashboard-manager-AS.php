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
    $ID_emp                         = $_SESSION['ID_emp'];
    $ID_usu                         = $_SESSION['ID_usu'];
    $ID_gcm                         = $_SESSION['ID_gcm'];
    $_SESSION['1-new-quotation-ne'] = $_SERVER['REQUEST_URI'];
    $_SESSION['dropBack']           = $_SERVER['REQUEST_URI'];
    $_SESSION['actionsBack']        = $_SERVER['REQUEST_URI'];
    $usu = $ID_usu;
    $ger = $ID_gcm;
    $asignado = '0';
  ?>
<!--Fin Head-->
<!--Inicio Objetos-->
  <?php
    $quotations                     = new quotations;
    $usuarios                       = new usuarios;
    $monedas                        = new monedas;
    $adjuntos                       = new adjuntos;
    $tipo_moneda                    = new tipo_moneda;
    $status                         = new status;
    $gerencias_comerciales          = new gerencias_comerciales;
    $especiales                     = new especiales;
    $motivos_rechazo                = new motivos_rechazo;
    $registro_servicio              = new registro_servicio;
  ?>  
<!--Fin Objetos-->
<!--Inicio Funciones-->
  <?php
    $getQuotationsInserted          = $quotations->getQuotationsInsertedASManager($ger);
    $num_getQuotationsInserted      = mysql_num_rows($getQuotationsInserted);

    $getQuotationsAccepted          = $quotations->getQuotationsAceptedASManager($ger);
    $num_getQuotationsAccepted      = mysql_num_rows($getQuotationsAccepted);

    $getQuotationsBudgeted          = $quotations->getQuotationsBudgetedASManager($ger);
    $num_getQuotationsBudgeted      = mysql_num_rows($getQuotationsBudgeted);
  
    $getQuotationsDespacho          = $quotations->getQuotationsDespachoManager($ger);
    $num_getQuotationsDespacho      = mysql_num_rows($getQuotationsDespacho);

    $getQuotationsInstalacion       = $quotations->getQuotationsInstalacionManager($ger);
    $num_getQuotationsInstalacion   = mysql_num_rows($getQuotationsInstalacion);

    $getQuotationsCierreAS          = $quotations->getQuotationsCierreASManager($ger);
    $num_getQuotationsCierreAS      = mysql_num_rows($getQuotationsCierreAS);

    $getQuotationsRechazado         = $quotations->getQuotationsRechazadoManager($ger);
    $num_getQuotationsRechazado     = mysql_num_rows($getQuotationsRechazado);

    $getGerencias_comerciales       = $gerencias_comerciales->getGerencias_comerciales($ID_emp);
    $getGerencias_comercialesB      = $gerencias_comerciales->getGerencias_comerciales($ID_emp);

    $num_getGerencias_comerciales   = mysql_num_rows($getGerencias_comerciales);
    $num_getGerencias_comercialesB  = mysql_num_rows($getGerencias_comercialesB);

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

#iconoAccepted
{
  text-align: center;
}
#expandirAccepted:hover
{
  color: #0bb;
}
#contraerAccepted:hover
{
  color: #0bb;
}
#cerrarColumnaAccepted:hover
{
  color: #f00;
}
#minimizarAccepted:hover
{
  color: #0bb;
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


#iconoPresupuestados
{
  text-align: center;
}
#expandirPresupuestados:hover
{
  color: #0bb;
}
#contraerPresupuestados:hover
{
  color: #0bb;
}
#cerrarColumnaPresupuestados:hover
{
  color: #f00;
}
#minimizarPresupuestados:hover
{
  color: #0bb;
}

#iconoDespacho
{
text-align: center;
}
#expandirDespacho:hover
{
  color: #0bb;
}
#contraerDespacho:hover
{
  color: #0bb;
}
#cerrarColumnaDespacho:hover
{
  color: #f00;
}
#minimizarDespacho:hover
{
  color: #0bb;
}

#iconoInstalacion
{
  width: 100%;
  text-align: center;
}
#expandirInstalacion:hover
{
  color: #0bb;
}
#contraerInstalacion:hover
{
  color: #0bb;
}
#cerrarColumnaInstalacion:hover
{
  color: #f00;
}
#minimizarInstalacion:hover
{
  color: #0bb;
}

#iconoCierre
{
  width: 100%;
  text-align: center;
}
#expandirCierre:hover
{
  color: #0bb;
}
#contraerCierre:hover
{
  color: #0bb;
}
#cerrarColumnaCierre:hover
{
  color: #f00;
}
#minimizarCierre:hover
{
  color: #0bb;
}
 /* FIN ESTILOS SOLAPAS */

#direccion
{
  color: #f00;
  font-size: 85%;
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
   #icono
   {
    width: 100%;
    text-align: center;
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
.material-icons
{
  vertical-align: middle;
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
<!--Fin Script de loading general-->

<!--Inicio definicion de pestañas-->
<ul class="nav nav-tabs"     style="background-color: #fff; margin-top: 5px; ">
  <li><a href="#inicio"      data-toggle="tab"><i class="material-icons">turned_in</i> Principal</a></li>
  <li><a href="#Rechazados"  data-toggle="tab"><i class="material-icons">pan_tool</i> Rechazados</a></li>
  <li><a href="#Historial"   data-toggle="tab"><i class="material-icons">history</i> Historial</a></li>
</ul>
<!--Fin definicion de pestañas-->

<!-- Inicio div gral -->
<div class="tab-content" >
<!-- INICIO SOLAPA PRINCIPAL-->
  <div class="tab-pane fade in active" id="inicio" >
  <!-- Inicio div Asignados -->
      <div class="col-md-2" id="ExpandirAsignado">
     
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

      <h4><i class="material-icons">account_circle</i> Asignados (<?php echo $num_getQuotationsInserted;?>) </h4>

    <?php
    echo "<div  id='iconoAsignado'>";
      if($num_getQuotationsInserted!=0)
      {
        include('inc/pendientes_aceptacion_graph.php'); 
      }
      else
      {
        echo '<img src="images/confirm-icon.png">';
      } 
    echo "</div>";  
     ?>
    <!-- <?php include('inc/quotations-insertedAS.php'); ?>  -->
          <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
          <tr>
            <th style='text-align: center;' colspan='4'>No. Pedido</th>
          </tr>
        </thead>
        <tbody id='myTable'>
     <?php
        
      @$ID_ptoDeInsert = round(12*((base64_decode($_GET['ID_pto']))/12344));



      for($a=0; $a<$num_getQuotationsInserted; $a++)
      {
        $assoc_getQuotationsInserted = mysql_fetch_assoc($getQuotationsInserted);
        $ID_pto                      = $assoc_getQuotationsInserted['ID_pto'];

    /* Inicio Modal Aceptado */                          
    echo '<div class="modal fade" id="'.$assoc_getQuotationsInserted['ID_pto'].'a" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Aceptar pedido- '.$assoc_getQuotationsInserted['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body">
                   <div class="alert alert-warning" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
                      ¿Esta seguro que desea acptar este pedido?</h5>
                    </div>

                    <form action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                 
                     <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsInserted['pto_pedidoCod'].'" />
                    <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsInserted['ID_pto'].'" />
                    <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsInserted['pto_asignado'].'" />
                     <input type="hidden" name="ID_sta" value="16" />
                    <input type="hidden" name="actionAS" value="aceptado" /></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Aceptar</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Aceptado */


         /* Inicio Modal Rechazar */                          
    echo '<div class="modal fade" id="'.$assoc_getQuotationsInserted['ID_pto'].'rechazar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">RECHAZAR - '.$assoc_getQuotationsInserted['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body">
                   <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de rechazar un presupuesto, el mismo desaparecera del flujo y solo podra verse en la solapa Historial </p>
                    </div>
                    <form action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                    <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsInserted['ID_pto'].'" >
                    <input type="hidden" name="ID_sta" value="40" >
                    <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsInserted['pto_asignado'].'" >
                    <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsInserted['pto_pedidoCod'].'" >
                    <input type="hidden" name="actionAS" value="rechazado" >
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No, volver !</button>
                    <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">pan_tool</i> Si, Rechazar !</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Rechazar */

            
        
        /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsInserted['ID_pto'].'EliminarAsignados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Pedido - '.$assoc_getQuotationsInserted['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                         <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="actionAS" value="delete" />
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsInserted['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsInserted['pto_asignado'].'" />
                          <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button> 
                          </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Eliminar */

    echo "<tr>
            <td style='vertical-align: middle;' >";
if ($ID_ptoDeInsert==$ID_pto)
               {
                

                 echo "<script>
                 function blink()
                  {
                  $('#Destacado').fadeTo(100, 0.1).fadeTo(200, 1.0).fadeTo(100, 0.1).fadeTo(200, 1.0).fadeTo(100, 0.1).fadeTo(200, 1.0);
                  }
                  setInterval(blink, 2200);

                 
                  
                  </script>";
                  echo "<img id='Destacado' src='images/nuevoPedido.png' style='width: 50px; float: right; >";
              }
                   


            echo "<div id='".$assoc_getQuotationsInserted['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>
             <a data-toggle='collapse' data-parent='#".$assoc_getQuotationsInserted['ID_pto']."' href='#collapse".$assoc_getQuotationsInserted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsInserted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsInserted['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsInserted['cli_desc']."</a>
            </div>
            <div id='collapse".$assoc_getQuotationsInserted['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

                     <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente</strong> <a href='../MasterData/modify-store.php?id=".base64_encode((12344*($assoc_getQuotationsInserted['ID_obr']))/12)."' data-toggle='modal' title='Ver Tienda' target='_blank' data-placement='top'>".$assoc_getQuotationsInserted['obr_desc']."</a></p>";


                //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaInserted=$assoc_getQuotationsInserted['obr_URL'];
                  $diremapInserted         = explode('?', $direccionMapaInserted);
                  if (!isset($diremapInserted[1])) 

                  {
                      $Mobile_DetectInserted="http://maps.google.com?daddr=".$assoc_getQuotationsInserted['obr_dir']."";
                      $direccionInserted="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionInserted="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectInserted="geo:0,0?daddr=".$diremapInserted[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectInserted="http://maps.apple.com/maps?saddr=".$diremapInserted[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectInserted="maps:".$diremapInserted[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectInserted = "http://maps.google.com?daddr=".$diremapInserted[1]."";
                      } 

                   } 
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "<p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectInserted."'>".$assoc_getQuotationsInserted['obr_desc']."   ".$assoc_getQuotationsInserted['obr_desc']."</a>".$direccionInserted."</p>";

                if ($assoc_getQuotationsInserted['pto_contacto'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsInserted['pto_contacto']."</p>";
                 }
                  if ($assoc_getQuotationsInserted['obr_mail'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsInserted['obr_mail']."'>".$assoc_getQuotationsInserted['pto_mail']."</a></p>";
                 }
                  if ($assoc_getQuotationsInserted['obr_tel'])
                 {
                     echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsInserted['obr_tel']."'>".$assoc_getQuotationsInserted['pto_telefono']."</a></p>";
                 }
               
               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Fecha de Ingreso:</strong> Ingreso: ".$assoc_getQuotationsInserted['pto_fecIngreso']."</p>";

                 if ($assoc_getQuotationsInserted['pto_presupuestoRelacionado']!=0)
                  {
                  
                  $getQuotationsByIdA= $quotations->getQuotationsById($assoc_getQuotationsInserted['pto_presupuestoRelacionado']);
                  $assoc_getQuotationsByIdA=mysql_fetch_assoc($getQuotationsByIdA);
                  $ID_fic_A=$assoc_getQuotationsByIdA['ID_fic'];
                  $ID_obr_A=$assoc_getQuotationsByIdA['ID_obr'];
                   echo "<p><i class='material-icons' style='vertical-align: middle'> assignment_return</i> Presupuesto Relacionado:<a href='modify-quotation-ne.php?ID_fic=".base64_encode((12344*($ID_fic_A))/12)."&ID_obr=".base64_encode((12344*($ID_obr_A))/12)."&ID_pto=". base64_encode((12344*($assoc_getQuotationsInserted['pto_presupuestoRelacionado']))/12)."'> ". $assoc_getQuotationsByIdA['pto_pedidoCod'] ." <strong></a></p>";
                }

               echo "<div style='display: inline-flex; margin-top: 10px' align='center'>

                <button type='button' class='btn btn-default' data-toggle='modal' title='Aceptar Pedido' data-placement='top' data-target='#".$assoc_getQuotationsInserted['ID_pto']."a' style='margin-right: 10px'><i class='material-icons center'>assignment_ind</i></button>";

                  echo "<button type='button' class='btn btn-default' data-toggle='modal' title='Rechazar' data-placement='top' data-target='#".$assoc_getQuotationsInserted['ID_pto']."rechazar' style='margin-right: 10px'><i class='material-icons center'>pan_tool</i></button>";
              
                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsInserted['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsInserted['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_getQuotationsInserted['ID_pto']."EliminarAsignados'><i class='material-icons'>delete_forever</i></button>
               </div>
              </div>
            </div>";



              
            echo "</td>
          </tr>";




            }

          ?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' colspan='4'>No. Pedido</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    </div>
    <!-- Fin div Asignado -->
  
   <!-- Inicio div Aceptados-->
      <div class="col-md-2" id="ExpandirAccepted">
     
      <div class="col-md-12" id="cuadros">
      
      <!--Inicio Barra de herramientas de ventana-->
       <div class="col-md-12" id="barraTareas">
          <i id="cerrarColumnaAccepted" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
          <i id="expandirAccepted" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
          <i id="contraerAccepted" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
          <i id="minimizarAccepted" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
       </div>   
      <hr>
      <!--Fin Barra de herramientas de ventana-->

 <h4><i class="material-icons">assignment_turned_in</i> Aceptados (<?php echo $num_getQuotationsAccepted?>) </h4>
     <!-- <?php<?php include('inc/quotations-acceptedAS.php'); ?>--> 

    <?php
    echo "<div  id='iconoAccepted'>";
      if($num_getQuotationsAccepted!=0)
      {
        include('inc/pendientes_presupuestacion_graph.php'); 
      }
      else
      {
        echo '<img src="images/confirm-icon.png">';
      } 
    echo "</div>";  
     ?>
      <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
          <tr>
            <th style='text-align: center;' colspan='3'>No. Pedido</th>
          </tr>
        </thead>
        <tbody id='myTable'>
 <?php

  for($c=0; $c<$num_getQuotationsAccepted; $c++)
  {
    $assoc_getQuotationsAccepted = mysql_fetch_assoc($getQuotationsAccepted);
    $ID_pto                      = $assoc_getQuotationsAccepted['ID_pto'];
    $getTipo_moneda              = $tipo_moneda->getTipo_moneda();
    $num_getTipo_moneda          = mysql_num_rows($getTipo_moneda); 

         /* Inicio Modal Rechazar aceptado*/                          
    echo '<div class="modal fade" id="'.$assoc_getQuotationsAccepted['ID_pto'].'rechazarAceptado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">RECHAZAR ACEPTADO- '.$assoc_getQuotationsAccepted['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body">
                   <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de rechazar un presupuesto, el mismo desaparecera del flujo y solo podra verse en la solapa Historial </p>
                    </div>
                    <form action="actions-quotation-as.php" method="post" id="rechazarAceptado" name="rechazarAceptado" enctype="multipart/form-data">
                    
                    <div class="form-group">
                    <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsAccepted['ID_pto'].'" >
                    <input type="hidden" name="ID_sta" value="21" >
                    <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsAccepted['pto_asignado'].'" >
                    <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsAccepted['pto_pedidoCod'].'" >
                    <input type="hidden" name="actionAS" value="rechazado" >
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No, volver !</button>
                    <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">pan_tool</i> Si, Rechazar !</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Rechazar */

         /* Inicio Modal Presupuestar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsAccepted['ID_pto'].'p" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Presupuestar Pedido - '.$assoc_getQuotationsAccepted['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body">
 
                  <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                  <fieldset>

                  <!-- Form Name -->
                  <legend>Presupuesto</legend>

                  <!-- Select Basic -->
                 <div class="form-group">
                    <label for="ID_tipoMonedaPres">Moneda</label>
                      <select name="ID_tipoMonedaPres" class="form-control" required>';
                        for ($tdm=0; $tdm < $num_getTipo_moneda; $tdm++)
                   { 
                        $assoc_getTipo_moneda = mysql_fetch_assoc($getTipo_moneda);
                 
                        echo "<option value='".$assoc_getTipo_moneda['ID_tmo']."'>".$assoc_getTipo_moneda['tmo_desc']."</option>";
                          }
                echo '</select>
                  </div>

                    <!-- Text input-->
                  <div class="form-group">
                    <label for="tipoCambioPres">Tipo de Cambio</label>  
                    <input name="tipoCambioPres" type="number" step="0.01"  class="form-control input-md" required>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label for="pto_montoPresupuesto">Monto Presupuesto</label>  
                    <input name="pto_montoPresupuesto" type="text" placeholder="XXXXXX.XX" class="form-control input-md" required>
                  </div>

                     <!-- Text input-->
                  <div class="form-group">
                    <label for="pto_diasEntrega">Dias de Entrega</label>  
                    <input name="pto_diasEntrega" type="number" placeholder="20" class="form-control input-md" required>
                  </div>

                  <!-- File Button --> 
                  <div class="form-group">
                    <label for="adj_ruta">Presupuesto en Excel</label>
                      <input type="file" name="adj_ruta[]" multiple required>
                  </div>

                  <input type="hidden" name="actionAS" value="quotate" />
                  <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsAccepted['pto_pedidoCod'].'" />
                  <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsAccepted['ID_pto'].'" />
                  <input type="hidden" name="ID_usu" value="'.$assoc_getQuotationsAccepted['ID_usu'].'" />
                  <input type="hidden" name="pto_contacto" value="'.$assoc_getQuotationsAccepted['pto_contacto'].'" />
                  <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsAccepted['pto_asignado'].'" />
                  </fieldset>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">done</i> Aceptar</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>';
          /* Fin Modal Presupuestar */

         /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsAccepted['ID_pto'].'EliminarAceptados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Pedido - '.$assoc_getQuotationsAccepted['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                        <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="actionAS" value="delete" />
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsAccepted['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsAccepted['pto_asignado'].'" />
                        
                          <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button> 
                          </Form>
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        
                  </div>
                </div>
              </div>
            </div>
          </div>';
          /* Fin Modal Eliminar */

  echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_getQuotationsAccepted['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>
               ";
             if ($assoc_getQuotationsAccepted['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsAccepted['ID_pto']."' href='#collapse".$assoc_getQuotationsAccepted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsAccepted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsAccepted['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsAccepted['cli_desc']." - ". $assoc_getQuotationsAccepted['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsAccepted['ID_pto']."' href='#collapse".$assoc_getQuotationsAccepted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsAccepted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsAccepted['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsAccepted['cli_desc']."</a>";
           }
            echo " 
            </div>
            <div id='collapse".$assoc_getQuotationsAccepted['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsAccepted['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsAccepted['obr_desc']."</a></p>

               ";


                //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaAccepted=$assoc_getQuotationsAccepted['obr_URL'];
                  $diremapAccepted         = explode('?', $direccionMapaAccepted);
                  if (!isset($diremapAccepted[1])) 

                  {
                      $Mobile_DetectAccepted="http://maps.google.com?daddr=".$assoc_getQuotationsAccepted['obr_dir']."";
                      $direccionAccepted="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionAccepted="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectAccepted="geo:0,0?daddr=".$diremapAccepted[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectAccepted="http://maps.apple.com/maps?saddr=".$diremapAccepted[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectAccepted="maps:".$diremapAccepted[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectAccepted = "http://maps.google.com?daddr=".$diremapAccepted[1]."";
                      } 

                   } 
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "<p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectAccepted."'>".$assoc_getQuotationsAccepted['obr_desc']."   ".$assoc_getQuotationsAccepted['obr_desc']."</a>".$direccionAccepted."</p>";


                if ($assoc_getQuotationsAccepted['pto_contacto'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsAccepted['pto_contacto']."</p>";
                 }

                   if ($assoc_getQuotationsAccepted['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsAccepted['obr_mail']."'>".$assoc_getQuotationsAccepted['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsAccepted['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsAccepted['obr_tel']."'>".$assoc_getQuotationsAccepted['pto_telefono']."</a></p>";
                 }

               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsAccepted['pto_fecIngreso']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado:</strong> ".$assoc_getQuotationsAccepted['pto_fecAceptado']."</p>";


                echo "<div style='display: inline-flex' align='center'>

                <button type='button' class='btn btn-default' data-toggle='modal' title='Presupuestar' data-placement='top' data-target='#".$assoc_getQuotationsAccepted['ID_pto']."p' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>

               ";

                 echo "<button type='button' class='btn btn-default' data-toggle='modal' title='Rechazar Aceptado' data-placement='top' data-target='#".$assoc_getQuotationsAccepted['ID_pto']."rechazarAceptado' style='margin-right: 10px'><i class='material-icons center'>pan_tool</i></button>";

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsAccepted['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsAccepted['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_getQuotationsAccepted['ID_pto']."EliminarAceptados'><i class='material-icons'>delete_forever</i></button>
                </div>
              </div>
            </div>
            </td>
          </tr>";
  }

     
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' colspan='3'>No. Pedido</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    </div>
    <!-- Fin div Aceptados -->
     <!-- Inicio div Presupuestados -->
      <div class="col-md-2" id="ExpandirPresupuestados">
     
      <div class="col-md-12" id="cuadros">
      
      <!--Inicio Barra de herramientas de ventana-->
       <div class="col-md-12" id="barraTareas">
          <i id="cerrarColumnaPresupuestados" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
          <i id="expandirPresupuestados" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
          <i id="contraerPresupuestados" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
          <i id="minimizarPresupuestados" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
       </div>   
      <hr>
      <!--Fin Barra de herramientas de ventana-->
      <h4><i class="material-icons">description</i> Presupuestados(<?PHP echo $num_getQuotationsBudgeted;?>)</h4>

    <?php
    echo "<div  id='iconoPresupuestados'>";
      if($num_getQuotationsBudgeted!=0)
      {
        include('inc/pendientes_venta_graph.php'); 
      }
      else
      {
        echo '<img src="images/confirm-icon.png">';
      } 
    echo "</div>";  
     ?>
    <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
           
          </tr>
          <tr>
            <th style='text-align: center;' colspan='3'>No. Pedido</th>
          </tr>
        </thead>
        <tbody id='myTable'>

 <?php

  for($d=0; $d<$num_getQuotationsBudgeted; $d++)
  {
    $assoc_getQuotationsBudgeted        = mysql_fetch_assoc($getQuotationsBudgeted);
    $ID_pto                             = $assoc_getQuotationsBudgeted['ID_pto'];
    $ID_sta                             = $assoc_getQuotationsBudgeted['ID_sta'];
    $getStatusById                      = $status->getStatusById($ID_sta);
    $assoc_getStatusById                = mysql_fetch_assoc($getStatusById);
    $getMotivosRechazoIdEmp             = $motivos_rechazo->getMotivosRechazoIdEmp($ID_emp);
    $num_getMotivosRechazoIdEmp         = mysql_num_rows($getMotivosRechazoIdEmp);


    /* Inicio Modal Rechazar aceptado*/                          
    echo '<div class="modal fade" id="rechazarPresupuestado'.$assoc_getQuotationsBudgeted['ID_pto'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Rechazar Presupuestado- '.$assoc_getQuotationsBudgeted['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body">
                   <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de rechazar un presupuesto, el mismo desaparecera del flujo y solo podra verse en la solapa Historial </p>
                    </div>
                    <form action="actions-quotation-as.php" method="post" id="rechazarPresupuestado" name="rechazarPresupuestado" enctype="multipart/form-data"> ';

                       echo '<div class="form-group">';
                       echo '<label></label>';
                       echo '<select class="form-control" name="ID_mot">';

                    for ($count=0; $count < $num_getMotivosRechazoIdEmp; $count++)
                     { 
                      $assoc_getMotivosRechazoIdEmp = mysql_fetch_assoc($getMotivosRechazoIdEmp);
                      echo "<option value='".$assoc_getMotivosRechazoIdEmp['ID_mot']."'>".$assoc_getMotivosRechazoIdEmp['mot_desc']."</option>";
                     }
                    echo "</select>";
                    echo '<div class="form-group">
                    <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsBudgeted['ID_pto'].'" >
                    <input type="hidden" name="ID_sta" value="19" >
                    <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsBudgeted['pto_asignado'].'" >
                    <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsBudgeted['pto_pedidoCod'].'" >
                    <input type="hidden" name="actionAS" value="rechazado" >
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No, volver !</button>
                    <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">pan_tool</i> Si, Rechazar !</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Rechazar */

                 /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsBudgeted['ID_pto'].'EliminarPresupuestados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Pedido - '.$assoc_getQuotationsBudgeted['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="actionAS" value="delete" />
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsBudgeted['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsBudgeted['pto_asignado'].'" />
                          <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button> 
                          </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     
                  </div>
                </div>
              </div>
            </div>
          </div>';
          /* Fin Modal Eliminar */


           echo '<div class="modal fade" id="'.$assoc_getQuotationsBudgeted['ID_pto'].'vender" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Vender</h4>
                  </div>
                  <div class="modal-body" align="center">';
      
                          echo '<form class="form-inline" action="actions-quotation-as.php" class="form-horizontal" method="post" enctype="multipart/form-data">';
                      
                           //No. Orden de Compra
                            echo '<div class="form-group" style="margin: 3%;">';
                            echo '<label>No. Orden de Compra</label>';
                              echo '<input type="number" class="form-control" name="pto_OC" placeholder="No. Orden de Compra"></input>';
                            echo '</div>';

                           //No. Orden/es de Venta (SAP):
                            echo '<div class="form-group" style="margin: 3%;">';
                            echo '<label>No. Orden/es de Venta (SAP)</label>';
                              echo '<input type="number" class="form-control" name="pto_OV" placeholder="No. Orden/es de Venta (SAP)"></input>';
                            echo '</div>';

                            //No. Proyecto (SAP):
                            echo '<div class="form-group" style="margin: 3%;">';
                            echo '<label>No. Proyecto (SAP)</label>';
                              echo '<input type="number" class="form-control" name="pto_proyecto" placeholder="No. Proyecto (SAP)"></input>';
                            echo '</div>';

                             //Fecha de entrega (SAP):
                           $pto_diasEntrega=$assoc_getQuotationsBudgeted['pto_diasEntrega'];
                           $fechaDeHoy = date("Y-m-d");
                            $fechaA = strtotime ( ''.$pto_diasEntrega.' day' , strtotime ($fechaDeHoy));
                            $fechaA = date ( 'Y-m-d' , $fechaA );

                            echo '<div class="form-group" style="margin: 3%;">';
                            echo '<label>Fecha de entrega (SAP)</label>';
                              echo '<input type="date" class="form-control" name="pto_fecEntrega" value="'.$fechaA.'"></input>';
                            echo '</div>';

                             //TIPO DE MONEDA
                            echo '<div class="form-group" style="margin: 3%;">';
                            echo '<label>Tipo de moneda</label>';
                            echo '<select class="form-control" name="ID_tipoMonedaVenta" >';
                            echo '<option value="1" selected>Tipo de moneda: ARG</option>';
                           

                            /*  for ($a=0; $a < $num_getTipo_moneda; $a++)
                             { 
                                $assoc_getTipo_moneda=mysql_fetch_assoc($getTipo_moneda);
                                   echo '<option value="'. $assoc_getTipo_moneda['ID_tmo'].'">'. $assoc_getTipo_moneda['tmo_desc'].'</option>';
                             }*/
                            echo '<select>';
                            echo '</div>';

                             //Monto de la OV (ingrsar sólo números XXXX.XX):
                            echo '<div class="form-group" style="margin: 3%;">';
                              echo '<input type="number" class="form-control" name="pto_montoOV" placeholder="Monto de la OV (ingrsar sólo números XXXX.XX)"></input>';
                            echo '</div>';


                            echo ' <input type="hidden" name="actionAS" value="vendido" />
                                   <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsBudgeted['pto_pedidoCod'].'" />
                                   <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsBudgeted['ID_pto'].'" />
                                   <input type="hidden" name="ID_usu" value="'.$assoc_getQuotationsBudgeted['ID_usu'].'" />
                                   <input type="hidden" name="pto_mail" value="'.$assoc_getQuotationsBudgeted['pto_mail'].'" />
                                   <input type="hidden" name="ID_tpp" value="'.$assoc_getQuotationsBudgeted['ID_tpp'].'" />
                                   <input type="hidden" name="pto_contacto" value="'.$assoc_getQuotationsBudgeted['pto_contacto'].'" />
                                   <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsBudgeted['pto_asignado'].'" />';

                               echo '<button type="submit" class="btn btn-success" style="width: 100%; margin-bottom: 2%;"><i class="material-icons" style="vertical-align: middle">attach_money</i> Vender</button>';
                                  echo '</form>';
                        echo '</div>';

                echo'<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>';                                  
    echo '<div class="modal fade" id="'.$assoc_getQuotationsBudgeted['ID_pto'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Cliente</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="actionAS" value="delete" />
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsBudgeted['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsBudgeted['pto_asignado'].'" />
                          <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button> 
                          </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     
                  </div>
                </div>
              </div>
            </div>
          </div>';                                     
    echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_getQuotationsBudgeted['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>
            ";
            if ($assoc_getQuotationsBudgeted['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsBudgeted['ID_pto']."' href='#collapse".$assoc_getQuotationsBudgeted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsBudgeted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsBudgeted['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsBudgeted['cli_desc']." - ". $assoc_getQuotationsBudgeted['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsBudgeted['ID_pto']."' href='#collapse".$assoc_getQuotationsBudgeted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsBudgeted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsBudgeted['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsBudgeted['cli_desc']."</a>";
           }
     echo "
            </div>
            <div id='collapse".$assoc_getQuotationsBudgeted['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong> <a href='../MasterData/modify-store.php?id=".base64_encode((12344*($assoc_getQuotationsBudgeted['ID_obr']))/12)."' data-toggle='modal' title='Ver Tienda' target='_blank' data-placement='top'>".$assoc_getQuotationsBudgeted['obr_desc']."</a></p>";

                  //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaBudgeted=$assoc_getQuotationsBudgeted['obr_URL'];
                  $diremapBudgeted         = explode('?', $direccionMapaBudgeted);
                  if (!isset($diremapBudgeted[1])) 

                  {
                      $Mobile_DetectBudgeted="http://maps.google.com?daddr=".$assoc_getQuotationsBudgeted['obr_dir']."";
                      $direccionBudgeted="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionBudgeted="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectBudgeted="geo:0,0?daddr=".$diremapBudgeted[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectBudgeted="http://maps.apple.com/maps?saddr=".$diremapBudgeted[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectBudgeted="maps:".$diremapBudgeted[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectBudgeted = "http://maps.google.com?daddr=".$diremapBudgeted[1]."";
                      } 

                   } 
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "<p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectBudgeted."'>".$assoc_getQuotationsBudgeted['obr_desc']."   ".$assoc_getQuotationsBudgeted['obr_desc']."</a>".$direccionBudgeted."</p>";


                if ($assoc_getQuotationsBudgeted['pto_contacto'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsBudgeted['pto_contacto']."</p>";
                 }

                   if ($assoc_getQuotationsBudgeted['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsBudgeted['obr_mail']."'>".$assoc_getQuotationsBudgeted['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsBudgeted['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsBudgeted['obr_tel']."'>".$assoc_getQuotationsBudgeted['pto_telefono']."</a></p>";
                 }

               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsBudgeted['pto_fecIngreso']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>assignment_ind</i> <strong>Presupuestista:</strong> ".$usuarios->genereaUsuariosNomApe($assoc_getQuotationsBudgeted['pto_asignado'])."</p>";

               if ($assoc_getQuotationsBudgeted['ser_cod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio:</strong> ".$assoc_getQuotationsBudgeted['ser_cod']."</p>";
                 } 
               

              echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado:</strong> ".$assoc_getQuotationsBudgeted['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado:</strong>".$assoc_getQuotationsBudgeted['pto_fecPresupuesto']."</p>

              <p><i class='material-icons' style='vertical-align: middle'>explicit</i> <strong>Estado:</strong>".$assoc_getStatusById['sta_desc']."</strong></p>";

                echo "<div style='display: inline-flex' align='center'>

                <button type='button' class='btn btn-success' data-toggle='modal' title='Vender' data-placement='top' data-target='#".$assoc_getQuotationsBudgeted['ID_pto']."vender' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>";

                echo "<button type='button' class='btn btn-default' data-toggle='modal' title='Rechazar Presupuestado' data-placement='top' data-target='#rechazarPresupuestado".$assoc_getQuotationsBudgeted['ID_pto']."' style='margin-right: 10px'><i class='material-icons center'>pan_tool</i></button>";

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsBudgeted['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsBudgeted['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_getQuotationsBudgeted['ID_pto']."EliminarPresupuestados'><i class='material-icons'>delete_forever</i></button>
               </div>";

           echo "</td>
          </tr>";

  }
      
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' colspan='3'>No. Pedido</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
    </div>
    <!-- Fin div Presupuestados -->
    <!-- Inicio div Despacho -->
     
      <div class="col-md-2" id="ExpandirDespacho">
     
      <div class="col-md-12" id="cuadros">
       <!--Inicio Barra de herramientas de ventana-->
       <div class="col-md-12" id="barraTareas">
          <i id="cerrarColumnaDespacho" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
          <i id="expandirDespacho" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
          <i id="contraerDespacho" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
          <i id="minimizarDespacho" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
       </div>   
      <hr>
      <!--Fin Barra de herramientas de ventana-->

    <h4><i class="material-icons">local_shipping</i> Despacho (<?php echo $num_getQuotationsDespacho;?>)</h4>


     <?php
        echo "<div  id='iconoDespacho'>";
        if($num_getQuotationsDespacho!=0)
        {
          include('inc/pendientes_despacho_graph.php'); 
        }
        else
        {
           echo '<img src="images/confirm-icon.png">';
        }
        echo "</div>";   
       ?>
                  <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
           

                 
          </tr>
          <tr>
            <th style='text-align: center;' colspan='3'>No. Pedido</th>
          </tr>
        </thead>
        <tbody id='myTable'>

 <?php

  for($d=0; $d<$num_getQuotationsDespacho; $d++)
  {
    $assoc_getQuotationsDespacho        = mysql_fetch_assoc($getQuotationsDespacho);
    $ID_pto                             = $assoc_getQuotationsDespacho['ID_pto'];
    $ID_sta                             = $assoc_getQuotationsDespacho['ID_sta'];


                 /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsDespacho['ID_pto'].'EliminarDespachado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Pedido - '.$assoc_getQuotationsDespacho['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="actionAS" value="delete" />
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsDespacho['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsDespacho['pto_asignado'].'" />
                          <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button> 
                          </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                 
                  </div>
                </div>
              </div>
            </div>
          </div>';
          /* Fin Modal Eliminar */


           echo '<div class="modal fade" id="'.$assoc_getQuotationsDespacho['ID_pto'].'Despachado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Despachar</h4>
                  </div>
                  <div class="modal-body" align="center">';
      
                          echo '<form class="form-inline" action="actions-quotation-as.php" class="form-horizontal" method="post" enctype="multipart/form-data">';
                      
                           //No. Remito (SAP)
                            echo '<div class="form-group" style="margin: 3%;">';
                              echo '<input type="number" class="form-control" name="pto_remito" placeholder="No. Remito (SAP)"></input>';
                            echo '</div>';

                            echo ' <input type="hidden" name="actionAS" value="despachado" />
                          <input type="hidden" name="ID_cli" value="'.$assoc_getQuotationsDespacho['ID_cli'].'" />
                          <input type="hidden" name="ID_obr" value="'.$assoc_getQuotationsDespacho['ID_obr'].'" />
                          <input type="hidden" name="ID_pri" value="'.$assoc_getQuotationsDespacho['ID_pri'].'" />
                          <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsDespacho['pto_pedidoCod'].'" />
                          <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsDespacho['ID_pto'].'" />
                          <input type="hidden" name="ID_usu" value="'.$assoc_getQuotationsDespacho['ID_usu'].'" />
                          <input type="hidden" name="pto_mail" value="'.$assoc_getQuotationsDespacho['pto_mail'].'" />
                          <input type="hidden" name="pto_telefono" value="'.$assoc_getQuotationsDespacho['pto_telefono'].'" />
                          <input type="hidden" name="ID_tpp" value="'.$assoc_getQuotationsDespacho['ID_tpp'].'" />
                          <input type="hidden" name="pto_contacto" value="'.$assoc_getQuotationsDespacho['pto_contacto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsDespacho['pto_asignado'].'" />
                          <input type="hidden" name="ser_cod" value="'.$assoc_getQuotationsDespacho['ser_cod'].'" />
                          <input type="hidden" name="pto_desc" value="'.$assoc_getQuotationsDespacho['pto_desc'].'" />
                          <input type="hidden" name="pto_telefono" value="'.$assoc_getQuotationsDespacho['pto_telefono'].'" />
                          <input type="hidden" name="pto_mail" value="'.$assoc_getQuotationsDespacho['pto_mail'].'" />
                          <input type="hidden" name="pto_contacto" value="'.$assoc_getQuotationsDespacho['pto_contacto'].'"/>';
                                 
                      
                                  echo '</form>';
                        echo '</div>';

                echo'<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>';                                  
                                     
    echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_getQuotationsDespacho['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>
                   ";
            if ($assoc_getQuotationsDespacho['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsDespacho['ID_pto']."' href='#collapse".$assoc_getQuotationsDespacho['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsDespacho['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsDespacho['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsDespacho['cli_desc']." - ". $assoc_getQuotationsDespacho['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsDespacho['ID_pto']."' href='#collapse".$assoc_getQuotationsDespacho['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsDespacho['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsDespacho['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsDespacho['cli_desc']."</a>";
           }
     echo "
            </div>
            <div id='collapse".$assoc_getQuotationsDespacho['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsDespacho['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsDespacho['obr_desc']."</a></p>";

                //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaDespacho=$assoc_getQuotationsDespacho['obr_URL'];
                  $diremapDespacho         = explode('?', $direccionMapaDespacho);
                  if (!isset($diremapDespacho[1])) 

                  {
                      $Mobile_DetectDespacho="http://maps.google.com?daddr=".$assoc_getQuotationsDespacho['obr_dir']."";
                      $direccionDespacho="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionDespacho="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectDespacho="geo:0,0?daddr=".$diremapDespacho[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectDespacho="http://maps.apple.com/maps?saddr=".$diremapDespacho[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectDespacho="maps:".$diremapDespacho[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectDespacho = "http://maps.google.com?daddr=".$diremapDespacho[1]."";
                      } 

                   } 
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "<p><i class='material-icons' style='vertical-align: middle'>place</i> <strong>Tienda:</strong><a href='".$Mobile_DetectDespacho."'>".$assoc_getQuotationsDespacho['obr_desc']."   ".$assoc_getQuotationsDespacho['obr_desc']."</a>".$direccionDespacho."</p>";


                if ($assoc_getQuotationsDespacho['pto_contacto'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsDespacho['pto_contacto']."</p>";
                 }

                   if ($assoc_getQuotationsDespacho['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsDespacho['obr_mail']."'>".$assoc_getQuotationsDespacho['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsDespacho['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsDespacho['obr_tel']."'>".$assoc_getQuotationsDespacho['pto_telefono']."</a></p>";
                 }

               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsDespacho['pto_fecIngreso']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>assignment_ind</i> <strong>Presupuestista: </strong>".$usuarios->genereaUsuariosNomApe($assoc_getQuotationsDespacho['pto_asignado'])."</p>";

               if ($assoc_getQuotationsDespacho['ser_cod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio: </strong>".$assoc_getQuotationsDespacho['ser_cod']."</p>";
                 } 
               

              echo"

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado: </strong>".$assoc_getQuotationsDespacho['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado:</strong> ".$assoc_getQuotationsDespacho['pto_fecPresupuesto']."</p>";

                echo "<div style='display: inline-flex' align='center'>";

                    /*<button type='button' class='btn btn-success' data-toggle='modal' title='Despachar' data-placement='top' data-target='#".$assoc_getQuotationsDespacho['ID_pto']."Despachado' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>";*/ 

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsDespacho['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsDespacho['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_getQuotationsDespacho['ID_pto']."EliminarDespachado'><i class='material-icons'>delete_forever</i></button>
               </div>";

           echo "</td>
          </tr>";

  }
      
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' colspan='3'>No. Pedido</th>
            </tr>
          </tfoot>
        </table>

      </div>
      
    </div>
    </div>
    <!-- Fin div Despacho -->
      <!-- Inicio div Instalación -->

      <div class="col-md-2" id="ExpandirInstalacion">
     
      <div class="col-md-12" id="cuadros">
      
      <!--Inicio Barra de herramientas de ventana-->
       <div class="col-md-12" id="barraTareas">
          <i id="cerrarColumnaInstalacion" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
          <i id="expandirInstalacion" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
          <i id="contraerInstalacion" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
          <i id="minimizarInstalacion" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
       </div>   
      <hr>
      <!--Fin Barra de herramientas de ventana-->



    <h4><i class="material-icons">build</i> Instalación (<?php echo $num_getQuotationsInstalacion;?>)</h4>

    <?php
    echo "<div id='iconoInstalacion'>";
      if($num_getQuotationsInstalacion!=0)
      {
        include('inc/pendientes_instalacion_graph.php'); 
      }
      else
      {
        echo '<img src="images/confirm-icon.png">';
      } 
    echo "</div>";  
     ?>
                  <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
           

                 
          </tr>
          <tr>
            <th style='text-align: center;' colspan='3'>No. Pedido</th>
          </tr>
        </thead>
        <tbody id='myTable'>

 <?php

  for($d=0; $d<$num_getQuotationsInstalacion; $d++)
  {
    $assoc_getQuotationsInstalacion     = mysql_fetch_assoc($getQuotationsInstalacion);
    $ID_pto                             = $assoc_getQuotationsInstalacion['ID_pto'];
    $ID_sta                             = $assoc_getQuotationsInstalacion['ID_sta'];

   /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsInstalacion['ID_pto'].'EliminarInstalacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Instalacion - '.$assoc_getQuotationsInstalacion['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                     <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="actionAS" value="delete" />
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsInstalacion['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsInstalacion['pto_asignado'].'" />
                          <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button> 
                          </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>';
          /* Fin Modal Eliminar */

           echo '<div class="modal fade" id="'.$assoc_getQuotationsInstalacion['ID_pto'].'Instalacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Instalacion</h4>
                  </div>
                  <div class="modal-body" align="center">';
      
                          echo '<form class="form-inline" action="actions-quotation-as.php" class="form-horizontal" method="post" enctype="multipart/form-data">';

                            echo ' <input type="hidden" name="actionAS" value="Instalacion" />
                                   <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsInstalacion['pto_pedidoCod'].'" />
                                   <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsInstalacion['ID_pto'].'" />
                                   <input type="hidden" name="ID_usu" value="'.$assoc_getQuotationsInstalacion['ID_usu'].'" />
                                   <input type="hidden" name="pto_mail" value="'.$assoc_getQuotationsInstalacion['pto_mail'].'" />
                                   <input type="hidden" name="ID_tpp" value="'.$assoc_getQuotationsInstalacion['ID_tpp'].'" />
                                   <input type="hidden" name="pto_contacto" value="'.$assoc_getQuotationsInstalacion['pto_contacto'].'" />
                                   <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsInstalacion['pto_asignado'].'" />';

                               echo '<button type="submit" class="btn btn-success" style="width: 100%; margin-bottom: 2%;"><i class="material-icons" style="vertical-align: middle">assignment_turned_in</i> Registrar Instalacion</button>';
                                  echo '</form>';
                        echo '</div>';

                echo'<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>';                                  
                      
    echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_getQuotationsInstalacion['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>
             ";
            if ($assoc_getQuotationsInstalacion['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsInstalacion['ID_pto']."' href='#collapse".$assoc_getQuotationsInstalacion['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsInstalacion['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsInstalacion['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsInstalacion['cli_desc']." - ". $assoc_getQuotationsInstalacion['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsInstalacion['ID_pto']."' href='#collapse".$assoc_getQuotationsInstalacion['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsInstalacion['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsInstalacion['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsInstalacion['cli_desc']."</a>";
           }
     echo "
            </div>
            <div id='collapse".$assoc_getQuotationsInstalacion['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

              <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsInstalacion['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsInstalacion['obr_desc']."</a></p>";

                  //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaInstalacion=$assoc_getQuotationsInstalacion['obr_URL'];
                  $diremapInstalacion         = explode('?', $direccionMapaInstalacion);
                  if (!isset($diremapInstalacion[1])) 

                  {
                      $Mobile_DetectInstalacion="http://maps.google.com?daddr=".$assoc_getQuotationsInstalacion['obr_dir']."";
                      $direccionInstalacion="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionInstalacion="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectInstalacion="geo:0,0?daddr=".$diremapInstalacion[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectInstalacion="http://maps.apple.com/maps?saddr=".$diremapInstalacion[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectInstalacion="maps:".$diremapInstalacion[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectInstalacion = "http://maps.google.com?daddr=".$diremapInstalacion[1]."";
                      } 
                   } 
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "<p><i class='material-icons' style='vertical-align: middle'>place</i> <strong>Tienda:</strong><a href='".$Mobile_DetectInstalacion."'>".$assoc_getQuotationsInstalacion['obr_desc']."   ".$assoc_getQuotationsInstalacion['obr_desc']."</a>".$direccionInstalacion."</p>";

                if ($assoc_getQuotationsInstalacion['pto_contacto'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsInstalacion['pto_contacto']."</p>";
                 }

                   if ($assoc_getQuotationsInstalacion['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsInstalacion['obr_mail']."'>".$assoc_getQuotationsInstalacion['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsInstalacion['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsInstalacion['obr_tel']."'>".$assoc_getQuotationsInstalacion['pto_telefono']."</a></p>";
                 }

               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsInstalacion['pto_fecIngreso']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>assignment_ind</i> <strong>Presupuestista: </strong>".$usuarios->genereaUsuariosNomApe($assoc_getQuotationsInstalacion['pto_asignado'])."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsInstalacion['pto_fecIngreso']."</p>";

               if ($assoc_getQuotationsInstalacion['ser_cod']=="")
                {
                 
                }
                else
                {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i><strong> Codigo de Servicio:</strong> ".$assoc_getQuotationsInstalacion['ser_cod']."</p>";
                } 
               
              echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado: </strong>".$assoc_getQuotationsInstalacion['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado:</strong>".$assoc_getQuotationsInstalacion['pto_fecPresupuesto']."</p>

                   <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Despachado: </strong>".$assoc_getQuotationsInstalacion['pto_fecDespacho']."</p>";

                  


                echo "<div style='display: inline-flex' align='center'>";

                 /* <button type='button' class='btn btn-success' data-toggle='modal' title='Instalacion' data-placement='top' data-target='#".$assoc_getQuotationsInstalacion['ID_pto']."Instalacion' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>";*/


                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsInstalacion['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsInstalacion['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_getQuotationsInstalacion['ID_pto']."EliminarInstalacion'><i class='material-icons'>delete_forever</i></button>
               </div>";

           echo "</td>
          </tr>";

  }
      
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' colspan='3'>No. Pedido</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
    </div>
    <!-- Fin div Instalación -->
    <!-- Inicio div Cierre-->
    <div class="col-md-2" id="ExpandirCierre">
      <div class="col-md-12" id="cuadros">
       <!--Inicio Barra de herramientas de ventana-->
       <div class="col-md-12" id="barraTareas">
          <i id="cerrarColumnaCierre" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
          <i id="expandirCierre" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
          <i id="contraerCierre" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
          <i id="minimizarCierre" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
       </div>   
      <hr>
      <!--Fin Barra de herramientas de ventana-->
 <h4><i class="material-icons">lock</i> Cerrados (<?php echo $num_getQuotationsCierreAS;?>)</h4>
    <?php
    echo "<div id='iconoCierre'>";
      if($num_getQuotationsCierreAS!=0)
      {
        include('inc/pendientes_cierre_graph.php'); 
      }
      else
      {
        echo '<img src="images/confirm-icon.png">';
      } 
      echo "</div>";
      ?>
          <div class='table-responsive'>
          <table class='table table-condensed table-hover table-striped'>
            <thead>
            <tr>
               

                 
            </tr>
            <tr>
              <th style='text-align: center;' colspan='3'>No. Pedido</th>
            </tr>
          </thead>
          <tbody id='myTable'>

 <?php

  for($d=0; $d<$num_getQuotationsCierreAS; $d++)
  {
    $assoc_getQuotationsCierreAS        = mysql_fetch_assoc($getQuotationsCierreAS);
    $ID_pto                             = $assoc_getQuotationsCierreAS['ID_pto'];
    $ID_sta                             = $assoc_getQuotationsCierreAS['ID_sta'];
    $GetRegistroServicioByIdPto=$registro_servicio->GetRegistroServicioByIdPto($ID_pto);
    $assoc_GetRegistroServicioByIdPto = mysql_fetch_assoc($GetRegistroServicioByIdPto);
   /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsCierreAS['ID_pto'].'Eliminarcierre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Instalacion - '.$assoc_getQuotationsCierreAS['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                   <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="actionAS" value="delete" />
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsCierreAS['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsCierreAS['pto_asignado'].'" />
                          <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button> 
                          </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     
                  </div>
                </div>
              </div>
            </div>
          </div>';
          /* Fin Modal Eliminar */

           echo '<div class="modal fade" id="'.$assoc_getQuotationsCierreAS['ID_pto'].'cierre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cerrar</h4>
                  </div>
                  <div class="modal-body" align="center">';
      
                          echo '<form class="form-inline" action="actions-quotation-as.php" class="form-horizontal" method="post" enctype="multipart/form-data">';

                         echo ' <div class="form-group">
                            <label for="adj_ruta">Documentos para el cierre</label>
                              <input type="file" name="adj_ruta[]" multiple required>
                          </div>';

                            echo ' <input type="hidden" name="actionAS" value="cerrar" />
                                   <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsCierreAS['pto_pedidoCod'].'" />
                                   <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsCierreAS['ID_pto'].'" />
                                   <input type="hidden" name="ID_usu" value="'.$assoc_getQuotationsCierreAS['ID_usu'].'" />
                                   <input type="hidden" name="pto_mail" value="'.$assoc_getQuotationsCierreAS['pto_mail'].'" />
                                   <input type="hidden" name="ID_tpp" value="'.$assoc_getQuotationsCierreAS['ID_tpp'].'" />
                                   <input type="hidden" name="pto_contacto" value="'.$assoc_getQuotationsCierreAS['pto_contacto'].'" />
                                   <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsCierreAS['pto_asignado'].'" />';

                               echo '<button type="submit" class="btn btn-success" style="width: 100%; margin-bottom: 2%;"><i class="material-icons" style="vertical-align: middle">lock_outline</i> Cerrar</button>';
                                  echo '</form>';
                        echo '</div>';

                echo'<div class="modal-footer">
                   
                      
                  </div>
                </div>
              </div>
            </div>
          </div>';                                  
                      
    echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_getQuotationsCierreAS['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
            if ($assoc_getQuotationsCierreAS['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsCierreAS['ID_pto']."' href='#collapse".$assoc_getQuotationsCierreAS['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsCierreAS['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsCierreAS['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsCierreAS['cli_desc']." - ". $assoc_getQuotationsCierreAS['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsCierreAS['ID_pto']."' href='#collapse".$assoc_getQuotationsCierreAS['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsCierreAS['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsCierreAS['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsCierreAS['cli_desc']."</a>";
           }
     echo "</div>
            <div id='collapse".$assoc_getQuotationsCierreAS['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsCierreAS['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsCierreAS['obr_desc']."</a></p>";


                //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaCierreAS=$assoc_getQuotationsCierreAS['obr_URL'];
                  $diremapCierreAS         = explode('?', $direccionMapaCierreAS);
                  if (!isset($diremapCierreAS[1])) 

                  {
                      $Mobile_DetectCierreAS="http://maps.google.com?daddr=".$assoc_getQuotationsCierreAS['obr_dir']."";
                      $direccionCierreAS="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionCierreAS="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectCierreAS="geo:0,0?daddr=".$diremapCierreAS[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectCierreAS="http://maps.apple.com/maps?saddr=".$diremapCierreAS[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectCierreAS="maps:".$diremapCierreAS[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectCierreAS = "http://maps.google.com?daddr=".$diremapCierreAS[1]."";
                      } 

                   } 
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "<p><i class='material-icons' style='vertical-align: middle'>place</i> <strong>Tienda:</strong><a href='".$Mobile_DetectCierreAS."'>".$assoc_getQuotationsCierreAS['obr_desc']."   ".$assoc_getQuotationsCierreAS['obr_desc']."</a>".$direccionCierreAS."</p>";


                if ($assoc_getQuotationsCierreAS['pto_contacto'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsCierreAS['pto_contacto']."</p>";
                 }

                   if ($assoc_getQuotationsCierreAS['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsCierreAS['obr_mail']."'>".$assoc_getQuotationsCierreAS['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsCierreAS['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsCierreAS['obr_tel']."'>".$assoc_getQuotationsCierreAS['pto_telefono']."</a></p>";
                 }
               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsCierreAS['pto_fecIngreso']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>assignment_ind</i> <strong>Presupuestista: </strong>".$usuarios->genereaUsuariosNomApe($assoc_getQuotationsCierreAS['pto_asignado'])."</p>";

               if ($assoc_getQuotationsCierreAS['ser_cod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio: </strong>".$assoc_getQuotationsCierreAS['ser_cod']."</p>";
                 } 
               

              echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado: </strong>".$assoc_getQuotationsCierreAS['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado: </strong>".$assoc_getQuotationsCierreAS['pto_fecPresupuesto']."</p>

                   <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Despachado: </strong>".$assoc_getQuotationsCierreAS['pto_fecDespacho']."</p>

                   <p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Servicio: </strong>". $assoc_GetRegistroServicioByIdPto['ser_cod']."</p>";

                echo "<div style='display: inline-flex' align='center'>

                  <button type='button' class='btn btn-success' data-toggle='modal' title='Cerrar' data-placement='top' data-target='#".$assoc_getQuotationsCierreAS['ID_pto']."cierre' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>";

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsCierreAS['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsCierreAS['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_getQuotationsCierreAS['ID_pto']."Eliminarcierre'><i class='material-icons'>delete_forever</i></button>
               </div>";

           echo "</td>
          </tr>"; 

  }
      
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' colspan='3'>No. Pedido</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
    <!-- Fin div Cierre-->
 

  </div>
  </div>
  <!-- FIN SOLAPA PRINCIPAL-->

    <!-- INICIO SOLAPA RECHAZADOS-->
   <div class="tab-pane fade" id="Rechazados" >
      <!-- Inicio div Rechazados -->
      <div class="col-md-4" style=" background-color:#fff; margin-top:10px; border: 4px solid #333; -webkit-border-radius: 15px; -moz-border-radius: 15px;">
      <h3><i class="material-icons">pan_tool</i> Rechazados</h3>
           <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
           
          </tr>
          <tr>
            <th style='text-align: center;' colspan='3'>No. Pedido</th>
          </tr>
        </thead>
        <tbody id='myTable'>

 <?php

  for($d=0; $d<$num_getQuotationsRechazado; $d++)
  {
    $assoc_getQuotationsRechazado       = mysql_fetch_assoc($getQuotationsRechazado);
    $ID_pto                             = $assoc_getQuotationsRechazado['ID_pto'];
    $ID_sta                             = $assoc_getQuotationsRechazado['ID_sta'];
    $getQuotations                      = $quotations->getQuotationsModifyAS($ID_pto);
    $assoc_getQuotations                = mysql_fetch_assoc($getQuotations);

    $ID_tpu="11";
    $getUsuariosByIdTpu = $usuarios->getUsuariosByIdTpu($ID_tpu);
    $num_getUsuariosByIdTpu = mysql_num_rows($getUsuariosByIdTpu);
    /* Inicio Modal devolver*/                          
    echo '<div class="modal fade" id="'.$assoc_getQuotationsRechazado['ID_pto'].'devolver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reasignar Presupuesto- '.$assoc_getQuotationsRechazado['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body">
                   <div class="alert alert-success" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>Usted esta a punto de devolver al flujo un presupuesto rechazado </p>
                    </div>
                    <form action="actions-quotation-as.php" method="post" id="devolverPresupuestado" name="rechazarPresupuestado" enctype="multipart/form-data">';
                      
                       echo '<div class="form-group" style="margin: 3%;">';
                     echo '<label for="exampleInputEmail1">Responsable</label>';
                    echo '<select class="form-control" name="pto_asignado" >';
                     echo '<option value="'.$assoc_getQuotations['ID_usu'].'" selected>'.$assoc_getQuotations['usu_nombre'].' '.$assoc_getQuotations['usu_apellido'].'</option>';
                    for ($b=0; $b < $num_getUsuariosByIdTpu; $b++)
                     { 
                        $assoc_getUsuariosByIdTpu=mysql_fetch_assoc($getUsuariosByIdTpu);
                           echo '<option value="'.$assoc_getUsuariosByIdTpu['ID_usu'].'">'.$assoc_getUsuariosByIdTpu['usu_nombre'].' '.$assoc_getUsuariosByIdTpu['usu_apellido'].'</option>';
                     }
                    echo '<select>';
                    echo '</div>';


              echo '<div class="form-group">
                    <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsRechazado['ID_pto'].'" >
                    <input type="hidden" name="ID_sta" value="12">
                    <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsRechazado['pto_pedidoCod'].'" >
                    <input type="hidden" name="actionAS" value="devolver">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">replay</i> Si</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal devolver devolver */

   /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsRechazado['ID_pto'].'EliminarRechazados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Instalacion - '.$assoc_getQuotationsRechazado['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <div class="alert alert-danger" role="alert">
                      <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
                      <p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <form class="form-horizontal" action="actions-quotation-as.php" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="actionAS" value="delete" />
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsRechazado['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsRechazado['pto_asignado'].'" />
                          <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">delete_forever</i> Eliminar</button> 
                          </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>';
          /* Fin Modal Eliminar */

                                    
                      
    echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_getQuotationsRechazado['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
             if ($assoc_getQuotationsRechazado['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsRechazado['ID_pto']."' href='#collapse".$assoc_getQuotationsRechazado['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsRechazado['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsRechazado['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsRechazado['cli_desc']." - ". $assoc_getQuotationsRechazado['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsRechazado['ID_pto']."' href='#collapse".$assoc_getQuotationsRechazado['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsRechazado['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsRechazado['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsRechazado['cli_desc']."</a>";
           }
            echo " </div>
            <div id='collapse".$assoc_getQuotationsRechazado['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsRechazado['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsRechazado['obr_desc']."</a></p>";

                     //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaRechazado=$assoc_getQuotationsRechazado['obr_URL'];
                  $diremapRechazado         = explode('?', $direccionMapaRechazado);
                  if (!isset($diremapRechazado[1])) 

                  {
                      $Mobile_DetectRechazado="http://maps.google.com?daddr=".$assoc_getQuotationsRechazado['obr_dir']."";
                      $direccionRechazado="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionRechazado="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectRechazado="geo:0,0?daddr=".$diremapRechazado[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectRechazado="http://maps.apple.com/maps?saddr=".$diremapRechazado[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectRechazado="maps:".$diremapRechazado[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectRechazado = "http://maps.google.com?daddr=".$diremapRechazado[1]."";
                      } 

                   } 
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "<p><i class='material-icons' style='vertical-align: middle'>place</i> <strong>Tienda:</strong><a href='".$Mobile_DetectRechazado."'>".$assoc_getQuotationsRechazado['obr_desc']."   ".$assoc_getQuotationsRechazado['obr_desc']."</a>".$direccionRechazado."</p>";

                   if ($assoc_getQuotationsRechazado['pto_contacto'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsRechazado['pto_contacto']."</p>";
                 }

                   if ($assoc_getQuotationsRechazado['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsRechazado['obr_mail']."'>".$assoc_getQuotationsRechazado['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsRechazado['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsRechazado['obr_tel']."'>".$assoc_getQuotationsRechazado['pto_telefono']."</a></p>";
                 }

              echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsRechazado['pto_fecIngreso']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>assignment_ind</i> <strong>Presupuestista:</strong> ".$usuarios->genereaUsuariosNomApe($assoc_getQuotationsRechazado['pto_asignado'])."</p>";

               if ($assoc_getQuotationsRechazado['ser_cod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio:</strong>".$assoc_getQuotationsRechazado['ser_cod']."</p>";
                 } 
               

              echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado:</strong> ".$assoc_getQuotationsRechazado['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado:</strong> ".$assoc_getQuotationsRechazado['pto_fecPresupuesto']."</p>

                   <p><i class='material-icons' style='vertical-align: middle'>access_time</i>  <strong>Despachado:</strong>".$assoc_getQuotationsRechazado['pto_fecDespacho']."</p>";

                echo "<div style='display: inline-flex' align='center'>

                  <button type='button' class='btn btn-success' data-toggle='modal' title='Devolver' data-placement='top' data-target='#".$assoc_getQuotationsRechazado['ID_pto']."devolver' style='margin-right: 10px'><i class='material-icons center'>replay</i></button>";

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsRechazado['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsRechazado['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_getQuotationsRechazado['ID_pto']."EliminarRechazados'><i class='material-icons'>delete_forever</i></button>
               </div>";

           echo "</td>
          </tr>";

  }
      
?>
        </tbody>
          <tfoot>
            <tr>
              <th style='text-align: center;' colspan='3'>No. Pedido</th>
            </tr>
          </tfoot>
        </table>
      </div>
      </div>
    <!-- Fin div Rechazados -->
   </div>
    <!-- FIN SOLAPA RECHAZADOS-->

  <!-- INICIO SOLAPA HISTORIAL-->  
  <div class="tab-pane fade" id="Historial">   

      <div  name='filtros' class='filtros' id='filtros'>
       <div style="margin: 5px;  width: 150px;">
         <h5 style="margin: 5px;"><strong><i class="material-icons">search</i> BUSCAR POR CODIGO:</strong></h5>
          <HR class='negra'>
         <input type="text" name="codigo" class="form-control" id="codigo"></input> 
         <button  type='button' class='btn btn-success' title='buscar'  id='buscar' name='buscar' data-placement='top' style='margin-top: 10px; width: 100%;'>
           <i class='material-icons center'>
             autorenew
            </i>
            Buscar
         
            
            <br>
             </div>  
               <br>
                 <br>
         <div style="margin: 5px;  width: 150px;">
            <br>
            <h5 style="margin: 5px;"><strong><i class="material-icons">filter_list</i> FILTRAR POR:</strong></h5><HR class='negra'>
          </div>  
           <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON USUARIOS-->
          <div class='filasFiltros' name='formulario_usuario' class='formulario_usuario' id='formulario_usuario'>
             <select class='form-control' name='filtro_usuario' id='filtro_usuario'>
             <option selected disabled>USUARIOS:</option>
              <?php 
                 $getQuotationsUsuarios = $quotations->getQuotationsUsuarios();
                 $num_getQuotationsUsuarios = mysql_num_rows($getQuotationsUsuariosHistorialASQuotationsUsuarios);
                 for ($usu=0; $usu < $num_getQuotationsUsuarios; $usu++)
                  { 
                    $assoc_getQuotationsUsuarios = mysql_fetch_assoc($getQuotationsUsuarios);
                   echo "<option value='".$assoc_getQuotationsUsuarios['ID_usu']."'>".$assoc_getQuotationsUsuarios['usu_nombre']." ".$assoc_getQuotationsUsuarios['usu_apellido']."</option>";
                  }
               ?>  
             </select> 
          </div>
           <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON USUARIOS-->

           <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON ASIGNADOS-->
          <div class='filasFiltros' name='formulario_asignado' class='formulario_asignado' id='formulario_asignado'>
      
             <select class='form-control' name='filtro_asignado' id='filtro_asignado'>
               <option selected disabled>ASIGNADOS:</option>
               <?php 
                 $getQuotationsUsuariosB = $quotations->getQuotationsUsuariosHistorialAS();
                 $num_getQuotationsUsuariosB = mysql_num_rows($getQuotationsUsuariosB);
                 for ($usuB=0; $usuB < $num_getQuotationsUsuariosB; $usuB++)
                  { 
                    $assoc_getQuotationsUsuariosB = mysql_fetch_assoc($getQuotationsUsuariosB);
                   echo "<option value='".$assoc_getQuotationsUsuariosB['ID_usu']."'>".$assoc_getQuotationsUsuariosB['usu_nombre']." ".$assoc_getQuotationsUsuariosB['usu_apellido']."</option>";
                  }
               ?>  
             </select> 
          </div>
          <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON ASIGNADOS-->

        
          <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON CLIENTES-->
          <div class='filasFiltros' name='formulario_cliente' class='formulario_cliente' id='formulario_cliente'>
             <select class='form-control' name='filtro_cliente' id='filtro_cliente'>
               <option selected disabled>CLIENTES:</option>
                 <?php 
                  $getQuotationsClientes = $quotations->getQuotationsClientesHistorialAS();
                  $num_getQuotationsClientes = mysql_num_rows($getQuotationsClientes);
                  for ($clientei=0; $clientei < $num_getQuotationsClientes; $clientei++)
                   { 
                      $assoc_getQuotationsClientes = mysql_fetch_assoc($getQuotationsClientes);

                      echo "<option value='".$assoc_getQuotationsClientes['ID_cli']."'>".$assoc_getQuotationsClientes['cli_desc']."</option>";
                   }
                   ?>
             </select> 
          </div>
          <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON CLIENTES-->

          <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON TIENDA-->
          <div class='filasFiltros' name='formulario_tienda' class='formulario_tienda' id='formulario_tienda'>
           
             <select class='form-control' name='filtro_tienda' id='filtro_tienda'>
               <option selected disabled>TIENDAS:</option>
            
             </select> 
          </div>

              <script language="javascript">
                $(document).ready(function(){
                   $("#filtro_cliente").change(function () {
                           $("#filtro_cliente option:selected").each(function () {
                            elegido=$(this).val();
                            $.post("quotations-combosDependientes.php", { elegido: elegido }, function(data){
                            $("#filtro_tienda").html(data);
                            });            
                        });
                   })
                });
              </script>

          <div class='filasFiltros'>
            <select class='form-control' name='filtro_estados' id='filtro_estados' multiple>
               <option selected disabled>ESTADOS:</option>
                  
                   <?php 
                        $getQuotationsStatus = $quotations->getQuotationsStatusHistorialAS();
                        $num_getQuotationsStatus = mysql_num_rows($getQuotationsStatus);
                        for ($statusi=0; $statusi < $num_getQuotationsStatus; $statusi++)
                         { 
                            $assoc_getQuotationsStatus = mysql_fetch_assoc($getQuotationsStatus);

                             echo "<option value='".$assoc_getQuotationsStatus['ID_sta']."'>".$assoc_getQuotationsStatus['sta_desc']."</option>";   

                        }?>
          </select>
        </div>  
         
          <div class='filasFiltros' name='formulario_fecha' class='formulario_fecha' id='formulario_fecha'>
                   
               Desde: <input type="date" name='filtro_fecha_desde' id='filtro_fecha_desde' class='form-control'>
                Hasta: <input type="date" name='filtro_fecha_hasta' id='filtro_fecha_hasta' class='form-control'>
               
          </div>

          <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON FECHAS-->

           <!--INICIO BOTON EJECUTAR FILTROS-->
             <div class='filasFiltros'>
          
          <button  type='button' class='btn btn-success' title='filtrar'  id='filtrar' name='filtrar' data-placement='top' style='margin-top: 10px; width: 100%;'>
           <i class='material-icons center'>
             autorenew
            </i>
            Filtrar
         
          <br> 
          <br> 

            <img src=images/cargando4.gif id='cargandoBoton' style="display: none; width: 100%; height: auto;" > 
          </button>
          <br>
          <br>
          <!--FIN BOTON EJECUTAR FILTROS-->

          <!--INICIO BOTON EJECUTAR FILTROS-->
          <hr class='negra'>
         
          <button  type='button' class='btn btn-default' title='limpiarFiltros'  id='limpiarFiltros' name='limpiarFiltros' data-placement='top' style='margin-top: 10px; width: 100%;'>
            <i class='material-icons center'>
             layers_clear
            </i> Limpiar filtros
          </button>
          <br> 

          <!--FIN BOTON EJECUTAR FILTROS-->

          <!--INICIO BOTON VER TODOS-->
        
          <button  type='button' class='btn btn-default' title='cargarFiltros'  id='cargarFiltros' name='cargarFiltros' data-placement='top' style='margin-top: 10px; width: 100%;'>
            <i class='material-icons center'>
              search
            </i> Ver Todos
          </button>
          <br> <br>
          
 </div>

          <!--FIN BOTON VER TODOS-->
            
      </div>

        <div  name='cargaexterna' class='cargaexterna' id='cargaexterna'">

        </div>
   
  </div>

  </div>


<!-- Fin: Div general-->

<!--Inicio: footer-->  
<?php
require_once('inc/footer.php');
?>
<!--Fin: footer-->  

<!--Inicio: Jquery-->  
  <script type="text/javascript">

// Inicio: barra cargando de ajax
  var cargandoBoton = $("#cargandoBoton");

  $(document).ajaxStart(function() {
    cargandoBoton.show();
  });

  $(document).ajaxSuccess(function() {
    cargandoBoton.hide();
  });
// Fin: barra cargando de ajax 

// Inicio: formulario de ingreso desplegable
  
      $("#botonVerNuevo").click(function(){

        $("#formularioNuevo").toggle("slow");
        $("#botonVerNuevo").toggle("slow");

      });

       $("#botonOcultarNuevo").click(function(){

        $("#formularioNuevo").toggle("slow");
        $("#botonVerNuevo").toggle("slow");

      });

// Fin: formulario de ingreso desplegable



  </script>



<!--Fin: Jquery-->  

 </div> 

</div>

</div>



<?php

  echo '<script>

            $("#limpiarFiltros").click(function(evento){
               $("#filtro_usuario").prop("selectedIndex",0);

               $("#filtro_fecha_hasta").val("");
                $("#filtro_fecha_desde").val("");
               $("#filtro_asignado").prop("selectedIndex",0);
               $("#filtro_cliente").prop("selectedIndex",0);
               $("#filtro_tienda").prop("selectedIndex",0);
              $("#filtro_estados").prop("selectedIndex",0);
               });


              $(document).ready(function(evento){

                  $("#cargarFiltros").click(function(evento){
                        evento.preventDefault();
                        var desde       = "vacio";
                        var ID_usu      = "vacio";
                        var pto_asignado = "vacio";
                        var ID_cli      = "vacio";
                        var ID_obr      = "vacio";
                        var ID_sta      = "vacio";
                            $("#cargaexterna").load
                        ("quotations-filtroAS-manager.php", {
                                                    desde: desde,
                                                    ID_usu: ID_usu,
                                                    pto_asignado: pto_asignado,
                                                    ID_cli : ID_cli,
                                                    ID_obr: ID_obr,
                                                    ID_sta:ID_sta
                                                  }, function(){
                         });
 }); 


                        $("#filtrar").click(function(evento){

                          if ($(filtro_fecha_desde).val().length > 1) {
                              if ($(filtro_fecha_hasta).val().length > 1) {
                                var desde             = "pto_fecIngreso BETWEEN \'" + $("#filtro_fecha_desde").val() + " 00:00:00\' AND \'" + $("#filtro_fecha_hasta").val() + " 00:00:00\'";
                            
                                }
                                else 
                                {
                              
                                }
                          }
                          else
                           {
                         
                           var desde       = "vacio";
                          
                           } 

                          if ($("#filtro_usuario").val()!=null) {
                          var ID_usu            = "ID_usu="+$("#filtro_usuario").val();
                           }
                         else
                         {
                           var ID_usu      = "vacio";
                         }


                          if ($("#filtro_asignado").val()!=null) {
                            var pto_asignado      = "pto_asignado="+$("#filtro_asignado").val();
                          }
                         else
                         {
                          var pto_asignado      = "vacio";
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
                            

                          if ($("#filtro_estados").val() != 0)

                           {$("#filtro_estados").on("change",function() {
                                      ID_sta=$(this).val();
                                      console.log($(this).val());
                                    });
                               }
                          else
                           {
                         
                            ID_sta       = "vacio";
                          
                           }     
                        

                           
                  
                           evento.preventDefault();
                            $("#cargaexterna").load
                        ("quotations-filtroAS-manager.php", {
                                                    desde: desde,
                                                    ID_usu: ID_usu,
                                                    pto_asignado: pto_asignado,
                                                    ID_cli : ID_cli,
                                                    ID_obr: ID_obr,
                                                    ID_sta: ID_sta
                                                 
                                                 
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
                        ("quotations-filtroAS-manager.php", {ID_pto: "'.@$ID_pto.'"}, function(){
                      });});});
  </script>';
  echo '<script>
              $(document).ready(function(){
                     $("#buscar").click(function(evento){
                        evento.preventDefault();
                        var codigo      = $("#codigo").val();
                        $("#cargaexterna").load
                        ("quotations-filtroAS-manager.php", {codigo: codigo}, function(){
                      });});});

  </script>';
?>



<!--FIN QUERYS DE FILTROS-->

  
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

   <div class="col-md-12">
       <div class="col-md-2">
            <div id="SolapaAccepted" class="solapa">
              <h5>
                Aceptados (<?php echo $num_getQuotationsAccepted?>)  <i id="contraerBAccepted" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
        <div class="col-md-2">
            <div id="SolapaAsignado" class="solapa">
              <h5>
                Asignados (<?php echo $num_getQuotationsInserted?>)  <i id="contraerBAsignado" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
        <div class="col-md-2">
            <div id="SolapaPresupuestados" class="solapa">
              <h5>
                Presup. (<?php echo $num_getQuotationsBudgeted?>)  <i id="contraerBPresupuestados" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
        <div class="col-md-2">
           <div id="SolapaDespacho" class="solapa">
              <h5>
                Despacho (<?php echo $num_getQuotationsDespacho?>)  <i id="contraerBDespacho" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
          </div>
       </div>
       <div class="col-md-2">
            <div id="SolapaInstalacion" class="solapa">
              <h5>
                Instalación (<?php echo $num_getQuotationsInstalacion?>)  <i id="contraerBInstalacion" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
         <div class="col-md-2">
            <div id="SolapaCierre" class="solapa">
              <h5>
                Cierre(<?php echo $num_getQuotationsCierreAS?>)  <i id="contraerBCierre" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
    </div>



<!-- Inicio jquery controles de columnas -->
<script>
   $("#expandirAccepted").click(function() {
   $("#ExpandirAccepted").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirAccepted").css("display", "none");
   $("#contraerAccepted").css("display", "block");
   $("#iconoAccepted").css("display", "none");
   });
   $("#contraerAccepted").click(function() {
   $("#ExpandirAccepted").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
   $("#expandirAccepted").css("display", "block");
   $("#contraerAccepted").css("display", "none");
   $("#iconoAccepted").css("display", "block");
   });
   $("#cerrarColumnaAccepted").click(function() {
   $("#ExpandirAccepted").hide( 1000 )});
   $("#minimizarAccepted").click(function() {
   $("#ExpandirAccepted").hide(1000);
   $("#SolapaAccepted").css("display", "block").fadeIn(100);
   });
   $("#contraerBAccepted").click(function() {
   $("#ExpandirAccepted").css("display", "block").fadeIn(100);
   $("#SolapaAccepted").css("display", "none");
});

   $("#expandirAsignado").click(function() {
   $("#ExpandirAsignado").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirAsignado").css("display", "none");
   $("#contraerAsignado").css("display", "block");
   $("#iconoAsignado").css("display", "none");
   });
   $("#contraerAsignado").click(function() {
   $("#ExpandirAsignado").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
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

   $("#expandirPresupuestados").click(function() {
   $("#ExpandirPresupuestados").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirPresupuestados").css("display", "none");
   $("#contraerPresupuestados").css("display", "block");
   $("#iconoPresupuestados").css("display", "none");
   });
   $("#contraerPresupuestados").click(function() {
   $("#ExpandirPresupuestados").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
   $("#expandirPresupuestados").css("display", "block");
   $("#contraerPresupuestados").css("display", "none");
   $("#iconoPresupuestados").css("display", "block");
   });
   $("#cerrarColumnaPresupuestados").click(function() {
   $("#ExpandirPresupuestados").hide( 1000 )});
   $("#minimizarPresupuestados").click(function() {
   $("#ExpandirPresupuestados").hide(1000);
   $("#SolapaPresupuestados").css("display", "block").fadeIn(100);
   });
   $("#contraerBPresupuestados").click(function() {
   $("#ExpandirPresupuestados").css("display", "block").fadeIn(100);
   $("#SolapaPresupuestados").css("display", "none");
});

   $("#expandirDespacho").click(function() {
   $("#ExpandirDespacho").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirDespacho").css("display", "none");
   $("#contraerDespacho").css("display", "block");
   $("#iconoDespacho").css("display", "none");
   });
   $("#contraerDespacho").click(function() {
   $("#ExpandirDespacho").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
   $("#expandirDespacho").css("display", "block");
   $("#contraerDespacho").css("display", "none");
   $("#iconoDespacho").css("display", "block");
   });
   $("#cerrarColumnaDespacho").click(function() {
   $("#ExpandirDespacho").hide( 1000 )});
   $("#minimizarDespacho").click(function() {
   $("#ExpandirDespacho").hide(1000);
   $("#SolapaDespacho").css("display", "block").fadeIn(100);
   });
   $("#contraerBDespacho").click(function() {
   $("#ExpandirDespacho").css("display", "block").fadeIn(100);
   $("#SolapaDespacho").css("display", "none");
});

   $("#expandirInstalacion").click(function() {
   $("#ExpandirInstalacion").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirInstalacion").css("display", "none");
   $("#contraerInstalacion").css("display", "block");
   $("#iconoInstalacion").css("display", "none");
   });
   $("#contraerInstalacion").click(function() {
   $("#ExpandirInstalacion").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
   $("#expandirInstalacion").css("display", "block");
   $("#contraerInstalacion").css("display", "none");
   $("#iconoInstalacion").css("display", "block");
   });
   $("#cerrarColumnaInstalacion").click(function() {
   $("#ExpandirInstalacion").hide( 1000 )});
   $("#minimizarInstalacion").click(function() {
   $("#ExpandirInstalacion").hide(1000);
   $("#SolapaInstalacion").css("display", "block").fadeIn(100);
   });
   $("#contraerBInstalacion").click(function() {
   $("#ExpandirInstalacion").css("display", "block").fadeIn(100);
   $("#SolapaInstalacion").css("display", "none");
});
   
   $("#expandirCierre").click(function() {
   $("#ExpandirCierre").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirCierre").css("display", "none");
   $("#contraerCierre").css("display", "block");
   $("#iconoCierre").css("display", "none");
   });
   $("#contraerCierre").click(function() {
   $("#ExpandirCierre").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
   $("#expandirCierre").css("display", "block");
   $("#contraerCierre").css("display", "none");
   $("#iconoCierre").css("display", "block");
   });
   $("#cerrarColumnaCierre").click(function() {
   $("#ExpandirCierre").hide( 1000 )});
   $("#minimizarCierre").click(function() {
   $("#ExpandirCierre").hide(1000);
   $("#SolapaCierre").css("display", "block").fadeIn(100);
   });
   $("#contraerBCierre").click(function() {
   $("#ExpandirCierre").css("display", "block").fadeIn(100);
   $("#SolapaCierre").css("display", "none");
});
</script>
<!-- fin jquery controles de columnas -->

<!-- Inicio footer -->
<?php
require_once ('inc/footer.php');
?>
<!-- Fin footer -->





   
