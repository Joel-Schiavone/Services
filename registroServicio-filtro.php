
<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');

@$ID_ser= $_POST["ID_ser"];
@$buscar= $_POST["buscar"];
@$codigo= $_POST["codigo"];
if (@$codigo) 
{
        $sql = "SELECT * FROM registro_servicio, obras, usuarios WHERE  obras.ID_obr=registro_servicio.ID_obr AND usuarios.ID_usu=registro_servicio.ID_usu AND ser_cod='".$codigo."' ORDER BY registro_servicio.ID_ser DESC";
        $result = mysql_query($sql);
        $num_result = mysql_num_rows($result);
        $clientes= new clientes;
        $tiendas = new tiendas;
        $status= new status;
        $prioridades = new prioridades;
        $usuarios = new usuarios;
}
else  
{
if (@$_POST["ID_cli"]!="vacio")
{
	 $filtro_cliente = " "."registro_servicio.".@$_POST["ID_cli"];
   $contA=1;
	 $filtro_clienteLista = "1";
}
else
{
    $filtro_cliente = "";
    $contA=0;
    $filtro_clienteLista = "";
}
if (@$_POST["ID_obr"]!="vacio" && $_POST["ID_obr"]!="ID_obr=vacio" )
{
   $filtro_tienda = " "."registro_servicio.".@$_POST["ID_obr"];
   $contB=1;
   $filtro_tiendaLista = "1"; 
}
else
{
    $filtro_tienda = "";
    $contB=0;
    $filtro_tiendaLista = "";
}
if (@$_POST['ID_sta']!="vacio")
{
  $filtro_estado = " ".@$_POST["ID_sta"];
  $contC=1;     
  $filtro_estadoLista = "1";
}
else
{
  $filtro_estado = "";
  $contC=0;
  $filtro_estadoLista = "";
}
if (@$_POST["ID_pri"]!="vacio")
{
   $filtro_prioridad = @$_POST["ID_pri"];
   $contD=1;
   $filtro_prioridadLista = "1";
}
else
{
    $filtro_prioridad = "";
    $contD=0;
    $filtro_prioridadLista = "";
}
if (@$_POST["ser_asig"]!="vacio")
{
   $filtro_asignado = @$_POST["ser_asig"];
   $contE=1;
   $filtro_asignadoLista= "1";
}
else
{
    $filtro_asignado = "";
    $contE=0;
    $filtro_asignadoLista= "";
}

  if($contA==1)
  {
    if($contB==1 or $contC==1 or $contD==1 or $contE==1)
    {
      $filtro_cliente = $filtro_cliente . " AND";
      $filtro_clienteLista = "2";
    }
  }

    if($contB==1)
  {
    if($contC==1 or $contD==1 or $contE==1)
    {
      $filtro_tienda = $filtro_tienda . " AND";
      $filtro_tiendaLista = "2";
    }
  }

  if($contC==1)
  {
    if($contD==1 or $contE==1)
    {
      $filtro_estado = $filtro_estado . " AND";
      $filtro_estadoLista = "2";
    }
  } 
  if($contD==1)
  {
    if($contE==1)
    {
      $filtro_prioridad = $filtro_prioridad . " AND";
      $filtro_prioridadLista = "2";
    }
  }  
  

    if (isset($_POST["ser_asig"]) or isset($_POST["ID_pri"]) or isset($_POST["ID_cli"]) or isset($_POST["ID_obr"]) or isset($_POST["ID_sta"]) )
    {
    	$where = "WHERE";

  /*echo   "SELECT * FROM registro_servicio, obras, usuarios WHERE
      obras.ID_obr=registro_servicio.ID_obr AND
      usuarios.ID_usu=registro_servicio.ID_usu AND ".$filtro_cliente." ".$filtro_tienda." ".$filtro_estado."  ".$filtro_prioridad."  ".$filtro_asignado."  ";*/

 $sql = "SELECT * FROM registro_servicio, obras, usuarios WHERE
      obras.ID_obr=registro_servicio.ID_obr AND
      usuarios.ID_usu=registro_servicio.ID_usu AND ".$filtro_cliente."  ".$filtro_tienda." ".$filtro_estado."  ".$filtro_prioridad."  ".$filtro_asignado." ORDER BY registro_servicio.ID_ser DESC";
       
        $result = mysql_query($sql);
        $num_result = mysql_num_rows($result);
         
             $clientes= new clientes;
             $tiendas = new tiendas;
             $status= new status;
             $prioridades = new prioridades;
             $usuarios = new usuarios;

             //Inicio cartel inteligente que redacta el filtro

             @$ID_cliCartel=explode("=",$_POST["ID_cli"]);
               @$ID_obrCartel=explode("=",$_POST["ID_obr"]);
                  @$ID_staCartel=explode("=",$_POST["ID_sta"]);
                    @$ID_priCartel=explode("=",$_POST["ID_pri"]);
                     @$ID_asigCartel=explode("=",$_POST["ser_asig"]);

             @$getClienteByIdB=$clientes->getClienteById(@$ID_cliCartel[1]);
             @$assoc_getClienteByIdB=mysql_fetch_assoc(@$getClienteByIdB);

             @$getTiendaByIdB=$tiendas->getTiendaById(@$ID_obrCartel[1]);
             @$assoc_getTiendaByIdB=mysql_fetch_assoc(@$getTiendaByIdB);

             @$getStatusByIdB=$status->getStatusById(@$ID_staCartel[1]);
             @$assoc_getStatusByIdB=mysql_fetch_assoc(@$getStatusByIdB);

             @$getPrioridadesByIdB=$prioridades->getPrioridadesById(@$ID_priCartel[1]);
             @$assoc_getPrioridadesByIdB=mysql_fetch_assoc(@$getPrioridadesByIdB);

             @$getUsuariosByIdB = $usuarios->getUsuariosById(@$ID_asigCartel[1]);
             @$assoc_getUsuariosByIdB = mysql_fetch_assoc(@$getUsuariosByIdB);

              if($filtro_clienteLista=="1")
                {
                 $filtro_clienteLista = "el Nombre de Cliente a " . $assoc_getClienteByIdB['cli_desc']." ";
                }

               if($filtro_tiendaLista=="1")
                {
                 $filtro_tiendaLista = "el Nombre de Tienda " . $assoc_getTiendaByIdB['obr_desc']." ";
                }

                if($filtro_estadoLista=="1")
                  {
                    $filtro_estadoLista = "el Estado " . $assoc_getStatusByIdB['sta_desc']."";
                  }

                 if($filtro_prioridadLista=="1")
                  {
                    $filtro_prioridadLista = "la Prioridad " . $assoc_getPrioridadesByIdB['pri_desc']." ";
                  }

                  if($filtro_asignadoLista=="1")
                  {
                    $filtro_asignadoLista= "El Usuario asignado " . $assoc_getUsuariosByIdB['usu_nombre']." " . $assoc_getUsuariosByIdB['usu_apellido']." ";
                  }

               if($filtro_clienteLista=="2") 
                 {
                 $filtro_clienteLista = "el Nombre de Cliente " . $assoc_getClienteByIdB['cli_desc']." y ";
                 }
                if($filtro_tiendaLista=="2")
                   {
                     $filtro_tiendaLista = "el Nombre de Tienda " . $assoc_getTiendaByIdB['obr_desc']." y";
                   }
                if($filtro_estadoLista=="2")
                   {
                    $filtro_estadoLista = "el Estado " . $assoc_getStatusByIdB['sta_desc']." y";
                    }
                if($filtro_prioridadLista=="2")
                   {
                    $filtro_prioridadLista = "la Prioridad " . $assoc_getPrioridadesByIdB['pri_desc']." y";
                    }
                if($filtro_asignadoLista=="2")
                {
                 $filtro_asignadoLista= "El Usuario asignado " . $assoc_getUsuariosByIdB['usu_nombre']." " . $assoc_getUsuariosByIdB['usu_apellido']." ";
               }
 
    if ($num_result==0) 
    {
       echo '<div class="alert alert-danger" role="alert">';
              echo '<h4>
                      <i class="material-icons" style="vertical-align: middle;">
                        assignment
                       </i>
                      No existen resultados para la Lista de registros filtrados por '.@$filtro_clienteLista.'  '.@$filtro_tiendaLista.' '.@$filtro_estadoLista.'  '.@$filtro_prioridadLista.'  '.@$filtro_asignadoLista.'.
                     </h4>';  
                echo '<h4> Pruebe limpiar los filtros y realizar una nueva busqueda </h4>'; 
           echo '</div>';  
    }
    else
    {

       echo '<div class="alert alert-info" role="alert">';
              echo '<h4>
                      <i class="material-icons" style="vertical-align: middle;">
                        assignment
                       </i>';

                        if ($num_result==1) 
                        {
                          $listarVerbo="Se Listó";
                          $registro="registro";
                          $filtrado="filtrado";
                        }
                        if ($num_result>=2) 
                        {
                          $listarVerbo="Se Listaron";
                          $registro="registros";
                          $filtrado="filtrados";
                        }

                      echo  $listarVerbo .' '.  $num_result.' ' . $registro . ' ' . $filtrado . ' por '.@$filtro_clienteLista.'  '.@$filtro_tiendaLista.' '.@$filtro_estadoLista.'  '.@$filtro_prioridadLista.'  '.@$filtro_asignadoLista.'
                     </h4>';  
           echo '</div>';  
    }

       //Fin cartel inteligente que redacta el filtro


               }
    else
    {
      echo '<div class="alert alert-dismissible alert-danger">
          <strong><i class="material-icons">sentiment_very_dissatisfied</i> Oh No!</strong> Lo sentimos, ocurrio un error
        </div>';
    }
}

