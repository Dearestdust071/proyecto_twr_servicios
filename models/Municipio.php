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
                'municipio_id' => (int)$d->municipio_id, 'nombre' => $d->nombre,'id_estado' => $d->id_estado
            ];
        }
        return $Array;
    }

    public function get_municipio_x_id($municipio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_municipio WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $municipio_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'municipio_id' => (int)$resultado->municipio_id, 'nombre' => $resultado->nombre,'id_estado' => $resultado->id_estado
        ] : [];
        return $Array;
    }

    public function insert_municipio($nombre,$id_estado)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_municipio`(`nombre`,`id_estado`) 
        VALUES (?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_estado);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_municipio($nombre,$id_estado,$municipio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_municipio` SET `nombre`= ?,`id_estado`= ?
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_estado);
        $sql->bindValue(3, $municipio_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_municipio($municipio_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_municipio` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $municipio_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
