<?php
require_once ('rol.class.php');
$app = new rol;
$app -> checkRole('administrador');
$accion = (isset($_GET['accion']))?$_GET['accion']:null;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch($accion){
    case 'crear':
        include 'views/rol/crear.php';
        break;
    case 'nuevo':
        $data=$_POST['data'];
        $resultado= $app->create($data);
        if($resultado){
            $mensaje="El rol se agrego correctamente";
            $tipo="success";
        }else{
            $mensaje="Ocurrio un error al agregar el rol";
            $tipo="danger";
        }
        $roles = $app->readAll();
        include('views/rol/index.php');
        break;
    case 'actualizar':
        $roles=$app->readOne($id);
        include('views/rol/crear.php');
        break;

    case 'modificar':
        $data= $_POST['data'];
        $resultado = $app->update($id,$data);
        if($resultado){
            $mensaje="El rol se modificó correctamente";
            $tipo="success";
        } else {
            $mensaje="Ocurrió un error al modificar el rol";
            $tipo="danger";
        }
        $roles = $app->readAll();
        include('views/rol/index.php');
        break;
    case 'eliminar':
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado=$app->delete($id);
                if($resultado){
                    $mensaje="Se elimino exitosamente el rol";
                    $tipo="success";
                }else{
                    $mensaje="Hubo un problema con la eliminacion";
                    $tipo="danger";
                }
            }
        }
        $roles = $app->readAll();
        include 'views/rol/index.php';
        break;
    default:
        $roles = $app->readAll();
        include 'views/rol/index.php';
}
require_once('views/footer.php');
?>