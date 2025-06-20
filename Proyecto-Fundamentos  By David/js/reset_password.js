document.getElementById("recoverForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const msg = document.getElementById("message");
    msg.innerText = "Enviando...";
    msg.style.color = "black";

    fetch("../database/send_reset.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "email=" + encodeURIComponent(email),
    })
    .then(res => res.json())
    .then(data => {
        msg.innerText = data.message;
        msg.style.color = data.success ? "green" : "red";
        if (data.success) {
            document.getElementById("recoverForm").reset();
        }
    })
    .catch(err => {
        msg.innerText = "❌ Error al enviar la solicitud.";
        msg.style.color = "red";
        console.error("Error:", err);
    });
});
