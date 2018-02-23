<?php
    $quotations= new quotations;
                                echo "<div class='bs-callout bs-callout-success'>";
                       $getQuotationsByIdB            =  $quotations->getQuotationsById($assoc_result['ID_pto']);
                      $assoc_getQuotationsByIdB      =  mysql_fetch_assoc($getQuotationsByIdB);

                      $adjuntos                        = new adjuntos();
                      $getAdjuntosByAdjIdRelacion      = $adjuntos->getAdjuntosByAdjIdRelacion($adj_idRelacion, $adj_tablaRelacion);
                     $num_getAdjuntosByAdjIdRelacion  = mysql_num_rows($getAdjuntosByAdjIdRelacion);

                      echo "<h4 class='modal-title' id='myModalLabel'>Adjuntos del presupuesto ".$assoc_getQuotationsByIdB['pto_pedidoCod']." </h4>";


                                                      echo "<div id='tablaOcultaAdjuntosAnteriores' ><table class='table table-condensed table-hover table-striped' >";
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
                                                        echo "</tr>";
                                                           for($adjuntosCount=0; $adjuntosCount<$num_getAdjuntosByAdjIdRelacion; $adjuntosCount++)
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
                                                              $usuarios = new usuarios;
                                                              $getUsuariosById        = $usuarios->getUsuariosById($ID_usu);
                                                              $assoc_getUsuariosById  = mysql_fetch_assoc($getUsuariosById);
                                                              echo $assoc_getUsuariosById['usu_nombre']. " " . $assoc_getUsuariosById['usu_apellido'];
                                                            echo "</td>";
                                                             echo "<td>";  
                                                                 
                                                             echo $assoc_getAdjuntosByAdjIdRelacion['adj_fecha'];
                                                            echo "</td>";   
                                                            
                                                        echo "</tr>";
                                                             
                                                        }
                                                      echo "</table>";
                                                      echo "</div>";
                                                      echo "</div>";
                    
?>