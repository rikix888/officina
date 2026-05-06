<?php

class officineAll
{

    public $codice;
    public $denominazione;
    public $indirizzo;
    public $serviziOfferti = [];
    public $accessori = [];
    public $ricambi = [];

    public function __construct() {}

    public function setCodice($c)
    {
        $this->codice = $c;
    }

    public function setDenominazione($d)
    {
        $this->denominazione = $d;
    }

    public function setIndirizzo($i)
    {
        $this->indirizzo = $i;
    }

    public function setServiziOfferti($s = [])
    {
        $this->serviziOfferti = $s;
    }

    public function setAccessori($a = [])
    {
        $this->accessori = $a;
    }

    public function setRicambi($r = [])
    {
        $this->ricambi = $r;
    }

    public function getOfficine()
    {
        require_once __DIR__ . "/database.php";
        $db = new database();

        $r = $db->query("SELECT Codice, Denominazione, Indirizzo FROM OFFICINA");

        $listaOfficine = [];

        if ($r && $r->num_rows > 0) {
            while ($row = $r->fetch_assoc()) {
                $officina = new officineAll();
                $officina->setCodice($row["Codice"]);
                $officina->setDenominazione($row["Denominazione"]);
                $officina->setIndirizzo($row["Indirizzo"]);

                $cod = $row["Codice"];

                // 2. Recupero TUTTI i servizi per QUESTA officina tramite JOIN
                $qServizi = $db->query("SELECT S.Descrizione FROM SERVIZIO S 
                JOIN OFFRE O ON S.Codice = O.CodiceServizio 
                WHERE O.CodiceOfficina = $cod ");

                $servizi = [];
                if ($qServizi) {
                    while ($sRow = $qServizi->fetch_assoc()) {
                        $servizi[] = $sRow["Descrizione"];
                    }
                }
                $officina->setServiziOfferti($servizi);

                // 3. Recupero TUTTI gli accessori disponibili per QUESTA officina
                $qAccessori = $db->query(" SELECT A.Descrizione FROM ACCESSORIO A 
                JOIN PRESENZA_ACCESSORIO PA ON A.CodiceArticolo = PA.CodiceArticolo 
                WHERE PA.CodiceOfficina = $cod AND PA.Quantita > 0 ");

                $accessori = [];
                if ($qAccessori) {
                    while ($aRow = $qAccessori->fetch_assoc()) {
                        $accessori[] = $aRow["Descrizione"];
                    }
                }
                $officina->setAccessori($accessori);
               

                // 4. Recupero TUTTI i ricambi disponibili per QUESTA officina
                $qRicambi = $db->query("SELECT P.Descrizione FROM PEZZO_DI_RICAMBIO P 
                JOIN PRESENZA_RICAMBIO PR ON P.CodicePezzo = PR.CodicePezzo 
                WHERE PR.CodiceOfficina = $cod AND PR.Quantita > 0 ");

                $ricambi = [];
                if ($qRicambi) {
                    while ($pRow = $qRicambi->fetch_assoc()) {
                        $ricambi[] = $pRow["Descrizione"];
                    }
                }
                $officina->setRicambi($ricambi);
              
                $listaOfficine[] = $officina;
            }
        }

        return $listaOfficine;
    }
}
