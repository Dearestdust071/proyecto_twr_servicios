<?php
require_once("../config/conexion.php");
require_once("../models/Preguntas.php");
$preguntas = new Preguntas();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $preguntas->get_preguntas();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $preguntas->get_preguntas_x_id($body["preguntas_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $preguntas->insert_preguntas($body["nombre"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $preguntas->update_preguntas($body["nombre"],$body["preguntas_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $preguntas->delete_preguntas($body["preguntas_id"]);
        echo json_encode($datos);
        break;    
}
