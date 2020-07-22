<?php
session_start();
$jsondata = array();
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
    include_once("../../modelo/usuario-modelo.php");
    include_once("../../modelo/sendmail.class.php");
    include_once("../../modelo/seguridad.class.php");
    include_once("../../modelo/templatenotificacion-modelo.php");
    $SendMail             = new SendMail();
    $templteNotificacion = new TemplteNotificacion();
    $seguridad = new Seguridad();
    $reChaptaKey = $configuracion["general"]["reChaptaKey"];
    //incluimos el archivo de la clase login
    //variable que se encarga de recibir la accion a realizar 
    $accion              = $_GET['accion'];
    //creamos un nuevo objeto de la clase
    $usuario             = new Usuario();
    //creamos un nuevo objeto de la clase
    $log                 = new Log();
    //accion definida para que un usuario pueda ser reistrado
    if ($accion == 1) {
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            $secret = $seguridad->Decrypt($reChaptaKey);
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if($responseData->success){
                //enviamos los datos recuperados por medio de los geter y seter a la clase 
                $usuario->setNombre($_POST['register-name']);
                $usuario->setCorreo($_POST['register-mail']);
                $usuario->setFechaNacimiento($_POST['register-date']);
                $usuario->setUserName($_POST['register-username']);
                $usuario->setPass($_POST['register-password']);
                $usuario->setCoeficienteDesinfoxicacion('0');
                $usuario->setIdPerfil($_POST['register-perfil']);
                //invocamo el metodo que se encarga de realizar la accion corespondiente
                if ($usuario->Nuevo() == true) {
                    $templteNotificacion->setCodigo("CrearUsuario");
                    $resultados = $templteNotificacion->Buscar();
                    while ($row = $templteNotificacion->Siguiente($resultados)) {
                        $body   = $row['Body'];
                        $asunto = $row['Asunto'];
                        $body   = str_replace("{nombre}", $usuario->getNombre(), $body);
                        $SendMail->Send($body, $asunto, $usuario->getCorreo());
                    }
                    $jsondata['success'] = true;
                    $jsondata['code'] = '00006';
                    $jsondata['description'] = "usuario creado correctamente";
                } else {
                    $jsondata['success'] = false;
                    $jsondata['code'] = '00007';
                    $jsondata['description'] = "usuario ya existe";
                }
            }
            else{
                $jsondata['success'] = false;
                $jsondata['code'] = '00008';
                $jsondata['description'] = "un robot realiza las peticiones";
            }
        }
        else{
            $jsondata['success'] = false;
            $jsondata['code'] = '00008';
            $jsondata['description'] = "un robot realiza las peticiones";
        }
    }
    else if ($accion == 2) {
        //enviamos los datos recuperados por medio de los geter y seter a la clase 
        $usuario->setIdUsuario($_SESSION['IdUsuario']);
        $usuario->setUserName($_SESSION['UserName']);
        $usuario->setNombre($_POST['perfil-name']);
        $usuario->setCorreo($_POST['perfil-mail']);
        $usuario->setFechaNacimiento($_POST['perfil-date']);
        $usuario->setIdPerfil($_POST['perfil-perfil']);
        //invocamo el metodo que se encarga de realizar la accion corespondiente
        if ($usuario->Editar() == true) {
            $_SESSION['DisplayName'] = $usuario->getNombre();
            $_SESSION['Correo'] = $seguridad->Encrypt($usuario->getCorreo());
            $_SESSION['FechaNacimiento'] = $usuario->getFechaNacimiento();
            $_SESSION['Perfil']      = $usuario->getIdPerfil();
            $_SESSION['tiempo']      = time();
            $jsondata['success'] = true;
            $jsondata['code'] = '00009';
            $jsondata['description'] = "el usuario fue modificado correctamente ";
        } else {
            $jsondata['success'] = false;
            $jsondata['code'] = '00010';
            $jsondata['description'] = "el usuario no fue modificado correctamente ";
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