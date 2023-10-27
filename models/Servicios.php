<?php
class Servicios extends Conectar
{
    public function get_servicios()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_servicios;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'servicio_id' => (int)$d->servicio_id, 'nombre' => $d->nombre
            ];
        }
        return $Array;
    }

    public function get_servicios_x_id($servicio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_servicios WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $servicio_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'servicio_id' => (int)$resultado->servicio_id, 'nombre' => $resultado->nombre
        ] : [];
        return $Array;
    }

    public function insert_servicios($nombre)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_servicios`(`nombre`) 
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

    public function update_servicios($nombre,$servicio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_servicios` SET `nombre`= ?
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $servicio_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_servicios($servicio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_servicios` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $servicio_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
