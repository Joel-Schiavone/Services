<?php
$usuarios                        = new usuarios();
$adjuntos                        = new adjuntos();
$getAdjuntosByAdjIdRelacion      = $adjuntos->getAdjuntosByAdjIdRelacion($adj_idRelacionSERVICES, $adj_tablaRelacionSERVICES);
$getAdjuntosByAdjIdRelacionA     = $adjuntos->getAdjuntosByAdjIdRelacion($adj_idRelacionSERVICES, $adj_tablaRelacionSERVICES);
$num_getAdjuntosByAdjIdRelacion  = mysql_num_rows($getAdjuntosByAdjIdRelacion);
$num_getAdjuntosByAdjIdRelacionA = mysql_num_rows($getAdjuntosByAdjIdRelacionA);
$hora						               	 = date ("h:i:s");
$fecha							             = date ("Y-n-j");
$adj_fecha						           = $fecha." ".$hora;
$ID_usu 						             = $_SESSION['ID_usu'];

 
 for($aa=0; $aa<$num_getAdjuntosByAdjIdRelacionA; $aa++)
   {
      $assoc_getAdjuntosByAdjIdRelacionA  = mysql_fetch_assoc($getAdjuntosByAdjIdRelacionA);

      echo "<div class='modal fade' id='".$assoc_getAdjuntosByAdjIdRelacionA['ID_adj']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
              <div class='modal-dialog' role='document'>
                 <div class='modal-content'>
                    <div class='modal-header'>
                       <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                       <h4 class='modal-title' id='myModalLabel'>Eliminar Registro</h4>
                    </div>

                    <div class='modal-body' align='center'>
                        <div class='alert alert-danger' role='alert'>
                           <h5><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> ¿Está seguro?</h5>
                           <p>Usted esta a punto de eliminar un registro</p>
                        </div>
                    </div>
                      
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                      <a href='drop-adjunto.php?ID_adj=".base64_encode((12344*($assoc_getAdjuntosByAdjIdRelacionA['ID_adj']))/12)."&url=".$_SERVER['REQUEST_URI']."'>
                          <button id='myButton' class='btn btn-primary' autocomplete='off'>
                              <i class='material-icons' style='height: 5px; margin-top: -12px;'>delete_forever</i> 
                                  Eliminar
                          </button>
                      </a>
                    </div>
                  </div>
                </div> 
            </div>";
     }
        

echo "<h4 class='modal-title' id='myModalLabel'>Adjuntos de Servicios</h4>";

                                                      echo "<table class='table table-condensed table-hover table-striped'>";
                                                        echo "<tr>";
                                                          echo "<td>";
                                                            echo "<h5>Nombre</h5>";
                                                          echo "</td>";
                                                           echo "<td>";
                                                            echo "<h5>Subido por</h5>";
                                                          echo "</td>";
                                                           echo "<td>";
                                                            echo "<h5>Fecha</h5>";
                                                          echo "</td>";
                                                          echo "<td>";
                                                            echo "<h5>Opciones</h5>";
                                                          echo "</td>";
                                                        echo "</tr>";
                                                            echo "<input hidden name='id' value='" . $adj_idRelacionSERVICES . "'></input>";
                                                            echo "<input hidden name='adj_fecha' value='".$adj_fecha."'></input>";
                                                            echo "<input hidden name='ID_usu' value='".$ID_usu."'></input>";
                                                            echo "<input hidden name='adj_idRelacion' value='".$adj_idRelacionSERVICES."'></input>";
                                                            echo "<input hidden name='adj_tablaRelacion' value='".$adj_tablaRelacionSERVICES."'></input>";
                                                         echo "</form>";                     
                                                           for($b=0; $b<$num_getAdjuntosByAdjIdRelacion; $b++)
                                                                  {
                                                                    $assoc_getAdjuntosByAdjIdRelacion = mysql_fetch_assoc($getAdjuntosByAdjIdRelacion);
                                                           
                                                        echo "<tr>"; 
                                                            echo "<td>";          
                                                             echo "<a href='".$assoc_getAdjuntosByAdjIdRelacion['adj_ruta']."' target='_blank'>
                                                              
                                                                        <div class='adjunto_vertical' id='adjunto_vertical'  style='display: block;'>
                                                                          <button type='button' class='btn btn-primary btn-xs' style='white-space: inherit; height: 100%;' id='adjunto' name='adjunto'>
                                                                            <i class='material-icons' style='vertical-align: middle;'> attach_file </i> ".$assoc_getAdjuntosByAdjIdRelacion['adj_desc']."
                                                                            </button>
                                                                          </div>
                                                                          <div class='adjunto_horizontal' id='adjunto_horizontal' style='display: none;'>
                                                                            <button type='button' class='btn btn-primary btn-xs' style='white-space: inherit; height: 100%;' id='desadjunto' name='desadjunto'>
                                                                            <i class='material-icons' style='vertical-align: middle;'> attachment </i> ".$assoc_getAdjuntosByAdjIdRelacion['adj_desc']."
                                                                            </button>
                                                                          </div>
                                                                  </a>
                                                                  <script>
                                                                    $('#adjunto').mouseover(function() 
                                                                       {  
                                                                        $('#adjunto_horizontal').css('display', 'block');
                                                                           $('#adjunto_vertical').css('display', 'none');
                                                                      });

                                                                      $('#desadjunto').mouseout(function() 
                                                                       {  
                                                                        $('#adjunto_horizontal').css('display', 'none');
                                                                           $('#adjunto_vertical').css('display', 'block');
                                                                      });
                                                                  </script>";

                                                            echo "</td>";   
                                                             echo "<td>";  
                                                              $ID_usu                 = $assoc_getAdjuntosByAdjIdRelacion['ID_usu'];
                                                              $getUsuariosById        = $usuarios->getUsuariosById($ID_usu);
                                                              $assoc_getUsuariosById  = mysql_fetch_assoc($getUsuariosById);
                                                              echo $assoc_getUsuariosById['usu_nombre']. " " . $assoc_getUsuariosById['usu_apellido'];
                                                            echo "</td>";
                                                             echo "<td>";  
                                                                 
                                                             echo $assoc_getAdjuntosByAdjIdRelacion['adj_fecha'];
                                                            echo "</td>";   
                                                            echo "<td>";
                                                            echo "<input hidden name='id' value='".$adj_idRelacionSERVICES."'></input><input hidden name='ID_adj' value='".$assoc_getAdjuntosByAdjIdRelacion['ID_adj']."'></input>";
                                                             echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#".$assoc_getAdjuntosByAdjIdRelacion['ID_adj']."'><i class='material-icons'>delete_forever</i></button>";
                                                          echo "</td>";
                                                        echo "</tr>";
                                                             
                                                        }
                                                      echo "</table>";
?>