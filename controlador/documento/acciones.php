<?php
session_start();
$jsondata      = array();
$configuracion = parse_ini_file('../../config.ini', true);
include_once("../../modelo/conexion.php");
include_once("../../modelo/Log.class.php");
//controlar el debug de los archivos
if($configuracion["general"]["Debug"]==false){
    error_reporting(0);
}
//iniciamos la session 
try {
    //incluimos el archivo de la clase
    include_once("../../modelo/documento-modelo.php");
    include_once("../../modelo/seguridad.class.php");
    $seguridad           = new Seguridad();
    $reChaptaKey         = $configuracion["general"]["reChaptaKey"];
    $PathDocument        = $configuracion["general"]["PathDocument"];
    $MaxFileSieze        = $configuracion["general"]["MaxFileSieze"];
    $Extension           = $configuracion["general"]["Extension"];
    $Extension           = explode(";", $Extension);
    //incluimos el archivo de la clase login
    //variable que se encarga de recibir la accion a realizar 
    $accion              = $_GET['accion'];
    //creamos un nuevo objeto de la clase
    $documento           = new Documento();
    //creamos un nuevo objeto de la clase
    $log                 = new Log();
    //accion definida para cargar un documento
    if ($accion == 1) {
        if (isset($_GET['g-recaptcha-response']) && !empty($_GET['g-recaptcha-response'])) {
            $secret         = $seguridad->Decrypt($reChaptaKey);
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_GET['g-recaptcha-response']);
            $responseData   = json_decode($verifyResponse);
            if ($responseData->success) {
                //enviamos los datos recuperados por medio de los geter y seter a la clase 
                $documento->setNombreDocumento($_GET['add-document-name']);
                $documento->setAutores($_GET['add-document-autor']);
                $documento->setPalabrasClave($_GET['add-document-palabras-clave']);
                date_default_timezone_set('America/Bogota');
                $date = new DateTime();
                $documento->setURL($_GET['add-document-url']);
                $FileExtension = explode(".", $_FILES['add-document-ruta']['name']);
                $FileExtension = $FileExtension[(count($FileExtension) - 1)];
                $dir  = $_SERVER['DOCUMENT_ROOT'] . "/" . $PathDocument . "/" . $date->format('Y-m-d') . "/";
                $DocumentName=sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)).".".$FileExtension;
                $path = $dir . $DocumentName;
                $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
                $URL="http".$s."://" .$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/" . $PathDocument . "/" . $date->format('Y-m-d') . "/".$DocumentName;
                $documento->setRuta($seguridad->Encrypt($URL));
                $documento->setAnoPublicacion($_GET['add-document-date']);
                $documento->setIdTipoDocumento($_GET['add-document-tipo']);
                $documento->setIdUsuario($_SESSION['IdUsuario']);
                //invocamo el metodo que se encarga de realizar la accion corespondiente
                if ($_FILES['add-document-ruta']['size'] > $MaxFileSieze) {
                    $jsondata['success']     = false;
                    $jsondata['code']        = '00017';
                    $jsondata['description'] = "el documento no cumple con el tamaño " . $MaxFileSieze;
                } else if (!in_array($FileExtension, $Extension)) {
                    $jsondata['success']     = false;
                    $jsondata['code']        = '00018';
                    $jsondata['description'] = "el documento no cumple con el tipo " . implode(";", $Extension);
                } else {
                    if ($documento->Nuevo() == true) {
                        if ($_FILES['add-document-ruta']['size'] > 0) {
                            if (is_dir($dir)) {
                                if (move_uploaded_file($_FILES['add-document-ruta']['tmp_name'], $path)) {
                                    $jsondata['success']     = true;
                                    $jsondata['code']        = '00015';
                                    $jsondata['description'] = "documento cargado exitosamente ";
                                } else {
                                    $jsondata['success']     = false;
                                    $jsondata['code']        = '00016';
                                    $jsondata['description'] = "el documento no se pudo cargar ";
                                }
                            } else {
                                if (mkdir($dir, 0777, true) === true) {
                                    if (move_uploaded_file($_FILES['add-document-ruta']['tmp_name'], $path)) {
                                        $jsondata['success']     = true;
                                        $jsondata['code']        = '00015';
                                        $jsondata['description'] = "documento cargado exitosamente ";
                                    } else {
                                        $jsondata['success']     = false;
                                        $jsondata['code']        = '00016';
                                        $jsondata['description'] = "el documento no se pudo cargar ";
                                    }
                                }
                            }
                        } else {
                            $jsondata['success']     = true;
                            $jsondata['code']        = '00015';
                            $jsondata['description'] = "documento cargado exitosamente ";
                        }
                    } else {
                        $jsondata['success']     = false;
                        $jsondata['code']        = '00016';
                        $jsondata['description'] = "el documento no se pudo cargar ";
                    }
                }
            } else {
                $jsondata['success']     = false;
                $jsondata['code']        = '00008';
                $jsondata['description'] = "un robot realiza las peticiones";
            }
        } else {
            $jsondata['success']     = false;
            $jsondata['code']        = '00008';
            $jsondata['description'] = "un robot realiza las peticiones";
        }
    }
    //accion definida para listar los documentos con un flitro de busqueda
    else if ($accion == 2){
        if($_GET["userself"]=="1"){
            $documento->setIdUsuario($_SESSION['IdUsuario']);
        }else{
            $documento->setIdUsuario("");
        }
        $documento->setNombreDocumento($_POST['get-document-name']);
        $documento->setPalabrasClave($_POST['get-document-palabras-clave']);
        $documento->setAutores($_POST['get-document-autor']);
        $documento->setAnoPublicacion($_POST['get-document-date']);
        $documento->setIdTipoDocumento($_POST['get-document-tipo']);
        $resultados=$documento->Buscar();
        $conresultados=false;
		$jsondata['code'] = '00018';
		$jsondata['description'] = "documentos filtrados correctamente en el menu get-documents";
		$jsondata['data']="<h2 class='content-sub-heading'>Resultados</h2><div id='card-result' class='card-wrap'>";
        while($row=$documento->Siguiente($resultados))
		{
            $conresultados=true;
            $borrar="";
            if($row['UserName']==$_SESSION['UserName'] ){
                $borrar="<li><a onclick=\"borrar('".$row['IdDocumento']."')\"><span class='access-hide'>Borrar</span><span class='icon icon-delete'></span></a></li>";
            }
            $jsondata['data']=$jsondata['data']."<div class='col-lg-12 col-md-12 col-sm-12'><div class='card card-alt'><div class='card-main'><div class='card-inner'><p class='card-heading text-alt'>".$row['NombreDocumento']."</p><p><strong>Autores:</strong> ".$row['Autores']."<br/><strong>Palabras Clave:</strong> ".$row['PalabrasClave']."<br/><strong>URL:</strong> <a href='".$row['URL']."' target='_blank'>".$row['URL']."</a><br/><strong>Año Publicacion:</strong> ".$row['AnoPublicacion']."<br/><strong>Tipo Documento:</strong> ".$row['TipoDocumento']."<br/><strong>Usuario:</strong> ".$seguridad->Decrypt($row['UserName'])."</p></div><div class='card-action'><ul class='nav nav-list pull-left'>".$borrar."<li><a data-toggle='modal' href='#modal-puntear-documento' onclick=\"puntear('".$row['IdDocumento']."')\"><span class='access-hide'>Puntear</span><span class='icon icon-thumbs-up-down'></span></a></li><li><a data-toggle='modal' href='#modal-ver-documento' onclick=\"mostrar('".($seguridad->Decrypt($row['Ruta']))."')\"><span class='access-hide'>Ver</span><span class='icon icon-remove-red-eye'></span></a></li></ul></div></div></div></div>";
		}
        $jsondata['data']=$jsondata['data']."</div>";
        if($conresultados){
            $jsondata['success'] = true;
        }else{
            $jsondata['success'] = false;
            $jsondata['data']="";
        }
    }
    //accion definida para eliminar un documento especifico
    else if ($accion == 3){
        $documento->setIdDocumento($_POST['get-document-id']);
        if($documento->Eliminar()){
            $jsondata['success']     = true;
            $jsondata['code']        = '00019';
            $jsondata['description'] = "el documento se elimino correctamente";
        }
        else{
            $jsondata['success']     = false;
            $jsondata['code']        = '00020';
            $jsondata['description'] = "error eliminando el documento";
        }
    }
    //accion definida para puentear los documentos
    else if ($accion == 4){
        //$_POST['puntear-document-puntos']
        //$_POST['puntear-document-id']

        $jsondata['success']     = true;
        $jsondata['code']        = '00021';
        $jsondata['description'] = "se punteo correctamente el documento ";
    }
    //accion definida para listar los documentos con un flitro de busqueda
    else if ($accion == 5){
        $documento->setIdUsuario("");
        $documento->setNombreDocumento($_POST['menu-search']);
        $documento->setPalabrasClave("");
        $documento->setAutores("");
        $documento->setAnoPublicacion("");
        $documento->setIdTipoDocumento("");
        $resultados=$documento->Buscar();
        $conresultados=false;
		$jsondata['code'] = '00022';
		$jsondata['description'] = "documentos filtrados correctamente en el menu form-quick-search";
		$jsondata['data']="<p><strong>Resultados:</strong></p><ul>";
        $count=0;
        while($row=$documento->Siguiente($resultados))
		{
            if($count<=10){
                $jsondata['data']=$jsondata['data']."<li><a href='https://docs.google.com/gview?url=".($seguridad->Decrypt($row['Ruta']))."&embedded=true' target='_blank'>".$row['NombreDocumento']."</a></li>";
                $conresultados=true;
                $count++;
            }
		}
        $jsondata['data']=$jsondata['data']."</ul>";
        if($conresultados){
            $jsondata['success'] = true;
        }else{
            $jsondata['success'] = false;
            $jsondata['data']="";
        }
    }
    //si no se indica el numero de la accion a realizar
    else {
        header('Location: ../../page-login');
    }
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
catch (Exception $e) {
    $log->write('Error en el controlado de acciones usuario ' . $e->getMessage());
}
?>