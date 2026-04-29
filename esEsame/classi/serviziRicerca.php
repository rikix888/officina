<?php 

class servizi {
    
    public $descrizione;

    public function __construct() {}

    public function setDescrizione($d){
        $this->descrizione = $d;
    }

    public function getServizi($param) {
        require_once __DIR__."/database.php";
        $db = new database();
        
        $r = $db->query("SELECT Descrizione FROM servizio WHERE Descrizione LIKE '$param'");
        
        

        
        $listaServizi = [];
        
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $servizio = new servizi();
                $servizio->setDescrizione($row["Descrizione"]); 
                $listaServizi[] = $servizio;
            }
        }
        
        return $listaServizi;
    }
}
?>