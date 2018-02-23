<?php
 require_once('inc/required.php');
$ID_ser=$_GET['ID_ser']; 

                                          echo '<div class="panel panel-danger">';
                                            echo '<div class="panel-heading">';
                                              echo '<h3 class="panel-title">Eliminar Registro</h3>';
                                            echo '</div>';
                                            echo '<div class="panel-body">';
                                                echo '<div class="alert alert-danger" role="alert">';
                                                      echo '<h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>';
                                                        echo '<p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>';
                                                    echo '</div>';
                                                 echo '<form action="actions-services.php" method="POST">';
                                                    echo '<input type="hidden" name="action" value="borrarRegistro">';
                                                    echo '<input type="hidden" name="ID_ser" value="'.$ID_ser.'">';
                                                    echo '<button type="submit" class="btn btn-danger"><i class="material-icons" style="vertical-align: middle">';echo 'delete_forever</i> Eliminar</button>';
                                                  echo '</form> ';
                                            echo '</div>';
                                          echo '</div>';

?>                                      