<?php

class Profile {

    public $fullname;
    public $lastname, $firstname, $middlename;
    public $address, $contact_number, $sex;
    public $conn;

    public function __construct($db, $id) {

        $this->conn = $db;

        if(!is_null($id)) {

            $query = "SELECT * FROM tbl_user_info WHERE user_id = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->closeCursor();
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->lastname = $row['last_name'];
            $this->firstname = $row['first_name'];
            $this->middlename = $row['middle_name'];
            $this->fullname = $this->firstname . " " . $this->middlename . " " . $this->lastname;
            $this->address = $row['address'];
            $this->contact_number = $row['contact_number'];
            $this->sex = $row['sex'];

        }

    }// construct

}// class

?>