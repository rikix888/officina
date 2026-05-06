<?php
session_start();

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['email'] = $email;

    require_once __DIR__."/../classi/credenziali.php";
    $credenziali = new Credenziali();
    if ($credenziali->doRegister($username,$email,$password)) {
        ok("");
        
    }
    else {
        error("Registration failed");
    }
}
    

function error($msg) {
    $v = [
    "success" => false,
   ];
   if ($msg) {
       $v["message"] = $msg;
   }
   echo json_encode($v);
   exit;
}

function ok($data,$msg=null) {
   $v = [
    "success" => true,
    "data" => $data
   ];
   if ($msg) {
       $v["message"] = $msg;
   }
   echo json_encode($v);
   exit;
}

?>
