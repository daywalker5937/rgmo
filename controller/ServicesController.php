<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json; charset=utf-8');

include_once  __DIR__ . '/../includes/config/database.php';
include_once __DIR__ . '/../objects/services.php';

$DATABASE = new Database();
$db = $DATABASE->getConnection();

function services($db) {
    $SERVICES = new Services($db);
    $SERVICES->get_services();
    return json_encode($SERVICES->services);
}

function service_type($db) {
    $SERVICES = new Services($db);
    $SERVICES->service_id = $_POST['service_id'];
    return json_encode($SERVICES->id_get_type());
}

switch($_POST['case']) {

    // Get All Services
    case 'services':
        echo services($db);
    break;

    // Get Type of Service depends on service_id
    case 'fetch type':
        echo service_type($db);
    break;

}// switch

?>