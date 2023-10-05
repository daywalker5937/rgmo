<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . '/../includes/config/database.php';

$DATABASE = new Database();
$db = $DATABASE->getConnection();

function getInfo($id, $db) {

    $query = "SELECT A.*, B.email FROM tbl_user_info as A
        LEFT JOIN tbl_user_login as B
        ON A.user_id = B.user_id
        WHERE A.user_id = ?
    ";

    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->closeCursor();
    $stmt->execute();

    return json_encode($stmt->fetch(PDO::FETCH_ASSOC));

}// get info

// Get All list of Clients
function getAllClients($db) {

    $data = [];

    $q = "SELECT user_id, role_id FROM tbl_user_role WHERE role_id <> ? ";

    $r_id = 1;
    $st = $db->prepare($q);
    $st->bindParam(1, $r_id);
    $st->closeCursor();
    $st->execute();
    $r = $st->fetchAll(PDO::FETCH_ASSOC);

    foreach($r as $k => $id) {

        $query = "SELECT A.*, B.email FROM tbl_user_info as A
            LEFT JOIN tbl_user_login as B
            ON A.user_id = B.user_id
            WHERE A.user_id = ?
        ";

        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $id['user_id']);
        $stmt->closeCursor();
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Status
        switch($id['role_id']) {
            case 2: 
                $row['status_id'] = $id['role_id'];
                $row['status'] = 'Client';
                $row['status_class'] = "bg-success"; 
            break;
            case 3:
                $row['status_id'] = $id['role_id'];
                $row['status'] = 'Pending Registration';
                $row['status_class'] = "bg-danger"; 
            break;
        }// switch

        // full name
        $row['name'] = $row['first_name'] . " " . $row['last_name'];

        // location
        $row['location'] = 'location';

        // action
        $row['action'] = 'action';
        
        $data[] = $row;
        
    }// foreach

    return json_encode(['data' => $data]);

}// get all client

function updateClientRegistration($db) {

    try {

        switch($_POST['button']) {
    
            case 'approve':
                $role_id = 2;
                $query = "UPDATE tbl_user_role SET role_id = ? WHERE user_id = ?";
                $stmt = $db->prepare($query);
                $stmt->bindParam(1, $role_id);
                $stmt->bindParam(2, $_POST['user_id']);
                $stmt->closeCursor();
                $stmt->execute();
            break;
    
            case 'disapprove':
                deleteRow($db, 'tbl_user_info', $_POST['user_id']);
                deleteRow($db, 'tbl_user_login', $_POST['user_id']);
                deleteRow($db, 'tbl_user_role', $_POST['user_id']);
            break;
    
        }// switch

        echo json_encode(['status' => true]);

    }catch(Exception $e) {
        echo json_encode(['status' => false, 'message' => $e->getMessage()]);
    }

}// update client registration

function deleteRow($db, $table, $id) {
    $query = "DELETE FROM $table WHERE user_id = ? ";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->closeCursor();
    $stmt->execute();
}// delete row

function getRegisteredClients($list) {
    
    $data = [];
    $list = json_decode($list);

    foreach($list->data as $key => $value) {

        if($value->status_id == 2) {
            $data[] = $value;
        }

    }// foreach

    return json_encode($data);

}// tenant count

switch($_POST['case']) {

    case 'get_info':
        echo getInfo($_POST['id'], $db);
    break;

    case 'get all clients':
        echo getAllClients($db);
    break;

    case 'update client registration':
        echo updateClientRegistration($db);
    break;

    case 'get registered clients':
        echo getRegisteredClients(getAllClients($db));
    break;

}// switch

?>