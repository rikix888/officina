<?php
session_start();
require_once __DIR__."/classi/database.php";
$db = new database();
if (isset($_SESSION['username'])) {
    $sql = "SELECT isAdmin FROM user WHERE username = '" . $_SESSION['username'] . "'";
    
    $result = $db->query($sql);
    $r = $result->fetch_assoc();

    if($r['isAdmin'] == 1){
        echo  "Accesso autorizzato.";
    }
    else{
        echo json_encode(["success" => false, "message" => "Accesso negato. Operazione non autorizzata."]);
        header("Location: index.php");
        exit;
    }
}
else {
    echo json_encode(["success" => false, "message" => "Accesso negato. Utente non autenticato."]);
    header("Location: login.php");
    exit;   
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello Amministratore</title>
    <script src="js/scriptAdmin.js" defer></script>
</head>
<body>
    <h1>Gestione Servizi Officine</h1>
    


        <label>Categoria:</label>
        <select id="tipoElemento" required>
            <option value="servizio">Servizio</option>
            <option value="accessorio">Accessorio</option>
            <option value="ricambio">Pezzo di Ricambio</option>
        </select><br><br>

        <div id="divDescrizione">
        <label>Descrizione</label>
        <input type="text" id="descrizione">
        </div>


        <div id="divOrario">
        <label>Costo orario</label>
        <input type="number" id="costoOrario">
        </div>

        <div id="divUnitario" style="display: none;">
        <label>Costo unitario</label>
        <input type="number" id="costoUnitario">
        </div><br>

        <label id="msgAdmin"></label><br>

        <button id="bottoneAdd">Aggiungi al Database</button>


</body>
</html>