<?php
require_once("../config/conexion.php");
require_once("../models/Registro.php");
$registros = new Registro();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $registros->get_registro();
        echo json_encode($datos);
        break;

    case "checkEmail":
        $datos = $registros->check_email($body["correo"]);
        echo json_encode($datos);
        break;

    case "checkUser":   
            $datos = $registros->check_user($body["correo"],$body["password"]);
            echo json_encode($datos);
            break;

    case "GetId":
        $datos = $registros->get_registro_x_id($body["registro_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $registros->insert_registro($body["nombre"], $body["apellido_paterno"], $body["apellido_materno"], $body["fecha_nacimiento"],
        $body["correo"], $body["telefono"], $body["usuario"], $body["password"], $body["acceso"],
        $body["estatus"], $body["id_pais"], $body["id_estado"], $body["id_municipio"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $registros->update_registro($body["nombre"], $body["apellido_paterno"], $body["apellido_materno"], $body["fecha_nacimiento"],
        $body["correo"], $body["telefono"], $body["usuario"], $body["password"], $body["acceso"],
        $body["estatus"], $body["id_pais"], $body["id_estado"], $body["id_municipio"], $body["id_municipio"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $registros->delete_registro($body["registro_id"]);
        echo json_encode($datos);
        break;

    
}
