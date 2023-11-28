<?php
class Imagenes_tipo extends Conectar
{
    public function get_imagenes_tipo()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_imagenes_tipo;";
        //$sql = "SELECT imagenes_tipo_id, CONCAT('[', GROUP_CONCAT(JSON_OBJECT('imagen', imagen)),']') AS imagen ,id_tipo_habitacion FROM tbl_imagenes_tipo GROUP BY id_tipo_habitacion;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'imagenes_tipo_id' => (int)$d->imagenes_tipo_id, 'imagen' => $d->imagen, 'id_tipo_habitacion' => (int)$d->id_tipo_habitacion
            ];
        }
        return $Array;
    }

    public function get_imagenes_tipo_x_id($imagenes_tipo_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_imagenes_tipo WHERE  imagenes_tipo_id= ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $imagenes_tipo_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'imagenes_tipo_id' => (int)$resultado->imagenes_tipo_id, 'imagen' => $resultado->imagen,'id_tipo_habitacion' => (int)$resultado->id_tipo_habitacion
        ] : [];
        return $Array;
    }

    public function insert_imagenes_tipo($imagen,$id_tipo_habitacion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $imagen_separada = explode(',',$imagen);
        foreach ($imagen_separada as $i) {
        $imagen2 = $i;
        $sql = "INSERT INTO `tbl_imagenes_tipo`(`imagen`,`id_tipo_habitacion`) 
        VALUES (?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $imagen2);
        $sql->bindValue(2, $id_tipo_habitacion);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
    }
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
        
    }

    public function update_imagenes_tipo($imagen,$id_tipo_habitacion,$imagenes_tipo_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_imagenes_tipo` SET `imagen`= ?, SET `id_tipo_habitacion`= ?
        WHERE imagenes_tipo_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $imagen);
        $sql->bindValue(2, $id_tipo_habitacion);
        $sql->bindValue(3, $imagenes_tipo_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_imagenes_tipo($imagenes_tipo_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_imagenes_tipo` WHERE imagenes_tipo_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $imagenes_tipo_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
