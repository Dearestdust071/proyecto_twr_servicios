<?php
class Reserva extends Conectar
{
    public function get_reserva()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_reserva;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'reserva_id' => (int)$d->reserva_id, 'inicio_reserva' => $d->inicio_reserva,
                'fin_reserva' => $d->fin_reservacion,'subtotal' => (int)$d->subtotal,'tbl_pago_pago_id' => (int)$d->tbl_pago_pago_id,
                'tbl_habitaciones_habitacion_id' => (int)$d->tbl_habitaciones_habitacion_id, 'tbl_registro_registro_id' => (int)$d->tbl_registro_registro_id
            ];
        }
        return $Array;
    }

    public function get_reserva_x_id($reserva_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_reserva WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $reserva_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'reserva_id' => (int)$resultado->reserva_id, 'inicio_reserva' => $resultado->inicio_reserva,
                'fin_reserva' => $resultado->fin_reserva,'subtotal' => (int)$resultado->subtotal,'tbl_pago_pago_id' => (int)$resultado->tbl_pago_pago_id,
                'tbl_habitaciones_habitacion_id' => (int)$resultado->tbl_habitaciones_habitacion_id,'tbl_registro_registro_id' => (int)$resultado->tbl_registro_registro_id
        ] : [];
        return $Array;
    }

    public function insert_reserva($inicio_reserva,$fin_reserva,$subtotal,$tbl_pago_pago_id,$tbl_habitaciones_habitacion_id,$tbl_registro_registro_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_reserva`(`inicio_reserva`,`fin_reserva`,`subtotal`,`tbl_pago_pago_id`,`tbl_habitaciones_habitacion_id`,`tbl_registro_registro_id`) 
        VALUES (?,?,?,?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $inicio_reserva);
        $sql->bindValue(2, $fin_reserva);
        $sql->bindValue(3, $subtotal);
        $sql->bindValue(4, $tbl_pago_pago_id);
        $sql->bindValue(5, $tbl_habitaciones_habitacion_id);
        $sql->bindValue(6, $tbl_registro_registro_id);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_reserva($inicio_reserva,$fin_reserva,$subtotal,$tbl_pago_pago_id,$tbl_habitaciones_habitacion_id,$tbl_registro_registro_id,$reserva_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_reserva` SET `inicio_reserva`= ?, `fin_reserva`= ? `subtotal`= ?, `tbl_pago_pago_id`= ?,`tbl_habitaciones_habitacion_id`= ?,`tbl_registro_registro_id`= ?
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $inicio_reserva);
        $sql->bindValue(2, $fin_reserva);
        $sql->bindValue(3, $subtotal);
        $sql->bindValue(4, $tbl_pago_pago_id);
        $sql->bindValue(5, $tbl_habitaciones_habitacion_id);
        $sql->bindValue(6, $tbl_registro_registro_id);
        $sql->bindValue(7, $reserva_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_reserva($reserva_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_reserva` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $reserva_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

}
