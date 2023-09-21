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
    $SERVICES->service_name = $_POST['service_name'];
    $SERVICES->getServiceId();
    return json_encode($SERVICES->idGetType());
}

function service_info($db) {
    $SERVICES = new Services($db);
    $SERVICES->type_id = $_POST['type_id'];
    $SERVICES->getServiceInfo();
    return json_encode($SERVICES);
}

function allServiceType($db) {
    $SERVICES = new Services($db);
    return json_encode($SERVICES->getAllType());
}

function submit_process($db) {
    $SERVICES = new Services($db);
}

function pending_request($db) {
    $SERVICES = new Services($db);
    return json_encode($SERVICES->getPendingRequest());
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

    // Get Info of Type
    case 'service info':
        echo service_info($db);
    break;

    // Get All Type of Services
    case 'all types':
        echo allServiceType($db);
    break;

    // Get All Pending Request
    case 'pending request':
        echo pending_request($db);
    break;

}// switch

?>