<?php
class Estado extends Conectar
{
    public function get_estado()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_estado;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'estado_id' => (int)$d->estado_id, 'nombre' => $d->nombre,'id_pais' => $d->id_pais
            ];
        }
        return $Array;
    }

    public function get_estado_x_id($estado_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_estado WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $estado_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'estado_id' => (int)$resultado->estado_id, 'nombre' => $resultado->nombre,'id_pais' => $resultado->id_pais
        ] : [];
        return $Array;
    }

    public function insert_estado($nombre,$id_pais)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_estado`(`nombre`,`id_pais`) 
        VALUES (?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_pais);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_estado($nombre,$id_pais,$estado_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_estado` SET `nombre`= ?,`pais_id`= ? 
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_pais);
        $sql->bindValue(3, $estado_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_estado($estado_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_estado` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $estado_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
