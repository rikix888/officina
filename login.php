<?php

    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        
        if ($msg == 1) {
            echo '<p style="color: green;">Registrazione e attivazione avvenute con successo! </p>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="js/scriptL.js"></script>
    
</head>
<body>
    <h1>Login</h1>
    <input type="text" id="loginUser" placeholder="Username">
    <input type="password" id="loginPass" placeholder="Password">
    <button id="loginBtn">Login</button>
    <a href="register.php">Don't have an account? Register here.</a>


    <div id="message"></div>

    
</body>
</html>