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

        $query = "SELECT * FROM tbl_list_of_service";
        $stmt = $this->conn->prepare($query);
        $stmt->closeCursor();
        $stmt->execute();
        $this->services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// get_services

    // Get Service Id using service name
    public function getServiceId() {

        $query = "SELECT service_id FROM tbl_list_of_service WHERE service_name = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->service_name);
        $stmt->closeCursor();
        $stmt->execute();
        $this->service_id = $stmt->fetch(PDO::FETCH_ASSOC)['service_id'];

    }// get service id

    public function idGetType() {

        $query = "SELECT * FROM tbl_type_of_service WHERE service_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->service_id);
        $stmt->closeCursor();
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// get type of services using id

    public function get_available_services() {

        $query = "SELECT * FROM tbl_type_of_service WHERE availability_status = 'Yes' ";
        $stmt = $this->conn->prepare($query);
        $stmt->closeCursor();
        $stmt->execute();
        $this->services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// get all services

}// class

?>