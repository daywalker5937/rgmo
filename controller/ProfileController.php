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

    $q = "SELECT user_id FROM tbl_user_role WHERE role_id = ? ";

    $r_id = 2;
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

        // location
        $row['location'] = 'location';

        // action
        $row['action'] = 'action';
        
        $data[] = $row;
        
    }// foreach

    return json_encode(['data' => $data]);

}// get all client

switch($_POST['case']) {

    case 'get_info':
        echo getInfo($_POST['id'], $db);
    break;

    case 'get all clients':
        echo getAllClients($db);
    break;

}// switch

?>