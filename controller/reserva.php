<?php
require_once("../config/conexion.php");
require_once("../models/Reserva.php");
$reserva = new Reserva();
 
$body = json_decode(file_get_contents("php://input"), true);
//echo $_GET['opcion'];
switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $reserva->get_reserva();
        echo json_encode($datos); 
        break;

    case "GetId":
        $datos = $reserva->get_reserva_x_id($body["reserva_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $reserva->insert_reserva($body["inicio_reserva"],$body["fin_reserva"],$body["subtotal"],$body["tbl_habitaciones_habitacion_id"],$body["tbl_registro_registro_id"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $reserva->update_reserva($body["inicio_reserva"],$body["fin_reserva"],$body["subtotal"],$body["tbl_habitaciones_habitacion_id"],$body["tbl_registro_registro_id"],$body["reserva_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $reserva->delete_reserva($body["reserva_id"]);
        echo json_encode($datos);
        break;    
}
