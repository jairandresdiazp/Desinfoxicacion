<?php
include_once("./modelo/seguridad.class.php");
$configuracion = parse_ini_file('./modelo/config.ini', true);
$configuraciongeneral = parse_ini_file('./config.ini', true);
$seguridad = new Seguridad();

if ($configuraciongeneral["general"]["Azure"] == false) {
    echo "driver " . $seguridad->Decrypt($configuracion["conexion"]["driver"]);
    echo "</br>host " . $seguridad->Decrypt($configuracion["conexion"]["host"]);
    echo "</br>username " . $seguridad->Decrypt($configuracion["conexion"]["username"]);
    echo "</br>password " . $seguridad->Decrypt($configuracion["conexion"]["password"]);
    echo "</br>database " . $seguridad->Decrypt($configuracion["conexion"]["database"]);
    echo "</br>port " . $seguridad->Decrypt($configuracion["conexion"]["port"]);
} else {
    echo "driver " . $seguridad->Decrypt($configuracion["conexionAzure"]["driver"]);
    echo "</br>host " . $seguridad->Decrypt($configuracion["conexionAzure"]["host"]);
    echo "</br>username " . $seguridad->Decrypt($configuracion["conexionAzure"]["username"]);
    echo "</br>password " . $seguridad->Decrypt($configuracion["conexionAzure"]["password"]);
    echo "</br>database " . $seguridad->Decrypt($configuracion["conexionAzure"]["database"]);
    echo "</br>port " . $seguridad->Decrypt($configuracion["conexionAzure"]["port"]);
}
?>