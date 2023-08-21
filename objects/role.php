<?php

class Role {

    public $role_id;
    public $user_id;
    public $role_name;
    public $conn;

    public function __construct($db, $user_id) {

        $this->conn = $db;

        // If not null get Role
        if(!is_null($user_id)) {

            $this->user_id = $user_id;

            // Get Role Id
            $query = "SELECT role_id FROM tbl_user_role WHERE user_id = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->user_id);
            $stmt->execute();
            $this->role_id = $stmt->fetch(PDO::FETCH_ASSOC)['role_id'];
            $stmt->closeCursor();

            // Get Role Name
            $query = "SELECT role_name FROM tbl_role WHERE role_id = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->role_id);
            $stmt->execute();
            $this->role_name = $stmt->fetch(PDO::FETCH_ASSOC)['role_name'];
            $stmt->closeCursor();

        }

    }// construct

}// class

?>