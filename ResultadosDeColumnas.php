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

#columnas
{
  background-color:#fff;
  margin-top:10px;
  margin-left: 4px;
  margin-right: 4px;
  border: 3px solid #333;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;"
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


#iconoAbierto
{
  text-align: center;
}
#expandirAbierto:hover
{
  color: #0bb;
}
#contraerAbierto:hover
{
  color: #0bb;
}
#cerrarColumnaAbierto:hover
{
  color: #f00;
}
#minimizarAbierto:hover
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

p
{
  text-align: left;
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
  </style>
<!--Fin Estilos exclusivos-->
<?php
    require_once('validacion.php'); 
    require_once('inc/conectar.php');
    require_once('modules/classes.php');
    require_once('modules/operaciones.php');
    require_once("phpmailer/PHPMailerAutoload.php");
    require_once("phpmailer/mailer-params.php");
    include('../inc/Mobile_Detect.php');
    $detect                           = new Mobile_Detect();
    $registro_servicio                = new registro_servicio;
    $questions                        = new questions;
    $answers                          = new answers;
    $oOpe                             = new operaciones();
    $GetRegistroServicioUltimo        = $registro_servicio->GetRegistroServicioUltimo();
    $assoc_GetRegistroServicioUltimo  = mysql_fetch_assoc($GetRegistroServicioUltimo);
    $action                           = $_POST['action'];

echo "<div>";
        //////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
             /////////////////////////////////////////////////////////////////////////////////////////////
                    //////////////////////////////////////////////////////////////////////////////

    if ($action=='GetRegistroServicioAbierto')
     {
      $inicioAbierto=$_POST['inicioAbierto'];
        $ID_buscadorAbierto                   =   $_POST['ID_buscadorAbierto'];
        $ID_codigoAbierto                     =   $_POST['ID_codigoAbierto'];
         $ID_clienteAbierto                   =   $_POST['ID_clienteAbierto'];

        if ($ID_buscadorAbierto!='0') 
        {
          $getQuotationsInserted = $registro_servicio->GetRegistroServicioAbiertoAjaxById($inicioAbierto, $ID_buscadorAbierto);
        }
        if ($ID_codigoAbierto!='0') 
        {
          $getQuotationsInserted = $registro_servicio->getQuotationsInsertedAjaxByIdCodigo($inicioAbierto, $ID_codigoAbierto);
        }
        if ($ID_clienteAbierto!='0') 
        {
          $getQuotationsInserted = $registro_servicio->getQuotationsInsertedAjaxByIdCliente($inicioAbierto, $ID_clienteAbierto);
        }
        if($ID_buscadorAbierto=='0' and $ID_codigoAbierto=='0' and $ID_clienteAbierto=='0') 
        {
          $getQuotationsInserted = $registro_servicio->GetRegistroServicioAbiertoAjax($inicioAbierto);
        }  

          $num_GetRegistroServicioAbierto=mysql_num_rows($getQuotationsInserted);

         for ($abierto=0; $abierto < $num_GetRegistroServicioAbierto; $abierto++)
          { 
            $assoc_GetRegistroServicioAbierto=mysql_fetch_assoc($getQuotationsInserted);
  
                /* Inicio Modal Asignar */
                 echo '<div class="modal fade" id="'.$assoc_GetRegistroServicioAbierto['ID_ser'].'Asignar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" id="myModalLabel">Asignar - '.$assoc_GetRegistroServicioAbierto['ser_cod'].'</h4>
                                        </div>
                                        <div class="modal-body" >';
                                              echo  '<form action="actions-services.php" method="POST">'; 
                                              echo "<p style='margin: 10px;'>Asignar registro a:</p>";

                                              echo  "<select class='form-control'  name='ser_asig'>";
                                                           echo  '<option value="'.$assoc_GetRegistroServicioAbierto['ID_usu'].'" selected>'.$assoc_GetRegistroServicioAbierto['usu_nombre'].' '.$assoc_GetRegistroServicioAbierto['usu_apellido'].'</option>'; 
                                                           echo $optionResponsables=$registro_servicio->optionResponsables();
                                                      
                                              echo "</select>";

                                               echo "<p style='margin: 10px;'>Tiempo estimado de llegada:</p>";

                                              echo  "<select class='form-control'  name='TiempoDeLlegada'>";
                                                          echo  '<option value="1 hora">1/2 Hora</option>';
                                                          echo  '<option value="1 hora">1 Hora</option>'; 
                                                          echo  '<option value="2 hora">2 Hora</option>'; 
                                                          echo  '<option value="3 hora">3 Hora</option>'; 
                                                          echo  '<option value="4 hora">4 Hora</option>';
                                                          echo  '<option value="1 hora">5 Hora</option>';
                                              echo "</select>

                                                  <input type='hidden' name='action' value='Asignar'>
                                                 
                                                  <input type='hidden' name='ID_ser' value='".$assoc_GetRegistroServicioAbierto['ID_ser']."'>
                                                   <button type='submit' class='btn btn-success'  style='margin:10px;'><i class='material-icons' style='vertical-align: middle'>group_add</i> Asignar</button>
                                                    </form>";
                                  echo "</div>";
                                  echo '<div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        </div>';
                      /* Fin Modal Asignar */


                  echo "<tr style='text-align:left'  id='primerTr'>

                    <td style='vertical-align: middle;'>";
                      
                     echo "<div id='".$assoc_GetRegistroServicioAbierto['ID_ser']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
                        if ($assoc_GetRegistroServicioAbierto['pto_pedidoCod'])
                        { 
                          echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioAbierto['ID_ser']."' href='#abierto".$assoc_GetRegistroServicioAbierto['ID_ser']."' aria-expanded='true' aria-controls='abierto".$assoc_GetRegistroServicioAbierto['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioAbierto['ser_cod']. "</b> - " .$assoc_GetRegistroServicioAbierto['cli_desc']." - ". $assoc_GetRegistroServicioAbierto['pto_pedidoCod']."</a>";
                        }
                        else
                        {
                         echo "<a data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioAbierto['ID_ser']."' href='#abierto".$assoc_GetRegistroServicioAbierto['ID_ser']."' aria-expanded='true' aria-controls='abierto".$assoc_GetRegistroServicioAbierto['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioAbierto['ser_cod']. "</b> - " .$assoc_GetRegistroServicioAbierto['cli_desc']."</a>";
                        }

                        echo "</div>
                              <div id='abierto".$assoc_GetRegistroServicioAbierto['ID_ser']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
                                <div class='panel-body' style='background-color:#fff;'>
                                  <p>
                                    <i class='material-icons' style='vertical-align: middle'>
                                      store
                                    </i>
                                    <strong>Cliente:</strong>
                                    <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_GetRegistroServicioAbierto['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_GetRegistroServicioAbierto['obr_desc']."</a></p>";
                                    
                 //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaAbierto=$assoc_GetRegistroServicioAbierto['obr_URL'];
                  $diremapAbierto         = explode('?', $direccionMapaAbierto);
                  if (!isset($diremapAbierto[1])) 
                  {
                      $Mobile_DetectAbierto="http://maps.google.com?daddr=".$assoc_GetRegistroServicioAbierto['obr_dir']."";
                      $direccionAbierto="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                  {
                      $direccionAbierto="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectAbierto="geo:0,0?daddr=".$diremapAbierto[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectAbierto="http://maps.apple.com/maps?saddr=".$diremapAbierto[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectAbierto="maps:".$diremapAbierto[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectAbierto = "http://maps.google.com?daddr=".$diremapAbierto[1]."";
                      } 
                  }     
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo


                                      echo " <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectAbierto."'>".$assoc_GetRegistroServicioAbierto['obr_desc']."".$assoc_GetRegistroServicioAbierto['obr_desc']." </a>".$direccionAbierto."</p>

                                        <p><i class='material-icons' style='vertical-align: middle'>assignment_late</i> <strong>Prioridad:  </strong> ".$assoc_GetRegistroServicioAbierto['pri_desc']."</p>

                                        <p><i class='material-icons' style='vertical-align: middle'>date_range</i> <strong>Fecha de Apertura:</strong> ".$assoc_GetRegistroServicioAbierto['ser_fecin']." </p>

                                        <p><i class='material-icons' style='vertical-align: middle'>alarm</i> <strong>Hora de Apertura:</strong> ".$assoc_GetRegistroServicioAbierto['ser_hourin']." </p>

                                        <p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Descripción: </strong> ".$assoc_GetRegistroServicioAbierto['ser_desc']." </p>

                                        <p><i class='material-icons' style='vertical-align: middle'>accessibility</i> <strong>Contacto: </strong> ".$assoc_GetRegistroServicioAbierto['ser_contacto']." </p>

                                        <p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong> <a href='tel:".$assoc_GetRegistroServicioAbierto['ser_telefono']."'>  ".$assoc_GetRegistroServicioAbierto['ser_telefono']." </a></p>

                                        <p><i class='material-icons' style='vertical-align: middle'>email</i> <strong>Email:</strong> <a href='mailto:".$assoc_GetRegistroServicioAbierto['ser_mail']."'> ".$assoc_GetRegistroServicioAbierto['ser_mail']." </a></p>";

                                        echo "<p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Nº Proyecto:</strong> ".$assoc_GetRegistroServicioAbierto['obr_nproyecto']." </p>";

                                          if ($assoc_GetRegistroServicioAbierto['pto_pedidoCod']=="")
                                          {
                                           
                                          }
                                          else
                                          {
                                            echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio:</strong> ".$assoc_GetRegistroServicioAbierto['pto_pedidoCod']."</p>";
                                          } 
                                            
                                           if ($assoc_GetRegistroServicioAbierto['ser_PTOmonto']=="")
                                          {
                                           
                                          }
                                          else
                                          {
                                            echo "<p><i class='material-icons' style='vertical-align: middle'>email</i> <strong>Email:</strong> <a href='mailto:".$assoc_GetRegistroServicioAbierto['ser_PTOmonto']."'> ".$assoc_GetRegistroServicioAbierto['ser_PTOmonto']." </a></p>";
                                           } 
                                            echo "<div class='col-md-12'>
                                                    <div class='col-md-4' id='botones'>
                                                      <a href='deleteServices.php?ID_ser=".$assoc_GetRegistroServicioAbierto['ID_ser']."'><button type='button' class='btn btn-danger' title='Eliminar' id='botonDentroDeDiv'>
                                                      <i class='material-icons'>delete_forever</i> 
                                                    </button></a>
                                                  </div> 
                                                 <div class='col-md-4' id='botones'>
                                                  <a href='modify-services-request.php?ID_ser=".base64_encode((12344*($assoc_GetRegistroServicioAbierto['ID_ser']))/12)."'>
                                                     <button class='btn btn-primary' data-toggle='modal' title='Modificar' data-placement='top' data-target='#".$assoc_GetRegistroServicioAbierto['ID_ser']."ModificarCerrados' id='botonDentroDeDiv' >
                                                      <i class='material-icons'>
                                                        edit
                                                      </i>
                                                     </button>
                                                 </a>
                                                </div> 
                           
                                                <div class='col-md-4' id='botones'>
                                                  <button type='button' class='btn btn-success' data-toggle='modal' title='Asignar' data-placement='top' data-target='#".$assoc_GetRegistroServicioAbierto['ID_ser']."Asignar'>
                                                <i class='material-icons' style='font-size: 20px;'>
                                                  group_add
                                                </i> 
                                             </button>
                                             </div>
                                        </div>  
                                    </p>  
                               </div>
                        </div>  ";

           echo "</td>
          </tr>"; 
          echo "</div><hr class='negra'>"; 
              }
  }


          //////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
             /////////////////////////////////////////////////////////////////////////////////////////////
                    //////////////////////////////////////////////////////////////////////////////


  if ($action=='GetRegistroServicioAsignado')
     {
        $inicioAsignado             =   $_POST['inicioAsignado'];
        $ID_buscadorAsignado        =   $_POST['ID_buscadorAsignado'];
        $ID_codigoAsignado          =   $_POST['ID_codigoAsignado'];
        $ID_clienteAsignado         =   $_POST['ID_clienteAsignado'];

        if ($ID_buscadorAsignado!='0') 
        {
          $GetRegistroServicioAsignado = $registro_servicio->GetRegistroServicioAsignadoAjaxById($inicioAsignado, $ID_buscadorAsignado);
        }
        if ($ID_codigoAsignado!='0') 
        {
          $GetRegistroServicioAsignado = $registro_servicio->GetRegistroServicioAsignadoAjaxByIdCodigo($inicioAsignado, $ID_codigoAsignado);
        }
        if ($ID_clienteAsignado!='0') 
        {
          $GetRegistroServicioAsignado = $registro_servicio->GetRegistroServicioAsignadoAjaxByIdCliente($inicioAsignado, $ID_clienteAsignado);
        }
        if($ID_buscadorAsignado=='0' and $ID_codigoAsignado=='0' and $ID_clienteAsignado=='0') 
        {
    
          $GetRegistroServicioAsignado = $registro_servicio->GetRegistroServicioAsignadoAjax($inicioAsignado);
        }  


          $num_GetRegistroServicioAsignado=mysql_num_rows($GetRegistroServicioAsignado);

         for ($asignado=0; $asignado < $num_GetRegistroServicioAsignado; $asignado++)
          { 
            $assoc_GetRegistroServicioAsignado=mysql_fetch_assoc($GetRegistroServicioAsignado);


         

              /* Inicio Modal Cerrar */
         echo '<div class="modal fade bs-example-modal-lg" id="'.$assoc_GetRegistroServicioAsignado['ID_ser'].'CerrarAsignado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

                                   echo "<div class='col-md-12' id='formularioInput'><p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Nº Proyecto:</strong> ".$assoc_GetRegistroServicioAsignado['obr_nproyecto']." </p> </div>";

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
                                
                                 $tipos_servicio                   = $oOpe->tipo_servicio();
                                  $num_tse                          = mysql_num_rows($tipos_servicio);
                      

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
                        <input type='hidden' name='action' value='cerrarAsignado'>
                        <input type='hidden' name='ID_ser' value='".$assoc_GetRegistroServicioAsignado['ID_ser']."'>

                         <button type='button' class='btn btn-warning' style='margin-top:10px; margin-bottom:10px; width: 100%' id='botonFalso".$assoc_GetRegistroServicioAsignado['ID_ser']."'><i class='material-icons' style='vertical-align: middle'>warning</i> Seleccione al menos un tipo de servicio</button>

                         <button type='submit' class='btn btn-success' style='margin-top:10px; margin-bottom:10px; width: 100%; display: none;' id='botonVerdadero".$assoc_GetRegistroServicioAsignado['ID_ser']."'><i class='material-icons' style='vertical-align: middle'>check_circle</i> Guardar y Firmar</button>


                          </form>
                      
                        </div>
                       <div class='modal-footer'>
                      </div>
                       </div>
                    </div>
                  </div>
                </div>";
              /* Fin Modal Cerrar */
        

                  
              

           echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_GetRegistroServicioAsignado['ID_ser']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
             if ($assoc_GetRegistroServicioAsignado['pto_pedidoCod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioAsignado['ID_ser']."' href='#Asignado".$assoc_GetRegistroServicioAsignado['ID_ser']."' aria-expanded='true' aria-controls='Asignado".$assoc_GetRegistroServicioAsignado['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioAsignado['ser_cod']. "</b> - " .$assoc_GetRegistroServicioAsignado['cli_desc']." - ". $assoc_GetRegistroServicioAsignado['pto_pedidoCod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioAsignado['ID_ser']."' href='#Asignado".$assoc_GetRegistroServicioAsignado['ID_ser']."' aria-expanded='true' aria-controls='Asignado".$assoc_GetRegistroServicioAsignado['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioAsignado['ser_cod']. "</b> - " .$assoc_GetRegistroServicioAsignado['cli_desc']."</a>";
           }
            echo "</div>
            <div id='Asignado".$assoc_GetRegistroServicioAsignado['ID_ser']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

             <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_GetRegistroServicioAsignado['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_GetRegistroServicioAsignado['obr_desc']."</a></p>";

                 //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaAsignado=$assoc_GetRegistroServicioAsignado['obr_URL'];
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

                echo "<p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectAsignado."'>".$assoc_GetRegistroServicioAsignado['obr_desc']."   ".$assoc_GetRegistroServicioAsignado['obr_desc']." </a>".$direccionAsignado."</p>

           
              <p><i class='material-icons' style='vertical-align: middle'>assignment_late</i> <strong>Prioridad:</strong>  ".$assoc_GetRegistroServicioAsignado['pri_desc']." </p>

          <p><i class='material-icons' style='vertical-align: middle'>date_range</i> <strong>Fecha de Apertura: </strong> ".$assoc_GetRegistroServicioAsignado['ser_fecin']." </p>

                <p><i class='material-icons' style='vertical-align: middle'>alarm</i> <strong>Hora de Apertura:  </strong> ".$assoc_GetRegistroServicioAsignado['ser_hourin']."</p>


              <p><i class='material-icons' style='vertical-align: middle'>assignment</i>  <strong>Descripción:</strong> ".$assoc_GetRegistroServicioAsignado['ser_desc']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>accessibility</i>  <strong>Contacto:</strong> ".$assoc_GetRegistroServicioAsignado['ser_contacto']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong> Telefono:</strong> <a href='tel:".$assoc_GetRegistroServicioAsignado['ser_telefono']."'> ".$assoc_GetRegistroServicioAsignado['ser_telefono']." </a></p>

              <p><i class='material-icons' style='vertical-align: middle'>email</i> <strong>Email: </strong><a href='mailto:".$assoc_GetRegistroServicioAsignado['ser_mail']."'> ".$assoc_GetRegistroServicioAsignado['ser_mail']." </a></p>";

                 echo "<p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Nº Proyecto:</strong> ".$assoc_GetRegistroServicioAsignado['obr_nproyecto']." </p>";

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
                  <a href='deleteServices.php?ID_ser=".$assoc_GetRegistroServicioAsignado['ID_ser']."'><button type='button' class='btn btn-danger' title='Eliminar' id='botonDentroDeDiv'>
                                                      <i class='material-icons'>delete_forever</i> 
                                                    </button></a>
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
                    <button type='button' class='btn btn-success' data-toggle='modal' title='Cerrar' data-placement='top' data-target='#".$assoc_GetRegistroServicioAsignado['ID_ser']."CerrarAsignado' id='botonDentroDeDiv' >
                <i class='material-icons'>
                  check_circle 
                </i>  
               </button>
             </div></div>";

           echo "</td>
          </tr>"; 
          echo "</div></div><hr class='negra'>"; 
        }
 
     }

        //////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
             /////////////////////////////////////////////////////////////////////////////////////////////
                    //////////////////////////////////////////////////////////////////////////////

        if ($action=='GetRegistroServicioPendiente')
    {
        $inicioPendiente=$_POST['inicioPendiente'];
        $ID_buscadorPendiente        =   $_POST['ID_buscadorPendiente'];
        $ID_codigoPendiente         =   $_POST['ID_codigoPendiente'];
        $ID_clientePendiente          =   $_POST['ID_clientePendiente'];

        if ($ID_buscadorPendiente!='0') 
        {
          $GetRegistroServicioPendiente = $registro_servicio->getQuotationsPendienteAjaxByIdCodigo($inicioPendiente, $ID_buscadorPendiente);
        }
        if ($ID_codigoPendiente!='0') 
        {
          $GetRegistroServicioPendiente = $registro_servicio->getQuotationsPendienteAjaxByIdCodigo($inicioPendiente, $ID_codigoPendiente);
        }
        if ($ID_clientePendiente!='0') 
        {
          $GetRegistroServicioPendiente = $registro_servicio->getQuotationsPendienteAjaxByIdCliente($inicioPendiente, $ID_clientePendiente);
        }
        if($ID_buscadorPendiente=='0' and $ID_codigoPendiente=='0' and $ID_clientePendiente=='0') 
        {
          $GetRegistroServicioPendiente = $registro_servicio->GetRegistroServicioPendienteAjax($inicioPendiente);
        }  

    
        $num_GetRegistroServicioPendiente=mysql_num_rows($GetRegistroServicioPendiente);

         for ($Pendiente=0; $Pendiente < $num_GetRegistroServicioPendiente; $Pendiente++)
          { 
            $assoc_GetRegistroServicioPendientes=mysql_fetch_assoc($GetRegistroServicioPendiente);

          /* Inicio Modal Cerrar */
        echo '<div class="modal fade bs-example-modal-lg" id="'.$assoc_GetRegistroServicioPendientes['ID_ser'].'CerrarPendientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                <p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Nº Proyecto:</strong></div><div class='col-md-8' id='formularioInput'>  ".$assoc_GetRegistroServicioPendientes['obr_nproyecto']." </p></div> </div>";


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
                          
                   
                echo  "<input type='hidden' name='action' value='cerrar'>
                      <input type='hidden' name='ID_ser' value='".$assoc_GetRegistroServicioPendientes['ID_ser']."'>
                       <input type='hidden' name='ser_cod' value='".$assoc_GetRegistroServicioPendientes['ser_cod']."'>
                           <button type='button' class='btn btn-warning' style='margin-top:10px; margin-bottom:10px; width: 100%' id='botonFalso".$assoc_GetRegistroServicioPendientes['ID_ser']."'><i class='material-icons' style='vertical-align: middle'>warning</i> Seleccione al menos un tipo de servicio</button>

                       <button type='submit' class='btn btn-success' style='margin-top:10px; margin-bottom:10px; width: 100%; display: none;' id='botonVerdadero".$assoc_GetRegistroServicioPendientes['ID_ser']."'><i class='material-icons' style='vertical-align: middle'>check_circle</i> Guardar y Firmar</button>
                        </form>
                         </div>
                   <div class='modal-footer'>
                             
                              </div>
                      </div>
                    </div>
                  </div>
                </div>";
            /* Fin Modal Cerrar */

        

            echo "<tr>
                <td style='vertical-align: middle;'>
                <div id='".$assoc_GetRegistroServicioPendientes['ID_ser']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
                 if ($assoc_GetRegistroServicioPendientes['pto_pedidoCod']) { 
                echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioPendientes['ID_ser']."' href='#Pendientes".$assoc_GetRegistroServicioPendientes['ID_ser']."' aria-expanded='true' aria-controls='Pendientes".$assoc_GetRegistroServicioPendientes['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioPendientes['ser_cod']. "</b> - " .$assoc_GetRegistroServicioPendientes['cli_desc']." - ". $assoc_GetRegistroServicioPendientes['pto_pedidoCod']."</a>";
               }
               else
               {
                 echo "<a data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioPendientes['ID_ser']."' href='#Pendientes".$assoc_GetRegistroServicioPendientes['ID_ser']."' aria-expanded='true' aria-controls='Pendientes".$assoc_GetRegistroServicioPendientes['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioPendientes['ser_cod']. "</b> - " .$assoc_GetRegistroServicioPendientes['cli_desc']."</a>";
               }
                echo " </div>
                <div id='Pendientes".$assoc_GetRegistroServicioPendientes['ID_ser']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
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
                           $Mobile_DetectPendientes = "http://maps.google.com?daddr=".$diremapPendientes[1]."";
                          } 

                       } 
                      //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                    echo "<p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectPendientes."'>".$assoc_GetRegistroServicioPendientes['obr_desc']."   ".$assoc_GetRegistroServicioPendientes['obr_desc']."</a>".$direccionPendientes."</p>

                  <p><i class='material-icons' style='vertical-align: middle'>assignment_late</i> <strong>Prioridad: </strong> ".$assoc_GetRegistroServicioPendientes['pri_desc']." </p>

                   <p><i class='material-icons' style='vertical-align: middle'>date_range</i> <strong>Fecha de Apertura: </strong> ".$assoc_GetRegistroServicioPendientes['ser_fecin']." </p>

                  <p><i class='material-icons' style='vertical-align: middle'>alarm</i> <strong>Hora de Apertura: </strong> ".$assoc_GetRegistroServicioPendientes['ser_hourin']." </p>

                  <p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Descripción: </strong> ".$assoc_GetRegistroServicioPendientes['ser_desc']." </p>

                  <p><i class='material-icons' style='vertical-align: middle'>accessibility</i> <strong>Contacto: </strong> ".$assoc_GetRegistroServicioPendientes['ser_contacto']." </p>

                  <p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong> <a href='tel:".$assoc_GetRegistroServicioPendientes['ser_telefono']."'>  ".$assoc_GetRegistroServicioPendientes['ser_telefono']." </a></p>

                  <p><i class='material-icons' style='vertical-align: middle'>email</i> <strong>Email:</strong> <a href='mailto:".$assoc_GetRegistroServicioPendientes['ser_mail']."'> ".$assoc_GetRegistroServicioPendientes['ser_mail']." </a></p>";

                     echo "<p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Nº Proyecto:</strong> ".$assoc_GetRegistroServicioPendientes['obr_nproyecto']." </p>";


                   if ($assoc_GetRegistroServicioPendientes['pto_pedidoCod']=="")
                    {
                     
                    }
                    else
                     {
                      echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i>  <strong>Codigo de Servicio:</strong>".$assoc_GetRegistroServicioPendientes['pto_pedidoCod']."</p>";
                     } 
                   

                                 echo "<p><i class='material-icons' style='vertical-align: middle'>account_circle</i> <strong>Asignado: </strong> ".$assoc_GetRegistroServicioPendientes['usu_nombre']." ".$assoc_GetRegistroServicioPendientes['usu_apellido']." </p>

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
                        <button type='button' class='btn btn-success' data-toggle='modal' title='Cerrar' data-placement='top' data-target='#".$assoc_GetRegistroServicioPendientes['ID_ser']."CerrarPendientes' id='botonDentroDeDiv' >
                    <i class='material-icons'>
                      check_circle 
                    </i>  
                   </button>
                 </div></div>";

           echo "</td>
          </tr>"; 
          echo "</div><hr class='negra'>"; 
        }
     }

             //////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
             /////////////////////////////////////////////////////////////////////////////////////////////
                    //////////////////////////////////////////////////////////////////////////////


      if ($action=='GetRegistroServicioRepuesto')
     {
        $inicioRepuesto=$_POST['inicioRepuesto'];
        $ID_buscadorRepuesto       =   $_POST['ID_buscadorRepuesto'];
        $ID_codigoRepuesto         =   $_POST['ID_codigoRepuesto'];
        $ID_clienteRepuesto          =   $_POST['ID_clienteRepuesto'];

        if ($ID_buscadorRepuesto!='0') 
        {
          $GetRegistroServicioRepuesto = $registro_servicio->GetRegistroServicioRepuestoAjaxById($inicioRepuesto, $ID_buscadorRepuesto);
        }
        if ($ID_codigoRepuesto!='0') 
        {
          $GetRegistroServicioRepuesto= $registro_servicio->GetRegistroServicioRepuestoAjaxByIdCodigo($inicioRepuesto, $ID_codigoRepuesto);
        }
        if ($ID_clienteRepuesto!='0') 
        {
          $GetRegistroServicioRepuesto = $registro_servicio->GetRegistroServicioRepuestoAjaxByIdCliente($inicioRepuesto, $ID_clienteRepuesto);
        }
        if($ID_buscadorRepuesto=='0' and $ID_codigoRepuesto=='0' and $ID_clienteRepuesto=='0') 
        {
          $GetRegistroServicioRepuesto = $registro_servicio->GetRegistroServicioRepuestoAjax($inicioRepuesto);
        }  


       
      $num_GetRegistroServicioRepuesto=mysql_num_rows($GetRegistroServicioRepuesto);

         for ($Repuesto=0; $Repuesto < $num_GetRegistroServicioRepuesto; $Repuesto++)
          { 
            $assoc_GetRegistroServicioRepuestos=mysql_fetch_assoc($GetRegistroServicioRepuesto);

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
            <td style='vertical-align: middle;'>
            <div id='".$assoc_GetRegistroServicioRepuestos['ID_ser']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
             if ($assoc_GetRegistroServicioRepuestos['pto_pedidoCod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioRepuestos['ID_ser']."' href='#Repuestos".$assoc_GetRegistroServicioRepuestos['ID_ser']."' aria-expanded='true' aria-controls='Repuestos".$assoc_GetRegistroServicioRepuestos['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioRepuestos['ser_cod']. "</b> - " .$assoc_GetRegistroServicioRepuestos['cli_desc']." - ". $assoc_GetRegistroServicioRepuestos['pto_pedidoCod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioRepuestos['ID_ser']."' href='#Repuestos".$assoc_GetRegistroServicioRepuestos['ID_ser']."' aria-expanded='true' aria-controls='Repuestos".$assoc_GetRegistroServicioRepuestos['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioRepuestos['ser_cod']. "</b> - " .$assoc_GetRegistroServicioRepuestos['cli_desc']."</a>";
           }
            echo "</div>
            <div id='Repuestos".$assoc_GetRegistroServicioRepuestos['ID_ser']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

              <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_GetRegistroServicioRepuestos['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_GetRegistroServicioRepuestos['obr_desc']."</a></p>";


                 //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaRepuestos=$assoc_GetRegistroServicioRepuestos['obr_URL'];
                  $diremapRepuestos        = explode('?', $direccionMapaRepuestos);
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
                         $Mobile_DetectRepuestos="http://maps.google.com?daddr=".$diremapRepuestos[1]."";
                        } 
                   }      
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "  <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda: </strong><a href='".$Mobile_DetectRepuestos."'>".$assoc_GetRegistroServicioRepuestos['obr_desc']."".$assoc_GetRegistroServicioRepuestos['obr_desc']."</a>".$direccionRepuestos."</p>

              <p><i class='material-icons' style='vertical-align: middle'>assignment_late</i> <strong>Prioridad: </strong> ".$assoc_GetRegistroServicioRepuestos['pri_desc']." </p>


                <p><i class='material-icons' style='vertical-align: middle'>date_range</i> <strong>Fecha de Apertura: </strong> ".$assoc_GetRegistroServicioRepuestos['ser_fecin']." </p>

                <p><i class='material-icons' style='vertical-align: middle'>alarm</i> <strong>Hora de Apertura: </strong> ".$assoc_GetRegistroServicioRepuestos['ser_hourin']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Descripción: </strong> ".$assoc_GetRegistroServicioRepuestos['ser_desc']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>accessibility</i> <strong>Contacto: </strong> ".$assoc_GetRegistroServicioRepuestos['ser_contacto']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong> <a href='tel:".$assoc_GetRegistroServicioRepuestos['ser_telefono']."'>  ".$assoc_GetRegistroServicioRepuestos['ser_telefono']." </a></p>

              <p><i class='material-icons' style='vertical-align: middle'>email</i> <strong>Email:</strong><a href='mailto:".$assoc_GetRegistroServicioRepuestos['ser_mail']."'> ".$assoc_GetRegistroServicioRepuestos['ser_mail']." </a></p>";

               echo "<p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Nº Proyecto:</strong> ".$assoc_GetRegistroServicioRepuestos['obr_nproyecto']." </p>";

             
                               if ($assoc_GetRegistroServicioRepuestos['pto_pedidoCod']=="")
                                {
                                 
                                }
                                else
                                 {
                                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong> Codigo de Servicio: </strong>".$assoc_GetRegistroServicioRepuestos['pto_pedidoCod']."</p>";
                                 } 
                               

                             echo "<p><i class='material-icons' style='vertical-align: middle'>account_circle</i> <strong>Asignado:</strong>  ".$assoc_GetRegistroServicioRepuestos['usu_nombre']." ".$assoc_GetRegistroServicioRepuestos['usu_apellido']." </p>

        

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
             </div></div>";

           echo "</td>
          </tr>"; 
          echo "</div><hr class='negra'>"; 

              }
  }

          //////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
             /////////////////////////////////////////////////////////////////////////////////////////////
                    //////////////////////////////////////////////////////////////////////////////

    if ($action=='GetRegistroServicioCerrado')
     {
       $inicioCerrado=$_POST['inicioCerrado'];

        $ID_buscadorCerrado       =   $_POST['ID_buscadorCerrado'];
        $ID_codigoCerrado         =   $_POST['ID_codigoCerrado'];
        $ID_clienteCerrado          =   $_POST['ID_clienteCerrado'];

        if ($ID_buscadorCerrado!='0') 
        {
          $GetRegistroServicioCerrado = $registro_servicio->GetRegistroServicioCerradoAjaxById($inicioCerrado, $ID_buscadorCerrado);
        }
        if ($ID_codigoCerrado!='0') 
        {
          $GetRegistroServicioCerrado= $registro_servicio->getQuotationsCerradoAjaxByIdCodigo($inicioCerrado, $ID_codigoCerrado);
        }
        if ($ID_clienteCerrado!='0') 
        {
          $GetRegistroServicioCerrado = $registro_servicio->getQuotationsCerradoAjaxByIdCliente($inicioCerrado, $ID_clienteCerrado);
        }
        if($ID_buscadorCerrado=='0' and $ID_codigoCerrado=='0' and $ID_clienteCerrado=='0') 
        {
          $GetRegistroServicioCerrado = $registro_servicio->GetRegistroServicioCerradoAjax($inicioCerrado);
        }  

         $num_GetRegistroServicioCerrado=mysql_num_rows($GetRegistroServicioCerrado);

         for ($CerradoA=0; $CerradoA < $num_GetRegistroServicioCerrado; $CerradoA++)
          { 
            $assoc_GetRegistroServicioCerrados=mysql_fetch_assoc($GetRegistroServicioCerrado);
           $num_GetRegistroServicioCerrado;



      

    echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_GetRegistroServicioCerrados['ID_ser']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>";
             if ($assoc_GetRegistroServicioCerrados['pto_pedidoCod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioCerrados['ID_ser']."' href='#Cerrados".$assoc_GetRegistroServicioCerrados['ID_ser']."' aria-expanded='true' aria-controls='Cerrados".$assoc_GetRegistroServicioCerrados['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioCerrados['ser_cod']. "</b> - " .$assoc_GetRegistroServicioCerrados['cli_desc']." - ". $assoc_GetRegistroServicioCerrados['pto_pedidoCod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_GetRegistroServicioCerrados['ID_ser']."' href='#Cerrados".$assoc_GetRegistroServicioCerrados['ID_ser']."' aria-expanded='true' aria-controls='Cerrados".$assoc_GetRegistroServicioCerrados['ID_ser']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_GetRegistroServicioCerrados['ser_cod']. "</b> - " .$assoc_GetRegistroServicioCerrados['cli_desc']."</a>";
           }
            echo " </div>
            <div id='Cerrados".$assoc_GetRegistroServicioCerrados['ID_ser']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

              <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_GetRegistroServicioCerrados['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_GetRegistroServicioCerrados['obr_desc']."</a></p>";



               //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaCerrados=$assoc_GetRegistroServicioCerrados['obr_URL'];
                  $diremapCerrados         = explode('?', $direccionMapaCerrados);
                  if (!isset($diremapCerrados[1])) 
                  {
                      $Mobile_DetectCerrados="http://maps.google.com?daddr=".$assoc_GetRegistroServicioCerrados['obr_dir']."";
                      $direccionCerrados="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                  { 
                      $direccionCerrados="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectCerrados="geo:0,0?daddr=".$diremapCerrados[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectCerrados="http://maps.apple.com/maps?saddr=".$diremapCerrados [1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectCerrados="maps:".$diremapCerrados[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectCerrados = "http://maps.google.com?daddr=".$diremapCerrados[1]."";
                      } 
                  }   
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

               echo "  <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectCerrados."'> ".$assoc_GetRegistroServicioCerrados['obr_desc']."  ".$assoc_GetRegistroServicioCerrados['obr_desc']." </a>".$direccionCerrados."</p>


              <p><i class='material-icons' style='vertical-align: middle'>assignment_late</i> <strong>Prioridad:</strong>  ".$assoc_GetRegistroServicioCerrados['pri_desc']."</p> 

              
                <p><i class='material-icons' style='vertical-align: middle'>date_range</i> <strong>Fecha de Apertura: </strong> ".$assoc_GetRegistroServicioCerrados['ser_fecin']." </p>

                <p><i class='material-icons' style='vertical-align: middle'>alarm</i> <strong>Hora de Apertura: </strong> ".$assoc_GetRegistroServicioCerrados['ser_hourin']." </p>


              <p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong> Descripción: </strong>".$assoc_GetRegistroServicioCerrados['ser_desc']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>accessibility</i> <strong>Contacto: </strong> ".$assoc_GetRegistroServicioCerrados['ser_contacto']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong> <a href='tel:".$assoc_GetRegistroServicioCerrados['ser_telefono']."'>  ".$assoc_GetRegistroServicioCerrados['ser_telefono']." </a></p>

              <p><i class='material-icons' style='vertical-align: middle'>email</i> <strong>Email:</strong> <a href='mailto:".$assoc_GetRegistroServicioCerrados['ser_mail']."'> ".$assoc_GetRegistroServicioCerrados['ser_mail']." </a></p>";


               echo "<p><i class='material-icons' style='vertical-align: middle'>assignment</i> <strong>Nº Proyecto:</strong> ".$assoc_GetRegistroServicioCerrados['obr_nproyecto']." </p>";

                               if ($assoc_GetRegistroServicioCerrados['pto_pedidoCod']=="")
                                {
                                 
                                }
                                else
                                 {
                                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio:</strong> ".$assoc_GetRegistroServicioCerrados['pto_pedidoCod']."</p>";
                                 } 
                               

                             echo "<p><i class='material-icons' style='vertical-align: middle'>account_circle</i> <strong> Asignado: </strong>".$assoc_GetRegistroServicioCerrados['usu_nombre']." ".$assoc_GetRegistroServicioCerrados['usu_apellido']." </p>

              <p><i class='material-icons' style='vertical-align: middle'>assignment_turned_in</i> <strong>Solución: </strong> ".$assoc_GetRegistroServicioCerrados['ser_solucion']." </p>

              <p>

                   <div class='col-md-12' style='margin-bottom:2%;'>

                 <div class='col-md-4' id='botones'>
                  <button type='button' class='btn btn-success' id='".$assoc_GetRegistroServicioCerrados['ID_ser']."CerrarDefinitivamente'>
                    <i class='material-icons'>check_circle</i> 
                  </button>
                 </div> 

                 <div class='col-md-4' id='botones'>
                   <a href='deleteServices.php?ID_ser=".$assoc_GetRegistroServicioCerrados['ID_ser']."'><button type='button' class='btn btn-danger' title='Eliminar' id='botonDentroDeDiv'>
                                                      <i class='material-icons'>delete_forever</i> 
                                                    </button></a>
                
                 </div> 

                 <div class='col-md-4' id='botones'>
                  <a href='modify-services-request.php?ID_ser=".base64_encode((12344*($assoc_GetRegistroServicioCerrados['ID_ser']))/12)."'>
                     <button class='btn btn-primary' id='".$assoc_GetRegistroServicioCerrados['ID_ser']."ModificarCerrados'>
                      <i class='material-icons'>
                        edit
                      </i>
                     </button></a></div></div></div>";

                     echo '<div class="container-fluid">
                            <div class="panel panel-success" style="display:none" id="'.$assoc_GetRegistroServicioCerrados['ID_ser'].'CerrarDefinitivamenteDiv">
                              <div class="panel-heading">
                                <h3 class="panel-title">Formulario de Cierre</h3>
                              </div>
                              <div class="panel-body">
                                 <form action="actions-services.php" method="POST">
                                    <input type="hidden" name="action" value="CerrarDefinitivamente">
                                    <input type="hidden" name="ID_ser" value="'.$assoc_GetRegistroServicioCerrados['ID_ser'].'">

                                    <p><i class="material-icons" style="vertical-align: middle">attach_money</i> <strong> Costo Materia Prima: </strong> <input class="form-control" type="text" name="ser_costomp" placeholder="Costo Materia Prima"></p>

                                    <p><i class="material-icons" style="vertical-align: middle">description</i> <strong> Factura al Cliente: </strong> <input class="form-control" type="text"  name="ser_fc" placeholder="Factura al Cliente"></p>

                                  <p><button type="submit" class="btn btn-success"><i class="material-icons" style="vertical-align: middle">check_circle</i> Cerrar </button></p>
                                </form> 
                              </div>
                          </div>
                        </div>';

                    

                  echo "<script>
                    $('#".$assoc_GetRegistroServicioCerrados['ID_ser']."CerrarDefinitivamente').click(function(){
                      $('#".$assoc_GetRegistroServicioCerrados['ID_ser']."CerrarDefinitivamenteDiv').toggle('slow');
                       $('#".$assoc_GetRegistroServicioCerrados['ID_ser']."CerrarDefinitivamente').toggle('slow');
                    });
                    </script>";


        echo "</td>
          </tr>";
 echo "</div></div><hr class='negra'>";
              }
  }


    echo "</div>";   
?>
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
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>
<!--Fin: Jquery-->  
