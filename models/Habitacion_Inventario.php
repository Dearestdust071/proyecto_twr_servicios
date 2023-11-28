<?php
class Habitacion_Inventario extends Conectar
{
    public function get_HabitacionInventario()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT t1.*,t2.nombre AS Nombre_habitacion,t3.nombre AS Nombre_inventario
        FROM tbl_habitacion_inventario AS t1
        JOIN tbl_habitaciones AS t2
        ON t2.habitacion_id = t1.id_habitacion
        JOIN tbl_inventario AS t3
        ON t3.inventario_id = t1.id_inventario;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'habitacion_inventario_id' => (int)$d->habitacion_inventario_id, 'id_habitacion' => (int)$d->id_habitacion,
                'id_inventario' => (int)$d->id_inventario,'estatus' => $d->estatus,'Nombre_habitacion' => $d->Nombre_habitacion,
                'Nombre_inventario' => $d->Nombre_inventario
            ];
        }
        return $Array;
    }

    public function get_HabitacionInventario_x_id($habitacion_inventario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT t1.*,t2.nombre AS Nombre_habitacion,t3.nombre AS Nombre_inventario
        FROM tbl_habitacion_inventario AS t1
        JOIN tbl_habitaciones AS t2
        ON t2.habitacion_id = t1.id_habitacion
        JOIN tbl_inventario AS t3
        ON t3.inventario_id = t1.id_inventario
        WHERE habitacion_inventario_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_inventario_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'habitacion_inventario_id' => (int)$resultado->habitacion_inventario_id, 'id_habitacion' => (int)$resultado->id_habitacion,
            'id_inventario' => (int)$resultado->id_inventario,'estatus' => $resultado->estatus,'Nombre_habitacion' => $resultado->Nombre_habitacion,
            'Nombre_inventario' => $resultado->Nombre_inventario
        ] : [];
        return $Array;
    }

    public function insert_HabitacionInventario($id_habitacion,$id_inventario,$estatus)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_habitacion_inventario`(`id_habitacion`,`id_inventario`,`estatus`) 
        VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_habitacion);
        $sql->bindValue(2, $id_inventario);
        $sql->bindValue(3, $estatus);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_HabitacionInventario($id_habitacion,$id_inventario,$estatus,$habitacion_inventario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_habitacion_inventario` SET `id_habitacion`= ?,`id_inventario`= ?,`estatus`= ?
        WHERE habitacion_inventario_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_habitacion);
        $sql->bindValue(2, $id_inventario);
        $sql->bindValue(3, $estatus);
        $sql->bindValue(4, $habitacion_inventario_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_HabitacionInventario($habitacion_inventario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_habitacion_inventario` WHERE habitacion_inventario_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $habitacion_inventario_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
