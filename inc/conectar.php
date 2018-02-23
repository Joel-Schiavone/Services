<?php
$link = mysql_connect('localhost', 'aHqsc', 'aHqsc22.,00oaH');
if (!$link) {
    die('No se puede conectar a la base de datos: ' . mysql_error());
}
mysql_select_db("travel_expenses",$link);
?>