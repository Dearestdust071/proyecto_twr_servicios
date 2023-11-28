<?php
class Municipio extends Conectar
{
    public function get_municipio()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_municipio;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'municipio_id' => (int)$d->municipio_id, 'nombre' => $d->nombre,'tbl_estado_estado_id' => (int)$d->tbl_estado_estado_id
            ];
        }
        return $Array;
    }

    public function get_municipio_x_id($municipio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_municipio WHERE municipio_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $municipio_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'municipio_id' => (int)$resultado->municipio_id, 'nombre' => $resultado->nombre,'tbl_estado_estado_id' => (int)$resultado->tbl_estado_estado_id
        ] : [];
        return $Array;
    }

    public function insert_municipio($nombre,$tbl_estado_estado_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_municipio`(`nombre`,`tbl_estado_estado_id`) 
        VALUES (?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $tbl_estado_estado_id);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_municipio($nombre,$tbl_estado_estado_id,$municipio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_municipio` SET `nombre`= ?,`tbl_estado_estado_id`= ?
        WHERE municipio_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $tbl_estado_estado_id);
        $sql->bindValue(3, $municipio_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_municipio($municipio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_municipio` WHERE municipio_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $municipio_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
