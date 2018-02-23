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

  ?>  
<!--Fin Objetos-->
<!--Inicio Funciones-->
  <?php
   //Limito la busqueda 

    $GetRegistroServicioAbiertoInicial = $registro_servicio->GetRegistroServicioAbiertoInicial();
    $num_GetRegistroServicioAbiertoInicial=mysql_num_rows($GetRegistroServicioAbiertoInicial);

    $GetRegistroServicioAsignadoInicial = $registro_servicio->GetRegistroServicioAsignadoInicial();
    $num_GetRegistroServicioAsignadoInicial=mysql_num_rows($GetRegistroServicioAsignadoInicial);
      
    $GetRegistroServicioPendienteInicial = $registro_servicio->GetRegistroServicioPendienteInicial();
    $num_GetRegistroServicioPendienteInicial=mysql_num_rows($GetRegistroServicioPendienteInicial);

    $GetRegistroServicioRepuestoInicial = $registro_servicio->GetRegistroServicioRepuestoInicial();
    $num_GetRegistroServicioRepuestoInicial=mysql_num_rows($GetRegistroServicioRepuestoInicial);

    $GetRegistroServicioCerradoInicial = $registro_servicio->GetRegistroServicioCerradoInicial();
    $num_GetRegistroServicioCerradoInicial=mysql_num_rows($GetRegistroServicioCerradoInicial);
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







  <!--Inicio Muestra cartel de codigo cargado-->
  <?php
    if (@$_GET['codigo']) 
    {
      $codigo=$_GET['codigo'];
      $GetRegistroServicioByIdser=$registro_servicio->GetRegistroServicioByIdserB($codigo);
                $assoc_GetRegistroServicioByIdser=mysql_fetch_assoc($GetRegistroServicioByIdser);
                 echo '<div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h3><strong>Codigo de Servicio Nº : </strong> '.$assoc_GetRegistroServicioByIdser['ser_cod'].'
                      </h3>';
                      if ($assoc_GetRegistroServicioByIdser['obr_nproyecto']) 
                      {
                        echo '<h3><strong>Proyecto Nº : </strong> '.$assoc_GetRegistroServicioByIdser['obr_nproyecto'].'
                      </h3>';
                      }
                      if ($assoc_GetRegistroServicioByIdser['pto_pedidoCod']) 
                      {
                        echo '<h3><strong>Presupuesto Asociado: </strong> '.$assoc_GetRegistroServicioByIdser['pto_pedidoCod'].'
                      </h3>';
                      }

                      echo '</div>';
    }
  ?>
  <!--Fin Muestra cartel de codigo cargado-->


<!-- Inicio div gral -->
   <!--INICIO: BARRA DE BUSQUEDA-->
    <?php
      @$tabla                   = "  "; //Nombre de la tabla en donde el buscador debe buscar
      @$BusquedaColumnaCodigo   = "  "; //Nombre de columna en la que se debe buscar el Codigo
      @$DirectorioDelSistema    = "services"; //Nombre de la carpeta que aloja al sistema actual 
      @$UrlDeRetorno            = "dashboard-services.php"; //Url a la que se debe redireccionar luego de ejecutar la funcion
      include('../inc/barraDeBusqueda.php');  
    ?>
   <!--FIN: BARRA DE BUSQUEDA-->
