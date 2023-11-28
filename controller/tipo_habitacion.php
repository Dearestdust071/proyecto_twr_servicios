<?php
require_once("../config/conexion.php");
require_once("../models/Tipo_habitacion.php");
$tipo_habitaciones = new Tipo_habitacion();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $tipo_habitaciones->get_tipo_habitacion();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $tipo_habitaciones->get_tipo_habitacion_x_id($body["tipo_habitacion_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $tipo_habitaciones->insert_tipo_habitacion($body["nombre"],$body["descripcion"],$body["rango_precios"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $tipo_habitaciones->update_tipo_habitacion($body["nombre"],$body["descripcion"],$body["rango_precios"],$body["tipo_habitacion_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $tipo_habitaciones->delete_tipo_habitacion($body["tipo_habitacion_id"]);
        echo json_encode($datos);
        break;    
}
