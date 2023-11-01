<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . '/../includes/config/database.php';
include_once __DIR__ . '/EmailController.php';

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

        // Get this client email
        $client = json_decode(getInfo($_POST['user_id'], $db));

        switch($_POST['button']) {
    
            case 'approve':

                // Update Database
                $role_id = 2;
                $query = "UPDATE tbl_user_role SET role_id = ? WHERE user_id = ?";
                $stmt = $db->prepare($query);
                $stmt->bindParam(1, $role_id);
                $stmt->bindParam(2, $_POST['user_id']);
                $stmt->closeCursor();
                $stmt->execute();

                // Send Email
                $subject = "Client Pending Registration";
                $message = "Dear Client! 
                    It is our pleasure to inform you that your account has been <b>Approved!</b> 
                    Now that you are registered in, you may use our rental services. Thank you.";

                // Send
                sendEmail($client->email, $subject, $message);

            break;
    
            case 'disapprove':

                // Delete User Info
                deleteRow($db, 'tbl_user_info', $_POST['user_id']);
                deleteRow($db, 'tbl_user_login', $_POST['user_id']);
                deleteRow($db, 'tbl_user_role', $_POST['user_id']);

                // Send Email
                $subject = "Client Pending Registration";
                $message = "Dear Customer You have been <b>rejected</b> access to your account, which we regret! Thank you";

                // Send
                sendEmail($client->email, $subject, $message);

            break;
    
        }// switch

        echo json_encode(['status' => true]);

    }catch(Exception $e) {
        echo json_encode(['status' => false, 'message' => $e->getMessage()]);
    }

}// update client registration

function callSendEmail($email, $subject, $message) {
    return sendEmail($email, $subject, $message);
}

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

function genderSelection() {
    return [
        ["id" => "Male", "text" => "Male"],
        ["id" => "Female", "text" => "Female"]
    ];
}

function civilStatusSelection() {
    return [
        ["id" => "Single", "text" => "Single"],
        ["id" => "Married", "text" => "Married"],
        ["id" => "Divorced", "text" => "Divorced"],
        ["id" => "Widowed", "text" => "Widowed"]
    ]; 
}

function updateDisplay($data) {

    $gender = genderSelection();
    $civil = civilStatusSelection();

    // Add Selected Gender
    foreach($gender as $key => $value) {
        if($value['id'] == $data->sex) {
            $gender[$key]['selected'] = true;
        }
    }

    // Add Selected Civil Status
    foreach($civil as $key => $value) {
        if($value['id'] == $data->civil_status) {
            $civil[$key]['selected'] = true;
        }
    }

    $data->sex = $gender;
    $data->civil_status = $civil;

    echo json_encode($data);

}// update display

function updateClientInfo($db) {

    $p = json_decode(getInfo($_POST['id'], $db));

    try {

        // Check first if User Changed something
        $present_data = [
            $p->last_name, $p->first_name, $p->middle_name, 
            $p->address, $p->contact_number, $p->sex, $p->civil_status, $p->email
        ];
    
        $post_data = [
            $_POST['lname'], $_POST['fname'], $_POST['mname'], 
            $_POST['address'], $_POST['contact_number'], $_POST['sex'], 
            $_POST['civil_status'], $_POST['email']
        ];
    
        // Check if Same present and post data
        if($present_data == $post_data) {
            throw new Exception('Nothing Changed!');
        }
        else {

            // Update User Info
            $query_ui = "UPDATE tbl_user_info 
                SET first_name = ?, last_name = ?, middle_name = ?,
                address = ?, contact_number = ?, sex = ?, civil_status = ?
                WHERE user_id = ?
            ";

            // Update
            $stmt_ui = $db->prepare($query_ui);
            $stmt_ui->bindParam(1, $_POST['fname']);
            $stmt_ui->bindParam(2, $_POST['lname']);
            $stmt_ui->bindParam(3, $_POST['mname']);
            $stmt_ui->bindParam(4, $_POST['address']);
            $stmt_ui->bindParam(5, $_POST['contact_number']);
            $stmt_ui->bindParam(6, $_POST['sex']);
            $stmt_ui->bindParam(7, $_POST['civil_status']);
            $stmt_ui->bindParam(8, $_POST['id']);
            $stmt_ui->closeCursor();
            $stmt_ui->execute();

            // Update Email
            $query_ul = "UPDATE tbl_user_login SET email = ? WHERE user_id = ?";
            $query_ul = $db->prepare($query_ul);
            $query_ul->bindParam(1, $_POST["email"]);
            $query_ul->bindParam(2, $_POST["id"]);
            $query_ul->closeCursor();
            $query_ul->execute();

            return json_encode(["status"=> true]);

        }

    }catch(Exception $e) { 
        return json_encode(['status' => false, 'message'=> $e->getMessage()]);
    }

}// update client info

function deleteUser($db) {

    try {

        // Delete User Info
        deleteRow($db, 'tbl_user_info', $_POST['user_id']);
        deleteRow($db, 'tbl_user_login', $_POST['user_id']);
        deleteRow($db, 'tbl_user_role', $_POST['user_id']);

        return json_encode(['status'=> true]);

    }
    catch(Exception $e) { 
        return json_encode(['status'=> false,'message'=> $e->getMessage()]);
    }

}// delete user

switch($_POST['case']) {

    case 'get_info': echo getInfo($_POST['id'], $db); break;
    case 'get all clients': echo getAllClients($db); break;
    case 'update client registration': echo updateClientRegistration($db); break;
    case 'get registered clients': echo getRegisteredClients(getAllClients($db)); break;
    case 'get for update': echo updateDisplay(json_decode(getInfo($_POST['id'], $db))); break;
    case 'update client info': echo updateClientInfo($db); break;
    case 'delete user': echo deleteUser($db); break;

}// switch

?>