<!-- Inicio div Fantasma -->
<div class="col-md-1">
</div>
<!-- Fin div Fantasma -->

 <!-- Inicio div Abierto -->
      <div class="col-md-2" id="ExpandirAbierto">
     
      <div class="col-md-12" id="cuadros">
      
      <!--Inicio Barra de herramientas de ventana-->
       <div class="col-md-12" id="barraTareas">
          <i id="cerrarColumnaAbierto" class="material-icons" data-toggle="modal" data-placement="top" title="Cerrar Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">close</i>  
          <i id="expandirAbierto" class="material-icons" data-toggle="modal" data-placement="top" title="Expandir Ventana" style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;">launch</i> 
          <i id="contraerAbierto" class="material-icons" data-toggle="modal" data-placement="top" title="Contraer Ventana" style="vertical-align: middle; float: right; display: none; font-size: 17px; margin: 5px;">view_column</i>
          <i id="minimizarAbierto" class="material-icons" data-toggle="modal" data-placement="top" title="Minimizar Ventana"  style="vertical-align: middle; float: right; font-size: 17px; margin: 5px;" >remove</i> 
       </div>   
      <hr>
      <!--Fin Barra de herramientas de ventana-->

    <h3>Abiertos (<?php echo $num_GetRegistroServicioAbiertoInicial;?>)</h3>
    <?php 
      $determinanteDeColumnaAbierto="Abierto";
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
          <div id='resultados<?php echo $determinanteDeColumnaAbierto;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
             <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaAbierto;?>" id="Inicio<?php echo $determinanteDeColumnaAbierto;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaAbierto;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
            <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaAbierto;?>' style="display: none; width: 100%; height: auto;" >
            </tr>
          </tfoot>
        </table>

      </div>
    </div>

 </div>

<!-- Fin div Abierto -->

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

    <h3>Asignados (<?php echo $num_GetRegistroServicioAsignadoInicial;?>)</h3>
       <?php 
      $determinanteDeColumnaAsignado="Asignado";
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


<!-- Inicio div Pendientes-->
      <div class="col-md-2" id="ExpandirPendiente">
     
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

    <h3>Pendientes (<?php echo $num_GetRegistroServicioPendienteInicial;?>)</h3>
  <?php 
      $determinanteDeColumnaPendiente="Pendiente";
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
          <div id='resultados<?php echo $determinanteDeColumnaPendiente;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
             <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaPendiente;?>" id="Inicio<?php echo $determinanteDeColumnaPendiente;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaPendiente;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
              <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaPendiente;?>' style="display: none; width: 100%; height: auto;" >

            </tr>
          </tfoot>
        </table>

      </div>
    </div>

 </div>


    
<!-- Fin div Pendientes -->

<!-- Inicio div Repuestos -->
      <div class="col-md-2" id="ExpandirRepuesto">
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

    <h3>Esperando Repuestos (<?php echo $num_GetRegistroServicioRepuestoInicial;?>)</h3>

     <?php 
      $determinanteDeColumnaRepuesto="Repuesto";
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
          <div id='resultados<?php echo $determinanteDeColumnaRepuesto;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
             <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaRepuesto;?>" id="Inicio<?php echo $determinanteDeColumnaRepuesto;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaRepuesto;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
              <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaRepuesto;?>' style="display: none; width: 100%; height: auto;" >

            </tr>
          </tfoot>
        </table>

      </div>
    </div>

 </div>
<!-- Fin div Pendientes -->


    <!-- Inicio div Cerrados-->
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

    <h3>Cerrados (<?php echo $num_GetRegistroServicioCerradoInicial;?>)</h3>

      <?php 
        $determinanteDeColumnaCerrado="Cerrado";
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
          <div id='resultados<?php echo $determinanteDeColumnaCerrado;?>' class='resultados'></div>
        </tbody>
          <tfoot>
            <tr>
             <input hidden type="text" name="InicioGetRegistroServicio<?php echo $determinanteDeColumnaCerrado;?>" id="Inicio<?php echo $determinanteDeColumnaCerrado;?>" value="10">
            <button class="btn btn-primary" id="MasGetRegistroServicio<?php echo $determinanteDeColumnaCerrado;?>" style="margin-top: 2%; width: 100%;"><i class="material-icons">add</i> Ver Mas</button>
              <img src=images/cargando4.gif id='cargandoBoton<?php echo $determinanteDeColumnaCerrado;?>' style="display: none; width: 100%; height: auto;" >
            </tr>
          </tfoot>
        </table>

      </div>
    </div>

 </div>
<!-- Fin div Cerrados-->

