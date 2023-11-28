<?php
class Pago extends Conectar
{
    public function get_pago()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_pago;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'pago_id' => (int)$d->pago_id, 'total' => $d->total,'tbl_reserva_reserva_id' => $d->tbl_reserva_reserva_id,
                'tbl_tarjeta_tarjeta_id' => $d->tbl_tarjeta_tarjeta_id
            ];
        }
        return $Array;
    }
    // public function get_usuarios()
    // {
    //     $db = parent::conexion();
    //     parent::set_names();
    //     $sql = "SELECT * FROM tbl_pago;";
    //     $sql = $db->prepare($sql);
    //     $sql->execute();
    //     $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
    //     $Array = [];
    //     foreach ($resultado as $d) {
    //         $Array[] = [
    //             'pago_id' => (int)$d->pago_id, 'total' => $d->total,'tbl_reserva_reserva_id' => $d->tbl_reserva_reserva_id,
    //             'tbl_tarjeta_tarjeta_id' => $d->tbl_tarjeta_tarjeta_id
    //         ];
    //     }
    //     return $Array;
    // }
    public function get_pago_x_id($pago_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_pago WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $pago_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'pago_id' => (int)$resultado->pago_id, 'total' => $resultado->total,'tbl_reserva_reserva_id' => $resultado->tbl_reserva_reserva_id,
                'tbl_tarjeta_tarjeta_id' => $resultado->tbl_tarjeta_tarjeta_id
        ] : [];
        return $Array;
    }

    public function insert_pago($total,$tbl_reserva_reserva_id,$tbl_tarjeta_tarjeta_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_pago`(`total`,`tbl_reserva_reserva_id`,`tbl_tarjeta_tarjeta_id`) 
        VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $total);
        $sql->bindValue(2, $tbl_reserva_reserva_id);
        $sql->bindValue(3, $tbl_tarjeta_tarjeta_id);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_pago($total,$tbl_reserva_reserva_id,$tbl_tarjeta_tarjeta_id,$pago_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_pago` SET `total`= ? ,`tbl_reserva_reserva_id`= ?, `tbl_tarjeta_tarjeta_id`= ?
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $total);
        $sql->bindValue(2, $tbl_reserva_reserva_id);
        $sql->bindValue(3, $tbl_tarjeta_tarjeta_id);
        $sql->bindValue(4, $pago_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_pago($pago_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_pago` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $pago_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function get_info_reservacion_tarjetas($correo, $password)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT t1.registro_id,
        CONCAT(t1.nombre,' ',t1.apellido_paterno,' ',t1.apellido_materno) AS cliente,
        (SELECT CONCAT('[', GROUP_CONCAT(JSON_OBJECT('reserva_id', t2.reserva_id, 'habitacion_id', 
        t3.habitacion_id, 'nombre_habitacion', t3.nombre)),']')
        FROM tbl_reserva AS t2
        JOIN tbl_habitaciones AS t3 ON t2.tbl_habitaciones_habitacion_id = t3.habitacion_id
        WHERE t2.tbl_registro_registro_id = t1.registro_id  
        AND t2.tbl_registro_registro_id = @usuario_id
        AND NOT EXISTS (SELECT * FROM tbl_pago AS t5 WHERE t5.tbl_reserva_reserva_id = t2.reserva_id)
        ) AS Reservaciones,
        (SELECT CONCAT('[', GROUP_CONCAT(JSON_OBJECT('tarjeta_id', t4.tarjeta_id, 'numero_tarjeta', 
        t4.numero_tarjeta, 'cliente_tarjeta', CONCAT(t4.nombre,' ',t4.apellido_paterno,' ',t4.apellido_materno))),']')
        FROM tbl_tarjeta AS t4
        WHERE t4.tbl_registro_registro_id = t1.registro_id
        AND t4.tbl_registro_registro_id = @usuario_id
        ) AS Tarjetas
    FROM tbl_registro AS t1
    WHERE t1.correo = ?; and password = ?";


        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $correo);
        $sql->bindValue(2, $password);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);

        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'registro_id' => (int)$d->registro_id, 
                'cliente' => $d->cliente,
                'tarjetas' => json_decode($d->Tarjetas),
                'reservaciones' => json_decode($d->Reservaciones)
            ];
        }
        return $Array;
    }
}
