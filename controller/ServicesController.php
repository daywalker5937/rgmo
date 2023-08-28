<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json; charset=utf-8');

include_once  __DIR__ . '/../includes/config/database.php';
include_once __DIR__ . '/../objects/services.php';

function services($service_function) {
    $DATABASE = new Database();
    $db = $DATABASE->getConnection();
    $SERVICES = new Services($db);
    ($service_function == 'fetch service') ? $SERVICES->get_services() : $SERVICES->get_available_services();
    return json_encode($SERVICES->services);
}

echo services($_POST['case']);

?>