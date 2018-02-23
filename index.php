<!--
REFERENCIA:
* Head
* Objetos
* Estilos exclusivos
* Alertas
* Div gral
* Footer
* JQuery

-->  

<!--Inicio: Head--> 
<?php
$url_name = "Home";
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
require_once('inc/header.php');
?>
<!--Fin: Head--> 

<!--Inicio: Objetos--> 
<?php
 
?>
<!--Fin: Objetos--> 

<!--Inicio: Estilos exclusivos--> 
          <style type="text/css">
        
          </style>
<!--Fin: Estilos exclusivos--> 

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
   
<!--Inicio: Div gral -->     
 
  <div id="modal" align="center">
   
    <p id='modalp'></div></p>

  </div>
  <div class="container-fluid">
    <div class="row">
       <div class="col-sm-12"  style="text-align: center; ">
        
             <img src="../images/services.jpg" style="width: 30%; margin: 5%;">

      </div>
      
    </div>  
   


<!--Inicio: Div gral -->     

 <!--Inicio: footer -->  
<?php
  require_once('inc/footer.php');
?> 
<!--Fin: footer -->  
