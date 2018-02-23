<!--
REFERENCIA:
* Head.
* motor de herramientas de texto
* Buscador Cliente / Tienda
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
   @$ID_pto             =  round(12*((base64_decode($_GET['ID_pto']))/12344));  
    $ID_emp			      = $_SESSION['ID_emp'];
	  $_SESSION['1-new-quotation-ne']  = $_SERVER['REQUEST_URI'];
    $_SESSION['actionsBack']         = $_SERVER['REQUEST_URI'];
    $_SESSION['adjuntos']           = $_SERVER['REQUEST_URI'];
    
  ?>
<!--Fin Head-->







<!--Inicio Objetos-->
  <?php
   $tipo_presupuesto  = new tipo_presupuesto;
   $usuarios          = new usuarios;
   $prioridades       = new prioridades;
   $adjuntos          = new adjuntos;
   $quotations        = new quotations;
   $registro_servicio = new registro_servicio;
   $tasks             = new tasks;
  ?>  
<!--Fin Objetos-->

<!--Inicio Funciones-->
  <?php
    $tpp_udn="After Sales";
    $getTipoPresupuestoByTppUdn     = $tipo_presupuesto->getTipoPresupuestoByTppUdn($tpp_udn);
    $num_getTipoPresupuestoByTppUdn = mysql_num_rows($getTipoPresupuestoByTppUdn);

    $ID_tpu="11";
    $getUsuariosByIdTpu = $usuarios->getUsuariosByIdTpu($ID_tpu);
    $num_getUsuariosByIdTpu = mysql_num_rows($getUsuariosByIdTpu);

    $getPrioridades = $prioridades->getPrioridades();
    $num_getPrioridades = mysql_num_rows($getPrioridades);

    $getQuotations = $quotations->getQuotationsModifyAS($ID_pto);
    $assoc_getQuotations = mysql_fetch_assoc($getQuotations);

  

     
  
    


  ?>
<!--Fin Funciones-->

<!--Inicio: Alertas -->
<?php
  if(isset($_GET['m']))
  {
    $ID_ale = $_GET['m'];
    $especiales = new especiales();
    $getAlerta  = $especiales->getAlerta($ID_ale);
    $assoc_getAlerta = mysql_fetch_assoc($getAlerta);
    echo  $assoc_getAlerta['ale_desc'];
  }
?>
<!--Fin: Alertas-->



<!--Inicio Script de loading general-->
  <script type="text/javascript">
    $(window).load(function () {
      $('#cargando').hide();
    });

    </script>
    <div id="cargando">

    </div>
<!--Fin Script de loading general-->

<!-- Inicio Buscador Cliente / Tienda -->

<?php
    //No Modificar estas variables 
    @$id             =  round(12*((base64_decode($_GET['ID_obr']))/12344));  // ID_obr
    @$ID_obr         =  $id;        
    @$obr_desc       =  $_GET['dato'];  // obr_desc
    @$cli_marker     =  $_GET['logo'];  // cli_marker
    @$idB            =  round(12*((base64_decode($_GET['idB']))/12344));  // ID_obr
    @$ID_cli         =  $idB; 
    @$cli_desc       =  $_GET['datoB'];  // obr_desc
    if (isset($_GET['ID_obr']))
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

