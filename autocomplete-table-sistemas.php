 <!-- Inicio Head -->
  <?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
    $ID_emp                          =    $_SESSION['ID_emp'];
    $obras_sistema                   =    new obras_sistema(); 
    $tiendas                         =    new tiendas();
    $obras_sector                    =    new obras_sector();
    $ID_obr                          =    $_POST["ID_obr"];
    $ID_sec                          =    $_POST["datosSector"];
    $getobras_sistemaById_sec        =    $obras_sistema ->getobras_sistemaById_sec ($ID_obr, $ID_sec);
    $num_getobras_sistemaById_sec    =    mysql_num_rows($getobras_sistemaById_sec);
    $getobras_sistemaById_secB       =    $obras_sistema ->getobras_sistemaById_sec ($ID_obr, $ID_sec);
    $num_getobras_sistemaById_secB   =    mysql_num_rows($getobras_sistemaById_secB);
    $getobras_sistemaById_secC       =    $obras_sistema ->getobras_sistemaById_sec ($ID_obr, $ID_sec);
    $num_getobras_sistemaById_secC   =    mysql_num_rows($getobras_sistemaById_secC);

    $getTiendasByIdEmp               =    $tiendas->getTiendasByIdEmp($ID_emp);
    $num_getTiendasByIdEmp           =    mysql_num_rows($getTiendasByIdEmp);

    $getTiendasById                  =    $tiendas->getTiendasById($ID_obr);
    $assoc_getTiendasById            =    mysql_fetch_assoc($getTiendasById);

    $getObras_sectorById             =    $obras_sector->getObras_sectorById($ID_sec);
    $assoc_getObras_sectorById       =    mysql_fetch_assoc($getObras_sectorById);

    $_SESSION['urlEquipment']        =   $_SERVER['REQUEST_URI']; 
  ?>
<!--Fin Objetos-->

<!--Inicio Modal Sector Modificar-->
    <?php
     for ($i=0; $i < $num_getobras_sistemaById_secB; $i++) 
                          { 
                              $assoc_getobras_sistemaById_secB =  mysql_fetch_assoc($getobras_sistemaById_secB);  
                              $getObras_sectorById_obr         =    $obras_sector->getObras_sectorById_obr($ID_obr);
                              $num_getObras_sectorById_obr     =    mysql_num_rows($getObras_sectorById_obr);

                             echo "<div class='modal fade' id='".$assoc_getobras_sistemaById_secB['ID_sis']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                     <form action='modif-system.php' method='POST'>
                                        <div class='modal-dialog' role='document'>
                                           <div class='modal-content'>
                                               <div class='modal-header'>
                                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                   <h4 class='modal-title' id='myModalLabel'>  
                                                        <i style='vertical-align: middle;' class='material-icons'>
                                                          settings
                                                        </i>
                                                        Sistemas
                                                   </h4>
                                                </div>
                                                <div class='modal-body' align='center'>
                                                        <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                settings
                                                              </i>
                                                            </span>
                                                             <input type='text' name='sis_desc' class='form-control' value='".$assoc_getobras_sistemaById_secB['sis_desc']."'>
                                                          </div>
                                                        </div>

                                                             <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                select_all
                                                              </i>
                                                            </span>
                                                        <select name='ID_sec' class='form-control'>

                                                           <option selected class='form-control' value='".$assoc_getObras_sectorById['ID_sec']."'>".$assoc_getObras_sectorById['sec_desc']."
                                                           </option>";

                                                           for ($j=0; $j < $num_getObras_sectorById_obr ; $j++)
                                                            { 
                                                              $assoc_getObras_sectorById_obr = mysql_fetch_assoc($getObras_sectorById_obr);
                                                              
                                                              if ($assoc_getObras_sectorById_obr['ID_sec']!=$assoc_getObras_sectorById['ID_sec'])
                                                              {
                                                              echo "<option value='".$assoc_getObras_sectorById_obr['ID_sec']."'>".$assoc_getObras_sectorById_obr['sec_desc']."
                                                                    </option>";
                                                              }
                                                            }

                                                  echo "</select>
                                                          </div>
                                                        </div>
                                                             <div class='form-group'>
                                                          <div style='margin: 30px;' class='input-group'>
                                                            <span class='input-group-addon' id='basic-addon1'>
                                                              <i style='height: 5px; margin-top: -12px;' class='material-icons'>
                                                                store
                                                              </i>
                                                            </span>
                                                        <select  name='ID_obr' class='form-control'>
                                                           <option selected class='form-control' value='".$assoc_getTiendasById['ID_obr']."'>".$assoc_getTiendasById['obr_desc']."
                                                           </option>";

                                                      
                                                    echo "</select>
                                                          </div>
                                                        </div>
                                                        <input hidden type='text' name='ID_sis' value='".$assoc_getobras_sistemaById_secB['ID_sis']."'>
                                                        

                                                </div>
                                                <div class='modal-footer'>

                                                 <button type='submit' name='modificar' id='modificar' value='modificar'  class='btn btn-success'><i class='material-icons' style='vertical-align: middle'> save </i> Guardar Cambios</button>
                                                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                                               </div>
                                            </div> 
                                        </div>
                                      </form>  
                                    </div>";
                                 }   
            ?>                               
