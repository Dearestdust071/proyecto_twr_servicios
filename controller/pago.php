<?php
require_once("../config/conexion.php");
require_once("../models/Pago.php");
$pago = new Pago();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $pago->get_pago();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $pago->get_pago_x_id($body["pago_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $pago->insert_pago($body["total"],$body["tbl_reserva_reserva_id"],$body["tbl_tarjeta_tarjeta_id"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $pago->update_pago($body["total"],$body["tbl_reserva_reserva_id"],$body["tbl_tarjeta_tarjeta_id"],$body["pago_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $pago->delete_pago($body["pago_id"]);
        echo json_encode($datos);
        break; 
        
    case "GetInfoUTR":
        $datos = $pago->get_info_reservacion_tarjetas();
        echo json_encode($datos);
        break;
}
