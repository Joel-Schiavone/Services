<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');
require_once('modules/operaciones.php');
?>
<head>
  <title>::: newCrm - <?php echo $url_name ?> :::</title>
  <meta charset="utf-8" />
 <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
  <link rel="icon" type="image/png" href="images/logo-epta.png">
  <link rel="stylesheet" href="css/component.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/demo.css">
  <link href="../css/font-awesome.css" rel="stylesheet">
  <link href="../css/motion-ui.min.css" rel="stylesheet"  />
  <link href="css/material-icons.css" rel="stylesheet"> 
  <script src="../js/jquery.js"></script>
  <script src="../js/conditionize.jquery.js"></script>

<!--inicio script para firma canvas de registro_servicio_cierra_usuario.php-->

<script>
    var ongoingTouches = new Array;
    
    function colorForTouch(touch) {
      var id = touch.identifier;
      id = id.toString(16); // make it a hex digit
      return "#" + id + id + id;
    }
    
    function ongoingTouchIndexById(idToFind) {
      for (var i=0; i<ongoingTouches.length; i++) {
        var id = ongoingTouches[i].identifier;
        
        if (id == idToFind) {
          return i;
        }
      }
      return -1;    // not found
    }
    
    function handleStart(evt) {
      evt.preventDefault();
      var el = document.getElementById("canvas");
      var ctx = el.getContext("2d");
      var touches = evt.changedTouches;
            
      for (var i=0; i<touches.length; i++) {
        ongoingTouches.push(touches[i]);
        var color = colorForTouch(touches[i]);
        ctx.fillStyle = color;
        ctx.fillRect(touches[i].pageX-2, touches[i].pageY-2, 4, 4);
      }
    }
  
    function handleMove(evt) {
      evt.preventDefault();
      var el = document.getElementById("canvas");
      var ctx = el.getContext("2d");
      var touches = evt.changedTouches;
      
      ctx.lineWidth = 4;
            
      for (var i=0; i<touches.length; i++) {
        var color = colorForTouch(touches[i]);
        var idx = ongoingTouchIndexById(touches[i].identifier);

        ctx.fillStyle = color;
        ctx.beginPath();
        ctx.moveTo(ongoingTouches[idx].pageX, ongoingTouches[idx].pageY);
        ctx.lineTo(touches[i].pageX, touches[i].pageY);
        ctx.closePath();
        ctx.stroke();
        ongoingTouches.splice(idx, 1, touches[i]);  // swap in the new touch record
      }
    }

    function handleEnd(evt) {
      evt.preventDefault();
      var el = document.getElementById("canvas");
      var ctx = el.getContext("2d");
      var touches = evt.changedTouches;
      
      ctx.lineWidth = 4;
            
      for (var i=0; i<touches.length; i++) {
        var color = colorForTouch(touches[i]);
        var idx = ongoingTouchIndexById(touches[i].identifier);
        
        ctx.fillStyle = color;
        ctx.beginPath();
        ctx.moveTo(ongoingTouches[i].pageX, ongoingTouches[i].pageY);
        ctx.lineTo(touches[i].pageX, touches[i].pageY);
        ongoingTouches.splice(i, 1);  // remove it; we're done
      }
    }
    
    function handleCancel(evt) {
      evt.preventDefault();
      var touches = evt.changedTouches;
      
      for (var i=0; i<touches.length; i++) {
        ongoingTouches.splice(i, 1);  // remove it; we're done
      }
    }

  
    function startup() {
      var el = document.getElementById("canvas");
      el.addEventListener("touchstart", handleStart, false);
      el.addEventListener("touchend", handleEnd, false);
      el.addEventListener("touchcancel", handleCancel, false);
      el.addEventListener("touchleave", handleEnd, false);
      el.addEventListener("touchmove", handleMove, false);
    }
  </script>















<script type="text/javascript">
   

//function comenzar(){
          
  //lienzo = document.getElementsByTagName('canvas')[0];
 // ctx = lienzo.getContext('2d');

  //Dejamos todo preparado para escuchar los eventos
 // document.addEventListener('mousedown',pulsaRaton,false);
 // document.addEventListener('mousemove',mueveRaton,false);
 // document.addEventListener('mouseup',levantaRaton,false);


  //document.addEventListener('touchstart',pulsaRaton,false);
  //document.addEventListener('touchmove',mueveRaton,false);
  //document.addEventListener('touchend',levantaRaton,false);
  //lienzo.addEventListener('mousedown',pulsaRaton,false);
  //lienzo.addEventListener('mousemove',mueveRaton,false);
  //lienzo.addEventListener('mouseup',levantaRaton,false);
}







/*function pulsaRaton(capturo){
  estoyDibujando = true;
  //Indico que vamos a dibujar
  ctx.beginPath();

  //Averiguo las coordenadas X e Y por dónde va pasando el ratón
  ctx.moveTo(capturo.clientX,capturo.clientY);

  //event.prevenDefault();
 // canvas_x=event.targetTouches[0].pageX;
  //canvas_y=event.targetTouches[0].pageY;
}

function mueveRaton(capturo){
  if(estoyDibujando){
    //indicamos el color de la línea
    ctx.strokeStyle='#000';
    //Por dónde vamos dibujando
    ctx.lineTo(capturo.clientX,capturo.clientY);
    ctx.stroke();
  }
}

function levantaRaton(capturo){
  //Indico que termino el dibujo
  ctx.closePath();
  estoyDibujando = false;
}*/


