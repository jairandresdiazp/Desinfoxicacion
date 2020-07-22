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
try {
    //incluimos el archivo de la clase login
    include_once("../../modelo/login-modelo.php");
    include_once("../../modelo/sendmail.class.php");
    include_once("../../modelo/seguridad.class.php");
    include_once("../../modelo/templatenotificacion-modelo.php");
    $SendMail             = new SendMail();
    $templteNotificacion = new TemplteNotificacion();
    $seguridad = new Seguridad();
    //incluimos el archivo de la clase login
    //variable que se encarga de recibir la accion a realizar 
    $accion              = $_GET['accion'];
    //creamos un nuevo objeto de la clase
    $login               = new Login();
    //creamos un nuevo objeto de la clase
    $log                 = new Log();
    //accion definida para que un usuario pueda ingresar al sistema
    if ($accion == 1) {
        //enviamos los datos recuperados por medio de los geter y seter a la clase 
        $login->setUserName($_POST['login-username']);
        $login->setClave($_POST['login-password']);
        //invocamo el metodo que se encarga de realizar la accion corespondiente
        if ($login->Iniciar() == true) {
            //iniciamos la variable de session usuario
            $_SESSION['IdUsuario']   = $login->getIdLogin();
            $_SESSION['UserName']    = $login->getUserName();
            $_SESSION['DisplayName'] = $login->getDisplayName();
            $_SESSION['Correo'] = $login->getCorreo();
            $_SESSION['FechaNacimiento'] = $login->getFechaNacimiento();
            $_SESSION['Perfil']      = $login->getPerfil();
            $_SESSION['tiempo']      = time();
            $jsondata['success'] = true;
            $jsondata['code'] = '00001';
            $jsondata['description'] = "usuario logueado correctamente";
        } else {
            $jsondata['success'] = false;
            $jsondata['code'] = '00002';
            $jsondata['description'] = "la combinacion de usuario/clave no es valida";
        }
    }
    //accion definida para destruir una sesion
    else if ($accion == 2) {
        //destruimos la session
        session_destroy();
        header('Location: ../../page-login.php');
    }
    //accion definida para recordar la contraseña
    else if ($accion == 3) {
        //enviamos los datos recuperados por medio de los geter y seter a la clase 
        $login->setUserName($_POST['remenver-username']);
        $jsondata['success'] = false;
        $jsondata['code'] = '00003';
        $jsondata['description'] = "no se envio el correo de recuperacion de clave";
        //invocamo el metodo que se encarga de realizar la accion corespondiente
        $usuarioresult = $login->Buscar();
        while ($rowuser = $login->Siguiente($usuarioresult)) {
            $templteNotificacion->setCodigo("RecuperarClave");
            $resultados = $templteNotificacion->Buscar();
            while ($row = $templteNotificacion->Siguiente($resultados)) {
                $body   = $row['Body'];
                $asunto = $row['Asunto'];
                $body   = str_replace("{nombre}", $rowuser['Nombre'], $body);
                $body   = str_replace("{clave}", $seguridad->Decrypt($rowuser['Pass']), $body);
                $SendMail->Send($body, $asunto, $seguridad->Decrypt($rowuser['Correo']));
                $jsondata['success'] = true;
                $jsondata['code'] = '00004';
                $jsondata['description'] = "se envio el correo de recuperacion de clave";
            }
        }
    }
    else if ($accion == 4) {
        //enviamos los datos recuperados por medio de los geter y seter a la clase 
        $jsondata['success'] = false;
        $jsondata['code'] = '00011';
        $jsondata['description'] = "las claves no coinciden";
        if($_POST['pass-pass1']==$_POST['pass-pass2']){
            $login->setUserName($seguridad->Decrypt($_SESSION['UserName']));
            $log->write('usuario '.$login->getUserName());
            $login->setIdLogin($_SESSION['IdUsuario']);
            $login->setClave($_POST['pass-pass2']);
            //invocamo el metodo que se encarga de realizar la accion corespondiente
             if ($login->Editar() == true) {
                $usuarioresult = $login->Buscar();
                $jsondata['success'] = true;
                $jsondata['code'] = '00012';
                $jsondata['description'] = "se camvio la clave correctamente";
                while ($rowuser = $login->Siguiente($usuarioresult)) {
                    $templteNotificacion->setCodigo("RecuperarClave");
                    $resultados = $templteNotificacion->Buscar();
                    while ($row = $templteNotificacion->Siguiente($resultados)) {
                        $body   = $row['Body'];
                        $asunto = $row['Asunto'];
                        $body   = str_replace("{nombre}", $rowuser['Nombre'], $body);
                        $body   = str_replace("{clave}", $seguridad->Decrypt($rowuser['Pass']), $body);
                        $SendMail->Send($body, $asunto, $seguridad->Decrypt($rowuser['Correo']));
                        $jsondata['success'] = true;
                        $jsondata['code'] = '00013';
                        $jsondata['description'] = "se camvio la clave correctamente y se envio correo con la notificacion";
                    }
                }
             }
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
    $log->write('Error en el controlado de acciones inicio-session ' . $e->getMessage());
}
?>