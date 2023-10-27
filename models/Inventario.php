<?php
class Inventario extends Conectar
{
    public function get_inventario()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_inventario;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'inventario_id' => (int)$d->inventario_id, 'nombre' => $d->nombre
            ];
        }
        return $Array;
    }

    public function get_inventario_x_id($inventario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_inventario WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $inventario_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'inventario_id' => (int)$resultado->inventario_id, 'nombre' => $resultado->nombre
        ] : [];
        return $Array;
    }

    public function insert_inventario($nombre)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_inventario`(`nombre`) 
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

    public function update_inventario($nombre,$inventario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_inventario` SET `nombre`= ?
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $inventario_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_inventario($inventario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_inventario` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $inventario_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
