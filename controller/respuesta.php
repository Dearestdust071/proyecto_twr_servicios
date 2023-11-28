<?php
require_once("../config/conexion.php");
require_once("../models/Respuesta.php");
$respuesta = new Respuesta();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $respuesta->get_respuesta();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $respuesta->get_respuesta_x_id($body["respuesta_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $respuesta->insert_respuesta($body["nombre"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $respuesta->update_respuesta($body["nombre"],$body["respuesta_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $respuesta->delete_respuesta($body["respuesta_id"]);
        echo json_encode($datos);
        break;    
}
