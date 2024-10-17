<?php
require_once ('../sistema.class.php');

class invernadero extends sistema {
    function create ($data) {
        $result = [];
        $this->conexion();
        $sql="INSERT INTO invernadero(invernadero,longitud,latitud,area,fecha_creacion) 
        VALUES(:invernadero,:longitud,:latitud,:area,:fecha_creacion);";
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':invernadero',$data['invernadero'],PDO::PARAM_STR);
        $modificar->bindParam(':longitud',$data['longitud'],PDO::PARAM_STR);
        $modificar->bindParam(':latitud',$data['latitud'],PDO::PARAM_STR);
        $modificar->bindParam(':area',$data['area'],PDO::PARAM_INT);
        $modificar->bindParam(':fecha_creacion',$data['fecha_creacion'],PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    public function update($id, $data) {
        $this->conexion();
        $sql = "UPDATE invernadero SET invernadero = :invernadero, longitud = :longitud, latitud = :latitud, area = :area,fecha_creacion =:fecha_creacion WHERE id_invernadero = :id_invernadero";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':invernadero', $data['invernadero'], PDO::PARAM_STR);
        $modificar->bindParam(':longitud', $data['longitud'], PDO::PARAM_STR);
        $modificar->bindParam(':latitud', $data['latitud'], PDO::PARAM_STR);
        $modificar->bindParam(':area', $data['area'], PDO::PARAM_INT);
        $modificar->bindParam(':id_invernadero', $id, PDO::PARAM_INT);
        $modificar->bindParam(':fecha_creacion',$data['fecha_creacion'],PDO::PARAM_STR);
        return $modificar->execute();
    }    

    function delete ($id) {
        $result = [];
        $this->conexion();
        $sql="delete from invernadero where id_invernadero=:id_invernadero";
        $borrar=$this->con->prepare($sql);
        $borrar->bindParam(':id_invernadero',$id,PDO::PARAM_INT);
        $borrar->execute();
        $result = $borrar->rowCount();
        return $result;
    }

    function readOne($id) {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM invernadero WHERE id_invernadero = :id_invernadero';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(':id_invernadero', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }    

    function readAll(){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM invernadero';
        $sql = $this->con->prepare($consulta);
        $sql -> execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}
?>