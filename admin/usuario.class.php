<?php
require_once ('../sistema.class.php');

class usuario extends sistema {
    function create ($data) {
        $result = [];
        $this->conexion();
        $rol = $data['rol'];
        $data = $data['data'];
        //Como abrir transacciones
        $this->con->beginTransaction();
        try {
            $hashedPassword = password_hash($data['contrasena'], PASSWORD_BCRYPT);
            $sql = "INSERT INTO usuario(correo, contrasena) 
                    VALUES(:correo, :contrasena);";
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $insertar->bindParam(':contrasena', $hashedPassword, PDO::PARAM_STR);
            $insertar->execute();
            $sql = "SELECT id_usuario FROM usuario WHERE correo = :correo";
            $consulta = $this->con->prepare($sql);
            $consulta->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::PARAM_ASSOC);
            $id_usuario = isset($datos['id_usuario'])? $datos['id_usuario']:null;
            if (!is_null($id_usuario)) {
                foreach ($rol as $r => $k) {
                    $sql = "INSERT INTO usuario_rol(id_usuario, id_rol)
                    VALUES(:id_usuario, :id_rol)";
                    $insertar_rol = $this->con->prepare($sql);
                    $insertar_rol->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $insertar_rol->bindParam(':id_rol', $r, PDO::PARAM_INT);
                    $insertar_rol->execute();
                }
                $this->con->commit();
                $result = $insertar->rowCount();
            }
            return $result;
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return false;
    }
    
    function update ($id, $data) {
        $this->conexion();
        $result = [];
        $hashedPassword = password_hash($data['contrasena'], PASSWORD_BCRYPT);
        $sql = "update usuario set correo=:correo, contrasena=:contrasena
        where id_usuario=:id_usuario;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $modificar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $modificar->bindParam(':contrasena', $hashedPassword, PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    function delete ($id) {
        $result = [];
        $this->conexion();
        if (is_numeric($id)) {
            $sql = "delete from usuario where id_usuario=:id_usuario";
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
        }
        return $result;
    }

    function readOne ($id) {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM usuario where id_usuario=:id_usuario;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_usuario", $id, PDO::PARAM_INT);
        $sql -> execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll(){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM usuario';
        $sql = $this->con->prepare($consulta);
        $sql -> execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAllRoles($id){
        $sql = "SELECT u.*, r.rol FROM usuario u
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                JOIN rol r ON ur.id_rol = r.id_rol
                WHERE u.id_usuario = :id_usuario;";
        $consulta = $this->con->prepare($sql);
        $sql->bindParam(":id_usuario", $id, PDO::PARAM_INT);
        $sql -> execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
}
?>