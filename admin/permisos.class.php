<?php
require_once('../sistema.class.php');

class Permisos extends Sistema {
    function create($data) {
        $this->conexion();
        $sql = "INSERT INTO permiso (permiso) VALUES (:permiso)";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':permiso', $data['permiso'], PDO::PARAM_STR);
        $insertar->execute();
        return $insertar->rowCount();
    }

    function update($id, $data) {
        $this->conexion();
        $sql = "UPDATE permiso SET permiso = :permiso WHERE id_permiso = :id_permiso";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $modificar->bindParam(':permiso', $data['permiso'], PDO::PARAM_STR);
        $modificar->execute();
        return $modificar->rowCount();
    }

    function delete($id) {
        $this->conexion();
        $sql = "DELETE FROM permiso WHERE id_permiso = :id_permiso";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $borrar->execute();
        return $borrar->rowCount();
    }

    function readOne($id) {
        $this->conexion();
        $sql = "SELECT * FROM permiso WHERE id_permiso = :id_permiso";
        $consulta = $this->con->prepare($sql);
        $consulta->bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    function readAll() {
        $this->conexion();
        $sql = "SELECT * FROM permiso";
        $consulta = $this->con->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>