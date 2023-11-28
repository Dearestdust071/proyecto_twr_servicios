<?php
require_once("../config/conexion.php");
require_once("../models/Inventario.php");
$inventario = new Inventario();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $inventario->get_inventario();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $inventario->get_inventario_x_id($body["inventario_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $inventario->insert_inventario($body["nombre"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $inventario->update_inventario($body["nombre"],$body["inventario_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $inventario->delete_inventario($body["inventario_id"]);
        echo json_encode($datos);
        break;    
}
