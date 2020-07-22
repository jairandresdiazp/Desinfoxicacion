<?php
session_start();
$jsondata = array();
include_once("../../modelo/conexion.php");
include_once("../../modelo/Log.class.php");
$configuracion = parse_ini_file('../../config.ini', true);
//controlar el debug de los archivos
if($configuracion["general"]["Debug"]==false){
    error_reporting(0);
}
//iniciamos la session 
try
{
	//incluimos el archivo de la clase login
	include_once("../../modelo/tipodocumento-modelo.php");
	//incluimos el archivo de la clase login
	//variable que se encarga de recibir la accion a realizar 
	$accion=$_GET['accion'];
	//creamos un nuevo objeto de la clase
	$tipodocumento= new TipoDocumento();
	//creamos un nuevo objeto de la clase
	$log = new Log();
	//accion definida para llenar un select
	if($accion==1)
	{
		//invocamo el metodo que se encarga de realizar la accion corespondiente
		$resultados=$tipodocumento->Buscar();
		$jsondata['success'] = true;
		$jsondata['code'] = '00014';
		$jsondata['description'] = "select tipodocumento llenado correctamente";
		$jsondata['data']="<option value=''> </option>";
		while($row=$tipodocumento->Siguiente($resultados))
		{
            $jsondata['data']=$jsondata['data']."<option value='".$row['IdTipoDocumento']."'>".$row['Nombre']."</option>";
		}
	}
	//si no se indica el numero de la accion a realizar
	else
	{
		header('Location: ../../page-login');
	}
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
catch(Exception $e)
{
	$log->write('Error en el controlado de acciones tipodocumento '.$e->getMessage());
}
?>