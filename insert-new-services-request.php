<?php
	require_once('inc/required.php');
   	$_SESSION['dropBack']           = $_SERVER['REQUEST_URI'];
    $_SESSION['actionsBack']        = $_SERVER['REQUEST_URI'];
?>
<!--Inicio Objetos-->
  <?php
    $questions          = new questions;
    $answers            = new answers;
    $oOpe               = new operaciones();
    $registro_servicio  = new registro_servicio();
  ?>
<!--Fin Objetos-->

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

<!--Inicio Funciones-->
  <?php
    $prioridades  = $oOpe->prioridades();
    $num_pri      = mysql_num_rows($prioridades);
    $contratistas = $oOpe->contratistas();
    $num_cont     = mysql_num_rows($contratistas);
     $contratistasSupervisores = $oOpe->contratistasSupervisores();
    $num_contratistasSupervisores     = mysql_num_rows($contratistasSupervisores);
    $supervisores = $oOpe->supervisores();
    $num_sup      = mysql_num_rows($supervisores);
    @$ID_obr      = 12*((base64_decode($_GET['id']))/12344);
    @$ID_ser      = 12*((base64_decode($_GET['ID_ser']))/12344);
    @$ID_cli      = $_GET['idB'];
    $obras_id     = $oOpe->obras_id($ID_obr);
    $obr_id       = mysql_fetch_assoc($obras_id);
  ?>  
<!--Fin Funciones-->

<!--Inicio Alertas-->
    <?php

    ?>
<!--Fin Alertas-->

