<?php 

class officine {
    
    public function __construct() {}

    public function getOfficineCompatibili($testo, $categoria) {
        require_once __DIR__."/database.php";
        $db = new database();
        
        $param = $testo . "%"; 
        
        $sql = "";

        switch ($categoria) {
            
            case 'servizio':
                // La query include una JOIN con la tabella SERVIZIO per ottenere la descrizione del servizio
                $sql = "SELECT O.Codice, O.Denominazione, O.Indirizzo, GROUP_CONCAT(S.Descrizione SEPARATOR ', ') AS ElementiTrovati
                        FROM OFFICINA O 
                        JOIN OFFRE OFR ON O.Codice = OFR.CodiceOfficina 
                        JOIN SERVIZIO S ON OFR.CodiceServizio = S.Codice 
                        WHERE S.Descrizione LIKE '$param'
                        GROUP BY O.Codice, O.Denominazione, O.Indirizzo";
                break;
                
            
            case 'accessorio':
                $sql = "SELECT O.Codice, O.Denominazione, O.Indirizzo, GROUP_CONCAT(A.Descrizione SEPARATOR ', ') AS ElementiTrovati
                        FROM OFFICINA O 
                        JOIN PRESENZA_ACCESSORIO PA ON O.Codice = PA.CodiceOfficina 
                        JOIN ACCESSORIO A ON PA.CodiceArticolo = A.CodiceArticolo 
                        WHERE A.Descrizione LIKE '$param' AND PA.Quantita > 0
                        GROUP BY O.Codice, O.Denominazione, O.Indirizzo";
                break;

            case 'ricambio':
                $sql = "SELECT O.Codice, O.Denominazione, O.Indirizzo, GROUP_CONCAT(PDR.Descrizione SEPARATOR ', ') AS ElementiTrovati
                        FROM OFFICINA O 
                        JOIN PRESENZA_RICAMBIO PR ON O.Codice = PR.CodiceOfficina 
                        JOIN PEZZO_DI_RICAMBIO PDR ON PR.CodicePezzo = PDR.CodicePezzo 
                        WHERE PDR.Descrizione LIKE '$param' AND PR.Quantita > 0
                        GROUP BY O.Codice, O.Denominazione, O.Indirizzo";
                break;

            default:
                return []; 
        }

        $r = $db->query($sql);
        
        $listaOfficine = [];
        
        if ($r && $r->num_rows > 0) {
            while ($row = $r->fetch_assoc()) {
                $listaOfficine[] = [
                    "denominazione" => $row["Denominazione"],
                    "indirizzo" => $row["Indirizzo"],
                    "elementi_trovati" => $row["ElementiTrovati"]
                ];
            }
        }
        
        return $listaOfficine;
    }
}

?>