<?php
class Habitacion_servicios extends Conectar
{
    public function get_habitacion_servicios()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT t1.*,t2.nombre AS Nombre_habitacion,t3.nombre AS Nombre_servicios
        FROM tbl_habitacion_servicios AS t1
        JOIN tbl_habitaciones AS t2
        ON t2.habitacion_id = t1.id_habitacion
        JOIN tbl_servicios AS t3
        ON t3.servicios_id = t1.id_servicios;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'habitacion_servicios_id' => (int)$d->habitacion_servicios_id, 'id_habitacion' => (int)$d->id_habitacion,
                'id_servicios' => (int)$d->id_servicios,'estatus' => $d->estatus,'Nombre_habitacion' => $d->Nombre_habitacion,
                'Nombre_servicios' => $d->Nombre_servicios
            ];
        }
        return $Array;
    }

    public function get_habitacion_servicios_x_id($habitacion_servicios_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT t1.*,t2.nombre AS Nombre_habitacion,t3.nombre AS Nombre_servicios
        FROM tbl_habitacion_servicios AS t1
        JOIN tbl_habitaciones AS t2
        ON t2.habitacion_id = t1.id_habitacion
        JOIN tbl_servicios AS t3
        ON t3.servicios_id = t1.id_servicios
        WHERE habitacion_servicios_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_servicios_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'habitacion_servicios_id' => (int)$resultado->habitacion_servicios_id, 'id_habitacion' => (int)$resultado->id_habitacion,
            'id_servicios' => (int)$resultado->id_servicios,'estatus' => $resultado->estatus,'Nombre_habitacion' => $resultado->Nombre_habitacion,
            'Nombre_servicios' => $resultado->Nombre_servicios
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
        $sql = "UPDATE `tbl_habitacion_servicios` SET `id_habitacion`= ?,`id_servicios`= ?,`estatus`= ?
        WHERE habitacion_servicios_id = ?;";
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
        $sql = "DELETE FROM `tbl_habitacion_servicios` WHERE habitacion_servicios_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_servicios_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
