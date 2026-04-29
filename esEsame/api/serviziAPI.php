<?php 
if (isset($_POST["param"])) {
    $param = $_POST['param'];

    require_once __DIR__."/../classi/servizi.php";
    $servizi = new servizi();
    
    $r = $servizi->getServizi($param);
    
    if (!empty($r)) {
        echo json_encode($r);
        exit;
    } else {
        error("Non ci sono servizi di quel tipo");
    }
} else {
    error("Nessun parametro inviato");
}

function error($msg = null) {
    $v = [
        "success" => false,
    ];
    if ($msg) { 
        $v["message"] = $msg;
    }
    echo json_encode($v);
    exit;
}
?>