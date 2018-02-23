
<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
@$aws_desc= $_POST['aws_desc'];
 $ID_qts = $_POST['ID_qts'];
$ID_ser = $_POST['ID_ser'];
mysql_query("SET NAMES 'utf8'");
$answers = new answers;

if ($aws_desc=="Anterior")
{
   $dropAnswersByIdSerUltima=$answers->dropAnswersByIdSerUltima($ID_ser);
}
else
{
 $insertAnswers=$answers->insertAnswers($aws_desc, $ID_qts, $ID_ser);
}
  $getAnswers=$answers->getAnswers($ID_ser);
  $num_getAnswers=mysql_num_rows($getAnswers);

echo "<div class='col-md-12' id='Tabla' data-toggle='modal' title='Eliminar' data-placement='top' data-target='#EliminarTabla'>";
     echo "<div class='col-md-12' id='cartelEliminar' style='display:none;'>
                          <div class='alert alert-danger' role='alert' id='alerta12' name='alerta12'>     
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>                    
                          <span aria-hidden='true'>&times;</span>
                        </button>
                        <h4>
                        <i class='material-icons' style='vertical-align: middle; font-size:20px;'> announcement</i>
                          Haga Click Para eliminar la tabla de respuestas guardadas y recomenzar el Troubleshooting</h4>  
                      </div> 
                    </div>";  
  echo "<table class='table table-striped table-responsive' style='text-align:center'>";
    echo "<tr>";
      echo "<td  style='text-align:center'>";
        echo "<h4>Preguntas Realizadas</h4>";
      echo "</td>";
      echo "<td style='text-align:center'>";
        echo "<h4>Respuestas Enviadas</h4>";
      echo "</td>";
    echo "</tr>";


    for ($i=0; $i < $num_getAnswers; $i++)
     { 
      $assoc_getAnswers=mysql_fetch_assoc($getAnswers);
     echo "<tr>";
        echo "<td style='text-align:center'>";
          echo $assoc_getAnswers['qts_desc'];
        echo "</td>";
        echo "<td style='text-align:center'>";
          echo $assoc_getAnswers['aws_desc'];
        echo "</td>";
      echo "</tr>";   
     }
  echo "</table>";
echo "</div>";


require_once('inc/footer.php');



?> 
<script type="text/javascript">
  $("#Tabla").mouseover(function(){
    $("#cartelEliminar").css("display", "block");
     $("#Tabla").css("opacity", "0.8");
  });
  $("#Tabla").mouseout(function(){
    $("#cartelEliminar").css("display", "none");
     $("#Tabla").css("opacity", "1");
  });
  
</script>

