<?php
require_once __DIR__ . '/../config/config.php';

class Database {
    private $conn;

    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        try {
            $this->conn = new mysqli(Config::$hostname, Config::$username, Config::$password, Config::$dbName);
            $this->conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            die("ERRORE FATALE - Connessione al database fallita: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function query($q) {
        return $this->conn->query($q);
    }
}
?>