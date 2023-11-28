<?php
class Registro extends Conectar
{
    public function get_registro()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_registro;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id' => (int)$d->id, 'nombre' => $d->nombre,
                'apellido_paterno' => $d->apellido_paterno, 'apellido_materno' => (int)$d->apellido_materno,
                'fecha_nacimiento' => (int)$d->fecha_nacimiento,'correo' => (int)$d->correo,
                'telefono' => (int)$d->telefono,'usuario' => (int)$d->usuario,
                'password' => (int)$d->password,'acceso' => (int)$d->acceso,'estatus' => (int)$d->estatus,
                'id_pais' => (int)$d->id_pais,'id_estado' => (int)$d->id_estado,'id_municipio' => (int)$d->id_municipio
            ];
        }
        return $Array;
    }


    public function check_user($correo,$password)
    {
        $conectar = parent::conexion();
        parent::set_names();
        // correo, password FROM
        $sql = "SELECT * FROM tbl_registro WHERE correo = ? AND password = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $correo);
        $sql->bindValue(2, $password);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        
            if($resultado->correo == $correo && $resultado->password == $password){
                // echo "Todo salio de acuerdo al plan (se encontro el correo)";
            $Array = $resultado ? [
            'registro_id' => (int)$resultado->registro_id, 'nombre' => $resultado->nombre,
            'apellido_paterno' => $resultado->apellido_paterno, 'apellido_materno' => $resultado->apellido_materno,
            'fecha_nacimiento' => $resultado->fecha_nacimiento,'correo' => $resultado->correo,
            'telefono' => $resultado->telefono,'usuario' => $resultado->usuario,'password' => $resultado->password,
            'acceso' => $resultado->acceso,'estatus' => $resultado->estatus,'id_pais' => $resultado->id_pais,
            'id_estado' => $resultado->id_estado, 'id_municipio' => $resultado->id_municipio,
        ] : [];
                return $Array;
            }else{
                // echo "No se encontro el correo";
                return false;
            }


        // return $Array;
    }

    public function check_email($correo)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT correo FROM tbl_registro WHERE correo = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $correo);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        // $Array = $resultado ? [
        //     'id' => (int)$resultado->id, 'nombre' => $resultado->nombre,
        //     'apellido_paterno' => $resultado->apellido_paterno, 'apellido_materno' => $resultado->apellido_materno,
        //     'fecha_nacimiento' => $resultado->fecha_nacimiento,'correo' => $resultado->correo,
        //     'telefono' => $resultado->telefono,'usuario' => $resultado->usuario,'password' => $resultado->password,
        //     'acceso' => $resultado->acceso,'estatus' => $resultado->estatus,'id_pais' => $resultado->id_pais,
        //     'id_estado' => $resultado->id_estado, 'id_municipio' => $resultado->id_municipio,
        // ] : [];

        
            if($resultado->correo == $correo){
                // echo "Todo salio de acuerdo al plan (se encontro el correo)";
                return true;
            }else{
                // echo "No se encontro el correo";
                return false;
            }


        // return $Array;
    }
    

    public function get_registro_x_id($registro_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        // Cambie el id a registro_id por que solo tenia id
        $sql = "SELECT * FROM tbl_registro WHERE registro_id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $registro_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id' => (int)$resultado->id, 'nombre' => $resultado->nombre,
            'apellido_paterno' => $resultado->apellido_paterno, 'apellido_materno' => $resultado->apellido_materno,
            'fecha_nacimiento' => $resultado->fecha_nacimiento,'correo' => $resultado->correo,
            'telefono' => $resultado->telefono,'usuario' => $resultado->usuario,'password' => $resultado->password,
            'acceso' => $resultado->acceso,'estatus' => $resultado->estatus,'id_pais' => $resultado->id_pais,
            'id_estado' => $resultado->id_estado, 'id_municipio' => $resultado->id_municipio,
        ] : [];
        return $Array;
    }

    public function insert_registro($nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $correo, $telefono, $usuario, $password, $acceso, $estatus, $id_pais, $id_estado, $id_municipio)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_registro`(`nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `correo`, `telefono`, `usuario`, `password`, `acceso`, `estatus`, `id_pais`, `id_estado`, `id_municipio`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
        try {
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $apellido_paterno);
            $sql->bindValue(3, $apellido_materno);
            $sql->bindValue(4, $fecha_nacimiento);
            $sql->bindValue(5, $correo);
            $sql->bindValue(6, $telefono);
            $sql->bindValue(7, $usuario);
            $sql->bindValue(8, $password);
            $sql->bindValue(9, $acceso);
            $sql->bindValue(10, $estatus);
            $sql->bindValue(11, $id_pais);
            $sql->bindValue(12, $id_estado);
            $sql->bindValue(13, $id_municipio);
            $estatus = $sql->execute();
            
            $lastInserId = $conectar->lastInsertId();
    
            if ($estatus && $lastInserId != "0") {
                // Obtén y devuelve el registro recién insertado
                $query = $this->get_registro_x_id($lastInserId);
                return $query;
            } else {
                // Manejo de errores si la inserción falla
                $errorInfo = $sql->errorInfo();
                return ['error' => 'Error en la inserción: ' . $errorInfo[2]];
            }
        } catch (PDOException $e) {
            // Manejo de excepciones
            return ['error' => 'Error en la preparación o ejecución de la consulta: ' . $e->getMessage()];
        }
    }
    

    public function update_registro($nombre, $apellido_paterno, $apellido_materno,$fecha_nacimiento,$correo,$telefono,$usuario,$password,$acceso,$estatus,$id_pais,$id_estado,$id_municipio,$registro_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_registro` SET `nombre`= ?, `apellido_paterno`= ?, `apellido_materno`= ?,`fecha_nacimiento`= ? ,`correo`= ?,
        `telefono`= ? ,`usuario`= ? ,`password`= ? ,`acceso`= ? ,`estatus`= ? ,`id_pais`= ? ,`id_estado`= ?,`id_municipio`= ? 
        WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $apellido_paterno);
        $sql->bindValue(3, $apellido_materno);
        $sql->bindValue(4, $fecha_nacimiento);
        $sql->bindValue(5, $correo);
        $sql->bindValue(6, $telefono);
        $sql->bindValue(7, $usuario);
        $sql->bindValue(8, $password);
        $sql->bindValue(9, $acceso);
        $sql->bindValue(10, $estatus);
        $sql->bindValue(11, $id_pais);
        $sql->bindValue(12, $id_estado);
        $sql->bindValue(13, $id_municipio);
        $sql->bindValue(14, $registro_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_registro($registro_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_registro` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $registro_id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    
}
