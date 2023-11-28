<?php
class Preguntas extends Conectar
{
    public function get_preguntas()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_preguntas;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'preguntas_id' => (int)$d->preguntas_id, 'nombre' => $d->nombre
            ];
        }
        return $Array;
    }

    public function get_preguntas_x_id($preguntas_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_preguntas WHERE preguntas_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $preguntas_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'preguntas_id' => (int)$resultado->preguntas_id, 'nombre' => $resultado->nombre
        ] : [];
        return $Array;
    }

    public function insert_preguntas($nombre)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_preguntas`(`nombre`) 
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

    public function update_preguntas($nombre,$preguntas_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_preguntas` SET `nombre`= ? WHERE preguntas_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(1, $preguntas_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_preguntas($preguntas_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_preguntas` WHERE preguntas_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $preguntas_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
