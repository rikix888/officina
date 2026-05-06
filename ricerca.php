<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFFICINA</title>
    <script src="js/scriptRicerca.js" defer></script>
</head>
<body>
    <div>
        <select id="categoriaRicerca">
            <option value="servizio">Servizio</option>
            <option value="accessorio">Accessorio</option>
            <option value="ricambio">Pezzo di Ricambio</option>
        </select>
        <input type="text" id="testoRicerca" placeholder="Inserisci il nome...">
        <button id="btnCercaOfficine">Cerca Officine</button>
    </div>
    
    <div id="risultatiOfficine" style="margin-top: 20px;"></div>
    <button onclick="location.href='hobby.php'">Torna alla pagina principale</button>
</body>
</html>