<!--Inicio Estilos exclusivos-->
  <style type="text/css">

    #formularioInput
    {
      margin-top: 10px;
    }
    #formularioBoton
    {
      margin: 20px;
      text-align: center;
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


<!-- Inicio Buscador Cliente / Tienda -->
<?php
    //No Modificar estas variables 
    @$id             =  round(12*((base64_decode($_GET['id']))/12344));  // ID_obr
    @$ID_obr         =  $id;        
    @$obr_desc       =  $_GET['dato'];  // obr_desc
    @$cli_marker     =  $_GET['logo'];  // cli_marker
    @$idB            =  round(12*((base64_decode($_GET['idB']))/12344));  // ID_obr
   @$ID_cli         =  $idB; 
    @$cli_desc       =  $_GET['datoB'];  // obr_desc
    if (isset($_GET['id']))
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

<?php 

 if (isset($_GET['id']))
      {
			      	

						echo "<div class='container-fluid'>          
						  <div class='row'> ";
						    
						  ?>
						
						     
						<?php 
						   if (@$_GET['contacto'] ) 
						  {
						    $contacto   = @$_GET['contacto'];
						  }  
						  else
						  {
						     $contacto   = "";
						  }
						   
						  if (@$_GET['mail']) 
						  {  
						    $mail      = @$_GET['mail'];
						  }
						  else
						  {
						    $mail      = "";
						  }

						if (@$_GET['telefono']) 
						  { 
						    $telefono   = @$_GET['telefono'];
						  }  
						  else
						  {
						     $telefono   = "";
						  }
						  ?>

						

						    

						          <?php 
						            $clientes=new clientes();
						            $getClienteByIdObr=$clientes->getClienteByIdObr($ID_obr);
						            $assoc_getClienteByIdObr=mysql_fetch_assoc($getClienteByIdObr);
						            $ID_cli= $assoc_getClienteByIdObr['ID_cli'];
						          ?>

						                 

						   <!--INICIO TROUBLESHOOTING-->
						   <?php 
						      $questions=new questions;
						      $getQuestionsSoloID=$questions->getQuestionsSoloID($ID_cli);
						      $assoc_getQuestionsSoloID=mysql_fetch_assoc($getQuestionsSoloID);
						     
						      if ($assoc_getQuestionsSoloID['ID_cli']==$ID_cli and $garantia=='si') 
						      {
						    ?>
						      	<div class='col-md-12' style='align:center; background-color: #fff; margin-top: 20px; text-align: center;'>
						      			<h4 class='modal-title' id='tituloTroubleshooting' style='margin-top: 20px; text-align: center; margin-bottom: 20px;'>
						               Troubleshooting
						             </h4> 

						             <button class="btn btn-success" id="comienzaTrobleshooting"><i class="material-icons" style="vertical-align: middle;">directions_run</i> Comenzar </button>

						             <div id='preguntasTrobleshooting' style="display: none; margin-bottom: 20px;">
						  
						             <div class='col-md-12'  style='padding-top:20px; border-bottom: 1px solid #333;'>  
						                 <div class='col-md-6'  style='text-align: left;'>
						                    <h4 class='modal-title'>
						                      Troubleshooting    
						                      <i class="material-icons" style="vertical-align: middle;">directions_run</i>
						                   </h4> 
						                    <br>
						                 </div>
						                 <div id='cargandoBoton' class='col-md-6' style='text-align: center; display: none;'>
						                   <i class="material-icons" style="vertical-align: middle;">save</i>
						                      Guardando Respuesta 
						                       <img src=images/cargando4.gif style=' width: 30%; height: auto;' >
						                 </div> 
						              </div>  
						                
						             <div class='col-md-12'  style='padding-top:20px; border-bottom: 1px solid #333;'>  
						                
						                 <?php 
						                      @$qts_madre   = 1;
						                      @$ID_cli      = round(12*((base64_decode($_GET['idB']))/12344));

						       /*  -----------------------------------------------------------------------------------------------
						         Trae todas las preguntas pertenecientes al cliente y que no son madres
						         ----------------------------------------------------------------------------------------------- */                       
						                      $getQuestions = $questions->getQuestions($ID_cli);
						                       $num_getQuestions=mysql_num_rows($getQuestions);

						         /*  -----------------------------------------------------------------------------------------------
						         Trae todas las preguntas pertenecientes al cliente que son madres
						         ----------------------------------------------------------------------------------------------- */               
						                      $getQuestionsMafre=$questions->getQuestionsMafre($ID_cli, $qts_madre);
						                       $num_getQuestionsMafre=mysql_num_rows($getQuestionsMafre);

						                         $getQuestionsMafreC=$questions->getQuestionsMafre($ID_cli, $qts_madre);
						                       $num_getQuestionsMafreC=mysql_num_rows($getQuestionsMafreC);
						      

						                      echo "<div class='col-md-12' id='primeraPregunta' style='text-align:center;'>";

						          /*  -----------------------------------------------------------------------------------------------
						          Utilizado para que coloque por unica vez el titulo de seleccione un item en caso de que la questions sea de tipo dos
						           ----------------------------------------------------------------------------------------------- */  
						                      $getQuestionsMafreB=$questions->getQuestionsMafre($ID_cli, $qts_madre);
						                      $assoc_getQuestionsMafreB=mysql_fetch_assoc($getQuestionsMafreB);
						                        if ($assoc_getQuestionsMafreB['qts_tipo']==2)
						                        {
						                           echo "<h3>Seleccione un Item para Continuar</h3>";
						                        }                      
						                          
						                      echo "<input type='hidden' id='ID_ser' name='ID_ser' value='".$ID_ser."'>";   
						        /*  -----------------------------------------------------------------------------------------------
						          Repite bucle segun la cantidad de preguntas madres
						           ----------------------------------------------------------------------------------------------- */

						                      for ($contadorPreguntasMadres=0; $contadorPreguntasMadres < $num_getQuestionsMafre; $contadorPreguntasMadres++) 
						                     { 
						                        $assoc_getQuestionsMafre=mysql_fetch_assoc($getQuestionsMafre);
						                     
						                       

						          /*  -----------------------------------------------------------------------------------------------
						              Si el tipo de pregunta es 2 muestra las preguntas madres dentro del boton 
						           ----------------------------------------------------------------------------------------------- */
						 

						                            if ($assoc_getQuestionsMafre['qts_tipo']==2)
						                        {

						                          echo '<button class="btn btn-success" id="Boton2'.$assoc_getQuestionsMafre['ID_qts'].''.$assoc_getQuestionsMafre['qts_siguiente1'].'"  value="'.$assoc_getQuestionsMafre['qts_siguiente1'].'">';
						                                   echo $assoc_getQuestionsMafre['qts_desc'] ; 
						                                    echo '<i class="material-icons" style="vertical-align: middle;">
						                                    keyboard_arrow_right
						                                  </i>
						                                </button><br><br>';

						                         echo "<script>
						                              $('#Boton2".$assoc_getQuestionsMafre['ID_qts']."".$assoc_getQuestionsMafre['qts_siguiente1']."').click(function(){
						                                   var valor='#Pregunta'+$(this).val();
						                                  $(valor).toggle('slow');
						                                  $('#primeraPregunta').toggle('slow');

						                                  var aws_desc      = 'Si'
						                                  var ID_qts        = ".$assoc_getQuestionsMafre['ID_qts'].";
						                                  var ID_ser        = ".$ID_ser.";
						                                    $('#cargaexterna').load
						                                    ('RespuestasTroubleshooting.php', {
						                                                    aws_desc: aws_desc,
						                                                    ID_qts: ID_qts,
						                                                    ID_ser: ID_ser
						                                                 
						                                     }, function(){

						                                });
						                              });
						                             
						                          </script>";

						                        }    

						        }  
						                         echo "</div>";

						          
						      
						            /*  -----------------------------------------------------------------------------------------------
						              Luego de las preguntas madres comienzas las preguntas que no son madres
						            ----------------------------------------------------------------------------------------------- */

						                      for ($trouble=0; $trouble <  $num_getQuestions; $trouble++)
						                      { 
						                         $assoc_getQuestions=mysql_fetch_assoc($getQuestions);
						                  

						                         echo "<div class='col-md-12' style='display:none' id='Pregunta".$assoc_getQuestions['ID_qts']."'>";
						                         echo "<input type='hidden' id='ID_serB' name='ID_serB' value='".$ID_ser."'>";
						                         echo "<input type='hidden' id='ID_qtsB' name='ID_qtsB' value='".$assoc_getQuestions['ID_qts']."'>";

						             /*  -----------------------------------------------------------------------------------------------
						              Si el tipo de pregunta es 1 muestra el boton si y no 
						           ----------------------------------------------------------------------------------------------- */                         
						                       if ($assoc_getQuestions['qts_tipo']==1)
						                        { 
						                          $ID_qts=$assoc_getQuestions['ID_qts'];

						                          //BOTON NO

						                           echo "<h3>".$assoc_getQuestions['qts_desc']."</h3>";
						                           echo "<div class='col-md-12' style='text-align:center;'>";
						                          
						                           echo "<div class='col-md-4' style='text-align:center;'>";
						                           echo '<button class="btn btn-danger" id="Boton2B'.$assoc_getQuestions['ID_qts'].''.$assoc_getQuestions['qts_siguiente2'].'" value="'.$assoc_getQuestions['qts_siguiente2'].'">
						                                      <i class="material-icons" style="vertical-align: middle;">
						                                        close
						                                      </i>
						                                       No
						                                    </button>';

						                            echo "</div>"; 

						                                echo "<script>
						                              $('#Boton2B".$assoc_getQuestions['ID_qts']."".$assoc_getQuestions['qts_siguiente2']."').click(function(){
						                                 var valor='#Pregunta'+$(this).val();
						                                   $('#Pregunta".$assoc_getQuestions['ID_qts']."').toggle('slow');
						                                  $(valor).toggle('slow');
						                                 

						                                  var aws_desc      = 'No'
						                                  var ID_qtsB        = ".$assoc_getQuestions['ID_qts'].";
						                                  var ID_serB       = $('#ID_serB').val();

						                                  $('#cargaexterna').load
						                                    ('RespuestasTroubleshooting.php', {
						                                                    aws_desc: aws_desc,
						                                                    ID_qts: ID_qtsB,
						                                                    ID_ser: ID_serB
						                                                 
						                                     }, function(){

						                                });
						                          
						                              });
						                             
						                          </script>";



						                             //BOTON ANTERIOR
						                          
						                           echo "<div class='col-md-4' style='text-align:center;'>";
						                                
						                         
						                      $getQuestionsMadre=$questions->getQuestionsMadre($ID_cli, $assoc_getQuestions['qts_padre']);
						                      
						                       if ($getQuestionsMadre=="si")
						                        {
						                            echo '<button class="btn btn-warning" id="volverAInicio'.$assoc_getQuestions['ID_qts'].'" value="Boton3BB'.$assoc_getQuestions['qts_padre'].'">
						                                      <i class="material-icons" style="vertical-align: middle;">
						                                        keyboard_arrow_left
						                                      </i>
						                                       Anterior
						                                    </button>';

						                              echo "<script>

						                                $('#volverAInicio".$assoc_getQuestions['ID_qts']."').click(function(){
						                                  ID_sta=$(this).val();
						                                   
						                                  $('#Pregunta".$assoc_getQuestions['ID_qts']."').toggle('slow');

						                                   $('#primeraPregunta').toggle('slow');

						                                    var aws_desc      = 'Anterior'
						                                  var ID_qtsB        = ".$assoc_getQuestions['ID_qts'].";
						                                  var ID_serB        = $('#ID_serB').val();
						                                
						                                    $('#cargaexterna').load
						                                    ('RespuestasTroubleshooting.php', {
						                                                    aws_desc: aws_desc,
						                                                    ID_qts: ID_qtsB,
						                                                    ID_ser: ID_serB
						                                                 
						                                     }, function(){

						                                });
						                              });
						                             
						                          </script>";
						                        }
						                        else
						                        {

						                           echo '<button class="btn btn-warning" id="Boton3B'.$assoc_getQuestions['ID_qts'].'" value="'.$assoc_getQuestions['qts_padre'].'">
						                                      <i class="material-icons" style="vertical-align: middle;">
						                                        keyboard_arrow_left
						                                      </i>
						                                       Anterior
						                                    </button>';
						                            echo "<script>
						                              $('#Boton3B".$assoc_getQuestions['ID_qts']."').click(function(){
						                             

						                                   ID_sta=$(this).val();
						                                   var valor='#Pregunta'+$(this).val();
						                                  
						                                  $(valor).toggle('slow');
						                                  $('#Pregunta".$assoc_getQuestions['ID_qts']."').toggle('slow');

						                                    var aws_desc      = 'Anterior'
						                                  var ID_qtsB        = ".$assoc_getQuestions['ID_qts'].";
						                                  var ID_serB        = $('#ID_serB').val();
						                                
						                                    $('#cargaexterna').load
						                                    ('RespuestasTroubleshooting.php', {
						                                                    aws_desc: aws_desc,
						                                                    ID_qts: ID_qtsB,
						                                                    ID_ser: ID_serB
						                                                 
						                                     }, function(){

						                                });
						                              });
						                             
						                          </script>";


						                        } 

						                            echo "</div>"; 

						                             //BOTON SI       

						                                
						                            echo "<div class='col-md-4' style='text-align:center;'>";      
						                              echo '<button class="btn btn-success" id="Boton1B'.$assoc_getQuestions['ID_qts'].''.$assoc_getQuestions['qts_siguiente1'].'" name="Boton1" value="'.$assoc_getQuestions['qts_siguiente1'].'">
						                                      <i class="material-icons" style="vertical-align: middle;">
						                                        done
						                                      </i>
						                                       Si
						                                    </button>';
						                            echo "</div>";        
						                          echo "</div>";

						                            echo "<script>
						                              $('#Boton1B".$assoc_getQuestions['ID_qts']."".$assoc_getQuestions['qts_siguiente1']."').click(function(){
						                                  ID_sta=$(this).val();
						                                   var valor='#Pregunta'+$(this).val();
						                                
						                                  $(valor).toggle('slow');
						                                  $('#Pregunta".$assoc_getQuestions['ID_qts']."').toggle('slow');

						                                 
						                                    var aws_desc      = 'Si'
						                                  var ID_qtsB        = ".$assoc_getQuestions['ID_qts'].";
						                                  var ID_serB        = $('#ID_serB').val();

						                                    $('#cargaexterna').load
						                                    ('RespuestasTroubleshooting.php', {
						                                                    aws_desc: aws_desc,
						                                                    ID_qts: ID_qtsB,
						                                                    ID_ser: ID_serB
						                                                 
						                                     }, function(){

						                                });
						                              });
						                             
						                          </script>";



						                         
						                       }  

						           /*  -----------------------------------------------------------------------------------------------
						              Si el tipo de pregunta es 2 muestra el boton siguiente 
						           ----------------------------------------------------------------------------------------------- */
						 

						                       if ($assoc_getQuestions['qts_tipo']==2)
						                        {
						                             echo '<button class="btn btn-success" id="Boton2'.$assoc_getQuestions['ID_qts'].''.$assoc_getQuestions['qts_siguiente1'].'"  value="'.$assoc_getQuestions['qts_siguiente1'].'">';
						                                   echo $assoc_getQuestions['qts_desc'] ; 
						                                    echo '<i class="material-icons" style="vertical-align: middle;">
						                                    keyboard_arrow_right
						                                  </i>
						                                </button><br><br>';

						                         echo "<script>
						                              $('#Boton2".$assoc_getQuestions['ID_qts']."".$assoc_getQuestions['qts_siguiente1']."').click(function(){
						                                   var valor='#Pregunta'+$(this).val();
						                                  $(valor).toggle('slow');
						                                  $('#primeraPregunta').toggle('slow');

						                                  var aws_desc      = 'Si'
						                                  var ID_qts        = $('#ID_qts').val();
						                                  var ID_ser        = $('#ID_ser').val();
						                                    $('#cargaexterna').load
						                                    ('RespuestasTroubleshooting.php', {
						                                                    aws_desc: aws_desc,
						                                                    ID_qts: ID_qts,
						                                                    ID_ser: ID_ser
						                                                 
						                                     }, function(){

						                                });
						                              });
						                             
						                          </script>";

						                          
						                        }            
						                       
						          /*  -----------------------------------------------------------------------------------------------
						              Si el tipo de pregunta es 3 muestra el boton siguiente 
						           ----------------------------------------------------------------------------------------------- */
						 

						                       if ($assoc_getQuestions['qts_tipo']==3)
						                        {
						                         echo "<h3>".$assoc_getQuestions['qts_desc']."</h3>";
						                         echo "<div class='col-md-12' style='text-align:center;'>";
						                          echo '<button class="btn btn-success" id="Boton3C'.$assoc_getQuestions['ID_qts'].''.$assoc_getQuestions['qts_siguiente1'].'"  value="'.$assoc_getQuestions['qts_siguiente1'].'">
						                                  Siguiente <i class="material-icons" style="vertical-align: middle;">
						                                    keyboard_arrow_right
						                                  </i>
						                                </button>';
						                           echo "</div>";   


						                                echo "<script>
						                              $('#Boton3C".$assoc_getQuestions['ID_qts']."".$assoc_getQuestions['qts_siguiente1']."').click(function(){
						                                 var valor='#Pregunta'+$(this).val();
						                                   $('#Pregunta".$assoc_getQuestions['ID_qts']."').toggle('slow');
						                                  $(valor).toggle('slow');
						                          
						                              });
						                             
						                          </script>";
						                          
						                        }      


						            /*  -----------------------------------------------------------------------------------------------
						              Si el tipo de pregunta es 4 muestra el boton siguiente 
						           ----------------------------------------------------------------------------------------------- */
						 

						                       if ($assoc_getQuestions['qts_tipo']==4)
						                        {

						                            echo "<div class='col-md-12' style='text-align:center;'>";

						                             /*  -----------------------------------------------------------------------------------------------
						                                  muestra pregunta
						                               ----------------------------------------------------------------------------------------------- */
						                         echo "<div class='col-md-12' style='text-align:center;'>";
						                         echo "<h3>".$assoc_getQuestions['qts_desc']."</h3>";
						                         echo "</div>";
						                                //BOTON ANTERIOR
						                          
						                           echo "<div class='col-md-12' style='text-align:center;'>";
						                            
						                              echo "<div class='col-md-6' style='text-align:right;'>";         
						                      $getQuestionsMadre=$questions->getQuestionsMadre($ID_cli, $assoc_getQuestions['qts_padre']);
						                      
						                       if ($getQuestionsMadre=="si")
						                        {
						                            echo '<button class="btn btn-warning" id="volverAInicio'.$assoc_getQuestions['ID_qts'].'" value="Boton3BB'.$assoc_getQuestions['qts_padre'].'">
						                                      <i class="material-icons" style="vertical-align: middle;">
						                                        keyboard_arrow_left
						                                      </i>
						                                       Anterior
						                                    </button>';

						                              echo "<script>

						                                $('#volverAInicio".$assoc_getQuestions['ID_qts']."').click(function(){
						                                  ID_sta=$(this).val();
						                                   
						                                  $('#Pregunta".$assoc_getQuestions['ID_qts']."').toggle('slow');

						                                   $('#primeraPregunta').toggle('slow');

						                                    var aws_desc      = 'Anterior'
						                                  var ID_qtsB        = ".$assoc_getQuestions['ID_qts'].";
						                                  var ID_serB        = $('#ID_serB').val();
						                                
						                                    $('#cargaexterna').load
						                                    ('RespuestasTroubleshooting.php', {
						                                                    aws_desc: aws_desc,
						                                                    ID_qts: ID_qtsB,
						                                                    ID_ser: ID_serB
						                                                 
						                                     }, function(){

						                                });
						                              });
						                             
						                          </script>";
						                        }
						                        else
						                        {

						                           echo '<button class="btn btn-warning" id="Boton3B'.$assoc_getQuestions['ID_qts'].'" value="'.$assoc_getQuestions['qts_padre'].'">
						                                      <i class="material-icons" style="vertical-align: middle;">
						                                        keyboard_arrow_left
						                                      </i>
						                                       Anterior
						                                    </button>';
						                            echo "<script>
						                              $('#Boton3B".$assoc_getQuestions['ID_qts']."').click(function(){
						                             

						                                   ID_sta=$(this).val();
						                                   var valor='#Pregunta'+$(this).val();
						                                  
						                                  $(valor).toggle('slow');
						                                  $('#Pregunta".$assoc_getQuestions['ID_qts']."').toggle('slow');

						                                    var aws_desc      = 'Anterior'
						                                  var ID_qtsB        = ".$assoc_getQuestions['ID_qts'].";
						                                  var ID_serB        = $('#ID_serB').val();
						                                
						                                    $('#cargaexterna').load
						                                    ('RespuestasTroubleshooting.php', {
						                                                    aws_desc: aws_desc,
						                                                    ID_qts: ID_qtsB,
						                                                    ID_ser: ID_serB
						                                                 
						                                     }, function(){

						                                });
						                              });
						                             
						                          </script>";


						                        } 
						                            echo "</div>"; 
						                             echo "<div class='col-md-6' style='text-align:left;'>";     
						                              echo '<button class="btn btn-success" id="agregartrou'.$assoc_getQuestions['ID_qts'].'">
						                                      <i class="material-icons" style="vertical-align: middle;">
						                                        add
						                                      </i> Agregar Troubleshooting
						                                    </button>';
						                              echo "</div>";  
						                            echo "</div>"; 
						                            echo "</div>";

						                            echo "<script>
						                                $('#agregartrou".$assoc_getQuestions['ID_qts']."').click(function(){
						                                
						                                  $('#Pregunta".$assoc_getQuestions['ID_qts']."').toggle('slow');

						                                   $('#primeraPregunta').toggle('slow');

						                              });
						                             
						                          </script>";
						                        }      

						                      

						                     echo "</div>";
						                       
						                       }   

						                 ?>
						               <br><br>
						              <br><br>
						               <br><br>
						              <br><br>
						         <?php     
						           /* Inicio Modal Eliminar */
						             echo '<div class="modal fade" id="EliminarTabla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						                      <div class="modal-dialog" role="document">
						                        <div class="modal-content">
						                           <div class="modal-header">
						                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						                              <h4 class="modal-title" id="myModalLabel">Eliminar Tabla Troubleshooting</h4>
						                            </div>
						                            <div class="modal-body" align="center">
						                              <div class="alert alert-danger" role="alert">
						                                <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¿Esta seguro?</h5>
						                                <p>CUIDADO !!! Usted esta a punto de eliminar una tabla de respuestas guardadas de Troubleshooting</p>
						                              </div>
						                            </div>
						                            <div class="modal-footer">
						                                  <form class="form-horizontal" action="actions-services.php" method="post" enctype="multipart/form-data">
						                                    <input type="hidden" name="action" value="deleteTable" />
						                                    <input type="hidden" name="ID_ser" value="'.$ID_ser.'" />

						                                   <input type="hidden" name="ser_contacto" value="'.$contacto.'">
						                                   <input type="hidden" name="ser_telefono" value="'.$telefono.'">
						                                   <input type="hidden" name="ser_mail"     value="'.$mail.'">
						                                   <input type="hidden" name="ID_cli"       value="'.$ID_cli.'">
						                                   <input type="hidden" name="ID_obr"       value="'.$ID_obr.'">


						                                    <button type="submit" class="btn btn-danger">
						                                      <i class="material-icons" style="vertical-align: middle">
						                                        delete_forever
						                                      </i>
						                                        Eliminar
						                                    </button> 
						                                  </form>
						                                  <br>
						                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						                            </div>
						                          </div>
						                        </div>
						                      </div>
						                    </div>';
						                    /* Fin Modal Eliminar */
						                ?>
						             <div id='cargaexterna'></div>
						              <br><br>
						         </div>     
						  </div>  
						<?php
						      
						      }
						      elseif ( $garantia=='no') 
						      {
						        
						         echo " <div class='col-md-12' style='align:center; background-color: #fff; margin-top: 20px; text-align: center;'><div class='alert alert-warning' role='alert' id='alerta12' name='alerta12' >                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>                      <span aria-hidden='true'>&times;</span>                    </button>                   <h4> <i class='material-icons' style='vertical-align: middle; font-size:20px;'> announcement</i>  Informar al cliente sobre la caducidad de la garantía y proponerle enviar un técnico con costo</h4>  </div> </div>";
						      }    
						           
						          
						   ?>
						  
						<br><br>

						</div>  
						           <!--  
						             Inicio de formulario para describir el problema
						           -->
						 <div class='col-md-12' style='text-align:left; background-color: #fff; margin-top: 20px;'>
						          <form action='actions-services.php' method='POST'>     
						           <input type="hidden" name="ID_ser" value="<?php echo $ID_ser;?>">
						           <input type="hidden" name="action" value="registrar">
						           <input type="hidden" name="ID_cli" value="<?php echo $ID_cli ?>" />
						           <input type="hidden" name="ID_obr" value="<?php echo $ID_obr ?>" />
						        
						             <h4 class='modal-title' id='myModalLabel' style='margin-top: 20px; text-align: center;'>
						                Formulario de Registro de Serivicio
						             </h4>


						      <div class='col-md-4' id='formularioInput'>  
						          <i class="material-icons" style="vertical-align: middle;">
						           contact_phone
						          </i> Contacto:
						        </div> 
						        <div class='col-md-8' id='formularioInput'> 
						          <input type="text" name="ser_contacto" class="form-control" placeholder="<?php echo $contacto;?>">

						        </div> 


						        <div class='col-md-4' id='formularioInput'>  

						          <i class="material-icons" style="vertical-align: middle;" >
						           phone
						           </i> Teléfono:
						        </div> 
						        <div class='col-md-8' id='formularioInput'> 
						          <input type="text" name="ser_telefono" class="form-control" placeholder="<?php echo $telefono;?>">
						        </div> 

						        <div class='col-md-4' id='formularioInput'>  
						          <i class="material-icons" style="vertical-align: middle;">
						           email
						           </i> email: 
						        </div> 
						        <div class='col-md-8' id='formularioInput'> 
						          <input type="text" class="form-control" name="ser_mail" placeholder="<?php echo $mail;?>">
						        </div>

						        <div class='col-md-4' id='formularioInput'>  
						          <i class="material-icons" style="vertical-align: middle;">
						            mode_edit
						          </i> Descripción del problema:
						        </div> 
						        <div class='col-md-8' id='formularioInput'> 

						          <textarea name="ser_desc" cols="50" rows="10"></textarea>
						        </div> 
						       <div class='col-md-4' id='formularioInput'>  
						          <i class="material-icons" style="vertical-align: middle;">
						           receipt</i>
						            Numero de parte:
						        </div>
						        <div class='col-md-8' id='formularioInput'> 
						          <input type="text" name="ser_recCli" class="form-control"></input>
						        </div> 
						        <div class='col-md-4' id='formularioInput'>  
						          <i class="material-icons" style="vertical-align: middle;">
						           person</i>
						            Responsable:
						        </div> 
						        <div class='col-md-8' id='formularioInput'> 
						          <select class="form-control"  name="ser_asig" style="width:172px">
						            <?php
						        echo  '<option value="0" selected>No Asignar</option>';
						        echo  '<option value="20" >Cornu Javier</option>';
						        echo  '<option value="29" >Sosa Carlos</option>';
						      for($a=0; $a<$num_contratistasSupervisores; $a++){
						        $assoc_contratistasSupervisores    = mysql_fetch_assoc($contratistasSupervisores);
						        echo  '<option value="' . $assoc_contratistasSupervisores['ID_usu'] . '">' . $assoc_contratistasSupervisores['usu_apellido'] . ' ' . $assoc_contratistasSupervisores['usu_nombre'] . '</option>';
						      }
						      
						    ?>
						          </select>
						      </div>

						        <div class='col-md-4' id='formularioInput'>  
						          <i class="material-icons" style="vertical-align: middle;">
						           priority_high
						           </i> Prioridad:
						        </div> 
						        <div class='col-md-8' id='formularioInput'> 
						          <select class="form-control"  name="ID_pri" style="width:172px">
						            <?php
						  
						      for($f=0; $f<$num_pri; $f++){
						        $pri      = mysql_fetch_assoc($prioridades);
						        echo  '<option value="' . $pri['ID_pri'] . '">' . $pri['pri_desc'] . '</option>';
						      }
						    ?>
						          </select>
						        </div> 


						       <div class='col-md-12' id='formularioBoton'>  
						       <button type="submit" class="btn btn-success" name="carga" value="Registrar">
						        <i class="material-icons" style="vertical-align: middle;">done</i>
						           Registrar
						        </button>
						       </div>   

						      </form>

						          </div>
							
						<!-- fin div gral -->

<?php
}
?>
 <!-- Inicio footer -->
<?php
require_once ('inc/footer.php');
?>
 <!-- Fin footer -->


<!-- Inicio JQuery -->
 <script type="text/javascript">
   $("#comienzaTrobleshooting").click(function(){
    $("#preguntasTrobleshooting").toggle('slow');
      $("#comienzaTrobleshooting").toggle('slow');
       $("#tituloTroubleshooting").toggle('slow');

   });
 </script>
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

</script>

<!-- Fin JQuery -->
