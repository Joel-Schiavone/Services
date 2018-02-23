<?php
 require_once('inc/required.php');
$ID_pto=$_GET['ID_pto']; 

                                          echo '<div class="panel panel-danger">';
                                            echo '<div class="panel-heading">';
                                              echo '<h3 class="panel-title">Eliminar Registro</h3>';
                                            echo '</div>';
                                            echo '<div class="panel-body">';
                                                echo '<div class="alert alert-danger" role="alert">';
                                                      echo '<h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>';
                                                        echo '<p>CUIDADO !!! Usted esta a punto de eliminar un Registro</p>';
                                                    echo '</div>';
                                                 echo '<form action="actions-quotation-as.php" method="POST">';
                                                    echo '<input type="hidden" name="actionAS" value="delete">';
                                                    echo '<input type="hidden" name="ID_pto" value="'.$ID_pto.'">';
                                                    echo '<button type="submit" class="btn btn-danger"><i class="material-icons" style="vertical-align: middle">';echo 'delete_forever</i> Eliminar</button>';
                                                  echo '</form> ';
                                            echo '</div>';
                                          echo '</div>';

?>                                      