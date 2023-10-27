<?php
require_once("../config/conexion.php");
require_once("../models/Habitaciones.php");
$imagenes_tipo = new Imagenes_tipo();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $imagenes_tipo->get_imagenes_tipo();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $imagenes_tipo->get_imagenes_tipo_x_id($body["imagenes_tipo_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $imagenes_tipo->insert_imagenes_tipo($body["imagen"],$body["id_tipo_habitacion"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $imagenes_tipo->update_imagenes_tipo($body["imagen"],$body["id_tipo_habitacion"],$body["imagenes_tipo_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $imagenes_tipo->delete_imagenes_tipo($body["imagenes_tipo_id"]);
        echo json_encode($datos);
        break;    
}
