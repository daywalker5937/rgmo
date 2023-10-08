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

    // client form
    public $form_id;
    public $client_id;
    public $payment_id;
    public $status;
    public $total_paid;
    public $payment;
    public $due_date;

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

    public function getOccupiedSlots() {

        $status = "no";
        $query = "SELECT * FROM tbl_type_of_service WHERE availability_status = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $status);
        $stmt->closeCursor();
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// occupied slots

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

    public function updateStatus() {

        $query = "UPDATE tbl_client_form SET status = ? WHERE id = ? AND client_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->status);
        $stmt->bindParam(2, $this->form_id);
        $stmt->bindParam(3, $this->client_id);
        $stmt->closeCursor();
        $stmt->execute();

    }// update status

    public function updateServiceAvailability() {

        $query = "UPDATE tbl_type_of_service SET availability_status = ? WHERE type_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->availability_status);
        $stmt->bindParam(2, $this->type_id);
        $stmt->closeCursor();
        $stmt->execute();

    }// service availability

    public function submitRequest() {

        try {

            $query = "INSERT INTO tbl_client_form (client_id, status, service_id) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->client_id);
            $stmt->bindParam(2, $this->status);
            $stmt->bindParam(3, $this->type_id);
            $stmt->closeCursor();
            $stmt->execute();

            return ['status' => true];

        }catch(Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }

    }// submit

    public function getPaymentData() {

        $query = "SELECT * FROM tbl_payments WHERE form_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->form_id);
        $stmt->closeCursor();
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }// check payment

    public function insertClientPayment() {
            
        // insert into tbl_payments
        $query_payments = "INSERT INTO tbl_payments (service_price, total_paid, due_date, form_id)
        VALUES (?,?,?,?)";

        $stmt_payments = $this->conn->prepare($query_payments);
        $stmt_payments->bindParam(1, $this->price);
        $stmt_payments->bindParam(2, $this->total_paid);
        $stmt_payments->bindParam(3, $this->due_date);
        $stmt_payments->bindParam(4, $this->form_id);
        $stmt_payments->closeCursor();
        $stmt_payments->execute();

        // Get Inserted payment_id
        $payment_id = $this->conn->lastInsertId();

        // insert into tbl_payment_logs
        $query_logs = "INSERT INTO tbl_payment_logs (client_id, payment, payment_id) VALUES (?,?,?)";
        $stmt_logs = $this->conn->prepare($query_logs);
        $stmt_logs->bindParam(1, $this->client_id);
        $stmt_logs->bindParam(2, $this->payment);
        $stmt_logs->bindParam(3, $payment_id);
        $stmt_logs->closeCursor();
        $stmt_logs->execute();

        // Change Status
        $this->status = "Client Payment";
        $this->updateStatus();

        // Update Service to No after Payment
        $this->updateServiceAvailability();

    }// submit client payment

}// class

?>