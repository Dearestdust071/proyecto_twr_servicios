<?php
class Pais extends Conectar
{
    public function get_pais()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_pais;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'pais_id' => (int)$d->pais_id, 'nombre' => $d->nombre,'extencion' => $d->extencion
            ];
        }
        return $Array;
    }

    public function get_pais_x_id($pais_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_pais WHERE pais_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $pais_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'pais_id' => (int)$resultado->pais_id, 'nombre' => $resultado->nombre,'extencion' => $resultado->extencion
        ] : [];
        return $Array;
    }

    public function insert_pais($nombre,$extencion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_pais`(`nombre`,`extencion`) 
        VALUES (?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $extencion);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_pais($nombre,$pais_id,$extencion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_pais` SET `nombre`= ? ,`extencion`= ?
        WHERE pais_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $pais_id);
        $sql->bindValue(3, $extencion);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_pais($pais_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_pais` WHERE pais_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $pais_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
