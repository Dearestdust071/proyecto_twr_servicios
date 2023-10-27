<?php
class Habitacion_servicios extends Conectar
{
    public function get_habitacion_servicios()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_habitacion_servicios;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'habitacion_servicios_id' => (int)$d->habitacion_servicios_id, 'id_habitacion' => $d->id_habitacion,
                'id_servicios' => $d->id_servicios,'estatus' => $d->estatus
            ];
        }
        return $Array;
    }

    public function get_habitacion_servicios_x_id($habitacion_servicios_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_habitacion_servicios WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_servicios_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'habitacion_servicios_id' => (int)$resultado->habitacion_servicios_id, 'id_habitacion' => $resultado->id_habitacion,
            'id_servicios' => $resultado->id_servicios,'estatus' => $resultado->estatus
        ] : [];
        return $Array;
    }

    public function insert_habitacion_servicios($id_habitacion,$id_servicios,$estatus)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_habitacion_servicios`(`id_habitacion`,`id_servicios`,`estatus`) 
        VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_habitacion);
        $sql->bindValue(2, $id_servicios);
        $sql->bindValue(3, $estatus);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_habitacion_servicios($id_habitacion,$id_servicios,$estatus,$habitacion_servicios_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_habitacion_servicios` SET `id_habitacion`= ?, SET `id_servicios`= ?, SET `estatus`= ?
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_habitacion);
        $sql->bindValue(2, $id_servicios);
        $sql->bindValue(3, $estatus);
        $sql->bindValue(4, $habitacion_servicios_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_habitacion_servicios($habitacion_servicios_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_habitacion_servicios` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_servicios_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
