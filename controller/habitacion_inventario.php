<?php
require_once("../config/conexion.php");
require_once("../models/Habitacion_Inventario.php");
$habitacion_inventario = new Habitacion_Inventario();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $habitacion_inventario->get_HabitacionInventario();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $habitacion_inventario->get_HabitacionInventario_x_id($body["habitacion_inventario_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $habitacion_inventario->insert_HabitacionInventario($body["id_habitacion"],$body["id_inventario"],$body["estatus"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $habitacion_inventario->update_HabitacionInventario($body["id_habitacion"],$body["id_inventario"],$body["estatus"],$body["habitacion_inventario_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $habitacion_inventario->delete_HabitacionInventario($body["habitacion_inventario_id"]);
        echo json_encode($datos);
        break;    
}
