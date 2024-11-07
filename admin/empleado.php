<?php
require_once ('empleado.class.php');
require_once('usuario.class.php');
$appusuario = new usuario();
$app = new empleado();
$app -> checkRole('administrador');
$accion = (isset($_GET['accion']))?$_GET['accion']:null;

$id = (isset($_GET['id']))?$_GET['id']:null;
switch($accion){
    case 'crear':
        $usuarios = $appusuario->readAll();
        include 'views/empleado/crear.php';
        break;
    case 'nuevo':
        
        $data=$_POST['data'];
        $resultado = $app->create($data);
        if($resultado) {
            $mensaje = "El empleado fue dado de alta exitosamente.";
            $tipo = "success";
        }else{
            $mensaje = "Ocurrio un error al agregar al empleado.";
            $tipo = "danger";
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    case 'actualizar':
        $empleados = $app->readOne($id);
        $usuarios = $appusuario->readAll();
        include('views/empleado/crear.php');
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if($resultado) {
            $mensaje = "El empleado se actualizo exitosamente.";
            $tipo = "success";
        }else{
            $mensaje = "Ocurrio un error al actualizar al empleado.";
            $tipo = "danger";
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    case 'eliminar':
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado = $app->delete($id);
                if($resultado){
                    $mensaje = "El empleado se elimino correctamente.";
                    $tipo = "success";
                }else{
                    $mensaje = "Ocurrio un error con la eliminacion.";
                    $tipo = "danger";
                }
            }
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    default:
        $empleados = $app->readAll();
        include 'views/empleado/index.php';
}
require_once('views/footer.php');
?>