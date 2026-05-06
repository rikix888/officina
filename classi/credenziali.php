<?php 
require_once __DIR__."/database.php";

class Credenziali {
    private $db;
    
    public function __construct() {
        $this->db = new database();
    }

    public function doLogin($user, $password) {
        $conn = $this->db->getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM `USER` WHERE Username = ? AND Password = ?");
        $stmt->bind_param("ss", $user, $password); 
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return true;
        }
        return false;
    }
    
    public function doRegister($user, $email, $password) {
        $conn = $this->db->getConnection();
        $otp = $this->codiceOTP();
        
        $stmt = $conn->prepare("INSERT INTO `USER` (Username, Email, Password, CodiceOTP) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user, $email, $password, $otp);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
        return false;
    }
    
    public function codiceOTP() {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
?>