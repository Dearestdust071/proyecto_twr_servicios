<?php
require_once("../config/conexion.php");
require_once("../models/Municipio.php");
$municipio = new Municipio();
 
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $municipio->get_municipio();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $municipio->get_municipio_x_id($body["municipio_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $municipio->insert_municipio($body["nombre"],$body["tbl_estado_estado_id"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $municipio->update_municipio($body["nombre"],$body["tbl_estado_estado_id"],$body["municipio_id"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $municipio->delete_municipio($body["municipio_id"]);
        echo json_encode($datos);
        break;    
}
