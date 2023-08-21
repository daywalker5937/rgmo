<?php

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    header("Access-Control-Allow-Methods: POST");
    header('Content-Type: application/json; charset=utf-8');

    include_once __DIR__ .  '/../includes/config/database.php';

    
    $last_name = $_POST['lname'];
    $first_name = $_POST['fname'];
    $middle_name = $_POST['mname'];
    $address = $_POST['address'];
    $sex = $_POST['sex'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email'];
    $pass = $_POST['password'];
    $con_pass = $_POST['confirm_password'];
    
    // If Password is Same with Confirm Password
    if($pass == $con_pass) {

        try {

            $DATABASE = new Database();
            $DATABASE->getConnection();

            // hash password
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);  
            
            // Insert to user_info table
            $info_query = "INSERT INTO tbl_user_info 
                (first_name, last_name, middle_name, address, contact_number, sex)
                VALUES (?,?,?,?,?,?)
            ";

            $stmt_info = $DATABASE->connection->prepare($info_query);
            $stmt_info->bindParam(1, $first_name);
            $stmt_info->bindParam(2, $last_name);
            $stmt_info->bindParam(3, $middle_name);
            $stmt_info->bindParam(4, $address);
            $stmt_info->bindParam(5, $contact_number);
            $stmt_info->bindParam(6, $sex);
            $stmt_info->closeCursor();
            $stmt_info->execute();

            // Get User Id of User
            $user_id = $DATABASE->connection->lastInsertId();            

            // Insert to login table
            $login_query = "INSERT INTO tbl_user_login (email, password, user_id) VALUES (?,?,?) ";
            $stmt_login = $DATABASE->connection->prepare($login_query);
            $stmt_login->bindParam(1, $email_address);
            $stmt_login->bindParam(2, $hashed_password);
            $stmt_login->bindParam(3, $user_id);
            $stmt_login->closeCursor();
            $stmt_login->execute();

            // Insert to a Client Role to tbl_user_role
            $role_id = 2;
            $role_query = "INSERT INTO tbl_user_role (user_id, role_id) VALUES (?,?)";
            $stmt_role = $DATABASE->connection->prepare($role_query);
            $stmt_role->bindParam(1, $user_id);
            $stmt_role->bindParam(2, $role_id);
            $stmt_role->closeCursor();
            $stmt_role->execute();

            echo json_encode(['status' => true]);

        }catch(Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }

    }// if

?>