<!-- Inicio div gral -->

	<?php 

 
          echo '<div class="col-md-11" style="background-color:#fff; border: 4px solid #333; -webkit-border-radius: 15px; -moz-border-radius: 15px; text-align: center; margin: 3%;">';
                echo "<h3 style='text-align: left;'><i class='material-icons' style='vertical-align: middle'> library_books</i> Datos del Pedido</h3>";
     //ADJUNTO

                    echo '<div class="form-group" style="margin: 3%;">';
                                                               //busca tarea para buscar adjuntos
                                $getQuotationsByIdPto=$quotations->getQuotationsByIdPto($ID_pto);
                                $assoc_getQuotationsByIdPto=mysql_fetch_assoc($getQuotationsByIdPto);
                                if ($assoc_getQuotationsByIdPto['ser_cod']) 
                                {
                                      $ser_cod=$assoc_getQuotationsByIdPto['ser_cod'];
                                      $GetRegistroServicioBySerCod=$registro_servicio->GetRegistroServicioBySerCod($ser_cod);
                                      $assoc_GetRegistroServicioBySerCod=mysql_fetch_assoc($GetRegistroServicioBySerCod);
                                      $ID_ser=$assoc_GetRegistroServicioBySerCod['ID_ser'];
                                      $getTasksByIdSer=$tasks->getTasksByIdSerRepuesto($ID_ser);
                                   
                                        $assoc_getTasksByIdSer=mysql_fetch_assoc($getTasksByIdSer);

                                                           // Inicio adjuntos -->
                                                                  $adj_idRelacionSERVICES       = $assoc_getTasksByIdSer['ID_tas'];
                                                                  $adj_tablaRelacionSERVICES    = "tasks";
                                                                  include('inc/adjuntosBackOfficesServices.php');
                                                             // Fin adjuntos -->
                                      
                                }
                     echo '</div>';
                    echo '<div class="form-group" style="margin: 3%;">';
                                          $adj_idRelacion       = $assoc_getQuotations['ID_pto'];
                                      $adj_tablaRelacion    = "quotations";
                                      $opcionAgregar        = "si";
                                      include('inc/adjuntos.php');
                                      $getAdjuntosByAdjIdRelacion=$adjuntos->getAdjuntosByAdjIdRelacion($adj_idRelacion, $adj_tablaRelacion);
    $num_getAdjuntosByAdjIdRelacion=mysql_num_rows($getAdjuntosByAdjIdRelacion);
                    echo '</div>';

             echo '<form class="form-inline" action="actions-quotation-as.php" class="form-horizontal" method="post" enctype="multipart/form-data">';
              
                    //TIPO DE PEDIDO
                    echo '<div class="form-group" style="margin: 3%;">';
                    echo '<label for="exampleInputEmail1">Tipo de Pedido</label>';
                    echo '<select class="form-control" name="ID_tpp" >';
                    echo '<option value="'.$assoc_getQuotations['ID_tpp'].'" selected>'.$assoc_getQuotations['tpp_desc'].'</option>';
                    for ($a=0; $a < $num_getTipoPresupuestoByTppUdn; $a++)
                     { 
                        $assoc_getTipoPresupuestoByTppUdn=mysql_fetch_assoc($getTipoPresupuestoByTppUdn);
                           echo '<option value="'.$assoc_getTipoPresupuestoByTppUdn['ID_tpp'].'">'.$assoc_getTipoPresupuestoByTppUdn['tpp_desc'].'</option>';
                     }
                    echo '<select>';
                    echo '</div>';

                    //CONTACTO
                    echo '<div class="form-group" style="margin: 3%;">';
                     echo '<label for="exampleInputEmail1">Contacto</label>';
                    echo '<input type="text" class="form-control" name="pto_contacto" placeholder="Contacto" value="'.$assoc_getQuotations['pto_contacto'].'" ></input>';
                    echo '</div>';

                    //TELEFONO
                    echo '<div class="form-group" style="margin: 3%;">';
                     echo '<label for="exampleInputEmail1">Telefono</label>';
                    echo '<input type="tel" class="form-control" name="pto_telefono" placeholder="Telefono"  value="'.$assoc_getQuotations['pto_telefono'].'"></input>';
                    echo '</div>';

                    //Inicio: separa cadena de mail para poder enviar a todas las direcciones
                    $CadenaMail=explode(",",$assoc_getQuotations['pto_mail']);
                    //Fin: separa cadena de mail para poder enviar a todas las direcciones    

                    //EMAIL
                    echo '<div class="form-group" style="margin: 3%;">';
                    echo '<label for="exampleInputEmail1">Email</label>';
                    echo '<input type="email" class="form-control" name="pto_mail" placeholder="Email"  value="'.$CadenaMail[0].'"></input>';
                     echo '<i  id="agregar" class="material-icons" style="vertical-align: middle; color:#0a0; cursor:pointer">add</i>';
                    echo '</div>';

                    if (@$CadenaMail[1]!="")
                     {
                     $none1 = "block";
                     echo "<script>$('#agregar').fadeOut('slow');</script>";
                     }
                    else
                     {
                     $none1 = "none";
                     } 
                     if (@$CadenaMail[2]!="")
                     {
                     $none2 = "block";
                     }
                    else
                     {
                     $none2 = "none";
                     } 
                    if (@$CadenaMail[3]!="")
                     {
                     $none3 = "block";
                     }
                    else
                     {
                     $none3 = "none";
                     } 
                     if (@$CadenaMail[4]!="")
                     {
                     $none4 = "block";
                     }
                    else
                     {
                     $none4 = "none";
                     } 
                    if (@$CadenaMail[5]!="")
                     {
                     $none5 = "block";
                     }
                    else
                     {
                     $none5 = "none";
                     }                      

                       //EMAIL
                    echo '<div class="form-group" style="margin: 3%; display: '.$none1.';" id="email1">';
                     echo '<label for="exampleInputEmail1">Email</label>';
                      echo '<input id="input1" type="email" class="form-control" name="pto_mail1" placeholder="Email" value="'.@$CadenaMail[1].'"></input>';
                        echo '<i  id="agregar1" class="material-icons" style="vertical-align: middle; color:#0a0; cursor:pointer">add</i>';
                         echo '<i id="remover1" class="material-icons" style="vertical-align: middle; color:#a00; cursor:pointer">remove</i>';
                      echo '</div>';

                         //EMAIL
                    echo '<div class="form-group" style="margin: 3%; display: '.$none2.';" id="email2">';
                     echo '<label for="exampleInputEmail1">Email</label>';
                      echo '<input id="input2" type="email" class="form-control" name="pto_mail2" placeholder="Email" value="'.@$CadenaMail[2].'"></input>';
                       echo '<i  id="agregar2" class="material-icons" style="vertical-align: middle; color:#0a0; cursor:pointer">add</i>';
                        echo '<i  id="remover2" class="material-icons" style="vertical-align: middle; color:#a00; cursor:pointer">remove</i>';
                      echo '</div>';

                         //EMAIL
                    echo '<div class="form-group" style="margin: 3%; display: '.$none3.';" id="email3">';
                     echo '<label for="exampleInputEmail1">Email</label>';
                      echo '<input id="input3" type="email" class="form-control" name="pto_mail3" placeholder="Email" value="'.@$CadenaMail[3].'"></input>';
                      echo '<i  id="agregar3" class="material-icons" style="vertical-align: middle; color:#0a0; cursor:pointer">add</i>';
                       echo '<i  id="remover3" class="material-icons" style="vertical-align: middle; color:#a00; cursor:pointer">remove</i>';
                      echo '</div>';

                         //EMAIL
                    echo '<div class="form-group" style="margin: 3%; display: '.$none4.';" id="email4">';
                     echo '<label for="exampleInputEmail1">Email</label>';
                      echo '<input id="input4" type="email" class="form-control" name="pto_mail4" placeholder="Email" value="'.@$CadenaMail[4].'"></input>';
                       echo '<i  id="agregar4" class="material-icons" style="vertical-align: middle; color:#0a0; cursor:pointer">add</i>';
                        echo '<i  id="remover4" class="material-icons" style="vertical-align: middle; color:#a00; cursor:pointer">remove</i>';
                      echo '</div>';

                         //EMAIL
                    echo '<div  class="form-group" style="margin: 3%; display: '.$none5.';" id="email5">';
                     echo '<label for="exampleInputEmail1">Email</label>';
                      echo '<input id="input5" type="email" class="form-control" name="pto_mail5" placeholder="Email" value="'.@$CadenaMail[5].'"></input>';
                          echo '<i  id="remover5" class="material-icons" style="vertical-align: middle; color:#a00; cursor:pointer">remove</i>';
                      echo '</div>';


                    //RESPONSABLE 
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
                    //PRIORIDAD
                    echo '<div class="form-group" style="margin: 3%;">';
                    echo '<label for="exampleInputEmail1">Prioridades</label>';
                    echo '<select class="form-control" name="ID_pri">';
                   echo '<option value="'.$assoc_getQuotations['ID_pri'].'" selected>'.$assoc_getQuotations['pri_desc'].'</option>';
                    for ($c=0; $c < $num_getPrioridades; $c++)
                     { 
                      $assoc_getPrioridades = mysql_fetch_assoc($getPrioridades);
                           echo '<option value="'.$assoc_getPrioridades['ID_pri'].'">'.$assoc_getPrioridades['pri_desc'].'</option>';
                     }
                    echo '<select>';
                    echo '</div>';

               
                    //DESCRIPCION
                    echo '<div class="form-group" style="margin: 3%;">';
                      echo '<label for="exampleInputEmail1">Descripcion del Pedido</label>';
                      echo '<textarea class="form-control" name="pto_desc" placeholder="Descripcion del Pedido">'.$assoc_getQuotations['pto_desc'].'</textarea>';
                    echo '</div>';

                    //VARIABLES OCULTAS : ACTION, CLIENTE, TIENDA
                     echo '<input type="hidden" name="actionAS" value="modifQuotationAS">';
                     echo '<input type="hidden" name="ID_pto" value="'.$assoc_getQuotations['ID_pto'].'">';
                    echo '<input type="hidden" name="pto_pedidoCod" value="'.$assoc_getQuotations['pto_pedidoCod'].'">';
                    echo '<input type="hidden" name="ID_obr" value="'.$assoc_getQuotations['ID_obr'].'">';
                     echo '<button type="submit" class="btn btn-success" style="width: 100%; margin-bottom: 2%;"><i class="material-icons" style="vertical-align: middle">save</i> Guardar</button>';

                echo '</div>';
             echo '</form>';
          echo '</div>'; 
    ?>

