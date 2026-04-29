addEventListener('DOMContentLoaded', function() {

document.getElementById('registerBtn').addEventListener('click', async function() {
    const user = document.getElementById('registerUser').value;
    const email = document.getElementById('registerEmail').value;
    const pass = document.getElementById('registerPass').value;

    let response = await fetch('api/registerAPI.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({ username: user, email: email, password: pass })
    })
    let body = await response.text();
    console.log(body);
    let bodyJson = JSON.parse(body);

    if (bodyJson.success) {
        
        window.location.href = "mailer.php";
    } else {
       alert(bodyJson.message);
    }
});
});
