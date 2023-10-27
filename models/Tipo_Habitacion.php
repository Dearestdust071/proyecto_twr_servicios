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
                'tipo_habitacion_id' => (int)$d->tipo_habitacion_id, 'nombre' => $d->nombre
            ];
        }
        return $Array;
    }

    public function get_tipo_habitacion_x_id($tipo_habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_tipo_habitacion WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tipo_habitacion_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'tipo_habitacion_id' => (int)$resultado->tipo_habitacion_id, 'nombre' => $resultado->nombre
        ] : [];
        return $Array;
    }

    public function insert_tipo_habitacion($nombre)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_tipo_habitacion`(`nombre`) 
        VALUES (?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_tipo_habitacion($nombre,$tipo_habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_tipo_habitacion` SET `nombre`= ?
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $tipo_habitacion_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_tipo_habitacion($tipo_habitacion_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_tipo_habitacion` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tipo_habitacion_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
