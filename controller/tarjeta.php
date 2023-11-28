<?php
require_once("../config/conexion.php");
require_once("../models/Tarjeta.php");
$tarjeta = new Tarjeta();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

  case "GetAll":
    $datos = $tarjeta->get_tarjeta();
    echo json_encode($datos);
    break;

  case "GetId":
    $datos = $tarjeta->get_tarjeta_x_id($body["servicio_id"]);
    echo json_encode($datos);
    break;

  case "Insert":
    $datos = $tarjeta->insert_tarjeta(
      $body["numero_tarjeta"],
      $body["anio"],
      $body["mes"],
      $body["cvv"],
      $body["nombre"],
      $body["apellido_paterno"],
      $body["apellido_materno"],
      $body["tipo"],
      $body["monto"],
      $body["tbl_registro_registro_id"]
    );
    echo json_encode($datos);
    break;

  case "cobrar":
    $datos = $tarjeta->cobrar($body["numero_tarjeta"], $body["monto"]);
    echo json_encode($datos);
    break;

  case "Delete":
    $datos = $tarjeta->delete_tarjeta($body["tarjeta_id"]);
    echo json_encode($datos);
    break;


  default:
    echo "Aqui no entra nada";
    break;
}
