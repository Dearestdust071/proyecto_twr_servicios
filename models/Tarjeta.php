<?php
class Tarjeta extends Conectar
{
  public function get_tarjeta()
  {
    $db = parent::conexion();
    parent::set_names();
    $sql = "SELECT * FROM tbl_tarjeta;";
    $sql = $db->prepare($sql);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
    $Array = [];
    foreach ($resultado as $d) {
      $Array[] = [
        'tarjeta_id' => (int)$d->tarjeta_id, 'numero_tarjeta' => $d->numero_tarjeta, 'anio' => $d->anio,
        'mes' => $d->mes, 'cvv' => $d->cvv, 'nombre' => $d->nombre, 'apellido_paterno' => $d->apellido_paterno,
        'apellido_materno' => $d->apellido_materno, 'tipo' => $d->tipo, 'monto' => $d->monto,
        'tbl_registro_registro_id' => $d->tbl_registro_registro_id
      ];
    }
    return $Array;
  }

  public function get_tarjeta_x_id($tarjeta_id)
  {
    $conectar = parent::conexion();
    parent::set_names();
    $sql = "SELECT * FROM tbl_tarjeta WHERE id = ?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $tarjeta_id);
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_OBJ);
    $Array = $resultado ? [
      'tarjeta_id' => (int)$resultado->tarjeta_id, 'numero_tarjeta' => $resultado->numero_tarjeta, 'anio' => $resultado->anio,
      'mes' => $resultado->mes, 'cvv' => $resultado->cvv, 'nombre' => $resultado->nombre, 'apellido_paterno' => $resultado->apellido_paterno,
      'apellido_materno' => $resultado->apellido_materno, 'tipo' => $resultado->tipo, 'monto' => $resultado->monto,
      'tbl_registro_registro_id' => $resultado->tbl_registro_registro_id
    ] : [];
    return $Array;
  }

  public function insert_tarjeta($numero_tarjeta, $anio, $mes, $cvv, $nombre, $apellido_paterno, $apellido_materno, $tipo, $monto, $tbl_registro_registro_id)
  {

    try {
      $conectar = parent::conexion();
      parent::set_names();
      $sql = "INSERT INTO `tbl_tarjeta`(`numero_tarjeta`,`anio`,`mes`,`cvv`,`nombre`,`apellido_paterno`,`apellido_materno`,`tipo`,`monto`,`tbl_registro_registro_id`) 
        VALUES (?,?,?,?,?,?,?,?,?,?);";
      $sql = $conectar->prepare($sql);
      $sql->bindValue(1, $numero_tarjeta);
      $sql->bindValue(2, $anio);
      $sql->bindValue(3, $mes);
      $sql->bindValue(4, $cvv);
      $sql->bindValue(5, $nombre);
      $sql->bindValue(6, $apellido_paterno);
      $sql->bindValue(7, $apellido_materno);
      $sql->bindValue(8, $tipo);
      $sql->bindValue(9, $monto);
      $sql->bindValue(10, $tbl_registro_registro_id);
      $resultado['estatus'] =  $sql->execute();
      $lastInserId =  $conectar->lastInsertId();
      if ($lastInserId != "0") {
        $resultado['id'] = (int)$lastInserId;
      }
      return $resultado;
    } catch (\Throwable $th) {
      echo $th;
      return false;
    }
  }

  public function update_tarjeta($numero_tarjeta, $anio, $mes, $cvv, $nombre, $apellido_paterno, $apellido_materno, $tipo, $monto, $tbl_registro_registro_id, $tarjeta_id)
  {
    $conectar = parent::conexion();
    parent::set_names();
    $sql = "UPDATE `tbl_tarjeta` SET `nombre`= ?
        WHERE id = ?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $numero_tarjeta);
    $sql->bindValue(2, $anio);
    $sql->bindValue(3, $mes);
    $sql->bindValue(4, $cvv);
    $sql->bindValue(5, $nombre);
    $sql->bindValue(6, $apellido_paterno);
    $sql->bindValue(7, $apellido_materno);
    $sql->bindValue(8, $tipo);
    $sql->bindValue(9, $monto);
    $sql->bindValue(10, $tbl_registro_registro_id);
    $sql->bindValue(11, $tarjeta_id);
    $resultado['estatus'] = $sql->execute();
    return $resultado;
  }

  public function delete_tarjeta($tarjeta_id)
  {
    $conectar = parent::conexion();
    parent::set_names();
    $sql = "DELETE FROM `tbl_tarjeta` WHERE id = ?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $tarjeta_id);
    $resultado['estatus'] = $sql->execute();
    return $resultado;
  }

  public function cobrar($numero_tarjeta, $monto)
  {
    $conectar = parent::conexion();
    parent::set_names();
    $sql = "UPDATE `tbl_tarjeta` SET `monto`= ?
        WHERE numero_tarjeta = ?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $monto);
    $sql->bindValue(2, $numero_tarjeta);
    $resultado['estatus'] = $sql->execute();
    return $resultado;
  }
}
