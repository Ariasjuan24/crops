<?php
require_once ('../sistema.class.php');

class rol extends sistema {
    function create ($data) {
        $result = [];
        $this->conexion();
        $sql="INSERT INTO rol(rol) 
        VALUES(:rol);";
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':rol',$data['rol'],PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    public function update($id, $data) {
        $this->conexion();
        $sql = "UPDATE rol SET rol = :rol WHERE id_rol = :id_rol";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_rol', $id, PDO::PARAM_INT);
        return $modificar->execute();
    }    

    function delete ($id) {
        $result = [];
        $this->conexion();
        $sql="delete from rol where id_rol=:id_rol";
        $borrar=$this->con->prepare($sql);
        $borrar->bindParam(':id_rol',$id,PDO::PARAM_INT);
        $borrar->execute();
        $result = $borrar->rowCount();
        return $result;
    }

    function readOne($id) {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM rol WHERE id_rol = :id_rol';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }    

    function readAll(){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM rol';
        $sql = $this->con->prepare($consulta);
        $sql -> execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}
?>