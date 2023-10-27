<?php
require_once("../config/conexion.php");
require_once("../models/Servicios.php");
$servicios = new Servicios();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $servicios->get_servicios();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $servicios->get_servicios_x_id($body["servicio_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $servicios->insert_servicios($body["nombre"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $servicios->update_servicios($body["nombre"], $body["servicio_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $servicios->delete_servicios($body["servicio_id"]);
        echo json_encode($datos);
        break;
}
