<?php

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    header("Access-Control-Allow-Methods: POST");
    header('Content-Type: application/json; charset=utf-8');

    include_once __DIR__ . '/../includes/config/database.php';
    include_once __DIR__ . '/../objects/session.php';
    include_once __DIR__ . '/../objects/access.php';
    include_once __DIR__ . '/../objects/profile.php';
    include_once __DIR__ . '/../objects/role.php';

    $user_email = $_POST['_email'];
    $user_pass = $_POST['_pass'];
    $result = false;

    $DATABASE = new Database();
    $db = $DATABASE->getConnection();
    
    // Get password if email matched
    $query = "SELECT user_id, password FROM tbl_user_login WHERE email = ? ";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $user_email);
    $stmt->closeCursor();
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {

        if(password_verify($user_pass, $row['password'])) {

            // User Profile Data
            $PROFILE = new Profile($db, $row['user_id']);

            // Get Role
            $ROLE = new Role($db, $row['user_id']);

            // Create Session
            $ACCESS = new Access();
            $ACCESS->user_id = $row['user_id'];
            $ACCESS->name = $PROFILE->fullname;
            $ACCESS->user_role = $ROLE->role_name;
            $ACCESS->sessionUser();

            // Close Statement
            $stmt->closeCursor();
            $result = true;

        }// if passwords matched

    }// if not null

    echo json_encode($result);

?>