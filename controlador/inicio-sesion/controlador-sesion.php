<?php
session_start();
$configuracion = parse_ini_file('./config.ini', true);
$Inactividad = $configuracion["sesion"]["TTL"];
if(isset($_SESSION['tiempo'])) 
{
    $TiempoSesion = time() - $_SESSION['tiempo'];
    if($TiempoSesion > $Inactividad || !isset($_SESSION['IdUsuario']))
    {
        //destruimos la session
        session_destroy();
		echo "<script type='text/javascript'>window.location='page-login';</script>";
    }
}
$_SESSION['tiempo'] = time();
if(!isset($_SESSION['IdUsuario']))
{
    session_destroy();
    echo "<script type='text/javascript'>window.location='page-login';</script>";
}
?>