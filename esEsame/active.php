<?php 
    if (isset($_GET['otp'])) {
        $otpTrovato = $_GET['otp'];
        require_once __DIR__."/classi/database.php";
        $db = new database();

        $r = $db->query("UPDATE user SET Attivazione=1, CodiceOTP=NULL WHERE CodiceOTP='$otpTrovato'");
        if ($r) {
            header("Location: login.php?msg=1");
            exit();
        }
        else {
            echo "Errore durante l'attivazione dell'account.";
        }
        
        
    }


?>