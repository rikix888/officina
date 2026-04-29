document.addEventListener("DOMContentLoaded", function () {
    const selectTipo = document.getElementById('tipoElemento');
    const divCostoUnitario = document.getElementById('divUnitario');
    const divCostoOrario = document.getElementById('divOrario');
    const divDescrizione = document.getElementById('divDescrizione');
    const btn = document.getElementById('bottoneAdd');
    const msgAdmin = document.getElementById('msgAdmin');

    selectTipo.addEventListener('change', function() {
        if (this.value === 'servizio') {
            divCostoUnitario.style.display = 'none';
            divCostoOrario.style.display = 'block';
        } else {
            divCostoUnitario.style.display = 'block';
            divCostoOrario.style.display = 'none';

        }
    });

    btn.addEventListener('click', async function() {

        const costoUnitario = document.getElementById('costoUnitario').value;
        const costoOrario = document.getElementById('costoOrario').value;
        const descrizione = document.getElementById('descrizione').value;
        const tipo = document.getElementById('tipoElemento').value;        



        try {
            let response = await fetch('api/aggiungiAPI.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ tipo: tipo , costoUnitario: costoUnitario, costoOrario: costoOrario, descrizione: descrizione })
            });

            let json = await response.text();
            console.log(json);
            json= JSON.parse(json);

          
            msgAdmin.style.color = json.success ? "green" : "red";
            msgAdmin.textContent = json.message;

        
            if (json.success) {
                btn.reset();
                divCostoUnitario.style.display = 'none';
                divCostoOrario.style.display = 'block';
            }

        } catch (error) {
            console.error(error);
           
        }
    });
});

''