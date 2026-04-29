document.addEventListener("DOMContentLoaded", async function () {
    const divOfficine = document.getElementById('officine');

   

    let response = await fetch('api/visualizzaOfficine.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
    });

    let bodyText = await response.text();

    try {
        console.log(bodyText);
        let json = JSON.parse(bodyText);
        divOfficine.innerHTML = "";

        if (json.success) {
            json.data.forEach(officina => {
                let card = document.createElement("div");
                card.style.borderBottom = "1px solid #ccc";
                card.style.padding = "10px 0";

                card.innerHTML = `
                    <strong>${officina.denominazione}</strong><br>
                    <small>${officina.indirizzo}</small><br>
                    <span style="display: inline-block; margin-top: 5px; font-size: 0.9em; color: #333;">
                        <strong>Servizi:</strong> ${officina.serviziOfferti} <br>
                        <strong>Accessori:</strong> ${officina.accessori}<br>
                        <strong>Ricambi:</strong> ${officina.ricambi}
                    </span>
                `;

                divOfficine.appendChild(card);
            });
        } else {
            divOfficine.innerHTML = `<p>${json.message}</p>`;
        }
    } catch (e) {
        console.error(e);
    }
});