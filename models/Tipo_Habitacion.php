<?php
class Tipo_habitacion extends Conectar
{
    public function get_tipo_habitacion()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_tipo_habitacion;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'tipo_habitacion_id' => (int)$d->tipo_habitacion_id, 'nombre' => $d->nombre,'descripcion' => $d->descripcion,
                'rango_precios' => $d->rango_precios
            ];
        }
        return $Array;
    }

    public function get_tipo_habitacion_x_id($tipo_habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_tipo_habitacion WHERE tipo_habitacion_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tipo_habitacion_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'tipo_habitacion_id' => (int)$resultado->tipo_habitacion_id, 'nombre' => $resultado->nombre,'descripcion' => $resultado->descripcion,
            'rango_precios' => $resultado->rango_precios
        ] : [];
        return $Array;
    }

    public function insert_tipo_habitacion($nombre,$descripcion,$rango_precios)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_tipo_habitacion`(`nombre`,`descripcion`,`rango_precios`) 
        VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $rango_precios);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_tipo_habitacion($nombre,$descripcion,$rango_precios,$tipo_habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_tipo_habitacion` SET `nombre`= ?,`descripcion`= ?,`rango_precios`= ?
        WHERE tipo_habitacion_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $rango_precios);
        $sql->bindValue(4, $tipo_habitacion_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_tipo_habitacion($tipo_habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_tipo_habitacion` WHERE tipo_habitacion_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tipo_habitacion_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
