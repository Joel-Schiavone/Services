<?php 
    $tiendas = new tiendas;
    $getTiendasByIdBuscador = $tiendas->getTiendasById($id);
    $assoc_getTiendasByIdBuscador = mysql_fetch_assoc($getTiendasByIdBuscador);
$redireccioncorta=explode("?",$redireccion);

  if (@$seleccionado=="si")
  {

 // Inicio: Tieda input disabled 
                
     echo "<div class='col-md-12 bs-callout-info' style='background-color: #eee;' >
              <div class='form-group'>
                 <div class='form-group'>
                   
                 </div>";




//Codigo para calcular si esta en garantia o no 
/*echo "fecha inicio: " . */ $assoc_getTiendasByIdBuscador['obr_fecinreal'];
    /*echo "<br>";*/
    /*echo "fecha fin: " . */ $assoc_getTiendasByIdBuscador['obr_fecfinreal'];
    $fechaFin=$assoc_getTiendasByIdBuscador['obr_fecfinreal'];
    /*echo "<br>"; */
    //Suma 1 año a la fecha
    $fecha =  $assoc_getTiendasByIdBuscador['obr_fecfinreal'];
    $nuevafecha = strtotime ( '+1 year' , strtotime ( $fecha ) ) ;
    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
    /*echo "fecha suamda un año: " .*/$nuevafecha;
    /*echo "<br>";*/
    /*echo "fecha actual: " .*/$fechaActual=date("Y-m-d");
    /*echo "<br>";*/
    if ($fechaActual>=$fechaFin and $fechaActual<=$nuevafecha)
     {
     echo "<div class='alert alert-success' role='alert' id='alerta12' name='alerta12' >                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>                      <span aria-hidden='true'>&times;</span>                    </button>                   <h4> <i class='material-icons' style='vertical-align: middle; font-size:20px;'> done</i>  Esta Tienda está en Garantía</h4>  </div>";
     $garantia="si";
     }
    else 
     {
       echo "<div class='alert alert-danger' role='alert' id='alerta12' name='alerta12' >                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>                      <span aria-hidden='true'>&times;</span>                    </button>                   <h2> <i class='material-icons' style='vertical-align: middle; font-size:60px;'> error_outline</i>  Esta Tienda NO está en Garantía</h2>  </div>"; 
        $garantia="no";
     }
   

                 echo "<div class='input-group' id='divAnimadoD' name='divAnimadoD'>
                            <span class='input-group-addon' id='basic-addon1'>";
                              if ($cli_marker)
                              {
                                echo "<img src='".$cli_marker."' style='width: 30px; height: auto;'>";
                              }
                              else
                              {
                                echo "<img src='../images/markers/otros.png' style='width: 30px; height: auto;'>";
                              }                                               
                                echo "Tienda seleccionada:
                              </span>
                            <input id='icon_prefix' aria-describedby='basic-addon1'  type='text' name='".$id."' name='icon_prefix' class='form-control' placeholder='".$obr_desc."' autocomplete='off' style='height: 50px;' disabled>
                          </div>
                        </div> ";


                     echo '
                   
                  <div class="row" style="overflow: hidden">
                      <div class="col-md-4"> 
                         <h4>Datos del Cliente: </h4>
                          <div class="form-group">
                              <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">
                                  <i style="vertical-align: middle; " class="material-icons">
                                    person_pin_circle 
                                  </i>
                                  '.$assoc_getTiendasByIdBuscador['cli_desc'].'
                               </div> 
                          </div>    
                          <div class="form-group">
                              <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">
                                  <i style="vertical-align: middle;" class="material-icons">
                                    store
                                  </i>
                                  '.$assoc_getTiendasByIdBuscador['obr_desc'].'
                              </div> 
                           </div>    
                           <div class="form-group">
                              <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">     
                                   <i style="vertical-align: middle;" class="material-icons">
                                    place
                                  </i>
                                  '.$assoc_getTiendasByIdBuscador['obr_dir'].'
                              </div> 
                            </div>    
                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">     
                                    <i style="vertical-align: middle; " class="material-icons">
                                      face
                                    </i>
                                    '.$assoc_getTiendasByIdBuscador['obr_contacto'].'
                                </div> 
                            </div>    
                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">     
                                    <i style="vertical-align: middle;" class="material-icons">
                                      mail_outline
                                    </i>
                                    '.$assoc_getTiendasByIdBuscador['obr_mail'].'
                                 </div> 
                            </div>     

                        </div>  ';

                        if ($assoc_getTiendasByIdBuscador['obr_callcenter']) 
                        {
                            echo '<div class="col-md-4">         
                         <h4>Datos del Call Center: </h4>
                              <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">     
                                    <i style="vertical-align: middle;" class="material-icons">
                                      headset_mic
                                    </i>
                                    '.$assoc_getTiendasByIdBuscador['obr_callcenter'].'
                                 </div> 
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">     
                                    <a href="tel:+'.$assoc_getTiendasByIdBuscador['obr_telcall'].'"><i style="vertical-align: middle;" class="material-icons">
                                      phone
                                    </i>
                                    '.$assoc_getTiendasByIdBuscador['obr_telcall'].'
                                 </div> </a>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">     
                                    <i style="vertical-align: middle;" class="material-icons">
                                      mail_outline
                                    </i>
                                    '.$assoc_getTiendasByIdBuscador['obr_mailcall'].'
                                 </div> 
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">     
                                    <i style="vertical-align: middle;" class="material-icons">
                                      contact_phone
                                    </i>
                                    '.$assoc_getTiendasByIdBuscador['obr_contactocall'].'
                                 </div> 
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-11" style="margin: 5px;">     
                                    <i style="vertical-align: middle;" class="material-icons">
                                      receipt
                                    </i>
                                    '.$assoc_getTiendasByIdBuscador['obr_ticketinterno'].'
                                 </div> 
                            </div>
                      </div>
                      <div class="col-md-4">
                         <h4>Datos del Ubicación: </h4>         
                          <input hidden id="geocomplete" type="text" value="'.$assoc_getTiendasByIdBuscador['obr_dir'].'" class="input-group-field">
                           <input hidden id="find" type="button" value="Buscar" class="button" />
                            <div class="map_canvas" style="height:200px; width: 100%;">
                            </div>
                      </div>';
                        }
                        else
                        {
                           echo '<div class="col-md-8">         
                          <input hidden id="geocomplete" type="text" value="'.$assoc_getTiendasByIdBuscador['obr_dir'].'" class="input-group-field">
                           <input hidden id="find" type="button" value="Buscar" class="button" />
                            <div class="map_canvas" style="height:200px; width: 100%;">
                            </div>
                           </div>';
                        }
                   
              echo '</div>    
                  </div>';
                // Fin: Tieda input disabled 


    ?> 
      

  <?php
    }  
   else
    {
      echo "<div class='row' id='selectTiendas' name='selectTiendas' style='display:none; margin-right: 5px; margin-left: 5px; margin-top: 10px; '>
                      <div class='col-md-10 col-md-offset-1'  >
                        <span >
                          <h2 style='color: #fff'><?php echo $Titulo;?></h2>
                        </span>
                        <div class='form-group'>
                          <div class='input-group'>
                            <span class='input-group-addon' id='basic-addon1'>
                               <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                 store
                              </i>
                            </span>
                            <input type='hidden' name='redireccion' value='".$redireccion."'>";

                              if ($AgregarCliente=='si' AND $AgregarTienda=='no')
                              {
                                $ancho="75%";
                                echo "<input id='icon_prefix' aria-describedby='basic-addon1'  type='text'  name='icon_prefix' class='form-control' placeholder='".$placeholder."' autocomplete='off' style='height: 50px; width: ".$ancho.";'>";
                                 echo "<a href='new-customer.php?url=".$_SERVER['REQUEST_URI']."'><button type='bottom' class='btn btn-success' style='height: 50px; width: 25%; text-align: center;'><i class='material-icons' style='vertical-align: middle;'> add </i> Agregar un Cliente</button></a>";
                                 
                              }
                              if ($AgregarTienda=="si" AND $AgregarCliente=="no") {
                                $ancho="75%";
                                echo "<input id='icon_prefix' aria-describedby='basic-addon1'  type='text'  name='icon_prefix' class='form-control' placeholder='".$placeholder."' autocomplete='off' style='height: 50px; width: ".$ancho.";'>";
                                echo "<a href='new-store.php?url=".$_SERVER['REQUEST_URI']."'><button type='bottom' class='btn btn-success' style='height: 50px; width: 25%; text-align: center;'><i class='material-icons' style='vertical-align: middle;'> add </i> Agregar una Tienda</button></a>";
                                 
                              }
                              if($AgregarCliente=="si" AND $AgregarTienda=="si")
                              {
                                $ancho="50%";
                                echo "<input id='icon_prefix' aria-describedby='basic-addon1'  type='text'  name='icon_prefix' class='form-control' placeholder='".$placeholder."' autocomplete='off' style='height: 50px; width: ".$ancho.";'>";
                                echo "<a href='new-customer.php?url=".$_SERVER['REQUEST_URI']."'><button type='bottom' class='btn btn-success' style='height: 50px; width: 25%; text-align: center;'><i class='material-icons' style='vertical-align: middle;'> add </i> Agregar un Cliente</button></a>";
                                 echo "<a href='new-store.php?url=".$_SERVER['REQUEST_URI']."'><button type='bottom' class='btn btn-success' style='height: 50px; width: 25%; text-align: center;'><i class='material-icons' style='vertical-align: middle;'> add </i> Agregar una Tienda</button></a>";
                                  
                              } 
                              if($AgregarCliente=="no" AND $AgregarTienda=="no")
                              {
                                 $ancho="100%";
                                  echo "<input id='icon_prefix' aria-describedby='basic-addon1'  type='text'  name='icon_prefix' class='form-control' placeholder='".$placeholder."' autocomplete='off' style='height: 50px; width: ".$ancho.";'>";
                              }
                             
                             
                    echo "</div>
                            <div id='suggestions' class='suggestions'>
                            </div>
                        </div>
                      </div>
                    </div>
        


      <script type='text/javascript'>
          $('#icon_prefix').keypress(function()
            {
              var icon_prefix = $(this).val();   
              var redireccion =  $(this).val();    
              var dataString = 'icon_prefix='+icon_prefix;
              $.ajax(
              {
                  type: 'POST',
                  url: 'autocomplete-universal-cliente-tienda.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestions').fadeIn(1000).html(data);
                      $('.suggest-element').on('click', function()
                        {
                          var valorInput = $('#icon_prefixx').html();
                          $('#icon_prefix').val(valorInput);
                          $('#suggestions').fadeOut(1000);
                        });              
                   }
               });
           });


      $(window).ready(function(){ 
        $('#selectTiendas').toggle('slow');

      });


            </script> ";
   } ?>

 <script>
           $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });
           $(document).ready(function(){
          $("#geocomplete").trigger("geocode");
        });
      });
       </script>
      <script src="../js/jquery.geocomplete.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn4bcKTSDiSjBQiRTWaQ1VTAik07m-tZ8&libraries=places"></script>