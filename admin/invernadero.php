<?php
require_once ('invernadero.class.php');
$app = new Invernadero;
$app -> checkRole('administrador');
$accion = (isset($_GET['accion']))?$_GET['accion']:null;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch($accion){
    case 'crear':
        include 'views/invernadero/crear.php';
        break;
    case 'nuevo':
        $data=$_POST['data'];
        $resultado= $app->create($data);
        if($resultado){
            $mensaje="El invernadero se agrego correctamente";
            $tipo="success";
        }else{
            $mensaje="Ocurrio un error al agregar el invernadero";
            $tipo="danger";
        }
        $invernaderos = $app->readAll();
        include('views/invernadero/index.php');
        break;
    case 'actualizar':
        $invernaderos=$app->readOne($id);
        include('views/invernadero/crear.php');
        break;

    case 'modificar':
        $data= $_POST['data'];
        $resultado = $app->update($id,$data);
        if($resultado){
            $mensaje="El invernadero se modificó correctamente";
            $tipo="success";
        } else {
            $mensaje="Ocurrió un error al modificar el invernadero";
            $tipo="danger";
        }
        $invernaderos = $app->readAll();
        include('views/invernadero/index.php');
        break;
    case 'eliminar':
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado=$app->delete($id);
                if($resultado){
                    $mensaje="Se elimino exitosamente el invernadero";
                    $tipo="success";
                }else{
                    $mensaje="Hubo un problema con la eliminacion";
                    $tipo="danger";
                }
            }
        }
        $invernaderos = $app->readAll();
        include 'views/invernadero/index.php';
        break;
    default:
        $invernaderos = $app->readAll();
        include 'views/invernadero/index.php';
}
require_once('views/footer.php');
?>