<!-- Fin Modal Sector Modificar-->

<!--Inicio Modal Sector Eliminar-->

<?php
          for($bb=0; $bb<$num_getobras_sistemaById_secC; $bb++)
           {
              $assoc_getobras_sistemaById_secC  = mysql_fetch_assoc($getobras_sistemaById_secC);

              echo "<div class='modal fade' id='Eliminar".$assoc_getobras_sistemaById_secC['ID_sis']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
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
                            <form action='modif-system.php' method='POST'>
                              <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                                  <button type='submit' id='eliminar' name='eliminar' value='eliminar' class='btn btn-danger'>
                                      <i class='material-icons' style='height: 5px; margin-top: -12px;'>delete_forever</i> 
                                          eliminar
                                  </button>
                                  <input hidden type='text' name='ID_obr' value='".$ID_obr."'></input>
                                  <input hidden type='text' name='ID_sis' value='".$assoc_getobras_sistemaById_secC['ID_sis']."'>
                                 </form> 
                              </a>
                            </div>
                          </div>
                        </div> 
                    </div>";
             }

?>     
<!-- Fin Modal Sector eliminar-->

 <div class="col-md-4" style="background-color:#fff; margin-top:10px; border: 4px solid #333; -webkit-border-radius: 15px; -moz-border-radius: 15px;">
      
  <H4 class='modal-title' id='myModalLabel' style='margin-top: 10px;'>  
    <i style='vertical-align: middle;' class='material-icons'>
       settings
    </i>
    SISTEMAS
    <button type='button' class='btn btn-success' id='nuevoSistema' style='float: right; margin-bottom: 10px; margin-right: 5px;'>
      <i class='material-icons' style='vertical-align: middle'> 
        add 
      </i>
    </button>
  </H4>
         <div id='inputNuevoSistema' style="display: none;">
                   <form action='insert-system.php' method='POST'>
                    <table class='table table-responsive'>
                        <tr>
                          <td>Nuevo Sector</td>
                          <td>Guardar</td>
                        </tr>
                        <tr>
                          <td>
                            <input hidden type='text' name='ID_sec' value='<?php echo $ID_sec; ?>'></input>
                            <input hidden type='text' name='ID_obr' value='<?php echo $ID_obr; ?>'></input>
                            <input type='text' name='sis_desc' class='form-control' placeholder='Denominación'></input>
                          </td>
                          <td>
                          <button type='submit' class='btn btn-success' data-toggle='modal' style='width: 40px; height: 30px; text-align: center;' >
                            <i class='material-icons' style='vertical-align: middle'>
                             save 
                            </i>
                          </button>
                        </td>
                      </tr>
                    </table>
                  </form>
              </div>
<?php
                echo "<table class='table table-responsive'>
                        <tr>
                            <td>
                              Descripción
                            </td>
                            <td>
                              Editar
                            </td>
                            <td>
                              Eliminar
                            </td>
                        </tr>"; 
                          for ($a=0; $a < $num_getobras_sistemaById_sec; $a++) 
                          { 
                             $assoc_getobras_sistemaById_sec =  mysql_fetch_assoc($getobras_sistemaById_sec);       
                                  echo "<tr>
                                          <td>
                                           <button id='autocompletequipos".$assoc_getobras_sistemaById_sec['ID_sis']."' name='autocomplete-table-sistemas' class='btn btn-info'>".$assoc_getobras_sistemaById_sec['sis_desc']."</button>
                                          </td>
                                          <td>
                                              <button type='button' class='btn btn-success' data-toggle='modal' style='width: 40px; height: 30px; text-align: center;' data-target='#".$assoc_getobras_sistemaById_sec['ID_sis']."' ><i class='material-icons' style='vertical-align: middle'> edit </i></button>
                                          </td>
                                          <td>
                                            <button type='bottom' class='btn btn-danger' style='width: 40px; height: 30px; text-align: center' data-toggle='modal' data-target='#Eliminar".$assoc_getobras_sistemaById_sec['ID_sis']."'><i class='material-icons' style='vertical-align: middle;'> delete_forever </i></button>
                                          </td>
                                      </tr>"; 
                                         echo "<script type='text/javascript'>
                                  $(window).ready(function(){
                                    $('#autocompletequipos".$assoc_getobras_sistemaById_sec['ID_sis']."').click(function(){
                                      $('#recibeTablaEquipos').load('autocomplete-table-equipos.php', { 'datosSistemas': '".$assoc_getobras_sistemaById_sec['ID_sis']."', 'ID_obr': '".$assoc_getobras_sistemaById_sec['ID_obr']."' , 'ID_sec': '".$assoc_getobras_sistemaById_sec['ID_sec']."'} );
                                       });
                                  });
                              </script>";       
                          } 
                          echo "</table>";
          ?>
</div>
  <!-- Inicio JQuery -->
  <script type='text/javascript'>
         $('#nuevoSistema').click(function(){
          $('#inputNuevoSistema').toggle('slow');
         });
  </script>
  <!-- Fin JQuery -->
