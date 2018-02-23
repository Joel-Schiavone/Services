<?php
    require_once('validacion.php'); 
    require_once('inc/conectar.php');
    require_once('modules/classes.php');
    require_once('modules/operaciones.php');
    require_once("phpmailer/PHPMailerAutoload.php");
    require_once("phpmailer/mailer-params.php");
    include('../inc/Mobile_Detect.php');
    $detect = new Mobile_Detect();
    $registro_servicio      = new registro_servicio;
    $quotations             = new quotations;
    $questions              = new questions;
    $answers                = new answers;
    $oOpe                   = new operaciones();
    $tipo_moneda            = new tipo_moneda;
    $status                 = new status;
    $motivos_rechazo        = new motivos_rechazo;
    $usuarios               = new usuarios;
    $action                 = $_POST['action'];
    $ID_emp                 = $_SESSION['ID_emp'] ;
?>
<!--Inicio Estilos exclusivos-->
  <style type="text/css">
    
    hr 
    {
      display: block;
      height: 5px;
      border: 0;
      border-top: 1px solid #fff;
      margin: 1em 0;
      padding: 0; 
    }

    hr.negra 
    {
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

    @media (max-width: 900px) 
    {
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
          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////

 if ($action=='GetRegistroServicioAsignadoAS')
     {

        $inicioAsignadoAS    =   $_POST['inicioAsignadoAS'];
        if (@$_POST['filtro_clienteAsignados']=='null') 
        {
          $filtro_clienteAsignado= "";
        }
        else
        {
          
          $BuscandoComasAsignado = strpos($_POST['filtro_clienteAsignados'], ",");
          if ($BuscandoComasAsignado === false) 
          {
            $filtro_clienteAsignado = " AND quotations.pto_asignado='".$_POST['filtro_clienteAsignados']."'";
          }
          else
          {  
            $arrayAsignado = explode(",", $_POST['filtro_clienteAsignados']);
            $numeroArrayAsignado=count($arrayAsignado);

              $filtro_clienteAsignadoPrimero="AND (quotations.pto_asignado='".$arrayAsignado['0']."' ";
              $filtro_clienteAsignadoTemporalB="";
              for ($countArrayAsignado=0; $countArrayAsignado < $numeroArrayAsignado; $countArrayAsignado++) 
              { 
                $filtro_clienteAsignadoTemporal  = "OR quotations.pto_asignado='".$arrayAsignado[$countArrayAsignado]."'";
                $filtro_clienteAsignadoTemporalB  = $filtro_clienteAsignadoTemporalB." ".$filtro_clienteAsignadoTemporal;
              }

              $filtro_clienteAsignado = $filtro_clienteAsignadoPrimero." ".$filtro_clienteAsignadoTemporalB." )" ;
            }  

        }  
        if (@$_POST['filtro_clienteBuscador']) 
        {
          $filtro_clienteBuscador = " AND quotations.ID_cli='".$_POST['filtro_clienteBuscador']."'";
        }
        else
        {
           $filtro_clienteBuscador= "";
        }  
        if (@$_POST['filtro_tiendaBuscador']=='null') 
        {
           $filtro_tiendaBuscador = " ";
        }
        else
        {
          $filtro_tiendaBuscador = " AND quotations.ID_obr='".$_POST['filtro_tiendaBuscador']."'";
        } 
        if (@$_POST['codigo']) 
        {
          $codigo = " AND quotations.pto_pedidoCod='".$_POST['codigo']."'";
        }
        else
        {
          $codigo = " ";
        }  

      /* echo "SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
         WHERE (quotations.ID_tpp='1' OR 
            quotations.ID_tpp='2' OR
            quotations.ID_tpp='3' OR
            quotations.ID_tpp='4' OR
            quotations.ID_tpp='5' OR
            quotations.ID_tpp='7' ) AND
            (quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17') AND 
            quotations.ID_cli=clientes.ID_cli AND
            quotations.ID_obr=obras.ID_obr 
            ".$filtro_clienteAsignado."  
            ".$filtro_clienteBuscador."
            ".$filtro_tiendaBuscador."
            ".$codigo."
             ORDER BY quotations.ID_pto DESC LIMIT 0, ".$inicioAsignadoAS."";*/
    
        $sql  = "SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
         WHERE (quotations.ID_tpp='1' OR 
            quotations.ID_tpp='2' OR
            quotations.ID_tpp='3' OR
            quotations.ID_tpp='4' OR
            quotations.ID_tpp='5' OR
            quotations.ID_tpp='7' ) AND
            (quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17') AND 
            quotations.ID_cli=clientes.ID_cli AND
            quotations.ID_obr=obras.ID_obr 
            ".$filtro_clienteAsignado."  
            ".$filtro_clienteBuscador."
            ".$filtro_tiendaBuscador."
            ".$codigo."
             ORDER BY quotations.ID_pto DESC LIMIT 0, ".$inicioAsignadoAS."";
          $getQuotationsAsignadoAS       = mysql_query($sql);



          $num_GetRegistroServicioAsignado=mysql_num_rows($getQuotationsAsignadoAS);


                      echo "<script>$(document).ready(function(){
                          $('#viendoResultadosAsignado').html('".$num_GetRegistroServicioAsignado."');
                    });</script>";


         for ($AsignadoAS=0; $AsignadoAS < $num_GetRegistroServicioAsignado; $AsignadoAS++)
          { 
            $assoc_getQuotationsInserted=mysql_fetch_assoc($getQuotationsAsignadoAS);
            $ID_pto                     = $assoc_getQuotationsInserted['ID_pto'];

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
                                 <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Aceptar</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
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
                               <input type="hidden" name="ID_mot" value="7" >
                              <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsInserted['pto_asignado'].'" >
                              <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsInserted['pto_pedidoCod'].'" >
                              <input type="hidden" name="actionAS" value="rechazado" >
                              <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">pan_tool</i> Si, Rechazar !</button>
                                 </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">No, volver !</button>

                            </div>
                            </div>
                        </div>
                      </div>
                    </div>';
                  /* Fin Modal Rechazar */

              

              echo "<tr>
                      <td style='vertical-align: middle;' >";
                 

                      echo "<div id='".$assoc_getQuotationsInserted['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0; text-align:left;'>
                        ";
                       if ($assoc_getQuotationsInserted['ser_cod']) { 
                      echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsInserted['ID_pto']."' href='#collapse".$assoc_getQuotationsInserted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsInserted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsInserted['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsInserted['cli_desc']." - ". $assoc_getQuotationsInserted['ser_cod']."</a>";
                     }
                     else
                     {
                       echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsInserted['ID_pto']."' href='#collapse".$assoc_getQuotationsInserted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsInserted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsInserted['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsInserted['cli_desc']."</a>";
                     }
                      echo " 
                      </div>
                      <div id='collapse".$assoc_getQuotationsInserted['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
                        <div class='panel-body'>

                       <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente</strong> <a href='../MasterData/modify-store.php?id=".base64_encode((12344*($assoc_getQuotationsInserted['ID_obr']))/12)."' data-toggle='modal' title='Ver Tienda' target='_blank' data-placement='top'>".$assoc_getQuotationsInserted['obr_desc']."</a></p>";

                       echo "<p>
                                                 <i class='material-icons' style='vertical-align: middle'>
                                                      store
                                                    </i> 
                                                    <strong>
                                                      Proyecto:
                                                    </strong>
                                                      ". $assoc_getQuotationsInserted['obr_nproyecto']."
                                             </p>"; 

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

                          echo "<p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectInserted."'>".$assoc_getQuotationsInserted['obr_desc']." </a>".$direccionInserted."</p>";

                           $pto_usuarioA1=$assoc_getQuotationsInserted['ID_usu'];
                           $getUsuariosByIdA1=$usuarios->getUsuariosById($pto_usuarioA1);
                           $assoc_getUsuariosByIdA1=mysql_fetch_assoc($getUsuariosByIdA1);
                            echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Operador:</strong> ".$assoc_getUsuariosByIdA1['usu_nombre']." ".$assoc_getUsuariosByIdA1['usu_apellido']."</p>";
                           
                           $pto_asignadoA2=$assoc_getQuotationsInserted['pto_asignado'];
                           $getUsuariosByIdA2=$usuarios->getUsuariosById($pto_asignadoA2);
                           $assoc_getUsuariosByIdA2=mysql_fetch_assoc($getUsuariosByIdA2);
                            echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Asignado:</strong> ".$assoc_getUsuariosByIdA2['usu_nombre']." ".$assoc_getUsuariosByIdA2['usu_apellido']."</p>";

                             if ($assoc_getQuotationsInserted['pto_contacto'])
                           {
                            echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Contacto:</strong> ".$assoc_getQuotationsInserted['pto_contacto']."</p>";
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



                            echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                                          description
                                        </i>
                                        <strong>
                                          Detalle:
                                        </strong>
                                          ".$assoc_getQuotationsInserted['pto_desc']."
                                      </p>";

                           if ($assoc_getQuotationsInserted['pto_presupuestoRelacionado']!=0)
                            {
                            
                            $getQuotationsByIdA= $quotations->getQuotationsById($assoc_getQuotationsInserted['pto_presupuestoRelacionado']);
                            $assoc_getQuotationsByIdA=mysql_fetch_assoc($getQuotationsByIdA);
                            $ID_fic_A=$assoc_getQuotationsByIdA['ID_fic'];
                            $ID_obr_A=$assoc_getQuotationsByIdA['ID_obr'];
                             echo "<p><i class='material-icons' style='vertical-align: middle'> assignment_return</i> Presupuesto Relacionado:<a href='modify-quotation-ne.php?ID_fic=".base64_encode((12344*($ID_fic_A))/12)."&ID_obr=".base64_encode((12344*($ID_obr_A))/12)."&ID_pto=". base64_encode((12344*($assoc_getQuotationsInserted['pto_presupuestoRelacionado']))/12)."'> ". $assoc_getQuotationsByIdA['pto_pedidoCod'] ." <strong></a></p>";
                          }

                         echo "<div style='display: inline-flex; margin-top: 10px; text-align:left;'>

                          <button type='button' class='btn btn-default' data-toggle='modal' title='Aceptar Pedido' data-placement='top' data-target='#".$assoc_getQuotationsInserted['ID_pto']."a' style='margin-right: 10px'><i class='material-icons center'>assignment_ind</i></button>";

                            echo "<button type='button' class='btn btn-default' data-toggle='modal' title='Rechazar' data-placement='top' data-target='#".$assoc_getQuotationsInserted['ID_pto']."rechazar' style='margin-right: 10px'><i class='material-icons center'>pan_tool</i></button>";
                        
                          echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsInserted['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsInserted['ID_obr']))/12).'">';
                          echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                          <a href='deleteQuotationsAS.php?ID_pto=".$assoc_getQuotationsInserted['ID_pto']."'><button type='button' class='btn btn-danger'  title='Eliminar'><i class='material-icons'>delete_forever</i></button></a>
                           </div></div>";

           echo "</td>
          </tr>"; 
          echo "</div><hr class='negra'>"; 

              }
  }


          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////

                if ($action=='GetRegistroServicioAccepted')
             {

                  $inicioAcceptedAS    =   $_POST['inicioAccepted'];
                  if (@$_POST['filtro_clienteAsignados']=='null') 
                  {
                    $filtro_clienteAsignadoAccepted= "";
                  }
                  else
                  {
                    $BuscandoComasAccepted = strpos($_POST['filtro_clienteAsignados'], ",");
                    if ($BuscandoComasAccepted === false) 
                    {
                      $filtro_clienteAsignadoAccepted = " AND quotations.pto_asignado='".$_POST['filtro_clienteAsignados']."'";
                    }
                    else
                    {  
                      $arrayAccepted = explode(",", $_POST['filtro_clienteAsignados']);
                      $numeroArrayAccepted=count($arrayAccepted);

                        $filtro_clienteAcceptedPrimero="AND (quotations.pto_asignado='".$arrayAccepted['0']."' ";
                        $filtro_clienteAcceptedTemporalB=""; 
                        for ($countArrayAccepted=0; $countArrayAccepted < $numeroArrayAccepted; $countArrayAccepted++) 
                        { 
                          $filtro_clienteAcceptedTemporal  = "OR quotations.pto_asignado='".$arrayAccepted[$countArrayAccepted]."'";
                          $filtro_clienteAcceptedTemporalB  = $filtro_clienteAcceptedTemporalB." ".$filtro_clienteAcceptedTemporal;
                        }

                        $filtro_clienteAsignadoAccepted = $filtro_clienteAcceptedPrimero." ".$filtro_clienteAcceptedTemporalB." )" ;
                      }  
                  }  
                  if (@$_POST['filtro_clienteBuscador']) 
                  {
                    $filtro_clienteBuscadorAccepted = " AND quotations.ID_cli='".$_POST['filtro_clienteBuscador']."'";
                  }
                  else
                  {
                     $filtro_clienteBuscadorAccepted= "";
                  }  
                  if (@$_POST['filtro_tiendaBuscador']=='null') 
                  {
                     $filtro_tiendaBuscadorAccepted = " ";
                  }
                  else
                  {
                    $filtro_tiendaBuscadorAccepted = " AND quotations.ID_obr='".$_POST['filtro_tiendaBuscador']."'";
                  } 
                  if (@$_POST['codigo']) 
                  {
                    $codigoAccepted = " AND quotations.pto_pedidoCod='".$_POST['codigo']."'";
                  }
                  else
                  {
                    $codigoAccepted = " ";
                  }  

               
                  $sql  = "SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
                   WHERE (quotations.ID_tpp='1' OR 
                      quotations.ID_tpp='2' OR
                      quotations.ID_tpp='3' OR
                      quotations.ID_tpp='4' OR
                      quotations.ID_tpp='5' OR
                      quotations.ID_tpp='7' ) AND
                      quotations.ID_sta='16'  AND 
                      quotations.ID_cli=clientes.ID_cli AND
                      quotations.ID_obr=obras.ID_obr  
                      ".$filtro_clienteAsignadoAccepted."  
                      ".$filtro_clienteBuscadorAccepted."
                      ".$filtro_tiendaBuscadorAccepted."
                      ".$codigoAccepted."
                       ORDER BY quotations.ID_pto DESC LIMIT 0, ".$inicioAcceptedAS."";
                      $getQuotationsAccepted       = mysql_query($sql);
                    
                    $num_GetRegistroServicioAccepted=mysql_num_rows($getQuotationsAccepted);

                      echo "<script>$(document).ready(function(){
                          $('#viendoResultadosAccepted').html('".$num_GetRegistroServicioAccepted."');
                    });</script>";


                    for ($AcceptedAS=0; $AcceptedAS < $num_GetRegistroServicioAccepted; $AcceptedAS++)
                    { 
                        $assoc_getQuotationsAccepted  =  mysql_fetch_assoc($getQuotationsAccepted);
                        $ID_pto                       =  $assoc_getQuotationsAccepted['ID_pto'];
                        $getTipo_moneda               =  $tipo_moneda->getTipo_moneda();
                        $num_getTipo_moneda           =  mysql_num_rows($getTipo_moneda); 

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
                                         <button class="btn btn-primary" type="submit"><i class="material-icons" style="vertical-align: middle">pan_tool</i> Si, Rechazar !</button>
                                          </form>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No, volver !</button>
                                      </div>
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
                                   
                                              <label for="ID_tipoMonedaPres">Moneda</label>
                                                <select name="ID_tipoMonedaPres" class="form-control" required>';
                                                  for ($tdm=0; $tdm < $num_getTipo_moneda; $tdm++)
                                                 { 
                                                  $assoc_getTipo_moneda = mysql_fetch_assoc($getTipo_moneda);
                                           
                                                  echo "<option value='".$assoc_getTipo_moneda['ID_tmo']."'>".$assoc_getTipo_moneda['tmo_desc']."</option>";
                                                    }
                                          echo '</select>
                                            

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
                                             <input type="hidden" name="ID_tpp" value="'.$assoc_getQuotationsAccepted['ID_tpp'].'" />
                                            
                                             <button type="submit" class="btn btn-primary"><i class="material-icons" style="vertical-align: middle">done</i> Aceptar</button>
                                         </fieldset>    
                                      </form>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>';
                              /* Fin Modal Presupuestar */

                    
                          echo "<tr>
                                <td style='vertical-align: middle;'>
                                <div id='".$assoc_getQuotationsAccepted['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0; text-align:left;'>
                                   ";
                                 if ($assoc_getQuotationsAccepted['ser_cod']) { 
                                echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsAccepted['ID_pto']."' href='#collapse".$assoc_getQuotationsAccepted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsAccepted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsAccepted['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsAccepted['cli_desc']." - ". $assoc_getQuotationsAccepted['ser_cod']."</a>";
                               }
                               else
                               {
                                 echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsAccepted['ID_pto']."' href='#collapse".$assoc_getQuotationsAccepted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsAccepted['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsAccepted['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsAccepted['cli_desc']."</a>";
                               }
                                echo " 
                                </div>
                                <div id='collapse".$assoc_getQuotationsAccepted['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
                                  <div class='panel-body'>

                                  <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsAccepted['ID_cli']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsAccepted['cli_desc']."</a></p>

                                   ";

                                   echo "<p>
                                                 <i class='material-icons' style='vertical-align: middle'>
                                                      store
                                                    </i> 
                                                    <strong>
                                                      Proyecto:
                                                    </strong>
                                                      ". $assoc_getQuotationsAccepted['obr_nproyecto']."
                                             </p>"; 
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

                                    echo "<p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Tienda:</strong><a href='".$Mobile_DetectAccepted."'>".$assoc_getQuotationsAccepted['obr_desc']."  </a>".$direccionAccepted."</p>";


                                   
                                     $pto_usuarioB1=$assoc_getQuotationsAccepted['ID_usu'];
                                     $getUsuariosByIdB1=$usuarios->getUsuariosById($pto_usuarioB1);
                                     $assoc_getUsuariosByIdB1=mysql_fetch_assoc($getUsuariosByIdB1);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Operador:</strong> ".$assoc_getUsuariosByIdB1['usu_nombre']." ".$assoc_getUsuariosByIdB1['usu_apellido']."</p>";
                                     
                                     $pto_asignadoB2=$assoc_getQuotationsAccepted['pto_asignado'];
                                     $getUsuariosByIdB2=$usuarios->getUsuariosById($pto_asignadoB2);
                                     $assoc_getUsuariosByIdB2=mysql_fetch_assoc($getUsuariosByIdB2);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Asignado:</strong> ".$assoc_getUsuariosByIdB2['usu_nombre']." ".$assoc_getUsuariosByIdB2['usu_apellido']."</p>";

                                       if ($assoc_getQuotationsAccepted['pto_contacto'])
                                     {
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Contacto:</strong> ".$assoc_getQuotationsAccepted['pto_contacto']."</p>";
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

                                   <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado:</strong> ".$assoc_getQuotationsAccepted['pto_fecAceptado']."</p>

                                   <p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                          description
                                        </i>
                                        <strong>
                                          Detalle:
                                        </strong>
                                          ".$assoc_getQuotationsAccepted['pto_desc']."
                                      </p>";

                                    echo "<div style='display: inline-flex' align='center'>

                                    <button type='button' class='btn btn-default' data-toggle='modal' title='Presupuestar' data-placement='top' data-target='#".$assoc_getQuotationsAccepted['ID_pto']."p' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>

                                   ";

                                     echo "<button type='button' class='btn btn-default' data-toggle='modal' title='Rechazar Aceptado' data-placement='top' data-target='#".$assoc_getQuotationsAccepted['ID_pto']."rechazarAceptado' style='margin-right: 10px' disabled><i class='material-icons center'>pan_tool</i></button>";

                                    echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsAccepted['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsAccepted['ID_obr']))/12).'">';
                                    echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                                    <a href='deleteQuotationsAS.php?ID_pto=".$assoc_getQuotationsAccepted['ID_pto']."'><button type='button' class='btn btn-danger' title='Eliminar'><i class='material-icons'>delete_forever</i></button></a>
                                    </div></div>";

           echo "</td>
          </tr>"; 
          echo "</div><hr class='negra'>"; 
              }
  }

          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////

    if ($action=='GetRegistroServicioPresupuestados')
     {

        $inicioPresupuestadosAS    =   $_POST['inicioPresupuestados'];
                  if (@$_POST['filtro_clienteAsignados']=='null') 
                  {
                     $filtro_clienteAsignadoPresupuestados= "";
                  }
                  else
                  {
                    $BuscandoComasPresupuestados = strpos($_POST['filtro_clienteAsignados'], ",");
                    if ($BuscandoComasPresupuestados === false) 
                    {
                      $filtro_clienteAsignadoPresupuestados = " AND quotations.pto_asignado='".$_POST['filtro_clienteAsignados']."'";
                    }
                    else
                    {  
                      $arrayPresupuestados = explode(",", $_POST['filtro_clienteAsignados']);
                      $numeroArrayPresupuestados=count($arrayPresupuestados);

                        $filtro_clientePresupuestadosPrimero="AND (quotations.pto_asignado='".$arrayPresupuestados['0']."' ";
                         $filtro_clientePresupuestadosTemporalB="";
                        for ($countArrayPresupuestados=0; $countArrayPresupuestados < $numeroArrayPresupuestados; $countArrayPresupuestados++) 
                        { 
                          $filtro_clientePresupuestadosTemporal  = "OR quotations.pto_asignado='".$arrayPresupuestados[$countArrayPresupuestados]."'";
                          $filtro_clientePresupuestadosTemporalB  = $filtro_clientePresupuestadosTemporalB." ".$filtro_clientePresupuestadosTemporal;
                        }

                        $filtro_clienteAsignadoPresupuestados = $filtro_clientePresupuestadosPrimero." ".$filtro_clientePresupuestadosTemporalB." )" ;
                      }  
                  }  
                  if (@$_POST['filtro_clienteBuscador']) 
                  {
                    $filtro_clienteBuscadorPresupuestados = " AND quotations.ID_cli='".$_POST['filtro_clienteBuscador']."'";
                  }
                  else
                  {
                     $filtro_clienteBuscadorPresupuestados= "";
                  }  
                  if (@$_POST['filtro_tiendaBuscador']=='null') 
                  {
                     $filtro_tiendaBuscadorPresupuestados = " ";
                  }
                  else
                  {
                    $filtro_tiendaBuscadorPresupuestados = " AND quotations.ID_obr='".$_POST['filtro_tiendaBuscador']."'";
                  } 
                  if (@$_POST['codigo']) 
                  {
                    $codigoPresupuestados = " AND quotations.pto_pedidoCod='".$_POST['codigo']."'";
                  }
                  else
                  {
                    $codigoPresupuestados = " ";
                  }  

               
                  $sql  = "SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
                         WHERE (quotations.ID_tpp='1' OR 
                            quotations.ID_tpp='2' OR
                            quotations.ID_tpp='3' OR
                            quotations.ID_tpp='4' OR
                            quotations.ID_tpp='5' OR
                            quotations.ID_tpp='7' ) AND
                            quotations.ID_sta='13'  AND 
                            quotations.ID_cli=clientes.ID_cli AND
                            quotations.ID_obr=obras.ID_obr   
                      ".$filtro_clienteAsignadoPresupuestados."  
                      ".$filtro_clienteBuscadorPresupuestados."
                      ".$filtro_tiendaBuscadorPresupuestados."
                      ".$codigoPresupuestados."
                       ORDER BY quotations.ID_pto DESC LIMIT 0, ".$inicioPresupuestadosAS."";
                      $getQuotationsPresupuestados       = mysql_query($sql);
                    

         $num_GetRegistroServicioPresupuestados=mysql_num_rows($getQuotationsPresupuestados);

          echo "<script>$(document).ready(function(){
                $('#viendoResultadosPresupuestados').html('".$num_GetRegistroServicioPresupuestados."');
          });</script>";


         for ($PresupuestadosAS=0; $PresupuestadosAS < $num_GetRegistroServicioPresupuestados; $PresupuestadosAS++)
          { 
            $assoc_getQuotationsBudgeted        = mysql_fetch_assoc($getQuotationsPresupuestados);
            $ID_pto                             = $assoc_getQuotationsBudgeted['ID_pto'];
            $ID_sta                             = $assoc_getQuotationsBudgeted['ID_sta'];
            $getStatusById                      = $status->getStatusById($ID_sta);
            $assoc_getStatusById                = mysql_fetch_assoc($getStatusById);
            $getMotivosRechazoIdEmp             = $motivos_rechazo->getMotivosRechazoIdEmp($ID_emp);
            $num_getMotivosRechazoIdEmp         = mysql_num_rows($getMotivosRechazoIdEmp);

             $getTipo_moneda               =  $tipo_moneda->getTipo_moneda();
                        $num_getTipo_moneda           =  mysql_num_rows($getTipo_moneda); 
            
                     echo '<div class="modal fade" id="'.$assoc_getQuotationsBudgeted['ID_pto'].'vender" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                             <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                          &times;
                                        </span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">
                                        Vender
                                      </h4>
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
                                            echo '</div><br>
                        
                                            
                                          <div class="form-group" style="margin: 3%;">
                                              <label for="ID_tipoMonedaVenta">Moneda</label>
                                                <select name="ID_tipoMonedaVenta" class="form-control" required>';
                                                  for ($tdm=0; $tdm < $num_getTipo_moneda; $tdm++)
                                                 { 
                                                  $assoc_getTipo_moneda = mysql_fetch_assoc($getTipo_moneda);
                                           
                                                  echo "<option value='".$assoc_getTipo_moneda['ID_tmo']."'>".$assoc_getTipo_moneda['tmo_desc']."</option>";
                                                  }
                                          echo '</select></div>
                                            
                                            <div class="form-group">
                                              <label for="tipoCambioVenta">Tipo de Cambio</label>  
                                              <input name="tipoCambioVenta" type="number" step="0.01"  class="form-control input-md" required>
                                            </div>';
                                           

                                           //Monto de la OV (ingrsar sólo números XXXX.XX)
                                          echo '<div class="form-group" style="margin: 3%;">';
                                            echo '<label>Monto OV</label>';
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
                      </div>';    



             
                    /* Inicio Modal Rechazar aceptado                     
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
                      */
            echo "<tr>
                    <td style='vertical-align: middle;'>";

                      echo "  
                            <div id='".$assoc_getQuotationsBudgeted['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0; text-align:left;'>
                            ";
                                if ($assoc_getQuotationsBudgeted['ser_cod']) 
                                { 
                                   echo "
                                         <a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsBudgeted['ID_pto']."' href='#collapse".$assoc_getQuotationsBudgeted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsBudgeted['ID_pto']."'>
                                              <b>
                                                <i class='material-icons' style='vertical-align: middle'>
                                                  list
                                                </i>
                                                ".$assoc_getQuotationsBudgeted['pto_pedidoCod']. "
                                              </b>
                                                <br> <i class='material-icons' style='vertical-align: middle'>store</i>  " .$assoc_getQuotationsBudgeted['cli_desc']." - ". $assoc_getQuotationsBudgeted['ser_cod']."
                                          </a>
                                        ";
                               }
                               else
                               {
                                 echo "
                                        <a data-toggle='collapse' data-parent='#".$assoc_getQuotationsBudgeted['ID_pto']."' href='#collapse".$assoc_getQuotationsBudgeted['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsBudgeted['ID_pto']."'>
                                            <b>
                                              <i class='material-icons' style='vertical-align: middle'>
                                                list
                                              </i>
                                              ".$assoc_getQuotationsBudgeted['pto_pedidoCod']. "
                                            </b> 
                                             <br> <i class='material-icons' style='vertical-align: middle'>store</i>  " .$assoc_getQuotationsBudgeted['cli_desc']."
                                          </a>
                                      ";
                               }

                      echo "
                          </div>

                        <div id='collapse".$assoc_getQuotationsBudgeted['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
                                  <div class='panel-body'>
                                      <p>
                                        <i class='material-icons' style='vertical-align: middle'>
                                          store
                                        </i>
                                        <strong>
                                          Cliente:
                                        </strong>
                                        <a href='../MasterData/modify-store.php?id=".base64_encode((12344*($assoc_getQuotationsBudgeted['ID_cli']))/12)."' data-toggle='modal' title='Ver Tienda' target='_blank' data-placement='top'>
                                          ".$assoc_getQuotationsBudgeted['cli_desc']."
                                        </a>
                                      </p>
                                </div>
                              ";

                               echo "<p>
                                                 <i class='material-icons' style='vertical-align: middle'>
                                                      store
                                                    </i> 
                                                    <strong>
                                                      Proyecto:
                                                    </strong>
                                                      ". $assoc_getQuotationsBudgeted['obr_nproyecto']."
                                             </p>"; 

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
                          echo "<p>
                                  <i class='material-icons' style='vertical-align: middle'>
                                    store
                                  </i> 
                                  <strong>
                                    Tienda:
                                  </strong>
                                  <a href='".$Mobile_DetectBudgeted."'>
                                    ".$assoc_getQuotationsBudgeted['obr_desc']."  
                                  </a>
                                  ".$direccionBudgeted."
                                </p>";          

                                     $pto_usuarioC1=$assoc_getQuotationsBudgeted['ID_usu'];
                                     $getUsuariosByIdC1=$usuarios->getUsuariosById($pto_usuarioC1);
                                     $assoc_getUsuariosByIdC1=mysql_fetch_assoc($getUsuariosByIdC1);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Operador:</strong> ".$assoc_getUsuariosByIdC1['usu_nombre']." ".$assoc_getUsuariosByIdC1['usu_apellido']."</p>";
                                     
                                     $pto_asignadoC2=$assoc_getQuotationsBudgeted['pto_asignado'];
                                     $getUsuariosByIdC2=$usuarios->getUsuariosById($pto_asignadoC2);
                                     $assoc_getUsuariosByIdC2=mysql_fetch_assoc($getUsuariosByIdC2);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Asignado:</strong> ".$assoc_getUsuariosByIdC2['usu_nombre']." ".$assoc_getUsuariosByIdC2['usu_apellido']."</p>";

                                       if ($assoc_getQuotationsBudgeted['pto_contacto'])
                                     {
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Contacto:</strong> ".$assoc_getQuotationsBudgeted['pto_contacto']."</p>";
                                     }

                                if ($assoc_getQuotationsBudgeted['pto_mail'])
                                   {
                                    echo "
                                          <p>
                                            <i class='material-icons' style='vertical-align: middle'>
                                              mail_outline
                                            </i>
                                            <strong>
                                              Email:
                                            </strong>
                                            <a href='mailto:".$assoc_getQuotationsBudgeted['obr_mail']."'>
                                              ".$assoc_getQuotationsBudgeted['pto_mail']."
                                            </a>
                                          </p>
                                        ";
                                   }

                                if ($assoc_getQuotationsBudgeted['pto_telefono'])
                                   {
                                      echo "
                                            <p>
                                              <i class='material-icons' style='vertical-align: middle'>
                                                phone
                                              </i>
                                              <strong>
                                                Telefono:
                                              </strong>
                                                <a href='tel:".$assoc_getQuotationsBudgeted['obr_tel']."'>
                                                  ".$assoc_getQuotationsBudgeted['pto_telefono']."
                                                </a>
                                            </p>";
                                   }

                                echo "
                                      <p>
                                        <i class='material-icons' style='vertical-align: middle'>
                                          access_time
                                        </i>
                                        <strong>
                                          Ingreso:
                                        </strong> 
                                        ".$assoc_getQuotationsBudgeted['pto_fecIngreso']."
                                      </p>";

                               if ($assoc_getQuotationsBudgeted['ser_cod']=="")
                                {
                                 
                                }
                               else
                                {
                                  echo "
                                        <p>
                                          <i class='material-icons' style='vertical-align: middle'>
                                            receipt
                                          </i>
                                          <strong>
                                            Codigo de Servicio:
                                          </strong>
                                          ".$assoc_getQuotationsBudgeted['ser_cod']."
                                        </p>
                                      ";
                                } 


                                    echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                        Codigo de presupuesto:
                                         <strong>
                                          ".$assoc_getQuotationsBudgeted['pto_numero']."
                                        </strong>
                                      </p>";           


                            echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                          Orden de Compra:
                                         <strong>
                                          ".$assoc_getQuotationsBudgeted['pto_OC']."
                                        </strong>
                                      </p>";   

                           echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                          Orden de Venta:
                                         <strong>
                                          ".$assoc_getQuotationsBudgeted['pto_OV']."
                                        </strong>
                                      </p>";     

                             

                                echo "
                                      <p>
                                        <i class='material-icons' style='vertical-align: middle'>
                                          access_time
                                        </i>
                                        <strong>
                                          Aceptado:
                                        </strong>
                                        ".$assoc_getQuotationsBudgeted['pto_fecAceptado']."
                                      </p>

                                      <p>
                                        <i class='material-icons' style='vertical-align: middle'>
                                          access_time
                                        </i>
                                        <strong>
                                          Presupuestado:
                                        </strong>
                                          ".$assoc_getQuotationsBudgeted['pto_fecPresupuesto']."
                                      </p>

                                      <p>
                                        <i class='material-icons' style='vertical-align: middle'>
                                          explicit
                                        </i>
                                        <strong>
                                          Estado:
                                        </strong>
                                          ".$assoc_getStatusById['sta_desc']."
                                      </p>

                                    <p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                          description
                                        </i>
                                        <strong>
                                          Detalle:
                                        </strong>
                                          ".$assoc_getQuotationsBudgeted['pto_desc']."
                                      </p>";

                                  echo "<p>";                                                                                                                            
                                 // Inicio adjuntos -->
                                      $adj_idRelacion       = $assoc_getQuotationsBudgeted['ID_pto'];
                                      $adj_tablaRelacion    = "quotations";
                                      include('inc/adjuntos.php');
                                 // Fin adjuntos -->
                                   
                              echo "</p>";  

                           echo "      
                               <div style='display: inline-flex' align='center'>
                                <button type='button' class='btn btn-success' data-toggle='modal' title='Vender' data-placement='top' data-target='#".$assoc_getQuotationsBudgeted['ID_pto']."vender' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>
                                 <button type='button' class='btn btn-default' data-toggle='modal' title='Rechazar Presupuestado' data-placement='top' data-target='#rechazarPresupuestado".$assoc_getQuotationsBudgeted['ID_pto']."' style='margin-right: 10px' disabled>
                                        <i class='material-icons center'>
                                          pan_tool
                                        </i>
                                  </button>
                                  <a href='modify-quotation-as.php?ID_pto=".base64_encode((12344*($assoc_getQuotationsBudgeted['ID_pto']))/12)."&ID_obr=".base64_encode((12344*($assoc_getQuotationsBudgeted['ID_obr']))/12)."'>
                                      <button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'>
                                          <i class='material-icons center'>
                                            edit
                                          </i>
                                      </button>
                                  </a>
                                  <a href='deleteQuotationsAS.php?ID_pto=".$assoc_getQuotationsBudgeted['ID_pto']."'><button type='button' class='btn btn-danger'  title='Eliminar'>
                                    <i class='material-icons'>
                                      delete_forever
                                    </i>
                                  </button></a>
                             </div>  
                        </div>      
                    </td>
                </tr>

                </div><hr class='negra'>"; 

       }
  }

          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////

    if ($action=='GetRegistroServicioDespacho')
     {

        $inicioDespachoAS    =   $_POST['inicioDespacho'];
                  if (@$_POST['filtro_clienteAsignados']=='null') 
                  {
                    $filtro_clienteAsignadoDespacho= "";
                  }
                  else
                  {
                    $BuscandoComasDespacho = strpos($_POST['filtro_clienteAsignados'], ",");
                    if ($BuscandoComasDespacho === false) 
                    {
                      $filtro_clienteAsignadoDespacho = " AND quotations.pto_asignado='".$_POST['filtro_clienteAsignados']."'";
                    }
                    else
                    {  
                      $arrayDespacho = explode(",", $_POST['filtro_clienteAsignados']);
                      $numeroArrayDespacho=count($arrayDespacho);

                        $filtro_clienteDespachoPrimero="AND (quotations.pto_asignado='".$arrayDespacho['0']."' ";
                          $filtro_clienteDespachoTemporalB="";
                        for ($countArrayDespacho=0; $countArrayDespacho < $numeroArrayDespacho; $countArrayDespacho++) 
                        { 
                          $filtro_clienteDespachoTemporal  = "OR quotations.pto_asignado='".$arrayDespacho[$countArrayDespacho]."'";
                          $filtro_clienteDespachoTemporalB  = $filtro_clienteDespachoTemporalB." ".$filtro_clienteDespachoTemporal;
                        }

                        $filtro_clienteAsignadoDespacho = $filtro_clienteDespachoPrimero." ".$filtro_clienteDespachoTemporalB." )" ;
                      }  
                  }  
                  if (@$_POST['filtro_clienteBuscador']) 
                  {
                    $filtro_clienteBuscadorDespacho = " AND quotations.ID_cli='".$_POST['filtro_clienteBuscador']."'";
                  }
                  else
                  {
                    $filtro_clienteBuscadorDespacho= " ";
                  }  
                  if (@$_POST['filtro_tiendaBuscador']=='null') 
                  {
                     $filtro_tiendaBuscadorDespacho = " ";
                  }
                  else
                  {
                    $filtro_tiendaBuscadorDespacho = " AND quotations.ID_obr='".$_POST['filtro_tiendaBuscador']."'";
                  } 
                  if (@$_POST['codigo']) 
                  {
                    $codigoDespacho = " AND quotations.pto_pedidoCod='".$_POST['codigo']."'";
                  }
                  else
                  {
                    $codigoDespacho = " ";
                  }  

    

                  $sql  = "SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
                     WHERE (quotations.ID_tpp='1' OR 
                        quotations.ID_tpp='2' OR
                        quotations.ID_tpp='3' OR
                        quotations.ID_tpp='4' OR
                        quotations.ID_tpp='5' OR
                        quotations.ID_tpp='7' ) AND
                        quotations.ID_sta='15'AND
                        quotations.ID_cli=clientes.ID_cli AND
                        quotations.ID_obr=obras.ID_obr   
                      ".$filtro_clienteAsignadoDespacho."  
                      ".$filtro_clienteBuscadorDespacho."
                      ".$filtro_tiendaBuscadorDespacho."
                      ".$codigoDespacho."
                       ORDER BY quotations.ID_pto DESC LIMIT 0, ".$inicioDespachoAS."";
                      $getQuotationsDespacho       = mysql_query($sql);
                    

        $num_GetRegistroServicioDespacho=mysql_num_rows($getQuotationsDespacho);

          echo "<script>$(document).ready(function(){
                $('#viendoResultadosDespacho').html('".$num_GetRegistroServicioDespacho."');
          });</script>";


         for ($DespachoAS=0; $DespachoAS < $num_GetRegistroServicioDespacho; $DespachoAS++)
          { 
            $assoc_getQuotationsDespacho=mysql_fetch_assoc($getQuotationsDespacho);
            $ID_pto                             = $assoc_getQuotationsDespacho['ID_pto'];
            $ID_sta                             = $assoc_getQuotationsDespacho['ID_sta'];


                


                


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
            <div id='".$assoc_getQuotationsDespacho['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0; text-align:left;'>
                   ";
            if ($assoc_getQuotationsDespacho['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsDespacho['ID_pto']."' href='#collapse".$assoc_getQuotationsDespacho['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsDespacho['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsDespacho['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsDespacho['cli_desc']." - ". $assoc_getQuotationsDespacho['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsDespacho['ID_pto']."' href='#collapse".$assoc_getQuotationsDespacho['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsDespacho['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsDespacho['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsDespacho['cli_desc']."</a>";
           }
     echo "
            </div>
            <div id='collapse".$assoc_getQuotationsDespacho['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsDespacho['ID_cli']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsDespacho['cli_desc']."</a></p>";

                 echo "<p>
                                                 <i class='material-icons' style='vertical-align: middle'>
                                                      store
                                                    </i> 
                                                    <strong>
                                                      Proyecto:
                                                    </strong>
                                                      ". $assoc_getQuotationsDespacho['obr_nproyecto']."
                                             </p>"; 

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

                echo "<p><i class='material-icons' style='vertical-align: middle'>place</i> <strong>Tienda:</strong><a href='".$Mobile_DetectDespacho."'>".$assoc_getQuotationsDespacho['obr_desc']."</a>".$direccionDespacho."</p>";


                 $pto_usuarioD1=$assoc_getQuotationsDespacho['ID_usu'];
                                     $getUsuariosByIdD1=$usuarios->getUsuariosById($pto_usuarioD1);
                                     $assoc_getUsuariosByIdD1=mysql_fetch_assoc($getUsuariosByIdD1);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Operador:</strong> ".$assoc_getUsuariosByIdD1['usu_nombre']." ".$assoc_getUsuariosByIdD1['usu_apellido']."</p>";
                                     
                                     $pto_asignadoD2=$assoc_getQuotationsDespacho['pto_asignado'];
                                     $getUsuariosByIdD2=$usuarios->getUsuariosById($pto_asignadoD2);
                                     $assoc_getUsuariosByIdD2=mysql_fetch_assoc($getUsuariosByIdD2);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Asignado:</strong> ".$assoc_getUsuariosByIdD2['usu_nombre']." ".$assoc_getUsuariosByIdD2['usu_apellido']."</p>";

                                       if ($assoc_getQuotationsDespacho['pto_contacto'])
                                     {
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Contacto:</strong> ".$assoc_getQuotationsDespacho['pto_contacto']."</p>";
                                     }


                   if ($assoc_getQuotationsDespacho['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsDespacho['obr_mail']."'>".$assoc_getQuotationsDespacho['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsDespacho['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsDespacho['obr_tel']."'>".$assoc_getQuotationsDespacho['pto_telefono']."</a></p>";
                 }

               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsDespacho['pto_fecIngreso']."</p>";

               if ($assoc_getQuotationsDespacho['ser_cod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio: </strong>".$assoc_getQuotationsDespacho['ser_cod']."</p>";
                 } 
                    echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                        Codigo de presupuesto:
                                         <strong>
                                          ".$assoc_getQuotationsDespacho['pto_numero']."
                                        </strong>
                                      </p>";           


                            echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                          Orden de Compra:
                                         <strong>
                                          ".$assoc_getQuotationsDespacho['pto_OC']."
                                        </strong>
                                      </p>";   

                           echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                          Orden de Venta:
                                         <strong>
                                          ".$assoc_getQuotationsDespacho['pto_OV']."
                                        </strong>
                                      </p>";     

                             

              echo"
               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado: </strong>".$assoc_getQuotationsDespacho['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado:</strong> ".$assoc_getQuotationsDespacho['pto_fecPresupuesto']."</p>

               <p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                          description
                                        </i>
                                        <strong>
                                          Detalle:
                                        </strong>
                                          ".$assoc_getQuotationsDespacho['pto_desc']."
                                      </p>";

                                       echo "<p>";                                                                                                                            
                                 // Inicio adjuntos -->
                                      $adj_idRelacion       = $assoc_getQuotationsDespacho['ID_pto'];
                                      $adj_tablaRelacion    = "quotations";
                                      include('inc/adjuntos.php');
                                 // Fin adjuntos -->
                                   
                              echo "</p>";  

                echo "<div style='display: inline-flex' align='center'>";

                    /*<button type='button' class='btn btn-success' data-toggle='modal' title='Despachar' data-placement='top' data-target='#".$assoc_getQuotationsDespacho['ID_pto']."Despachado' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>";*/ 

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsDespacho['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsDespacho['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <a href='deleteQuotationsAS.php?ID_pto=".$assoc_getQuotationsDespacho['ID_pto']."'><button type='button' class='btn btn-danger' title='Eliminar'><i class='material-icons'>delete_forever</i></button></a>
               </div></div>";

           echo "</td>
          </tr>"; 
          echo "</div><hr class='negra'>"; 

              }
  }

          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////

    if ($action=='GetRegistroServicioInstalacion') // PENDIENTES DE INSTALACION ESTADO 20
     {


        $inicioInstalacionAS    =   $_POST['inicioInstalacion'];
                  if (@$_POST['filtro_clienteAsignados']=='null') 
                  {
                    $filtro_clienteAsignadoInstalacion= "";
                  }
                  else
                  {
                       $BuscandoComasInstalacion = strpos($_POST['filtro_clienteAsignados'], ",");
                        if ($BuscandoComasInstalacion === false) 
                        {
                          $filtro_clienteAsignadoInstalacion = " AND quotations.pto_asignado='".$_POST['filtro_clienteAsignados']."'";
                        }
                        else
                        {  
                          $arrayInstalacion = explode(",", $_POST['filtro_clienteAsignados']);
                          $numeroArrayInstalacion=count($arrayInstalacion);

                            $filtro_clienteInstalacionPrimero="AND (quotations.pto_asignado='".$arrayInstalacion['0']."' ";
                            $filtro_clienteInstalacionTemporalB=""; 
                            for ($countArrayInstalacion=0; $countArrayInstalacion < $numeroArrayInstalacion; $countArrayInstalacion++) 
                            { 
                              $filtro_clienteInstalacionTemporal  = "OR quotations.pto_asignado='".$arrayInstalacion[$countArrayInstalacion]."'";
                              $filtro_clienteInstalacionTemporalB  = $filtro_clienteInstalacionTemporalB." ".$filtro_clienteInstalacionTemporal;
                            }

                            $filtro_clienteAsignadoInstalacion = $filtro_clienteInstalacionPrimero." ".$filtro_clienteInstalacionTemporalB." )" ;
                          }  
                  }  
                  if (@$_POST['filtro_clienteBuscador']) 
                  {
                    $filtro_clienteBuscadorInstalacion = " AND quotations.ID_cli='".$_POST['filtro_clienteBuscador']."'";
                  }
                  else
                  {
                     $filtro_clienteBuscadorInstalacion= "";
                  }  
                  if (@$_POST['filtro_tiendaBuscador']=='null') 
                  {
                     $filtro_tiendaBuscadorInstalacion = " ";
                  }
                  else
                  {
                    $filtro_tiendaBuscadorInstalacion = " AND quotations.ID_obr='".$_POST['filtro_tiendaBuscador']."'";
                  } 
                  if (@$_POST['codigo']) 
                  {
                    $codigoInstalacion = " AND quotations.pto_pedidoCod='".$_POST['codigo']."'";
                  }
                  else
                  {
                    $codigoInstalacion = " ";
                  }  

               
                  $sql  = "SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
                       WHERE (quotations.ID_tpp='1' OR 
                          quotations.ID_tpp='2' OR
                          quotations.ID_tpp='3' OR
                          quotations.ID_tpp='4' OR
                          quotations.ID_tpp='5' OR
                          quotations.ID_tpp='7' ) AND
                          quotations.ID_sta='20'  AND 
                          quotations.ID_cli=clientes.ID_cli AND
                          quotations.ID_obr=obras.ID_obr   
                      ".$filtro_clienteAsignadoInstalacion."  
                      ".$filtro_clienteBuscadorInstalacion."
                      ".$filtro_tiendaBuscadorInstalacion."
                      ".$codigoInstalacion."
                       ORDER BY quotations.ID_pto DESC LIMIT 0, ".$inicioInstalacionAS."";
                      $getQuotationsInstalacion       = mysql_query($sql);
                    

        $num_GetRegistroServicioInstalacion=mysql_num_rows($getQuotationsInstalacion);

            echo "<script>$(document).ready(function(){
                $('#viendoResultadosInstalacion').html('".$num_GetRegistroServicioInstalacion."');
          });</script>";


         for ($InstalacionAS=0; $InstalacionAS < $num_GetRegistroServicioInstalacion; $InstalacionAS++)
          { 
            $assoc_getQuotationsInstalacion = mysql_fetch_assoc($getQuotationsInstalacion);
            $ID_pto                                = $assoc_getQuotationsInstalacion['ID_pto'];
            $ID_sta                                = $assoc_getQuotationsInstalacion['ID_sta'];


                 echo '<div class="modal fade" id="'.$assoc_getQuotationsInstalacion['ID_pto'].'instalar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                             <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                          &times;
                                        </span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">
                                        Registrar Instalación
                                      </h4>
                                    </div>
                                    <div class="modal-body" align="center">';
                
                                      echo '<form class="form-inline" action="actions-quotation-as.php" class="form-horizontal" method="post" enctype="multipart/form-data">';

                                          echo ' <input type="hidden" name="actionAS" value="Instalar" />
                                                 <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsInstalacion['ID_pto'].'" />';
                                                
                                         echo '<button type="submit" class="btn btn-success" style="width: 100%; margin-bottom: 2%;"><i class="material-icons" style="vertical-align: middle">done_all</i> Registrar Instalación</button>';
                                   echo '</form>';
                                  echo '</div>';

                                  echo'<div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                      
                          </div>
                        </div>
                      </div>';    

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
            <div id='".$assoc_getQuotationsInstalacion['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0; text-align:left;'>
             ";
            if ($assoc_getQuotationsInstalacion['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsInstalacion['ID_pto']."' href='#collapse".$assoc_getQuotationsInstalacion['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsInstalacion['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsInstalacion['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsInstalacion['cli_desc']." - ". $assoc_getQuotationsInstalacion['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsInstalacion['ID_pto']."' href='#collapse".$assoc_getQuotationsInstalacion['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsInstalacion['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsInstalacion['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsInstalacion['cli_desc']."</a>";
           }
     echo "
            </div>
            <div id='collapse".$assoc_getQuotationsInstalacion['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsInstalacion['ID_cli']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsInstalacion['cli_desc']."</a></p>";

               echo "<p>
                                                 <i class='material-icons' style='vertical-align: middle'>
                                                      store
                                                    </i> 
                                                    <strong>
                                                      Proyecto:
                                                    </strong>
                                                      ". $assoc_getQuotationsInstalacion['obr_nproyecto']."
                                             </p>"; 


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

                echo "<p><i class='material-icons' style='vertical-align: middle'>place</i> <strong>Tienda:</strong><a href='".$Mobile_DetectInstalacion."'>".$assoc_getQuotationsInstalacion['obr_desc']." </a>".$direccionInstalacion."</p>";

               
                 $pto_usuarioE1=$assoc_getQuotationsInstalacion['ID_usu'];
                                     $getUsuariosByIdE1=$usuarios->getUsuariosById($pto_usuarioE1);
                                     $assoc_getUsuariosByIdE1=mysql_fetch_assoc($getUsuariosByIdE1);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Operador:</strong> ".$assoc_getUsuariosByIdE1['usu_nombre']." ".$assoc_getUsuariosByIdE1['usu_apellido']."</p>";
                                     
                                     $pto_asignadoE2=$assoc_getQuotationsInstalacion['pto_asignado'];
                                     $getUsuariosByIdE2=$usuarios->getUsuariosById($pto_asignadoE2);
                                     $assoc_getUsuariosByIdE2=mysql_fetch_assoc($getUsuariosByIdE2);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Asignado:</strong> ".$assoc_getUsuariosByIdE2['usu_nombre']." ".$assoc_getUsuariosByIdE2['usu_apellido']."</p>";

                                       if ($assoc_getQuotationsInstalacion['pto_contacto'])
                                     {
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Contacto:</strong> ".$assoc_getQuotationsInstalacion['pto_contacto']."</p>";
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

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsInstalacion['pto_fecIngreso']."</p>";

               if ($assoc_getQuotationsInstalacion['ser_cod']=="")
                {
                 
                }
                else
                {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i><strong> Codigo de Servicio:</strong> ".$assoc_getQuotationsInstalacion['ser_cod']."</p>";
                } 

                 echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                        Codigo de presupuesto:
                                         <strong>
                                          ".$assoc_getQuotationsInstalacion['pto_numero']."
                                        </strong>
                                      </p>";           


                            echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                          Orden de Compra:
                                         <strong>
                                          ".$assoc_getQuotationsInstalacion['pto_OC']."
                                        </strong>
                                      </p>";   

                           echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                          Orden de Venta:
                                         <strong>
                                          ".$assoc_getQuotationsInstalacion['pto_OV']."
                                        </strong>
                                      </p>";     

               
              echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado: </strong>".$assoc_getQuotationsInstalacion['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado:</strong>".$assoc_getQuotationsInstalacion['pto_fecPresupuesto']."</p>

                   <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Despachado: </strong>".$assoc_getQuotationsInstalacion['pto_fecDespacho']."</p>

                  
                         <p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                          description
                                        </i>
                                        <strong>
                                          Detalle:
                                        </strong>
                                          ".$assoc_getQuotationsInstalacion['pto_desc']."
                                      </p>";

                                        // Inicio adjuntos -->
                                      $adj_idRelacion       = $assoc_getQuotationsInstalacion['ID_pto'];
                                      $adj_tablaRelacion    = "quotations";
                                      include('inc/adjuntos.php');
                                 // Fin adjuntos -->

                echo "<div style='display: inline-flex' align='center'>";

                 /* <button type='button' class='btn btn-success' data-toggle='modal' title='Instalacion' data-placement='top' data-target='#".$assoc_getQuotationsInstalacion['ID_pto']."Instalacion' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>";*/

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsInstalacion['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsInstalacion['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                 <a href='deleteQuotationsAS.php?ID_pto=".$assoc_getQuotationsInstalacion['ID_pto']."'><button type='button' class='btn btn-danger'  title='Eliminar'><i class='material-icons'>delete_forever</i></button></a>";

                    if ($assoc_getQuotationsInstalacion['ser_cod']) 
                      {  
                      }
                     else
                     {
                        echo "<button type='button'  style='margin-left: 10px' class='btn btn-success' data-toggle='modal' title='Cerrar' data-placement='top' data-target='#".$assoc_getQuotationsInstalacion['ID_pto']."instalar' id='botonDentroDeDiv'><i class='material-icons'>assignment</i></button>";
                     }         

                  echo "</div></div>";

           echo "</td>
          </tr>"; 
          echo "</div><hr class='negra'>"; 
              }
  }


          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //////////////////////////////       S E P A R A D O R       V I S U A L           //////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////

    if ($action=='GetRegistroServicioCierre')
     {



        $inicioCerradoAS    =   $_POST['inicioCierre'];
                  if (@$_POST['filtro_clienteAsignados']=='null') 
                  {
                    $filtro_clienteAsignadoCerrado= "";
                  }
                  else
                  {
                      $BuscandoComasCerrado = strpos($_POST['filtro_clienteAsignados'], ",");
                        if ($BuscandoComasCerrado === false) 
                        {
                          $filtro_clienteAsignadoCerrado = " AND quotations.pto_asignado='".$_POST['filtro_clienteAsignados']."'";
                        }
                        else
                        {  
                          $arrayCerrado = explode(",", $_POST['filtro_clienteAsignados']);
                          $numeroArrayCerrado=count($arrayCerrado);

                            $filtro_clienteCerradoPrimero="AND (quotations.pto_asignado='".$arrayCerrado['0']."' ";
                              $filtro_clienteCerradoTemporalB="";
                            for ($countArrayCerrado=0; $countArrayCerrado < $numeroArrayCerrado; $countArrayCerrado++) 
                            { 
                              $filtro_clienteCerradoTemporal  = "OR quotations.pto_asignado='".$arrayCerrado[$countArrayCerrado]."'";
                              $filtro_clienteCerradoTemporalB  = $filtro_clienteCerradoTemporalB." ".$filtro_clienteCerradoTemporal;
                            }

                            $filtro_clienteAsignadoCerrado = $filtro_clienteCerradoPrimero." ".$filtro_clienteCerradoTemporalB." )" ;
                          }  
                  }  
                  if (@$_POST['filtro_clienteBuscador']) 
                  {
                    $filtro_clienteBuscadorCerrado = " AND quotations.ID_cli='".$_POST['filtro_clienteBuscador']."'";
                  }
                  else
                  {
                     $filtro_clienteBuscadorCerrado= "";
                  }  
                  if (@$_POST['filtro_tiendaBuscador']=='null') 
                  {
                     $filtro_tiendaBuscadorCerrado = " ";
                  }
                  else
                  {
                    $filtro_tiendaBuscadorCerrado = " AND quotations.ID_obr='".$_POST['filtro_tiendaBuscador']."'";
                  } 
                  if (@$_POST['codigo']) 
                  {
                    $codigoCerrado = " AND quotations.pto_pedidoCod='".$_POST['codigo']."'";
                  }
                  else
                  {
                    $codigoCerrado = " ";
                  }  

               
                  $sql  = "SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
                       WHERE (quotations.ID_tpp='1' OR 
                          quotations.ID_tpp='2' OR
                          quotations.ID_tpp='3' OR
                          quotations.ID_tpp='4' OR
                          quotations.ID_tpp='5' OR
                          quotations.ID_tpp='7' ) AND
                          quotations.ID_sta='14'  AND 
                          quotations.ID_cli=clientes.ID_cli AND
                          quotations.ID_obr=obras.ID_obr   
                      ".$filtro_clienteAsignadoCerrado."  
                      ".$filtro_clienteBuscadorCerrado."
                      ".$filtro_tiendaBuscadorCerrado."
                      ".$codigoCerrado."
                       ORDER BY quotations.ID_pto DESC LIMIT 0, ".$inicioCerradoAS."";
                      $getQuotationsCierre       = mysql_query($sql);
                  

          $num_GetRegistroServicioCerrado=mysql_num_rows($getQuotationsCierre);

          echo "<script>$(document).ready(function(){
                $('#viendoResultadosCierre').html('".$num_GetRegistroServicioCerrado."');
          });</script>";

         for ($CerradoAS=0; $CerradoAS < $num_GetRegistroServicioCerrado; $CerradoAS++)
          { 
            $assoc_getQuotationsCierreAS=mysql_fetch_assoc($getQuotationsCierre);
            $ID_pto                             = $assoc_getQuotationsCierreAS['ID_pto'];
            $ID_sta                             = $assoc_getQuotationsCierreAS['ID_sta'];

    $GetRegistroServicioByIdPto=$registro_servicio->GetRegistroServicioByIdPto($ID_pto);
    $assoc_GetRegistroServicioByIdPto = mysql_fetch_assoc($GetRegistroServicioByIdPto);
  

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
          </div>';                                  
                      
    echo "<tr>
            <td style='vertical-align: middle;'>
            <div id='".$assoc_getQuotationsCierreAS['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0; text-align:left;'>";
            if ($assoc_getQuotationsCierreAS['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsCierreAS['ID_pto']."' href='#collapse".$assoc_getQuotationsCierreAS['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsCierreAS['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsCierreAS['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsCierreAS['cli_desc']." - ". $assoc_getQuotationsCierreAS['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsCierreAS['ID_pto']."' href='#collapse".$assoc_getQuotationsCierreAS['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsCierreAS['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsCierreAS['pto_pedidoCod']. "</b> <br> <i class='material-icons' style='vertical-align: middle'>store</i> " .$assoc_getQuotationsCierreAS['cli_desc']."</a>";
           }
     echo "</div>
            <div id='collapse".$assoc_getQuotationsCierreAS['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsCierreAS['ID_cli']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsCierreAS['cli_desc']."</a></p>";

               echo "<p>
                                                 <i class='material-icons' style='vertical-align: middle'>
                                                      store
                                                    </i> 
                                                    <strong>
                                                      Proyecto:
                                                    </strong>
                                                      ". $assoc_getQuotationsCierreAS['obr_nproyecto']."
                                             </p>"; 

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

                echo "<p><i class='material-icons' style='vertical-align: middle'>place</i> <strong>Tienda:</strong><a href='".$Mobile_DetectCierreAS."'>".$assoc_getQuotationsCierreAS['obr_desc']."  </a>".$direccionCierreAS."</p>";


                 $pto_usuarioF1=$assoc_getQuotationsCierreAS['ID_usu'];
                                     $getUsuariosByIdF1=$usuarios->getUsuariosById($pto_usuarioF1);
                                     $assoc_getUsuariosByIdF1=mysql_fetch_assoc($getUsuariosByIdF1);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Operador:</strong> ".$assoc_getUsuariosByIdF1['usu_nombre']." ".$assoc_getUsuariosByIdF1['usu_apellido']."</p>";
                                     
                                     $pto_asignadoF2=$assoc_getQuotationsCierreAS['pto_asignado'];
                                     $getUsuariosByIdF2=$usuarios->getUsuariosById($pto_asignadoF2);
                                     $assoc_getUsuariosByIdF2=mysql_fetch_assoc($getUsuariosByIdF2);
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Asignado:</strong> ".$assoc_getUsuariosByIdF2['usu_nombre']." ".$assoc_getUsuariosByIdF2['usu_apellido']."</p>";

                                       if ($assoc_getQuotationsCierreAS['pto_contacto'])
                                     {
                                      echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Contacto:</strong> ".$assoc_getQuotationsCierreAS['pto_contacto']."</p>";
                                     }

                   if ($assoc_getQuotationsCierreAS['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsCierreAS['obr_mail']."'>".$assoc_getQuotationsCierreAS['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsCierreAS['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsCierreAS['obr_tel']."'>".$assoc_getQuotationsCierreAS['pto_telefono']."</a></p>";
                 }
               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsCierreAS['pto_fecIngreso']."</p>";

               if ($assoc_getQuotationsCierreAS['ser_cod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio: </strong>".$assoc_getQuotationsCierreAS['ser_cod']."</p>";
                 } 
               

                  echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                        Codigo de presupuesto:
                                         <strong>
                                          ".$assoc_getQuotationsCierreAS['pto_numero']."
                                        </strong>
                                      </p>";           


                            echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                          Orden de Compra:
                                         <strong>
                                          ".$assoc_getQuotationsCierreAS['pto_OC']."
                                        </strong>
                                      </p>";   

                           echo "<p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                        assignment_ind
                                      </i> 
                                          Orden de Venta:
                                         <strong>
                                          ".$assoc_getQuotationsCierreAS['pto_OV']."
                                        </strong>
                                      </p>";     


              echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado: </strong>".$assoc_getQuotationsCierreAS['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado: </strong>".$assoc_getQuotationsCierreAS['pto_fecPresupuesto']."</p>

                   <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Despachado: </strong>".$assoc_getQuotationsCierreAS['pto_fecDespacho']."</p>

                   <p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Servicio: </strong>". $assoc_GetRegistroServicioByIdPto['ser_cod']."</p>

                      <p>
                                      <i class='material-icons' style='vertical-align: middle'>
                                          description
                                        </i>
                                        <strong>
                                          Detalle:
                                        </strong>
                                          ".$assoc_GetRegistroServicioByIdPto['pto_desc']."
                                      </p>";

                                        // Inicio adjuntos -->
                                      $adj_idRelacion       = $assoc_getQuotationsCierreAS['ID_pto'];
                                      $adj_tablaRelacion    = "quotations";
                                      include('inc/adjuntos.php');
                                 // Fin adjuntos -->
                                      
                echo "<div style='display: inline-flex' align='center'>

                  <button type='button' class='btn btn-success' data-toggle='modal' title='Cerrar' data-placement='top' data-target='#".$assoc_getQuotationsCierreAS['ID_pto']."cierre' style='margin-right: 10px'><i class='material-icons center'>assignment</i></button>";

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsCierreAS['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsCierreAS['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <a href='deleteQuotationsAS.php?ID_pto=".$assoc_getQuotationsCierreAS['ID_pto']."'><button type='button' class='btn btn-danger' title='Eliminar'><i class='material-icons'>delete_forever</i></button></a>
               </div></div>";

           echo "</td>
          </tr>"; 
          echo "</div><hr class='negra'>"; 
              }
  }
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

</script>
<!--Fin: Jquery-->  