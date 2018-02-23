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
    $ID_emp                                         = $_SESSION['ID_emp'];
    $ID_usu                                         = $_SESSION['ID_usu'];
    $_SESSION['1-new-quotation-ne']                 = $_SERVER['REQUEST_URI'];
    $_SESSION['dropBack']                           = $_SERVER['REQUEST_URI'];
    $_SESSION['actionsBack']                        = $_SERVER['REQUEST_URI'];
    $usu                                            = $ID_usu;
    $ger                                            = '0';
    $asignado                                       = '0';
  ?>
<!--Fin Head-->
<!--Inicio Objetos-->
  <?php
    $quotations                                     = new quotations;
    $usuarios                                       = new usuarios;
    $monedas                                        = new monedas;
    $adjuntos                                       = new adjuntos;
    $tipo_moneda                                    = new tipo_moneda;
    $status                                         = new status;
    $gerencias_comerciales                          = new gerencias_comerciales;
    $especiales                                     = new especiales;
    $motivos_rechazo                                = new motivos_rechazo;
    $registro_servicio                              = new registro_servicio;
  ?>  
<!--Fin Objetos-->
<!--Inicio Funciones-->
  <?php
    $getQuotationsInserted                          = $quotations->getQuotationsInsertedASIdUsu($ID_usu);
    $num_getQuotationsInserted                      = mysql_num_rows($getQuotationsInserted);
    $getQuotationsInsertedInicial                   = $quotations->getQuotationsInsertedASIdUsu($ID_usu);
    $num_GetRegistroServicioAsignadoInicial         = mysql_num_rows($getQuotationsInsertedInicial);

    $getQuotationsAccepted                          = $quotations->getQuotationsAceptedASIdUsu($ID_usu);
    $num_getQuotationsAccepted                      = mysql_num_rows($getQuotationsAccepted);
    $getQuotationsAcceptedInicial                   = $quotations->getQuotationsAceptedASIdUsu($ID_usu);
    $num_GetRegistroServicioAcceptedInicial         = mysql_num_rows($getQuotationsAcceptedInicial);
  
    $getQuotationsBudgeted                          = $quotations->getQuotationsBudgetedASIdUsu($ID_usu);
    $num_getQuotationsBudgeted                      = mysql_num_rows($getQuotationsBudgeted);
    $getQuotationsBudgetedInicial                   = $quotations->getQuotationsBudgetedASIdUsu($ID_usu);
    $num_GetRegistroServicioPresupuestadosInicial   = mysql_num_rows($getQuotationsBudgetedInicial);
  
    $getQuotationsDespacho                          = $quotations->getQuotationsDespachoASIdUsu($ID_usu);
    $num_getQuotationsDespacho                      = mysql_num_rows($getQuotationsDespacho);
       $getQuotationsDespachoInicial                = $quotations->getQuotationsDespachoASIdUsu($ID_usu);
    $num_GetRegistroServicioDespachoInicial         = mysql_num_rows($getQuotationsDespachoInicial);

    $getQuotationsInstalacion                       = $quotations->getQuotationsInstalacionIdUsu($ID_usu);
    $num_getQuotationsInstalacion                   = mysql_num_rows($getQuotationsInstalacion);
       $getQuotationsInstalacionInicial             = $quotations->getQuotationsInstalacionIdUsu($ID_usu);
    $num_GetRegistroServicioInstalacionInicial      = mysql_num_rows($getQuotationsInstalacionInicial);

    $getQuotationsCierreAS                          = $quotations->getQuotationsCierreASIdUsu($ID_usu);
    $num_getQuotationsCierreAS                      = mysql_num_rows($getQuotationsCierreAS);
     $getQuotationsCierreASInicial                  = $quotations->getQuotationsCierreASIdUsu($ID_usu);
    $num_GetRegistroServicioCierreASInicial         = mysql_num_rows($getQuotationsCierreASInicial);

    $getQuotationsRechazado                         = $quotations->getQuotationsRechazadoIdUsu($ID_usu);
    $num_getQuotationsRechazado                     = mysql_num_rows($getQuotationsRechazado);

    $getQuotationsOtros                             = $quotations->getQuotationsOtrosIdUsu($ID_usu);
    $num_getQuotationsOtros                         = mysql_num_rows($getQuotationsOtros);
  
    $getGerencias_comerciales                       = $gerencias_comerciales->getGerencias_comerciales($ID_emp);
    $getGerencias_comercialesB                      = $gerencias_comerciales->getGerencias_comerciales($ID_emp);

    $num_getGerencias_comerciales                   = mysql_num_rows($getGerencias_comerciales);
    $num_getGerencias_comercialesB                  = mysql_num_rows($getGerencias_comercialesB);
   ?>
<!--Fin Funciones-->
<!--Inicio Alertas-->
  <?php
    if(isset($_GET['m']))
    {
      $ID_ale                                         = $_GET['m'];
      $especiales                                     = new especiales();
      $getAlerta                                      = $especiales->getAlerta($ID_ale);
      $assoc_getAlerta                                = mysql_fetch_assoc($getAlerta);
      echo $assoc_getAlerta['ale_desc'];
    }
  ?>
