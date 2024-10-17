<?php
require_once ('seccion.class.php');
require_once('invernadero.class.php');
$appinvernadero = new invernadero();
$app = new seccion();
$app -> checkRole('administrador');
$accion = (isset($_GET['accion']))?$_GET['accion']:null;

$id = (isset($_GET['id']))?$_GET['id']:null;
switch($accion){
    case 'crear':
        $invernaderos = $appinvernadero->readAll();
        include 'views/seccion/crear.php';
        break;
    case 'nuevo':
        $data=$_POST['data'];
        $resultado = $app->create($data);
        if($resultado) {
            $mensaje = "La sección fue dado de alta exitosamente.";
            $tipo = "success";
        }else{
            $mensaje = "Ocurrio un error al agregar la sección.";
            $tipo = "danger";
        }
        $secciones = $app->readAll();
        include('views/seccion/index.php');
        break;
    case 'actualizar':
        $secciones = $app->readOne($id);
        $invernaderos = $appinvernadero->readAll();
        include('views/seccion/crear.php');
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if($resultado) {
            $mensaje = "La sección se actualizo exitosamente.";
            $tipo = "success";
        }else{
            $mensaje = "Ocurrio un error al actualizar la seccion.";
            $tipo = "danger";
        }
        $secciones = $app->readAll();
        include('views/seccion/index.php');
        break;
    case 'eliminar':
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado = $app->delete($id);
                if($resultado){
                    $mensaje = "La seccion se elimino correctamente.";
                    $tipo = "success";
                }else{
                    $mensaje = "Ocurrio un error con la eliminacion.";
                    $tipo = "danger";
                }
            }
        }
        $secciones = $app->readAll();
        include('views/seccion/index.php');
        break;
    default:
        $secciones = $app->readAll();
        include 'views/seccion/index.php';
}
require_once('views/footer.php');
?>