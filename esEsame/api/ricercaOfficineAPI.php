<?php 
if (isset($_POST["testo"]) && isset($_POST["categoria"])) {
    $testo = $_POST['testo'];
    $categoria = $_POST['categoria'];

    require_once __DIR__."/../classi/officineRicerca.php";
    $officineObj = new officine();
    
    $risultati = $officineObj->getOfficineCompatibili($testo, $categoria);
    
    if (!empty($risultati)) {
        echo json_encode([
            "success" => true,
            "data" => $risultati
        ]);
        exit;
    } else {
        error("Nessuna officina trovata per questa ricerca.");
    }
} else {
    error("Parametri di ricerca mancanti.");
}

function error($msg) {
    echo json_encode([
        "success" => false,
        "message" => $msg
    ]);
    exit;
}
?>