?>

<div class='table-responsive' >
  <table class='table table-condensed table-hover table-striped  table-bordered' >
    <thead>
      <tr>
        <th style='text-align: center;'>CÓDIGO - CLIENTE - TIENDA</th>
      </tr>
      </thead>
      <tbody id='myTable'>
      <?php
        	for ($contRegistroS=0; $contRegistroS < $num_result; $contRegistroS++) 
			     { 
					$assoc_result = mysql_fetch_assoc($result);
          $ID_ser            = $assoc_result['ID_ser'];
					$ID_cli 		       = $assoc_result['ID_cli'];
					$ID_obr 		       = $assoc_result['ID_obr'];
					$ID_pri 		       = $assoc_result['ID_pri'];
					$ID_sta 		       = $assoc_result['ID_sta'];
				  $ser_asig 	       = $assoc_result['ser_asig'];

					$getClienteById = $clientes->getClienteById($ID_cli);
					$assoc_getClienteById = mysql_fetch_assoc($getClienteById);

					$getTiendasById = $tiendas -> getTiendasById($ID_obr);
					$assoc_getTiendasById = mysql_fetch_assoc($getTiendasById);

					$getUsuariosById = $usuarios->getUsuariosById($ser_asig);
					$assoc_getUsuariosById = mysql_fetch_assoc($getUsuariosById);

					$getStatusById = $status->getStatusById($ID_sta);
					$assoc_getStatusById = mysql_fetch_assoc($getStatusById);

          echo "<tr>";
            
	          	echo "<th style='text-align: center;'>";
                echo "<a  role='button' data-toggle='collapse' href='#collapseExample".$assoc_result['ser_cod']."' aria-expanded='false' aria-controls='collapseExample'>
                ".$assoc_result['ser_cod']." - ".$assoc_getClienteById['cli_desc']." - ".$assoc_getTiendasById['obr_desc']."";
                 echo "</a>";
                  echo "<div class='collapse' id='collapseExample".$assoc_result['ser_cod']."'>";
                echo "<div class='well' style='text-align:left;'>";
                    
                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Cliente:
                               <strong>
                                 ".$assoc_getClienteById['cli_desc']."
                              </strong>
                            </p>";

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Tienda:
                               <strong>
                                ".$assoc_getTiendasById['obr_desc']."
                              </strong>
                            </p>
                            ";   



                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              explicit
                            </i> 
                              Estado:
                               <strong>
                                ".$assoc_getStatusById['sta_desc']."
                              </strong>
                            </p>";        

                            $ID_usu=$assoc_result['ID_usu'];
                            $getUsuariosByIdB = $usuarios->getUsuariosById($ID_usu);
                            $assoc_getUsuariosByIdB = mysql_fetch_assoc($getUsuariosByIdB);
                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Operador:
                               <strong>
                                 " .$assoc_getUsuariosByIdB['usu_nombre']. " " . $assoc_getUsuariosByIdB['usu_apellido']. "
                              </strong>
                            </p>"; 
          
              

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Asignado:
                               <strong>
                                 " .$assoc_getUsuariosById['usu_nombre']. " " . $assoc_getUsuariosById['usu_apellido']. "
                              </strong>
                            </p>"; 

                

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Problema:
                               <strong>
                                ".$assoc_result['ser_desc']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              solución:
                               <strong>
                                ".$assoc_result['ser_solucion']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Contacto
                               <strong>
                                ".$assoc_result['ser_contacto']."
                              </strong>
                            </p>";   

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Telefono:
                               <strong>
                                ".$assoc_result['ser_telefono']."
                              </strong>
                            </p>";   

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Email:
                               <strong>
                                ".$assoc_result['ser_mail']."
                              </strong>
                            </p>";      

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Fecha inicio:
                               <strong>
                                ".$assoc_result['ser_fecin']."
                              </strong>
                            </p>";     

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Hora Inicio
                               <strong>
                                 ".$assoc_result['ser_hourin']."
                              </strong>
                            </p>";

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Fecha salida
                               <strong>
                                ".$assoc_result['ser_fecout']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                             Hora Salida
                               <strong>
                                ".$assoc_result['ser_hourout']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Conforme
                               <strong>
                                ".$assoc_result['ser_persconforme']."
                              </strong>
                            </p>";                                   

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Horas:
                               <strong>
                                ".$assoc_result['ser_hs']."
                              </strong>
                            </p>";    

                                            
                     echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment
                            </i> 
                              Nº Proyecto:
                               <strong>
                                ".$assoc_result['obr_nproyecto']."
                              </strong>
                            </p>";    

                                                                                                                                                                                                                                                        
               echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              pan_tool
                            </i> 
                              Costo de Mano de Obra:
                               <strong>
                                ".$assoc_result['ser_costo']."
                              </strong>
                            </p>";    



               echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              location_on
                            </i> 
                              Dirección de la tienda:
                               <strong>
                                ".$assoc_result['obr_dir']."
                              </strong>
                            </p>";    

                   


                echo "</div>";
              echo "</div>";
                 echo "</th>";
            
        
             
	         echo "</tr>";
     







           }
         ?>  
        </tbody>
          <tfoot>
            <tr>
	     <th style='text-align: center;'>CÓDIGO - CLIENTE - TIENDA</th>
           
	       
            </tr>
          </tfoot>
        </table>
      </div>
     <div class='col-md-12 text-center'>
                               <ul class='pager' id='myPager'></ul>
                            </div> 
                                   </div>

                                  



                  <script>
                  $.fn.pageMe = function(opts){
                      var $this = this,
                          defaults = {
                              perPage: 15,
                              showPrevNext: true,
                              hidePageNumbers: true
                          },
                          settings = $.extend(defaults, opts);
                      
                      var listElement = $this;
                      var perPage = settings.perPage; 
                      var children = listElement.children();
                      var pager = $('.pager');
                      
                      if (typeof settings.childSelector!="undefined") {
                          children = listElement.find(settings.childSelector);
                      }
                      
                      if (typeof settings.pagerSelector!="undefined") {
                          pager = $(settings.pagerSelector);
                      }
                      
                      var numItems = children.size();
                      var numPages = Math.ceil(numItems/perPage);

                      pager.data("curr",0);
                      
                      if (settings.showPrevNext){
                          $('<li class="previous"><a href="#" class="prev_link"><span aria-hidden="true">&larr;</span> Anterior</a></li>').appendTo(pager);
                      }

                    if (settings.showPrevNext){
                          $('<li><a href="#" class="page_link"><?php echo  mysql_num_rows($result). " resultados"; ?></a></li>').appendTo(pager);
                      }    
                      if (settings.showPrevNext){
                          $('<li class="next"><a href="#" class="next_link">Siguiente <span aria-hidden="true">&rarr;</span></a></li>').appendTo(pager);
                      }
                      
                      pager.find('.page_link:first').addClass('active');
                      pager.find('.prev_link').hide();
                      if (numPages<=1) {
                          pager.find('.next_link').hide();
                      }
                      pager.children().eq(1).addClass("active");
                      
                      children.hide();
                      children.slice(0, perPage).show();
                      
                      pager.find('li .page_link').click(function(){
                          var clickedPage = $(this).html().valueOf()-1;
                          goTo(clickedPage,perPage);
                          return false;
                      });
                      pager.find('li .prev_link').click(function(){
                          previous();
                          return false;
                      });
                      pager.find('li .next_link').click(function(){
                          next();
                          return false;
                      });
                      
                      function previous(){
                          var goToPage = parseInt(pager.data("curr")) - 1;
                          goTo(goToPage);
                      }
                       
                      function next(){
                          goToPage = parseInt(pager.data("curr")) + 1;
                          goTo(goToPage);
                      }
                      
                      function goTo(page){
                          var startAt = page * perPage,
                              endOn = startAt + perPage;
                          
                          children.css('display','none').slice(startAt, endOn).show();
                          
                          if (page>=1) {
                              pager.find('.prev_link').show();
                          }
                          else {
                              pager.find('.prev_link').hide();
                          }
                          
                          if (page<(numPages-1)) {
                              pager.find('.next_link').show();
                          }
                          else {
                              pager.find('.next_link').hide();
                          }
                          
                          pager.data("curr",page);
                          pager.children().removeClass("active");
                          pager.children().eq(page+1).addClass("active");
                      
                      }
                  };

                  $(document).ready(function(){
                      
                    $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:8});
                      
                  });
                  </script>

         

