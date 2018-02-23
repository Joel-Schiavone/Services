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
 
    $getQuotationsDespacho          = $quotations->getQuotationsDespacho();
    $num_getQuotationsDespacho      = mysql_num_rows($getQuotationsDespacho);

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

  hr.negra {
    display: block;
    height: 5px;
    border: 0;
    border-top: 1px solid #333;
    margin: 1em 0;
    padding: 0; 
    }
    #direccion
{
  color: #f00;
  font-size: 85%;
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


<!-- Inicio div Despacho -->
      <div class="col-md-12" style=" background-color:#fff; margin-top:10px; border: 4px solid #333; -webkit-border-radius: 15px; -moz-border-radius: 15px;">
    <h3><i class="material-icons" style="vertical-align: middle;">local_shipping</i> Despacho (<?php echo $num_getQuotationsDespacho?>)</h3>

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

                  
                     echo ' 
                   <div class="modal fade" id="'.$assoc_getQuotationsDespacho['ID_pto'].'Despachado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                        echo '<input type="number" class="form-control" name="pto_remito" placeholder="No. Remito (SAP)" required></input>';
                                      echo '</div>';

                                        echo '<input type="hidden" name="actionAS" value="despachado"></input>
                                              <input type="hidden" name="ID_cli"        value="'.$assoc_getQuotationsDespacho['ID_cli'].'"        ></input>
                                              <input type="hidden" name="ID_obr"        value="'.$assoc_getQuotationsDespacho['ID_obr'].'"        ></input>
                                              <input type="hidden" name="ID_pri"        value="'.$assoc_getQuotationsDespacho['ID_pri'].'"        ></input>
                                              <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsDespacho['pto_pedidoCod'].'" ></input>
                                              <input type="hidden" name="ID_pto"        value="'.$assoc_getQuotationsDespacho['ID_pto'].'"        ></input>
                                              <input type="hidden" name="ID_usu"        value="'.$assoc_getQuotationsDespacho['ID_usu'].'"        ></input>
                                              <input type="hidden" name="pto_mail"      value="'.$assoc_getQuotationsDespacho['pto_mail'].'"      ></input>
                                              <input type="hidden" name="ID_tpp"        value="'.$assoc_getQuotationsDespacho['ID_tpp'].'"        ></input>
                                              <input type="hidden" name="pto_contacto"  value="'.$assoc_getQuotationsDespacho['pto_contacto'].'"  ></input>
                                              <input type="hidden" name="pto_asignado"  value="'.$assoc_getQuotationsDespacho['pto_asignado'].'"  ></input>
                                              <input type="hidden" name="ser_cod"       value="'.$assoc_getQuotationsDespacho['ser_cod'].'"       ></input>
                                              <textarea type="hidden" name="pto_desc" >'.$assoc_getQuotationsDespacho['pto_desc'].'</textarea>
                                              <input type="hidden" name="pto_telefono"  value="'.$assoc_getQuotationsDespacho['pto_telefono'].'"  ></input>

                                              <input type="checkbox" name="Parcial"> Envío Parcial</input><br><br>

                                              <button type="submit" class="btn btn-success" data-toggle="modal" title="Despachar" data-placement="top" style="margin-right: 10px"><i class="material-icons center">local_shipping</i></button>';
                                
                                     echo '</form>';
                                  echo '</div>';

                          echo'<div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>   
                                </div>
                        </div>
                      </div> ';   
      echo "<tr>
           <td style='vertical-align: middle;'>
            <div id='".$assoc_getQuotationsDespacho['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>
             <a data-toggle='collapse' data-parent='#".$assoc_getQuotationsDespacho['ID_pto']."' href='#collapse".$assoc_getQuotationsDespacho['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsDespacho['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsDespacho['pto_OV']. " - ".$assoc_getQuotationsDespacho['pto_pedidoCod']. " </b> - " .$assoc_getQuotationsDespacho['cli_desc']."</a>
            </div>
            <div id='collapse".$assoc_getQuotationsDespacho['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsDespacho['ID_obr']))/12)."' data-toggle='modal' title='Ver Tienda' target='_blank' data-placement='top'>".$assoc_getQuotationsDespacho['obr_desc']."</a></p>";

                //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaDespacho=$assoc_getQuotationsDespacho['obr_URL'];
                  $diremapDespacho      = explode('?', $direccionMapaDespacho);
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

                echo "<p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectDespacho."'> ".$assoc_getQuotationsDespacho['obr_desc']."".$assoc_getQuotationsDespacho['obr_desc']." </a>".$direccionDespacho."</p>

               <p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsDespacho['pto_contacto']."</p> 
               <p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsDespacho['pto_mail']."'>".$assoc_getQuotationsDespacho['pto_mail']."</a></p>

               <p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong> <a href='tel:".$assoc_getQuotationsDespacho['pto_telefono']."'>".$assoc_getQuotationsDespacho['pto_telefono']."</a></p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Fecha:</strong> Ingreso: ".$assoc_getQuotationsDespacho['pto_fecIngreso']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>assignment_ind</i> <strong>Presupuestista:</strong> ".$usuarios->genereaUsuariosNomApe($assoc_getQuotationsDespacho['pto_asignado'])."</p>";

               if ($assoc_getQuotationsDespacho['ser_cod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio:</strong> ".$assoc_getQuotationsDespacho['ser_cod']."</p>";
                 } 
               

              echo"<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado: </strong>".$assoc_getQuotationsDespacho['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado:</strong>".$assoc_getQuotationsDespacho['pto_fecPresupuesto']."</p>";

               if ($assoc_getQuotationsDespacho['pto_remito']!="") 
                {
                    echo '<div class="alert alert-dismissible alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Envio Parcial</strong>
                    <br> <br>
                  <p><i class="material-icons" style="vertical-align: middle">assignment_turned_in</i> <strong>Remito:</strong> '.$assoc_getQuotationsDespacho['pto_remito'].'</p></div>';

                }
                

                echo "<div style='text-align:center'>

                    <button type='button' class='btn btn-success' data-toggle='modal' title='Despachar' data-placement='top' data-target='#".$assoc_getQuotationsDespacho['ID_pto']."Despachado' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>";

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsDespacho['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsDespacho['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons'>edit</i></button></a>

                  <a href='deleteQuotationsAS.php?ID_pto=".$assoc_getQuotationsDespacho['ID_pto']."'><button type='button' class='btn btn-danger'  title='Eliminar'><i class='material-icons'>delete_forever</i></button></a>
               </div>";

           echo "</td>
          </tr>";

  }



?>
        </tbody>
        </table>
      </div>
    </div>

   
    <!-- Fin div Despacho -->

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

  $('.collapse').collapse()

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

<!-- 
<form action="actions-quotation-as.php" method="POST" enctype="multipart/form-data">
  <input type="text" name="actionAS" value="enviarMail">
  <input type="file" name="adj_ruta[]" multiple required>
  <input type="submit" name="enviar" value="Enviar">
</form>
-->

<!-- Inicio footer -->
<?php
require_once ('inc/footer.php');
?>
<!-- Fin footer -->