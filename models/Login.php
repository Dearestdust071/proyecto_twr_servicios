<?php
class Login extends Conectar
{

    public function Login_access($usuario, $password)
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_registro WHERE usuario = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $usuario);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = ['status' => 0, 'mensaje' => 'no object'];
        if (!empty($resultado)) {
            if ($resultado->password == $password) {
                $Array= [
                    'id' => (int)$resultado->id,
                    'usuario' => $resultado->usuario,
                    'password' => $resultado->password,
                    'status' => 1
                ];
            } else {
                $Array['mensaje'] = 'no password';
            }
        }
        return $Array;
    }
}