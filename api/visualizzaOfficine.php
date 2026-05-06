<?php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
require_once __DIR__."/../classi/officineAll.php";
$officine = new officineAll();

$risultati = $officine->getOfficine();

if (!empty($risultati)) {
    echo json_encode([
        "success" => true,
        "data" => $risultati
    ]);
    exit;
} else {
    error("Nessuna officina trovata per questa ricerca.");
}



function error($msg) {
    echo json_encode([
        "success" => false,
        "message" => $msg
    ]);
    exit;
}
?>