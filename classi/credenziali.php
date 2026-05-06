<?php 

class Credenziali {
    

    public function __construct() {
        
    }

    public function doLogin($user,$password) {
        
        require_once __DIR__."/database.php";
        $db = new database();
        $r = $db->query("SELECT * FROM user WHERE username='$user' AND password='$password'");
        if ($row = $r->fetch_assoc()) {
            return true;
        }
        return false;
    }
    
    public function doRegister($user,$email,$password) {
        require_once __DIR__."/database.php";
        $db = new database();
        $otp = $this->codiceOTP();
        $r = $db->query("INSERT INTO user (username,email,password,CodiceOTP) VALUES ('$user','$email','$password','$otp')");
        if ($r) {
            return true;
        }       
         return false;
    }

    
    public function codiceOTP() {
        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Version 4
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Variant 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    
}


?>