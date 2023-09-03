<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ .  '/../includes/config/database.php';

try {

    $target_dir = __DIR__ . "/../includes/images/";
    $target_file = $target_dir . basename($_FILES["upload_pic"]["name"]);
    $last_name = $_POST['lname'];
    $first_name = $_POST['fname'];
    $middle_name = $_POST['mname'];
    $address = $_POST['address'];
    $civil_status = $_POST['civil_status'];
    $sex = $_POST['sex'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email'];
    $pass = $_POST['password'];
    $con_pass = $_POST['confirm_password'];
    $file_name = $_FILES["upload_pic"]["name"];

    // Check if file already exists
    if (file_exists($target_file)) {
        throw new Exception("File Name Already Exists! Try other Name!");
    }

    $DATABASE = new Database();
    $DATABASE->getConnection();

    // Check Email if Existing
    $email_query = "SELECT email FROM tbl_user_login WHERE email = ? ";
    $stmt_email = $DATABASE->connection->prepare($email_query);
    $stmt_email->bindParam(1, $email_address);
    $stmt_email->closeCursor();
    $stmt_email->execute();
    $email_row = $stmt_email->fetch(PDO::FETCH_ASSOC);

    // If Email Address Submitted is not existing
    if(!$email_row) {

        // If Password is Same with Confirm Password
        if($pass == $con_pass) {

            // Upload Image
            if(move_uploaded_file($_FILES["upload_pic"]["tmp_name"], $target_file)) {
            
                /** Create User Account **/

                // hash password
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);  
                
                // Insert to user_info table
                $info_query = "INSERT INTO tbl_user_info 
                    (first_name, last_name, middle_name, address, contact_number, sex, user_image, civil_status)
                    VALUES (?,?,?,?,?,?,?,?)
                ";

                $stmt_info = $DATABASE->connection->prepare($info_query);
                $stmt_info->bindParam(1, $first_name);
                $stmt_info->bindParam(2, $last_name);
                $stmt_info->bindParam(3, $middle_name);
                $stmt_info->bindParam(4, $address);
                $stmt_info->bindParam(5, $contact_number);
                $stmt_info->bindParam(6, $sex);
                $stmt_info->bindParam(7, $file_name);
                $stmt_info->bindParam(8, $civil_status);
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
                $role_id = $_POST['role'];
                $role_query = "INSERT INTO tbl_user_role (user_id, role_id) VALUES (?,?)";
                $stmt_role = $DATABASE->connection->prepare($role_query);
                $stmt_role->bindParam(1, $user_id);
                $stmt_role->bindParam(2, $role_id);
                $stmt_role->closeCursor();
                $stmt_role->execute();

                echo json_encode(['status' => true]);

            }else {
                throw new Exception("Something wrong with uploading your image! Please Try Again!");
            }

        }// if passwords are same

    }// if not existing
    else {
        throw new Exception("Email already used by other user! Try other Email Address!");
    }

}catch(Exception $e) {
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
}


    

?>