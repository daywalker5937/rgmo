<?php

class Services {

    // properties
    public $service_id;
    public $type_id;
    public $service_name;
    public $type_name;
    public $location;
    public $price;
    public $description;
    public $availability_status;
    public $service_image;
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

    public function getServiceInfo() {

        $query = "SELECT * FROM tbl_type_of_service WHERE type_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->type_id);
        $stmt->closeCursor();
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {

            $this->type_name = $row['type_name'];
            $this->location = $row['location'];
            $this->price = number_format($row['price']);
            $this->description = $row['description'];
            $this->availability_status = $row['availability_status'];
            $this->service_image = $row['service_image'];
            $this->service_id = $row['service_id'];

        }

    }// service info

    public function getAllType() {

        $query = "SELECT * FROM tbl_type_of_service";
        $stmt = $this->conn->prepare($query);
        $stmt->closeCursor();
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $k => $v) {

            $q = "SELECT service_name FROM tbl_list_of_service WHERE service_id = ? ";
            $s = $this->conn->prepare($q);
            $s->bindParam(1, $v['service_id']);
            $s->closeCursor();
            $s->execute();

            $data[$k]['service_id'] = $s->fetch(PDO::FETCH_ASSOC)['service_name'];

        }

        return $data;

    }// get all type of services

    public function getPendingRequest() {
        
        $status = "Pending";
        $query = "SELECT * FROM tbl_client_form WHERE status = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $status);
        $stmt->closeCursor();
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// get pending requests

    public function getServiceAvailability() {

        $query = "SELECT * FROM tbl_type_of_service WHERE availability_status = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->availability_status);
        $stmt->closeCursor();
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// get available services

    public function submitRequest() {

        try {

            $query = "INSERT INTO tbl_client_form (client_id, status, service_id) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $_POST['user_id']);
            $stmt->bindParam(2, $_POST['status']);
            $stmt->bindParam(3, $_POST['type_id']);
            $stmt->closeCursor();
            $stmt->execute();

            return ['status' => true];

        }catch(Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }

    }// submit 

}// class

?>