<!-- Inicio footer -->
<?php
require_once ('inc/footer.php');
?>
<!-- Fin footer -->

<!--Inicio: Agregar y remover campo Email-->
<script>
  $("#agregar").click(function(){           //Al hacer click en + 
    $("#email1").fadeIn( "slow" );         //Aparace el siguiente input de email 
    $("#agregar").fadeOut( "slow" );      //Desaparece el boton +
  });

    $("#agregar1").click(function(){        //Al hacer click en + del segundo input email
    $("#email2").fadeIn( "slow" );         //Aparace el siguiente input de email 
    $("#agregar1").fadeOut( "slow" );     //Desaparece el boton + 
    $("#remover1").fadeOut( "slow" );    //Desaparece el boton -
  });

      $("#agregar2").click(function(){     
    $("#email3").fadeIn( "slow" );         
    $("#agregar2").fadeOut( "slow" );
     $("#remover2").fadeOut( "slow" );
  });

        $("#agregar3").click(function(){
    $("#email4").fadeIn( "slow" );
    $("#agregar3").fadeOut( "slow" );
     $("#remover3").fadeOut( "slow" );
  });

    $("#agregar4").click(function(){
    $("#email5").fadeIn( "slow" );
    $("#agregar4").fadeOut( "slow" );
     $("#remover4").fadeOut( "slow" );
});

      $("#remover1").click(function(){      //Al hacer click en - del segundo input email
    $("#email1").fadeOut( "slow" );        //Desaparece el ultimo input de email mostrado
     $("#agregar").fadeIn( "slow" );      //Aparece el boton + en el input email anterior
     $('#input1').val("");               //Se borra el contenido del input ocultado
    
  });

     $("#remover2").click(function(){
      $("#email2").fadeOut( "slow" );
       $("#agregar1").fadeIn( "slow" );
        $("#remover1").fadeIn( "slow" );
         $('#input2').val("");
  });

   $("#remover3").click(function(){
      $("#email3").fadeOut( "slow" );
       $("#agregar2").fadeIn( "slow" );
         $("#remover2").fadeIn( "slow" );
           $('#input3').val("");
  });

   $("#remover4").click(function(){
    $("#email4").fadeOut( "slow" );
     $("#agregar3").fadeIn( "slow" );
       $("#remover3").fadeIn( "slow" );
         $('#input4').val("");
  });

 $("#remover5").click(function(){
    $("#email5").fadeOut( "slow" );
      $("#agregar4").fadeIn( "slow" );
       $("#remover4").fadeIn( "slow" );
         $('#input5').val("");
  });


</script>
<!--Fin: Agregar y remover campo Email-->