<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . '/../includes/config/database.php';

function getInfo($id) {

    $DATABASE = new Database();
    $db = $DATABASE->getConnection();

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

switch($_POST['case']) {

    case 'get_info':
        echo getInfo($_POST['id']);
    break;

}// switch

?>