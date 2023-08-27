<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . '/../includes/config/database.php';

$DATABASE = new Database();
$db = $DATABASE->getConnection();


function sidebarList($db, $id) {

    $data = [];

    foreach($id as $k => $v) {

        $query = "SELECT * FROM tbl_sidebar WHERE id = ? ";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $v);
        $stmt->closeCursor();
        $stmt->execute();
        $data[] = $stmt->fetch(PDO::FETCH_ASSOC);

    }// foreach

    return json_encode($data);

}// sidebar



switch($_POST['case']) {

    case 'sidebar_list':
        echo sidebarList($db, $_POST['id']);
    break;

}// switch

?>