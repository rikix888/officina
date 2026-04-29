addEventListener('DOMContentLoaded', function() {

document.getElementById('loginBtn').addEventListener('click', async function() {
    const user = document.getElementById('loginUser').value;
    const pass = document.getElementById('loginPass').value;

    let response = await fetch('api/loginAPI.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({ username: user, password: pass })
    })
    let body = await response.text();
    console.log(body);
    let bodyJson = JSON.parse(body);

    if (bodyJson.success) {
        alert("Login successful!");
        window.location.href = "index.php";
    } else {
       alert(bodyJson.message);
    }
});
});
