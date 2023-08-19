<?php

class Database {

	private $hostname = "localhost";
	private $u_name = "root";
	private $p_word = "";
	private $dbName = "rgmo_db";

	public $connection = null;

	public function getConnection() {

		if(!isset($this->connection)) {
			try {
				$this->connection = new pdo("mysql:host=" . $this->hostname . ";dbname=" . $this->dbName, $this->u_name, $this->p_word);
			}
			catch(PDOException $e) {
				die("Connection failed: " . $e->getMessage());
			}
		}//if
		return $this->connection;


	}//getConnection

}//Database

?>