//function upload() {
//$.post('images/firmas/upload-imagen.php',
//{
//img : canvas.toDataURL()
//},
//function(data) {
//$('#imagen').attr('src', '/images/firmas/imagen.png?timestamp=' + new Date().getTime());
//});
//}

    </script>

<!--fin script para firma canvas de registro_servicio_cierra_usuario.php-->

      <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.css" crossorigin="anonymous">
<link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<script src="../js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<style type="text/css">
    body
  {
  width:  100%;
  height: 100%;
  margin: 0;
  border: 0;
  overflow:hidden;
  }


#canvas{
     border: 1px solid  #000;
     box-shadow: 2px 2px 10px #333;
     background-color: #fff;
    /*     overflow-x: auto;*/
    /*overflow-y: hidden;*/
    /*white-space: nowrap;*/
    /*scroll-snap-points-x: snapInterval(0px,100%);*/
    /*scroll-snap-type: mandatory;*/

}



</style>


<body onload="startup()">


<!--Start of Tawk.to Script-->

<?php
  $ID_tas          = round(12*((base64_decode($_GET['id']))/12344), 0);
  $oOpe         = new operaciones();
  $registro_servicio_id = $oOpe->registro_servicio_id_tas($ID_tas);
  $assoc_registro_servicio_id         = mysql_fetch_assoc($registro_servicio_id);
?>

<!-- INICIO CONTENIDO -->

<div style="width: 100%; height:100%; margin: 0px; padding: 0px;">

<!--INICIO: CANVAS-->

<div class="row" style="width: 100%; margin: 0px; padding: 0px;">
  <canvas id="canvas" width="350" height="400"></canvas>  

 <!--FIN: CANVAS-->
 
<!--INICIO: DIV DE BOTON CONTINUAR-->
<div style="width:100%;">
 <form action="registro_firma_cierre_guarda_tasks.php"  method="post" enctype="multipart/form-data">
 <textarea hidden type='text' name='firma' id='input'></textarea>
  <input hidden type='text' name='ID_tas' value='<?php echo $assoc_registro_servicio_id['ID_tas'];?>'/>
     <button id="png" class="btn btn-success" type="submit" name="carga" value="Cerrar" style="width: 100%;">
      <i class="material-icons" style="vertical-align: middle;">
        thumb_up
      </i>
       Continuar
      </button>
  </form>
</div>  

<!--FIN: DIV DE BOTON CONTINUAR-->


<!--INICIO: Instrucciones-->
<p class="bg-success" style="color: red; font-size: 20px; text-align: center;">
  <i class="material-icons" style="vertical-align: middle;">
    warning
  </i>
    Coloque su firma en el recuadro superior y luego presione el botón "Continuar" para finalizar el cierre del servicio. </p>

<!--FIN: Instrucciones-->

<!--INICIO: DIV DE BOTON VOLVER-->

<button  class="btn btn-default" style="float: left; margin-left: 20px;">
    <a href="registro_servicio.php?<?php echo "c=" . base64_encode((12344*($ID_cli))/12) . "&o=" . base64_encode((12344*($ID_obr))/12) . "&z=" . base64_encode((12344*($ser_asig))/12) . "&e=" . base64_encode((12344*($ID_sta))/12) . "" ?>"><i class="material-icons" style="vertical-align: middle;">keyboard_backspace</i> Volver</a>
</button>

<!--FIN: DIV DE BOTON VOLVER-->


<!--<button  value="SALVAR DATOS" /></button>-->

<img hidden src="" id="laimagen"/ value="">

<!--INICIO: DIV DE BOTON SALVAR DATOS-->


<!--<input type="button" onClick="salvarDatos();" value="SALVAR DATOS" />-->

<!--FIN: DIV DE BOTON SALVAR DATOS-->






<script type="text/javascript">


//INICIO: FUNCION QUE GUARDA CANVAS
var png = document.getElementById("png");
png.addEventListener("click",function(){  

},false);

var img = document.getElementById('laimagen');

var png = document.getElementById("png");
png.addEventListener("click",function(){  
  img.src = canvas.toDataURL("image/png"); 
  input.value = canvas.toDataURL("image/png"); 
  textarea.value = canvas.toDataURL("image/png"); 
    var uno=canvas.toDataURL("image/png"); 

},false);



//FIN : FUNCION QUE GUARDA CANVAS
 /* var canvas = document.getElementById('sketchpad');
<script type="text/javascript" charset="utf-8"> 
  window.addEventListener('load',function(){
     
    canvas = document.getElementById('sketchpad');
    var context = canvas.getContext('2d');

 function salvarDatos() {
     var canvasData = canvas.toDataURL("image/png");
       var ajax = new XMLHttpRequest();
       ajax.open("POST",'test.php',false);
       ajax.setRequestHeader('Content-Type', 'application/upload');
       ajax.send(canvasData);
     
     var ajax = new XMLHttpRequest();    
     nombre = document.getElementById('nombre').value;
     numero = document.getElementById('numero').value;
     ajax.open("POST", "testdatos.php",true);
     ajax.onreadystatechange=function() {
    if (ajax.readyState==4) {
      contenedor.innerHTML = ajax.responseText
    }
     }
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  //ajax.send("numero="+numero+"&nombre="+nombre)
  
*/


</script>



