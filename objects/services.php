<?php

class Services {

    // properties
    public $service_id;
    public $service_name;
    public $location;
    public $price;
    public $description;
    public $availability_status;
    public $services;

    // connection
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function get_services() {

        $query = "SELECT * FROM tbl_type_of_service";
        $stmt = $this->conn->prepare($query);
        $stmt->closeCursor();
        $stmt->execute();
        $this->services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// get_services

    public function get_available_services() {

        $query = "SELECT * FROM tbl_type_of_service WHERE availability_status = 'Yes' ";
        $stmt = $this->conn->prepare($query);
        $stmt->closeCursor();
        $stmt->execute();
        $this->services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// get all services

}// class

?>