document.addEventListener("DOMContentLoaded", function () {
    const btnCerca = document.getElementById('btnCercaOfficine');
    const inputTesto = document.getElementById('testoRicerca');
    const selectCategoria = document.getElementById('categoriaRicerca');
    const divRisultati = document.getElementById('risultatiOfficine');

    btnCerca.addEventListener("click", async function() {
        const testo = inputTesto.value.trim();
        const categoria = selectCategoria.value;

   
        if (testo === "") {
            divRisultati.innerHTML = "<p>Inserisci un testo per la ricerca.</p>";
            return;
        }

        divRisultati.innerHTML = "<p>Ricerca in corso...</p>";

        let response = await fetch('api/ricercaOfficineAPI.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({ 
                testo: testo, 
                categoria: categoria 
            })
        });

        let bodyText = await response.text();

        try {
            let json = JSON.parse(bodyText);
            divRisultati.innerHTML = ""; 

            if (json.success) {
                json.data.forEach(officina => {
                    let card = document.createElement("div");
                    
                    card.innerHTML = `<strong>${officina.denominazione}</strong><br>
                                      ${officina.indirizzo}<br>
                                        Trovati: ${officina.elementi_trovati}
                                      </span>`;
                    
                    divRisultati.appendChild(card);
                });
            } else {
                divRisultati.innerHTML = `<p>${json.message}</p>`;
            }
        } catch (e) {
            console.error(e);
            console.log(bodyText);
        }
    });
});