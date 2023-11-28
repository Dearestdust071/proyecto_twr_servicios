<?php
class Habitaciones extends Conectar
{
    public function get_habitacion()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT t1.*, t2.nombre AS Tipo_habitacion
        FROM tbl_habitaciones AS t1
        JOIN tbl_tipo_habitacion AS t2
        ON t2.tipo_habitacion_id = t1.id_tipo_habitacion;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'habitacion_id' => (int)$d->habitacion_id, 'nombre' => $d->nombre,
                'capacidad' => $d->capacidad, 'extencion' => $d->extencion,
                'camas' => $d->camas,'descripcion' => $d->descripcion,'subtotal' => $d->subtotal,
                'total' => $d->total,'id_tipo_habitacion' => (int)$d->id_tipo_habitacion,
                'Tipo_habitacion' => $d->Tipo_habitacion
            ];
        }
        return $Array;
    }

    public function get_habitacion_x_id($habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT t1.*, t2.nombre AS Tipo_habitacion
        FROM tbl_habitaciones AS t1
        JOIN tbl_tipo_habitacion AS t2
        ON t2.tipo_habitacion_id = t1.id_tipo_habitacion
        WHERE habitacion_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'habitacion_id' => (int)$resultado->habitacion_id, 'nombre' => $resultado->nombre,
            'capacidad' => $resultado->capacidad, 'extencion' => $resultado->extencion,
            'camas' => $resultado->camas,'descripcion' => $resultado->descripcion,'subtotal' => $resultado->subtotal,
            'total' => $resultado->total,'id_tipo_habitacion' => (int)$resultado->id_tipo_habitacion,
            'Tipo_habitacion' => $resultado->Tipo_habitacion
        ] : [];
        return $Array;
    }

    public function insert_habitacion($nombre, $capacidad, $extencion,$camas,$descripcion,$subtotal,$total,$id_tipo_habitacion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_habitaciones`(`nombre`, `capacidad`, `extencion`, `camas`,
         `descripcion`,`subtotal`, `total`, `id_tipo_habitacion`) 
        VALUES (?,?,?,?,?,?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $capacidad);
        $sql->bindValue(3, $extencion);
        $sql->bindValue(4, $camas);
        $sql->bindValue(5, $descripcion);
        $sql->bindValue(6, $subtotal);
        $sql->bindValue(7, $total);
        $sql->bindValue(8, $id_tipo_habitacion);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_habitacion($nombre, $capacidad,$extencion,$camas,$descripcion,$subtotal,$total,$id_tipo_habitacion,$habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_habitaciones` SET `nombre`= ?, `capacidad`= ?, `extencion`= ?,`camas`= ? ,
        `descripcion`= ?,`subtotal`= ? ,`total`= ? ,`id_tipo_habitacion`= ? 
        WHERE habitacion_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $capacidad);
        $sql->bindValue(3, $extencion);
        $sql->bindValue(4, $camas);
        $sql->bindValue(5, $descripcion);
        $sql->bindValue(6, $subtotal);
        $sql->bindValue(7, $total);
        $sql->bindValue(8, $id_tipo_habitacion);
        $sql->bindValue(9, $habitacion_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_habitacion($habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_habitaciones` WHERE habitacion_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    
}
