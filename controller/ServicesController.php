<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json; charset=utf-8');

include_once  __DIR__ . '/../includes/config/database.php';
include_once __DIR__ . '/../objects/services.php';
include_once __DIR__ . '/../objects/profile.php';

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
    $pending_request = $SERVICES->getPendingRequest();

    // Get Client Info
    foreach($pending_request as $key => $value) {

        // Get Client Id Data
        $PROFILE = new Profile($db, $value['client_id']);
        $pending_request[$key]['client_name'] = $PROFILE->firstname . " " . $PROFILE->lastname;
        
        // Get Service Id Datad
        $SERVICES->type_id = $value['service_id'];
        $SERVICES->getServiceInfo();
        $pending_request[$key]['service_name'] = $SERVICES->type_name;
        $pending_request[$key]['service_price'] = $SERVICES->price;

        // Action
        $pending_request[$key]['action'] = 'buttons';

    }// foreach

    return json_encode($pending_request);

}// pending request

function getServiceAvailability($db) {
    $SERVICES = new Services($db);
    $SERVICES->availability_status = $_POST['status'];
    return json_encode($SERVICES->getServiceAvailability());
}

function client_request($db) {
    $SERVICES = new Services($db);
    $SERVICES->client_id = $_POST['user_id'];
    $SERVICES->status = $_POST['status'];
    $SERVICES->type_id = $_POST['type_id'];
    return json_encode($SERVICES->submitRequest());
}

function occupiedSlots($db) {
    $SERVICES = new Services($db);
    $SERVICES->availability_status = $_POST['availability'];
    return json_encode($SERVICES->getServiceAvailability());
}

function submitPayment($db) {

    // Services Instance
    $SERVICES = new Services($db);

    // Service Price
    $_POST['service_price'] = str_replace(',','', $_POST['service_price']);
    
    try {

        // Check Payment Status
        switch($_POST['status']) {

            // Insert new data in tbl_payments
            case 'Pending':

                    // Payment must not exceed more than service price
                    if($_POST['payment'] <= $_POST['service_price']) {

                        $SERVICES->price = $_POST['service_price'];
                        $SERVICES->total_paid = $_POST['payment'];
                        $SERVICES->due_date = '';
                        $SERVICES->form_id = $_POST['form_id'];
                        $SERVICES->client_id = $_POST['client_id'];
                        $SERVICES->payment = $_POST['payment'];
                        $SERVICES->type_id = $_POST['service_id'];
                        $SERVICES->availability_status = 'no';
                        $SERVICES->insertClientPayment();

                    }
                    else {
                        throw new Exception("Payment Inserted is more than Service Price");
                    }
                
            break;

        }// switch

        return json_encode(['status' => true]);

    }catch(Exception $e) {
        return json_encode(['status' => false, 'message' => $e->getMessage()]);
    }

}// submit payment

function paidClient($db) {

    $SERVICES = new Services($db);
    $payments_data = $SERVICES->getAllPaymentData();

    foreach($payments_data as $key => $value) {

        $SERVICES->form_id = $value['form_id'];
        $client_form = $SERVICES->getClientFormData();

        // Get Name of Client
        $PROFILE = new Profile($db, $client_form['client_id']);
        $payments_data[$key]['client_name'] = $PROFILE->firstname . " " . $PROFILE->lastname;

        // Get Service Name
        $SERVICES->type_id = $client_form['service_id'];
        $SERVICES->getServiceInfo();
        $payments_data[$key]['service_name'] = $SERVICES->type_name;
        $payments_data[$key]['location'] = $SERVICES->location;

    }// foreach

    return json_encode($payments_data);

}// paid client

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

    // Logged in Client Submit Request
    case 'client request':
        echo client_request($db);
    break;

    // Get All Available Services
    case 'available service':
        echo getServiceAvailability($db);
    break;

    // Submit Client Payment
    case 'submit client payment':
        echo submitPayment($db);
    break;

    // Get Occupied Slots
    case 'occupied slots':
        echo occupiedSlots($db);
    break;

    // Get All Payment Data
    case 'persons paid':
        echo paidClient($db);
    break;

}// switch

?>