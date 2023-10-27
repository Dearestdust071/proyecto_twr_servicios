<?php
class Habitaciones extends Conectar
{
    public function get_habitacion()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_habitaciones;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'habitacion_id' => (int)$d->habitacion_id, 'nombre' => $d->nombre,
                'capacidad' => $d->capacidad, 'extencion' => (int)$d->extencion,
                'camas' => (int)$d->camas,'descripcion' => (int)$d->descripcion,
                'fecha_inicio' => (int)$d->fecha_inicio,'fecha_fin' => (int)$d->fecha_fin,
                'opiniones' => (int)$d->opiniones,'comentarios' => (int)$d->comentarios,'subtotal' => (int)$d->subtotal,
                'total' => (int)$d->total,'id_tipo_habitacion' => (int)$d->id_tipo_habitacion
            ];
        }
        return $Array;
    }

    public function get_habitacion_x_id($habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_habitaciones WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'habitacion_id' => (int)$resultado->habitacion_id, 'nombre' => $resultado->nombre,
            'capacidad' => $resultado->capacidad, 'extencion' => $resultado->extencion,
            'camas' => $resultado->camas,'descripcion' => $resultado->descripcion,
            'fecha_inicio' => $resultado->fecha_inicio,'fecha_fin' => $resultado->fecha_fin,'opiniones' => $resultado->opiniones,
            'comentarios' => $resultado->comentarios,'subtotal' => $resultado->subtotal,'total' => $resultado->total,
            'id_tipo_habitacion' => $resultado->id_tipo_habitacion
        ] : [];
        return $Array;
    }

    public function insert_habitacion($nombre, $capacidad, $extencion,
    $camas,$descripcion,$fecha_inicio,$fecha_fin,$opiniones,$comentarios,$subtotal,$total,$id_tipo_habitacion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_habitaciones`(`nombre`, `capacidad`, `extencion`, `camas`
         `descripcion`, `fecha_inicio`, `fecha_fin`, `opiniones`, `comentarios`, `subtotal`, `total`, `id_tipo_habitacion`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $capacidad);
        $sql->bindValue(3, $extencion);
        $sql->bindValue(4, $camas);
        $sql->bindValue(5, $descripcion);
        $sql->bindValue(6, $fecha_inicio);
        $sql->bindValue(7, $fecha_fin);
        $sql->bindValue(8, $opiniones);
        $sql->bindValue(9, $comentarios);
        $sql->bindValue(10, $subtotal);
        $sql->bindValue(11, $total);
        $sql->bindValue(12, $id_tipo_habitacion);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_habitacion($nombre, $capacidad,$extencion,$camas,$descripcion,$fecha_inicio,$fecha_fin,
    $opiniones,$comentarios,$subtotal,$total,$id_tipo_habitacion,$habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_habitaciones` SET `nombre`= ?, `capacidad`= ?, `extencion`= ?,`camas`= ? ,`descripcion`= ?, 
        `fecha_inicio`= ? ,`fecha_fin`= ? ,`opiniones`= ? ,`comentarios`= ? ,`subtotal`= ? ,`total`= ? ,`id_tipo_habitacion`= ? 
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $capacidad);
        $sql->bindValue(3, $extencion);
        $sql->bindValue(4, $camas);
        $sql->bindValue(5, $descripcion);
        $sql->bindValue(6, $fecha_inicio);
        $sql->bindValue(7, $fecha_fin);
        $sql->bindValue(8, $opiniones);
        $sql->bindValue(9, $comentarios);
        $sql->bindValue(10, $subtotal);
        $sql->bindValue(11, $total);
        $sql->bindValue(12, $id_tipo_habitacion);
        $sql->bindValue(13, $habitacion_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_habitacion($habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_habitaciones` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    
}