<div id='alertas' name='alertas'></div>
<!--Fin Alertas-->
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
       #icono
       {
        width: 100%;
        text-align: center;
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

      h4
      {
        text-align: center;
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
    .material-icons
    {
      vertical-align: middle;
    }
  </style>

    <!--Fin Estilos exclusivos-->

<?php 
/*
 //Trae Modulo para construir el asunto del mensaje
   $responsable ="responsable";
    $texto                       =   "<p>Se cargo un nuevo Presupuesto AS con la siguiente descripcion: ".$responsable."</p><p>Responsable: " . $responsable . "</p><p><h4>DATOS DEL CLIENTE</h4></p><p>Contacto: " . $responsable  . "</p><p>Email: " . $responsable . "</p><p>Telefono: " . $responsable  . "</p>";

    
echo $variable=$texto;
*/
?>


<!--Inicio Script de loading general-->
  <script type="text/javascript">
    $(window).load(function () {
      $('#cargando').hide();
    });

    </script>
    <div id="cargando">

    </div>
<!--Fin Script de loading general-->

<!--Inicio Cambia de color la solapa si los registros son diferentes de cero-->
  <?php 
    if ($num_getQuotationsRechazado!=0)
     {
      $styloRechazados="style='background-color: #f00; color: #fff;'";
     }
     else
     {
      $styloRechazados="";
     } 
      if ($num_getQuotationsOtros!=0)
     {
      $styloAbiertos="style='background-color: #f00; color: #fff;'";
     }
     else
     {
      $styloAbiertos="";
     } 
  ?>
<!--Fin Cambia de color la solapa si los registros son diferentes de cero-->

<!--Inicio definicion de pestañas-->
<ul class="nav nav-tabs"    style="background-color: #fff; margin-top: 5px; ">
  <li><a href="#inicio"     data-toggle="tab"><i class="material-icons">turned_in</i> Principal</a></li>
  <li ><a href="#Rechazados" <?php echo $styloRechazados;?> data-toggle="tab"><i class="material-icons">pan_tool</i> Rechazados (<?php echo $num_getQuotationsRechazado?>)</a></li>
  <li><a href="#Historial"  data-toggle="tab"><i class="material-icons">history</i> Historial</a></li>
  <li ><a href="#Abiertos" <?php echo $styloAbiertos;?>  data-toggle="tab"><i class="material-icons">lock_open</i> Abiertos (<?php echo $num_getQuotationsOtros?>)</a></li>
</ul>
<!--Fin definicion de pestañas-->



<!-- Inicio div gral -->
<div class="tab-content" >
<!-- INICIO SOLAPA PRINCIPAL-->
  <div class="tab-pane fade in active" id="inicio" >
  <!-- Inicio div Asignados -->
     <!--INICIO: BARRA DE BUSQUEDA-->
    <?php
      @$tabla                   = "  "; //Nombre de la tabla en donde el buscador debe buscar
      @$BusquedaColumnaCodigo   = "  "; //Nombre de columna en la que se debe buscar el Codigo
      @$DirectorioDelSistema    = "quotations"; //Nombre de la carpeta que aloja al sistema actual 
      @$UrlDeRetorno            = "dashboard-sales-AS.php"; //Url a la que se debe redireccionar luego de ejecutar la funcion
      include('../inc/barraDeBusqueda.php');  
    ?>
   <!--FIN: BARRA DE BUSQUEDA-->

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
      $determinanteDeColumnaAsignado="AsignadoAS";
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
     <hr class='negra'>
          <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
          <tr>
          </tr>
        </thead>
        <tbody id='myTable'>
            <div id='resultados<?php echo $determinanteDeColumnaAsignado;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
                <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaAsignado;?>" id="Inicio<?php echo $determinanteDeColumnaAsignado;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaAsignado;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
            <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaAsignado;?>' style="display: none; width: 100%; height: auto;" >
             
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    </div>
    <!-- Fin div Asignado -->
 
<!-- Inicio div Aceptados -->
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
    $determinanteDeColumnaAccepted="Accepted";
    echo "<div id='iconoAccepted'>";
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
     <hr class='negra'>
      <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
          <tr>
          </tr>
        </thead>
        <tbody id='myTable'>
            <div id='resultados<?php echo $determinanteDeColumnaAccepted;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
               <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaAccepted;?>" id="Inicio<?php echo $determinanteDeColumnaAccepted;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaAccepted;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
            <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaAccepted;?>' style="display: none; width: 100%; height: auto;" >

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
      <h4><i class="material-icons">description</i> Presup. (<?PHP echo $num_getQuotationsBudgeted;?>)</h4>
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
  
     $determinanteDeColumnaPresupuestados="Presupuestados";
     ?>
     <hr class='negra'>
    <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'  border="1">
        <thead>
        <tr>
           
          </tr>
          <tr>
  
  
          </tr>
        </thead>
        <tbody id='myTable'>
          <div id='resultados<?php echo $determinanteDeColumnaPresupuestados;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
                <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaPresupuestados;?>" id="Inicio<?php echo $determinanteDeColumnaPresupuestados;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaPresupuestados;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
              <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaPresupuestados;?>' style="display: none; width: 100%; height: auto;" >
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

      $determinanteDeColumnaDespacho="Despacho";
     ?>
     <hr class='negra'>
     <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
              
        </tr>
      <tr>
   

       </tr>
      </thead>
        <tbody id='myTable'>
            <div id='resultados<?php echo $determinanteDeColumnaDespacho;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
               <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaDespacho;?>" id="Inicio<?php echo $determinanteDeColumnaDespacho;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaDespacho;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
              <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaDespacho;?>' style="display: none; width: 100%; height: auto;" >
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
       $determinanteDeColumnaInstalacion="Instalacion";
     ?>

     <hr class='negra'>
      <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
           

                 
          </tr>
          <tr>
      

          </tr>
        </thead>
        <tbody id='myTable'>
            <div id='resultados<?php echo $determinanteDeColumnaInstalacion;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
              <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaInstalacion;?>" id="Inicio<?php echo $determinanteDeColumnaInstalacion;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaInstalacion;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
              <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaInstalacion;?>' style="display: none; width: 100%; height: auto;" >
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
        $determinanteDeColumnaCierreAS="Cierre";
     ?>
     <hr class='negra'>
    <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
           

                 
          </tr>
          <tr>
        

          </tr>
        </thead>
        <tbody id='myTable'>
            <div id='resultados<?php echo $determinanteDeColumnaCierreAS;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
               <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaCierreAS;?>" id="Inicio<?php echo $determinanteDeColumnaCierreAS;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaCierreAS;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
              <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaCierreAS;?>' style="display: none; width: 100%; height: auto;" >
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
      <h3><i class="material-icons">pan_tool</i>  Rechazados (<?php echo $num_getQuotationsRechazado;?>)</h3>
           <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
           
          </tr>
          <tr>
          


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
         <input type="text" name="codigoBuscador" class="form-control" id="codigoBuscador"></input> 
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
                 $getQuotationsUsuarios = $quotations->getQuotationsUsuariosHistorialAS();
                 $num_getQuotationsUsuarios = mysql_num_rows($getQuotationsUsuarios);
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
  <!-- INICIO SOLAPA Abierto-->  
    <div class="tab-pane fade" id="Abiertos"> 
           
      <div class="col-md-4" style=" background-color:#fff; margin-top:10px; border: 4px solid #333; -webkit-border-radius: 15px; -moz-border-radius: 15px;">
      <h3><i class="material-icons">lock_open</i> Abiertos (<?php echo $num_getQuotationsOtros?>)</h3>
           <div class='table-responsive'>
      <table class='table table-condensed table-hover table-striped'>
        <thead>
        <tr>
           
          </tr>
          <tr>

          </tr>
        </thead>
        <tbody id='myTable'>

 <?php

  for($d=0; $d<$num_getQuotationsOtros; $d++)
  {
    $assoc_getQuotationsOtros          = mysql_fetch_assoc($getQuotationsOtros);
    $ID_pto                             = $assoc_getQuotationsOtros['ID_pto'];
    $ID_sta                             = $assoc_getQuotationsOtros['ID_sta'];
    $ID_tpu="11";
    $getUsuariosByIdTpuB = $usuarios->getUsuariosByIdTpu($ID_tpu);
    $num_getUsuariosByIdTpuB = mysql_num_rows($getUsuariosByIdTpuB);
   /* Inicio Modal asignar*/                          
    echo '<div class="modal fade" id="'.$assoc_getQuotationsOtros['ID_pto'].'asignar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Asignar Pedido - '.$assoc_getQuotationsOtros['pto_pedidoCod'].'</h4>
                  </div>
                  <div class="modal-body">
                   <div class="alert alert-success" role="alert">
                    </div>
                    <form action="actions-quotation-as.php" method="post" id="asignarPresupuestado" name="asignarPresupuestado" enctype="multipart/form-data">
                     <div class="form-group">
                      <label for="pto_asig">Seleccione Presupuestista</label>

                      <select name="pto_asignado" required>';
                          
                     echo $vendedores = $usuarios->vendedores();
                    echo '</select>

                    </div>
                    <div class="form-group">
                      <input type="date" class="form-control" name="pto_fecEntregaEstimada" required value="'.$assoc_getQuotationsOtros['pto_fecEntregaEstimada'].'" />
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsOtros['ID_pto'].'" >
                    <input type="hidden" name="ID_sta" value="2">
                    <input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotationsOtros['pto_pedidoCod'].'" >
                    <input type="hidden" name="actionAS" value="asignado">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-success" type="submit"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Asignar</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal asignar */

   /* Inicio Modal Eliminar */
   echo '<div class="modal fade" id="'.$assoc_getQuotationsOtros['ID_pto'].'EliminarRechazados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Instalacion - '.$assoc_getQuotationsOtros['pto_pedidoCod'].'</h4>
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
                         <input type="hidden" name="ID_pto" value="'.$assoc_getQuotationsOtros['ID_pto'].'" />
                          <input type="hidden" name="pto_asignado" value="'.$assoc_getQuotationsOtros['pto_pedidoCod'].'" />
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
            <div id='".$assoc_getQuotationsOtros['ID_pto']."' role='tablist' aria-multiselectable='true' style='margin: 0;'>
             ";
             if ($assoc_getQuotationsOtros['ser_cod']) { 
            echo "<a style='color: #090;' data-toggle='collapse' data-parent='#".$assoc_getQuotationsOtros['ID_pto']."' href='#collapse".$assoc_getQuotationsOtros['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsOtros['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsOtros['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsOtros['cli_desc']." - ". $assoc_getQuotationsOtros['ser_cod']."</a>";
           }
           else
           {
             echo "<a data-toggle='collapse' data-parent='#".$assoc_getQuotationsOtros['ID_pto']."' href='#collapse".$assoc_getQuotationsOtros['ID_pto']."' aria-expanded='true' aria-controls='collapse".$assoc_getQuotationsOtros['ID_pto']."'><b><i class='material-icons' style='vertical-align: middle'>list</i> ".$assoc_getQuotationsOtros['pto_pedidoCod']. "</b> - " .$assoc_getQuotationsOtros['cli_desc']."</a>";
           }
            echo " 
            </div>
            <div id='collapse".$assoc_getQuotationsOtros['ID_pto']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>
              <div class='panel-body'>

               <p><i class='material-icons' style='vertical-align: middle'>store</i> <strong>Cliente:</strong> <a href='../MasterData/modify-customer.php?id=".base64_encode((12344*($assoc_getQuotationsOtros['ID_obr']))/12)."' data-toggle='modal' title='Ver Cliente' target='_blank' data-placement='top'>".$assoc_getQuotationsOtros['obr_desc']."</a></p>";

                  //INICIO: busca como llegar al cliente en mapa por cualquier dispositivo
                  $direccionMapaOtros=$assoc_getQuotationsOtros['obr_URL'];
                  $diremapOtros         = explode('?', $direccionMapaOtros);
                  if (!isset($diremapOtros[1])) 

                  {
                      $Mobile_DetectOtros="http://maps.google.com?daddr=".$assoc_getQuotationsOtros['obr_dir']."";
                      $direccionOtros="<a id='direccion'>(Dirección Desactualizada)</a>";
                  }
                  else
                   {
                      $direccionOtros="";
                      if( $detect->isAndroid() ) {
                       // Android
                       $Mobile_DetectOtros="geo:0,0?daddr=".$diremapOtros[1]."";
                      } elseif ( $detect->isIphone() ) {
                       // iPhone
                       $Mobile_DetectOtros="http://maps.apple.com/maps?saddr=".$diremapOtroso[1]."";
                      } elseif ( $detect->isWindowsphone() ) {
                       // Windows Phone
                       $Mobile_DetectOtros="maps:".$diremapOtros[1]."";
                      } else{
                       // Por defecto
                       $Mobile_DetectOtros = "http://maps.google.com?daddr=".$diremapOtros[1]."";
                      } 

                   } 
                  //FIN: busca como llegar al cliente en mapa por cualquier dispositivo

                echo "<p><i class='material-icons' style='vertical-align: middle'>place</i> <strong>Tienda:</strong><a href='".$Mobile_DetectOtros."'>".$assoc_getQuotationsOtros['obr_desc']."   ".$assoc_getQuotationsOtros['obr_desc']."</a>".$direccionOtros."</p>";

                   if ($assoc_getQuotationsOtros['pto_contacto'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>face</i> <strong>Usuario:</strong> ".$assoc_getQuotationsOtros['pto_contacto']."</p>";
                 }

                   if ($assoc_getQuotationsOtros['pto_mail'])
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>mail_outline</i> <strong>Email:</strong> <a href='mailto:".$assoc_getQuotationsOtros['obr_mail']."'>".$assoc_getQuotationsOtros['pto_mail']."</a></p>";
                 }

                    if ($assoc_getQuotationsOtros['pto_telefono'])
                 {
                    echo "<p><i class='material-icons' style='vertical-align: middle'>phone</i> <strong>Telefono:</strong><a href='tel:".$assoc_getQuotationsOtros['obr_tel']."'>".$assoc_getQuotationsOtros['pto_telefono']."</a></p>";
                 }

               echo "<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Ingreso:</strong> ".$assoc_getQuotationsOtros['pto_fecIngreso']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>assignment_ind</i> <strong>Presupuestista: </strong>".$usuarios->genereaUsuariosNomApe($assoc_getQuotationsOtros['pto_asignado'])."</p>";

               if ($assoc_getQuotationsOtros['ser_cod']=="")
                {
                 
                }
                else
                 {
                  echo "<p><i class='material-icons' style='vertical-align: middle'>receipt</i> <strong>Codigo de Servicio: </strong>".$assoc_getQuotationsOtros['ser_cod']."</p>";
                 } 

              echo"<p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Aceptado: </strong>".$assoc_getQuotationsOtros['pto_fecAceptado']."</p>

               <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Presupuestado:</strong>".$assoc_getQuotationsOtros['pto_fecPresupuesto']."</p>

                   <p><i class='material-icons' style='vertical-align: middle'>access_time</i> <strong>Despachado: </strong>".$assoc_getQuotationsOtros['pto_fecDespacho']."</p>";

                echo "<div style='display: inline-flex' align='center'>

                  <button type='button' class='btn btn-success' data-toggle='modal' title='asignar' data-placement='top' data-target='#".$assoc_getQuotationsOtros['ID_pto']."asignar' style='margin-right: 10px'><i class='material-icons center'>assignment_ind</i></button>";

                echo '<a href="modify-quotation-as.php?ID_pto='.base64_encode((12344*($assoc_getQuotationsOtros['ID_pto']))/12).'&ID_obr='.base64_encode((12344*($assoc_getQuotationsOtros['ID_obr']))/12).'">';
                echo "<button class='btn btn-primary' title='Ver / Modificar' data-toggle='modal' data-placement='top' style='margin-right: 10px'><i class='material-icons center'>edit</i></button></a>

                <button type='button' class='btn btn-danger' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#".$assoc_getQuotationsOtros['ID_pto']."EliminarRechazados'><i class='material-icons'>delete_forever</i></button>
               </div>";

           echo "</td>
          </tr>";

  }
      
?>
        </tbody>
          <tfoot>
            <tr>
             

            </tr>
          </tfoot>
        </table>
      </div>
      </div>
    <!-- Fin div Rechazados -->
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
                        ("quotations-filtroAS.php", {
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
                        ("quotations-filtroAS.php", {
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
                        ("quotations-filtroAS.php", {ID_pto: "'.@$ID_pto.'"}, function(){
                      });});});
  </script>';
  echo '<script>
              $(document).ready(function(){
                     $("#buscar").click(function(evento){
                        evento.preventDefault();
                        var codigo      = $("#codigoBuscador").val();
                        $("#cargaexterna").load
                        ("quotations-filtroAS.php", {codigo: codigo}, function(){
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
<script type="text/javascript">
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
   $("#DatosCliente").css("display", "block");
   $("#iconoPresupuestados").css("display", "none");
   });
   $("#contraerPresupuestados").click(function() {
   $("#ExpandirPresupuestados").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
   $("#expandirPresupuestados").css("display", "block");
   $("#contraerPresupuestados").css("display", "none");
   $("#DatosCliente").css("display", "none");
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


<?php 

    if (@$_GET['ID_Buscador']) 
    {
      $ID_buscadorAsignadoAS=$_GET['ID_Buscador'];
      $ID_buscadorAcceptedAS=$_GET['ID_Buscador'];
      $ID_buscadorPresupuestadosAS=$_GET['ID_Buscador'];
      $ID_buscadorDespachoAS=$_GET['ID_Buscador'];
      $ID_buscadorInstalacionAS=$_GET['ID_Buscador'];
      $ID_buscadorCierreAS=$_GET['ID_Buscador'];
    }
    else
    {
      $ID_buscadorAsignadoAS=0;
      $ID_buscadorAcceptedAS=0;
      $ID_buscadorPresupuestadosAS=0;
      $ID_buscadorDespachoAS=0;
      $ID_buscadorInstalacionAS=0;
      $ID_buscadorCierreAS=0;
    }  
    if (@$_GET['codigo']) 
    {
      $ID_codigoAsignadoAS=$_GET['codigo'];
      $ID_codigoAcceptedAS=$_GET['codigo'];
      $ID_codigoPresupuestadosAS=$_GET['codigo'];
      $ID_codigoDespachoAS=$_GET['codigo'];
      $ID_codigoInstalacionAS=$_GET['codigo'];
      $ID_codigoCierreAS=$_GET['codigo'];
    }
    else
     {
      $ID_codigoAsignadoAS=0;
      $ID_codigoAcceptedAS=0;
      $ID_codigoPresupuestadosAS=0;
      $ID_codigoDespachoAS=0;
      $ID_codigoInstalacionAS=0;
      $ID_codigoCierreAS=0;
     }  
     if (@$_GET['ID_cli'])
    {
      if ($_GET['ID_cli']!='0' or $_GET['ID_cli']!=0) 
      { 
        $ID_clienteAsignadoAS=$_GET['ID_cli'];
        $ID_clienteAcceptedAS=$_GET['ID_cli'];
        $ID_clientePresupuestadosAS=$_GET['ID_cli'];
        $ID_clienteDespachoAS=$_GET['ID_cli'];
        $ID_clienteInstalacionAS=$_GET['ID_cli'];
        $ID_clienteCierreAS=$_GET['ID_cli'];
      }
     }
    else
    {
        $ID_clienteAsignadoAS=0;
        $ID_clienteAcceptedAS=0;
        $ID_clientePresupuestadosAS=0;
        $ID_clienteDespachoAS=0;
        $ID_clienteInstalacionAS=0;
        $ID_clienteCierreAS=0;
    }  
        echo "<script> var total".$determinanteDeColumnaAsignado."=10; $(document).ready(function()
            {  
            
              var action".$determinanteDeColumnaAsignado." = 'GetRegistroServicio".$determinanteDeColumnaAsignado."';

              var inicio".$determinanteDeColumnaAsignado." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAsignado."]').val();

              var dataString".$determinanteDeColumnaAsignado." = 'inicio".$determinanteDeColumnaAsignado."='+inicio".$determinanteDeColumnaAsignado." + '&action='+action".$determinanteDeColumnaAsignado."  +
               '&ID_buscadorAsignadoAS='+".$ID_buscadorAsignadoAS." + 
                '&ID_clienteAsignado='+".$ID_clienteAsignadoAS." +
               '&ID_codigoAsignadoAS=+".$ID_codigoAsignadoAS."' ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaAsignado.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaAsignado."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAsignado."]').val();
                     
                     if (".$determinanteDeColumnaAsignado."Total>= ".$num_GetRegistroServicioAsignadoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaAsignado."').toggle('slow');
                     }

                     $('#resultados".$determinanteDeColumnaAsignado."').toggle('slow').delay(100).toggle('slow').html(data);
                      total".$determinanteDeColumnaAsignado."= (parseInt(inicio".$determinanteDeColumnaAsignado.") + parseInt(total".$determinanteDeColumnaAsignado."));
                     $('#Inicio".$determinanteDeColumnaAsignado."').val(total".$determinanteDeColumnaAsignado.");

                 
                   }
               });
           });</script>";

     echo "<script> var total".$determinanteDeColumnaAsignado."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaAsignado."').click(function()
            {  

              var action".$determinanteDeColumnaAsignado." = 'GetRegistroServicio".$determinanteDeColumnaAsignado."';
              var inicio".$determinanteDeColumnaAsignado." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAsignado."]').val();
              var dataString".$determinanteDeColumnaAsignado." = 'inicio".$determinanteDeColumnaAsignado."='+inicio".$determinanteDeColumnaAsignado." + '&action='+action".$determinanteDeColumnaAsignado."  +
               '&ID_buscadorAsignadoAS='+".$ID_buscadorAsignadoAS." + 
                '&ID_clienteAsignado='+".$ID_clienteAsignadoAS." +
               '&ID_codigoAsignadoAS=+".$ID_codigoAsignadoAS."' ;
                 $('#cargandoBoton".$determinanteDeColumnaAsignado."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaAsignado.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaAsignado."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAsignado."]').val();
                    
                     if (".$determinanteDeColumnaAsignado."Total>= ".$num_GetRegistroServicioAsignadoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaAsignado."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaAsignado."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaAsignado."= (parseInt(inicio".$determinanteDeColumnaAsignado.") + parseInt(total".$determinanteDeColumnaAsignado."));
                     $('#Inicio".$determinanteDeColumnaAsignado."').val(total".$determinanteDeColumnaAsignado.");
                        $('#cargandoBoton".$determinanteDeColumnaAsignado."').css('display', 'none');
                  
                   }
               });
           });</script>";

              echo "<script> var total".$determinanteDeColumnaAccepted."=10; $(document).ready(function()
            {  
              var action".$determinanteDeColumnaAccepted." = 'GetRegistroServicio".$determinanteDeColumnaAccepted."';
              var inicio".$determinanteDeColumnaAccepted." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAccepted."]').val();
              var dataString".$determinanteDeColumnaAccepted." = 'inicio".$determinanteDeColumnaAccepted."='+inicio".$determinanteDeColumnaAccepted." + '&action='+action".$determinanteDeColumnaAccepted." +
                '&ID_buscadorAccepted='+".$ID_buscadorAcceptedAS." +
                 '&ID_clienteAccepted='+".$ID_clienteAcceptedAS." +
                 '&ID_codigoAccepted=+".$ID_codigoAcceptedAS."' ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaAccepted.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaAccepted."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAccepted."]').val();
                    
                     if (".$determinanteDeColumnaAccepted."Total>= ".$num_GetRegistroServicioAcceptedInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaAccepted."').toggle('slow');
                     }

                     $('#resultados".$determinanteDeColumnaAccepted."').toggle('slow').delay(300).toggle('slow').html(data);
                      total".$determinanteDeColumnaAccepted."= (parseInt(inicio".$determinanteDeColumnaAccepted.") + parseInt(total".$determinanteDeColumnaAccepted."));
                     $('#Inicio".$determinanteDeColumnaAccepted."').val(total".$determinanteDeColumnaAccepted.");

                 
                   }
               });
           });</script>";

     echo "<script> var total".$determinanteDeColumnaAccepted."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaAccepted."').click(function()
            {  

              var action".$determinanteDeColumnaAccepted." = 'GetRegistroServicio".$determinanteDeColumnaAccepted."';
              var inicio".$determinanteDeColumnaAccepted." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAccepted."]').val();
              var dataString".$determinanteDeColumnaAccepted." = 'inicio".$determinanteDeColumnaAccepted."='+inicio".$determinanteDeColumnaAccepted." + '&action='+action".$determinanteDeColumnaAccepted." +
               '&ID_codigoAccepted=+".$ID_codigoAcceptedAS."' +
               '&ID_clienteAccepted='+".$ID_clienteAcceptedAS." +
               '&ID_buscadorAccepted='+".$ID_buscadorAcceptedAS." ;
                 $('#cargandoBoton".$determinanteDeColumnaAccepted."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaAccepted.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaAccepted."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAccepted."]').val();
                    
                     if (".$determinanteDeColumnaAccepted."Total>= ".$num_GetRegistroServicioAcceptedInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaAccepted."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaAccepted."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaAccepted."= (parseInt(inicio".$determinanteDeColumnaAccepted.") + parseInt(total".$determinanteDeColumnaAccepted."));
                     $('#Inicio".$determinanteDeColumnaAccepted."').val(total".$determinanteDeColumnaAccepted.");
                        $('#cargandoBoton".$determinanteDeColumnaAccepted."').css('display', 'none');
                  
                   }
               });
           });</script>";
                         echo "<script> var total".$determinanteDeColumnaPresupuestados."=10; $(document).ready(function()
            {  
              var action".$determinanteDeColumnaPresupuestados." = 'GetRegistroServicio".$determinanteDeColumnaPresupuestados."';
              var inicio".$determinanteDeColumnaPresupuestados." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaPresupuestados."]').val();
              var dataString".$determinanteDeColumnaPresupuestados." = 'inicio".$determinanteDeColumnaPresupuestados."='+inicio".$determinanteDeColumnaPresupuestados." +
               '&action='+action".$determinanteDeColumnaPresupuestados." +
               '&ID_codigoPresupuestados=+".$ID_codigoPresupuestadosAS."' +
                '&ID_clientePresupuestados='+".$ID_clientePresupuestadosAS." +
                 '&ID_buscadorPresupuestados='+".$ID_buscadorPresupuestadosAS." ;

              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaPresupuestados.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaPresupuestados."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaPresupuestados."]').val();
                    
                     if (".$determinanteDeColumnaPresupuestados."Total>= ".$num_GetRegistroServicioPresupuestadosInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaPresupuestados."').toggle('slow');
                     }

                     $('#resultados".$determinanteDeColumnaPresupuestados."').toggle('slow').delay(500).toggle('slow').html(data);
                      total".$determinanteDeColumnaPresupuestados."= (parseInt(inicio".$determinanteDeColumnaPresupuestados.") + parseInt(total".$determinanteDeColumnaPresupuestados."));
                     $('#Inicio".$determinanteDeColumnaPresupuestados."').val(total".$determinanteDeColumnaPresupuestados.");

                 
                   }
               });
           });</script>";

     echo "<script> var total".$determinanteDeColumnaPresupuestados."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaPresupuestados."').click(function()
            {  

              var action".$determinanteDeColumnaPresupuestados." = 'GetRegistroServicio".$determinanteDeColumnaPresupuestados."';
              var inicio".$determinanteDeColumnaPresupuestados." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaPresupuestados."]').val();
              var dataString".$determinanteDeColumnaPresupuestados." = 'inicio".$determinanteDeColumnaPresupuestados."='+inicio".$determinanteDeColumnaPresupuestados." + 
               '&action='+action".$determinanteDeColumnaPresupuestados." +
               '&ID_codigoPresupuestados=+".$ID_codigoPresupuestadosAS."' +
                '&ID_clientePresupuestados='+".$ID_clientePresupuestadosAS." +
                 '&ID_buscadorPresupuestados='+".$ID_buscadorPresupuestadosAS." ;

                 $('#cargandoBoton".$determinanteDeColumnaPresupuestados."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaPresupuestados.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaPresupuestados."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaPresupuestados."]').val();
                    
                     if (".$determinanteDeColumnaPresupuestados."Total>= ".$num_GetRegistroServicioPresupuestadosInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaPresupuestados."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaPresupuestados."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaPresupuestados."= (parseInt(inicio".$determinanteDeColumnaPresupuestados.") + parseInt(total".$determinanteDeColumnaPresupuestados."));
                     $('#Inicio".$determinanteDeColumnaPresupuestados."').val(total".$determinanteDeColumnaPresupuestados.");
                        $('#cargandoBoton".$determinanteDeColumnaPresupuestados."').css('display', 'none');
                  
                   }
               });
           });</script>";

            echo "<script> var total".$determinanteDeColumnaDespacho."=10; $(document).ready(function()
            {  
              var action".$determinanteDeColumnaDespacho." = 'GetRegistroServicio".$determinanteDeColumnaDespacho."';
              var inicio".$determinanteDeColumnaDespacho." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaDespacho."]').val();
              var dataString".$determinanteDeColumnaDespacho." = 'inicio".$determinanteDeColumnaDespacho."='+inicio".$determinanteDeColumnaDespacho." + '&action='+action".$determinanteDeColumnaDespacho." +
               '&ID_codigoDespacho=+".$ID_codigoDespachoAS."' +
               '&ID_clienteDespacho='+".$ID_clienteDespachoAS." +
               '&ID_buscadorDespacho='+".$ID_buscadorDespachoAS." ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaDespacho.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaDespacho."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaDespacho."]').val();
                    
                     if (".$determinanteDeColumnaDespacho."Total>= ".$num_GetRegistroServicioDespachoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaDespacho."').toggle('slow');
                     }

                     $('#resultados".$determinanteDeColumnaDespacho."').toggle('slow').delay(600).toggle('slow').html(data);
                      total".$determinanteDeColumnaDespacho."= (parseInt(inicio".$determinanteDeColumnaDespacho.") + parseInt(total".$determinanteDeColumnaDespacho."));
                     $('#Inicio".$determinanteDeColumnaDespacho."').val(total".$determinanteDeColumnaDespacho.");

                 
                   }
               });
           });</script>";

     echo "<script> var total".$determinanteDeColumnaDespacho."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaDespacho."').click(function()
            {  

              var action".$determinanteDeColumnaDespacho." = 'GetRegistroServicio".$determinanteDeColumnaDespacho."';
              var inicio".$determinanteDeColumnaDespacho." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaDespacho."]').val();
              var dataString".$determinanteDeColumnaDespacho." = 'inicio".$determinanteDeColumnaDespacho."='+inicio".$determinanteDeColumnaDespacho." + '&action='+action".$determinanteDeColumnaDespacho." +
               '&ID_codigoDespacho=+".$ID_codigoDespachoAS."' +
               '&ID_clienteDespacho='+".$ID_clienteDespachoAS." +
               '&ID_buscadorDespacho='+".$ID_buscadorDespachoAS." ;
                 $('#cargandoBoton".$determinanteDeColumnaDespacho."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaDespacho.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaDespacho."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaDespacho."]').val();
                    
                     if (".$determinanteDeColumnaDespacho."Total>= ".$num_GetRegistroServicioDespachoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaDespacho."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaDespacho."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaDespacho."= (parseInt(inicio".$determinanteDeColumnaDespacho.") + parseInt(total".$determinanteDeColumnaDespacho."));
                     $('#Inicio".$determinanteDeColumnaDespacho."').val(total".$determinanteDeColumnaDespacho.");
                        $('#cargandoBoton".$determinanteDeColumnaDespacho."').css('display', 'none');
                  
                   }
               });
           });</script>";


                 echo "<script> var total".$determinanteDeColumnaInstalacion."=10; $(document).ready(function()
            {  
              var action".$determinanteDeColumnaInstalacion." = 'GetRegistroServicio".$determinanteDeColumnaInstalacion."';
              var inicio".$determinanteDeColumnaInstalacion." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaInstalacion."]').val();
              var dataString".$determinanteDeColumnaInstalacion." = 'inicio".$determinanteDeColumnaInstalacion."='+inicio".$determinanteDeColumnaInstalacion." + '&action='+action".$determinanteDeColumnaInstalacion." +
               '&ID_codigoInstalacion=+".$ID_codigoInstalacionAS."' +
               '&ID_clienteInstalacion='+".$ID_clienteInstalacionAS." +
               '&ID_buscadorInstalacion='+".$ID_buscadorInstalacionAS." ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaInstalacion.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaInstalacion."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaInstalacion."]').val();
                    
                     if (".$determinanteDeColumnaInstalacion."Total>= ".$num_GetRegistroServicioInstalacionInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaInstalacion."').toggle('slow');
                     }

                     $('#resultados".$determinanteDeColumnaInstalacion."').toggle('slow').delay(800).toggle('slow').html(data);
                      total".$determinanteDeColumnaInstalacion."= (parseInt(inicio".$determinanteDeColumnaInstalacion.") + parseInt(total".$determinanteDeColumnaInstalacion."));
                     $('#Inicio".$determinanteDeColumnaInstalacion."').val(total".$determinanteDeColumnaInstalacion.");

                 
                   }
               });
           });</script>";

     echo "<script> var total".$determinanteDeColumnaInstalacion."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaInstalacion."').click(function()
            {  

              var action".$determinanteDeColumnaInstalacion." = 'GetRegistroServicio".$determinanteDeColumnaInstalacion."';
              var inicio".$determinanteDeColumnaInstalacion." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaInstalacion."]').val();
              var dataString".$determinanteDeColumnaInstalacion." = 'inicio".$determinanteDeColumnaInstalacion."='+inicio".$determinanteDeColumnaInstalacion." + '&action='+action".$determinanteDeColumnaInstalacion." +
               '&ID_codigoInstalacion=+".$ID_codigoInstalacionAS."' +
               '&ID_clienteInstalacion='+".$ID_clienteInstalacionAS." +
               '&ID_buscadorInstalacion='+".$ID_buscadorInstalacionAS." ;
                 $('#cargandoBoton".$determinanteDeColumnaInstalacion."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaInstalacion.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaInstalacion."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaInstalacion."]').val();
                    
                     if (".$determinanteDeColumnaInstalacion."Total>= ".$num_GetRegistroServicioInstalacionInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaInstalacion."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaInstalacion."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaInstalacion."= (parseInt(inicio".$determinanteDeColumnaInstalacion.") + parseInt(total".$determinanteDeColumnaInstalacion."));
                     $('#Inicio".$determinanteDeColumnaInstalacion."').val(total".$determinanteDeColumnaInstalacion.");
                        $('#cargandoBoton".$determinanteDeColumnaInstalacion."').css('display', 'none');
                  
                   }
               });
           });</script>";


            echo "<script> var total".$determinanteDeColumnaCierreAS."=10; $(document).ready(function()
            {  
              var action".$determinanteDeColumnaCierreAS." = 'GetRegistroServicio".$determinanteDeColumnaCierreAS."';
              var inicio".$determinanteDeColumnaCierreAS." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaCierreAS."]').val();
              var dataString".$determinanteDeColumnaCierreAS." = 'inicio".$determinanteDeColumnaCierreAS."='+inicio".$determinanteDeColumnaCierreAS." + '&action='+action".$determinanteDeColumnaCierreAS." +
               '&ID_codigoCierre=+".$ID_codigoCierreAS."' +
               '&ID_clienteCierre='+".$ID_clienteCierreAS." +
               '&ID_buscadorCierre='+".$ID_buscadorCierreAS." ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaCierreAS.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaCierreAS."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaCierreAS."]').val();
                    
                     if (".$determinanteDeColumnaCierreAS."Total>= ".$num_GetRegistroServicioCierreASInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaCierreAS."').toggle('slow');
                     }

                     $('#resultados".$determinanteDeColumnaCierreAS."').toggle('slow').delay(1000).toggle('slow').html(data);
                      total".$determinanteDeColumnaCierreAS."= (parseInt(inicio".$determinanteDeColumnaCierreAS.") + parseInt(total".$determinanteDeColumnaCierreAS."));
                     $('#Inicio".$determinanteDeColumnaCierreAS."').val(total".$determinanteDeColumnaCierreAS.");
                   }
               });
           });</script>";

     echo "<script> var total".$determinanteDeColumnaCierreAS."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaCierreAS."').click(function()
            {  
              var action".$determinanteDeColumnaCierreAS." = 'GetRegistroServicio".$determinanteDeColumnaCierreAS."';
              var inicio".$determinanteDeColumnaCierreAS." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaCierreAS."]').val();
              var dataString".$determinanteDeColumnaCierreAS." = 'inicio".$determinanteDeColumnaCierreAS."='+inicio".$determinanteDeColumnaCierreAS." + '&action='+action".$determinanteDeColumnaCierreAS." +
               '&ID_codigoCierre=+".$ID_codigoCierreAS."' +
               '&ID_clienteCierre='+".$ID_clienteCierreAS." +
               '&ID_buscadorCierre='+".$ID_buscadorCierreAS." ;
                 $('#cargandoBoton".$determinanteDeColumnaCierreAS."').css('display', 'block');

              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnasASById.php',
                  data: dataString".$determinanteDeColumnaCierreAS.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaCierreAS."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaCierreAS."]').val();
                    
                     if (".$determinanteDeColumnaCierreAS."Total>= ".$num_GetRegistroServicioCierreASInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaCierreAS."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaCierreAS."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaCierreAS."= (parseInt(inicio".$determinanteDeColumnaCierreAS.") + parseInt(total".$determinanteDeColumnaCierreAS."));
                     $('#Inicio".$determinanteDeColumnaCierreAS."').val(total".$determinanteDeColumnaCierreAS.");
                        $('#cargandoBoton".$determinanteDeColumnaCierreAS."').css('display', 'none');
                  
                   }
               });
           });</script>";
?>   



<!-- Inicio footer -->
<?php
require_once ('inc/footer.php');
?>
<!-- Fin footer -->





   