<!-- Inicio div Fantasma -->
<div class="col-md-1">
</div>
<!-- Fin div Fantasma -->

</div>
 
<div class="tab-pane fade" id="Historial">   
  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-2" style="background-color: #fff;">
           <div class="col-md-12" style="margin-top: 15px;">
         <h5 style="margin: 5px;"><strong>BUSCAR POR CODIGO:</strong></h5>
         
         <input type="text" name="codigoBuscador" class="form-control" id="codigoBuscador"></input> 
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
                $getRegistroServiciosHistorialNEClientes = $registro_servicio->getRegistroServiciosHistorialNEClientes();
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
                <option disabled>SELECCIONE UN CLIENTE PARA VER SUS TIENDAS</option>
             </select> 
          </div>
              <script language="javascript">
                $(document).ready(function(){
                   $("#filtro_cliente").change(function () {
                           $("#filtro_cliente option:selected").each(function () {
                            elegido=$(this).val();
                            $.post("registroServicio-combosDependientes.php", { elegido: elegido }, function(data){
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
                  $getRegistroServiciosHistorialEstados = $registro_servicio->getRegistroServiciosHistorialEstados();
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
                  $getRegistroServiciosHistorialPrioridad = $registro_servicio->getRegistroServiciosHistorialPrioridad();
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

           <!--INICIO DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON ASIGNADOS-->
          <div class='col-md-12'  name='formulario_Asignados' class='formulario_Asignados' id='formulario_Asignados' style="margin-top: 15px; ">
             <select class='form-control' name='filtro_Asignados' id='filtro_Asignados'>
               <option selected disabled>ASIGNADOS:</option>
                 <?php 
                  $getRegistroServiciosHistorialAsignados = $registro_servicio->getRegistroServiciosHistorialAsignados();
                  $num_getRegistroServiciosHistorialAsignados = mysql_num_rows($getRegistroServiciosHistorialAsignados);
                  for ($Asignadosi=0; $Asignadosi < $num_getRegistroServiciosHistorialAsignados; $Asignadosi++)
                   { 
                      $assoc_getRegistroServiciosHistorialAsignados = mysql_fetch_assoc($getRegistroServiciosHistorialAsignados);

                      echo "<option value='".$assoc_getRegistroServiciosHistorialAsignados['ser_asig']."'>".$assoc_getRegistroServiciosHistorialAsignados['usu_nombre']."</option>";
                   }
                   ?>
             </select> 
          </div>
          <!--FIN DIV OCULTO CON FORMULARIO QUE APARECE AL ACTIVAR EL BOTON ASIGNADOS-->

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
                        ("registroServicio-filtro.php", {
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
                        ("registroServicio-filtro.php", {
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
                        ("registroServicio-filtro.php", {ID_ser: "'.@$ID_ser.'"}, function(){
                      });});});
  </script>';
 echo '<script>
              $(document).ready(function(){
                     $("#buscar").click(function(evento){
                        evento.preventDefault();
                        var codigoBuscador      = $("#codigoBuscador").val();
                        $("#cargaexterna").load
                        ("registroServicio-filtro.php", {codigo: codigoBuscador}, function(){
                      });});});

  </script>';
?>

<!-- Fin JQuery -->

     <div class="col-md-12">
        <div class="col-md-2">
            <div id="SolapaAbierto" class="solapa">
              <h5>
                Abierto (<?php echo $num_GetRegistroServicioAbiertoInicial?>)  <i id="contraerBAbierto" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
        <div class="col-md-2">
            <div id="SolapaAsignado" class="solapa">
              <h5>
                Asignados (<?php echo $num_GetRegistroServicioAsignadoInicial?>)  <i id="contraerBAsignado" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
        <div class="col-md-2">
           <div id="SolapaPendiente" class="solapa">
              <h5>
                Pendientes (<?php echo $num_GetRegistroServicioPendientesInicial?>)  <i id="contraerBPendiente" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
          </div>
       </div>
       <div class="col-md-2">
            <div id="SolapaRepuesto" class="solapa">
              <h5>
                Repuestos (<?php echo $num_GetRegistroServicioRepuestoInicial?>)  <i id="contraerBRepuesto" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
         <div class="col-md-2">
            <div id="SolapaCierre" class="solapa">
              <h5>
                Cerrados(<?php echo $num_GetRegistroServicioCerradoInicial?>)  <i id="contraerBCierre" class="material-icons" data-toggle="modal" data-placement="top" title="Maximizar Ventana" style="vertical-align: middle;">launch</i>
              </h5>
            </div>
        </div>
    </div>



<!-- Inicio jquery controles de columnas -->
<script type="text/javascript">
   $("#expandirAbierto").click(function() {
   $("#ExpandirAbierto").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirAbierto").css("display", "none");
   $("#contraerAbierto").css("display", "block");
   $("#iconoAbierto").css("display", "none");
   });
   $("#contraerAbierto").click(function() {
   $("#ExpandirAbierto").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
   $("#expandirAbierto").css("display", "block");
   $("#contraerAbierto").css("display", "none");
   $("#iconoAbierto").css("display", "block");
   });
   $("#cerrarColumnaAbierto").click(function() {
   $("#ExpandirAbierto").hide( 1000 )});
   $("#minimizarAbierto").click(function() {
   $("#ExpandirAbierto").hide(1000);
   $("#SolapaAbierto").css("display", "block").fadeIn(100);
   });
   $("#contraerBAbierto").click(function() {
   $("#ExpandirAbierto").css("display", "block").fadeIn(100);
   $("#SolapaAbierto").css("display", "none");
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

  
   $("#expandirPendiente").click(function() {
   $("#ExpandirPendiente").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirPendiente").css("display", "none");
   $("#contraerPendiente").css("display", "block");
   $("#iconoPendiente").css("display", "none");
   });
   $("#contraerPendiente").click(function() {
   $("#ExpandirPendiente").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
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
   $("#ExpandirRepuesto").removeClass( "col-md-2 noClass" ).addClass( "col-md-12" ).show( "slow" );
   $("#expandirRepuesto").css("display", "none");
   $("#contraerRepuesto").css("display", "block");
   $("#iconoRepuesto").css("display", "none");
   });
   $("#contraerRepuesto").click(function() {
   $("#ExpandirRepuesto").removeClass( "col-md-12 noClass" ).addClass( "col-md-2" );
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
      $ID_buscadorAbierto=$_GET['ID_Buscador'];
      $ID_buscadorAsignado=$_GET['ID_Buscador'];
      $ID_buscadorPendiente=$_GET['ID_Buscador'];
      $ID_buscadorRepuesto=$_GET['ID_Buscador'];
      $ID_buscadorCerrado=$_GET['ID_Buscador'];
    }
    else
    {
      $ID_buscadorAbierto=0;
      $ID_buscadorAsignado=0;
      $ID_buscadorPendiente=0;
      $ID_buscadorRepuesto=0;
      $ID_buscadorCerrado=0;
    }  
    if (@$_GET['codigo']) 
    {
      $ID_codigoAbierto=$_GET['codigo'];
      $ID_codigoAsignado=$_GET['codigo'];
      $ID_codigoPendiente=$_GET['codigo'];
      $ID_codigoRepuesto=$_GET['codigo'];
      $ID_codigoCerrado=$_GET['codigo'];
    }
    else
     {
      $ID_codigoAbierto=0;
      $ID_codigoAsignado=0;
      $ID_codigoPendiente=0;
      $ID_codigoRepuesto=0;
      $ID_codigoCerrado=0;
     }  
      if (@$_GET['ID_cli'])
    {
          if ($_GET['ID_cli']!='0' or $_GET['ID_cli']!=0) 
          { 
            $ID_clienteAbierto=$_GET['ID_cli'];
            $ID_clienteAsignado=$_GET['ID_cli'];
            $ID_clientePendiente=$_GET['ID_cli'];
            $ID_clienteRepuesto=$_GET['ID_cli'];
            $ID_clienteCerrado=$_GET['ID_cli'];
          }
     }
    
    else
    {
      $ID_clienteAbierto=0;
      $ID_clienteAsignado=0;
      $ID_clientePendiente=0;
      $ID_clienteRepuesto=0;
      $ID_clienteCerrado=0;
    }  
  
         echo "<script> var total".$determinanteDeColumnaAbierto."=10; $(document).ready(function()
            {  
              var action".$determinanteDeColumnaAbierto." = 'GetRegistroServicio".$determinanteDeColumnaAbierto."';
              var inicio".$determinanteDeColumnaAbierto." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAbierto."]').val();
              var dataString".$determinanteDeColumnaAbierto." = 'inicio".$determinanteDeColumnaAbierto."='+inicio".$determinanteDeColumnaAbierto." + '&action='+action".$determinanteDeColumnaAbierto." +
               '&ID_codigoAbierto=+".$ID_codigoAbierto."' +
                '&ID_clienteAbierto=+".$ID_clienteAbierto."' +
               '&ID_buscadorAbierto='+".$ID_buscadorAbierto." ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
                  data: dataString".$determinanteDeColumnaAbierto.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaAbierto."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAbierto."]').val();
                    
                     if (".$determinanteDeColumnaAbierto."Total>= ".$num_GetRegistroServicioAbiertoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaAbierto."').toggle('slow');
                     }

                     $('#resultados".$determinanteDeColumnaAbierto."').toggle('slow').delay(200).toggle('slow').html(data);
                      total".$determinanteDeColumnaAbierto."= (parseInt(inicio".$determinanteDeColumnaAbierto.") + parseInt(total".$determinanteDeColumnaAbierto."));
                     $('#Inicio".$determinanteDeColumnaAbierto."').val(total".$determinanteDeColumnaAbierto.");

                 
                   }
               });
           });</script>";

     echo "<script> var total".$determinanteDeColumnaAbierto."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaAbierto."').click(function()
            {  

              var action".$determinanteDeColumnaAbierto." = 'GetRegistroServicio".$determinanteDeColumnaAbierto."';
              var inicio".$determinanteDeColumnaAbierto." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAbierto."]').val();
              var dataString".$determinanteDeColumnaAbierto." = 'inicio".$determinanteDeColumnaAbierto."='+inicio".$determinanteDeColumnaAbierto." + '&action='+action".$determinanteDeColumnaAbierto." +
               '&ID_codigoAbierto=+".$ID_codigoAbierto."' +
                '&ID_clienteAbierto=+".$ID_clienteAbierto."' +
               '&ID_buscadorAbierto='+".$ID_buscadorAbierto." ;
                 $('#cargandoBoton".$determinanteDeColumnaAbierto."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
                  data: dataString".$determinanteDeColumnaAbierto.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaAbierto."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAbierto."]').val();
                    
                     if (".$determinanteDeColumnaAbierto."Total>= ".$num_GetRegistroServicioAbiertoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaAbierto."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaAbierto."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaAbierto."= (parseInt(inicio".$determinanteDeColumnaAbierto.") + parseInt(total".$determinanteDeColumnaAbierto."));
                     $('#Inicio".$determinanteDeColumnaAbierto."').val(total".$determinanteDeColumnaAbierto.");
                        $('#cargandoBoton".$determinanteDeColumnaAbierto."').css('display', 'none');
                  
                   }
               });
           });</script>";


             echo "<script> var total".$determinanteDeColumnaAsignado."=10; $(document).ready(function()
            {  
              var action = 'GetRegistroServicio".$determinanteDeColumnaAsignado."';
              var inicio".$determinanteDeColumnaAsignado." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAsignado."]').val();
              var dataString".$determinanteDeColumnaAsignado." = 'inicio".$determinanteDeColumnaAsignado."='+inicio".$determinanteDeColumnaAsignado." + '&action='+action +
               '&ID_codigoAsignado=+".$ID_codigoAsignado."' +
                '&ID_clienteAsignado=+".$ID_clienteAsignado."' +
               '&ID_buscadorAsignado='+".$ID_buscadorAsignado." ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
                  data: dataString".$determinanteDeColumnaAsignado.",
                  success: function(data)
                   {
                      var ".$determinanteDeColumnaAsignado."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAsignado."]').val();
                    
                     if (".$determinanteDeColumnaAsignado."Total>= ".$num_GetRegistroServicioAsignadoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaAsignado."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaAsignado."').toggle('slow').delay(400).toggle('slow').html(data);
                      total".$determinanteDeColumnaAsignado."= (parseInt(inicio".$determinanteDeColumnaAsignado.") + parseInt(total".$determinanteDeColumnaAsignado."));
                     $('#Inicio".$determinanteDeColumnaAsignado."').val(total".$determinanteDeColumnaAsignado.");
                   }
               });
           });</script>";


             echo "<script> var total".$determinanteDeColumnaAsignado."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaAsignado."').click(function()
            {  

              var action = 'GetRegistroServicio".$determinanteDeColumnaAsignado."';
              var inicio".$determinanteDeColumnaAsignado." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaAsignado."]').val();
              var dataString".$determinanteDeColumnaAsignado." = 'inicio".$determinanteDeColumnaAsignado."='+inicio".$determinanteDeColumnaAsignado." + '&action='+action +
               '&ID_codigoAsignado=+".$ID_codigoAsignado."' +
                '&ID_clienteAsignado=+".$ID_clienteAsignado."' +
               '&ID_buscadorAsignado='+".$ID_buscadorAsignado." ;
                 $('#cargandoBoton".$determinanteDeColumnaAsignado."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
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

             echo "<script> var total".$determinanteDeColumnaPendiente."=10; $(document).ready(function()
            {  
              var action = 'GetRegistroServicio".$determinanteDeColumnaPendiente."';
              var inicio".$determinanteDeColumnaPendiente." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaPendiente."]').val();

              var dataString".$determinanteDeColumnaPendiente." = 'inicio".$determinanteDeColumnaPendiente."='+inicio".$determinanteDeColumnaPendiente." + '&action='+action +
               '&ID_codigoPendiente=+".$ID_codigoPendiente."' +
                '&ID_clientePendiente=+".$ID_clientePendiente."' +
               '&ID_buscadorPendiente='+".$ID_buscadorPendiente.";
                
                  $.ajax(
                  {
                      type: 'POST',
                      url:  'ResultadosDeColumnas.php',
                      data: dataString".$determinanteDeColumnaPendiente.",
                      success: function(data)
                       {
                          var ".$determinanteDeColumnaPendiente."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaPendiente."]').val();
                        
                         if (".$determinanteDeColumnaPendiente."Total>=".$num_GetRegistroServicioPendienteInicial.")
                         {
                           $('#MasGetRegistroServicio".$determinanteDeColumnaPendiente."').toggle('slow');
                         }
                         $('#resultados".$determinanteDeColumnaPendiente."').toggle('slow').delay(600).toggle('slow').html(data);
                          total".$determinanteDeColumnaPendiente."= (parseInt(inicio".$determinanteDeColumnaPendiente.") + parseInt(total".$determinanteDeColumnaPendiente."));
                         $('#Inicio".$determinanteDeColumnaPendiente."').val(total".$determinanteDeColumnaPendiente.");
                        } 
                   });
              });</script>";

         echo "<script> var total".$determinanteDeColumnaPendiente."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaPendiente."').click(function()
            {  

              var action = 'GetRegistroServicio".$determinanteDeColumnaPendiente."';
              var inicio".$determinanteDeColumnaPendiente." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaPendiente."]').val();
              var dataString".$determinanteDeColumnaPendiente." = 'inicio".$determinanteDeColumnaPendiente."='+inicio".$determinanteDeColumnaPendiente." + '&action='+action  +
               '&ID_codigoPendiente=+".$ID_codigoPendiente."' +
               '&ID_clientePendiente=+".$ID_clientePendiente."' +
               '&ID_buscadorPendiente='+".$ID_buscadorPendiente." ;
              $('#cargandoBoton".$determinanteDeColumnaPendiente."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
                  data: dataString".$determinanteDeColumnaPendiente.",
                  success: function(data)
                   {
                    var ".$determinanteDeColumnaPendiente."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaPendiente."]').val();
                    
                     if (".$determinanteDeColumnaPendiente."Total>= ".$num_GetRegistroServicioPendienteInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaPendiente."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaPendiente."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaPendiente."= (parseInt(inicio".$determinanteDeColumnaPendiente.") + parseInt(total".$determinanteDeColumnaPendiente."));
                     $('#Inicio".$determinanteDeColumnaPendiente."').val(total".$determinanteDeColumnaPendiente.");
                     $('#cargandoBoton".$determinanteDeColumnaPendiente."').css('display', 'none');
                   }
               });
           });</script>";

        
          
             echo "<script> var total".$determinanteDeColumnaRepuesto."=10; $(document).ready(function()
            {  
              var action = 'GetRegistroServicio".$determinanteDeColumnaRepuesto."';
              var inicio".$determinanteDeColumnaRepuesto." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaRepuesto."]').val();
              var dataString".$determinanteDeColumnaRepuesto." = 'inicio".$determinanteDeColumnaRepuesto."='+inicio".$determinanteDeColumnaRepuesto." + '&action='+action +
               '&ID_codigoRepuesto=+".$ID_codigoRepuesto."' +
               '&ID_clienteRepuesto=+".$ID_clienteRepuesto."' +
               '&ID_buscadorRepuesto='+".$ID_buscadorRepuesto." ;

              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
                  data: dataString".$determinanteDeColumnaRepuesto.",
                  success: function(data)
                   {
                    var ".$determinanteDeColumnaRepuesto."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaRepuesto."]').val();
                    
                     if (".$determinanteDeColumnaRepuesto."Total>= ".$num_GetRegistroServicioRepuestoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaRepuesto."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaRepuesto."').toggle('slow').delay(800).toggle('slow').html(data);
                      total".$determinanteDeColumnaRepuesto."= (parseInt(inicio".$determinanteDeColumnaRepuesto.") + parseInt(total".$determinanteDeColumnaRepuesto."));
                     $('#Inicio".$determinanteDeColumnaRepuesto."').val(total".$determinanteDeColumnaRepuesto.");
                   }
               });
           });</script>";


             echo "<script> var total".$determinanteDeColumnaRepuesto."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaRepuesto."').click(function()
            {  
              var action = 'GetRegistroServicio".$determinanteDeColumnaRepuesto."';
              var inicio".$determinanteDeColumnaRepuesto." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaRepuesto."]').val();
              var dataString".$determinanteDeColumnaRepuesto." = 'inicio".$determinanteDeColumnaRepuesto."='+inicio".$determinanteDeColumnaRepuesto." + '&action='+action +
               '&ID_codigoRepuesto=+".$ID_codigoRepuesto."' +
                '&ID_clienteRepuesto=+".$ID_clienteRepuesto."' +
               '&ID_buscadorRepuesto='+".$ID_buscadorRepuesto." ;
                $('#cargandoBoton".$determinanteDeColumnaRepuesto."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
                  data: dataString".$determinanteDeColumnaRepuesto.",
                  success: function(data)
                   {
                     var ".$determinanteDeColumnaRepuesto."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaRepuesto."]').val();
                    
                     if (".$determinanteDeColumnaRepuesto."Total>= ".$num_GetRegistroServicioRepuestoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaRepuesto."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaRepuesto."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaRepuesto."= (parseInt(inicio".$determinanteDeColumnaRepuesto.") + parseInt(total".$determinanteDeColumnaRepuesto."));
                     $('#Inicio".$determinanteDeColumnaRepuesto."').val(total".$determinanteDeColumnaRepuesto.");
                       $('#cargandoBoton".$determinanteDeColumnaRepuesto."').css('display', 'none');
                   }
               });
           });</script>";

            echo "<script> var total".$determinanteDeColumnaCerrado."=10; $(document).ready(function()
            {  

              var action = 'GetRegistroServicio".$determinanteDeColumnaCerrado."';
              var inicio".$determinanteDeColumnaCerrado." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaCerrado."]').val();
              var dataString".$determinanteDeColumnaCerrado." = 'inicio".$determinanteDeColumnaCerrado."='+inicio".$determinanteDeColumnaCerrado." + '&action='+action +
               '&ID_codigoCerrado=+".$ID_codigoCerrado."' +
                '&ID_clienteCerrado=+".$ID_clienteCerrado."' +
               '&ID_buscadorCerrado='+".$ID_buscadorCerrado." ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
                  data: dataString".$determinanteDeColumnaCerrado.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaCerrado."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaCerrado."]').val();
                    
                     if (".$determinanteDeColumnaCerrado."Total>= ".$num_GetRegistroServicioCerradoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaCerrado."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaCerrado."').toggle('slow').delay(800).toggle('slow').html(data);
                      total".$determinanteDeColumnaCerrado."= (parseInt(inicio".$determinanteDeColumnaCerrado.") + parseInt(total".$determinanteDeColumnaCerrado."));
                     $('#Inicio".$determinanteDeColumnaCerrado."').val(total".$determinanteDeColumnaCerrado.");

                  
                   }
               });
           });</script>";

         echo "<script> var total".$determinanteDeColumnaCerrado."=10; $('#MasGetRegistroServicio".$determinanteDeColumnaCerrado."').click(function()
            {  

              var action = 'GetRegistroServicio".$determinanteDeColumnaCerrado."';
              var inicio".$determinanteDeColumnaCerrado." = $('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaCerrado."]').val();
              var dataString".$determinanteDeColumnaCerrado." = 'inicio".$determinanteDeColumnaCerrado."='+inicio".$determinanteDeColumnaCerrado." + '&action='+action +
               '&ID_codigoRepuesto=+".$ID_codigoCerrado."' +
                '&ID_clienteCerrado=+".$ID_clienteCerrado."' +
               '&ID_buscadorRepuesto='+".$ID_buscadorCerrado." ;
               $('#cargandoBoton".$determinanteDeColumnaCerrado."').css('display', 'block');
              $.ajax(
              {
                  type: 'POST',
                  url: 'ResultadosDeColumnas.php',
                  data: dataString".$determinanteDeColumnaCerrado.",
                  success: function(data)
                   {
                       var ".$determinanteDeColumnaCerrado."Total=$('input:text[name=InicioGetRegistroServicio".$determinanteDeColumnaCerrado."]').val();
                    
                     if (".$determinanteDeColumnaCerrado."Total>= ".$num_GetRegistroServicioCerradoInicial.")
                     {
                       $('#MasGetRegistroServicio".$determinanteDeColumnaCerrado."').toggle('slow');
                     }
                     $('#resultados".$determinanteDeColumnaCerrado."').fadeIn(1000).html(data);
                      total".$determinanteDeColumnaCerrado."= (parseInt(inicio".$determinanteDeColumnaCerrado.") + parseInt(total".$determinanteDeColumnaCerrado."));
                     $('#Inicio".$determinanteDeColumnaCerrado."').val(total".$determinanteDeColumnaCerrado.");
                     $('#cargandoBoton".$determinanteDeColumnaCerrado."').css('display', 'none');
                   }
               });
           });</script>";

         
    ?>


<!-- Inicio footer -->
<?php
require_once ('inc/footer.php');
?>
<!-- Fin footer -->