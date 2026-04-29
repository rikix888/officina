<?php


class Database {
    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../config/config.php';
        $this->conn = new mysqli(Config::$hostname, Config::$username, Config::$password, Config::$dbName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        
    }

    public function query($q) {
        return $this->conn->query($q);
    }

}

?>