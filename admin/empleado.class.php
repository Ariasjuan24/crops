<?php
require_once ('../sistema.class.php');

class empleado extends sistema {
    function create ($data) {
        $result = [];
        $this->conexion();
        $sql = "INSERT INTO empleado(primer_apellido, segundo_apellido, nombre, rfc, id_usuario, fotografia) 
                VALUES( :primer_apellido, :segundo_apellido, :nombre, :rfc, :id_usuario,  :fotografia);";
        $insertar=$this->con->prepare($sql);
        $fotografia = $this->uploadFoto();
        $insertar->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $insertar->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
        $insertar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
        $insertar->bindParam(':fotografia', $fotografia, PDO::PARAM_STR);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data){
        $this->conexion();
        $result=[];
        $tmp="";
        if($_FILES['fotografia']['error']!=4){
            $fotografia=$this->uploadFoto();
            $tmp="fotografia=:fotografia,";
        }
        $sql = 'update empleado set primer_apellido=:primer_apellido, 
                                        segundo_apellido=:segundo_apellido,
                                        nombre=:nombre,
                                        rfc=:rfc,
                                        '.$tmp.'
                                        id_usuario=:id_usuario
                                        where id_empleado=:id_empleado';
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':primer_apellido',$data['primer_apellido'],PDO::PARAM_STR);
        $modificar->bindParam(':segundo_apellido',$data['segundo_apellido'],PDO::PARAM_STR);
        $modificar->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
        $modificar->bindParam(':rfc',$data['rfc'],PDO::PARAM_STR);
        if($_FILES['fotografia']['error']!=4){
            $modificar->bindParam(':fotografia',$fotografia,PDO::PARAM_STR);
        }
        $modificar->bindParam(':id_usuario',$data['id_usuario'],PDO::PARAM_INT);
        $modificar->bindParam(':id_empleado',$id,PDO::PARAM_INT);
        $modificar->execute();
        $result=$modificar->rowCount();
        return $result;
    }
    

    function delete ($id) {
        $result = [];
        $this->conexion();
        if (is_numeric($id)) {
            $sql = "DELETE FROM empleado WHERE id_empleado=:id_empleado";
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam(':id_empleado', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
        }
        return $result;
    }

    function readOne ($id) {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM empleado where id_empleado=:id_empleado;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_empleado", $id, PDO::PARAM_INT);
        $sql -> execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll(){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT e.*, u.correo FROM empleado e JOIN usuario u ON e.id_usuario = u.id_usuario;';
        $sql = $this->con->prepare($consulta);
        $sql -> execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function uploadFoto(){
        $tipos = array("image/jpeg", "image/png", "image/gif");
        $data = $_FILES['fotografia'];
        $default = "default.jpg";
        if ($data['error']==0) {
            if ($data['size']<= 1048576) {
                if (in_array($data['type'], $tipos)) {
                    $n = rand(1, 1000000);
                    $nombre = explode('.', $data['name']);
                    $imagen = md5($n.$nombre[0]).".".$nombre[sizeof($nombre)-1];
                    $origen = $data['tmp_name'];
                    $destino = "C:\\xampp\\htdocs\\crops\\uploads\\".$imagen;
                    if (move_uploaded_file($origen, $destino)) {
                        return $imagen;
                    }
                    return $default;
                }
            }
        }
        return $default;
    }
}
?>