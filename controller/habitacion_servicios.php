<?php
require_once("../config/conexion.php");
require_once("../models/Habitacion_servicios.php");
$habitacionservicios = new Habitacion_servicios();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $habitacionservicios->get_habitacion_servicios();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $habitacionservicios->get_habitacion_servicios_x_id($body["habitacion_servicios_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $habitacionservicios->insert_habitacion_servicios($body["id_habitacion"],$body["id_servicios"],$body["estatus"]);
        echo json_encode($datos);
        echo("Se registro su servicio");
        break;

    case "Update":
        $datos = $habitacionservicios->update_habitacion_servicios($body["id_habitacion"],$body["id_servicios"],$body["estatus"],$body["habitacion_servicios_id"]);
        echo json_encode($datos);
        echo("Se actualizo bien");
        break;

    case "Delete":
        $datos = $habitacionservicios->delete_habitacion_servicios($body["habitacion_servicios_id"]);
        echo json_encode($datos);
        echo("Se Elimino bien");
        break;
}
