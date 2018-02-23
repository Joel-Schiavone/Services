<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
@$ID_pto= $_POST["ID_pto"];
$ID_emp = $_SESSION['ID_emp'];
@$buscar= $_POST["buscar"];
@$codigo= $_POST["codigo"];
if (@$codigo) 
{
        $sql = "SELECT * FROM quotations WHERE pto_pedidoCod='".$codigo."' OR pto_numero='".$codigo."'";
        $result = mysql_query($sql);
        $num_result = mysql_num_rows($result);
    if ($num_result>=1) 
            {
              echo "<div class='alert alert-success' role='alert' style='text-align:center;' >
                    <h3><i class='material-icons' style='vertical-align:middle;'>mood</i> Se encontró ".$num_result." registro</h3>
                  </div>";
            }
            else
            {
             echo "<div class='alert alert-warning' role='alert' style='text-align:center;' >
                    <h3><i class='material-icons' style='vertical-align:middle;'>sentiment_very_dissatisfied</i> No se encontraron registros</h3>
                  </div>";
            } 
}
else  
{

if (@$_POST["ID_usu"]!="vacio")
{
   $filtro_usuario = @$_POST["ID_usu"];
   $contA=1;
}
else
{
    $filtro_usuario = "";
    $contA=0;
}

if (@$_POST["pto_asignado"]!="vacio")
{
  
   $filtro_asignado = @$_POST["pto_asignado"];
   $contB=1;

}

else
{

    $filtro_asignado = "";
    $contB=0;
}




if (@$_POST["ID_cli"]!="vacio")
{
   $filtro_cliente = " ".@$_POST["ID_cli"];
   $contC=1;
  
}

else
{
    $filtro_cliente = "";
    $contC=0;
}

if (@$_POST["ID_obr"]!="vacio")
{
   $filtro_tienda = " ".@$_POST["ID_obr"];
   $contD=1;
  
}
else
{
    $filtro_tienda = "";
    $contD=0;
 

}


if (@$_POST["desde"]!="vacio")
{
   $desde = @$_POST["desde"];
   $contE=1;

}
else
{
  $desde = "";
  $contE=0;
}


      if (@$_POST['ID_sta']!="vacio")
      {
         $resultado = count(@$_POST['ID_sta']);
         $aray = @$_POST['ID_sta'];
         $stringA = " OR ID_sta= ";

          @$filtro_estado = "(ID_sta= " . implode ( $stringA , $aray) . ")";
  
         $contF=1;
      
      }
      else
      {
        $filtro_estado = "";
        $contF=0;
      }


if($contA==1)
  {
        if($contB==1 or $contC==1 or $contD==1 or $contF==1 or $contE==1)
    {
      $filtro_usuario = $filtro_usuario . " AND";
    }

  }

  if($contB==1)
  {
    if($contC==1 or $contD==1 or $contF==1 or $contE==1)
    {
      $filtro_asignado = $filtro_asignado . " AND";
    }
  }
  if($contC==1)
  {
    if($contD==1 or $contF==1 or $contE==1)
    {
      $filtro_cliente = $filtro_cliente . " AND";
    }
  } 
  if($contD==1)
  {
    if($contF==1 or $contE==1)
    {
      $filtro_tienda = $filtro_tienda . " AND";
    }
   }  
  if($contF==1)
  { 
    if($contE==1)
    {
      $filtro_estado = $filtro_estado . " AND";
    }
  }  


    if (isset($_POST["ID_usu"]) or isset($_POST["pto_asignado"]) or isset($_POST["desde"]) or isset($_POST["ID_cli"]) or isset($_POST["ID_obr"]) or isset($_POST["ID_sta"]) )
    {
      $where = " WHERE ID_tpp!='6' AND ";

    //  echo "SELECT * FROM quotations ".$where." ".$filtro_usuario." ".$filtro_asignado."  ".$filtro_cliente."  ".$filtro_tienda." ".$filtro_estado." ".$desde." ";

        $sql = "SELECT *,
             DATE_FORMAT(pto_fecDescDirector, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecDescDirector,
             DATE_FORMAT(pto_fecModif, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecModif,
             DATE_FORMAT(pto_fecDescGerente, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecDescGerente,
             DATE_FORMAT(pto_fecDescCostos, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecDescCostos,
             DATE_FORMAT(pto_fecDescDirector, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecDescDirector,
             DATE_FORMAT(pto_fecPerdida, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecPerdida,
             DATE_FORMAT(pto_fecBloqueo, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecBloqueo,
              DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
              DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
              DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
              DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
              DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado,
              DATE_FORMAT(pto_fecPresupuesto, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecPresupuesto,
              DATE_FORMAT(pto_fecEntrega, '%d-%m-%Y') as pto_fecEntrega,  
              DATE_FORMAT(pto_fecVenta, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecVenta,
              DATE_FORMAT(pto_fecDespacho, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecDespacho,
              DATE_FORMAT(pto_fecInstalacion, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecInstalacion  FROM quotations ".$where."  ".$filtro_usuario." ".$filtro_asignado."  ".$filtro_cliente."  ".$filtro_tienda." ".$filtro_estado."  
         ".$desde." ";
        $result = mysql_query($sql);
             $num_result = mysql_num_rows($result);
            }
    else
    {
        $where = "WHERE ID_tpp!='6'";
         $sql = "SELECT *
              FROM quotations ".$where."";
        $result = mysql_query($sql);
        $num_result = mysql_num_rows($result);
    }
  if ($num_result>=1) 
            {
              echo "<div class='alert alert-success' role='alert' style='text-align:center;' >
                    <h3><i class='material-icons' style='vertical-align:middle;'>mood</i> Se encontraron ".$num_result." registros</h3>
                  </div>";
            }
            else
            {
             echo "<div class='alert alert-warning' role='alert' style='text-align:center;' >
                    <h3><i class='material-icons' style='vertical-align:middle;'>sentiment_very_dissatisfied</i> No se encontraron registros</h3>
                  </div>";
            } 

}
$clientes = new clientes;
$tiendas = new tiendas;
$usuarios = new usuarios; 
$status = new status;
$motivos_rechazo = new motivos_rechazo;
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
          for ($cuentaQuotations=0; $cuentaQuotations < $num_result; $cuentaQuotations++) 
      { 
          $assoc_result = mysql_fetch_assoc($result);
          $ID_cli            = $assoc_result['ID_cli'];
          $ID_obr            = $assoc_result['ID_obr'];
          $ID_usu            = $assoc_result['ID_usu'];
          $ID_sta            = $assoc_result['ID_sta'];
          $pto_asignado      = $assoc_result['pto_asignado'];

          $getClienteById = $clientes->getClienteById($ID_cli);
          $assoc_getClienteById = mysql_fetch_assoc($getClienteById);

          $getTiendasById = $tiendas -> getTiendasById($ID_obr);
          $assoc_getTiendasById = mysql_fetch_assoc($getTiendasById);

          $getUsuariosById = $usuarios->getUsuariosById($ID_usu);
          $assoc_getUsuariosById = mysql_fetch_assoc($getUsuariosById);

          $getUsuariosByIdB = $usuarios->getUsuariosById($pto_asignado);
          $assoc_getUsuariosByIdB = mysql_fetch_assoc($getUsuariosByIdB);

          $getStatusById = $status->getStatusById($ID_sta);
          $assoc_getStatusById = mysql_fetch_assoc($getStatusById);

          $tipo_moneda = new tipo_moneda;
                  $ID_tmo = $assoc_result['ID_tipoMonedaPres'];
                  $getTipo_monedaById = $tipo_moneda->getTipo_monedaById($ID_tmo);
                  $assoc_getTipo_monedaById = mysql_fetch_assoc($getTipo_monedaById);
                  $ID_mot = $assoc_result['ID_mot'];
       
          echo "<tr>";
            
              echo "<th style='text-align: center;'>";
                echo "<a  role='button' data-toggle='collapse' href='#collapseExample".$assoc_result['pto_pedidoCod']."' aria-expanded='false' aria-controls='collapseExample'>
                ".$assoc_result['pto_pedidoCod']." - ".$assoc_getClienteById['cli_desc']." - ".$assoc_getTiendasById['obr_desc']."";
                 echo "</a>";
                  echo "<div class='collapse' id='collapseExample".$assoc_result['pto_pedidoCod']."'>";
                echo "<div class='well' style='text-align:left;'>";
                  $ID_ptoB = $assoc_result['ID_pto'];
                  
                    $pto_asignadoC = $assoc_result['pto_asignado'];
                  $pto_vendedorD = $assoc_result['pto_vendedor'];
                  $quotations = new quotations;
                  $usuarios = new usuarios;
                  $getQuotations = $quotations->getQuotations($ID_ptoB);
                  $assoc_getQuotations = mysql_fetch_assoc($getQuotations);

                  $getUsuariosByIdC = $usuarios->getUsuariosById($pto_asignadoC);
                  $assoc_getUsuariosByIdC = mysql_fetch_assoc($getUsuariosByIdC);


                  $getUsuariosByIdD = $usuarios->getUsuariosById($pto_vendedorD);
                  $assoc_getUsuariosByIdD = mysql_fetch_assoc($getUsuariosByIdD);

                  $tipo_moneda = new tipo_moneda;
                  $ID_tmo = $assoc_getQuotations['ID_tipoMonedaPres'];
                  $getTipo_monedaById = $tipo_moneda->getTipo_monedaById($ID_tmo);
                  $assoc_getTipo_monedaById = mysql_fetch_assoc($getTipo_monedaById);
                  $ID_mot = $assoc_result['ID_mot'];
                 


    


























         echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Empresa:
                               <strong>
                                ".$assoc_getQuotations['emp_nombre']."
                              </strong>
                            </p>";

                
                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Cliente:
                               <strong>
                                 ".$assoc_getQuotations['cli_desc']."
                              </strong>
                            </p>";

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Tienda:
                               <strong>
                                ".$assoc_getQuotations['obr_desc']."
                              </strong>
                            </p>
                            ";   

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Usuario:
                               <strong>
                                " .$assoc_getQuotations['usu_nombre']. " " .$assoc_getQuotations['usu_apellido']. "
                              </strong>
                            </p>";


                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              explicit
                            </i> 
                              Estado:
                               <strong>
                                ".$assoc_getQuotations['sta_desc']."
                              </strong>
                            </p>";        


                               if ($ID_mot!=0)
                                 {
                                  $getMotivosRechazoIdMot = $motivos_rechazo->getMotivosRechazoIdMot($ID_mot);
                                  $assoc_getMotivosRechazoIdMot = mysql_fetch_assoc($getMotivosRechazoIdMot);
                                   echo "    <p>
                                                  <i class='material-icons' style='vertical-align: middle'>
                                                    assignment_ind
                                                  </i> 
                                                    mot:
                                                     <strong>
                                                     ".$assoc_getMotivosRechazoIdMot['mot_desc']."
                                                    </strong>
                                                  </p>";    
                                 }
                                 else
                                 {

                                 }

               

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Competencia:
                               <strong>
                                ".$assoc_getQuotations['com_nombre']."
                              </strong>
                            </p>";       


                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Presupuesto Relacionado:
                               <strong>
                                ".$assoc_result['pto_presupuestoRelacionado']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Codigo de pedido:
                               <strong>
                                ".$assoc_result['pto_pedidoCod']."
                              </strong>
                            </p>";

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Codigo de presupuesto:
                               <strong>
                                ".$assoc_result['pto_numero']."
                              </strong>
                            </p>";           


                  echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                                Orden de Compra:
                               <strong>
                                ".$assoc_result['pto_OC']."
                              </strong>
                            </p>";   

                 echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                                Orden de Venta:
                               <strong>
                                ".$assoc_result['pto_OV']."
                              </strong>
                            </p>";                     
            

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Asignado:
                               <strong>
                                 " .$assoc_getUsuariosByIdC['usu_nombre']. " " . $assoc_getUsuariosByIdC['usu_apellido']. "
                              </strong>
                            </p>"; 

                  echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Vendedor:
                               <strong>
                                 " .$assoc_getUsuariosByIdD['usu_nombre']. " " . $assoc_getUsuariosByIdD['usu_apellido']. "
                              </strong>
                            </p>";  

                                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Contacto:
                               <strong>
                                ".$assoc_result['pto_contacto']."
                              </strong>
                            </p>";   


                  echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              email
                            </i> 
                              Email de Contacto:
                               <strong>
                                 ".$assoc_result['pto_mail']."
                              </strong>
                            </p>";   


                  echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              phone
                            </i> 
                              Telefono de Contacto:
                               <strong>
                                 ".$assoc_result['pto_telefono']."
                              </strong>
                            </p>";      

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Descripcion:
                               <strong>
                                ".$assoc_result['pto_desc']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Monto Presupuesto:
                               <strong>
                                ".$assoc_result['pto_montoPresupuesto']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Monto OV:
                               <strong>
                                ".$assoc_result['pto_montoOV']."
                              </strong>
                            </p>";   

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Fecha Modificacion:
                               <strong>
                                ".$assoc_result['pto_fecModif']."
                              </strong>
                            </p>";   

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Cerrado:
                               <strong>
                                ".$assoc_result['pto_cerrado']."
                              </strong>
                            </p>";      

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Tipo de Moneda:
                               <strong>
                                ".$assoc_getQuotations['tmo_desc']."
                              </strong>
                            </p>";     

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Tipo de Moneda Pres:
                               <strong>
                                ".$assoc_getTipo_monedaById['tmo_desc']."
                              </strong>
                            </p>";

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Tipo Cambio Pres:
                               <strong>
                                ".$assoc_result['tipoCambioPres']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                             Tipo Cambio Venta:
                               <strong>
                                ".$assoc_result['tipoCambioVenta']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              assignment_ind
                            </i> 
                              Ayuda OT:
                               <strong>
                                ".$assoc_result['pto_ayudaOt']."
                              </strong>
                            </p>";                                   

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Descuento Gerente:
                               <strong>
                                ".$assoc_result['pto_fecDescGerente']."
                              </strong>
                            </p>";    

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Descuento Director:
                               <strong>
                                ".$assoc_result['pto_fecDescDirector']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Descuento Costo:
                               <strong>
                                ".$assoc_result['pto_fecDescCostos']."
                              </strong>
                            </p>";      

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Pedido Descuento Director:
                               <strong>
                                ".$assoc_result['pto_fecPedidoDescDirector']."
                              </strong>
                            </p>";     

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Perdida:
                               <strong>
                                ".$assoc_result['pto_fecPerdida']."
                              </strong>
                            </p>";      

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Bloqueo:
                               <strong>
                                ".$assoc_result['pto_fecBloqueo']."
                              </strong>
                            </p>"; 

                  echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Ingreso:
                               <strong>
                                ".$assoc_result['pto_fecIngreso']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Requerida:
                               <strong>
                                ".$assoc_result['pto_fecRequerida']."
                              </strong>
                            </p>";  

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Asignacion:
                               <strong>
                                ".$assoc_result['pto_fecAsignado']."
                              </strong>
                            </p>";

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Entrega Estimada:
                               <strong>
                                ".$assoc_result['pto_fecEntregaEstimada']."
                              </strong>
                            </p>";     

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i>  
                              Fecha Aceptado:
                               <strong>
                                ".$assoc_result['pto_fecAceptado']."
                              </strong>
                            </p>";   

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                             access_time
                            </i> 
                              Fecha Presupuestado:
                               <strong>
                                ".$assoc_result['pto_fecPresupuesto']."
                              </strong>
                            </p>";                                             

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Entrega:
                               <strong>
                                ".$assoc_result['pto_fecEntrega']."
                              </strong>
                            </p>";         

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Venta:
                               <strong>
                                ".$assoc_result['pto_fecVenta']."
                              </strong>
                            </p>";      

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Despacho:
                               <strong>
                                ".$assoc_result['pto_fecDespacho']."
                              </strong>
                            </p>";       

                echo "<p>
                            <i class='material-icons' style='vertical-align: middle'>
                              access_time
                            </i> 
                              Fecha Instalacion:
                               <strong>
                                ".$assoc_result['pto_fecInstalacion']."
                              </strong>
                            </p>";                                         

                                                                                                                                                                                                                                                        
                              
          echo "<p>";                                                                                                                            
                   // Inicio adjuntos -->
                        $adj_idRelacion       = $assoc_result['ID_pto'];
                        $adj_tablaRelacion    = "quotations";
                        include('inc/adjuntos.php');
                   // Fin adjuntos -->
                     
                echo "</p>";  





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
                   <?php

require_once('inc/footer.php');
?> 
