<?php
session_start();
require_once __DIR__."/../classi/database.php";
$db = new database();

if (isset($_POST['tipo'], $_POST['descrizione'])) {
    $tipo = $_POST['tipo'];
    $descrizione = $_POST['descrizione'];
    
    $costoOrario = isset($_POST['costoOrario']) ? (float)$_POST['costoOrario'] : 0;
    $costoUnitario = isset($_POST['costoUnitario']) ? (float)$_POST['costoUnitario'] : 0;

    $sql = "";

    if ($tipo === 'servizio') {
        $sql = "INSERT INTO SERVIZIO (CostoOrario, Descrizione) 
                VALUES ($costoOrario, '$descrizione')";
                
    } else if ($tipo === 'accessorio') {
        $sql = "INSERT INTO ACCESSORIO (CostoUnitario, Descrizione) 
                VALUES ($costoUnitario, '$descrizione')";
                
    } else if ($tipo === 'ricambio') {
        $sql = "INSERT INTO PEZZO_DI_RICAMBIO (Descrizione, CostoUnitario) 
                VALUES ('$descrizione', $costoUnitario)";
                
    } else {
        echo json_encode(["success" => false, "message" => "Tipo di elemento non valido."]);
        exit;
    }

    $result = $db->query($sql);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Elemento aggiunto"]);
    } else {
        echo json_encode(["success" => false, "message" => "Errore nell'inserimento nel database"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Parametri mancanti."]);
}
?>