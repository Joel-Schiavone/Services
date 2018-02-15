<?php
session_start();
ob_start();
if (ini_get('register_globals'))
{
    foreach ($_SESSION as $key=>$value)
    {
        if (isset($GLOBALS[$key]))
            unset($GLOBALS[$key]);
    }
}
if (!$_SESSION['estado'] == "conectado"){
	header("Location: login.php?all=1");
	exit();
}
?>