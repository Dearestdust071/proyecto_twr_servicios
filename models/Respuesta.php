<?php
class Respuesta extends Conectar
{
    public function get_respuesta()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_respuesta;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'respuesta_id' => (int)$d->respuesta_id, 'nombre' => $d->nombre
            ];
        }
        return $Array;
    }

    public function get_respuesta_x_id($respuesta_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
<<<<<<< HEAD
        $sql = "SELECT * FROM tbl_respuesta WHERE id = ?;";
=======
        $sql = "SELECT * FROM tbl_respuesta WHERE respuesta_id = ?;";
>>>>>>> 71d1ce6d0c00c0a8995660b413d1632f7ebb5d8c
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $respuesta_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'respuesta_id' => (int)$resultado->respuesta_id, 'nombre' => $resultado->nombre
        ] : [];
        return $Array;
    }

    public function insert_respuesta($nombre)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_respuesta`(`nombre`) 
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

    public function update_respuesta($nombre,$respuesta_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
<<<<<<< HEAD
        $sql = "UPDATE `tbl_respuesta` SET `nombre`= ? WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(1, $respuesta_id);
=======
        $sql = "UPDATE `tbl_respuesta` SET `nombre`= ? WHERE respuesta_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $respuesta_id);
>>>>>>> 71d1ce6d0c00c0a8995660b413d1632f7ebb5d8c
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_respuesta($respuesta_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
<<<<<<< HEAD
        $sql = "DELETE FROM `tbl_respuesta` WHERE id = ?;";
=======
        $sql = "DELETE FROM `tbl_respuesta` WHERE respuesta_id = ?;";
>>>>>>> 71d1ce6d0c00c0a8995660b413d1632f7ebb5d8c
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $respuesta_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
