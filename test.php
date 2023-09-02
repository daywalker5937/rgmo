<?php

include_once __DIR__ . '/includes/config/database.php';

$DATABASE = new Database();
$db = $DATABASE->getConnection();

try {

    $arr = [
        ['Isabela Farm', 'Isabela', '500000', 'Fruit Farm', 'yes', 1],
        ['Cagayan Farm', 'Cagayan', '2000000', 'Vegetable Farm', 'yes', 1],
        ['Ilocos Farm', 'Ilocos Norte', '1200000', 'Seed Farm', 'yes', 1],
        ['Camella Housing', 'Cavite', '300000', '2 story building, 2 rooms with dining area', 'yes', 2],
        ['Ondoy Housing', 'Antipolo', '400000', 'Bungalo House with full of appliances', 'yes', 2],
        ['Cherry Housing', 'Teresa', '100000', '3 story house with jacuzzi', 'yes', 2],
        ['Abuyod Housing', 'Teresa', '800000', '2 story house with 2 room size veranda', 'yes', 2],
        ['Coffee Stall', 'Manila', '5000', 'Coffee Stall that can accommodate 10 seats', 'yes', 3],
        ['Pizza Stall', 'Makati', '4000', 'Pizza Stall with Family Size Tables', 'yes', 3],
        ['Isabela Rice Field', 'Isabela', '800000', 'Good field with water irrigation', 'yes', 4],
        ['Cagayan Rice Field', 'Cagayan', '900000', 'Good field with water irrigation', 'yes', 4],
        ['Transylvania Room', 'Cubao', '500000', 'Room with jacuzzi and veranda', 'yes', 5],
    ];

    $r = [
        ['luxury1.jpg', 'Transylvania Room']
    ];

    foreach($r as $k => $v) {

        $query = "UPDATE tbl_type_of_service SET service_image = ? WHERE type_name = ? ";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $v[0]);
        $stmt->bindParam(2, $v[1]);
        $stmt->closeCursor();
        $stmt->execute();

    }

    echo "success";

}catch(Exception $e) {
    echo $e->getMessage();
}

?>