<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once __DIR__."/../classi/credenziali.php";
    $credenziali = new Credenziali();
    if ($credenziali->doLogin($username,$password)) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['logged'] = true;
        ok("");
        
        
    }
    else {
        error("Login failed");
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
