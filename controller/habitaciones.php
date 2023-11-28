<?php
require_once("../config/conexion.php");
require_once("../models/Habitaciones.php");
$habitaciones = new Habitaciones();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $habitaciones->get_habitacion();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $habitaciones->get_habitacion_x_id($body["habitacion_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $habitaciones->insert_habitacion($body["nombre"], $body["capacidad"], $body["extencion"], $body["camas"],
        $body["descripcion"],$body["subtotal"], $body["total"], $body["id_tipo_habitacion"]);
        echo json_encode($datos);
        echo("Se inserto la habitacion");
        break;

    case "Update":
        $datos = $habitaciones->update_habitacion($body["nombre"], $body["capacidad"], $body["extencion"], $body["camas"],
        $body["descripcion"],$body["subtotal"],$body["total"], $body["id_tipo_habitacion"], $body["habitacion_id"]);
        echo json_encode($datos);
        echo("Se edito la habitacion");
        break;

    case "Delete":
        $datos = $habitaciones->delete_habitacion($body["habitacion_id"]);
        echo json_encode($datos);
        echo("Se elimino la habitacion");
        break;

    
}
