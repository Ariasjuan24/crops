<?php 
require_once ('../sistema.class.php');
$app = new Sistema;
$accion = (isset($_GET['accion']))?$_GET['accion']:null;

switch ($accion) {
    case 'login':
        $correo = $_POST['data']['correo'];
        $contrasena = $_POST['data']['contrasena'];
        if ($app->login($correo, $contrasena)){
            $mensaje = "Bienvenido al sistema";
            $tipo = "success";
            $app -> checkRole('administrador');
            require_once('views/header/header_administrador.php');
            $app->alerta($tipo, $mensaje);
            //Plantilla personalizada de Bienvenida
        }else {
            $mensaje="Correo o contraseña incorrecto 
            <a href='login.php'>[Presione aquí para volver a intentar]<a/>";
            $tipo="danger";
            require_once('views/header.php');
            $app->alerta($tipo, $mensaje);
        }
        break;
     case 'logout':
        $app -> logout();
        break;
    default : 
        include ('views/login/index.php');
        break;
}
include_once('views/footer.php');
?>